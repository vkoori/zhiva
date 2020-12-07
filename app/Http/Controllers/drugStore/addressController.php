<?php

namespace App\Http\Controllers\drugStore;
use Illuminate\Support\Facades\Http;

class addressController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$cartController = app('App\Http\Controllers\drugStore\cartController');
		$data = $cartController->calcCart();

		$profileController = app('App\Http\Controllers\profileController');
		$address = $profileController->address();
		$data = array_merge($data, $address);
		$data['form_url'] = url('address');

		return View('drug_store.address')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert() {
		$rules = [
			'province' => array('required', 'numeric'),
			'city' => array('required', 'numeric'),
			'address' => array('required'),
			'lat' => array('required', 'between:-90.0000000,90.0000000'),
			'lng' => array('required', 'between:-180.0000000,180.0000000'),
			'postal-code' => array('nullable', 'digits_between:9,11')
		];

		$customMessages = [
			'province.required' 			=> 'استان انتخاب نشده است.',
			'province.numeric' 				=> 'انتخاب استان با خطا مواجه شد.',
			'city.required' 				=> 'شهر انتخاب نشده است.',
			'city.numeric' 					=> 'انتخاب شهر با خطا مواجه شد.',
			'address.required' 				=> 'آدرس وارد نشده است.',
			'lat.required' 					=> 'طول جغرافیایی انتخاب نشده است.',
			'lat.between' 					=> 'اندازه طول جغرافیایی وارد شده نادرست است.',
			'lng.required' 					=> 'عرض جغرافیایی انتخاب نشده است.',
			'lng.between' 					=> 'اندازه عرض جغرافیایی وارد شده نادرست است.',
			'postal-code.digits_between' 	=> 'کدپستی وارد شده نامعتبر است.',
		];
		
		if (isset($_POST["first-name"])) {
			$rules['first-name'] = array('required');
			$rules['last-name'] = array('required');
			$rules['email'] = array('nullable', 'email');
			$rules['phone'] = array('nullable', 'regex:/^0[0-9]{10}$|^\x{0660}[\x{0660}-\x{0669}]{10}$|^\x{06F0}[\x{06F0}-\x{06F9}]{10}$/u');

			$customMessages['first-name.required'] = 'نام کوچک وارد نشده است.';
			$customMessages['last-name.required'] = 'نام خانوادگی وارد نشده است.';
			$customMessages['email.email'] = 'آدرس ایمیل نا معتبر است.';
			$customMessages['phone.regex'] = 'شماره ثابت باید به همراه پیش شماره و بدون هیچ نماد اضافه ای یادداشت شود. مثال:02112345678';
		}

		request()->validate($rules, $customMessages);

		$userid = \Session::get('userid');
		$profileClass = app('App\Http\Controllers\api\profileController');
		
		if (isset($_POST["first-name"])) {
			$functions = app('App\Http\Controllers\api\functionsController');
			$phone = $functions->convert_nums($_POST['phone']);
			
			$name = $_POST['first-name'];
			$familiy = $_POST['last-name'];
			$email = ($_POST['email'] == "") ? NULL : $_POST['email'];
			$phone = ($phone == "") ? NULL : $phone;

			$condition = array(
				'userid' 	=> $userid
			);
			$data = array(
				'userid' 	=> $userid,
				'name' 		=> $name, 
				'familiy' 	=> $familiy, 
				'email' 	=> $email, 
				'phone' 	=> $phone
			);

			$profileClass->addCustomer($condition, $data);
		}

		$customer = $profileClass->getCustomer($userid);

		$postal_code = ($_POST['postal-code'] == "") ? NULL : $_POST['postal-code'];
		$data = array(
			'cityid' 		=> $_POST['city'],
			'address' 		=> $_POST['address'],
			'postal_code' 	=> $postal_code,
			'customerid' 	=> $customer[0]->id,
			'lat' 			=> $_POST['lat'],
			'lng' 			=> $_POST['lng']
		);

		$profileClass->addAddress($data);
		$addressid = $profileClass->getAddress($userid);

		return redirect('address');

	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function addNew() {
		$url = request()->fullUrl();
		$parts = parse_url($url);
		if (isset($parts['query'])) {
			parse_str($parts['query'], $query);
			$form_url = $query['back'];
		} else {
			$form_url = '';
		}

		$profileClass = app('App\Http\Controllers\api\profileController');
		$provinces = $profileClass->provinces();
		
		$data = array(
			'customer' 		=> array('user has info'),
			'provinces' 	=> $provinces,
			'form_url' 		=> $form_url
		);

		if ($form_url == url('address')) {
			$cartController = app('App\Http\Controllers\drugStore\cartController');
			$cart = $cartController->calcCart();
			
			$data = array_merge($data, $cart);

			return View('drug_store.add-another-address')->with($data);
		} else {
			return View('profile.add-another-address')->with($data);
		}

	}
}