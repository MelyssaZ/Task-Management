<?php
include('config/constants.php');

//check whether list_id is assigned
if(isset($_GET['list_id'])) {
//get value from URL
    $list_id = $_GET['list_id'];
//Connect Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

//select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

//write the query to update list
    $sql = "SELECT * FROM tbl_list WHERE list_id=$list_id";

//execute query
    $res = mysqli_query($conn, $sql);
//query executed successfully
    if ($res == true) {
        $row = mysqli_fetch_assoc($res);
        //Create individual variable to save the data
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
    } else {
        //Go back to Manage List page
        header('location:' . SITEURL . 'manage-list.php');
    }
}
?>

<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <div class="menu">
        <a href="<?php echo SITEURL; ?>">Home</a>
        <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>
    </div>
    <h3>Update List</h3>
    <p>
        <?php
        //check if the session is set
        if(isset($_SESSION['update_fail']))
        {
            echo $_SESSION['update_fail'];
            unset($_SESSION['update_fail']);
        }
        ?>
    </p>
    <form method="post" action="">
        <table>
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
            </tr>
            <tr>
                <td>List Description: </td>
                <td><textarea name="list_description">
                        <?php echo $list_description; ?>
                    </textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    //check the update button is clicked
    if(isset($_POST['submit'])){
        //get updated values from the form
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        //connect to database
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select database
        $db_select = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
        //query to update list
        $sql2 = "UPDATE tbl_list SET
            list_name = '$list_name',
            list_description = '$list_description'
            WHERE list_id=$list_id";
        //execute query

        $res2 = mysqli_query($conn2, $sql2);
        //query executed successfully
        if ($res2 == true) {
            //Query executed successfully, list Update
            $_SESSION['update'] = "List Update Successfully";
            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
        else{
            //failed to update list
            $_SESSION['update_fail'] = 'Failed to update list';
            header('location:'.SITEURL.'update-list.php?list_id=$list_id');
        }
    }
?>
