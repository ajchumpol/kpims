<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageCokpi/getCokpi')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลผู้ตัวชี้วัด</h3>
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
		  <header class="w3-container w3-blue">
			<h4>เกณฑ์ประเมินผล : <?=$cri_title?></h4>
		  </header>
		  <table class="w3-table">
			<tr class="w3-blue">
				<th class="w3-center">ตัวชี้วัด</th>
				<th class="w3-center">น้ำหนัก (%)</th>
				<th class="w3-center">แนวทางการกำหนดตัวชี้วัด</th>
				<th class="w3-center">ตัวชี้วัดย่อย</th>
				<th class="w3-center">แก้ไข</th>
				<th class="w3-center">ลบ</th>
			</tr>
		  <?php
			// convert object to array
			$data_cokpi_arr = json_decode(json_encode($data_cokpi_obj), True);
			for ($j_no = 0; $j_no < count($data_cokpi_arr); $j_no++):
		  ?>
			<tr>
				<td><?=$data_cokpi_arr[$j_no]['cokpi_title']?></td>
				<td class="w3-center"><?=$data_cokpi_arr[$j_no]['cokpi_wei']?></td>
				<td><?=$data_cokpi_arr[$j_no]['cokpi_app']?></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/addSubkpi/').$data_cokpi_arr[$j_no]['cri_id'].'/'.$data_cokpi_arr[$j_no]['cokpi_id']?>"><i class="material-icons" style="vertical-align:middle;">description</i></a></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/updateCokpi/').$data_cokpi_arr[$j_no]['cokpi_id'].'/'.$data_cokpi_arr[$j_no]['cri_id']?>#ADD"><i class="material-icons" style="vertical-align:middle;">edit</i></a></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/deleting/').$data_cokpi_arr[$j_no]['cokpi_id'].'/'.$data_cokpi_arr[$j_no]['cri_id']?>" onclick="return confirmation('กรุณายืนยันเพื่อลบข้อมูลตัวชี้วัด ?')"><i class="material-icons" style="vertical-align:middle;">delete</i></a></td>
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
			   <th colspan="6" style="text-align:right;">ทั้งหมด <?=count($data_cokpi_arr)?> ระเบียน</th>
			</tr>
		  </table>

			<a name="ADD"></a>
		  <header class="w3-container w3-blue">
			<h4>จัดการข้อมูลตัวชี้วัด</h4>
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

			$i_cokpi_id = "";
			$i_cokpi_title = "";
			$i_cokpi_wei = "";
			$i_cokpi_app = "";
			$i_unit1 = "";
			$i_unit2 = "";
			$i_cokpi_comment = "";
			if(isset($data_method) == "UDP"):
				$i_cokpi_id = $cokpi_id;
				$i_cokpi_title = $cokpi_title;
				$i_cokpi_wei = $cokpi_wei;
				$i_cokpi_app = $cokpi_app;
				if($cokpi_unit == 1):
					$i_unit1 = "checked";
				else:
					$i_unit2 = "checked";
				endif;
				$i_cokpi_comment = $cokpi_comment;
				echo form_open('ManageCokpi/updatingCokpi', $attributes);
			else:
				echo form_open('ManageCokpi/adding', $attributes);
			endif;
			?>
			<table class="w3-table">
			<tr>
			<td><b>เกณฑ์ประเมินผลฯ</b></td>
			<td><input class="w3-input w3-border w3-grey" type="text" name="i_crititle" value="<?=$cri_title?>" readonly required>
			<input class="w3-input w3-border" type="hidden" name="i_cri_id" value="<?=$cri_id?>"></td>
			</tr>	
			<tr>
			<td><b>ตัวชี้วัด <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_cokpi_title" value="<?=$i_cokpi_title?>" required>
				<input class="w3-input w3-border" type="hidden" name="i_cokpi_id" value="<?=$i_cokpi_id?>" required>
			</td>
			</tr>
			<tr>
			<td><b>หน่วยวัด <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-radio" type="radio" name="i_cokpi_unit" value="1" <?=$i_unit1?> required> ระดับ 
				<input class="w3-radio" type="radio" name="i_cokpi_unit" value="2" <?=$i_unit2?> required> อื่น ๆ
			</td>
			</tr>
			<tr>
			<td><b>น้ำหนัก (%)<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" style="width:10%" type="number" id="i_cokpi_wei" name="i_cokpi_wei" value="<?=$i_cokpi_wei?>" required></td>
			</tr>
			<tr>
			<td><b>แนวทางกำหนดตัวชี้วัด</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_cokpi_app"><?=$i_cokpi_app?></textarea></td>
			</tr>
			<tr>
			<td><b>หมายเหตุ</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_cokpi_comment"><?=$i_cokpi_comment?></textarea></td>
			</tr>
			<tr>
			<td colspan="2">
			<?php if(isset($data_method) == "UDP"): ?>
				<button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนแก้ไข?');">แก้ไข</button>
				<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
				<a href="<?=base_url('index.php/ManageCokpi/addCokpi/').$cri_id?>" class="w3-button w3-red">ย้อนกลับ</a>
			<?php else: ?>
				<button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนบันทึก?');">บันทึก</button>
				<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
				<a href="<?=base_url('index.php/ManageCokpi/getCokpi')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<?php endif; ?>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
			
			<!-- button class="w3-btn w3-blue" onclick="topFunction()" id="myBtn" title="Go to top"><i class="material-icons" style="vertical-align:middle;">arrow_upward</i></button -->

		  </div>
		  <br>
