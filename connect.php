<?php
	$conn = new mysqli('192.168.20.78', 'biblioteca', 'jQNomg1A', 'db_ls') or die(mysqli_error());
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
