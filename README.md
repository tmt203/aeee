# AEEE

A static website that allow users to view articles.

## How to run this project on local ?
**1. System requirements:**  
- PHP ([download](https://www.php.net/downloads.php)).
- MySQL ([download]([https://dev.mysql.com/downloads/mysql/])).

**2. Create a database called *aeee***  
- You can use any MySQL Server visual tool to do this step (e.g: MySQL Workbench).

**3. Configure .env file:**  
- Create a `.env` file in the root folder.
- Copy and paste the content from `.env.example` file to `.env` file.
- Edit the `DB_ROOT` and `DB_PASSWORD` to match your MySQL config.

**4. Run project:**  
- Open the command promt in the public folder and run: `php -S localhost:8080`