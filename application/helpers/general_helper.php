<?php 

function generateStringFromArray($data) {
	if(!empty($data) && count((array)$data) > 0 ) {
		$str = '';
		foreach ($data as $key => $value) {
			$str .= "['".$key."', ".$value."],";
		}
		return $str;
	} else {
		return "";
	}
}	


?>