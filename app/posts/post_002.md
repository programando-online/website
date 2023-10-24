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

![Painel de Controle do Laragon](https://lh3.googleusercontent.com/pw/ADCreHcOctokpVXlUq4vXhW11bx3iCWnwtySljcpEakxDhd78BNRf5X4yeMy30pbqQ2DHM5SED56cfpnRSTHarjYld-fwEgktloIr3c4WTPLfTkSiwHmvxOFtCMhUTiO9Xvhc8moqcc_Mt8XPYtigHE-bsfW1dM1mzUB1nM-KbfrNiwMZ2TNT5PKgu-CUXqlS7uvEevrvgNwhh1wCQSE89vchGnfOGERI7abOys0uiOANg6i7Pntaoblsn6gOWJ4LkWJUq3TDAk3pbP-gY41m6YpO6XJLLZWraWQJAVAnR13AgFLDASgU8GcT90IERu_IDkPlJGJ8jjlPazpJMltSYbBERupVYnTvJHMz7-mJQXUke2VKt9SwknZSgtk-4V1yjbkiuH1geqM6lVkIHPzR6nRI3t3U00T8BLvxo7qo5SBrLicNEczzW51DxLhAQu12mLl6ReNtQemaxMGLCRI-yiRo-3DC7pQFEgV3JiVYvszifqzrmWeCTvyoJV6rVRGe9M7M2W1IboB8z01Z1ODSSpgQLRwID6p5hfwIa8Adh67akiqBY1cEDIp1B6Uz6fY0t6R178VxwLFmQ1uYHc7xmOqiMlQ3VwiTg8b1P01gIVsBnMVvGsyCXBRmEQaIv2gP8EF9sIVwVijNM-WxRKqcOuhJPCbffmlOPozOe4EHeDeB2f6OWKUpF74ztyeyCs0N6pAGGOwxzRtc5uDWrVoi_MA1XEekkL-b3sJ6P3NFCf0cUK9tGMgvrT55UeRdBBN-hNRiqQ8tgcrjqbPxQhBhPTMfUzrNRxdXXJ2ZWzCDpj-KBvT94oP1x3yuZLhKF18Gz9iF2THeeZImO48wecEhEiQVFyS2OK80JtTAeyPe-01BADqbRrF5N95DrJkGYEKX1gUvKFnk4V3uM9eLTY2k-ESeQ=w676-h452-s-no?authuser=0){.text-center .my-2}

Embora seja uma alternativa excelente para aqueles que desejam aprender o PHP, (eu mesmo comecei usando o XAMPP na faculdade), as vezes pode ser confuso entender quais são as atribuições de cada software ou serviço. Um erro no servidor web pode ser confundido com um erro do PHP e vice-versa. Por isso, apesar de usar tudo junto e misturado, é necessário que o iniciante estude cada um dos componentes utilizados. Além disso, o problema citado anteriormente de rodar na sua máquina e não no servidor ainda persiste.

## Utilizar containers

Aqui vou entrar em um assunto complicado de explicar. Complicado porque a melhor comparação seria dizer que containers são *como maquinas virtuais* que rodam isoladas no seu dispositivo. O problema é que containers **não são máquinas virtuais**. Então vai uma definição um pouco genérica: containers são ambientes isolados do seu dispositivo mas que compartilham do kernel do seu sistema operacional para empacotar aplicações. Para uma explicação bem mais técnica e aprofundada, aqui está um link para o [vídeo](https://www.youtube.com/watch?v=85k8se4Zo70) do Fabio Akita sobre o tema.

O orquestrador de containers mais utilizado atualmente é o [Docker](https://www.docker.com/), com ele é possível criar containers de praticamente qualquer aplicação, inclusive PHP rodando em diversas versões e servidores. 
Não vou entrar nos pormenores da instalação pois isso daria uma postagem inteira, mas é possível utilizar a docker engine instalada no WSL (Windows Subsystem for Linux), aproveitando no Windows a performance do Docker para linux.
Primeiro, uma **imagem** do software ou servidor é baixada (pense na imagem como uma ISO do sistema contendo apenas os arquivos realmente necessários), em seguida as configurações do container são aplicadas e ele é executado. 
No exemplo abaixo, com um único comando no terminal o docker reflete o arquivo index.php em um container que contém a versão 5.6 da linguagem e um servidor apache.
![Rodando PHP no Docker](https://lh3.googleusercontent.com/pw/ADCreHfV6fzWGA7gusH3fYLv27yrNFQffa3s_OEBw9E1SPaCbEFajmULp6z-_5quf_UrPd8UVRW3ti6UwGIk6PpWBO17RNE8LKZJxHEt1B53DlvKKXZQRULai5Y9CcpqioDbanxlN3rtdMg6gVUf1hG9c1AnPItfQ61LWUsZshEwG9JndAfHJ9gTML7YyRHLXrzQPjh3T8RkMp-p-qlSmqsIODVmOixuqyrtpa5RG9vVmSJ-T5eZ-52vvWUHlbI1qVqL7j7C9SgkcxM1_on9YAMm0uOZQhE5rxPoyCmKNrtUj8Ul2DE_RX-ukQ1bAffS8x0j5RNniewWuXICh_e6Az2Xm1JE6nxosNXsZzIDLWt9DSD72s0HVXQt2_HdMs_CdGYExP_3CUzNmwjl2BQN0hn4wzTlgMRvpB0Cd2QuuBX2-aJQx_VVukmtSe0Uy98Y1zK2BAFOvakP7TkR0vKUWTfNeL4kJh_i4fSVGs2EfJTqJVZJ7XQ1sspvJqUcavR_BxYpAuKeKLozyFH-0xTk1_r6MTfjJ6hhDBSiOjBinpZ3xtHt87a_3NbSMW0_F4lZsZkpdWYZGvRnEVbJD1wTU90nb3z_44plVVrDXS0dV59RVo8B9wa-6a4YQvQFAXde4JdJLuGkQmzhRwo1BZJWPD1oO8bGOjhdfgSTP2pFEf3sgX7ZCqbEpEBhJFTO1It2220WVhhBscFH45Wq3LhrEk5WOQYCNncGAxHsLfki25IoVUhppKyMDUGC35SlhFnwKL066njZ3qdctoZ4vF9DZEyzQc6jwl5KvckgMD5MpqxnWy4vEWkPoB6TJvahalHNsXCLpQUQpMIc5xwmfqddauieMx4zNF9S7VvfEWl4D86f_0Oo6EGJ0fnTGuQEmzZP3EQfZTWXybpvEo2XsjnsIkGXYg=w1222-h643-s-no?authuser=0)

Da mesma forma é possível rodar dois servidores com diferentes versões do PHP. Isso facilita muito o desenvolvimento principalmente quando se precisa trabalhar com projetos legados que necessitam de versões antigas do PHP.

![Dois containers rodando ao mesmo tempo](https://lh3.googleusercontent.com/pw/ADCreHcKZ8eQJHX3DJ9Y2rIBLigiDwJrGSFQO6ENmbW6fQFpGoOm-DJJVaPH-yvQFc6M0xnDYtHPAbzPz4TLGR61Gk4Mt9E-e6ISNZCyRkS_z7LibuGNcdesh-9dWZXd_U9cDbrwvydeDknennapX_nG3u-0aPrEbs3MUltxLCTczymhLsCVD1gFy0inbakCRx8o8yL4ZSGSaz1O0m43DF3rjYgrEsGylXuPNKRnE2rqkR-IrMIOlJb41drcygYjXpuYg3icIPyz0x8YRvLukHwi51ZTUgo0D1VvVAkEwqVtM8IesrHtePqPp03ba9EIoYXD0OdrHnoEgm3RdjWF99gSJ3lMeRU1uSNX4-fhiW-d6Goy1GV3L6wvWrrZ0ulOAbHu9CsjkKnaDQPjm5WoiVqrNbDvTXNZxUYBUV2F3xksDVpU6mk7Bw_nNMlJHZPqpGzfVs7GyalhXsbOuyqPggI-_58qQS6pk_hzBgZBQxWGhsb2ZbOGCiREKTOBOXtqrWzhq39VUsd3-cHvWokaTONiFU-1ZsTWk75djXmum1cgUcK9ZcMhCdNd1JPlV-oc8tncVDXcTZ5OApBIGfc7TUBR09WIVHFB9RZrI9iG5dZQPUEBuCidbSkhUQFyQaS_q8F3wzeq0SYIag7qZnbYpP_jUSLaiL-379DtIB_IEW9h9dLsnub0L515T0XgC4CJagapuAKWQcaovT6ztKmLsE7cpy5K7k7ZUsx5cTqQ9vhIHoC-xwqDwQ2t8yQYy22y20LqpRLEeOjoFAW3Bbcm4CeImwNsc1UAllNAEUu65N05NcvPDt-NYm9b-hpJhVXlB6pZDHT1pwbaIpPtNzefgjbUhqvENqLHTzP__qvGPqa58fwqujKiWZu-PMRv_eWlPuQXXmYLENh9i0cVLMgsmM-jAg=w1225-h643-s-no?authuser=0)

Mas como sempre, existem os contras. Para rodar containers, é necessário possuir um Hardware relativamente potente. Além da necessidade de dominar os orquestradores de containers, geralmente usando linha de comandos, e usar um pouco do tempo configurando as imagens.