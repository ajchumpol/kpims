<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<br>
	<table style="margin: auto; width:60%; padding:10px;">
	<tr><td>
	<div class="w3-container w3-card4">
		<div class="w3-blue w3-center">
		  <h3>กรุณาระบุข้อมูล (เพื่อรับข้อมูลรหัสผ่าน)</h3>
		</div>
		<!-- form class="w3-container" -->
		<?=form_open("User/sendPassword", "autocomplete='off'")?>
		<label>อีเมล</label>
		<input class="w3-input" name="i_email" id="i_email" type="email" placeholder="E-mail" required>

		<!--label>ระบุข้อความที่ปรากฏ</label>
		<?=$data_img['image']?>
		<input class="w3-input" name="i_captcha" id="i_captcha" type="text" placeholder="Captcha" required>
		<input type="hidden" id="i_ctmp" value="<?=$data_img['word']?>"-->

		<button class="w3-button w3-blue w3-block w3-margin-top" name="i_submit" type="submit">ตกลง</button>
		<button class="w3-button w3-red w3-margin-top" type="reset">ล้างข้อมูล</button>
		<a class="w3-button w3-grey w3-margin-top" href="<?=base_url('index.php/Login')?>">ย้อนกลับ</a>
		<br><br><br><br>
		<?php
		if(isset($error)):
		?>
		  <div id="id01" class="w3-modal" style="display:block;">
		    <div class="w3-modal-content w3-card-4">
		      <header class="w3-container w3-red">
		        <h2>ข้อผิดพลาดระบบ:</h2>
		      </header>
		      <div class="w3-container">
		        <p><?=$error?></p>
		      </div>
		      <footer class="w3-container w3-red w3-center">
		        <button onclick="document.getElementById('id01').style.display='none'">Close</button>
		      </footer>
		    </div>
		  </div>
		<?php endif;
		if(isset($info)):
		?>
		  <div id="id02" class="w3-modal" style="display:block;">
		    <div class="w3-modal-content w3-card-4">
		      <header class="w3-container w3-green">
		        <h2>Information:</h2>
		      </header>
		      <div class="w3-container">
		        <p><?=$info?></p>
		      </div>
		      <footer class="w3-container w3-green w3-center">
		        <button onclick="location.href='<?=base_url('index.php/Login')?>'">กลับหน้าหลัก</button>
		      </footer>
		    </div>
		  </div>
		<?php endif; ?>
		</form>
	</div>
	</td></tr>
	</table>
