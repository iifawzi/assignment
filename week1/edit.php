<?php
session_start();
require_once("pdo.php");
if (! isset($_GET['profile_id'])) {
  $_SESSION['err'] = "Missing user_id";
  header('Location: index.php');
  return;
}
if (isset($_POST['cancel'])) {
	header("Location:index.php");
}
if (isset($_POST['save'])) {
	if (
	       empty($_POST['first_name']) 
	    || empty($_POST['last_name']) 
	    || empty($_POST['email']) 
	    || empty($_POST['headline']) 
	    || empty($_POST['summary'])) {
		$_SESSION['err']= "All fields are required";
    	header("Location:edit.php?profile_id=".$_POST['profile_id']);
		return;
	# code...
	}
	elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$_SESSION['err']="Email address must contain @";
	header("Location:edit.php?profile_id=".$_POST['profile_id']);
	return;
}
    $sql="UPDATE `profile` SET `first_name`=:fname,`last_name`=:lname,`headline`=:head,`summary`=:summ,`email`=:email WHERE profile_id=:profile_id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':fname'=>$_POST['first_name'],
        ':lname' =>$_POST['last_name'] , 
        ':head' =>$_POST['headline'] , 
        ':summ' =>$_POST['summary'] , 
        ':email'=>$_POST['email'],
        ':profile_id'=> $_POST['profile_id']
                        ));
    $_SESSION['success']="Record Updated";
    header("Location:index.php");
    return;
}
$sql="SELECT * FROM profile where profile_id=:id";
$stmt=$pdo->prepare($sql);
$row=$stmt->execute(array("id"=>$_GET['profile_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Ahmed Aboemira-9d5a197b</title>
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Editing Profile for UMSI</h1>
<?php
if (isset($_SESSION['err'])) {
echo "<p style='color:red;'>".$_SESSION['err']."</p>";
unset($_SESSION['err']);
	# code...
}
  ?>
<form method="post" action="edit.php?profile_id=".$_GET['profile_id']">
<p>First Name:
<input type="text" name="first_name" size="60"
value="<?= $row['first_name']?>"/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"
value="<?= $row['last_name']?>"/></p>
<p>Email:
<input type="text" name="email" size="30"
value="<?= $row['email']?>"/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"
value="<?= $row['headline']?>"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80">
<?= $row['summary']?></textarea>
<p>
<input type="hidden" name="profile_id" value="<?= $_GET['profile_id']?>" />
<input type="submit" name="save" value="Save">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
