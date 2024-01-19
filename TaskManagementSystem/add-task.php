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
                        <?php
                        //connect Database
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                        //select database
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                        //SQL query to get the list from table
                        $sql = "SELECT * FROM tbl_list";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //check the query execute
                        if($res == true){
                            //create variable to count rows
                            $count_rows = mysqli_num_rows($res);
                            //if data in database then display all in dropdown else display None as option
                            if($count_rows > 0){
                                //display all lists on dropdown from database
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                                    ?>
                                    <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                    <?php
                                }
                            }
                            else{
                                //Display None as option
                                ?>
                                <option value="0">None</option>
                                <?php
                            }
                        }
                        ?>
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
                <td><input type="date" name="deadline" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    //check whether the Save button is clicked or not
    if(isset($_POST['submit'])){
        //Get all the values from Form
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        //connect to database
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select database
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

        $sql2 = "INSERT INTO tbl_task SET 
             task_name = '$task_name',
             task_description = '$task_description',
             list_id = $list_id,
             priority = '$priority',
             deadline = '$deadline'
             ";
        //Execute Query
        $res2 = mysqli_query($conn2, $sql2);
        //query executed successfully
        if($res2==true){
            $_SESSION['add'] = "Task added successfully";
            //Redirect to home page
            header('location:'.SITEURL);
        }
        else{
            $_SESSION['add_fail'] = "Failed to add task";
            //Redirect to add task page
            header('location:'.SITEURL.'add-task.php');
        }
    }
?>

