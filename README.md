# PHP To-Do List Application

A simple and elegant To-Do List built with PHP and MySQL.

## Features
- ✅ Add new tasks
- ✅ Mark tasks as complete/incomplete
- ✅ Delete tasks
- ✅ Responsive design
- ✅ MySQL database storage

## Technologies Used
- PHP
- MySQL
- HTML5
- CSS3
- XAMPP

## Setup Instructions
1. Install XAMPP
2. Create database 'todo_system'
3. Run this SQL:
```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_text VARCHAR(255) NOT NULL,
    is_completed TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

