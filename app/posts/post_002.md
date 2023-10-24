---
title: Três formas de usar o PHP no windows
date: '2023-10-11'
tags:
  - PHP
  - Apache
  - Windows
---

Essa postagem é mais uma visão geral sobre o uso do PHP em ambientes Windows do que um tutorial ou um aprofundamento, mas as vezes é necessário ver que existem mais de uma opção para o mesmo problema.
Atualmente existem três formas de instalar, ou melhor dizendo, usar o PHP no sistema operacional Windows. Cada uma delas exige um nível distinto de conhecimento, tanto do funcionamento da linguagem quanto da integração com outros serviços como Banco de Dados e Servidor Web.

## Usar os binários pré-compilados (instalação manual)

Através do site [https://windows.php.net/download/](https://windows.php.net/download/) é possível baixar os arquivos compilados do PHP para o sistema operacional Windows, bem como o código fonte da linguagem. Assim, se você possuir conhecimentos suficientes, pode compilar o PHP no seu próprio dispositivo. 

Esses binários do PHP são pré-compilados com e sem a capacidade de multithreads, sendo identificados pelas versões TS (**T**hread-**S**afe) e NTS (**N**on **T**hread-**S**afe) e requerem que a biblioteca *Visual C++ Redistributable para Visual Studio 2015-2019* seja instalada no sistema.

Depois de baixar o arquivo, deve-se descompacta-lo em um diretório do sistema operacional (como em **C://php**, por exemplo) e adicionar este caminho ao PATH das variáveis do sistema. Isso faz com que o sistema reconheça o interetador do php e seja capaz de interpretar um arquivo php no terminal do sistema. Também é possível inicializar o servidor embutido do PHP para testes simples, Mas para o desenvolvimento de sites e aplicações mais complexas é recomendado realizar a instalação e a configurações de servidores web como o IIS ou o [Apache Lounge](https://www.apachelounge.com/), softwares que são realmente usados em produção.

Essa não é uma forma de uso recomendada para a maioria dos usuários iniciantes. Fica claro que usar o PHP dessa forma exige um conhecimento considerável de servidores web, e leva um tempo a mais para a configuração e atualização do sistema. Imagine que a cada nova versão que você deseje instalar em sua máquina, as configurações devem ser também atualizadas. E levando em conta que a maioria dos servidores web utilizam Linux, existe a possibilidade de uma aplicação feita na sua máquina funcione de forma inesperada no servidor. Por isso existem outras formas de utilizar o PHP.

## Instalar pacotes de desenvolvimento

Para facilitar a criação de ambientes de desenvolvimento PHP no Windows, foram criados pacotes de desenvolvimento como o [XAMPP](https://www.apachefriends.org/), [WampServer](https://www.wampserver.com/), [EasyPHP](https://www.easyphp.org/) e [Laragon](https://laragon.org/).

São softwares que empacotam o PHP e outros serviços como Servidores Web, Sistemas Gerenciadores de Banco de Dados, editores de texto, etc; todos já integrados e configurados.

Esses softwares auxiliam na inicialização, configuração e manutenção de ambientes de desenvolvimento, todos podendo ser acessados através de um painel de controle. Com um clique é possível inicializar o Banco de Dados ou alterar as configurações do php.ini.

![Painel de Controle do Laragon](https://lh3.googleusercontent.com/pw/ADCreHdQwh2parorn6GxumdSHyBC4nzpxU80sGfX_PlkY53fgeOziKFwhwjU3LhpIw7GbGUSxBOIQcOqyyLFMWR5d-TrjFUfP6YCfWzBN9SiKqOr3pmbZOcelDqssY9pMQ9ajPGTzOB4c8Y4qqJHx7hQUorZ=w676-h452-s-no?authuser=0){.text-center .my-2}

Embora seja uma alternativa excelente para aqueles que desejam aprender o PHP, (eu mesmo comecei usando o XAMPP na faculdade), as vezes pode ser confuso entender quais são as atribuições de cada software ou serviço. Um erro no servidor web pode ser confundido com um erro do PHP e vice-versa. Por isso, apesar de usar tudo junto e misturado, é necessário que o iniciante estude cada um dos componentes utilizados. Além disso, o problema citado anteriormente de rodar na sua máquina e não no servidor ainda persiste.

## Utilizar containers

Aqui vou entrar em um assunto complicado de explicar. Complicado porque a melhor comparação seria dizer que containers são *como maquinas virtuais* que rodam isoladas no seu dispositivo. O problema é que containers **não são máquinas virtuais**. Então vai uma definição um pouco genérica: containers são ambientes isolados do seu dispositivo mas que compartilham do kernel do seu sistema operacional para empacotar aplicações. Para uma explicação bem mais técnica e aprofundada, aqui está um link para o [vídeo](https://www.youtube.com/watch?v=85k8se4Zo70) do Fabio Akita sobre o tema.

O orquestrador de containers mais utilizado atualmente é o [Docker](https://www.docker.com/), com ele é possível criar containers de praticamente qualquer aplicação, inclusive PHP rodando em diversas versões e servidores. 
Não vou entrar nos pormenores da instalação pois isso daria uma postagem inteira, mas é possível utilizar a docker engine instalada no WSL (Windows Subsystem for Linux), aproveitando no Windows a performance do Docker para linux.
Primeiro, uma **imagem** do software ou servidor é baixada (pense na imagem como uma ISO do sistema contendo apenas os arquivos realmente necessários), em seguida as configurações do container são aplicadas e ele é executado. 
No exemplo abaixo, com um único comando no terminal o docker reflete o arquivo index.php em um container que contém a versão 5.6 da linguagem e um servidor apache.
![Rodando PHP no Docker](https://lh3.googleusercontent.com/pw/ADCreHduRxJlEdoluwpxSRqt2TQNJ7rpCMq3yLJOtvowVscK83GEEw0mtoLzKczhmCQDKfr3BzyXXsjw7P3TuNBn3M1HN9tLT2nQ91iP-AbNtAPBbn93pAI4bBPpZt40zL-BgVIW1So133mIvncJLi4HZNtI=w1222-h643-s-no?authuser=0)

Da mesma forma é possível rodar dois servidores com diferentes versões do PHP. Isso facilita muito o desenvolvimento principalmente quando se precisa trabalhar com projetos legados que necessitam de versões antigas do PHP.

![Dois containers rodando ao mesmo tempo](https://lh3.googleusercontent.com/pw/ADCreHdHxh8QOql7IIO98IZ70It0x6pXy-hg7b2i98DJpU3KFRWqxtyc1kBg3eu6FqvovXLYqL85_uSTBvA-MDk7ZHhUdFT-JNd6KCztxZ4ewkghVbcRDB1mYC2Bjw46oXghMKfWksRetVBG6T2R_RMICHj8=w1225-h643-s-no?authuser=0)

Mas como sempre, existem os contras. Para rodar containers, é necessário possuir um Hardware relativamente potente. Além da necessidade de dominar os orquestradores de containers, geralmente usando linha de comandos, e usar um pouco do tempo configurando as imagens.