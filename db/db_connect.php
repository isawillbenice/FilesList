<?php
$link = mysqli_connect($host, $user, $password, $db);

if (mysqli_connect_errno()) {
	die("Ошибка соединения БД: " . mysqli_connect_error());
}
?>