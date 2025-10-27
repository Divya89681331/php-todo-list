<?php
include 'config.php';
session_start();

if (isset($_GET['id']) && isset($_GET['action'])) {
    $task_id = $_GET['id'];
    $action = $_GET['action'];
    
    if ($action == 'complete') {
        // Mark task as completed
        $sql = "UPDATE tasks SET is_completed = 1 WHERE id = ?";
        $_SESSION['message'] = "Task marked as completed!";
    } else if ($action == 'incomplete') {
        // Mark task as incomplete
        $sql = "UPDATE tasks SET is_completed = 0 WHERE id = ?";
        $_SESSION['message'] = "Task marked as incomplete!";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
}

// Redirect back to main page
header("Location: index.php");
exit();
?>