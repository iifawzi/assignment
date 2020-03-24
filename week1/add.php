<?php
session_start();
require_once('pdo.php');
if (isset($_POST['add'])) {
if ( empty($_POST['first_name'])||empty($_POST['last_name'])||empty($_POST['email'])|empty($_POST['headline'])||empty($_POST['summary'])) {
	$_SESSION['err']="All fields are required";
	header("Location:add.php?empty");
	return;
	# code...
}
elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$_SESSION['err']="Email address must contain @";
	header("Location:add.php");
	return;
}
else{
	$sql="INSERT INTO profile (first_name,last_name,email,headline,summary,user_id) VALUES (:fname,:lname,:email,:head,:summ,:id)";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(array(
		':fname' => $_POST['first_name'], 
		':lname' =>$_POST['last_name'] , 
		':email' =>$_POST['email'] , 
		':head' =>$_POST['headline'] , 
		':summ' => $_POST['summary'],
		':id' => $_SESSION['user_id']
	));
	$_SESSION['success']="Profile added";
	header('Location:index.php');
	return;

}
}
if (isset($_POST['cancel'])) {
  header("Location:index.php");
  return;
}

  ?>

<!DOCTYPE html>
<html>
<head>
<title>Dr. Chuck's Profile Add</title>
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
<h1>Adding Profile for UMSI</h1>
<?php if (isset($_SESSION['err'])) {
echo "<p style='color:red;'>".$_SESSION['err']."</p>";
unset($_SESSION['err']);
} ?>
<form method="post">
<p>First Name:
<input type="text" name="first_name" size="60"/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"/></p>
<p>Email:
<input type="text" name="email" size="30"/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80"></textarea>
<p>
<input type="submit" name="add" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
