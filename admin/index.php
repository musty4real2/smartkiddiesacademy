<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

//redirect to setup if system not setup!!!!
$getit=$object->query("SELECT * FROM `companysetup`");
if(mysql_num_rows($getit)==0){
	//redirect
	header("location:../setup/executive+login.php");
	}
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
<div id="head">
<?php $object->head("logo"); ?></div>
<div id="body">
<fieldset style="margin-top:50px;">
<?php   
          if ($_POST['login']){
		  $username=$_POST['username'];
		  $password=$_POST['password'];
		  
		  $fetch=$object->query("SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'");
		  
		  //if user exist
		  if(mysql_num_rows($fetch)!=0){
			
			//inside this block means user exists
			
			//fetch user details from dbase query
			while($row=mysql_fetch_array($fetch)){
				$uname=$row['username'];
				$pword=$row['password'];
				$dept=$row['dept'];
			
			
			
//***********************************************************************************************************************				
			//Now check using username and department to redirect this user
			if($dept=='admin'){
				//create session
				$_SESSION['admin']=1;
				//redirect
				header("location:menu.php");
				
			}//IF department
			

			
//***********************************************************************************************************************			
			
			
				}//while  
			  
		  }//if LOGIN
		  
		  if(strlen($username)==0){
		  echo "<p class=\"error\">Sorry, no Username specified</p>";
		  }
		  if(strlen($password)==0){
		  echo "<p class=\"error\">Sorry,no Password specified</p>";
		  }
		  
	
}

 
?>
<center><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
   <fieldset>
  <div id="bar"><h3>Login here</h3></div>

        <table border="0" width="398" height="255px">
        <tr><td>&nbsp;</td></tr>
        	<tr>
            	<td height="37" ><p>Username:</p></label></td>
              <td ><input class="abs" id="input" type="text" size="40" maxlength="15" width="30" name="username" autosuggest="off"/></td>
            </tr>
            <tr>
            	<td height="36"><p>Password:</p></td>
              <td><input id="input" class="abs" type="password" size="40" maxlength="15" name="password" /></td>
            </tr>
            <tr>
            	<td><label></label></td>
               
                <td align="justify"><input id="button" type="submit" value="Login" name="login"  /></td>
            </tr>
        </table>
  </fieldset>

	</form></center>
</fieldset>
</div>
</div>
<center><p>&copy;<?php echo date("Y");?>. All Rights Reserved. </p></center>


</body>
</html>