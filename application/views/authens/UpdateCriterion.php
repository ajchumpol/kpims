<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageCriterion/getCriterion')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลผู้เกณฑ์ประเมินผลฯ</h3>
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
			echo form_open('ManageCriterion/updatingCriterion', $attributes);
			?>
			<table class="w3-table">
			<tr>
			<td><b>ปีบัญชี <span style="color:#FF0000;">(ตั้งแต่ปีบัญชีเริ่มต้นไปย้อนหลัง)</span></b></td>
			<td>
			<?php
				$start_year = date('Y', strtotime('-5 year'))+543;
				$current_year = $cri_year;
				$end_year = date('Y', strtotime('+5 year'))+543;

				$select = '<select id="i_criyear" name="i_criyear">';
				$str = "";
				if($current_year == 9999): $str = "selected"; endif;
				$select .= '<option value="9999" '.$str.'>ไม่ระบุ</option>';
				for($i = $start_year; $i <= $end_year; $i++):
					if($i == $current_year):
						$str = "selected";
					else:
						$str = "";
					endif;
				    $select .= '<option value="'.$i.'"'.$str.'>'.$i.'</option>';
				endfor;

				$select .= '</select>';

				echo $select;
			?>
			</td>
			</tr>
			<tr>
			<td><b>เกณฑ์ประเมินผลฯ <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_crititle"  value="<?=$cri_title?>" required>
			<input class="w3-input w3-border" type="hidden" name="i_cri_id" value="<?=$cri_id?>"></td>
			</tr>
			<tr>
			<td><b>น้ำหนัก <span style="color:#FF0000;">*</span></b></td>
			<td>- <input class="w3-border" style="width:10%" type="number" id="i_criwei_min" name="i_criwei_min" value="<?=$cri_wei_min?>" required>/<input class="w3-border" style="width:10%" type="number" id="i_criwei_max" value="<?=$cri_wei_max?>" name="i_criwei_max" required> +</td>
			</tr>
			<tr>
			<td><b>ประเภทเงินทุนหมุนเวียน</b></td>
			<td>
			<?php
				// convert object to array
				$data_type_arr = json_decode(json_encode($capital_type_obj), True);
				if(count($data_type_arr) == 0):
					echo "-";
				endif;
				$chkStr = "";
				for ($t_no = 0; $t_no < count($data_type_arr); $t_no++):
					if($data_type_arr[$t_no]['capt_id'] == $capt_id):
						$chkStr = "checked";
					endif;
			?>
			<input class="w3-radio" type="radio" name="i_capt_id" value="<?=$data_type_arr[$t_no]['capt_id']?>" <?=$chkStr?>>
			<label><?=$data_type_arr[$t_no]['capt_name']?></label>
			<?php endfor; ?></td></tr>
			<tr>
			<td><b>แนวทางกำหนดตัวชี้วัด</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_criapp"><?=$cri_app?></textarea></td>
			</tr>
			<tr>
			<td><b>ตัวอย่างแนวทางกำหนดตัวชี้วัด</b></td>
			<td><textarea rows="5" cols="50" class="w3-input w3-border" name="i_criapp_ex"><?=$cri_app_ex?></textarea></td>
			</tr>

			<tr>
			<td colspan="2"><button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณายืนยันการแก้ไขข้อมูล?');">แก้ไข</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<a href="<?=base_url('index.php/ManageCriterion/getCriterion')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
