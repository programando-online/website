const feather = require('feather-icons');

//Feather Icons
feather.replace();
// Switch Theme
const changeButton = (featherIcon) => {
    let svg = document.querySelector("#theme-switcher").querySelector('.feather');
    document.querySelector("#theme-switcher").removeChild(svg);
    let icon = document.createElement('i');
    icon.setAttribute('data-feather', featherIcon);
    document.querySelector("#theme-switcher").appendChild(icon);
    feather.replace();
    console.log(featherIcon);
}
/* Theme Config */
var defaultIsDark;
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    defaultIsDark = true;
}else{
    defaultIsDark = false;
}
function loadSaveTheme(){
    let theme = window.localStorage.getItem("theme");
    switch (theme) {
        case 'dark':
            return 'dark';
            break;
        case 'light':
            return 'light';
            break;
        default:
            return (defaultIsDark === true) ? 'dark' : 'light';
            break;
    }
}
function setTheme(theme, save = false){
    if(theme === 'light'){
        document.documentElement.classList.remove('dark');
        changeButton('moon');
    }else if(theme === 'dark'){
        document.documentElement.classList.add('dark');
        changeButton('sun')
    }else{
        return;
    }
    if(save){
        window.localStorage.setItem('theme', theme);
    }
}
document.querySelector("#theme-switcher").addEventListener('click', () => {
    if (document.documentElement.classList.contains('dark')) {
        setTheme('light', true)
    } else {
        setTheme('dark', true);
    }
});

/* Search Box */
const open_modal_search = () => {
    document.querySelector('#modal-search').classList.remove('hidden');
    setTimeout(() => {
        document.querySelector('#modal-box-search').classList.add('m-2');
        document.querySelector('#modal-box-search').classList.remove('-mt-48');
        document.querySelector('#modal-search input').focus();
    }, 100);
}
const close_modal_search = () => {
    document.querySelector('#modal-box-search').classList.remove('m-2');
    document.querySelector('#modal-box-search').classList.add('-mt-48');
    setTimeout(() => {
        document.querySelector('#modal-search').classList.add('hidden');
        document.querySelector('#modal-search input').value = '';
        document.querySelector('#search-result').innerHTML = '';
    }, 100);
}
document.querySelector('#search-show').addEventListener('click', () => {
    open_modal_search();
});
document.querySelector('#search-close').addEventListener('click', () => {
    close_modal_search();
});
document.querySelector('#button-search').addEventListener('click', () => {
    setSearch();
});
document.querySelector('#input-search').addEventListener('keypress', (event) => {
    if (event.key === "Enter") {
        setSearch();
    }
});
function setSearch() {
    let loader = document.querySelector('#search-loader');
    let term = document.querySelector('#input-search').value;
    if (term.length > 0) {
        loader.classList.remove('hidden');
        loader.classList.add('flex');
        let container = document.querySelector('#search-result');
        container.innerHTML = '';
        let results = idx.search(term);
        if (results.length === 0) {
            let p = document.createElement('p');
            p.textContent = 'Nenhum resultado encontrado.';
            container.appendChild(p);
        } else {
            results.forEach((r) => {
                console.log(r);
                let post = posts.find((el) => el.title == r.ref);
                let link = document.createElement('a');
                link.classList.add('py-2', 'no-underline');
                link.setAttribute('href', post.href);
                let title = document.createElement('h2');
                title.classList.add('text-md', 'text-slate-800', 'hover:text-amber-400', 'font-bold', 'uppercase', 'hover:underline');
                title.textContent = post.title;
                let excerpt = document.createElement('p');
                excerpt.classList.add('py-1', 'mb-1',  'text-slate-800');
                excerpt.textContent = post.text.slice(0, 150);
                let terms = Object.keys(r.matchData.metadata).join(',');
                let found = document.createElement('p');
                found.classList.add('mb-1', 'text-slate-800');
                found.innerHTML = "Termos encontrados: <strong class='font-bold'>" + terms + "</strong>";
                let result = document.createElement('div');
                result.appendChild(excerpt);
                result.appendChild(found);
                link.appendChild(title);
                container.appendChild(link);
                container.appendChild(result);
            });
        }
        loader.classList.remove('flex');
        loader.classList.add('hidden');
    }
}
/* Tags Box */
const open_modal_tags = () => {
    document.querySelector('#modal-tags').classList.remove('hidden');
    setTimeout(() => {
        document.querySelector('#modal-box-tags').classList.add('m-2');
        document.querySelector('#modal-box-tags').classList.remove('-mt-48');
    }, 100);
}
const close_modal_tags = () => {
    document.querySelector('#modal-box-tags').classList.remove('m-2');
    document.querySelector('#modal-box-tags').classList.add('-mt-48');
    setTimeout(() => {
        document.querySelector('#modal-tags').classList.add('hidden');
    }, 100);
}
document.querySelector('#tags-show').addEventListener('click', () => {
    open_modal_tags();
});
document.querySelector('#tags-close').addEventListener('click', () => {
    close_modal_tags();
});
/* Profile Box */
function get_user_data() {
    fetch('https://api.github.com/users/luizfnunes')
        .then(response => {
            if (response.status === 200) {
                return response.json();
            } else {
                throw Error('Ocorreu um erro ao carregar dados do perfil.');
            }
        })
        .then(response => {
            let image = response.avatar_url;
            let name = response.name;
            let profile_url = response.html_url;
            let bio = response.bio;
            let count_repo = response.public_repos;
            let count_gist = response.public_gists;
            let followers = response.followers;
            let following = response.following;
            let author_el = document.querySelector('#author');
            let loader = document.querySelector('#author-loader');
            author_el.querySelector('img').setAttribute('src', image);
            author_el.querySelector('a').setAttribute('href', profile_url);
            author_el.querySelector('a').textContent = name;
            author_el.querySelector('p').textContent = bio;
            author_el.querySelector('span#repo').textContent = count_repo;
            author_el.querySelector('span#gists').textContent = count_gist;
            author_el.querySelector('span#followers').textContent = followers;
            author_el.querySelector('span#following').textContent = following;
            // author_el.querySelectorAll('.hidden').forEach((el) => {
            //     el.classList.remove('hidden');
            // });
            author_el.classList.remove('hidden');
            loader.remove();
        })
        .catch(error => {
        });
}
var metadata_url = "/search.json";
var posts = [];
var idx;
document.addEventListener('DOMContentLoaded', () => {
    setTheme(loadSaveTheme(), false);
    document.querySelector('#main-loader').classList.add('hidden');
    get_user_data();
    let request = new XMLHttpRequest();
    request.open('get', metadata_url, true);
    request.onload = function () {
        posts = JSON.parse(this.response);
        idx = lunr(function () {
            this.ref('title');
            this.field('title');
            this.field('text');
            this.metadataWhitelist = ['position']
            posts.forEach((doc) => {
                this.add(doc, 'href')
            }, this);
        });
    }
    request.send();

});