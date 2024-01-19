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
    <p>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset ($_SESSION['add']);
        }
        ?>
    </p>
    <div class="all-task">
        <a href="<?php SITEURL ?>add-task.php">Add Task</a>
        <table>
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
            <?php
                //connect database
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                //select database
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                //SQL query to get the list from table
                $sql = "SELECT * FROM tbl_task";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                if($res == true){
                    //create variable to count rows
                    $count_rows = mysqli_num_rows($res);
                    //create serial number variable
                    $sn=1;
                    //if data in database then display all in dropdown else display None as option
                    if($count_rows > 0){
                        //data in DataBase
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?> </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline?></td>
                                <td>
                                    <a href="#">Update</a>
                                    <a href="#">delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="5">No Task Added Yet</td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>