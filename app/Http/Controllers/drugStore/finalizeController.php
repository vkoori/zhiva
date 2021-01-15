<?php

namespace App\Http\Controllers\drugStore;

class finalizeController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$cartController = app('App\Http\Controllers\drugStore\cartController');
		$data = $cartController->calcCart();
		
		$addressid = $_POST['addressid'];
		$profileClass = app('App\Http\Controllers\api\profileController');
		$address = $profileClass->getAddressWithId($addressid);

		$data['address'] = $address[0];

		return view('drug_store.finalize')->with($data);
	}

}