<?php
function searchCryptids($term, $database) 
{
	$term = $term . '%';
	$sql = file_get_contents('sql/searchCryptids.sql');
	$params = array('name' => $term);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$cryptids = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $cryptids;
}
function deleteFavorite($term, $database) 
{
	$sql = file_get_contents('sql/deleteFavorite.sql');
	$params = array('favoritesid' => $term);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$favorites = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $favorites;
}
function get($key) 
{
	if(isset($_GET[$key])) 
	{
		return $_GET[$key];
	}
	else 
	{
		return '';
	}
}
?>