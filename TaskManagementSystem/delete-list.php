<?php
    //Include constants.php
    include('config/constants.php');

    //check whether list_id is assigned
    if(isset($_GET['list_id'])){
        //delete the list from database
        //get value from URL
        $list_id = $_GET['list_id'];
        //Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //write the query to delete list
        $sql = "DELETE FROM tbl_list WHERE list_id=$list_id";

        //execute query
        $res = mysqli_query($conn, $sql);
        //query executed successfully
        if($res==true){
            //Query executed successfully, list deleted
            $_SESSION['delete'] = "List Deleted Successfully";
            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
        else{
            //failed to Delete list
            $_SESSION['delete_fail'] = 'Failed to Delete list';
            header('location:'.SITEURL.'manage-list.php');
        }
    }
    else{
        //redirect to Manage List page
        header('location:'.SITEURL.'manage-list.php');
    }

?>