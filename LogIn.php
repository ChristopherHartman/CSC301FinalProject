<?php
	include('config.php');
	include('functions.php');
	$loginFailed = null;
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['userID'])) 
	{
		$userName = $_POST['userkey'];
		$password = $_POST['passkey'];
		$sql = file_get_contents('sql/getUser.sql');
		$params = array('name' => $userName);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);
		$user = $users[0];
		if($user['password'] == $password)
		{
			$_SESSION['userClass'] = new userClass($_SESSION['userID'], $userName);
			$_SESSION['userName'] = $userName;
			$_SESSION['userID'] = $user['userid'];
		}
	}
	elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userID']))
	{
		$_SESSION['userName'] = null;
		$_SESSION['userID'] = null;
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
		<td bgcolor="#BDFF5E"><center><a href="Favorites.php"><img border="0" alt="Forums" src="images/Favorites.png" style="PADDING: 10px"></center></td>
		<td bgcolor="#b0db3e"><center><a href="LogIn.php"><img border="0" alt="Contact us" src="images/LogIn.png"style="PADDING: 10px"></center></td>
	</table>
</header>
<body>
	<?php if(!isset($_SESSION['userID'])) : ?>
		<form action="" method="POST" style="background-color: #BDFF5E">
			<div class="form-element">
				<label>User:</label>
				<input type="text" name="userkey" class="textbox" />
				<label>Pass:</label>
				<input type="text" name="passkey" class="textbox" style="display: inline;" /><br>
				<label>Submit:</label>
				<input type="submit" class="button" value="LogIn" style="display: inline;" />&nbsp;
			</div>
		</form>
	<?php else : ?>
		<form action="" method="POST" style="background-color: #BDFF5E">
			<h1>You are logged in as: <?php echo $_SESSION['userClass']-> getUserName() ?></h1>
			<label>Logout:</label>
			<input type="submit" class="button" value="LogOut" style="display: inline;" />&nbsp;
		</form>
	<?php endif; ?>
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