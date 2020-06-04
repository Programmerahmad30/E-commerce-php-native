<?php

    session_start();

    $pageTitle = 'Create New Ads';

    include 'init.php';
    if (isset($_SESSION['user']))
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # code...
            echo $_POST['name'];
            echo $_POST['description'];
            echo $_POST['price'];
        }

    ?>

    <h1 class="text-center"><?php echo $pageTitle; ?></h1>

    <div class="create-ad block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading"><?php echo $pageTitle; ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                                <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

                                    <!-- Start Name field-->
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control live"
                                                autocomplete="off"
                                                required="required"
                                                placeholder="Name Of The Item"
                                                data-class=".live-title"
                                                />
                                        </div>
                                    </div>
                                    <!-- End Name field-->

                                    <!-- Start Description field-->
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">Description</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input
                                                type="text"
                                                name="description"
                                                class="form-control live"
                                                autocomplete="off"
                                                required="required"
                                                placeholder="Description Of The Item"
                                                data-class=".live-desc"/>
                                        </div>
                                    </div>
                                    <!-- End Description field-->

                                    <!-- Start Price field-->
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">Price</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input
                                                type="text"
                                                name="price"
                                                class="form-control live"
                                                autocomplete="off"
                                                required="required"
                                                placeholder="Price Of The Item"
                                                data-class=".live-price"/>
                                        </div>
                                    </div>
                                    <!-- End Price field-->

                                    <!-- Start Country field-->
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-10 col-md-9">
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
                                        <label class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-10 col-md-9">
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


                                    <!-- Start Categories field-->
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">Category</label>
                                        <div class="col-sm-10 col-md-9">
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
                                        <div class="col-sm-offset-3 col-sm-9 ">
                                            <input
                                                type="submit"
                                                value="Add Item"
                                                class="btn btn-primary btn-sm"/>
                                        </div>
                                    </div>
                                    <!-- End Submit field-->
                                </form>
                        </div>

                        <div class="col-md-4">
                            <div class="thumbnail item-box live-preview">
                                <span class="price-tag">
                                    $ <span class="live-price">0</span>
                                </span>
                                <img class="img-responsive" src="dddd.png" alt="">
                                <div class="caption">
                                    <h3 class="live-title">Title</h3>
                                    <p class="live-desc">Description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    }
    else
    {
        header('Location: login.php');
        exit();
    }
    include $tpl . 'footer.php';
?>

