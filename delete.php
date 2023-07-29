<?php
    require_once "db_connect.php";
    $id =$_GET["id"];

    $delete = "DELETE FROM `animal` WHERE id = $id";
    if(mysqli_query($connect, $delete)){
        header("Location: home.php");
    }else{
        echo "error";
    }
?>