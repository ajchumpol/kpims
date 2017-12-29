<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <script type="text/javascript" src="<?=base_url('scripts/loader.js')?>"></script>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body style="text-align: center;">
<?php
                        $ind = 0;
                        $j_no = 0; $tmp_cri = 0; $tmp_i = 0;
                        $res_cri_arr = array();
                        $res_cokpi_arr = array();
                        $tmp_cri_doc = 0; $tmp_cokpi_doc = 0; $tmp_subcokpi_doc = 0;
                        $data_cri_arr = json_decode(json_encode($data_cri_obj), True);
                        $data_cokpi_arr = json_decode(json_encode($data_cokpi_obj), True);
                        $data_subcokpi_arr = json_decode(json_encode($data_subcokpi_obj), True);
                        $data_grade_arr = json_decode(json_encode($data_grade_obj), True);
                        for ($j_no = 0; $j_no < count($data_cri_arr); $j_no++):
                                if($tmp_cri != $data_cri_arr[$j_no]['cri_id']):
                                        $tmp_cri = $data_cri_arr[$j_no]['cri_id'];
                                        $tmp_i++;
                                else:
                                        $tmp_i=0;
                                endif;
                                $res_cri_arr[$data_cri_arr[$j_no]['cri_id']][$data_cri_arr[$j_no]['cokpi_id']] = $data_cri_arr[$j_no]['cri_title'];
                                //$res_cri_arr[$data_cri_arr[$j_no]['cokpi_id']] = $data_cri_arr[$j_no]['cri_title'];

                                $sum_wei = 0;
                                $sum_score = 0;
                                $total_score = 0;
                                for ($i_no = 0; $i_no < count($data_cokpi_arr); $i_no++):
                                        if($data_cokpi_arr[$i_no]['cokpi_id'] == $data_cri_arr[$j_no]['cokpi_id']):
                                                for ($k_no = 0; $k_no < count($data_subcokpi_arr); $k_no++):
                                                        if($data_cokpi_arr[$i_no]['subcokpi_id'] == $data_subcokpi_arr[$k_no]['subcokpi_id']):
                                                                $total_score = $total_score + 5;
                                                                $sum_wei = $sum_wei + $data_subcokpi_arr[$k_no]['issdet_wei'];

                                                $cntgarr = count($data_grade_arr);
                                                $chk1 = ""; $chk2 = ""; $chk3 = ""; $chk4 = ""; $chk5 = "";
                                                for ($l_no = 0; $l_no < $cntgarr; $l_no++):
                                                        if($data_grade_arr[$l_no]['gra_id'] == $data_subcokpi_arr[$k_no]['gra_id']):
                                                                if(check_score($data_grade_arr[$l_no]['gra_score1'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
                                                                        $chk1 = "checked";
                                                                        $sum_score = ($sum_score + 1);
                                                                elseif(check_score($data_grade_arr[$l_no]['gra_score2'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
                                                                        $chk2 = "checked";
                                                                        $sum_score = ($sum_score + 2);
                                                                elseif(check_score($data_grade_arr[$l_no]['gra_score3'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
                                                                        $chk3 = "checked";
                                                                        $sum_score = ($sum_score + 3);
                                                                elseif(check_score($data_grade_arr[$l_no]['gra_score4'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
                                                                        $chk4 = "checked";
                                                                        $sum_score = ($sum_score + 4);
                                                                elseif(check_score($data_grade_arr[$l_no]['gra_score5'], $data_subcokpi_arr[$k_no]['issdet_ch_score']) == true):
                                                                        $chk5 = "checked";
                                                                        $sum_score = ($sum_score + 5);
                                                                endif;
                                                                $ind++;
                                                        endif;
                                                endfor;

                                                $sum_percent = number_format($sum_wei * ( $sum_score / $total_score), 2);
                                                $res_cokpi_arr[$data_cri_arr[$j_no]['cokpi_id']] = $data_cri_arr[$j_no]['cokpi_title'];
                                                $sum_cokpi_arr[$data_cri_arr[$j_no]['cokpi_id']] = $sum_percent;

                                        endif;
                                endfor;
                        endif;
                  endfor;
                endfor;

        //check empty value
        function check_value($data=""){
                return (empty($data))? "ไม่ระบุ": $data;
        }

        function check_score($a=0, $b=0){
                return ($a==$b) ? true : false;
        }
?>

<h3>รายงานสรุป (ด้านการประเมินผลเงินทุนหมุนเวียน)<br/>
กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน<br/>
ประจำปีบัญชี <?=$doc_year?></h3>
<hr/>

<div id="piechart"></div>

<script type="text/javascript">
// Get Data
<?php
$msg = "";
echo "var kpi_data = [";
echo "['Criterion','Percent'],";
foreach($res_cri_arr as $key_a => $val_a){
  $cri = "n/a";
  $sum = 0;
  foreach($val_a as $key_b => $val_b){
    $cri = $val_b;
    if(array_key_exists($key_b, $sum_cokpi_arr)){
      $sum = $sum + (int)$sum_cokpi_arr[$key_b];
    }
  }
  $msg.= "['$cri', $sum],";
}
echo trim($msg, ',')."];";
?>
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable(kpi_data);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'รายงานสรุป (ด้านการประเมินผลเงินทุนหมุนเวียน)', 'width':'100%', 'height':'100%' };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
</div>
<div>ข้อมูล ณ วันที่ <?=date('d/m/Y h:m:s')?></div>
                        <table class="w3-center">
                        <tr>
                        <td colspan="6">
                                <a href="#" onClick="window.print();" class="w3-button w3-grey">พิมพ์เอกสาร</a>
                                <a href="#" onClick="window.close();" class="w3-button w3-red">ปิดหน้านี้</a>
                        </td>
                        </tr>
                        </table>
                <br>
		<button class="w3-btn w3-blue" onclick="topFunction()" id="myBtn" title="Go to top"><i class="material-icons" style="vertical-align:middle;">arrow_upward</i></button>
        </body>
</html>

