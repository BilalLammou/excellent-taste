<?php
require '../db/db.php';
$db = new database();
$db->deleteKlant($_GET['id']);
?>