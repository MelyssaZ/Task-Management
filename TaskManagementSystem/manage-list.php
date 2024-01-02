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
    <h3>Manage List Page</h3>
    <p>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
    </p>
    <!-- Table to display lists -->
    <div class="all-lists">
        <a href="<?php echo SITEURL?>add-list.php">Add List</a>
        <table>
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <th>Action</th>
            </tr>
            <?php
                //connect Database
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                //Select Database
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                //Sql Query to display all data
                $sql = "SELECT * FROM tbl_list";
                $res = mysqli_query($conn, $sql);
                if($res==true){
                    //count rows of data
                    $count_rows = mysqli_num_rows($res);
                    $sn = 1;
                    if($count_rows > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $list_name; ?></td>
                                <td>
                                    <a href="#">Update</a>
                                    <a href="#">delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td>No List Added Yet.</td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>