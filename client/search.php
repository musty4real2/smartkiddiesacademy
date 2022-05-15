<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gilgal Health Resource Centre</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>


<body>
<div id="wrapper">
<div id="head">
<img src="../images/HEAD.jpg" width="1200" height="115" />
</div>


<div id="body">
<fieldset>

<h1 class="h1"><a href="client/search.php" title="search for a client"><img src="../images/search voter.gif" alt="" width="66" height="64" /></a>Search for Client in the Database</h1>




<div class="searchdiv">







<fieldset style="color:#a9aaab;">
<legend>Search by DATE OF REGISTRATION</legend>
<form  method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="searchtab"  border="0" width="700" style="text-align:center;">
    <tr>
          <td>Date of registration:</td>
        <td><label>
        
    DD <select name="day"><?php 
					echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
</label>
     MM:
<select name="month">    
       <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>Select</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    YYYY:<select name="year">
    <?php  
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select></label>
</td>
   <td><input type="submit" value="SEARCH" name="searchd" class="but" />
    

    </tr>
  </table>
</form>
<?php
if($_GET['searchd']){
	
	$year=$_GET['year'];
	$month=$_GET['month'];
	$day=$_GET['day'];
	
	$date="$day-$month-$year";
	
	
	include("../db_connect.php");
	$sql="SELECT * 
FROM `registration` 
WHERE `date` LIKE '%$date%'";

	$result=mysql_query($sql);
	if(!$result){
		echo "could not fetch Cleint records from the database:".mysql_error();
		}
		if(mysql_num_rows($result)==0){
			echo("<center><p class='er'>No Match found. Client has not been registered</p></center>");
			}
			elseif(mysql_num_rows($result)!=0){
	?>
		  <center>  <h1 class="error">Result</h1></center>
          
            <table class="restable" border="0" style="text-align:center;" >
        <tr style="background-color:#0e9dcc; color:#FFF; font-family:Tahoma, Geneva, sans-serif;"> 
    <th>Name</th>
    <th>Condition</th>
    <th>Phone Number</th>
    <th>Reg no</th>
    <th>Date of Reg</th>
    <td></td>
    <td></td>
        </tr>
<?php 
	while ($row=mysql_fetch_array($result)){
   $name=$row['name'];
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background


 echo '<tr bgcolor="' . $bg . '">';  ?>
    <td><?php echo  $name?></td>
    <td><?php echo $row['condition'];?></td>
    <td><?php echo $row['pnum'];?></td>
    <td><?php echo $row['reg_no'];?></td>
    <td><?php echo $row['date'];?></td>
    <td><a  title="view record" href="<?php echo 'view_record.php?id='.$row['id'];?>"><img src="../images/search voter.gif" width="20" height="20" /></a></td>
    <td><a  title="edit record" href="<?php echo 'edit_record.php?id='.$row['id'];?>"><img src="../images/pen.gif" width="20" height="20" /></a></td>
  </tr>
<?php }}?>
</table>
<?php }?>
</fieldset>







<center><h1>OR</h1></center>



<fieldset style="color:#a9aaab;">
<legend>Search by NAME</legend>
<form  method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="searchtab" border="0">
    <tr>
      <td width="124">Type Client's Firstname or Surname:</td>
      <td width="515" align="center" valign="middle"><label>
        <input name="name" type="text" id="name" size="50" value="<?php  if ($_POST['name']){ echo $_POST['name'];}?>" />
      </label></td>
      <td width="139"><label>
        <input type="submit" name="search" id="search" value="SEARCH" class="but" />
      </label></td>
    </tr>
  </table>
</form>
<?php
if($_GET['search']){
	
	$name=$_GET['name'];
	include("../db_connect.php");
	$sql="SELECT * 
FROM `registration` 
WHERE name LIKE '%$name%'";

	$result=mysql_query($sql);
	if(!$result){
		echo "could not fetch Cleint records from the database:".mysql_error();
		}
		if(mysql_num_rows($result)==0){
			echo("<center><p class='er'>Mr/Mrs $name record is not in the Database. Client has not been registered</p></center>");
			}
		elseif(mysql_num_rows($result)!=0){
	?>
		  <center>  <h1 class="error">Result</h1></center>
          
            <table class="restable" border="0"  style="text-align:center;">
        <tr style="background-color:#0e9dcc; color:#FFF; font-family:Tahoma, Geneva, sans-serif;"> 
    <td>Name</td>
    <td>Condition</td>
    <td>Phone Number</td>
    <td>Reg no.</td>
    <td>Date of Reg</td>
    <td></td>
    <td></td>
        </tr>
<?php 
	while ($row=mysql_fetch_array($result)){
   $name=$row['name'];
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background


 echo '<tr bgcolor="' . $bg . '">';  ?>
    <td><?php echo  $name?></td>
    <td><?php echo $row['condition'];?></td>
    <td><?php echo $row['pnum'];?></td>
    <td><?php echo $row['reg_no'];?></td>
    <td><?php echo $row['date'];?></td>
    <td><a  title="view record" href="<?php echo 'view_record.php?id='.$row['id'];?>"><img src="../images/search voter.gif" width="20" height="20" /></a></td>
    <td><a  title="edit record" href="<?php echo 'edit_record.php?id='.$row['id'];?>"><img src="../images/pen.gif" width="20" height="20" /></a></td>
  </tr>
<?php }}?>
</table>
<?php } ?>
</fieldset>

<center><a href="registration.php" title="register new client"><img src="images/add_voters.gif" width="47" height="47" /></a>		 <a href="index.php" title="go home"><img src="images/home.gif" width="47" height="48" /></a></center>
</div>
</div>

<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>


</body>
</html>