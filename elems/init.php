<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
session_start();

$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'admin'; //имя пользователя, по умолчанию это root
$password = '123321'; //пароль, по умолчанию пустой
$db_name = 'test'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);
//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

