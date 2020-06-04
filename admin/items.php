<?php
    /*
     * =========================
     * == Items Page
     * =========================
     * */

    ob_start();

    session_start();

    $pageTitle = 'Items';

    if (isset($_SESSION['Username'])){

        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if ($do == 'Manage')
        {

            $stmt = $con -> prepare("SELECT 
                                                items.*,
                                                categories.Name 
                                              AS
                                                category_name,
                                                users.Username 
                                              FROM 
                                                items
                                              INNER JOIN 
                                                categories 
                                              ON 
                                                categories.ID = items.Cat_ID
                                              INNER JOIN 
                                                users 
                                              ON 
                                                users.UserID = items.Member_ID
                                              ORDER BY 
                                                item_ID DESC");
            $stmt -> execute();
            $items = $stmt ->fetchAll();

            if (!empty($items))
            {

                ?>
                <h1 class="text-center">Manage Items</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">

                            <tr>
                                <td>#ID</td>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Price</td>
                                <td>Add Date</td>
                                <td>Category</td>
                                <td>UserName</td>
                                <td>Control</td>
                            </tr>

                            <?php

                            foreach ($items as $item)
                            {
                                echo "<tr>";
                                echo "<td>" . $item['item_ID'] . "</td>";
                                echo "<td>" . $item['Name'] . "</td>";
                                echo "<td>" . $item['Description'] . "</td>";
                                echo "<td>" . $item['Price'] . "</td>";
                                echo "<td>" . $item['Add_Date']. "</td>";
                                echo "<td>" . $item['category_name']. "</td>";
                                echo "<td>" . $item['Username']. "</td>";
                                echo "<td>
                                        <a href='items.php?do=Edit&itemid=" . $item['item_ID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                        <a href='items.php?do=Delete&itemid=" . $item['item_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-closed-captioning'></i> Delete</a>";
                                        if ($item['Approve'] == 0)
                                        {
                                            echo "<a
                                                     href='items.php?do=Approve&itemid=" . $item['item_ID'] . "'
                                                     class='btn btn-info activate'>
                                                     <i class='fa fa-check'></i> Approve</a>";
                                        }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>

                            <tr>

                        </table>
                    </div>
                    <a href="items.php?do=Add" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> New Items
                    </a>
                </div>

                <?php
            }
            else
            {
                echo '<div class="container">';
                    echo '<div class="nice-message">Thers\`s No Items To Show</div>';
                        echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> New Items
                              </a>';
                echo'</div>';
            }
            ?>
            <?php
        }

        /*===== ADD =====*/
        /*===== ADD =====*/
        /*===== ADD =====*/
        elseif ($do == 'Add')
        { ?>
            <h1 class="text-center">Add New Item</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST">

                    <!-- Start Name field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                autocomplete="off"
                                required="required"
                                placeholder="Name Of The Item"/>
                        </div>
                    </div>
                    <!-- End Name field-->

                    <!-- Start Description field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="description"
                                class="form-control"
                                autocomplete="off"
                                required="required"
                                placeholder="Description Of The Item"/>
                        </div>
                    </div>
                    <!-- End Description field-->

                    <!-- Start Price field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="price"
                                class="form-control"
                                autocomplete="off"
                                required="required"
                                placeholder="Price Of The Item"/>
                        </div>
                    </div>
                    <!-- End Price field-->

                    <!-- Start Country field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="country"
                                class="form-control"
                                autocomplete="off"
                                required="required"
                                placeholder="Country Of Made"/>
                        </div>
                    </div>
                    <!-- End Country field-->

                    <!-- Start Status field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="status">
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Very Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Status field-->

                    <!-- Start Members field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="member">
                                <option value="0">...</option>
                                <?php
                                    $stmt = $con -> prepare("SELECT * FROM users");
                                    $stmt -> execute();
                                    $users = $stmt -> fetchAll();
                                    foreach ($users as $user)
                                    {
                                        echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Members field-->


                    <!-- Start Categories field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="category">
                                <option value="0">...</option>
                                <?php
                                $stmt2 = $con -> prepare("SELECT * FROM categories");
                                $stmt2 -> execute();
                                $cats = $stmt2 -> fetchAll();
                                foreach ($cats as $cat)
                                {
                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Categories field-->

                    <!-- Start Submit field-->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <input
                                type="submit"
                                value="Add Item"
                                class="btn btn-primary btn-sm"/>
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                echo "<h1 class='text-center'>Insert Items Page</h1>";
                echo "<div class='container'>";

                // Get Variables From The Form
                $name     = $_POST['name'];
                $desc     = $_POST['description'];
                $price    = $_POST['price'];
                $country  = $_POST['country'];
                $status   = $_POST['status'];
                $member   = $_POST['member'];
                $cat      = $_POST['category'];


                //Validate the Form
                $formErrors = array();

                if (empty($name))
                {
                    $formErrors[] = 'Name Can\'t Be <strong>Empty</strong>';
                }

                if (empty($desc))
                {
                    $formErrors[] = 'Description Can\'t Be <strong>Empty</strong>';
                }

                if (empty($price))
                {
                    $formErrors[] = 'Price Can\'t Be <strong>Empty</strong>';
                }

                if (empty($country))
                {
                    $formErrors[] = 'Country Can\'t Be <strong>Empty</strong>';
                }

                if ($status == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Status</strong>';
                }

                if ($member == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Member</strong>';
                }

                if ($cat == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Category</strong>';
                }


                //Loop Into Error Array Echo It
                foreach ($formErrors as $error)
                {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }

                //Check If There,s No Error Proceed The Update Operation
                if (empty($formErrors))
                {

                    //Insert User Info  In Database
                    $stmt = $con->prepare("INSERT INTO 
                                                          items
                                                          (Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID) 
                                                          VALUES (:Zname, :Zdesc, :Zprice, :Zcountry, :Zstatus, now(), :Zcat, :Zmember)");
                    $stmt->execute(array(
                        'Zname'    => $name,
                        'Zdesc'    => $desc,
                        'Zprice'   => $price,
                        'Zcountry' => $country,
                        'Zstatus'  => $status,
                        'Zcat'     => $cat,
                        'Zmember'  => $member

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

                redirectHome($theMsg);

                echo '</div>';
            }

            echo "</div>";
        }

        /*===== EDIT =====*/
        /*===== EDIT =====*/
        /*===== EDIT =====*/
        elseif ($do == 'Edit')
        {
            //Check iF GET Request Userid Numeric & GET The Integer Value Of It
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

            //Select All Data Depend On This ID
            $stmt = $con -> prepare("SELECT * FROM items WHERE item_ID = ?");
            $stmt -> execute(array($itemid));
            $item = $stmt -> fetch();
            $count = $stmt -> rowCount();

            // IF Found ID Show The Form
            if ($count > 0 ) { ?>

                    <h1 class="text-center">Edit Item</h1>
                    <div class="container">
                        <form class="form-horizontal" action="?do=Update" method="POST">
                            <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />

                            <!-- Start Name field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10 col-md-4">
                                    <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            autocomplete="off"
                                            required="required"
                                            placeholder="Name Of The Item"
                                            value="<?php echo $item['Name']?>"/>
                                </div>
                            </div>
                            <!-- End Name field-->

                            <!-- Start Description field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10 col-md-4">
                                    <input
                                            type="text"
                                            name="description"
                                            class="form-control"
                                            autocomplete="off"
                                            required="required"
                                            placeholder="Description Of The Item"
                                            value="<?php echo $item['Description']?>"/>
                                </div>
                            </div>
                            <!-- End Description field-->

                            <!-- Start Price field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-10 col-md-4">
                                    <input
                                            type="text"
                                            name="price"
                                            class="form-control"
                                            autocomplete="off"
                                            required="required"
                                            placeholder="Price Of The Item"
                                            value="<?php echo $item['Price']?>"/>
                                </div>
                            </div>
                            <!-- End Price field-->

                            <!-- Start Country field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-10 col-md-4">
                                    <input
                                            type="text"
                                            name="country"
                                            class="form-control"
                                            autocomplete="off"
                                            required="required"
                                            placeholder="Country Of Made"
                                            value="<?php echo $item['Country_Made']?>"/>
                                </div>
                            </div>
                            <!-- End Country field-->

                            <!-- Start Status field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10 col-md-4">
                                    <select name="status">
                                        <option value="1" <?php if ($item ['Status'] == 1){ echo 'selected'; } ?>>New</option>
                                        <option value="2" <?php if ($item ['Status'] == 2){ echo 'selected'; } ?>>Like New</option>
                                        <option value="3" <?php if ($item ['Status'] == 3){ echo 'selected'; } ?>>Used</option>
                                        <option value="4" <?php if ($item ['Status'] == 4){ echo 'selected'; } ?>>Very Old</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Status field-->

                            <!-- Start Members field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Member</label>
                                <div class="col-sm-10 col-md-4">
                                    <select name="member">
                                        <?php
                                        $stmt = $con -> prepare("SELECT * FROM users");
                                        $stmt -> execute();
                                        $users = $stmt -> fetchAll();
                                        foreach ($users as $user)
                                        {
                                            echo "<option value='" . $user['UserID'] . "'";
                                            if ($item ['Member_ID'] == $user['UserID']){ echo 'selected'; }
                                            echo ">" . $user['Username'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- End Members field-->


                            <!-- Start Categories field-->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10 col-md-4">
                                    <select name="category">
                                        <?php
                                        $stmt2 = $con -> prepare("SELECT * FROM categories");
                                        $stmt2 -> execute();
                                        $cats = $stmt2 -> fetchAll();
                                        foreach ($cats as $cat)
                                        {
                                            echo "<option value='" . $cat['ID'] . "'";
                                            if ($item ['Cat_ID'] == $cat['ID'] ){ echo 'selected'; }
                                            echo ">" . $cat['Name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- End Categories field-->

                            <!-- Start Submit field-->
                            <div class="form-group form-group-lg">
                                <div class="col-sm-offset-2 col-sm-10 ">
                                    <input
                                            type="submit"
                                            value="Save Item"
                                            class="btn btn-primary btn-sm"/>
                                </div>
                            </div>
                            <!-- End Submit field-->
                        </form>

                    <?php

                        $stmt = $con -> prepare("SELECT
                                                            comments.*, users.Username AS Member
                                                          FROM
                                                            comments
                                                          INNER  JOIN
                                                            users
                                                          ON
                                                            users.UserID = comments.user_id
                                                          WHERE item_id = ?");
                        $stmt -> execute(array($itemid));
                        $rows = $stmt ->fetchAll();

                        if (! empty($rows)){

                        ?>
                        <h1 class="text-center">Manage [ <?php echo $item['Name']?> ] Comments</h1>
                            <div class="table-responsive">
                                <table class="main-table text-center table table-bordered">

                                    <tr>
                                        <td>Comment</td>
                                        <td>User Name</td>
                                        <td>Add Date</td>
                                        <td>Control</td>
                                    </tr>

                                    <?php

                                    foreach ($rows as $row)
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $row['comment'] . "</td>";
                                        echo "<td>" . $row['Member'] . "</td>";
                                        echo "<td>" . $row['comment_date']. "</td>";
                                        echo "<td>
                                                <a href='comments.php?do=Edit&comid=" . $row['c_id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                                <a href='comments.php?do=Delete&comid=" . $row['c_id'] . "' class='btn btn-danger confirm'><i class='fa fa-closed-captioning'></i> Delete</a>";

                                        if ($row['status'] == 0)
                                        {
                                            echo "<a 
                                    href='comments.php?do=Approved&comid=" . $row['c_id'] . "' 
                                    class='btn btn-info activate'>
                                    <i class='fa fa-check'></i> Approved</a>";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    <tr>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                <?php
            }

            // Else Not Found ID Dont Show The Form
            else
            {
                echo "<div class='container'>";
                $theMsg = '<div class="alert alert-danger">There Is No Such ID</div>';
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
            echo "<h1 class='text-center'>Update Page Items</h1>";
            echo "<div class='container'>";

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Get Variables From The Form

                $id     = $_POST['itemid'];
                $name   = $_POST['name'];
                $desc  = $_POST['description'];
                $price   = $_POST['price'];
                $country  = $_POST['country'];
                $status   = $_POST['status'];
                $cat      = $_POST['category'];
                $member   = $_POST['member'];



                //Validate the Form
                $formErrors = array();

                if (empty($name))
                {
                    $formErrors[] = 'Name Can\'t Be <strong>Empty</strong>';
                }

                if (empty($desc))
                {
                    $formErrors[] = 'Description Can\'t Be <strong>Empty</strong>';
                }

                if (empty($price))
                {
                    $formErrors[] = 'Price Can\'t Be <strong>Empty</strong>';
                }

                if (empty($country))
                {
                    $formErrors[] = 'Country Can\'t Be <strong>Empty</strong>';
                }

                if ($status == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Status</strong>';
                }

                if ($member == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Member</strong>';
                }

                if ($cat == 0)
                {
                    $formErrors[] = 'You Must Choose The <strong>Category</strong>';
                }


                //Loop Into Error Array Echo It
                foreach ($formErrors as $error)
                {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }

                //Check If There,s No Error Proceed The Update Operation
                if (empty($formErrors))
                {
                    //Update The Database Wthe Info
                    $stmt = $con -> prepare("UPDATE 
                                                         items 
                                                      SET 
                                                        Name = ?, 
                                                        Description = ?, 
                                                        Price  = ?, 
                                                        Country_Made = ?,
                                                        Status  = ?, 
                                                        Cat_ID  = ?, 
                                                        Member_ID  = ?
                                                      WHERE 
                                                        item_ID = ?");
                    $stmt -> execute(array($name, $desc, $price, $country, $status, $cat, $member, $id));
                    // Echo Success Message
                    $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Update</div>';

                    redirectHome($theMsg, 'Back');

                }

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
            echo "<h1 class='text-center'>Delete Items</h1>";
            echo "<div class='container'>";

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;


            $check = checkItem('Item_ID', 'items', $itemid);


            if ($check > 0 )
            {

                $stmt = $con -> prepare("DELETE FROM items WHERE item_ID = :zid");
                $stmt -> bindParam(":zid", $itemid);
                $stmt -> execute();
                $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Deleted</div>';

                redirectHome($theMsg,'back');
            }
            else
            {
                $theMsg = '<div class="alert alert-danger">This Is ID Is Not Exist</div>';

                redirectHome($theMsg);
            }

            echo '</div>';
        }

        /*===== APPROVE =====*/
        /*===== APPROVE =====*/
        /*===== APPROVE =====*/
        elseif ($do == 'Approve')
        {
            echo "<h1 class='text-center'>Approve Items</h1>";
            echo "<div class='container'>";

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

            $check = checkItem('item_ID', 'items', $itemid);

            if ($check > 0 )
            {

                $stmt = $con -> prepare("UPDATE items SET Approve = 1 WHERE  item_ID = ?");
                $stmt -> execute(array($itemid));
                $theMsg = "<div class='alert alert-success'>" . $stmt -> rowCount() . 'Record Activated</div>';

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