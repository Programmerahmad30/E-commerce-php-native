<?php

    /*
     * Title function v1.0
     * Title Functions That echo The Page Title In Case The Page
     * Has The variabiles $pageTitle And Echo Defult Title For Other
     **/

    function getTitle()
    {
        global $pageTitle;

        if (isset($pageTitle))
        {
            echo $pageTitle;
        }
        else
        {
            echo 'Default';
        }
    }

    /*
     * Home Redirect Function v2.0
     * This Function Accept Parameters
     * $theMsg = Echo The  Message [ Error | Success | Warning ]
     * $url = The Link you Want To Redirect To
     * $seconds  = Seconds Before Redirecting
     * function دي لو انادخلت على صفحة members.php?do=insert مباشر مش هينفع ويديني 6 ثوانى ويرجعني على صفحة dashboard.php
     * */

    function redirectHome($theMsg, $url = null, $seconds = 3)
    {
        if ($url === null)
        {
            $url  = 'index.php';
            $link = 'HomePage';
        }
        else
        {
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '')
            {
                $url = $_SERVER['HTTP_REFERER'];

                $link = 'Previous Page';
            }
            else
            {
                $url = 'index.php';

                $link = 'HomePage';
            }
        }

        echo $theMsg;

        echo "<div class ='alert alert-info'>You Will Be Redirected To $link After $seconds Seconds.</div>";

        header("refresh:$seconds;url=$url");

        exit();
    }

    /*
     * Check Items Functions v1.0
     * Function Tow Check DataBase [Function Accept Parameters]
     * $select =  The Item To Select [Example: user, item, category]
     * $from   =  The Table To Select From [Example: users, items, categories]
     * $value  =  The Values Of Select [Example: Ahmad, box, mobile]
     * */

    function checkItem($select, $from, $value)
    {
        global $con;

        $statement = $con -> prepare("SELECT $select FROM $from WHERE $select = ?");

        $statement -> execute(array($value));

        $count = $statement -> rowCount();

        return $count;
    }

    /*
     *
     * Count Number Of Items Function v1.0
     * Function To Count Number Of Items Rows
     * $item  = The Item To Count
     * $table = The  Table To Choose From
     *
     **/

    function countItems($item, $table)
    {

        global $con;
        $stmt2 = $con -> prepare("SELECT COUNT($item) FROM $table");
        $stmt2 -> execute();
        return  $stmt2 -> fetchColumn();
    }

    /*
     *
     * Get Latest Records Function v1.0
     * Function To Get Latest Items From Database [Users, Items, Comments]
     * $select = Field To Select
     * $table  = The Table To Choose From
     * $order  = The Desc Ordering
     * $limit  = Number Of Records To Get
     *
     * */

    function getLatest($select, $table, $order, $limit = 5)
    {
        global $con;

        $getStmt = $con -> prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
        $getStmt -> execute();
        $rows = $getStmt -> fetchAll();
        return $rows;
    }