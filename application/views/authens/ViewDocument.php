<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//check empty value
function check_value($data=""){
	return (empty($data))? "ไม่ระบุ": $data;
}

function check_score($a=0, $b=0){
	return ($a==$b) ? true : false;
}
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageDocument/getDocLists')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> รายการเอกสารเกณฑ์การประเมินฯ</h3>
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

		  <header class="w3-container w3-blue w3-center">
			<h4>กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน</br>ประจำปีบัญชี
			<?php
				echo $doc_year;
			?>
			</h4>
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
			echo form_open('ManageDocument/getDocLists', $attributes);
			?>
		  <table class="w3-table w3-light-grey">
			<tr>
				<td>รหัสเอกสาร
					<input type="hidden" name="i_year" id="i_year" value="<?=$doc_year?>">
					<input type="hidden" name="i_doc_id" value="<?=$doc_id?>">
				</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_label" value="<?=$doc_label?>" readonly required></td>
				<td>ชื่อเอกสาร</td>
				<td colspan="3"><input class="w3-input w3-border w3-light-grey" style="size:300px;" type="text" name="i_title" value="<?=$doc_title?>" readonly required></td>
			</tr>
			<tr>
				<td>สถานะเอกสาร</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_status" value="<?=$doc_status?>" readonly required></td>
				<td>ผู้ดำเนินการ</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_create_by" value="<?=$doc_create_name?>" readonly required></td>
				<td>วันที่ดำเนินการ</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_create" value="<?=$doc_create?>" readonly required></td>
			</tr>
			<tr>
				<td></td><td></td>
				<td>ผู้แก้ไขล่าสุด</td><td><input class="w3-input w3-border w3-light-grey" type="text" name="i_edit_by" value="<?=$doc_edit_name?>" readonly required></td>
				<td>วันที่แก้ไขล่าสุด</td>
				<td><input class="w3-input w3-border w3-light-grey" type="text" name="i_edit" value="<?=$doc_edit?>" readonly required></td>
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
		 	$tmp_cri_doc = 0; $tmp_cokpi_doc = 0; $tmp_subcokpi_doc = 0;
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
				<td class="w3-center"><input class="w3-light-grey" type="number" min="-<?=$data_cri_arr[$j_no]['cri_wei_min']?>" max="<?=$data_cri_arr[$j_no]['cri_wei_max']?>" name="i_cokpi_wei[<?=$data_cri_arr[$j_no]['cri_id']?>][<?=$data_cri_arr[$j_no]['cokpi_id']?>]" value="<?=$data_cri_arr[$j_no]['cokpi_score']?>" style="width:50px;" readonly required></td>
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
				<td colspan="2">
		  <?php
		  				$chk1 = ""; $chk2 = ""; $chk3 = ""; $chk4 = ""; $chk5 = "";
		  				for ($l_no = 0; $l_no < count($data_grade_arr); $l_no++):
		  					if($data_grade_arr[$l_no]['gra_id'] == $data_subcokpi_arr[$k_no]['gra_id']):
		  						if(check_score($data_grade_arr[$l_no]['gra_score1'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
		  							$chk1 = "checked";
		  						elseif(check_score($data_grade_arr[$l_no]['gra_score2'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
		  							$chk2 = "checked";
		  						elseif(check_score($data_grade_arr[$l_no]['gra_score3'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
		  							$chk3 = "checked";
		  						elseif(check_score($data_grade_arr[$l_no]['gra_score4'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
		  							$chk4 = "checked";
		  						elseif(check_score($data_grade_arr[$l_no]['gra_score5'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
		  							$chk5 = "checked";
		  						endif;
		  ?>
				<table class="w3-table w3-light-grey">
					<tr class="w3-blue"><th colspan="5" class="w3-center">ระดับคะแนน (1, 2, 3, 4 และ 5)
					<input type="hidden" name="i_gra_id[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_id']?>"></th></tr>
					<tr>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score1']?>" disabled <?=$chk1?> required><?=check_value($data_grade_arr[$l_no]['gra_title1'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score2']?>" disabled <?=$chk2?> required><?=check_value($data_grade_arr[$l_no]['gra_title2'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score3']?>" disabled <?=$chk3?> required><?=check_value($data_grade_arr[$l_no]['gra_title3'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score4']?>" disabled <?=$chk4?> required><?=check_value($data_grade_arr[$l_no]['gra_title4'])?></td>
						<td><input type="radio" name="i_gra_score[<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>][<?=$data_subcokpi_arr[$k_no]['issdet_id']?>]" value="<?=$data_grade_arr[$l_no]['gra_score5']?>" disabled <?=$chk5?> required><?=check_value($data_grade_arr[$l_no]['gra_title5'])?></td>
					</tr>
				</table>
			<?php
								$ind++;
							endif;
						endfor;
			?>
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
			<td colspan="6">
				<a href="<?=base_url('index.php/ManageDocument/printDocument/').$doc_id?>" target="_blank" class="w3-button w3-grey">พิมพ์เอกสาร</a>
				<a href="<?=base_url('index.php/ManageDocument/getDocLists')?>" class="w3-button w3-red">ย้อนกลับ</a>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
