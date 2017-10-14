<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//check status value
function check_status($data=""){
	return ($data=='D')? "ฉบับร่าง": "ฉบับสมบูรณ์";
}
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			  <h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ค้นหาเอกสารเกณฑ์การประเมินฯ</h3>
			  <table class="w3-table">
				<?php
				$attributes = array(
					'class' => 'w3-container', 
					'id' => 'addform', 
					'method' => 'post', 
					'autocomplete' => 'off'
				);

				echo form_open('ManageDocument/getDocSearch', $attributes);
				?>
			  	<tr>
			  		<td>ปีบัญชี</td>
			  		<td>
					<?php
						$start_year = date('Y', strtotime('-5 year'))+543;
						$label_tmp = "";
						if(isset($doc_label)):
							$label_tmp = $doc_label;
						endif;
						$title_tmp = "";
						if(isset($doc_title)):
							$title_tmp = $doc_title;
						endif;
						if(isset($doc_year)):
							$current_year = $doc_year;
						else:
							$current_year = date('Y')+543;
						endif;
						$end_year = date('Y', strtotime('+5 year'))+543;

						$select = '<select id="i_year" name="i_year" class="w3-input">';
						$select .= '<option value="9999" selected>ระบุปีบัญชี</option>';
						for($i = $start_year; $i <= $end_year; $i++):
							if($current_year == $i):
						    	$select .= '<option value="'.$i.'" selected>'.$i.'</option>';
						    else:
						    	$select .= '<option value="'.$i.'">'.$i.'</option>';
						    endif;
						endfor;

						$select .= '</select>';

						echo $select;
					?>
			  		</td>
			  		<td>รหัสเอกสาร</td>
			  		<td><input class="w3-input w3-border w3-left" style="width:300px;" type="text" name="i_label" value="<?=$label_tmp?>"></td>
			  		<td>ชื่อเอกสาร</td>
			  		<td>
					  <input class="w3-input w3-border w3-left" style="width:300px;" type="text" name="i_title" value="<?=$title_tmp?>">
			  		</td>
			  	</tr>
			  	<tr>
			  		<td colspan="6" class="w3-center">
			  			<button class="w3-button w3-blue" type="submit">ค้นหา</button>
			  			<a href="<?=base_url('index.php/MainUser')?>" class="w3-button w3-red">ยกเลิก</a>
			  		</td>
			  	</tr>
				</form>
			  </table>
			  <table class="w3-table-all w3-border">
			    <tr class="w3-blue">
			      <th class="w3-center">ที่</th>
			      <th class="w3-center">รหัสเอกสาร</th>
			      <th class="w3-center">ชื่อเอกสาร</th>
			      <th class="w3-center">สถานะเอกสาร</th>
			      <th class="w3-center">ปีบัญชี</th>
			      <th class="w3-center">สร้างโดย</th>
			    </tr>
				<?php
					// convert object to array
					$data_arr = json_decode(json_encode($data_obj), True);
					$i_ord = 1;
					$act = "";
					$e_del = false;
					for ($i_no = 0; $i_no < count($data_arr); $i_no++):
						$act = "printDocument/".$data_arr[$i_no]['doc_id'];
				?>
			    <tr>
			      <td><?=($i_ord++)?></td>
			      <td class="w3-center"><a href="<?=$act?>" class="w3-bar-item w3-button w3-blue" target="_blank"><?=$data_arr[$i_no]['doc_label']?></a></td>
			      <td><?=$data_arr[$i_no]['doc_title']?></td>
			      <td class="w3-center"><?=check_status($data_arr[$i_no]['doc_status'])?></td>
			      <td class="w3-center"><?=$data_arr[$i_no]['doc_year']?></td>
			      <td><?=$data_arr[$i_no]['user_name']?></td>
			    </tr>
				<?php
					endfor;

					if($i_no==0):
				?>
				<tr>
			      <td colspan="6" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
			  	</tr>
				<?php endif; ?>
			    <tr>
			      <th colspan="3">
					  <?php
					  	if (isset($data_pg)) {
                    		echo $data_pg;
                		}
					  ?>
			      </th>
			      <th colspan="3" style="text-align:right;">ทั้งหมด <?=count($data_arr)?> ระเบียน</th>
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
