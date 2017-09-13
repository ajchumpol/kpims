<?php
function calPaging($n_url, $n_row, $n_per = 10, $page = 0){

	if(!$page) $page = 1;

	$prev_page = $page - 1;
	$next_page = $page + 1;

	$s_page = (($n_per * $page) - $n_per);
	if($n_row <= $n_per) {
		$n_of_page = 1;
	} else if(($n_row % $n_per) == 0)	{
		$n_of_page =($n_row / $n_per);
	} else {
		$n_of_page =($n_row / $n_per) + 1;
		$n_of_page = (int)n_of_page;
	}

	if($prev_page) {
		echo " <a href='$n_url/page/$prev_page'> << Back </a> ";
	}

	for($i=1; $i<=$n_row; $i++){
		if($i != $page) {
			echo " <a href='$n_url/page/$i'>$i</a> ";
		} else {
			echo "<b> $i </b>";
		}
	}

	if($page != $n_of_page) {
		echo " <a href ='$n_url/page/$next_page'> Next >> </a> ";
	}

	/**
	* <a href="#">&laquo;</a>
  	* <a href="#">1</a>
  	* <a class="active" href="#">2</a>
  	* <a href="#">3</a>
  	* <a href="#">4</a>
  	* <a href="#">5</a>
  	* <a href="#">6</a>
  	* <a href="#">&raquo;</a>
  	**/
}
?>