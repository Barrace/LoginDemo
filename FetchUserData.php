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
    
    
    /*-----AJ's code starts here. PDO Objects ftw.-----
    
    function passwordMatch ($lastName, $pass)
    {
	//enter your info here
        $db_hostname = 'localhost';
        $db_database = 'XXXXXXXx';
        $db_username = 'XXXXXXXX';
        $db_password = 'XXXXXXXx';
	
	//connect to Database
        $db = new PDO("mysql:dbname=" . $db_database . ";host=localhost", $db_username, $db_password)
        or die("could not connect to DB");

	//dont know if you need this but just for safety
        if($lastName == "" || $pass == "")
            return false;

	//SQL
        $query = $db->prepare(' SELECT *
                                FROM `user`
                                WHERE `username` = ?
                                AND `password` = ? ');

	//fill in question marks
        $query->execute(array($lastName, str_rot13($pass)));
        
        //rows is always an array of results. If only one result, $rows[0].
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

	//if it returned a result, it was a match
        if(sizeof($rows) > 0)
            return true;
        else
            return false;

    }
    
    */
    
?>
