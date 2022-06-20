<?php
require '../db/db.php';
$db = new database();
$db->deleteReservering($_GET['id']);
?>