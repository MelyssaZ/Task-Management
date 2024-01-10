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
        </table>
    </form>
</body>
</html>

