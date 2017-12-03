SELECT favorites.favoritesid, favorites.userid, cryptids.name, cryptids.description
FROM favorites
INNER JOIN cryptids ON favorites.name=cryptids.name;