<?php
require_once 'config/dbconfig.php';
session_start();
session_destroy();
header('location:index.php');

?>
