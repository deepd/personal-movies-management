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
<?php 
    if(isset($_GET['action'])=='addMovie') {
        addMovie();
    }
?>
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
    <div>
        <form role="form-horizontal" action="?action=addMovie" method="POST">
          <div class="form-group">
            <label for="year" class="control-label col-xs-2">Year :</label>
            <div class="col-xs-10"> <input type="text" class="form-control" name="year"> </div>
          </div>
          <div class="form-group">
            <label for="length" class="control-label col-xs-2">Length :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="length"></div>
          </div>
          <div class="form-group">
            <label for="title" class="control-label col-xs-2">Title :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="title"></div>
          </div>
          <div class="form-group">
            <label for="subject" class="control-label col-xs-2">Subject :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="subject"></div>
          </div>
          <div class="form-group">
            <label for="actor" class="control-label col-xs-2">Actor :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="actor"></div>
          </div>
          <div class="form-group">
            <label for="actress" class="control-label col-xs-2">Actress :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="actress"></div>
          </div>
          <div class="form-group">
            <label for="director" class="control-label col-xs-2">Director :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="director"></div>
          </div>
          <div class="form-group">
            <label for="popularity" class="control-label col-xs-2">Popularity :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="popularity"></div>
          </div>
          <div class="form-group">
            <label for="award" class="control-label col-xs-2">Awards :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="award"></div>
          </div>
          <button type="submit" class="btn btn-default" name="submit">Submit</button>
        </form>
    </div>
</body>

<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    function addMovie() {
        $year = isset($_POST["year"]) ? $_POST["year"] : "";
        $length = isset($_POST["length"]) ? $_POST["length"] : "";
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
        $actor = isset($_POST["actor"]) ? $_POST["actor"] : "";
        $actress = isset($_POST["actress"]) ? $_POST["actress"] : "";
        $director = isset($_POST["director"]) ? $_POST["director"] : "";
        $popularity = isset($_POST["popularity"]) ? $_POST["popularity"] : "";
        $award = isset($_POST["award"]) ? $_POST["award"] : "";
        
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
        $sql = "INSERT INTO mytable values('".$year."','".$length."','".$title."','".$subject."','".$actor."','".$actress."','".$director.
        "','".$popularity."','".$award."',NULL)";
        $result = $db->query($sql);
        
       if(!$result) {
           header('Location: https://personal-movies-management-deepd.c9.io/list.php?action=' . 'addmovie&' .'title='.$title.'&failed=true');
       }
       else {
           header('Location: https://personal-movies-management-deepd.c9.io/list.php?action=' . 'addmovie&' .'title='.$title);
       }
        $db->close();
    }
?>

</html>                          