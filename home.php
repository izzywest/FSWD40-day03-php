<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
// select logged-in users detail
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<div class="container">

<div style="text-align: right;" class="alert alert-secondary" role="alert">
            Hi <?php echo $userRow['userName']; ?>
            <a href="logout.php?logout">Sign Out</a></div>
           
    <!-- Content after login here -->

    <h1>Book a car here</h1>
    
    <br>
<form action="home.php" method="GET">
Database: <input type="text" name="database1" />
<br>
Table: <input type="text" name="table1" />
<br>
<br>
<input type="submit" name="submit" />
</form>
<br>
<?php
$dbname = mysqli_real_escape_string($conn, $_GET['database1']);
$table1 = mysqli_real_escape_string($conn, $_GET['table1']);


if(isset($_GET["submit"])) {
    
$sql = "SELECT userId, userName, userEmail, userPass FROM `$table1`";
$result = mysqli_query($conn, $sql);
// fetch a next row (as long as there are some) into $row
while($row = mysqli_fetch_assoc($result)) {
       printf("ID=%s // Last Name: %s // First Name: %s<br>",
                     $row["userId"], $row["userName"],$row["userEmail"]);
}
echo "<br>";
}

?>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>