<?php
include('config/constants.php')
?>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL; ?>">Home</a>
    <a href=" <?php echo SITEURL; ?>manage-list.php">Manage List</a>
    <h3>Add List Page</h3>
    <p>
    <?php
    if(isset($_SESSION['add_fail']))
    {
        echo $_SESSION['add_fail'];
        unset($_SESSION['add_fail']);
    }
    ?>
    </p>
    <!-- Form to Add list -->
    <form method="post" action="">
        <table>
            <tr>
                <td>List Name: </td>
                <td><input type="text" name="list_name" placeholder="Type List Here" required="required"></td>
            </tr>
            <tr>
                <td>List Description: </td>
                <td><textarea name="list_description" placeholder="Type List Description Here"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php
// check whether the form is submitted
    if(isset($_POST['submit'])){
        //get value and save it
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        //connect database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select database
        $db_select = mysqli_select_db($conn, DB_NAME);
        //SQL query to insert data into database
        $sql = "INSERT INTO tbl_list SET 
                list_name = '$list_name', 
                list_description = '$list_description'";
        //execute query to Insert into database
        $res = mysqli_query($conn, $sql);

        if($res==true){
            //create a session variable to display message
            $_SESSION['add'] = "List Added Successfully";

            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');

        }
        else{
            $_SESSION['add_fail'] = "Fail to add list";
            header('location'.SITEURL.'add-list.php');
        }
    }
?>