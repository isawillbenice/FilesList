<?php
include_once('db/db.php');
include_once('db/db_connect.php');
include_once('get_data.php');

if (empty($_POST['updateData'])) {
	include_once('home_page.php');
} else {
	include_once('partial.php');
}
?>