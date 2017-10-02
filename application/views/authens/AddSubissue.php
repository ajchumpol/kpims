<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			<h4 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/ManageCokpi/getSubissue')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลประเด็นย่อยที่ใช้ในการพิจารณา</h4>
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
		  <header class="w3-container w3-pale-white">
			<h4>เกณฑ์ประเมินผลฯ : <?=$cri_title?></h4>
			<h5><?=$cokpi_title?></h5>
			<h5><?=$subkpi_title?></h5>
		  </header>
		  <table class="w3-table">
			<tr class="w3-blue">
				<th class="w3-center" rowspan="2">ข้อมูลประเด็นย่อยฯ</th>
				<th class="w3-center" rowspan="2">น้ำหนัก (%)</th>
				<th class="w3-center" colspan="5">ระดับคะแนน</th>
				<th class="w3-center" rowspan="2">ลบ</th>
			</tr>
			<tr class="w3-blue">
				<th class="w3-center">1</th>
				<th class="w3-center">2</th>
				<th class="w3-center">3</th>
				<th class="w3-center">4</th>
				<th class="w3-center">5</th>
			</tr>
		  <?php
			// convert object to array
			$data_subissue_arr = json_decode(json_encode($data_subissue_obj), True);
			for ($j_no = 0; $j_no < count($data_subissue_arr); $j_no++):
		  ?>
			<tr>
				<td><?=$data_subissue_arr[$j_no]['issdet_title']?></td>
				<td><?=$data_subissue_arr[$j_no]['issdet_wei']?></td>
				<td><?=$data_subissue_arr[$j_no]['gra_title1']?></td>
				<td><?=$data_subissue_arr[$j_no]['gra_title2']?></td>
				<td><?=$data_subissue_arr[$j_no]['gra_title3']?></td>
				<td><?=$data_subissue_arr[$j_no]['gra_title4']?></td>
				<td><?=$data_subissue_arr[$j_no]['gra_title5']?></td>
				<td class="w3-center"><a href="<?=base_url('index.php/ManageCokpi/deletingSubissue/').$data_subissue_arr[$j_no]['issdet_id'].'/'.$data_subissue_arr[$j_no]['subcokpi_id'].'/'.$cokpi_id.'/'.$cri_id?>" onclick="return confirmation('กรุณายืนยันเพื่อลบข้อมูลประเด็นย่อยฯ ?')"><i class="material-icons" style="vertical-align:middle;">delete</i></a></td>
			</tr>
		  <?php
		  	endfor;
		  ?>
		  <?php
		  	if($j_no == 0):
		  ?>
			<tr>
			   <td colspan="8" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
			</tr>
			<?php endif; ?>
			<tr>
			   <th colspan="8" style="text-align:right;">ทั้งหมด <?=count($data_subissue_arr)?> ระเบียน</th>
			</tr>
		  </table>

		  <a name="ADD"></a>
		  <header class="w3-container w3-blue">
			<h4>จัดการข้อมูลประเด็นย่อยฯ</h4>
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

			$i_issdet_id = "";
			$i_issdet_title = "";
			$i_issdet_wei = "";
			echo form_open('ManageCokpi/addingSubissue', $attributes);
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
			<td><b>ตัวชี้วัดย่อย</b></td>
			<td><input class="w3-input w3-border w3-grey" type="text" name="i_subkpi_title" value="<?=$subkpi_title?>" readonly required>
				<input class="w3-input w3-border" type="hidden" name="i_subkpi_id" value="<?=$subkpi_id?>">
			</td>
			</tr>
			<tr>
			<td><b>ประเด็นย่อยฯ <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_issdet_title" value="<?=$i_issdet_title?>" required>
				<input class="w3-input w3-border" type="hidden" name="i_issdet_id" value="<?=$i_issdet_id?>" required>
			</td>
			</tr>
			<tr>
			<td><b>น้ำหนัก (%)<span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" style="width:10%" type="number" id="i_issdet_wei" name="i_issdet_wei" value="<?=$i_issdet_wei?>" required></td>
			</tr>
			<tr>
			<td><b>ระดับคะแนน <span style="color:#FF0000;">*</span></b></td>
			<td>
						<select class="w3-input w3-border w3-left" style="width:300px;" name="i_gra_id" required>
					  	<option value="0">-ระบุระดับคะแนน-</option>
					  	<?php
							$data_grade_arr = json_decode(json_encode($data_grade_obj), True);
							for ($j_no = 0; $j_no < count($data_grade_arr); $j_no++):
								$gt1 = "";
								if($data_grade_arr[$j_no]['gra_title1']==""): $gt1 = "-"; else: $gt1 = "(1)".$data_grade_arr[$j_no]['gra_title1']; endif;
								if($data_grade_arr[$j_no]['gra_title2']==""): $gt1.= "/-"; else: $gt1.= "/(2)".$data_grade_arr[$j_no]['gra_title2']; endif;
								if($data_grade_arr[$j_no]['gra_title3']==""): $gt1.= "/-"; else: $gt1.= "/(3)".$data_grade_arr[$j_no]['gra_title3']; endif;
								if($data_grade_arr[$j_no]['gra_title4']==""): $gt1.= "/-"; else: $gt1.= "/(4)".$data_grade_arr[$j_no]['gra_title4']; endif;
								if($data_grade_arr[$j_no]['gra_title5']==""): $gt1.= "/-"; else: $gt1.= "/(5)".$data_grade_arr[$j_no]['gra_title5']; endif;
					  	?>
					  	<option value="<?=$data_grade_arr[$j_no]['gra_id']?>"><?=$gt1?></option>
					  	<?php
					  		endfor;
					  	?>
					  </select>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณาตรวจสอบข้อมูลก่อนบันทึก?');">บันทึก</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<a href="<?=base_url('index.php/ManageCokpi/getSubissue')?>" class="w3-button w3-red">ย้อนกลับ</a>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
			
			<!-- button class="w3-btn w3-blue" onclick="topFunction()" id="myBtn" title="Go to top"><i class="material-icons" style="vertical-align:middle;">arrow_upward</i></button -->

		  </div>
		  <br>
