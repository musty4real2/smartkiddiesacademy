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
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper">
<div id="head">
<?php $object->head("logo"); ?>
</div>


<div id="body">
<fieldset style="margin-top:0px;">


<h1 class="h1"><a  title="registered client" href="../admin/menu.php"><img src="../images/result2.gif" alt="" width="88" height="62" /></a>Generate Student(s) LIST </h1>
    <?php
if($_POST['enter']){
	include("connect.php");
	

$bank=$_POST['bank'];
$date=strtolower($bank);

			//VALIDATE
			if($date==""){$error[]="Select class to generate records for";}
									
	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){

/*********************** *****************************************************************************************************************
************************************************************************************************************************************************************/


header("location:addca.php?class=$date");

										}//END of IF NO VALIDATION ERROR EXIST
	}
	
?>
<br/>
<br/>
<p>&nbsp;</p>

<table width="70%" border="0" style="margin:auto;">
<form method="post"  action="<?php $_SERVER['PHP_SELF']; ?>" />
<tr><td><b>SELECT A CLASS:</b></td></tr>
  <tr>
    <td align="center" width="52%">
      <select name="bank" id="bank" class="input-text">
        <option value="">select</option>
        <option value="">---------</option>
        <?php
		
	  $ask="SELECT * FROM `class` ORDER BY `class_name` ASC";
	  if(!$ask=mysql_query($ask)){
		  echo "<option value=''>No Class available".mysql_error()."</option>";
		  }
		
		  while($row=mysql_fetch_array($ask)){
			  echo "<option value='{$row['id']}'>{$row['class_name']}</option>";
			  }
	  
	  ?>
        <?php if($_POST['class_name']){echo "<option  value='{$_POST['class_name']}' selected='selected'>{$_POST['class_name']}</option>"; }?>
      </select>      <br/></td>
    <td width="48%"><br/>
      <input  type="submit" name="enter" value="GENERATE LIST " onclick="return confirm('Do You Want To Go Ahead To Generate Records?');"/></td>
  </tr>
  <tr>
    <td><br/></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
 <td height="48">&nbsp;</td>

    <td>&nbsp;</td>



  </tr>
    </table>


</center>
</fieldset>
</div>
</div>
<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>

</body>
</html>