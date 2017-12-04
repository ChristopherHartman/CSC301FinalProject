<?php
	include('config.php');
	include('functions.php');
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
	}
	else
	{
		$action = '';
	}
	if($action == 'add' && isset($_SESSION['userID'])) 
	{
		$userSessionId = $_SESSION['userID'];
		$cryptidName = $_GET['name'];
		$sql = file_get_contents('sql/addFavorites.sql');
		$params = array(
			'userid' => $userSessionId,
			'name' => $cryptidName
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	elseif($action == 'delete' && isset($_SESSION['userID']))
	{
		$favid = $_GET['favid'];
		deleteFavorite($favid, $database);
	}
	if(isset($_SESSION['userID']))
	{
		$sql = file_get_contents('sql/joinFavoritesCryptidsUsers.sql');
		$statement = $database->prepare($sql);
		$statement->execute();
		$joinedfavorites = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
?>
<head><title>A Cryptid Database</title></head>
<header>
	<h1>A Cryptid Database</h1>
	<table style="border-radius: 25px">
	<tr>
		<td bgcolor="#BDFF5E"><center><a href="Homepage.php"><img border="0" alt="Home" src="images/Home.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="Cryptids.php"><img border="0" alt="Cryptids" src="images/Cryptids.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="AddCryptid.php?action=add"><img border="0" alt="Contact us" src="images/AddCryptid.png"style="PADDING: 10px"></center></td>
		<td bgcolor="#b0db3e"><center><a href="Favorites.php"><img border="0" alt="Forums" src="images/Favorites.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#BDFF5E"><center><a href="LogIn.php"><img border="0" alt="Contact us" src="images/LogIn.png"style="PADDING: 10px"></center></td>
	</tr>
	</table>
</header>
<body>
	<div style="background-color: #BDFF5E">
		<h1>Your Favorites:</h1>
		<?php if(isset($_SESSION['userID'])) : ?>
			<?php foreach($joinedfavorites as $favorite) : ?>
				<?php if($_SESSION['userID'] == $favorite['userid'] ) : ?>
					<h2><?php echo $favorite['name']; ?></h2>
					<?php echo $favorite['description']; ?><br>
					<a href="favorites.php?action=delete&favid=<?php echo $favorite['favoritesid'] ?>">Delete This Favorite</a><br />
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else : ?>
			<div style="background-color: #BDFF5E">
				<h1>Please Log in to add or see favorites</h1>
			</div>
		<?php endif; ?>
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