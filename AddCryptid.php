<?php
	include('config.php');
	include('functions.php');
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
	}
	else
	{
		$action = 'add';
	}
	$name = get('name');
	$cryptid = null;
	if(!empty($name)) 
	{
		$sql = file_get_contents('sql/getCryptid.sql');
		$params = array(
			'name' => $name
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$cryptids = $statement->fetchAll(PDO::FETCH_ASSOC);
		$cryptid = $cryptids[0];
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$name = $_POST['cryptName'];
		$description = $_POST['cryptDesc'];
		if ($action == 'edit') 
		{
			$sql = file_get_contents('sql/updateCryptid.sql');
			$params = array(
				'name' => $name,
				'description' => $description,
			);
			$statement = $database->prepare($sql);
			$statement->execute($params);
		}
		if($action == 'add') 
		{
			$sql = file_get_contents('sql/addCryptid.sql');
			$params = array(
				'name' => $name,
				'description' => $description,
			);
			$statement = $database->prepare($sql);
			$statement->execute($params);
		}
	header('location: cryptids.php');
}
?>
<head><title>A Cryptid Database</title></head>
<header>
	<h1>A Cryptid Database</h1>
	<table style="border-radius: 25px">
		<tr>
			<td bgcolor="#BDFF5E"><center><a href="Homepage.php"><img border="0" alt="Home" src="images/Home.png" style="PADDING: 10px"></center></td>
			<td bgcolor="#BDFF5E"><center><a href="Cryptids.php"><img border="0" alt="Cryptids" src="images/Cryptids.png" style="PADDING: 10px"></center></td>
			<td bgcolor="#b0db3e"><center><a href="AddCryptid.php?action=add"><img border="0" alt="Contact us" src="images/AddCryptid.png"style="PADDING: 10px"></center></td>
			<td bgcolor="#BDFF5E"><center><a href="Favorites.php"><img border="0" alt="Forums" src="images/Favorites.png" style="PADDING: 10px"></center></td>
			<td bgcolor="#BDFF5E"><center><a href="LogIn.php"><img border="0" alt="Contact us" src="images/LogIn.png"style="PADDING: 10px"></center></td>
		</tr>
	</table>
</header>
<body>
	<form action="" method="POST" style="background-color: #BDFF5E">
		<div class="form-element">
			<h1><?php echo $action	?></h1>
			<label>Cryptid Name</label>
			<?php if($action == 'add') : ?>
				<input type="text" name="cryptName" class="textbox" value="<?php echo $cryptid['name'] ?>" />
			<?php else : ?>
				<input type="text" name="cryptName" class="textbox" value="<?php echo $cryptid['name'] ?>" /><br>
			<?php endif; ?>
		</div>
		<div class="form-element">
			<label>Description</label>
			<?php if($action == 'add') : ?>
				<textarea rows="4" cols="50" type="text" name="cryptDesc" class="textbox" /><?php echo $cryptid['description'] ?></textarea><br>
			<?php else : ?>
				<textarea rows="4" cols="50" type="text" name="cryptDesc" class="textbox" /><?php echo $cryptid['description'] ?></textarea><br>
			<?php endif; ?>
		</div>
		<label>Submit:</label>
		<div class="form-element">
			<input type="submit" class="button" style="display: inline;"/>&nbsp;
		</div>
	</form>
</body>
<footer>
	<center>
		<a href="Homepage.php">Home</a>
		<a href="Cryptids.php">Cryptids</a>
		<a href="AddCryptid.php?action=add">Add Cryptid</a>
		<a href="Favorites.php">Favorites</a>
		<a href="LogIn.php">LogIn</a>
	</center>
</footer>

<link rel="stylesheet" type="text/css" href="finlstyle.css">