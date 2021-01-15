<?php

namespace App\Http\Controllers\drugStore;
use Cookie;

class bankController
{

	/**
	 * 
	 * 
	 * @return 
	 */
	public function goToBank() {
		$cart = Cookie::get('cart');
		if ($_POST["cart"] != $cart) 
			return redirect('cart')->withErrors(['سبد خرید شما تغییر یافته است.']);

		// use class discountController
		
		dd($_POST);
	}
}