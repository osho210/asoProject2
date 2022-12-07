<?php
require_once "DBManager.php";
$dbm = new DBManager();
$ary_names   = $_POST['names'];

$resultArray = $dbm->menu_allergy_filter($ary_names);
