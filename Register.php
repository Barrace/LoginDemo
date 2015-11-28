<?php 

    //Connect to Database
    $con=mysqli_connect("localhost", "root", "password", "user");
	
	mysqli_query($con, "SET CHARACTER SET utf8");
	
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
	} else {		}
	
	if(isset($_POST['age'])) {
		$age = $_POST['age'];
	} else {		}
	if(isset($_POST['password'])) {
		$password = $_POST['password'];
	} else {		}
	
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
	} else {		}

    //Store Values into Database
    $stmt = mysqli_prepare($con, "INSERT INTO user (name, age, username, password) VALUES (?, ?, ?, ?)");

    //Protects against SQL injection attacks
    mysqli_stmt_bind_param($stmt, "siss", $name, $age, $username, $password);

    //Execute
    mysqli_stmt_execute($stmt);

    //Close Statment
    mysqli_stmt_close($stmt);

    //Close Connection
    mysqli_close($con)
        
?>