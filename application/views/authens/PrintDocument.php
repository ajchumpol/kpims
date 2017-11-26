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
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
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
				<td><b>รหัสเอกสาร</b>
					<input type="hidden" name="i_year" id="i_year" value="<?=$doc_year?>">
					<input type="hidden" name="i_doc_id" value="<?=$doc_id?>">
				</td>
				<td><?=$doc_label?></td>
				<td><b>ชื่อเอกสาร</b></td>
				<td colspan="3"><?=$doc_title?></td>
			</tr>
			<tr>
				<td><b>สถานะเอกสาร</b></td>
				<td><?=$doc_status?></td>
				<td><b>ผู้ดำเนินการ</b></td>
				<td><?=$doc_create_name?></td>
				<td><b>วันที่ดำเนินการ</b></td>
				<td><?=$doc_create?></td>
			</tr>
			<tr>
				<td></td><td></td>
				<td><b>ผู้แก้ไขล่าสุด</b></td><td><?=$doc_edit_name?></td>
				<td><b>วันที่แก้ไขล่าสุด</b></td>
				<td><?=$doc_edit?></td>
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
			      <th class="w3-center" colspan="5">แนวทางการกำหนดตัวชี้วัด</th>
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
				<td colspan="4"><?=$data_cri_arr[$j_no]['cri_kpi_appexa']?></td>
			</tr>
			<?php else: $tmp_i=0; endif; ?>
			<tr>
				<td><?=$data_cri_arr[$j_no]['cokpi_title']?><input type="hidden" name="i_cokpi_id[]" value="<?=$data_cri_arr[$j_no]['cokpi_id']?>"></td>
				<td class="w3-center"><?=$data_cri_arr[$j_no]['cokpi_score']?></td>
				<td colspan="5"><?=$data_cri_arr[$j_no]['cokpi_app']?></td>
			</tr>
		  <?php
		  		for ($i_no = 0; $i_no < count($data_cokpi_arr); $i_no++):
		  			if($data_cokpi_arr[$i_no]['cokpi_id'] == $data_cri_arr[$j_no]['cokpi_id']):
		  ?>
			<tr class="w3-light-grey">
				<td><?=$data_cokpi_arr[$i_no]['subcokpi_title']?><input type="hidden" name="i_subkpi_id[]" value="<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>"></td>
				<td colspan="6"><?=$data_cokpi_arr[$i_no]['subcokpi_def']?><input type="hidden" name="i_cokpi_subkpi[<?=$data_cokpi_arr[$i_no]['cokpi_id']?>][<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>]" value="<?=$data_cokpi_arr[$i_no]['subcokpi_id']?>"></td>
			</tr>
		  <?php
		  				for ($k_no = 0; $k_no < count($data_subcokpi_arr); $k_no++):
		  					if($data_cokpi_arr[$i_no]['subcokpi_id'] == $data_subcokpi_arr[$k_no]['subcokpi_id']):
		  ?>
			<tr>
				<td><?=$data_subcokpi_arr[$k_no]['issdet_title']?><input type="hidden" name="i_issdet_id[]" value="<?=$data_subcokpi_arr[$k_no]['issdet_id']?>"></td>
				<td class="w3-center"><?=$data_subcokpi_arr[$k_no]['issdet_wei']?></td>
				<td colspan="4">
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
			<tr>
			<td colspan="6">
				<a href="#" onClick="window.print();" class="w3-button w3-grey">พิมพ์เอกสาร</a>
				<a href="#" onClick="window.close();" class="w3-button w3-red">ปิดหน้านี้</a>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
		  <button class="w3-btn w3-blue" onclick="topFunction()" id="myBtn" title="Go to top"><i class="material-icons" style="vertical-align:middle;">arrow_upward</i></button>
	</body>
</html>
