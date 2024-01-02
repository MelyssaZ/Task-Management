<?php
include ('config/constants.php');
?>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <!-- Menu -->
    <div class="Menu">
    <a href="<?php echo SITEURL; ?>">Home</a>

    <a href="#">To Do</a>
    <a href="#">Doing</a>
    <a href="#">Done</a>

    <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>
    </div>
    <!-- Task -->
    <div class="all-task">
        <a href="#">Add Task</a>
        <table>
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1. </td>
                <td>Design a website</td>
                <td>Medium</td>
                <td>02/19/2024</td>
                <td>
                    <a href="#">Update</a>
                    <a href="#">delete</a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>