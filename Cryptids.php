<?php
	include('config.php');
	include('functions.php');
	$name = get('name');
	if (isset($_GET['action'])) 
	{
		$action = $_GET['action'];
	}
	else
	{
		$action = '';
	}
	if ($action == 'delete') 
	{
		$sql = file_get_contents('sql/deleteCryptid.sql');
		$params = array('name' => $name);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	if(isset($_GET['searchkey'])) 
	{
		$term = $_GET['searchkey'];
	}
	else 
	{
		$term = "";
	}
	$cryptids = searchCryptids($term, $database);
?>
<head><title>A Cryptid Database</title></head>
<header>
	<h1>A Cryptid Database</h1>
	<table style="border-radius: 25px">
	<tr>
		<td bgcolor="#BDFF5E"><center><a href="Homepage.php"><img border="0" alt="Home" src="images/Home.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#b0db3e"><center><a href="Cryptids.php"><img border="0" alt="Cryptids" src="images/Cryptids.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="AddCryptid.php?action=add"><img border="0" alt="Contact us" src="images/AddCryptid.png"style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="Favorites.php"><img border="0" alt="Forums" src="images/Favorites.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="LogIn.php"><img border="0" alt="Contact us" src="images/LogIn.png"style="PADDING: 10px"></center></td>
	</tr>
	</table>
</header>
<body>
	<div class="form-element" style="background-color: #BDFF5E">
		<form method="GET">
			<label>Search:</label>
			<input type="text" name="searchkey" placeholder="Search..." />
			<input type="submit" value="Search" style="display: inline;"/>&nbsp;
		</form>
		<?php foreach($cryptids as $cryptid) : ?>
			<h2><?php echo $cryptid['name']; ?></h2>
			<?php echo $cryptid['description']; ?> <br />
			<a href="AddCryptid.php?action=edit&name=<?php echo $cryptid['name'] ?>">Edit Cryptid</a><br />
			<a href="favorites.php?action=add&name=<?php echo $cryptid['name'] ?>">Add Cryptid to Favorites</a><br />
			<a href="cryptids.php?action=delete&name=<?php echo $cryptid['name'] ?>">Delete This Cryptid</a><br />
		<?php endforeach; ?>
	</div>
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