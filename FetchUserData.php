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
	
	

    //Grabs values from Database
    $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE username = ? AND password = ?");

    //Protects against SQL injection attacks
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    //Execute
    mysqli_stmt_execute($stmt); 
	

    //Bind results 
    mysqli_stmt_bind_result($stmt, $userID, $name, $age, $username, $password);
    
    //Holds data of user returned
    $user = array();

    //Stores returned data in the array
    while(mysqli_stmt_fetch($stmt)){
        $user[name] = $name;
        $user[age] = $age;
        $user[username] = $username;
        $user[password] = $password;
    }
	


    //Turns array into a json
    echo json_encode($user);

	
	
    //Close Statment
    mysqli_stmt_close($stmt);

    //Close Connection
    mysqli_close($con);
?>