<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//check empty value
function check_value($data=""){
	return (empty($data))? "ไม่ระบุ": $data;
}
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> กำหนดเกณฑ์การประเมินฯ รายปีบัญชี</h3>
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
		  <header class="w3-container w3-blue w3-center">
			<?php
			$attributes = array(
				'class' => 'w3-container', 
				'id' => 'addform', 
				'method' => 'post', 
				'autocomplete' => 'off'
			);

			echo form_open('ManageDocument/adding', $attributes);
			?>
			<h4>กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน</br>ประจำปีบัญชี
			<?php
				$start_year = date('Y', strtotime('-5 year'))+543;
				if(isset($data_year)):
					$current_year = $data_year;
				else:
					$current_year = date('Y')+543;
				endif;
				$end_year = date('Y', strtotime('+5 year'))+543;

				$select = '<select id="i_year" name="i_year" onChange="location.href=\''.base_url('index.php/ManageDocument/openDocument/').'\'+this.value">';
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
			</h4>
		  </header>
		  <table class="w3-table w3-light-grey">
			<tr>
				<td>รหัสเอกสาร</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_label" value="<?=$label?>" readonly required></td>
				<td>ชื่อเอกสาร <span style="color:#FF0000;">*</span></td>
				<td colspan="3"><input class="w3-input w3-border" style="size:300px;" type="text" name="i_title" value="กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน ประจำปีบัญชี <?=$current_year?>" required></td>
			</tr>
			<tr>
				<td>สถานะเอกสาร</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_status" value="ฉบับร่าง" readonly required></td>
				<td>ผู้ดำเนินการ</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_create_by" value="<?=$_SESSION['s_user_flname']?>" readonly required></td>
				<td>วันที่ดำเนินการ</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_create" value="<?=date('Y-m-j')?>" readonly required></td>
			</tr>
		  </table>

		  <a name="ADD"></a>
		  <header class="w3-container w3-blue">
			<h5>รายการกรอบหลักเกณฑ์ตัวชี้วัด</h5>
		  </header>
		  <div class="w3-container">
		  	<table class="w3-table">
			    <tr class="w3-blue">
			      <th class="w3-center" style="width:25%;">เกณฑ์ประเมินผลฯ</th>
			      <th class="w3-center">น้ำหนัก (%)</th>
			      <th class="w3-center" colspan="2">แนวทางการกำหนดตัวชี้วัด</th>
			    </tr>
		  <?php
		  	$ind = 0;
		 	$j_no = 0; $tmp_cri = 0; $tmp_i = 0;
			$data_cri_arr = json_decode(json_encode($data_cri_obj), True);
			$data_cokpi_arr = json_decode(json_encode($data_cokpi_obj), True);
			$data_subcokpi_arr = json_decode(json_encode($data_subcokpi_obj), True);
			$data_grade_arr = json_decode(json_encode($data_grade_obj), True);
			for ($j_no = 0; $j_no < count($data_cri_arr); $j_no++):
				if($tmp_cri != $data_cri_arr[$j_no]['cri_id']):
					$tmp_cri = $data_cri_arr[$j_no]['cri_id'];
					$tmp_i++;
		  ?>
			<tr class="w3-grey">
				<td><?=$data_cri_arr[$j_no]['cri_title']?><input type="hidden" name="i_cri_id[]" value="<?=$data_cri_arr[$j_no]['cri_id']?>"></td>
				<td class="w3-center"><?=$data_cri_arr[$j_no]['cri_wei_min']."-/+".$data_cri_arr[$j_no]['cri_wei_max']?></td>
				<td><?=$data_cri_arr[$j_no]['cri_kpi_app']?></td>
				<td><?=$data_cri_arr[$j_no]['cri_kpi_appexa']?></td>
			</tr>
			<?php else: $tmp_i=0; endif; ?>
			<tr>
				<td><?=$data_cri_arr[$j_no]['cokpi_title']?><input type="hidden" name="i_cokpi_id[]" value="<?=$data_cri_arr[$j_no]['cokpi_id']?>"></td>
				<td class="w3-center"><input type="number" min="-<?=$data_cri_arr[$j_no]['cri_wei_min']?>" max="<?=$data_cri_arr[$j_no]['cri_wei_max']?>" name="i_cokpi_wei[<?=$data_cri_arr[$j_no]['cri_id']?>][<?=$data_cri_arr[$j_no]['cokpi_id']?>]" style="width:50px;" required><span style="color:#FF0000;">*</span></td>
				<td colspan="2"><?=$data_cri_arr[$j_no]['cokpi_app']?></td>
			</tr>
		  <?php
		  		for ($i_no = 0; $i_no < count($data_cokpi_arr); $i_no++):
		  			if($data_cokpi_arr[$i_no]['cokpi_id'] == $data_cri_arr[$j_no]['cokpi_id']):
		  ?>
			<tr class="w3-light-grey">
				<td><?=$data_cokpi_arr[$i_no]['subcokpi_title']?><input type="hidden" name="i_subkpi_id[]" value="<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>"></td>
				<td colspan="3"><?=$data_cokpi_arr[$i_no]['subcokpi_def']?><input type="hidden" name="i_cokpi_subkpi[<?=$data_cokpi_arr[$i_no]['cokpi_id']?>][<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>]" value="<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>"></td>
			</tr>
		  <?php
		  				for ($k_no = 0; $k_no < count($data_subcokpi_arr); $k_no++):
		  					if($data_cokpi_arr[$i_no]['subcokpi_id'] == $data_subcokpi_arr[$k_no]['subcokpi_id']):
		  ?>
			<tr>
				<td><?=$data_subcokpi_arr[$k_no]['issdet_title']?><input type="hidden" name="i_issdet_id[]" value="<?=$data_subcokpi_arr[$k_no]['issdet_id']?>"></td>
				<td class="w3-center"><input type="number" value="<?=$data_subcokpi_arr[$k_no]['issdet_wei']?>" name="i_subkpi_wei[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" class="w3-light-grey" style="width:50px;" readonly required></td>
				<td>
		  <?php
		  				for ($l_no = 0; $l_no < count($data_grade_arr); $l_no++):
		  					if($data_grade_arr[$l_no]['gra_id'] == $data_subcokpi_arr[$k_no]['gra_id']):
		  ?>
				<table class="w3-table w3-light-grey">
					<tr class="w3-blue"><th colspan="5" class="w3-center">ระดับคะแนน (1, 2, 3, 4 และ 5) <span style="color:#FF0000;">*</span>
						<input type="hidden" name="i_gra_id[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_id']?>"></th></tr>
					<tr>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score1']?>" required><?=check_value($data_grade_arr[$l_no]['gra_title1'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score2']?>" required><?=check_value($data_grade_arr[$l_no]['gra_title2'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score3']?>" required><?=check_value($data_grade_arr[$l_no]['gra_title3'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score4']?>" required><?=check_value($data_grade_arr[$l_no]['gra_title4'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score5']?>" required><?=check_value($data_grade_arr[$l_no]['gra_title5'])?></td>
					</tr>
				</table>
			<?php
									$ind++;
								endif;
							endfor;
			?>
				</td>
				<td>
					<ul>
					<?php
					$data_att_arr = json_decode(json_encode($data_att_obj), True);
					$flag = 0;
					for ($l_no = 0; $l_no < count($data_att_arr); $l_no++):
						if (($data_att_arr[$l_no]['issdet_id'] == $data_subcokpi_arr[$k_no]['issdet_id']) && 
							($data_att_arr[$l_no]['subcokpi_id'] == $data_cokpi_arr[$i_no]['subcokpi_id'])):
							$flag++;
							echo "<li><a class='w3-btn' href='".base_url($data_att_arr[$l_no]['att_path'])."' target='_blank'>".$data_att_arr[$l_no]['att_label']."</a></li>";
						endif;
					endfor;

					if($flag == 0):
					?>
						<li>
							<label style="color:#ff0000;">* ไม่มีเอกสารแนบ</label>
						</li>
					</ul>
					<?php endif; ?>
				</td>
			</tr>
		  <?php
		  					endif;
		  				endfor;
		  			endif;
		  		endfor;
		  	endfor;
		  ?>
		  	<input type="hidden" name="i_ind" value="<?=$ind?>">
			<tr>
			<td colspan="3">
				<button type="submit" class="w3-btn w3-grey" name="i_submit_draft">บันทึกฉบับร่าง</button>
				<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
				<a href="<?=base_url('index.php/MainUser')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			<td style="text-align:right;">
				<button type="submit" class="w3-btn w3-green" name="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนบันทึกเอกสาร\nกรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน ประจำปีบัญชี '+document.getElementById('i_year').value+'\nเนื่องจากคุณจะไม่สามารถแก้ไขเอกสารดังกล่าวได้หลังการกดยืนยัน?');">บันทึก</button>
			</td>
			</tr>
			</table>

			</form>
		  </div>
		  <br>
