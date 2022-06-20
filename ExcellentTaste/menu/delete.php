<?php
require '../db/db.php';
$db = new database();
$db->deleteMenu($_GET['id']);
?>