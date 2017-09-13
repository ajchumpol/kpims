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
	<a href="#" class="w3-bar-item w3-button">เกี่ยวกับเว็บไซต์</a>
	<a href="#" class="w3-bar-item w3-button">ติดต่อเรา</a>
	<?php if(isset($_SESSION['s_user_logged_in']) && isset($_SESSION['s_user_type']) == 1){ ?>
	<div class="w3-dropdown-hover">
	  <a href="#" class="w3-bar-item w3-button">ข้อมูลหลัก</a>
	  <div class="w3-dropdown-content w3-bar-block w3-blue" style="top:38px;">
		<a href="<?=base_url('index.php/ManageUser/getUser')?>" class="w3-bar-item w3-button">ข้อมูลผู้ใช้งาน</a>
		<a href="#" class="w3-bar-item w3-button">ข้อมูลเกณฑ์การประเมิน</a>
		<a href="#" class="w3-bar-item w3-button">ข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน</a>
		<a href="#" class="w3-bar-item w3-button">ข้อมูลหน่วยตัวชี้วัด</a>
		<a href="#" class="w3-bar-item w3-button">ข้อมูลน้ำหนักตัวชี้วัด</a>
		<a href="#" class="w3-bar-item w3-button">ข้อมูลระดับคะแนน (ตัวชี้วัดย่อย)</a>
	  </div>
	</div>
	<?php } ?>
	<?php if(isset($_SESSION['s_user_logged_in'])){ ?>
	<div class="w3-dropdown-hover w3-right">
	  <button class="w3-button"><i class="material-icons">person</i></button>
	  <div class="w3-dropdown-content w3-bar-block w3-blue" style="right:0"><?php $uid = $_SESSION['s_user_id']; ?>
	    <a href="<?=base_url('index.php/ManageUser/getUserDetail/').$uid?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">settings</i> ข้อมูลผู้ใช้</a>
	    <a href="#" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">vpn_key</i> เปลี่ยนรหัสผ่าน</a>
	    <a href="<?=base_url('index.php/User/logout')?>" class="w3-bar-item w3-button"><i class="material-icons" style="vertical-align:middle;">exit_to_app</i> ออกจากระบบ</a>
	  </div>
	</div>
	<?php } ?>
</div>

<div style="text-align:center;">
<?php
	$image_prop = array(
          'src' => 'images/kpi_banner.png',
          'alt' => 'KPI Management System',
          'style' => 'width:100%'
	);
	echo img($image_prop);
?>
</div>