<?php

try {
$db = new PDO ( 'sqlite:'.dirname(__FILE__).'/../SQLite/Mutasyon.db' );
} catch ( PDOException $e ) {
	print $e->getMessage ();
}