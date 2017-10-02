<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageCokpi/getSubkpi')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลผู้ตัวชี้วัดย่อย</h3>
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
			<a name="TOP"></a>
		  <header class="w3-container w3-pale-blue">
			<h4>เกณฑ์ประเมินผลฯ : <?=$cri_title?></h4>
			<h5><?=$cokpi_title?></h5>
		  </header>
		  <table class="w3-table">
			<tr class="w3-blue">
				<th class="w3-center">ตัวชี้วัดย่อย</th>
				<th class="w3-center">คำกำจัดความ</th>
				<th class="w3-center">หมายเหตุ</th>
				<th class="w3-center">ประเด็นย่อยฯ</th>
				<th class="w3-center">แก้ไข</th>
				<th class="w3-center">ลบ</th>
			</tr>
		  <?php
			// convert object to array
			$data_subkpi_arr = json_decode(json_encode($data_subkpi_obj), True);
			for ($j_no = 0; $j_no < count($data_subkpi_arr); $j_no++):
		  ?>
			<tr>
				<td><?=$data_subkpi_arr[$j_no]['subcokpi_title']?></td>
				<td><?=$data_subkpi_arr[$j_no]['subcokpi_def']?></td>
				<td><?=$data_subkpi_arr[$j_no]['subcokpi_comment']?></td>
				<td class="w3-center"><a href="#" onClick="onDev();"><i class="material-icons" style="vertical-align:middle;">description</i></a></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/updateSubkpi/').$data_subkpi_arr[$j_no]['subcokpi_id'].'/'.$cokpi_id.'/'.$cri_id?>#ADD"><i class="material-icons" style="vertical-align:middle;">edit</i></a></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/deletingSubkpi/').$data_subkpi_arr[$j_no]['subcokpi_id'].'/'.$cokpi_id.'/'.$cri_id?>" onclick="return confirmation('กรุณายืนยันเพื่อลบข้อมูลตัวชี้วัดย่อย ?')"><i class="material-icons" style="vertical-align:middle;">delete</i></a></td>
			</tr>
		  <?php
		  	endfor;
		  ?>
		  <?php
		  	if($j_no == 0):
		  ?>
			<tr>
			   <td colspan="6" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
			</tr>
			<?php endif; ?>
			<tr>
			   <th colspan="6" style="text-align:right;">ทั้งหมด <?=count($data_subkpi_arr)?> ระเบียน</th>
			</tr>
		  </table>

		  <a name="ADD"></a>
		  <header class="w3-container w3-blue">
			<h4>จัดการข้อมูลตัวชี้วัดย่อย</h4>
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

			$i_subkpi_id = "";
			$i_subkpi_title = "";
			$i_subkpi_def = "";
			$i_subkpi_comment = "";
			if(isset($data_method) == "UDP"):
				$i_subkpi_id = $subkpi_id;
				$i_subkpi_title = $subkpi_title;
				$i_subkpi_def = $subkpi_def;
				$i_subkpi_comment = $subkpi_comment;
				echo form_open('ManageCokpi/updatingSubkpi', $attributes);
			else:
				echo form_open('ManageCokpi/addingSubkpi', $attributes);
			endif;
			?>
			<table class="w3-table">
			<tr>
			<td><b>เกณฑ์ประเมินผลฯ</b></td>
			<td><input class="w3-input w3-border w3-grey" type="text" name="i_crititle" value="<?=$cri_title?>" readonly required>
				<input class="w3-input w3-border" type="hidden" name="i_cri_id" value="<?=$cri_id?>">
			</td>
			</tr>
			<tr>
			<td><b>ตัวชี้วัด</b></td>
			<td><input class="w3-input w3-border w3-grey" type="text" name="i_cokpi_title" value="<?=$cokpi_title?>" readonly required>
				<input class="w3-input w3-border" type="hidden" name="i_cokpi_id" value="<?=$cokpi_id?>">
			</td>
			</tr>
			<tr>
			<td><b>ตัวชี้วัดย่อย <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_subkpi_title" value="<?=$i_subkpi_title?>" required>
				<input class="w3-input w3-border" type="hidden" name="i_subkpi_id" value="<?=$i_subkpi_id?>" required>
			</td>
			</tr>
			<tr>
			<td><b>คำนิยาม</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_subkpi_def"><?=$i_subkpi_def?></textarea></td>
			</tr>
			<tr>
			<td><b>หมายเหตุ</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_subkpi_comment"><?=$i_subkpi_comment?></textarea></td>
			</tr>
			<tr>
			<td colspan="2">
			<?php if(isset($data_method) == "UDP"): ?>
				<button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนแก้ไข?');">แก้ไข</button>
				<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
				<a href="<?=base_url('index.php/ManageCokpi/addSubkpi/').$cri_id."/".$cokpi_id?>" class="w3-button w3-red">ย้อนกลับ</a>
			<?php else: ?>
				<button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนบันทึก?');">บันทึก</button>
				<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
				<a href="<?=base_url('index.php/ManageCokpi/getSubkpi')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<?php endif; ?>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
			
			<!-- button class="w3-btn w3-blue" onclick="topFunction()" id="myBtn" title="Go to top"><i class="material-icons" style="vertical-align:middle;">arrow_upward</i></button -->

		  </div>
		  <br>
