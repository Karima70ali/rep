<?php
require_once("../../includes/intialize.php");



if($session->is_logged_in()){
	redirect_to("home.php");
}
$message="";
if(isset($_POST['submit'])){


 $username=trim($_POST['username']);
 $password=trim($_POST['password']);
	
	$found_user=User::attempt_login($username,$password);
	if($found_user){
		$session->login($found_user);
	log_action('login',"{$found_user["first_name"]} logged in ");
		redirect_to("home.php");
	}
	else
	{
		
		$message="incorect username and password";
	}
	
}
else
{
	$username="";
	$password="";
}

?>





<html >
 <head>
 <title>login</title>
 <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css"/>

 </head>
<body>
<div id="header">
<h1>login page </h1>
</div>
<div id="main">


		<h2>Staff Login</h2>
		<?php echo output_message($message); ?>

		<form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
		</div>
		
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Karima Ali</div>
  </body>
</html>
<?php if(isset($database)){$database->close_connection();} ?>
