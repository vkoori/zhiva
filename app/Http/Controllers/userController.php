<?php

namespace App\Http\Controllers;

class userController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		return view('login');
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function mobileChecker() {
		// check validation
		$rules = [
			'mobile' => array('required', 'regex:/^09[0-9]{9}$|^\u0660\u0669[\u0660-\u0669]{9}$|^\u06F0\u06F9[\u06F0-\u06F9]{9}$/u')
		];

		$customMessages = [
			'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
			'mobile.regex' => 'شماره موبایل وارد شده نامعتبر است'
		];

		request()->validate($rules, $customMessages);

		if (isset($_GET['back']))
			$back = $_GET['back'];
		else 
			$back = url('/');

		$functions = app('App\Http\Controllers\api\functionsController');
		$mobile = $functions->convert_nums($_POST['mobile']);

		$users = app('App\Http\Controllers\api\userController');
		$user = $users->get($mobile);
		if (sizeof($user) == 0) {
			$data = array(
				'id' 		=> null,
				'mobile' 	=> $mobile,
				'pass' 		=> '',
				'active' 	=> 0
			);
			$userid = $users->add($data);

			date_default_timezone_set('Asia/Tehran');
			$now = date('Y-m-d H:i:s');
			$private = str_pad(time() - strtotime('today midnight'), 5, '0', STR_PAD_LEFT);
			$private = intval($private)*10 + rand(0,9);
			$bytes = random_bytes(20);
			$public_key = strval($userid).bin2hex($bytes).strval(microtime(true)*1000);

			$data = array(
				'register_date' 		=> $now,
				'key_generate_date' 	=> $now,
				'private_key' 			=> $private,
				'public_key' 			=> $public_key,
				'userid'		 		=> $userid
			);
			$users->addKey($data);
			
			// send sms
			
			$querySting = array(
				'token' => $public_key,
				'back' => $back
			);
			return redirect("ثبت-نام?".http_build_query($querySting));
			
		} else {
			$key = $users->activationKey2($user[0]->id);
			$public_key = $key[0]->public_key;
		
			$querySting = array(
				'token' => $public_key,
				'back' => $back
			);
			if ($user[0]->active == 0) {

				return redirect("ثبت-نام?".http_build_query($querySting));
			} else {
				return redirect("رمز-ورود?".http_build_query($querySting));
			}
		}
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function passShow() {
		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند ورود با خطا مواجه شد.']);

		return View('password');
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function registerShow() {
		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند ثبت نام با خطا مواجه شد.']);

		$token = $_GET["token"];
		$users = app('App\Http\Controllers\api\userController');
		$key = $users->activationKey($token);

		if (sizeof($key) == 0)
			return redirect('ورود')->withErrors(['فرآیند ثبت نام با خطا مواجه شد.']);

		date_default_timezone_set('Asia/Tehran');
		$now = date('Y-m-d H:i:s');

		$now = strtotime($now);
		$key_generate = strtotime($key[0]->key_generate_date);

		if ($now - $key_generate > 60*2) {
			$key_generate = $now;
			$private = str_pad(time() - strtotime('today midnight'), 5, '0', STR_PAD_LEFT);
			$private = intval($private)*10 + rand(0,9);

			$data = array(
				'key_generate_date' 	=> date('Y-m-d H:i:s'),
				'private_key' 			=> $private,
				'public_key' 			=> $token,
			);
			$users->addKey($data);

			// send sms

		}
		
		return view('register')->with('countdown', $now - $key_generate);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function activation() {
		// check validation
		$rules = [
			'psw' => array('required'),
			'key' => array('required', 'regex:/^\d{6}$/u')
		];

		$customMessages = [
			'psw.required' => 'وارد کردن رمز ورود الزامی است.',
			'key.required' => 'وارد کردن کد تایید الزامی است.',
			'key.regex' => 'کد وارد شده نامعتبر است.'
		];

		request()->validate($rules, $customMessages);
		
		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند ثبت نام با خطا مواجه شد.']);

		$token = $_GET["token"];
		$users = app('App\Http\Controllers\api\userController');
		$key = $users->activationKey($token);

		if (sizeof($key) == 0)
			return redirect('ورود')->withErrors(['فرآیند ثبت نام با خطا مواجه شد.']);

		date_default_timezone_set('Asia/Tehran');
		$now = date('Y-m-d H:i:s');
		$now = strtotime($now);
		$key_generate = strtotime($key[0]->key_generate_date);

		if ($now - $key_generate > 60*2)
			return redirect()->back()->withErrors('کد وارد شده منقضی شده است.');

		if ($key[0]->private_key == $_POST['key']) {
			$psw = \Hash::make($_POST['psw']);

			$data = array(
				'id' 		=> $key[0]->userid,
				'pass' 		=> $psw,
				'active' 	=> 1
			);
			$users->add($data);
			\Session::put('userid', $key[0]->userid);

			return redirect($_GET["back"]);
		} else {
			$public_key = $key[0]->public_key;
			return redirect()->back()->withErrors('کد وارد شده با پیامک ارسالی تطابق ندارد.');
		}

	}


	/**
	 * 
	 * 
	 * @return 
	 */
	public function login() {
		// check validation
		$rules = [
			'psw' => array('required'),
		];

		$customMessages = [
			'psw.required' => 'وارد کردن رمز عبور الزامی است.',
		];

		request()->validate($rules, $customMessages);

		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند ورود با خطا مواجه شد.']);

		$token = $_GET["token"];
		$users = app('App\Http\Controllers\api\userController');
		$pass = $users->pass($token);

		if (sizeof($pass) == 0)
			return redirect('ورود')->withErrors(['فرآیند ورود با خطا مواجه شد.']);

		if (\Hash::check($_POST['psw'], $pass[0]->pass)) {
			\Session::put('userid', $pass[0]->id);
			return redirect($_GET["back"]);
		} else {
			return redirect()->back()->withErrors('رمز وارد شده نادرست است.');
		}
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function forgetShow() {
		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند ثبت نام با خطا مواجه شد.']);

		$token = $_GET["token"];
		$users = app('App\Http\Controllers\api\userController');
		$key = $users->activationKey($token);

		if (sizeof($key) == 0)
			return redirect('ورود')->withErrors(['فرآیند ساخت رمز جدید با خطا مواجه شد.']);

		date_default_timezone_set('Asia/Tehran');
		$now = date('Y-m-d H:i:s');

		$now = strtotime($now);
		$key_generate = strtotime($key[0]->key_generate_date);

		if ($now - $key_generate > 60*2) {
			$key_generate = $now;
			$private = str_pad(time() - strtotime('today midnight'), 5, '0', STR_PAD_LEFT);
			$private = intval($private)*10 + rand(0,9);

			$data = array(
				'key_generate_date' 	=> date('Y-m-d H:i:s'),
				'private_key' 			=> $private,
				'public_key' 			=> $token,
			);
			$users->addKey($data);

			// send sms

		}
		
		return view('forget')->with('countdown', $now - $key_generate);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function forget() {
		// check validation
		$rules = [
			'psw' => array('required'),
			'key' => array('required', 'regex:/^\d{6}$/u')
		];

		$customMessages = [
			'psw.required' => 'وارد کردن رمز جدید الزامی است.',
			'key.required' => 'وارد کردن کد تایید الزامی است.',
			'key.regex' => 'کد وارد شده نامعتبر است.'
		];

		request()->validate($rules, $customMessages);
		
		if (!isset($_GET["token"]))
			return redirect('ورود')->withErrors(['فرآیند تغییر رمز با خطا مواجه شد.']);

		$token = $_GET["token"];
		$users = app('App\Http\Controllers\api\userController');
		$key = $users->activationKey($token);

		if (sizeof($key) == 0)
			return redirect('ورود')->withErrors(['فرآیند تغییر رمز با خطا مواجه شد.']);

		date_default_timezone_set('Asia/Tehran');
		$now = date('Y-m-d H:i:s');
		$now = strtotime($now);
		$key_generate = strtotime($key[0]->key_generate_date);

		if ($now - $key_generate > 60*2)
			return redirect()->back()->withErrors('کد وارد شده منقضی شده است.');

		if ($key[0]->private_key == $_POST['key']) {
			$psw = \Hash::make($_POST['psw']);

			$data = array(
				'id' 		=> $key[0]->userid,
				'pass' 		=> $psw,
			);
			$users->add($data);
			\Session::put('userid', $key[0]->userid);

			return redirect($_GET["back"]);
		} else {
			$public_key = $key[0]->public_key;
			return redirect()->back()->withErrors('کد وارد شده با پیامک ارسالی تطابق ندارد.');
		}
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function quit() {
		\Session::forget('userid');
		return redirect('/');
	}

}