<?php

namespace App\Http\Controllers;

class profileController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function address() {
		$userid = \Session::get('userid');

		$profileClass = app('App\Http\Controllers\api\profileController');
		$customer = $profileClass->getCustomer($userid);
		
		if (sizeof($customer) == 0) {
			$addresses = array();
		} else {
			$customerid = $customer[0]->id;
			$addresses = $profileClass->getAddress($customerid);
		}

		$data = array(
			'customer' => $customer,
			'addresses' => $addresses
		);

		if (sizeof($addresses) == 0) {
			$provinces = $profileClass->provinces();
			$data['provinces'] = $provinces;
		}

		return $data;
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function customer() {

		return '$data';
	}

}