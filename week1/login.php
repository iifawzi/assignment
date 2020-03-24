<?php
require_once('pdo.php');
session_start();
if (isset($_POST['login'])) {
$email=$_POST['email'];
$pass=$_POST['pass'];
$hashedpass=hash(md5, "XyZzy12*_".$pass);
$sql="SELECT * FROM  users WHERE email=:email and password=:pass";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(
	':email'=>$email,
	':pass'=>$hashedpass
));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if ($row!== false) {
		$_SESSION['account']=$row['email'];
		$_SESSION['user_id']=$row['user_id'];
		header('Location:index.php?');
		return;
	}
	else{
		$_SESSION['err']="Incorrect password";
		header('Location:login.php');
		return;	
	}
  }
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Chuck Severance's Login Page</title>
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
<h1>Please Log In</h1>
<?php
if (isset($_SESSION['err'])) {
echo "<p style='color:red;'>".$_SESSION['err']."</p>";
unset($_SESSION['err']);
	# code...
}

  ?>
<form method="POST" action="login.php">
<label for="email">Email</label>
<input type="text" name="email" id="email"><br/>
<label for="pass">Password</label>
<input type="password" name="pass" id="pass"><br/>
<input type="submit" name="login" onclick="return doValidate();" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find an account and password hint
in the HTML comments.
<!-- Hint: 
The account is umsi@umich.edu
The password is the three character name of the 
programming language used in this class (all lower case) 
followed by 123. -->
</p>
<script type="text/javascript">
function doValidate() {
console.log('Validating...');
	try{
		email=document.getElementById('email').value;
		pw=document.getElementById('pass').value;
		console.log("Validating..Email="+email+"Pass="+pw)
		if (email==null||email==""||pw==null||pw=="") {
		alert("Both fields must be filled out");
		return false;
		}
		if (email.indexOf('@')== -1) {
		alert("invalid Eamil");
		return false;
		}
	return true
}
	catch(e){
	return false;
	}
	return false;
}
</script>
</div>
</body>
