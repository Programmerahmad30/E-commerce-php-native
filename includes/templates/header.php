

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php getTitle() ?></title>
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo $css; ?>fontawesome.min.css">

        <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.theme.css">

        <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css">

        <link rel="stylesheet" href="<?php echo $css; ?>frontend.css">
    </head>
    <body>
    <div class="upper-bar">
        <div class="container">

            <?php
                if (isset($_SESSION['user']))
                {
                    echo 'Welcome ' . $sessionUser . ' ';

                    echo '<a href="profile.php">My Profile</a>';

                    echo ' - <a href="newad.php">New Ad</a>';

                    echo ' - <a href="logout.php">Logout</a>';

                    $userStatus = checkUserStatus($sessionUser);

                    if ($userStatus == 1)
                    {
                        //User Is Not Active
                        //echo 'your Membership Need To activet';
                    }
                }
                else
                {
            ?>
            <a href="login.php">
                <span class="pull-right">Login/SignUp</span>
            </a>
            <?php }?>
        </div>
    </div>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Homepage</a>
            </div>
            <div class="collapse navbar-collapse" id="#app-nav">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        foreach (getCat() as $cat)
                        {
                            echo
                                '<li>
                                    <a href="categories.php?pageid=' . $cat['ID'] . '&pagename=' . str_replace(' ' , '-', $cat ['Name']) . '">
                                    ' . $cat['Name'] .'</a>
                                </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>