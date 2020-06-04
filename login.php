<?php

    session_start();
    $pageTitle = 'Login';

    if (isset($_SESSION['user']))
    {
        header('Location: index.php');
    }

    include 'init.php';

    //Check If User Coming From HTTP Post Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login']))
        {
            # code...
            $user = $_POST['username'];
            $pass = $_POST['password'];


            $hashedPass = sha1($pass);

            //Check If The User Exist DataBase

            $stmt = $con -> prepare("SELECT 
                                                        Username, Password 
                                                  FROM   
                                                        users 
                                                  WHERE 
                                                        Username = ? 
                                                  AND   
                                                        Password = ? ");

            $stmt -> execute(array($user , $hashedPass));
            $count = $stmt -> rowCount();


            //If Count > 0 This Is Mean The Database Contain Recorde About This Username
            if ($count > 0)
            {
                $_SESSION['user'] = $user; // Register Session name
                header('Location: index.php'); //Redirect To DashBoard Page
                exit();
            }
        }
        else
        {
            $formErrors = array();
            
            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];
            $email     = $_POST['email'];
            
            
            //Valdition UserName
            if(isset($username))
            {
                $filterUser = filter_var($username, FILTER_SANITIZE_STRING);
                
                if(strlen($filterUser) < 4)
                {
                    $formErrors[] = 'UserName Must Be Larger Than 4 Chracters'; 
                }
            }
            
            
            //Valdition Password
            if(isset($password) && isset($password2))
            {
                if(empty($password))
                {
                    $formErrors [] = 'Sorry Password Cant Empty';
                }
                
                if(sha1($password2) !== sha1($password2))
                {
                    $formErrors [] = 'Sorry Password Is Not Match';
                }
            }
            
            //Valdition E-Mail
            if(isset($email))
            {
                $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                
                if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true)
                {
                    $formErrors[] = 'Email IS Not Valid'; 
                }
            }
            
            
            
            //Check If There,s No Error Proceed The User Add
            if (empty($formErrors))
            {

                //Check If User Exist In DataBase
                $check = checkItem("UserName", "users", $username);

                if ($check == 1)
                {
                    $formErrors[] = 'Sorry This User Is Exist';
                }
                else
                {
                   
                    //Insert User Info  In Database
                    $stmt = $con->prepare("INSERT INTO users(Username, Password, Email, RegStatus, Date) 
                                                       VALUES(:Zuser, :Zpass, :Zmail, 0, now())");
                    $stmt->execute(array(
                        'Zuser' => $username,
                        'Zpass' => sha1($password),
                        'Zmail' => $email
                    ));

                    // Echo Success Message
                    $succesMsg = 'Congrats You Are Now Register User';
                    
                }
            }
            
        }

    }


?>

<div class="container login-page">
    <h1 class="text-center">
        <span class="login selected" data-class="login">Login</span> |
        <span data-class="signup">SignUp</span>
    </h1>

    <!-- Start Form LogIn-->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="input-container">
            <input
                class="form-control"
                type="text"
                name="username"
                autocomplete="off"
                placeholder="Type Your Username"
                required />
        </div>

        <div class="input-container">
            <input
                class="form-control"
                type="password"
                name="password"
                autocomplete="new-password"
                placeholder="Type Your password"
                required />
        </div>
        <input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
    </form>
    <!-- End Form LogIn-->

    <!-- Start Form SignUp-->
    <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="input-container">
            <input
                pattern=".{4,}"
                title="Username Must Be 4 Char"
                class="form-control"
                type="text"
                name="username"
                autocomplete="off"
                placeholder="Type Your Username"
                required
                   />
        </div>

        <div class="input-container">
            <input
                minlength="4"
                class="form-control"
                type="password"
                name="password"
                autocomplete="new-password"
                placeholder="Type Your password"
                required
                 />
        </div>

        <div class="input-container">
            <input
                minlength="4"
                class="form-control"
                type="password"
                name="password2"
                autocomplete="new-password"
                placeholder="Reset your password"
                required 
                 />
        </div>

        <div class="input-container">
            <input
                class="form-control"
                type="email" 
                name="email"
                placeholder="Type Your E-mail"
                required
                 />
        </div>

        <input class="btn btn-success btn-block" name="signup" type="submit" value="SignUp">
    </form>
    <!-- End Form SignUp-->
    <div class="the-error text-center">
        <?php
            if(!empty($formErrors))
            {
                foreach($formErrors as $errors)
                {
                    echo $errors . '<br>';
                }
            }
          
          if(isset($succesMsg))
          {
              echo '<div class="msg success">' . $succesMsg . '</div>';
          }
        ?>
    </div>
</div>


<?php
    include $tpl . 'footer.php';
    ob_end_flush();
?>
