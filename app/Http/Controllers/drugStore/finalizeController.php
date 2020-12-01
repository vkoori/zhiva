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
		return view('drug_store.finalize');
		dd($_POST);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function goToBank() {
		dd($_POST);
	}
}