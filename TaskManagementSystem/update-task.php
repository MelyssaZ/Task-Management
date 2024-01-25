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
                        <select name="list_id">
                            <?php
                            //Connect Database
                            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                            //select database
                            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                            //write the query to update
                            $sql2 = "SELECT * FROM tbl_list";
                            //execute query
                            $res2 = mysqli_query($conn2, $sql2);
                            //check execute
                            if ($res2 == true) {
                                //Display the List
                                //count row
                                $count_row2 = mysqli_num_rows($res2);
                                //check whether list is added or not
                                if($count_row2>0){
                                    //list are added
                                    while($row2=mysqli_fetch_assoc($res2)){
                                        //get individual value
                                        $list_id_db = $row2['list_id'];
                                        $list_name = $row2['list_name'];
                                        ?>
                                        <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //No list Added
                                    //display none as option
                                    ?>
                                    <option <?php if($list_id==0) {echo "selected='selected'";} ?> value="0">None</option>
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
                            <option <?php if($priority=="High"){echo "selected='selected'";} ?> value="High">High</option>
                            <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                            <option <?php if($priority=="Low"){echo "selected='selected'";} ?> value="Low">Low</option>
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
<?php
    //check if button is click
?>