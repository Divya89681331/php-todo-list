<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="todo-app">
            <h1>📝 My To-Do List</h1>
            
            <!-- Show messages -->
            <?php 
            if (isset($_SESSION['message'])) {
                echo '<div class="message">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            
            <!-- Add Task Form -->
            <form method="POST" action="add_task.php" class="add-task-form">
                <input type="text" name="task_text" placeholder="Enter a new task..." required>
                <button type="submit">Add Task</button>
            </form>

            <!-- Tasks List -->
            <div class="tasks-list">
                <h2>Your Tasks:</h2>
                
                <?php
                // Fetch all tasks from database
                $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $task_id = $row['id'];
                        $task_text = $row['task_text'];
                        $is_completed = $row['is_completed'];
                        
                        echo '<div class="task-item ' . ($is_completed ? 'completed' : '') . '">';
                        echo '<span class="task-text">' . htmlspecialchars($task_text) . '</span>';
                        echo '<div class="task-actions">';
                        
                        if ($is_completed) {
                            echo '<a href="complete_task.php?id=' . $task_id . '&action=incomplete" class="btn incomplete-btn">↶ Undo</a>';
                        } else {
                            echo '<a href="complete_task.php?id=' . $task_id . '&action=complete" class="btn complete-btn">✓ Complete</a>';
                        }
                        
                        echo '<a href="delete_task.php?id=' . $task_id . '" class="btn delete-btn">🗑 Delete</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-tasks">No tasks yet. Add your first task above!</p>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>