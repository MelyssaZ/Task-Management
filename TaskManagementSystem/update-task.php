<?php
include ('config/constants.php');
//Check the task id URL
if(isset($_GET['task_id'])) {
    //get value from Database
    $task_id = $_GET['task_id'];
    //Connect Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    //select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    //write the query to update
    $sql = "SELECT * FROM tbl_task WHERE task_id=$task_id";
    //execute query
    $res = mysqli_query($conn, $sql);
    //query executed successfully
    if ($res == true) {
        $row = mysqli_fetch_assoc($res);
        //Create individual variable to save the data
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    } else {
        //Go back to Home page
        header('location:'.SITEURL);
    }
}
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
                    <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required" /></td>
                </tr>
                <tr>
                    <td>Task Description: </td>
                    <td>
                        <textarea name="task_description">
                            <?php echo $task_description; ?>
                        </textarea>
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
                    <td><input type="date" name="deadline" value="<?php echo $deadline; ?>"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
