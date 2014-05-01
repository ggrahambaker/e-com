<?php 
function connect() {

$options = array(
     PDO::ATTR_EMULATE_PREPARES => false,
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
   );

$dsn = 'mysql:host=localhost;' .
       'dbname=tail;' .
       'charset=utf8';

try {
    $db = new PDO($dsn, 'tail', 'grahamjasperzach', $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $db;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
	return false;
}

}
//Should return 1
?>
