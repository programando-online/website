<?php

namespace App;

use Cocur\Slugify\Slugify;

class Application
{
    private Config $config;
    private Template $template;
    private Converter $converter;
    private array $pages;
    private array $posts;
    private string $output;

    public function __construct(string $templatePath, array $converterConfig = [])
    {
        $this->config = new Config();
        $this->output = $this->config->get('output', 'dir');
        $this->template = new Template($templatePath);
        $this->converter = new Converter($converterConfig);
        $this->readPages();
        $this->readPosts();
    }

    private function getMarkdownData(string $directory, \SplFileInfo $file)
    {
        $file = $directory . "/" . $file->getFilename();
        $markdown = MarkdownReader::read($file);
        $data = $this->converter->read($markdown);
        return $data;
    }

    /* Read Pages and Posts */
    private function readPages()
    {
        $this->pages = [];
        $pagesDir = $this->config->get('folders', 'pages');
        $pageIterator = new \DirectoryIterator($pagesDir);
        foreach ($pageIterator as $fileInfo) {
            if ($fileInfo->isFile() && strtolower($fileInfo->getExtension()) == "md") {
                $data = $this->getMarkdownData($pagesDir, $fileInfo);
                $metakeys = array_filter(array_keys($data['header']), fn($val) => $val !== 'title');
                $metadata = [];
                foreach ($metakeys as $key) {
                    $metadata[$key] = $data['header'][$key];
                }
                $page = new BlogObject($data['header']['title'], $data['body'], $metadata);
                $this->pages[] = $page;
            }
        }
    }

    private function readPosts()
    {
        $this->posts = [];
        $postsDir = $this->config->get('folders', 'posts');
        $pageIterator = new \DirectoryIterator($postsDir);
        foreach ($pageIterator as $fileInfo) {
            if ($fileInfo->isFile() && strtolower($fileInfo->getExtension()) == "md") {
                $data = $this->getMarkdownData($postsDir, $fileInfo);
                $metakeys = array_filter(array_keys($data['header']), fn($val) => $val !== 'title');
                $metadata = [];
                foreach ($metakeys as $key) {
                    $metadata[$key] = $data['header'][$key];
                }
                $post = new BlogObject($data['header']['title'], $data['body'], $metadata);
                $post->header['tags'] = $this->convertTagList($post->header['tags']);
                $this->posts[] = $post;
            }
        }
        usort($this->posts, function ($p1, $p2) {
            if ($p1->header['date'] === $p2->header['date']) {
                return 0;
            }
            return $p1->header['date'] > $p2->header['date'] ? -1 : 1;
        });
    }

    private function clearOutput()
    {
        Output::clear($this->output);
        Output::create_dir($this->output);
    }

    public function run()
    {
        $this->clearOutput();
        $this->renderPages();
        $this->renderPosts();
        $this->renderIndex();
        $this->renderTags();
        $this->renderSearch();
        $this->renderAssets();
    }

    /* Default Data */
    private function getDefaultData()
    {
        return [
            'name' => $this->config->get('site', 'name'),
            'url' => $this->config->get('site', 'url'),
            'github' => $this->config->get('social', 'github'),
            'youtube' => $this->config->get('social', 'youtube'),
            'twitter' => $this->config->get('social', 'twitter'),
            'menu' => $this->getMenuData(),
            'tag_list' => $this->getTagList()
        ];
    }
    private function getMenuData()
    {
        $menu = [];
        foreach ($this->pages as $page) {
            if (array_key_exists('in_menu', $page->header) && $page->header['in_menu'] === true) {
                $menu[] = [
                    'title' => (array_key_exists('menu_title', $page->header)) ? $page->header['menu_title'] : $page->title,
                    'link' => $this->config->get('site', 'url') . "/page/" . $page->slug
                ];
            }
        }
        return $menu;
    }
    private function getTagList()
    {
        $tagList = [];
        foreach ($this->posts as $post) {
            foreach ($post->header['tags'] as $tag) {
                if (!in_array($tag, $tagList)) {
                    $tagList[] = $tag;
                }
            }
        }
        return $tagList;
    }
    /* Renders */
    private function renderPages()
    {
        $output_folder = $this->output . "page/";
        Output::create_dir($output_folder);
        foreach ($this->pages as $page) {
            $output_directory = $output_folder . $page->slug;
            Output::create_dir($output_directory);
            $output_file = $output_directory . "/index.html";
            $data = [
                ...$this->getDefaultData(),
                'title' => $page->title,
                'content' => $page->content,
            ];
            $html = $this->template->render('page.html', $data);
            Output::save($output_file, $html);
        }
    }

