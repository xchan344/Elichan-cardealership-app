<?php
require("config/db.php");

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }
    $query = "DELETE FROM transaction WHERE t_id = $id";
    mysqli_query($db, $query);
    header("Location: transaction.php");
    exit();
}
?>