<?php
include("../config.php");
    if (isset($_POST["linkid"])) {
        $query = $con->prepare("UPDATE sites SET clicks = clicks + 1 WHERE id = :id");
        $query->bindParam(":id", $_POST["linkid"]);
        $query->execute();
    } 
    else {
        echo ("No link passed to page");
    }
?>