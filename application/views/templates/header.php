<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to Working Capital Evaluation System</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('styles/w3.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('styles/kpi_styles.css')?>">
	<script type="text/javascript" src="<?=base_url('scripts/jquery.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('scripts/kpi_script.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div class="w3-bar w3-blue">
	<a href="<?=base_url('index.php/MainUser')?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">home</i></a>
	<a href="#" onclick="document.getElementById('idAbout').style.display='block'" class="w3-bar-item w3-button">เกี่ยวกับเว็บไซต์</a>
	<a href="#" onclick="document.getElementById('idContact').style.display='block'" class="w3-bar-item w3-button">ติดต่อเรา</a>
	<?php if(isset($_SESSION['s_user_logged_in']) && isset($_SESSION['s_user_type']) == 1){ ?>
	<div class="w3-dropdown-hover">
	  <a href="#" class="w3-bar-item w3-button">ข้อมูลหลัก</a>
	  <div class="w3-dropdown-content w3-bar-block w3-blue" style="top:38px;">
		<a href="<?=base_url('index.php/ManageUser/getUser')?>" class="w3-bar-item w3-button">ข้อมูลผู้ใช้งาน</a>
		<a href="<?=base_url('index.php/ManageCriterion/getCriterion')?>" class="w3-bar-item w3-button">ข้อมูลเกณฑ์การประเมิน</a>
		<a href="<?=base_url('index.php/ManageCapitalType/getCapitalType')?>" class="w3-bar-item w3-button">ข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน</a>
		<a href="<?=base_url('index.php/ManageCokpi/getCokpi')?>" class="w3-bar-item w3-button">ข้อมูลตัวชี้วัด</a>
		<a href="<?=base_url('index.php/ManageCokpi/getSubkpi')?>" class="w3-bar-item w3-button">ข้อมูลตัวชี้วัดย่อย</a>
		<a href="<?=base_url('index.php/ManageCokpi/getSubissue')?>" class="w3-bar-item w3-button">ข้อมูลประเด็นย่อยที่ใช้พิจารณา</a>
		<a href="<?=base_url('index.php/ManageGrade/getGrade')?>" class="w3-bar-item w3-button">ข้อมูลระดับคะแนน (ตัวชี้วัดย่อย)</a>
	  </div>
	</div>
	<?php } ?>
	<?php if(isset($_SESSION['s_user_logged_in'])){ ?>
	<div class="w3-dropdown-hover w3-right">
	  <button class="w3-button"><i class="material-icons">person</i></button>
	  <div class="w3-dropdown-content w3-bar-block w3-blue" style="right:0"><?php $uid = $_SESSION['s_user_id']; ?>
	    <a href="<?=base_url('index.php/ManageUser/getUserDetail/').$uid?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">settings</i> ข้อมูลผู้ใช้</a>
	    <a href="<?=base_url('index.php/ManageUser/changePassword')?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">vpn_key</i> เปลี่ยนรหัสผ่าน</a>
	    <a href="<?=base_url('index.php/User/logout')?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">exit_to_app</i> ออกจากระบบ</a>
	  </div>
	</div>
	<?php } ?>
</div>

<div style="text-align:center;">
<?php
	$image_prop = array(
          'src' => 'images/kpi_banner_v2.0.png',
          'alt' => 'KPI Management System',
          'style' => 'width:100%'
	);
	echo img($image_prop);
?>
</div>

		  <div id="idAbout" class="w3-modal" style="display:none;">
		    <div class="w3-modal-content w3-card-4">
		      <header class="w3-container w3-blue">
		        <h2>เกี่ยวกับเว็บไซต์:</h2>
		      </header>
		      <div class="w3-container">
		        <p>
		        	ระบบประเมินผลการดำเนินงานกองทุนหมุนเวียน<br>
		        	Working Capital Evaluation System
		        </p>
		      </div>
		      <footer class="w3-container w3-blue w3-center">
		        <button class="w3-btn w3-grey" onclick="document.getElementById('idAbout').style.display='none'">ปิดหน้าต่าง</button>
		      </footer>
		    </div>
		  </div>

		  <div id="idContact" class="w3-modal" style="display:none;">
		    <div class="w3-modal-content w3-card-4">
		      <header class="w3-container w3-blue">
		        <h2>ติดต่อเรา:</h2>
		      </header>
		      <div class="w3-container">
		        <p>
		        	สำนักงานเลขานุการกองทุนพัฒนาเทคโนโลยีเพื่อการศึกษา<br>
		        	319 ถ.ราชดำเนินนอก วังจันทรเกษม แขวงดุสิต เขตดุสิตกทม. 10300
		        </p>
		        <p>
		        	เยี่ยมชมเว็บไซต์ <a href="http://edf.moe.go.th/edtechweb/" target="_blank" class="w3-btn w3-blue">คลิกที่นี่</a>
		    	</p>
		      </div>
		      <footer class="w3-container w3-blue w3-center">
		        <button class="w3-btn w3-grey" onclick="document.getElementById('idContact').style.display='none'">ปิดหน้าต่าง</button>
		      </footer>
		    </div>
		  </div>