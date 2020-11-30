<?php

namespace App\Http\Controllers\admin\drugStore;

class brandController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$brand = app('App\Http\Controllers\api\drugStore\brandController');

		$countries = $brand->get_countries();
		$manufacturers = $brand->get_brans();

		$data = array(
			'countries' 		=> $countries,
			'manufacturers' 	=> $manufacturers
		);

		return view('admin.drug_store.brand')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert() {
		// check validation
		$rules = [
			'company' => array('required'),
			'company-en' => array('required', 'regex:/^[a-zA-Z0-9 ]*$/u'),
			'country' => array('required', 'numeric'),
			'website' => array('required', 'regex:/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/u')
		];

		$customMessages = [
			'company.required' => 'نام شرکت وارد نشده است.',
			'company-en.required' => 'نام لاتین شرکت وارد نشده است.',
			'country.required' => 'کشور ثبت نشده است.',
			'country.numeric' => 'مقدار ارسال شده برای کشور نامعتبر است.',
			'website.required' => 'وبسایت وارد نشده است.',
			'website.regex' => 'سایت وارد شده نامعتبر است.'
		];

		request()->validate($rules, $customMessages);

		$brand = app('App\Http\Controllers\api\drugStore\brandController');
		$brand = $brand->add_brand($_POST['country'], $_POST['company'], $_POST['company-en'], $_POST['website']);

		return redirect('admin/drug-store/brands')->with('success', 'ثبت شد');
	}
}