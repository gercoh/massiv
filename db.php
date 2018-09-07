<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.09.2018
 * Time: 18:59
 */
$dbhost ='localhost';
$dbuser='root';
$dbpass='';
$dbname='masive';
$db = mysqli_connect($dbhost,$dbuser,$dbpass) or die("трабл какой-то с подключением к базе данных ищи там");
mysqli_select_db($db,$dbname) or die("ошибочка пацани сварачиваемся");



