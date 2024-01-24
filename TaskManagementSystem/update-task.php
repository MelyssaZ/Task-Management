<?php
include ('config/constants.php');
//Check the task id URL
?>
<html>
    <head>
        <title>Task Manager</title>
    </head>
    <body>
        <h1>Task Manager</h1>
        <p>
            <a href="<?php echo SITEURL ?>">Home</a>
        </p>
        <h3>Update Task Page</h3>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>Task Name: </td>
                    <td><input type="text" name="task_name" value="" required="required" /></td>
                </tr>
                <tr>
                    <td>Task Description: </td>
                    <td>
                        <textarea name="task_description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Select List: </td>
                    <td>
                        <select>
                            <option value="1">Doing</option>
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
                <tr>
                    <td>Deadline: </td>
                    <td><input type="date" name="deadline" value=""/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
