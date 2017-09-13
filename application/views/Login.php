<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<br>
	<table style="margin: auto; width:40%; padding:10px;">
	<tr><td>
	<div class="w3-container w3-card4">
		<div class="w3-blue w3-center">
		  <h3>เข้าสู่ระบบ</h3>
		</div>
		<!-- form class="w3-container" -->
		<?=form_open("User/login", "autocomplete='off'")?>

		<label>ชื่อผู้ใช้งาน</label>
		<input class="w3-input" name="i_username" id="i_username" type="text" placeholder="Username">

		<label>รหัสผ่าน</label>
		<input class="w3-input" name="i_password" id="i_password" type="password" placeholder="Password">

		<button class="w3-button w3-blue w3-block w3-margin-top" type="submit">ตกลง</button>
		<button class="w3-button w3-red w3-margin-top">ล้างข้อมูล</button><span style="margin: 15px;"><a href="#">ลืมรหัสผ่าน?<a></span>
		<br><br><br><br>
		<?php
		if(isset($error)):
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
		<?php endif; ?>
		</form>
	</div>
	</td></tr>
	</table>
