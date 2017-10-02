<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<table style="margin: auto; width:100%; padding:10px;">
	<tr>
		<td style="margin: auto; width:25%;">
		<div class="w3-card" style="margin:10px;">
		<div class="w3-container">
		  <h3 class="w3-center"><?=$user_name?></h3>
		  <?php
			$image_prop = array(
		      	'src' => $user_photo,
		      	'alt' => $user_name,
		      	'style' => 'width:100%;padding:35px;'
			);
		    echo img($image_prop);
		  ?>
		  <div class="file_upload" style="align:center;">
		  <form method="post" enctype="multipart/form-data" action="ManageUser/uploading">
		  <label for="i_photo" class="w3-button w3-green">อัพโหลดรูปใหม่</label>
		  <input type="file" style="display:none;" id="i_photo" name="i_photo" class="file_upload_input" accept=".gif,.jpg,.jpeg,.png" onchange="this.form.submit();">
		  </form>
		  </div>
		  <h4 id="loading" style="display:none;">Loading...</h4>
		  <div id="message"></div>
		  <br>
		  <i class="material-icons" style="vertical-align:middle;">account_box</i> <?=$type_name?><br>
		  <i class="material-icons" style="vertical-align:middle;">cake</i> <?=$user_bd?><br>
		  <i class="material-icons" style="vertical-align:middle;">email</i> <?=$user_email?><br>
		  <i class="material-icons" style="vertical-align:middle;">date_range</i> <?=$user_create?><br>
		  <a href="ManageUser/updateUser/<?=$_SESSION['s_user_id']?>" class="w3-button w3-green">แก้ไขข้อมูล</a>
		</div>

		</div>

		<?php
		if(isset($error)) :
		?>
		  <div id="id01" class="w3-modal" style="display:block;">
		    <div class="w3-modal-content w3-card-4">
		      <header class="w3-container w3-red">
		        <h2>Information:</h2>
		      </header>
		      <div class="w3-container">
		        <p><?=$error?></p>
		      </div>
		      <footer class="w3-container w3-red w3-center">
		        <button onclick="document.getElementById('id01').style.display='none'">Close</button>
		      </footer>
		    </div>
		  </div>
		<?php endif;	?>

		</td>
		<td style="vertical-align:top;">
			<div class="w3-container">
			  <h2 class="w3-leftbar w3-border-blue w3-pale-blue" style="padding:15px;">ข้อมูลหลัก</h2>

			  <div class="w3-row">
			    <a href="ManageUser/getUser" onclick="openCity(event, 'Cate01');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลผู้ใช้งาน</div>
			    </a>
			    <a href="ManageCriterion/getCriterion" onclick="openCity(event, 'Cate02');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลเกณฑ์การประเมิน</div>
			    </a>
			    <a href="ManageCapitalType/getCapitalType" onclick="openCity(event, 'Cate03');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลกลุ่มประเภทเงินทุนหมุนเวียน</div>
			    </a>
			  </div>
			  <div class="w3-row">
			    <a href="ManageCokpi/getCokpi" onclick="openCity(event, 'Cate04');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลตัวชี้วัด</div>
			    </a>
			    <a href="ManageCokpi/getSubkpi" onclick="openCity(event, 'Cate05');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลตัวชี้วัดย่อย</div>
			    </a>
			    <a href="ManageCokpi/getSubissue" onclick="openCity(event, 'Cate06');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลประเด็นย่อยที่ใช้พิจารณา</div>
			    </a>
			  </div>
			  <div class="w3-row">
			    <a href="ManageGrade/getGrade" onclick="openCity(event, 'Cate07');">
			      <div class="w3-leftbar w3-third tablink w3-bottombar w3-hover-light-grey w3-hover-border-blue w3-padding">ข้อมูลระดับคะแนน (ตัวชี้วัดย่อย)</div>
			    </a>
			  </div>
			</div>
		</td>
	</tr>
	</table>
