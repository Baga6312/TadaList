# TadaList App

A simple todo list application with a ReactJS frontend, Express backend, MySQL database, and PHP for database interaction.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)

## Features

- Add, edit, and delete tasks
- User-friendly interface

## Prerequisites

Before you begin, ensure you have the following installed:

- [Node.js](https://nodejs.org/)
- [MySQL database]
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/todo-list.git
cd todo-list
```

2. Install dependecies

<h4>Install dependencies for root first </h4>

```
npm install
```

<h4>Install dependecies for every folders with </h4>

```
npm run set
```

## Configuration

make a `.env` file in the database folder with the necessary variables

```
DB_HOST = "localhost"
DB_USERNAME = "username_for_database"
DB_PASSWORD = "password_for_database"
DB_DATABASE = "database_name"
```

## Usage

Start the everything with

```
npm run dev
```
