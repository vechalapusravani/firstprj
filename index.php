<?php 
SESSION_START();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include ('Chat.php');
	$chat = new Chat();
	$user = $chat->loginUsers($_POST['username'], $_POST['pwd']);	
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		$_SESSION['userid'] = $user[0]['userid'];
		$chat->updateUserOnline($user[0]['userid'], 1);
		$lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
		$_SESSION['login_details_id'] = $lastInsertId;
		header("Location:index1.php");
	} else {
		$loginError = "Invalid username or password!";
	}
}

?>
<title>Online Chat</title>
<?php include('container.php');?>

<div class="container">		
	<h2 class="log_hed">Login</h1>		
	<div class="row">
		<div class="col-md-4">		
			<form method="post" class="login_frm">
				<div class="form-group">
				<?php if ($loginError ) { ?>
					<div class="alert alert-warning"><?php echo $loginError; ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">User:</label>
					<input type="username" class="form-control" name="username" required>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" required>
				</div>  
				<button type="submit" name="login" class="btn btn-info">Login</button>
			</form>
			<br>
			
		</div>
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
			<div>
				<img src="userpics/chatimage.png" >

			</div>
		</div>
		
	</div>
</div>	
<?php include('footer.php');?>

<style type="text/css">
form.login_frm{
  color: white;
}
.log_hed{
   color: yellow;
    font-weight: 700;
}


</style>






