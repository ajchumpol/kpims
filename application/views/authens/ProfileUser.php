<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/authens/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> หน้าหลักผู้ใช้งาน</h3>
			<table class="w3-table-all w3-border">
		
			<?php
			if(isset($info)):
			?>
			  <div id="id01" class="w3-modal" style="display:block;">
			    <div class="w3-modal-content w3-card-4">
			      <header class="w3-container w3-green">
			        <h2>Information:</h2>
			      </header>
			      <div class="w3-container">
			        <p><?=$info?></p>
			      </div>
			      <footer class="w3-container w3-green w3-center">
			        <button onclick="document.getElementById('id01').style.display='none'">Close</button>
			      </footer>
			    </div>
			  </div>
			<?php endif; ?>
			<?php
			if(isset($error)):
			?>
			  <div id="id02" class="w3-modal" style="display:block;">
			    <div class="w3-modal-content w3-card-4">
			      <header class="w3-container w3-red">
			        <h3>Information:</h3>
			      </header>
			      <div class="w3-container">
			        <p><?=$error?></p>
			      </div>
			      <footer class="w3-container w3-red w3-center">
			        <button onclick="document.getElementById('id02').style.display='none'">Close</button>
			      </footer>
			    </div>
			  </div>
			<?php endif; ?>

		  <header class="w3-container w3-blue"> 
			<h3>รายละเอียดข้อมูลผู้ใช้งาน : รหัส <?=$user_id?></h3>
		  </header>
		  <div class="w3-container">
			<!-- form class="w3-container" -->
			<table class="w3-table-all w3-hoverable">
			<tr>
			<td rowspan="8" style="width:20%;">
			  <?php
				$image_prop = array(
			      'src' => $user_photo,
			      'alt' => $user_name,
			      'style' => 'width:100%;margin-bottom:15px;'
				);
			    echo img($image_prop);
			  ?>
			</td>
			<td style="width:15%;"><b>ชื่อ-สกุล</b></td><td><?=$user_flname?></td>
			</tr>
			<tr>
			<td><b>ชื่อผู้ใช้งาน</b></td><td><?=$user_name?></td>
			</tr>
			<tr>
			<td><b>อีเมล</b></td><td><?=$user_email?></td>
			</tr>
			<tr>
			<td><b>ประเภทผู้ใช้งาน</b></td>
			<td>
			<?php
				$n_user_bd = date_create($user_bd);
				echo $type_name;
			?></td></tr>
			<tr>
			<td><b>ที่อยู่</b></td>
			<td><?=$user_address?></td>
			</tr>
			<tr>
			<td><b>วัน/เดือน/ปี เกิด</b></td>
			<td><?=date_format($n_user_bd, 'Y-m-d');?></td>
			</tr>
			<tr>
			<td><b>วันที่สมัครสมาชิก</b></td>
			<td><?=$user_create?></td>
			</tr>
			<tr>
			<td><b>วันที่แก้ไขล่าสุด</b></td>
			<td><?=$user_edited?></td>
			</tr>
			<tr>
			<td colspan="3">
			<a href="<?=base_url('index.php/authens/MainUser')?>" class="w3-button w3-red">ย้อนกลับ</a>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
