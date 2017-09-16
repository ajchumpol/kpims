<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="vertical-align:top;border:0px;">
			<div class="w3-container">
			  <h3 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;"><a href="<?=base_url('index.php/MainUser')?>"><i class="material-icons" style="vertical-align:middle;">arrow_back</i></a> ข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน</h3>
			  <table class="w3-table">
			  	<tr>
			  		<td colspan="4" style="padding:0px;margin:0px;">
					<?=form_open("ManageCapitalType/getCapitalType", "autocomplete='off'")?>
					  <input class="w3-input w3-border w3-left" style="width:300px;" type="text" name="i_key" placeholder="ค้นหากลุ่มประเภทเงินทุนหมุนเวียน">
					  <button class="w3-button w3-blue">ค้นหา</button>
					</form>
			  		</td>
			  		<td colspan="3" style="padding:0px;margin:0px;"><button onclick="document.getElementById('id03').style.display='block'" class="w3-button w3-blue w3-right">+</button></td>
			  	</tr>
			  </table>
			  <table class="w3-table-all w3-border">
			    <tr class="w3-blue">
			      <th class="w3-center">ที่</th>
			      <th class="w3-center">กลุ่มประเภทเงินทุนหมุนเวียน</th>
			      <th class="w3-center">แก้ไข</th>
			      <th class="w3-center">ลบ</th>
			    </tr>
				<?php
					// convert object to array
					$data_arr = json_decode(json_encode($data_obj), True);
					$i_ord = 1;
					for ($i_no = 0; $i_no < count($data_arr); $i_no++):
				?>
			    <tr>
			      <td><?=($i_ord++)?></td>
			      <td><?=$data_arr[$i_no]['capt_name']?></td>
			      <td class="w3-center"><a href="updateCapitalType/<?=$data_arr[$i_no]['capt_id']?>"><i class="material-icons" style="vertical-align:middle;">edit</i></a></td>
			      <td class="w3-center"><a href="deleting/<?=$data_arr[$i_no]['capt_id']?>" onclick="return confirmation('กรุณายืนยันเพื่อลบข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน ?')"><i class="material-icons" style="vertical-align:middle;">delete</i></a></td>
			    </tr>
				<?php
					endfor;

					if($i_no==0):
				?>
				<tr>
			      <td colspan="7" style="text-align:center;">*** ไม่มีรายการข้อมูล ***</td>
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
			      <th colspan="4" style="text-align:right;">ทั้งหมด <?=count($data_arr)?> ระเบียน</th>
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

	  <div id="id03" class="w3-modal">
		<div class="w3-modal-content">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('id03').style.display='none'" 
			class="w3-button w3-display-topright">&times;</span>
			<h3>กลุ่มประเภทเงินทุนหมุนเวียน</h3>
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
			echo form_open('ManageCapitalType/adding', $attributes);
			?>
			<table class="w3-table">
			<tr>
			<td><b>กลุ่มประเภทเงินทุนหมุนเวียน <span style="color:#FF0000;">*</span></b></td>
			<td><input class="w3-input w3-border" type="text" name="i_capt_name" required></td>
			</tr>
			<tr>
			<td colspan="2"><button type="submit" class="w3-btn w3-blue" id="i_submit" onclick="return confirmation('กรุณายืนยันข้อมูลก่อนกดปุ่มบันทึก?');">บันทึก</button>
			<button type="reset" class="w3-btn w3-blue">เคลียร์</button>
			<button type="button" onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-red">ยกเลิก</button>
			<span style="color:#FF0000;"><b>หมายเหตุ</b> * หมายถึง ต้องระบุข้อมูล</span>
			</td>
			</tr>
			</table>
			</form>
		  </div>
		  <br>
		</div>
	  </div>
