# Task Manager(Using CodeIgniter)
## Overview This assessment requires you to design and implement a secure, API-enabled web system. The goal is to demonstrate your understanding of authentication, API development, JSON handling, and basic security practices in modern web applications.

## First Secure the Open API Endpoint 
## https://dummyjson.com/todos 


### Next: Create a Database
Using XAMPP, create a database named `task_manager_db`.

---

## SQL Schema
Run the following code in your SQL terminal or phpMyAdmin:

```sql
USE task_manager_db;

CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Requirement: Enough space for Bcrypt hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tasks (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    user_id INT(11) UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

---

