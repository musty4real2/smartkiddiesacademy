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


<h1 class="h1"><a  title="registered client" href="client/registered_clients.php"><img src="../images/result2.gif" alt="" width="88" height="62" /></a>Registered Student(s)</h1>
<center><p class="er">If Student's name is not found, implies that student has not been registered or PRESS F5</p></center>

  
  <?php
$display = 50;
 // Determine how many pages there are...
 if (isset($_GET['p']) && is_numeric($_GET
['p'])) { // Already been determined.

 $pages = $_GET['p'];
 } else { // Need to determine.

 // Count the number of records:
 $q = "SELECT * FROM `registration` WHERE `treated`='1'";
 $r = mysql_query ($q);
$records=mysql_num_rows($r);
if(!$r){echo " query problem";}
if(empty($r)){echo "empty query";}


 // Calculate the number of pages...
 if ($records > $display) { // More than
 $pages = ceil ($records/$display);
 } else {
$pages = 1;
 }
 }
if (isset($_GET['s']) && is_numeric
($_GET['s'])) {
 $start = $_GET['s'];
 } else {
 $start = 0;
 }


  $sql="SELECT * FROM `registration`  WHERE `treated`='1' ORDER BY `child_name` ASC LIMIT $start,$display";



	$result=mysql_query($sql);
	if(!$result){
		echo "could not fetch Cleint records from the database:".mysql_error();
		}
	echo mysql_num_rows($result)." registered clients";
	if(mysql_num_rows($result)!=0){
		?>
<table class="restable" border="0" b style="text-align:center;"> 
  <tr style="background-color:#0e9dcc; color:#FFF; font-family:Tahoma, Geneva, sans-serif;">
    <th>Child Name</td>
    <th>Date Phone Number</th>
    <th>Mum Phone Number</th>
    <td>Entry Date</td>
    <td></td>
  </tr>
<?php 
$bg = '#eeeeee';
	while ($row=mysql_fetch_array($result)){
  $name=$row['child_name'];
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background


 echo '<tr bgcolor="' . $bg . '">';  ?>
    <td><?php echo $name;?></td>
    <td><?php echo $row['dads_phone'];?></td>
    <td><?php echo $row['mums_phone'];?></td>
    <td><?php echo $row['entry_date'];?></td>
    <td><a  title="view record" href="<?php echo 'view_record.php?id='.$row['id'];?>"><img src="../images/search voter.gif" width="20" height="20" /></a></td>
    
  </tr>
  
<?php }
echo "</table><center><div>";
  }

if ($pages > 1) {
echo '<br /><p>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="registered_clients.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }


for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="registered_clients.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="registered_clients.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</p>'; // Close the paragraph.
 }
echo "</div></center>";


 





?>
</table>
</fieldset>
</div>
</div>
<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>

</body>
</html>