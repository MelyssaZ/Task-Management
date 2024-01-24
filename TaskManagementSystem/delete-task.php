<?php
include ('config/constants.php');
if(isset($_GET['task_id'])){
    //delete the task from Database
    //get task ID
    $task_id = $_GET['task_id'];
    //connect Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    //select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    //SQL query to delete task from table
    $sql = "DELETE FROM tbl_task WHERE task_id=$task_id";
    //Execute Query
    $res = mysqli_query($conn, $sql);
    //check the query is executed
    if($res==true){
        //Query executed successfully and task deleted
        $_SESSION['delete'] = "Task deleted successfully";
        //Redirect to home page
        header('location:'.SITEURL);
    }
    else{
        //failed to delete task
        $_SESSION['delete_fail'] = "Failed to delete task";
        //Redirect to delete task page
        header('location:'.SITEURL.'delete-task.php');
    }
}
else{
    //Redirect to home
    header('location:'.SITEURL);
}
?>