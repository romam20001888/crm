<?
$db_host="localhost";
$db_login="mysql";
$db_password="mysql";
$db_database="srm";

$mysqli = new mysqli($db_host,$db_login,$db_password,$db_database);

//Выводим любую ошибку соединения
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>