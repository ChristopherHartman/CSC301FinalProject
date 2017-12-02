<?php
$user = 'hartmanc4';
$password = '4lUViavl';
$database = new PDO('mysql:host=localhost;dbname=db_fall17_hartmanc4', $user, $password);
session_start();
$current_url = basename($_SERVER['REQUEST_URI']);
function my_autoloader($class) 
{
    include 'classes/class.' . $class . '.php';
}
spl_autoload_register('my_autoloader');
if(!isset($customerID) && !isset($_GET['customerID']))
{
	header('login.php');
}
else if(isset($customerID))
{
	$sql = file_get_contents('sql/getCustomer.sql');
	$statement = $database->prepare($sql);
	$statement->execute($customerID);
	$customer = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>