<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageCapitalType/getCapitalType')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน</h3>
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
			<h3>แก้ไขข้อมูลผู้เกณฑ์ประเมินผล</h3>
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
			echo form_open('ManageCapitalType/updatingCapitalType', $attributes);
			?>
			<table class="w3-table">
			<tr>
			<td><b>กลุ่มประเภทเงินทุนหมุนเวียน <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_capt_name"  value="<?=$capt_name?>" required>
			<input class="w3-input w3-border" type="hidden" name="i_capt_id" value="<?=$capt_id?>"></td>
			</tr>

			<tr>
			<td colspan="2"><button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณายืนยันการแก้ไขข้อมูล?');">แก้ไข</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<a href="<?=base_url('index.php/ManageCapitalType/getCapitalType')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
