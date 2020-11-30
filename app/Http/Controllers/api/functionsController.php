<?php
namespace App\Http\Controllers\api;
// use DateTime;
// use DateTimeZone;
// use Session;

class functionsController {

	public function arabicToPersian($string) {
		$characters = [
			'ك' => 'ک',
			'دِ' => 'د',
			'بِ' => 'ب',
			'زِ' => 'ز',
			'ذِ' => 'ذ',
			'شِ' => 'ش',
			'سِ' => 'س',
			'ى' => 'ی',
			'ي' => 'ی',
			'١' => '۱',
			'٢' => '۲',
			'٣' => '۳',
			'٤' => '۴',
			'٥' => '۵',
			'٦' => '۶',
			'٧' => '۷',
			'٨' => '۸',
			'٩' => '۹',
			'٠' => '۰',
		];
		return str_replace(array_keys($characters), array_values($characters),$string);
	}

	public function convert_nums($string) {
		$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		$arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

		$num = range(0, 9);
		$convertedPersianNums = str_replace($persian, $num, $string);
		$englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

		return $englishNumbersOnly;
	}
}