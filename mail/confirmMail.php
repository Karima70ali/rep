<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">


<html lang="en">
	
<head>
		
<title>confirm mail</title>

	</head>

	<body>
	<?php
		$first_name=$_GET['firstName'];
		$code=$_GET['code'];
		$quey=mysqli_query("select * from regist_person where first_name={$first_name}");
		while($row=mysqli_fetch_array($query)){
			$db_code=$row['confirmed_code'];
		}
		if($code==$db_code){
			mysqli_query("update regist_person set confirmed =1");
			mysqli_query("update regist_person set confirmed_code =0");
		}
		else
		{
			echo "username  and code not match";
		}

?>
</body>

</html>