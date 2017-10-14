<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> หน้าหลักผู้ใช้งาน</h3>
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
			<h3>แก้ไขข้อมูลผู้ใช้งาน</h3>
		  </header>
		  <div class="w3-container">
			<!-- form class="w3-container" -->
			<?php
			$attributes = array(
				'class' => 'w3-container', 
				'id' => 'addform', 
				'method' => 'post', 
				'autocomplete' => 'off'
			);
			echo form_open('ManageUser/updatingUser', $attributes);
			?>
			<table class="w3-table">
			<tr>
			<td><b>ชื่อ-สกุล</b></td>
			<td><input class="w3-input w3-border" type="text" name="i_flname" value="<?=$user_flname?>">
				<input class="w3-input w3-border" type="hidden" name="i_userid" value="<?=$user_id?>"></td>
			</tr>
			<tr>
			<td><b>ชื่อผู้ใช้งาน<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border w3-grey" type="text" id="i_username" name="i_username" onchange="validateUsername()" value="<?=$user_name?>" readonly required></td>
			</tr>
			<tr>
			<td><b>อีเมล<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="email" id="i_email" name="i_email" onchange="validateEmail()" value="<?=$user_email?>" required></td>
			</tr>
			<tr>
			<td><b>ประเภทผู้ใช้งาน<span style="color:#FF0000;">*</span></b></td>
			<td>
			<?php
				$n_user_bd = date_create($user_bd);

				// convert object to array
				$user_type_arr = json_decode(json_encode($user_type_obj), True);
				for ($t_no = 0; $t_no < count($user_type_arr); $t_no++):
					$chkStr = "";
					if($user_type_arr[$t_no]['type_id'] == $type_id):
						$chkStr = "checked";
					endif;
			?>
			<input class="w3-radio w3-grey" type="radio" name="i_type" value="<?=$user_type_arr[$t_no]['type_id']?>" <?=$chkStr?> disabled="disabled" required>
			<label><?=$user_type_arr[$t_no]['type_name']?></label>
			<?php endfor; ?></td></tr>
			<tr>
			<td><b>ที่อยู่</b></td>
			<td><textarea rows="3" cols="50" class="w3-input w3-border" name="i_address"><?=$user_address?></textarea></td>
			</tr>
			<tr>
			<td><b>วัน/เดือน/ปี เกิด</b></td>
			<td><input class="w3-input w3-border" type="date" name="i_birthday" value="<?=date_format($n_user_bd, 'Y-m-d');?>"></td>
			</tr>
			<tr>
			<td colspan="2"><button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return validateUpdateUser('กรุณายืนยันการแก้ไขข้อมูล?');">แก้ไข</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<a href="<?=base_url('index.php/MainUser')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
