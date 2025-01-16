<?php
include_once __DIR__ . "/classes/Tour.php";
use classes\Tour;

$tour= new Tour();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    //echo "ID na vymazanie: $id<br>";
    $delete = $tour->deleteTour($id);
    if($delete) {
        header("Location: adminhome.php");
        exit;
    } else {
        echo '<p style="color: red">ERROR</p>';
    }
}