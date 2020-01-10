# Desafio BDR 

## Desafio

Crie, conforme seus conhecimentos, um pequeno sistema de cadastro de clientes, com
uma tela de visualização e exclusão de registros e formulário(s) para inserção e edição
dos cadastros já inseridos. Essas informações devem ser persistidos em um banco de
dados. O formulário deverá solicitar, pelo menos, o nome, e-mail, telefone e uma foto,
que deverá ser enviada para o servidor HTTP (LAMP, XAMP, MAMP...) instalado na sua
máquina, essa imagem deve ser apresentada ao lado do nome do cliente na lista de
visualização, em miniatura.
- Utilize a linguagem de programação PHP.
- Utilize o padrão MVC.
- Fique a vontade para utilizar qualquer framework que você possua conhecimento.
Será um diferencial se você utilizar o Zend Framework.

## Arquitetura do projeto

* Linguagem utilizada - PHP 7.x
* Bibliotecas - Doctrine, jquery, jschart, bootstrap.
* Framework - Zend 3
* Estrutura: MVC, ORM
* Banco de Dados: Mysql

#### Ambiente de desenvolvimento

A maneira mais fácil de executar a aplicação é instalar o ambiente de desenvolvimento
XAMPP. O XAMPP é completamente gratuito, fácil de instalar a distribuição Apache, contendo MySQL, PHP e Perl.
O pacote de código aberto do XAMPP foi criado para ser extremamente fácil de instalar e de usar.

Link para versão com php 7:

```bash
https://www.apachefriends.org/download.html
```
Após a instalação e início do controlador XAMPP geralmente será iniciado o cli-server na porta 80. Você poderá 
visitar a tela de boas vindas do XAMPP em  http://localhost

**Nota:** O xampp é utilizado *apenas para desenvolvimento e teste da aplicação*.

#### Adicionando o SQL ao banco de dados

Após o início do controlador XAMPP você terá acesso a aplicação **phpmyadmin** que é uma aplicação web para gerenciamento
do banco de dados mysql. Com ela poderemos subir o sql com a estrutura da base de dados que é utilizada na aplicação.

**Modelo relacional:** encontra-se dentro do projeto na para SQL

**Nota:** o acesso provavelmente estará disponível em  http://localhost/phpmyadmin.

#### Adicionando a aplicação no XAMPP
Basta copiar toda a pasta do projeto para o diretório de instalação do xampp seguindo o caminho:

```bash
    /DIR_INSTALACAO/xampp/htdocs
```

Após copiado execultar o seguinte comando no CMD:

```bash
    composer install
```

**Nota:** é necessário a instalação do composer na sua máquina 