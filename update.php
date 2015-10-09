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

<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    $action = $_GET["action"];
    $title = $_GET["title"];
    $failed = $_GET["failed"];
    if($action == "addmovie") {
        if($failed != "true") {
            echo $title . " Added to My Plan\n";
        }
        else {
            echo $title . " Is already added to My Plan\n";
        }
    }
    if($action == "deletemovie") {
        if($failed != "true") {
            echo $title . " Deleted from My Plan\n";
        }
        else {
            echo $title . " Not deleted from My Plan\n";
        }
    }
    
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
    $sql = "SELECT * FROM mytable";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table class=\"table\">
        <tr>
        <th>Year</th>
        <th>Length</th>
        <th>Title</th>
        <th>Subject</th>
        <th>Actor</th>
        <th>Actress</th>
        <th>Director</th>
        <th>Popularity</th>
        <th>Awards</th>
        </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['Length'] . "</td>";
            echo "<div><td>" . $row['Title'] . "<a href=\"https://personal-movies-management-deepd.c9.io/updateMovie.php?id=" . $row['ID'] . 
            "&year=" . $row['Year'] . "\" class=\"btn btn-info btn-xs\" style=\"float: right;\">Update</a>" . "</td></div>";
            echo "<td>" . $row['Subject'] . "</td>";
            echo "<td>" . $row['Actor'] . "</td>";
            echo "<td>" . $row['Actress'] . "</td>";
            echo "<td>" . $row['Director'] . "</td>";
            echo "<td>" . $row['Popularity'] . "</td>";
            echo "<td>" . $row['Awards'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h1>" . "No entries in My Plan" . "</h1>";
    }
    $db->close();
?>

</body>
</html>                          