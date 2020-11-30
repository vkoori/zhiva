<?php

namespace App\Http\Controllers\admin\drugStore;

class tasteController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$tastes = app('App\Http\Controllers\api\drugStore\tasteController');
		$tastes = $tastes->get_taste();

		return view('admin.drug_store.taste')->with('tastes', $tastes);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert() {
		// check validation
		$rules = [
			'name' => array('required'),
			'icon' => array('required', 'image')
		];

		$customMessages = [
			'name.required' => 'نام وارد نشده است.',
			'icon.required' => 'آیکون ثبت نشده است.',
			'icon.image' => 'فایل وارد شده تصویر نمی باشد.'
		];

		request()->validate($rules, $customMessages);

		$upload = app('App\Http\Controllers\api\uploadImageController');
		$url = $upload->taste();

		$data = array(
			'id' => null,
			'taste' => $_POST['name'],
			'icon' => $url
		);

		$tastes = app('App\Http\Controllers\api\drugStore\tasteController');
		$tastes->insert($data);

		return redirect('admin/drug-store/taste')->with('success', 'ثبت شد');
	}
}