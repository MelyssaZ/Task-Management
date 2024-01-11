<?php
include ('config/constants.php');
?>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL; ?>">Home</a>
    <h3>Add Task Page</h3>

    <form method="post" action="">
        <table>
            <tr>
                <td>Task Name: </td>
                <td><input type="text" name="task_name" placeholder="Type Task Name" required="required" /></td>
            </tr>
            <tr>
                <td>Task Description: </td>
                <td><textarea name="task_description" placeholder="Type Task Description Here"></textarea></td>
            </tr>
            <tr>
                <td>Select List</td>
                <td>
                    <select name="list_id">
                        <option value="1">To Do</option>
                        <option value="2">Doing</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