    private function renderPosts()
    {
        $output_folder = $this->output . "post/";
        Output::create_dir($output_folder);
        foreach ($this->posts as $post) {
            $output_directory = $output_folder . $post->slug;
            Output::create_dir($output_directory);
            $output_file = $output_directory . "/index.html";
            $data = [
                ...$this->getDefaultData(),
                'title' => $post->title,
                'date' => $post->header['date'],
                'tags' => $post->header['tags'], //$this->convertTagList($post->header['tags']),
                'content' => $post->content,
            ];
            $html = $this->template->render('post.html', $data);
            Output::save($output_file, $html);
        }
    }

    private function renderIndex()
    {
        $maxItems = $this->config->get('site', 'max_items');
        $paginated = $this->paginate($this->posts, $maxItems);
        $output_folder = $this->output;
        for ($i = 1; $i <= count($paginated); $i++) {
            if ($i === 1) {
                $output_dir = $output_folder;
            } else {
                $output_dir = $output_folder . "/$i";
                Output::create_dir($output_dir);
            }
            $output_file = $output_dir . "/index.html";
            $data = [
                ...$this->getDefaultData(),
                'posts' => $paginated[$i - 1],
                'num_pages' => count($paginated),
                'actual_page' => $i
            ];
            $html = $this->template->render('index.html', $data);
            Output::save($output_file, $html);
        }
    }

    private function renderTags()
    {
        $output_folder = $this->output . "tag/";
        Output::create_dir($output_folder);
        $tagList = $this->getTagList();
        foreach ($tagList as $tagItem) {
            $posts = [];
            foreach ($this->posts as $post) {
                foreach ($post->header['tags'] as $tag) {
                    if ($tag['name'] == $tagItem['name']) {
                        $posts[] = $post;
                    }
                }
            }
            $output_directory = $output_folder . $tagItem['slug'];
            Output::create_dir($output_directory);
            $maxItems = $this->config->get('site', 'max_items');
            $paginated = $this->paginate($posts, $maxItems);
            for ($i = 1; $i <= count($paginated); $i++) {
                if ($i === 1) {
                    $output_dir = $output_directory;
                } else {
                    $output_dir = $output_directory . "/$i";
                    Output::create_dir($output_dir);
                }
                $output_file = $output_dir . "/index.html";
                $data = [
                    ...$this->getDefaultData(),
                    'posts' => $paginated[$i - 1],
                    'num_pages' => count($paginated),
                    'actual_page' => $i,
                    'tag' => $tagItem['name'],
                    'slug' => $tagItem['slug']
                ];
                $html = $this->template->render('tag.html', $data);
                Output::save($output_file, $html);
            }
        }
    }
    public function renderSearch()
    {
        $url = $this->config->get('site', 'url');
        $posts = [];
        foreach ($this->posts as $post) {
            $posts[] = [
                'title' => $post->title,
                'href' => $url . "/post/" . $post->slug,
                'text' => trim(preg_replace('/\s\s+/', ' ', strip_tags($post->content))),
            ];
        }
        $html = json_encode($posts);
        Output::save($this->output . '/search.json', $html);
    }
    private function renderAssets()
    {
        exec('npm run build');
    }
    /* Utils */
    private function convertTagList(array $tags)
    {
        $tagList = [];
        foreach ($tags as $tag) {
            $tagList[] = [
                'name' => $tag,
                'slug' => (new Slugify())->slugify($tag)
            ];
        }
        return $tagList;
    }

    private function paginate(array $list, int $maxItems)
    {
        $total = count($list);
        if (count($list) > $maxItems) {
            $paginate = [];
            $pages = intval($total / $maxItems);
            $pages += ($total % $maxItems !== 0) ? 1 : 0;
            $counterPage = 0;
            $counterItem = 0;
            foreach ($list as $item) {
                $paginate[$counterPage][] = $item;
                $counterItem++;
                if ($counterItem > ($maxItems - 1)) {
                    $counterPage++;
                    $counterItem = 0;
                }
            }
            return $paginate;
        }
        return array($list);
    }
}