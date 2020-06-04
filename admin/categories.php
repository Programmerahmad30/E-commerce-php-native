<?php
    /*
     * =========================
     * == Category Page
     * =========================
     * */

    ob_start();

    session_start();

    $pageTitle = 'Categories';

    if (isset($_SESSION['Username'])){

        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if ($do == 'Manage')
        {
            $sort = 'ASC';

            $sort_array = array('ASC', 'DESC');

            if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array))
            {
                $sort = $_GET['sort'];
            }

            $stmt2 = $con -> prepare("SELECT * FROM categories ORDER BY Ordering $sort ");

            $stmt2 -> execute();

            $cats = $stmt2 -> fetchAll();

            if (!empty($cats))
            {
                ?>
                <h1 class="text-center">Manage Categories</h1>
                <div class="container categories">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> Manage Categories
                            <div class="option pull-right">
                                <i class="fa fa-sort"></i> Ordering: [
                                <a class="<?php if ($sort == 'ASC'){echo 'active';} ?>" href="?sort=ASC">ASC</a> |
                                <a class="<?php if ($sort == 'DESC'){echo 'active';} ?>" href="?sort=DESC">DESC</a> ]
                                <i class="fa fa-eye"></i> View: [
                                <span class="active" data-view="full">Full</span> |
                                <span data-view="classic">Classic</span> ]
                            </div>
                        </div>
                        <div class="panel-body">

                            <?php
                                foreach ($cats as $cat)
                                {
                                    echo "<div class='cat'>";
                                        echo "<div class='hidden-buttons'>";
                                            echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                                            echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa fa-closed-captioning'></i> Delete</a>";
                                        echo "</div>";
                                        echo "<h3>" . $cat['Name'] . "</h3>";
                                        echo "<div class='full-view'>";
                                        echo "<p>"; if ($cat['Description'] == ''){echo 'This Category Has No Description';} else{ echo $cat['Description']; } echo "</p>";
                                            if ($cat['Visibility'] == 1) {echo '<span class="visibility"><i class="fa fa-eye"></i> Hidden</span>';}
                                            if ($cat['Allow_Comment'] == 1) {echo '<span class="commenting"><i class="fa fa-window-close"></i> Comment Disabled</span>';}
                                            if ($cat['Allow_Ads'] == 1) {echo '<span class="advertises"><i class="fa fa-window-close"></i> Ads Disabled</span>';}
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<hr>";
                                }
                            ?>

                        </div>
                    </div>
                    <a class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
                </div>
                <?php
            }
            else
            {
                echo '<div class="container">';
                echo '<div class="nice-message">Thers\`s No Category To Show</div>';
                echo '<a href="categories.php?do=Add" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> New Category
                                  </a>';
                echo '</div>';
            }
            ?>
            <?php
        }

        /*===== ADD =====*/
        /*===== ADD =====*/
        /*===== ADD =====*/
        elseif ($do == 'Add') {?>
            <h1 class="text-center">Add New Category</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST">

                    <!-- Start Name field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="name" class="form-control"  autocomplete="off" required="required" placeholder="Name Of The Category"/>
                        </div>
                    </div>
                    <!-- End Name field-->

                    <!-- Start Description field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="description" class="form-control" placeholder="Describe The Category"/>
                        </div>
                    </div>
                    <!-- End Description field-->

                    <!-- Start Ordering field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories"/>
                        </div>
                    </div>
                    <!-- End Ordering field-->

                    <!-- Start Visibility field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-4">

                            <div>
                                <input id="vis-yes" type="radio" name="visibility" value="0" checked />
                                <label for="vis-yes">Yes</label>
                            </div>

                            <div>
                                <input id="vis-no" type="radio" name="visibility" value="1" />
                                <label for="vis-no">No</label>
                            </div>

                        </div>
                    </div>
                    <!-- End Visibility field-->

                    <!-- Start Commenting field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Commenting</label>
                        <div class="col-sm-10 col-md-4">

                            <div>
                                <input id="com-yes" type="radio" name="commenting" value="0" checked />
                                <label for="com-yes">Yes</label>
                            </div>

                            <div>
                                <input id="com-no" type="radio" name="commenting" value="1" />
                                <label for="com-no">No</label>
                            </div>

                        </div>
                    </div>
                    <!-- End Commenting field-->

                    <!-- Start Ads field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-4">

                            <div>
                                <input id="ads-yes" type="radio" name="ads" value="0" checked />
                                <label for="ads-yes">Yes</label>
                            </div>

                            <div>
                                <input id="ads-no" type="radio" name="ads" value="1" />
                                <label for="ads-no">No</label>
                            </div>

                        </div>
                    </div>
                    <!-- End Ads field-->

                    <!-- Start Submit field-->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <input type="submit" value="Add Category" class="btn btn-primary btn-lg"/>
                        </div>
                    </div>
                    <!-- End Submit field-->
                </form>
            </div>


        <?php
        }


        /*===== INSERT =====*/
        /*===== INSERT =====*/
        /*===== INSERT =====*/
        elseif ($do == 'Insert')
        {
            //Insert Category Page


            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                echo "<h1 class='text-center'>Update Category Page</h1>";
                echo "<div class='container'>";

                // Get Variables From The Form
                $name    = $_POST['name'];
                $desc    = $_POST['description'];
                $order   = $_POST['ordering'];
                $visible = $_POST['visibility'];
                $comment = $_POST['commenting'];
                $ads     = $_POST['ads'];


                //Check If Category Exist In DataBase
                $check = checkItem("Name", "categories", $name);

                if ($check == 1)
                {
                    $theMsg = '<div class="alert alert-danger">Sorry This Category Is Exist</div>';

                    redirectHome($theMsg, 'Back');
                }
                else
                {

                    //Insert Category Info  In Database
                    $stmt = $con->prepare("INSERT INTO 
                                                          categories(
                                                              Name, Description, Ordering, Visibility, Allow_Comment, Allow_Ads) 
                                                              VALUES (:Zname, :Zdesc, :Zorder, :Zvisibile, :Zcomment, :Zads)
                                                          ");
                    $stmt->execute(array(
                        'Zname'     => $name,
                        'Zdesc'     => $desc,
                        'Zorder'    => $order,
                        'Zvisibile' => $visible,
                        'Zcomment'  => $comment,
                        'Zads'      => $ads
                    ));

                    // Echo Success Message
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Inserted</div>';
                    redirectHome($theMsg, 'Back');
                }
            }
            else
            {

                echo '<div class="container">';
                $theMsg =  '<div class="alert alert-danger">Sorry You Cant Browse this Page Directly</div>';

                redirectHome($theMsg, 'Back');

                echo '</div>';
            }

            echo "</div>";
        }

        /*===== EDIT =====*/
        /*===== EDIT =====*/
        /*===== EDIT =====*/
        elseif ($do == 'Edit')
        {
            //Check iF GET Request Catid Numeric & GET The Integer Value Of It
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

            //Select All Data Depend On This ID
            $stmt = $con -> prepare("SELECT * FROM categories WHERE ID = ? ");
            $stmt -> execute(array($catid));
            $cat = $stmt -> fetch();
            $count = $stmt -> rowCount();

            // IF Found ID Show The Form
            if ($count > 0 ) { ?>


                <h1 class="text-center">Edit Category</h1>
                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>" />

                        <!-- Start Name field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name Of The Category" value="<?php echo $cat['Name']?>"/>
                            </div>
                        </div>
                        <!-- End Name field-->

                        <!-- Start Description field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="description" class="form-control" placeholder="Describe The Category" value="<?php echo $cat['Description']?>"/>
                            </div>
                        </div>
                        <!-- End Description field-->

                        <!-- Start Ordering field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ordering</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories" value="<?php echo $cat['Ordering']?>"/>
                            </div>
                        </div>
                        <!-- End Ordering field-->

                        <!-- Start Visibility field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10 col-md-4">

                                <div>
                                    <input id="vis-yes" type="radio" name="visibility" value="0"  <?php if ($cat['Visibility'] == 0) { echo 'checked'; }?> />
                                    <label for="vis-yes">Yes</label>
                                </div>

                                <div>
                                    <input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility'] == 1) { echo 'checked'; }?> />
                                    <label for="vis-no">No</label>
                                </div>

                            </div>
                        </div>
                        <!-- End Visibility field-->

                        <!-- Start Commenting field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Commenting</label>
                            <div class="col-sm-10 col-md-4">

                                <div>
                                    <input id="com-yes" type="radio" name="commenting" value="0"  <?php if ($cat['Allow_Comment'] == 0) { echo 'checked'; }?> />
                                    <label for="com-yes">Yes</label>
                                </div>

                                <div>
                                    <input id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment'] == 1) { echo 'checked'; }?> />
                                    <label for="com-no">No</label>
                                </div>

                            </div>
                        </div>
                        <!-- End Commenting field-->

                        <!-- Start Ads field-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Ads</label>
                            <div class="col-sm-10 col-md-4">

                                <div>
                                    <input id="ads-yes" type="radio" name="ads" value="0"  <?php if ($cat['Allow_Ads'] == 0) { echo 'checked'; }?> />
                                    <label for="ads-yes">Yes</label>
                                </div>

                                <div>
                                    <input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat['Allow_Ads'] == 1) { echo 'checked'; }?> />
                                    <label for="ads-no">No</label>
                                </div>

                            </div>
                        </div>
                        <!-- End Ads field-->

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


        /*===== UPDATE =====*/
        /*===== UPDATE =====*/
        /*===== UPDATE =====*/
        elseif ($do == 'Update')
        {
            //Update Page
            echo "<h1 class='text-center'>Update Category</h1>";
            echo "<div class='container'>";

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Get Variables From The Form

                $id        = $_POST['catid'];
                $name      = $_POST['name'];
                $desc      = $_POST['description'];
                $order     = $_POST['ordering'];
                $visible   = $_POST['visibility'];
                $comment   = $_POST['commenting'];
                $ads       = $_POST['ads'];

                //Update The Database Wthe Info
                $stmt = $con -> prepare("UPDATE 
                                                      categories 
                                                  SET 
                                                      Name = ?, 
                                                      Description = ?, 
                                                      Ordering = ?, 
                                                      Visibility = ?,
                                                      Allow_Comment = ?,
                                                      Allow_Ads = ? 
                                                  WHERE 
                                                      ID = ?");
                $stmt -> execute(array($name, $desc, $order, $visible, $comment, $ads, $id));
                // Echo Success Message
                $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Update</div>';

                redirectHome($theMsg, 'Back');

            }
            else
            {
                $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

                redirectHome($theMsg);
            }

            echo "</div>";
        }

        /*===== DELETE =====*/
        /*===== DELETE =====*/
        /*===== DELETE =====*/
        elseif ($do == 'Delete')
        {
            //Delete Category Page

            echo "<h1 class='text-center'>Delete Category</h1>";
            echo "<div class='container'>";

            //Check iF GET Request Catid Numeric & GET The Integer Value Of It
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;


            $check = checkItem('ID', 'categories', $catid);

            // IF Found ID Show The Form

            if ($check > 0 )
            {

                $stmt = $con -> prepare("DELETE FROM categories WHERE ID = :zid");
                $stmt -> bindParam(":zid", $catid);
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

        include $tpl . 'footer.php';
    }

    else
    {
        header('Location: index.php');
        exit();
    }

    ob_end_flush();
?>