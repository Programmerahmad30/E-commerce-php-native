<?php


    session_start();
    $noNavbar = '';

    $pageTitle = 'Login';

    if (isset($_SESSION['Username']))
    {
        header('Location: dashboard.php'); //Redirect To DashBoard Page
    }

	include 'init.php';

	//Check If User Coming From HTTP Post Request
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		# code...
        $userName = $_POST['user'];
        $password = $_POST['Password'];
        $hashedPass = sha1($password);

        //Check If The User Exist DataBase

        $stmt = $con -> prepare("SELECT 
                                                UserID, Username, Password 
                                          FROM   
                                                users 
                                          WHERE 
                                                Username = ? 
                                          AND   
                                                Password = ? 
                                          AND   
                                                GroupID = 1
                                          LIMIT 1");

        $stmt -> execute(array($userName , $hashedPass));
        $row = $stmt -> fetch();
        $count = $stmt -> rowCount();


        //If Count > 0 This Is Mean The Database Contain Recorde About This Username
        if ($count > 0)
        {
            $_SESSION['Username'] = $userName; // Register Session name
            $_SESSION['ID'] = $row['UserID']; // Register Session Id
            header('Location: dashboard.php'); //Redirect To DashBoard Page
            exit();
        }
	}
?>

	<!-- Start Form -->
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

		<h4 class="text-center">Admin Login</h4>

		<input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off" />

		<input class="form-control" type="password" name="Password" placeholder="Password" autocomplete="new-password" />

		<input class="btn btn-primary btn-block" type="submit" value="Login" />


	</form>
	<!-- End Form -->

<?php include $tpl . 'footer.php'; ?>