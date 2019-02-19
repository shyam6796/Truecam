<?php
  /**
   * Developed: Ravi Patel
   * Converting Indian Currency Numbers to words currency format
   */
class NumToWord_RP{
	public function rp_convertNumToWord($number){
		list($no, $point) = sscanf($number, '%d.%d');
		$hundred 	= null;
		$digits_1 	= strlen($no);
		$i 	= 0;
		$str= array();
		$words 		= array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine','10' => 'ten', '11' => 'eleven', '12' => 'twelve','13' => 'thirteen', '14' => 'fourteen','15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen','18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty','30' => 'thirty', '40' => 'forty', '50' => 'fifty','60' => 'sixty', '70' => 'seventy','80' => 'eighty', '90' => 'ninety');						
		$digits 	= array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
			$divider 	= ($i == 2) ? 10 : 100;
			$number 	= floor($no % $divider);
			$no 		= floor($no / $divider);
			$i 			+= ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
					" " . $digits[$counter] . $plural . " " . $hundred
					:
					$words[floor($number / 10) * 10]
					. " " . $words[$number % 10] . " "
					. $digits[$counter] . $plural . " " . $hundred;
			}else {
				$str[] = null;
			}
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		//$points = ($point) ? "" . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
		
		$rupee  = $result. "RUPEES ";
		$paise	= $this->rp_convertNumToWord2($point);
		$paise	= ($paise=="") ? "" : $paise." PAISE ";
		return strtoupper($rupee.$paise." ONLY");
	}
	public function rp_convertNumToWord2($number){
		list($no, $point) = sscanf($number, '%d.%d');
		$hundred 	= null;
		$digits_1 	= strlen($no);
		$i 	= 0;
		$str= array();
		$words 		= array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine','10' => 'ten', '11' => 'eleven', '12' => 'twelve','13' => 'thirteen', '14' => 'fourteen','15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen','18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty','30' => 'thirty', '40' => 'forty', '50' => 'fifty','60' => 'sixty', '70' => 'seventy','80' => 'eighty', '90' => 'ninety');						
		$digits 	= array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
			$divider 	= ($i == 2) ? 10 : 100;
			$number 	= floor($no % $divider);
			$no 		= floor($no / $divider);
			$i 			+= ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
					" " . $digits[$counter] . $plural . " " . $hundred
					:
					$words[floor($number / 10) * 10]
					. " " . $words[$number % 10] . " "
					. $digits[$counter] . $plural . " " . $hundred;
			}else {
				$str[] = null;
			}
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		//$points = ($point) ? "" . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
		return $result;
	}
}
 ?> 