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

<div class="card" style="width: 70%;">
<div class="card-body">
<h5 class="card-title">Book a car here</h5>
<img class="card-img-top" src="car.png" style="width: 15%; padding-bottom: 20px;" alt="Card image cap">
<h6 class="card-subtitle mb-2 text-muted">Select a database and table</h6>
<form action="home.php" method="GET">Database: <input class="form-control" style="width: 100%; "type="text" name="database1" />
Table: <input class="form-control" style="width: 100%; type="text" name="table1" /><br><br>
<input class="btn btn-primary"  type="submit" name="submit" /></form>  </div>
</div>

<?php
$dbname = mysqli_real_escape_string($conn, $_GET['database1']);
$table1 = mysqli_real_escape_string($conn, $_GET['table1']);

if(isset($_GET["submit"])) {

$sql = "SELECT userId, userName, userEmail, userPass FROM `$table1`";
$result = mysqli_query($conn, $sql);
// fetch a next row (as long as there are some) into $row
while($row = mysqli_fetch_assoc($result)) {
       printf("ID=%s Last Name: %s // First Name: %s<br>",
                     $row["userId"], $row["userName"],$row["userEmail"]);
}
echo "<br>";
}

?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>