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
    if(isset($_GET['action'])=='updateMovie') {
        updateMovie();
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
    <?php
        // A simple PHP script demonstrating how to connect to MySQL.
        // Press the 'Run' button on the top to start the web server,
        // then click the URL that is emitted to the Output tab of the console.
        $ID = $_GET["id"];
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
        $sql = "SELECT * FROM mytable where id=".$ID;
        $result = $db->query($sql);
        $row = $result->fetch_assoc()
    ?>
    <div>
        <form role="form-horizontal" action="?action=updateMovie" method="POST">
          <div class="form-group">
            <label for="year" class="control-label col-xs-2">Year :</label>
            <div class="col-xs-10"> <input type="text" class="form-control" name="year" value=<?php echo $row['Year']?>> </div>
          </div>
          <div class="form-group">
            <label for="length" class="control-label col-xs-2">Length :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="length" value="<?php echo $row['Length']?>"></div>
          </div>
          <div class="form-group">
            <label for="title" class="control-label col-xs-2">Title :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="title" value="<?php echo $row['Title']?>"></div>
          </div>
          <div class="form-group">
            <label for="subject" class="control-label col-xs-2">Subject :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="subject" value="<?php echo $row['Subject']?>"></div>
          </div>
          <div class="form-group">
            <label for="actor" class="control-label col-xs-2">Actor :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="actor" value="<?php echo $row['Actor']?>"></div>
          </div>
          <div class="form-group">
            <label for="actress" class="control-label col-xs-2">Actress :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="actress" value="<?php echo $row['Actress']?>"></div>
          </div>
          <div class="form-group">
            <label for="director" class="control-label col-xs-2">Director :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="director" value="<?php echo $row['Director']?>"></div>
          </div>
          <div class="form-group">
            <label for="popularity" class="control-label col-xs-2">Popularity :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="popularity" value="<?php echo $row['Popularity']?>"></div>
          </div>
          <div class="form-group">
            <label for="award" class="control-label col-xs-2">Awards :</label>
            <div class="col-xs-10"><input type="text" class="form-control" name="award" value="<?php echo $row['Awards']?>"></div>
          </div>
          <input type="hidden" name="ID" value=<?php echo $ID?>>
          <button type="submit" class="btn btn-default" name="submit">Submit</button>
        </form>
    </div>
</body>

<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    function updateMovie() {
        $ID = $_POST["ID"];
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
        $sql = "update mytable set Year='".$year."', Length='".$length."', Title='".$title."',Subject='".$subject."', Actor='".$actor."', Actress='".
        $actress."', Director='".$director."', Popularity='".$popularity."', Awards='".$award."' ".
        "where ID=".$ID;
        $result = $db->query($sql);
        
       if(!$result) {
           header('Location: https://personal-movies-management-deepd.c9.io/list.php?action=' . 'updatemovie&' .'title='.$title.'&failed=true');
       }
       else {
           header('Location: https://personal-movies-management-deepd.c9.io/list.php?action=' . 'updatemovie&' .'title='.$title);
       }
        $db->close();
    }
?>

</html>                          