<?php
function users_online()
{
    global $connection;
    $session = session_id();
    $time = time();
    $timeOutinSecs = 60;
    $timeOut = $time - $timeOutinSecs;

    $query = "SELECT * FROM users_online WHERE session = '$session' ";
    $SendQ = $connection->query($query);
    $count = mysqli_num_rows($SendQ);

    if ($count == NULL) {
        $connection->query("INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    } else {

        $connection->query("UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $queryUsersOn = $connection->query("SELECT * FROM users_online WHERE time > '$timeOut'");
    return $countUser = mysqli_num_rows($queryUsersOn);
}
function confirmQuery($queryRes)
{

    if (!$queryRes) {

        global $connection;
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}


function insert_categories()
{
    global $connection;

    if (!empty($_POST['submit'])) {


        $cat_title = $_POST['cat_title'];

        if ($cat_title == '' || empty($cat_title)) {

            echo "This field shouldn't be empty";
        } else {

            $query = "INSERT INTO categories(cat_title) 
                             VALUE('{$cat_title}')";
            $categoryQuery = $connection->query($query);
            if (!$categoryQuery) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{

    global $connection;

    //FIND ALL CATEGORIES
    $query = "SELECT * FROM categories";
    $selectCat = $connection->query($query);


    while ($row = mysqli_fetch_assoc($selectCat)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</td>";
        echo "</tr>";
    }
}


function deleteCategory()
{

    global $connection;

    if (isset($_GET['delete'])) {

        $thecatid = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$thecatid}";
        $deleteQuery = $connection->query($query);
        header("Location: categories.php");
    }
}
