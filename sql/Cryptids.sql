CREATE TABLE users
( 
	userid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name CHAR(50) NOT NULL,
	password CHAR(100) NOT NULL
);

CREATE TABLE favorites
( 
	favoritesid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid CHAR(50) NOT NULL,
	cryptidid CHAR(50) NOT NULL
);

CREATE TABLE cryptids
( 
	name CHAR(50) NOT NULL PRIMARY KEY,
	description CHAR(250) NOT NULL
);

INSERT INTO users VALUES
  (NULL, "Chris", "abc123");

INSERT INTO cryptids VALUES
  ("Bigfoot", "He's big, He's got big feet, whats not to love or understand comon");  