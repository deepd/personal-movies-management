<!DOCTYPE html>
<html lang="en">
<head>
<title>Movie Planner</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="base.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
</head>
<body>
     <div>

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li><a href="home.php">Home</a></li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Search<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="search.html">Simple Search</a></li>
                <li><a href="search-complex.html">Complex Search</a></li>
            </ul>
        </li>
        <li class="active" class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Movies<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="add.php">Add</a></li>
                <li><a href="delete.php">Delete</a></li>
                <li><a href="update.php">Update</a></li>
                <li><a href="list.php">List</a></li>
                <li class="divider"></li>
                <li><a href="plan.php">Plan</a></li>
            </ul>
        </li>
      </ul>

    </div>
<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    $title = $_GET["title"];
    $year = $_GET["year"];

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    //echo "Connected successfully (".$db->host_info.")";
    /*$sql = "create table mytable(Year varchar(255), Length varchar(255), Title varchar(255), Subject varchar(255), Actor varchar(255), 
            Actress varchar(255), Director varchar(255) , Popularity varchar(255), Awards varchar(255))";
    if ($db->query($sql) === TRUE) {
        echo "Table mytable created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }*/
    $sql = "INSERT INTO myplan SELECT * FROM mytable WHERE title=\"" . $title . "\" and year=\"" . $year . "\"";
    echo $sql;
    $result = $db->query($sql);
    
    if(!$result) {
        header("Location: https://personal-movies-management-deepd.c9.io/home.php?action=" . "addmovie&" ."title=" . $title . "&failed=true");
    }
    else {
        header("Location: https://personal-movies-management-deepd.c9.io/home.php?action=" . "addmovie&" ."title=" . $title);
    }
    
    $db->close();
    
?>

</body>
</html>                          