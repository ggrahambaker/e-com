<?php
function connectToDataBase(){
		  // Create connection
		$con=mysqli_connect("localhost", "tail", "password",  "tail");

		// Check connection
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  			return false;
		} else {
			return true;
		}
}
?>