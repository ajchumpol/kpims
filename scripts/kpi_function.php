<?php
function create_year($y=""){
	$start_year = date('Y', strtotime('-5 year'))+543;
	if(isset($y)) $current_year = $y;
	$current_year = date('Y')+543;
	$end_year = date('Y', strtotime('+5 year'))+543;

	$select = '<select id="i_year" name="i_year">';
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
}

function check_value($data=""){
	return (empty($data))? "ไม่ระบุ": $data;
}
?>