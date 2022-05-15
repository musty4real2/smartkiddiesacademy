<?php
class hms{
public $table;
public $id;
public $date;
public $month;
public $year;
public $roomid;
public $personid;

/**************************************************************************************/
				public function getTotal($c,$d){
	$this->c=$c;
	$this->d=$d;
	$fetchcat=$this->query("SElECT `total` FROM `ca` WHERE `subject_id`='{$this->c}' AND `student_id`='{$this->d}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['total'];
		}//while
		//$object->getCat(1)======= Luxury
	}
/**************************************Quuery method*****************************************************************************/
	/**************************************************************************************/
				public function getAvg($c,$d){
	$this->c=$c;
	$this->d=$d;
	$fetchcat=$this->query("SElECT `average` FROM `ca` WHERE `subject_id`='{$this->c}' AND `student_id`='{$this->d}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['average'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	/**************************************************************/
	public function getRemark($c,$d){
	$this->c=$c;
	$this->d=$d;
	$fetchcat=$this->query("SElECT `remark` FROM `ca` WHERE `subject_id`='{$this->c}' AND `student_id`='{$this->d}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['remark'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	/**************************************************************/
		/**************************************************************************************/
				public function getGrade($c,$d){
	$this->c=$c;
	$this->d=$d;
	$fetchcat=$this->query("SElECT `grade` FROM `ca` WHERE `subject_id`='{$this->c}' AND `student_id`='{$this->d}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['grade'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	/**************************************************************/
					public function getClass($catid){
	$this->catid=$catid;
	$fetchcat=$this->query("SElECT `class_name` FROM `class` WHERE `id`='{$this->catid}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['class_name'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	
					public function getStudent($catid){
	$this->catid=$catid;
	$fetchcat=$this->query("SElECT `child_name` FROM `registration` WHERE `id`='{$this->catid}'");
	while($row=mysql_fetch_array($fetchcat)){
		return $row['child_name'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	
	public function fetchAllWhere($table, $field, $value){
		$this->table=$table;
		$this->field=$field;
		$this->value=$value;
		$ex=$this->query("SELECT * FROM `{$this->table}` WHERE `{$this->field}`='{$this->value}'");
		return $ex;
		}
		public function fetchAllRecord($table){
		$this->table=$table;
		$exe=$this->query("SELECT * FROM `{$this->table}`");
		return $exe;
		}	 
		public function query($string){
	$this->string=$string;
	$l=@mysql_query($this->string) or die(mysql_error());
	return $l;
	
}
	public function currentDate(){
		return date('d-m-Y');
		}


/***************************************************End Quuery method************************************************************************/
public function count3(){
				$count=$this->query("SELECT COUNT(*) AS `total` FROM `registration` WHERE `treated`='0'");
				
				while ($row=mysql_fetch_array($count)){
				return $row['total'];
				}
				}
				
				public function countSubject($ct){
					$this->ct=$ct;
				$count=$this->query("SELECT COUNT(*) AS `total` FROM `subjects` WHERE `subject_class_id`='{$this->ct}'");
				
				while ($row=mysql_fetch_array($count)){
				return $row['total'];
				}
				}
/***************************************************guest type************************************************************************/
public function selectGuestType($table, $id){
	
	$this->table=$table;
	$this->id=$id;
	$guest=$this->query("SElECT `guesttype` FROM `{$this->table}` WHERE `id`='{$this->id}'");
	return $guest;
}
	
	
/***************************************************end of guest type************************************************************************/
	
/***************************************************returnCloth function************************************************************************/
public function returnCloth($table, $id){
			$this->table=$table;
			$this->id=$id;
	$return=$this->query("UPDATE `{$this->table}` SET `return` = '1'  WHERE `id` ='{$this->id}'");
						 return $return;
}

/*********************************************end of returnCloth function************************************************************************/
	
	/**************************************************************************FETCH ALL*********************************************************/
	public function fetchGuestLaundryRecord($table, $id){
	
	$this->table=$table;
	$this->id=$id;
	$record=$this->query("SElECT * FROM `{$this->table}` WHERE `id`='{$this->id}'");
	return $record;
}
/*************************************************************FETCH ALL datas where date *********************************************************/

	public function fetchRecordByDate($table, $date){
	
	$this->table=$table;
	$this->date=$date;
	$fetchdate=$this->query("SElECT * FROM `{$this->table}` WHERE `entrydate`='{$this->date}'");
	return $fetchdate;
}

/**************************************************************************END FETCH ALL*********************************************************/
/*******************************************************FETCH ALL datas where month *********************************************************/


	public function fetchRecordByMonth($table, $month){
	
	$this->table=$table;
	$this->month=$month;
	$fetchmonth=$this->query("SElECT * FROM `{$this->table}` WHERE MONTH(`entrydate`)='{$this->month}'");
	return $fetchmonth;
}
/*********************************************************************END FETCH ALL* Month********************************************************/
/*******************************************************FETCH ALL datas where year *********************************************************/


	public function fetchRecordByYear($table, $year){
	
	$this->table=$table;
	$this->year=$year;
	$fetchyear=$this->query("SElECT * FROM `{$this->table}` WHERE YEAR(`entrydate`)='{$this->year}'");
	return $fetchyear;
}
/***************************************************END FETCH ALL* Month********************************************************/



	public function getRoomCat($roomid){
	
	$this->roomid=$roomid;
	$fetchcat=$this->query("SElECT `room_category` FROM `rooms` WHERE `id`='{$this->roomid}'");
	
	while($row=mysql_fetch_array($fetchcat)){
		return $row['room_category'];
		}//while 
		//$object->getCat(1)======= Luxury
	}
/***************************************************END FETCH ALL*h********************************************************/
/***************************************************END FETCH ALL*********************************************************/
		public function getRoomCost($roomid){
	
	$this->roomid=$roomid;
	$fetchroomcost=$this->query("SElECT `cost` FROM `rooms` WHERE `id`='{$this->roomid}'");
	while($row=mysql_fetch_array($fetchroomcost)){
		return $row['cost'];
		}//while
		//$object->getCost()
/***************************************************END FETCH ALL*********************************************************/
	
		
	}	
			public function getRoomNumber($roomid){
	$this->roomid=$roomid;
	$fetchroomnumber=$this->query("SElECT `room_number` FROM `rooms` WHERE `id`='{$this->roomid}'");
	while($row=mysql_fetch_array($fetchroomnumber)){
		return $row['room_number'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	/***************************************************END FETCH ALL*********************************************************/

				public function getRoomLocation($roomid){
	$this->roomid=$roomid;
	$fetchroomlocation=$this->query("SElECT `room_location` FROM `rooms` WHERE `id`='{$this->roomid}'");
	while($row=mysql_fetch_array($fetchroomlocation)){
		return $row['room_location'];
		}//while
		//$object->getCat(1)======= Luxury
	}
	/****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
	public function getResturantDetailsByid($resid){
	
	$this->personid=$personid;
	$fetchcat=$this->query("SElECT `id` FROM `singleresturant` WHERE `id`='{$this->personid}'");
	
	while($row=mysql_fetch_array($fetchcat)){
		return $row['room_category'];
		}//while 
		//$object->getCat(1)======= Luxury
	}


	/*************************************************************************************************************************/
	/*************************************************************************************************************************/
	public function getGuestName($id){
		$this->id=$id;
		$query=$this->query("SELECT `surname`, `othername`, `title` FROM `single` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($query)){
			echo $row['surname']."  ". $row['othername']. " (".$row['title'].")";
			}//while
		}
	/*************************************************************************************************************************/
	
	public function getGuestName2($id){
		$this->id=$id;
		$query=$this->query("SELECT `companyname`,`surname`, `othername`, `title` FROM `group` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($query)){
			echo $row['companyname']." ". $row['surname']. "  ". $row['othername']. " (".$row['title'].")";
			}//while
		}	/*************************************************************************************************************************/
	public function getFoodname($id){
		$this->id=$id;
		$query=$this->query("SELECT `food_name` FROM `food` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($query)){
			echo $row['food_name'];
			}//while
		}
	/*************************************************************************************************************************/
	/*************************************************************************************************************************/
	public function getFoodCost($id){
		$this->id=$id;
		$query=$this->query("SELECT `cost` FROM `food` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($query)){
			return $row['cost'];
			}//while		
			}
	
	/*************************************************************************************************************************/
	/*************************************************************************************************************************/
	public function checkNumofRecord($query){
		$this->query=$query;
		if(mysql_num_rows($this->query)==0){ return false;}
		else { return true; }
		}
		
	/*************************************************************************************************************************/
		
		
		
		
		public function checkIfAccBal($id){
			$this->id=$id;
			
			$records=$this->query("SELECT * FROM `accountbalance` WHERE `guestid`='{$this->id}'");
			
			while($row=mysql_fetch_array($records)){
			$initial=$row['initial_deposit'];
			$total=$row['grand_total'];
			$balance=$row['balance'];
			$refund=$row['refund'];
						}

			if(abs($total-$initial) - abs($balance-$refund)==0){
				echo "<h2>BALANCED</h2>";
				}	
			if(abs($total-$initial) - abs($balance-$refund)!=0){
				echo "<h2>NOT BALANCED</h2>";
				}	
			
			}	/*************************************************************************************************************************/


		
		public function showcheckoutLink($id){
			$this->id=$id;
			
			$records=$this->query("SELECT * FROM `accountbalance` WHERE `guestid`='{$this->id}'");
			while($row=mysql_fetch_array($records)){
			$initial=$row['initial_deposit'];
			$total=$row['grand_total'];
			$balance=$row['balance'];
			$refund=$row['refund'];
						}

			if(abs($total-$initial) - abs($balance-$refund)==0){
				echo "<h2><a href='guest_record.php?id={$this->id}'>PROCEED TO CHECKOUT</a></h2>";
				}	
			if(abs($total-$initial) - abs($balance-$refund)!=0){
				echo "<h2>GUEST CANNOT CHECKOUT. ACCOUNT NOT BALANCED</h2>";
				}	
			
			}	/*************************************************************************************************************************/

	
		
		public function checkIfAccBal2($id){
			$this->id=$id;
			
			$records=$this->query("SELECT * FROM `groupaccountbalance` WHERE `guestid`='{$this->id}'");
			
			while($row=mysql_fetch_array($records)){
			$initial=$row['initial_deposit'];
			$total=$row['grand_total'];
			$balance=$row['balance'];
			$refund=$row['refund'];
						}

			if(abs($total-$initial) - abs($balance-$refund)==0){
				echo "<h2>BALANCED</h2>";
				}	
			if(abs($total-$initial) - abs($balance-$refund)!=0){
				echo "<h2>NOT BALANCED</h2>";
				}	
			
			}	/*************************************************************************************************************************/


		
		public function showcheckoutLink2($id){
			$this->id=$id;
			
			$records=$this->query("SELECT * FROM `groupaccountbalance` WHERE `guestid`='{$this->id}'");
			while($row=mysql_fetch_array($records)){
			$initial=$row['initial_deposit'];
			$total=$row['grand_total'];
			$balance=$row['balance'];
			$refund=$row['refund'];
						}

			if(abs($total-$initial) - abs($balance-$refund)==0){
				echo "<h2><a href='guest_record.php?id={$this->id}'>PROCEED TO CHECKOUT</a></h2>";
				}	
			if(abs($total-$initial) - abs($balance-$refund)!=0){
				echo "<h2>GUEST CANNOT CHECKOUT. ACCOUNT NOT BALANCED</h2>";
				}	
			
			}	


/**********************************************************************************************************/

		
		public function head($fpath){
			
			$c=$this->query("SELECT * FROM `companysetup`");
		while($row=mysql_fetch_array($c)){
		$logo=$row['logo'];
		$cname=$row['company'];
		}
		?>
		
		<span style="color:#fff; font-size:14px;">
        <center><img src="<?php echo "../$fpath/$logo";?>" width="1200" height="115" style="margin-top:2px;"/></center></span>

    
	
     	<?php
		}
			public function head2($fpath){
			
			$c=$this->query("SELECT * FROM `companysetup`");
		while($row=mysql_fetch_array($c)){
		$logo=$row['logo'];
		$cname=$row['company'];
		}
		?>
		
		<span style="color:#fff; font-size:14px;">
        <center><img src="<?php echo "$fpath/$logo";?>" width="501px" height="78px" style="margin-top:2px;"/></center></span>

    <?php
		/*******************************************************************************************************/
		
		
		}
		public function displayPhoto($photo, $folder, $scale){
		$this->photo=$photo;
		$this->folder=$folder;

		$this->scale=$scale;
	$pic=getimagesize("{$this->folder}/{$this->photo}");
	?>
  <img style="border:1px solid #999; padding:1px;"  class="pic" src="<?php echo "{$this->folder}/{$this->photo}";?>" 
   <?php echo $this->imageResize($pic[0], $pic[1], $this->scale);?> />
		
        <?php }
		//==============================================================================================================================/
//==============================================================================================================================/
	public function getPhoto($id){
		$this->id=$id;
		$fetch=$this->query("SELECT `photo` FROM `staffs` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($fetch)){
		return $row['photo'];	
		}
		}
//==============================================================================================================================/
//==============================================================================================================================/

	public function getStaffPhoto($id){
		$this->id=$id;
		$fetch=$this->query("SELECT `idcard` FROM `staffs` WHERE `id`='{$this->id}'");
		while($row=mysql_fetch_array($fetch)){
		return $row['idcard'];	
		}
		}
//==============================================================================================================================/
//==============================================================================================================================/
	/******************************imageResize*********************************************************************/

		
	public function imageResize($width, $height, $target){
		
		//takes the larger size of the width and height and applies the formular accordingly.. this is so this script will work dynamically with any size
		
		if($width>$height){
			$percentage = ($target/$width);
			}else {
				$percentage=($target / $height);
			}
			//gets the new value and applies the percentage, then rounds the values
			$width=round($width*$percentage);
			$height=round($height*$percentage);
			//returns the new sizes in html tag format... this is so you can plug this function inside an image tag and just get the 
			return "width=\"$width\" height=\"$height\"";
		
		}
	/******************************END*********************************************************************/


//==============================================================================================================================/
//==============================================================================================================================/

			public function footer($fpath){
			
			$c=$this->query("SELECT * FROM `companysetup`");
		while($row=mysql_fetch_array($c)){
		$cname=$row['company'];
		}
		?>
		
		<span style="color:#fff; font-size:14px;">
        <center>©Copyrights . All Rights reserved. <?php echo  $cname ?>.</center></span>

    <?php
		/*******************************************************************************************************/
		}
		
		}//end of hms

?>