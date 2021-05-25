<?php

/**
 * Format Class
 */
class Format {
	public function formatDate($date) {
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 400) {
		$text = $text . "";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text . '....';
		return $text;
	}

	public function validation($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function statusFormat($number) {
		switch ($number) {
			case 0:
			$result = '<span class="label label-sm label-success">Нийтлэгдсэн</span>';
			break;
			case 1:
			$result = '<span class="label label-sm label-info">Нөөцлөгдсөн</span>';
			break;
			default:
			$result = 'None';
			break;
		}
		return $result;
	}

	public function ucfirst($text) {
		return mb_strtoupper(mb_substr($text, 0, 1)).mb_substr($text, 1);
	}
}

?>