<?php 
    include("services.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $result = deleteProduct($id);
        header("Location: index.php");
    }
?>

