<?php
include 'config.php';
session_start();

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    
    // Delete task from database
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Task deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting task!";
    }
}

// Redirect back to main page
header("Location: index.php");
exit();
?>