<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_text = trim($_POST['task_text']);
    
    if (!empty($task_text)) {
        // Insert new task into database
        $sql = "INSERT INTO tasks (task_text) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $task_text);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Task added successfully!";
        } else {
            $_SESSION['error'] = "Error adding task!";
        }
    } else {
        $_SESSION['error'] = "Task cannot be empty!";
    }
}

// Redirect back to main page
header("Location: index.php");
exit();
?>