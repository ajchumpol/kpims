<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			  <h4 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลประเด็นย่อยที่ใช้ในการพิจารณา</h4>
			  <table class="w3-table">
			  	<tr>
			  		<td colspan="2" style="padding:0px;margin:0px;">
					<?=form_open("ManageCokpi/getSubissue", "autocomplete='off'")?>
					  <input class="w3-input w3-border w3-left" style="width:300px;" name="i_key" value="<?=$key?>">
					  <button class="w3-button w3-blue">ค้นหา</button>
					</form>
			  		</td>
			  		<td colspan="2" style="padding:0px;margin:0px;">
			  			<!--<button onclick="document.getElementById('id03').style.display='block'" class="w3-button w3-blue w3-right">+</button>-->
			  		</td>
			  	</tr>
			  </table>
			  <table class="w3-table-all w3-border">
				<?php
					// convert object to array
					$data_subkpi_arr = json_decode(json_encode($data_subkpi_obj), True);
					$i_ord = 1;
					$tmp_cri = 0;
					$tmp_cokpi = 0;
					for ($i_no = 0; $i_no < count($data_subkpi_arr); $i_no++):
						if($tmp_cri != $data_subkpi_arr[$i_no]['cri_id']):
							$tmp_cri = $data_subkpi_arr[$i_no]['cri_id'];
				?>
				<tr><td colspan="4"><h4>เกณฑ์ประเมินผล : <?=$data_subkpi_arr[$i_no]['cri_title']?></h4></td></tr>
				<?php
						endif;

						if($tmp_cokpi != $data_subkpi_arr[$i_no]['cokpi_id']):
							$tmp_cokpi = $data_subkpi_arr[$i_no]['cokpi_id'];
				?>
				<tr><td colspan="4"><h5><?=$data_subkpi_arr[$i_no]['cokpi_title']?></h5></td></tr>
			    <tr class="w3-blue">
			      <th class="w3-center">ตัวชี้วัดย่อย</th>
			      <th class="w3-center">คำนิยาม</th>
			      <th class="w3-center">หมายเหตุ</th>
			      <th class="w3-center">จัดการประเด็นย่อยฯ</th>
			    </tr>
				<?php endif; ?>
			    <tr>
			      <td><?=$data_subkpi_arr[$i_no]['subcokpi_title']?></td>
			      <td><?=$data_subkpi_arr[$i_no]['subcokpi_def']?></td>
			      <td><?=$data_subkpi_arr[$i_no]['subcokpi_comment']?></td>
			      <td class="w3-center"><a href="addSubissue/<?=$data_subkpi_arr[$i_no]['cri_id']?>/<?=$data_subkpi_arr[$i_no]['cokpi_id']?>/<?=$data_subkpi_arr[$i_no]['subcokpi_id']?>"><i class="material-icons" style="vertical-align:middle;">description</i></a></td>
			    </tr>
				<?php
					endfor;

					if($i_no==0):
				?>
				<tr>
			      <td colspan="4" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
			  	</tr>
				<?php endif; ?>
			    <tr>
			      <th colspan="3">
					  <?php
					  	if (isset($data_pg)):
                    		echo $data_pg;
                		endif;
					  ?>
			      </th>
			      <th colspan="4" style="text-align:right;">ทั้งหมด <?=count($data_subkpi_arr)?> ระเบียน</th>
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

		  <br>
		</div>
	  </div>
