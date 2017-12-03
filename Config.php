<?php
$user = 'hartmanc4';
$password = '4lUViavl';
$database = new PDO('mysql:host=localhost;dbname=db_fall17_hartmanc4', $user, $password);
$current_url = basename($_SERVER['REQUEST_URI']);
function my_autoloader($class) 
{
    include 'classes/class.' . $class . '.php';
}
spl_autoload_register('my_autoloader');
session_start();
?>