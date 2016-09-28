<?php
require_once("../../includes/intialize.php");
?>
<?php
// define variables and set to empty values
$firstNameErr = $lastNameErr = $passwordErr=$re_passwordErr = $emailErr = "";
$firstName = $lastName = $password=$re_password = $email = "";
$errors=array();
if(isset($_POST['submit'])){
  if (empty($_POST["firstName"])) {
    $errors['firstName']=$firstNameErr = "first Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
     $errors['firstName']= $firstNameErr = "Only letters and white space allowed"; 
    }
  }
  
    if (empty($_POST["lastName"])) {
   $errors['lastName']= $lastNameErr = "first Name is required";
  } else {
    $lastName = test_input($_POST["lastName"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
      $errors['lastName']=$lastNameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $errors['email']=$emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email']=$emailErr = "Invalid email format"; 
    }
  }
    
	
	    if (empty($_POST["password"])) {
   $errors['password']= $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
    
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/",$password)) {
    $errors['password']=  $passwordErr = "the password does not meet the requirements!"; 
    }
  }
  //"#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#"
  
	    if (empty($_POST["re_password"])) {
   $errors['re_password']= $re_passwordErr = "password is required";
  }
  else  if($_POST["re_password"]!= $_POST["password"]){
	$errors['re_password']= $re_passwordErr = "password is not match !!";  
  }
  else{
	   $re_password = test_input($_POST["re_password"]);
  }
    
  
  
  $user=new User();

$message="";
if(!$errors){
 
	
	$fields_required =array("firstName","lastName","email","password","re_password");
	validate_presences($fields_required);
	
	$fields_with_max_length = array("firstName" =>10,"lastName" =>10,"email" =>20,"password"=>16,"re_password" =>16);
	
	validate_max_lengths($fields_with_max_length);
	
	$enc_password=password_encrypt($password);
	$enc_repassword=password_encrypt($re_password);
	$confirmed_code=rand();
	
	$user->first_name=$firstName;
	$user->last_name=$lastName;
	$user->Email=$email;
	$user->password=$enc_password;
	$user->repassword=$enc_repassword;
	$user->confirmed=0;
	$user->confirmed_code=$confirmed_code;
	

		if($user->create()){
		$message="u have inserted ";		
		}

		
}


}
?>



<?php
/* /* $user=new User();

$message="";
if(!$errors){
 
	
	$fields_required =array("firstName","lastName","email","password","re_password");
	validate_presences($fields_required);
	
	$fields_with_max_length = array("firstName" =>10,"lastName" =>10,"email" =>20,"password"=>16,"re_password" =>16);
	
	validate_max_lengths($fields_with_max_length);
	
	$enc_password=md5($password);
	$enc_repassword=md5($re_password);
	$confirmed_code=rand();
	
	$user->first_name=$firstName;
	$user->last_name=$lastName;
	$user->email=$email;
	$user->password=$enc_password;
	$user->repassword=$re_password;
	$user->confirmed=0;
	$user->confirmed_code=$confirmed_code;
	

		if($user->create()){
		$message="u have inserted ";		
		}
		
/* 		$to= $email; // Send email to our user
		
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$firstName.'
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
http://www.abell12.com/registration/public/user_register/confirmMail.php?firstName=$firstName&code=$confirmed_code
 
'; // Our message above including the link
                     
$headers = 'From:noreply@abell12.com' . "\r\n"; // Set from headers
mail($email, $subject, $message, $headers); // Send our email
	 */
	
       
		//$message="u can't inserted client";	
			
		

/* }
else
{
	echo "errors";
}
  */
?>



<html >
 <head>
 <title>register</title>
 <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css"/>
<style>
.error {color: #FF0000;}
</style>
 </head>
<body>
<div id="header">
<h1>register page </h1>
</div>
<div id="main">

<h2>register page</h2>
<p><span class="error">* required field.</span></p>
<?php echo output_message($message); ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>">
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
   Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>">
  <span class="error">* <?php echo $lastNameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">*<?php echo $passwordErr;?></span></br>
  
  <br><br>
    re_password: <input type="password" name="re_password" value="<?php echo $re_password;?>">
  <span class="error">*<?php echo $re_passwordErr;?></span>
  <br><br>
   
  <input type="submit" name="submit" value="Submit"/>  

</form>
	</div>
		
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Karima Ali</div>
  </body>
</html>
<?php if(isset($database)){$database->close_connection();} ?>