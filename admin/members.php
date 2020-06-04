<?php

    /*
     * =================================
     * Manage Members Page
     * You Can Add | Edit | Delete Members From Here
     * =================================
     * */


    session_start();
    $pageTitle = 'Members';

    if (isset($_SESSION['Username']))
    {

        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        /*==========Start Manage Page============*/
        /*==========Start Manage Page============*/
        /*==========Start Manage Page============*/
        if ($do == 'Manage'){//Manage Members Page

            $query = '';

            if (isset($_GET['page']) && $_GET['page'] == 'Pending')
            {
                $query = 'AND RegStatus = 0';
            }

            //Select All Users Except Admin
            $stmt = $con -> prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC ");
            //Execute The Statement
            $stmt -> execute();
            // Assign To Varible
            $rows = $stmt ->fetchAll();

            if (!empty($rows)){

         ?>
            <h1 class="text-center">Manage Members</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">

                            <tr>
                                <td>#ID</td>
                                <td>Username</td>
                                <td>E-Mail</td>
                                <td>Full Name</td>
                                <td>Registered Date</td>
                                <td>Control</td>
                            </tr>

                            <?php

                                foreach ($rows as $row)
                                {
                                    echo "<tr>";
                                        echo "<td>" . $row['UserID'] . "</td>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>" . $row['FullName'] . "</td>";
                                        echo "<td>" . $row['Date']. "</td>";
                                        echo "<td>
                                                <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                                <a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-closed-captioning'></i> Delete</a>";

                                        if ($row['RegStatus'] == 0)
                                        {
                                            echo "<a 
                                                    href='members.php?do=Activate&userid=" . $row['UserID'] . "' 
                                                    class='btn btn-info activate'>
                                                    <i class='fa fa-check'></i> Activate</a>";
                                        }

                                        echo "</td>";
                                    echo "</tr>";
                                }
                            ?>

                            <tr>

                        </table>
                    </div>
                    <a href="members.php?do=Add" class="btn btn-primary">
                        <i class="fa fa-plus"></i> New Members
                    </a>
                </div>

                <?php }
                else
                {
                    echo '<div class="container">';
                        echo '<div class="nice-message">Thers\`s No Members To Show</div>';
                            echo '<a href="members.php?do=Add" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> New Members
                                  </a>';
                    echo '</div>';
                }
                ?>
        <?php
        }


        /*============Add Members Page===============*/
        /*============Add Members Page===============*/
        /*============Add Members Page===============*/
        elseif ($do  == 'Add') {//Add Members Page?>

                <h1 class="text-center">Add New Member</h1>
                    <div class="container">
                        <form class="form-horizontal" action="?do=Insert" method="POST">

                            <!-- Start Username field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" name="username" class="form-control"  autocomplete="off" required="required" placeholder="UserName To Login"/>
                                </div>
                            </div>
                            <!-- End Username field-->

                            <!-- Start Password field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="password" name="password" class="password form-control" autocomplete="new-password" required="required" placeholder="Password Must To Be Hard"/>
                                    <i class="show-pass fa fa-eye fa-2x"></i>
                                </div>
                            </div>
                            <!-- End Password field-->

                            <!-- Start Email field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email Must To Be Valid"/>
                                </div>
                            </div>
                            <!-- End Email field-->

                            <!-- Start FullName field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Full Name</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" name="full" class="form-control" required="required" placeholder="Full Name Must Be"/>
                                </div>
                            </div>
                            <!-- End FullName field-->

                            <!-- Start Submit field-->
                            <div class="form-group form-group-lg">
                                <div class="col-sm-offset-2 col-sm-10 ">
                                    <input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
                                </div>
                            </div>
                            <!-- End Submit field-->
                        </form>
                    </div>
        <?php }

        /*=======INSERT PAGE===========*/
        /*=======INSERT PAGE===========*/
        /*=======INSERT PAGE===========*/
        elseif ($do == 'Insert')
        {

            //Insert Members Page


            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                echo "<h1 class='text-center'>Insert Member Page</h1>";
                echo "<div class='container'>";

                // Get Variables From The Form
                $user   = $_POST['username'];
                $pass   = $_POST['password'];
                $email  = $_POST['email'];
                $name   = $_POST['full'];

                $hashPass = sha1($_POST['password']);

                //Validate the Form
                $formErrors = array();

                if (strlen($user) < 4)
                {
                    $formErrors[] = 'UserName Cant Be Less Than <strong>4 Characters</strong>';
                }

                if (strlen($user) > 20)
                {
                    $formErrors[] = 'UserName Cant Be More Than <strong>20 Characters</strong>';
                }

                if (empty($user))
                {
                    $formErrors[] = 'UserName Cant Be <strong>Empty</strong>';
                }

                if (empty($pass))
                {
                    $formErrors[] = 'Password Cant Be <strong>Empty</strong>';
                }

                if (empty($name))
                {
                    $formErrors[] = 'FullName Cant Be <strong>Empty</strong>';
                }

                if (empty($email))
                {
                    $formErrors[] = ' Email Cant Be <strong>Empty</strong>';
                }


                //Loop Into Error Array Echo It
                foreach ($formErrors as $error)
                {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }

                //Check If There,s No Error Proceed The Update Operation
                if (empty($formErrors))
                {

                    //Check If User Exist In DataBase
                    $check = checkItem("UserName", "users", $user);

                    if ($check == 1)
                    {
                        $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

                        redirectHome($theMsg, 'Back');
                    }
                    else
                    {

                        //Insert User Info  In Database
                        $stmt = $con->prepare("INSERT INTO 
                                                              users
                                                              (Username, Password, Email, FullName, RegStatus, Date) 
                                                              VALUES (:Zuser, :Zpass, :Zmail, :Zname, 1, now())");
                        $stmt->execute(array(
                            'Zuser' => $user,
                            'Zpass' => $hashPass,
                            'Zmail' => $email,
                            'Zname' => $name
                        ));

                        // Echo Success Message
                        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Inserted</div>';
                        redirectHome($theMsg, 'Back');
                    }
                }

            }
            else
            {

                echo '<div class="container">';
                $theMsg =  '<div class="alert alert-danger">Sorry You Cant Browse this Page Directly</div>';

                redirectHome($theMsg);

                echo '</div>';
            }

            echo "</div>";

        }

        /*===============EDIT PAGE================*/
        /*===============EDIT PAGE================*/
        /*===============EDIT PAGE================*/
        elseif ($do == 'Edit')
        { //Edit Page

            //Check iF GET Request Userid Numeric & GET The Integer Value Of It
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            //Select All Data Depend On This ID
            $stmt = $con -> prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt -> execute(array($userid));
            $row = $stmt -> fetch();
            $count = $stmt -> rowCount();

            // IF Found ID Show The Form
            if ($count > 0 ) { ?>

                <h1 class="text-center">Edit Member</h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="userid" value="<?php echo $userid ?>" />

                        <!-- Start Username field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required"/>
                            </div>
                        </div>
                        <!-- End Username field-->

                        <!-- Start Password field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>"/>
                                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Don,t want To Change"/>
                            </div>
                        </div>
                        <!-- End Password field-->

                        <!-- Start Email field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required"/>
                            </div>
                        </div>
                        <!-- End Email field-->

                        <!-- Start FullName field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Full Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" required="required"/>
                            </div>
                        </div>
                        <!-- End FullName field-->

                        <!-- Start Submit field-->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10 ">
                                <input type="submit" value="Save" class="btn btn-primary btn-lg"/>
                            </div>
                        </div>
                        <!-- End Submit field-->
                    </form>
                </div>
        <?php
            }

            // Else Not Found ID Dont Show The Form
            else
            {
                echo "<div class='container'>";
                $theMsg = '<div class="alert alert-danger">There Is No Number ID</div>';
                redirectHome($theMsg);
                echo "</div>";
            }
        }

        /*=======UPDATE PAGE===========*/
        /*=======UPDATE PAGE===========*/
        /*=======UPDATE PAGE===========*/
        elseif ($do == 'Update')
        {
            //Update Page
            echo "<h1 class='text-center'>Update Page Member</h1>";
            echo "<div class='container'>";

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Get Variables From The Form

                $id     = $_POST['userid'];
                $user   = $_POST['username'];
                $email  = $_POST['email'];
                $name   = $_POST['full'];

                /*
                 * Password Trick
                 * Condition ? True : False;
                */
                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : $pass = $_POST['oldpassword'];

                //Validate the Form
                $formErrors = array();

                if (strlen($user) < 4)
                {
                    $formErrors[] = 'UserName Cant Be Less Than <strong>4 Characters</strong>';
                }

                if (strlen($user) > 20)
                {
                    $formErrors[] = 'UserName Cant Be More Than <strong>20 Characters</strong>';
                }

                if (empty($user))
                {
                    $formErrors[] = 'UserName Cant Be <strong>Empty</strong>';
                }

                if (empty($name))
                {
                    $formErrors[] = 'FullName Cant Be <strong>Empty</strong>';
                }

                if (empty($email))
                {
                    $formErrors[] = ' Email Cant Be <strong>Empty</strong>';
                }


                //Loop Into Error Array Echo It
                foreach ($formErrors as $error)
                {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }

                //Check If There,s No Error Proceed The Update Operation
                if (empty($formErrors))
                {

                    $stmt2 = $con -> prepare("SELECT 
                                                      * 
                                                      FROM 
                                                        users 
                                                      WHERE 
                                                        Username = ? 
                                                      AND 
                                                        UserID != ?");
                    $stmt2 -> execute(array($user, $id));

                    $count = $stmt2 -> rowCount();

                    if ($count == 1)
                    {
                        echo '<div class="alert alert-danger">Sorry This User Exist</div>';

                        redirectHome($theMsg, 'Back');
                    }
                    else
                    {
                        //Update The Database Wthe Info
                        $stmt = $con -> prepare("UPDATE 
                                                        users 
                                                      SET 
                                                        Username = ?, 
                                                        Email = ?, 
                                                        FullName = ?, 
                                                        Password = ? 
                                                      WHERE 
                                                        UserID = ?");
                        $stmt -> execute(array($user, $email, $name, $pass, $id));
                        // Echo Success Message
                        $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Update</div>';

                        redirectHome($theMsg, 'Back');
                    }

                }

            }
            else
            {
                $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

                redirectHome($theMsg);
            }

            echo "</div>";
        }

        /*============Delete Members Page========*/
        /*============Delete Members Page========*/
        /*============Delete Members Page========*/
        elseif ($do == 'Delete')
        {//Delete Members Page

            echo "<h1 class='text-center'>Delete Page</h1>";
            echo "<div class='container'>";

                //Check iF GET Request Userid Numeric & GET The Integer Value Of It
                $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


                $check = checkItem('userid', 'users', $userid);

                // IF Found ID Show The Form

                if ($check > 0 )
                {

                    /*
                     * 1- كود الاستعلام
                     * 2- كود الربط بقوله اربط zuder بال $userid
                     * 3- كود التنفيذ الاستعلام
                     * */

                    //1
                    $stmt = $con -> prepare("DELETE FROM users WHERE UserID = :zuser");
                    //2
                    $stmt -> bindParam(":zuser", $userid);
                    //3
                    $stmt -> execute();
                    // Echo Success Message
                    $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Deleted</div>';

                    redirectHome($theMsg, 'back');
                }
                else
                {
                    $theMsg = '<div class="alert alert-danger">This Is ID Is Not Exist</div>';

                    redirectHome($theMsg);
                }

            echo '</div>';

        }

        /*========== Activate Members Page ==========*/
        /*========== Activate Members Page ==========*/
        /*========== Activate Members Page ==========*/
        elseif ($do == 'Activate')
        {
            echo "<h1 class='text-center'>Activate Page</h1>";
            echo "<div class='container'>";

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            $check = checkItem('userid', 'users', $userid);

            if ($check > 0 )
            {

                $stmt = $con -> prepare("UPDATE users SET RegStatus = 1 WHERE  UserID = ?");
                $stmt -> execute(array($userid));
                $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Activated</div>';

                redirectHome($theMsg);
            }
            else
            {
                $theMsg = '<div class="alert alert-danger">This Is ID Is Not Exist</div>';

                redirectHome($theMsg);
            }

            echo '</div>';
        }

            include $tpl . 'footer.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
