<?php
require '../db/db.php';
$db = new database();
$db->deleteBestelling($_GET['id']);
?>