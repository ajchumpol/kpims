<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			  <h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainCriterion')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลเกณฑ์การประเมิน</h3>
			  <table class="w3-table">
			  	<tr>
			  		<td colspan="4" style="padding:0px;margin:0px;">
					<?=form_open("ManageCriterion/getCriterion", "autocomplete='off'")?>
					  <input class="w3-input w3-border w3-left" style="width:300px;" type="text" name="i_key" placeholder="ค้นหาเกณฑ์การประเมิน">
					  <button class="w3-button w3-blue">ค้นหา</button>
					</form>
			  		</td>
			  		<td colspan="3" style="padding:0px;margin:0px;"><button onclick="document.getElementById('id03').style.display='block'" class="w3-button w3-blue w3-right">+</button></td>
			  	</tr>
			  </table>
			  <table class="w3-table-all w3-border">
			    <tr class="w3-blue">
			      <th class="w3-center">ที่</th>
			      <th class="w3-center">เกณฑ์ประเมินผลฯ</th>
			      <th class="w3-center">น้ำหนัก (%)</th>
			      <th class="w3-center" colspan="2">แนวทางการกำหนดตัวชี้วัด</th>
			      <th class="w3-center">แก้ไข</th>
			      <th class="w3-center">ลบ</th>
			    </tr>
				<?php
					// convert object to array
					$user_arr = json_decode(json_encode($user_obj), True);
					$i_ord = 1;
					for ($i_no = 0; $i_no < count($user_arr); $i_no++):
				?>
			    <tr>
			      <td><?=($i_ord++)?></td>
			      <td><?=$user_arr[$i_no]['user_name']?></td>
			      <td><?=$user_arr[$i_no]['user_email']?></td>
			      <td class="w3-center"><?=$user_arr[$i_no]['user_create']?></td>
			      <td class="w3-center"><a href="getUserDetail/<?=$user_arr[$i_no]['user_id']?>"><i class="material-icons" style="vertical-align:middle;">assignment_ind</i></a></td>
			      <td class="w3-center"><a href="updateUser/<?=$user_arr[$i_no]['user_id']?>"><i class="material-icons" style="vertical-align:middle;">edit</i></a></td>
			      <?php if($user_arr[$i_no]['type_id']==1 && $user_arr[$i_no]['user_name']=="Administrator"): ?>
			      	<td class="w3-center">-</td>
			  	  <?php else: ?>
			      	<td class="w3-center"><a href="deleting/<?=$user_arr[$i_no]['user_id']?>" onclick="return confirmation('กรุณายืนยันเพื่อลบข้อมูลผู้ใช้?')"><i class="material-icons" style="vertical-align:middle;">delete</i></a></td>
			  	  <?php endif; ?>
			    </tr>
				<?php
					endfor;

					if($i_no==0):
				?>
				<tr>
			      <td colspan="7" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
			  	</tr>
				<?php endif; ?>
			    <tr>
			      <th colspan="3">
					  <?php
					  	if (isset($user_pg)) {
                    		echo $user_pg;
                		}
					  ?>
			      </th>
			      <th colspan="4" style="text-align:right;">ทั้งหมด <?=count($user_arr)?> ระเบียน</th>
			    </tr>
  			</table>
  			<br>
		</td>
	</tr>
	</table>
		
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

	  <div id="id03" class="w3-modal">
		<div class="w3-modal-content">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('id03').style.display='none'" 
			class="w3-button w3-display-topright">&times;</span>
			<h3>เพิ่มข้อมูลเกณฑ์การประเมิน</h3>
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
			echo form_open('ManageCriterion/adding', $attributes);
			?>
			<table class="w3-table">
			<tr>
			<td><b>ชื่อ-สกุล</b></td>
			<td><input class="w3-input w3-border" type="text" name="i_flname"></td>
			</tr>
			<tr>
			<td><b>ชื่อผู้ใช้งาน<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" id="i_username" name="i_username" onkeyup="return validateUsername()" required></td>
			</tr>
			<tr>
			<td><b>อีเมล<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="email" id="i_email" name="i_email" onkeyup="return validateEmail()" required></td>
			</tr>
			<tr>
			<td><b>รหัสผ่าน<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="password" id="i_password" name="i_password" onkeyup="return validatePassword()" required></td>
			</tr>
			<tr>
			<td><b>ยืนยันรหัสผ่าน<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="password" id="i_confirm_password" onkeyup="return validatePassword()" required></td>
			</tr>
			<tr>
			<td><b>ประเภทผู้ใช้งาน<span style="color:#FF0000;">*</span></b></td>
			<td>
			<?php
				// convert object to array
				$user_type_arr = json_decode(json_encode($user_type_obj), True);
				for ($t_no = 0; $t_no < count($user_type_arr); $t_no++):
			?>
			<input class="w3-radio" type="radio" name="i_type" value="<?=$user_type_arr[$t_no]['type_id']?>" required>
			<label><?=$user_type_arr[$t_no]['type_name']?></label>
			<?php endfor; ?></td></tr>
			<tr>
			<td><b>ที่อยู่</b></td>
			<td><textarea rows="3" cols="50" class="w3-input w3-border" name="i_address"></textarea></td>
			</tr>
			<tr>
			<td><b>วัน/เดือน/ปี เกิด</b></td>
			<td><input class="w3-input w3-border" type="date" name="i_birthday"></td>
			</tr>
			<tr>
			<td colspan="2"><button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return validateCriterion('กรุณายืนยันข้อมูลก่อนกดปุ่มบันทึก?');">บันทึก</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<button type="button" onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-red">ยกเลิก</button>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
		</div>
	  </div>
