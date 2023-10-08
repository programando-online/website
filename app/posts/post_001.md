---
title: Olá Mundo - Blog no Ar
date: '2023-10-08'
tags:
  - Web
---

Olá, eu sou o Fernando e este é meu blog pessoal sobre programação.
Decidi desenvolver esse site utilizando o PHP, linguagem que utilizo para programar atualmente. Porém, não utilizei da forma tradicional, rodando em um servidor, mas sim como um construtor de sites estáticos para gerar todo o conteúdo em HTML, CSS e Javascript. 

Como bibliotecas externas estou utilizando [CommomMark](https://github.com/thephpleague/commonmark), o [Slugify](https://github.com/cocur/slugify) e o [Twig](https://twig.symfony.com/). A primeira biblioteca faz a conversão do formato de arquivo Markdown e seus metadados para o HTML. O Slugify converte strings para slugs e o Twig é um motor de templates que gera uma saída totalmente em HTML.

Para gerar os aquivos de estilos do site utilizei o [TailwindCSS](https://tailwindcss.com/), mais precisamente o Tailwind-cli rodando em node-js. Ele analiza os arquivos de html do template e gera um CSS customizado, apenas com as classes utilizadas. O mesmo método utilizei para criar um bundle dos arquivos Javascript, porém com a ferramenta [ESBuild](https://esbuild.github.io/) fazendo todo o trabalho.

<i class="inline-block" data-feather="smile"></i> Agora falando em bibliotecas integradas com o site, os ícones são providos pela biblioteca [Feather Icons](https://feathericons.com/) e o [Highlight.js](https://highlightjs.org/) irá realçar a sintaxe dos códigos apresentados nas postagens facilitando a leitura, como no código abaixo:

<pre><code class="php">echo "Olá Mundo!";
</code></pre>

E por fim, a biblioteca [Lunr.js](https://lunrjs.com/) possibilita realizar pesquisas em sites estáticos. Clicando no ícone de busca no cabeçalho do site você pode procurar utilizando uma caixa de pesquisas.

Desenvolver esse blog, embora tenha demorado um bocado se comparado a usar as ferramentas prontas, foi muito gratificante. Integrei diversas tecnologias para um fim específico, sofri para fazer muita coisa funcionar, desisti de outras tecnologias, reescrevi muito código... enfim, nada de novo na rotina de um programador.