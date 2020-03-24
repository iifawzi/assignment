<?php
session_start();  ?>

<!DOCTYPE html>
<html>
<head>
<title>Ahmed Aboemira-9d5a197b</title>
<!-- bootstrap.php - this is HTML -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Chuck Severance's Resume Registry</h1>
<?php if (isset($_SESSION['success'])) {
echo "<p style='color:green;'>".$_SESSION['success']."</p>";
unset($_SESSION['success']);
	# code...
}?>

<?php if (! isset($_SESSION['account'])) :?>
<p><a href="login.php">Please log in</a></p>
<?php include "nonuser.php"; ?>
<?php ; elseif (isset($_SESSION['account'])): ?>
<div class="container">
<p><a href="logout.php">Logout</a></p>
<?php include "users.php"; ?>
<p><a href="add.php">Add New Entry</a></p>
<p>
 <?php ;endif?>
<b>Note:</b> Your implementation should retain data across multiple
logout/login sessions.  This sample implementation clears all its
data periodically - which you should not do in your implementation.
</p>
</div>
</body>
