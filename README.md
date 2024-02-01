# Bingo Game

## Client Setup

* Make sure that **node** and **npm** is installed in the machine.
* Open a terminal and type the commands below:

```bash
npm install
npm start
```

## Server Setup

* Make sure that **php** and **mysql** is installed in the machine.
* Migrate first the database and the tables with the command below:

**Note**: Make sure that you are in the migrations folder before entering the commands below.

```bash
php migrate database.php
php migrate 202401311112-create-games-table.php
php 202401311114-create-cards-table.php
php 202402011042-create-crossed_nums-table.php
```

* Return to the root folder and type the command below to start the server:

```bash
php -S localhost:8000 -t public
```