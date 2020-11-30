<?php

namespace App\Http\Controllers\drugStore;
use Cookie;

class cartController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$cart = Cookie::get('cart');
		if (is_null($cart))
			$cart = array();
		else
			$cart = unserialize($cart);

		$getCart = app('App\Http\Controllers\api\drugStore\cartController');
		$products = array();

		$sumPrice = 0;
		$sumOff = 0;
		foreach ($cart as $k => $c) {
			$p = $getCart->products_of_cart($c['id'], $c['weight'], $c['taste']);
			$p = $p[0];
			$qs = array(
				"select-weight" => $c['weight'],
				"select-taste" 	=> $c['taste']
			);
			$qs = http_build_query($qs);
			$p->qs = $qs;
			$p->qty = $c['qty'];
			$p->item = $c['id'].','.$c['weight'].','.$c['taste'];
			
			if ($c['qty'] > $p->stock) {
				if ($p->stock == 0)
					unset($cart[$k]);
				else
					$cart[$k]['qty'] = $p->stock;
				$c['qty'] = $cart[$k]['qty']; // use in sumPrice and sumOff
				$cart = serialize($cart);
				Cookie::queue('cart', $cart, 60*24*30);
			}

			$sumPrice += $p->price * $c['qty'];
			$sumOff += $p->off * $c['qty'];

			array_push($products, $p);
		}

		$data = array(
			'cart' => $products,
			'sumPrice' => $sumPrice,
			'sumOff' => $sumOff
		);

		return View('drug_store.cart')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function add() {
		if ($_POST["action"] == "add-to-cart") {
			$cart = Cookie::get('cart');
			if (is_null($cart))
				$cart = array();
			else
				$cart = unserialize($cart);

			$product = array(
				'id' 		=> $_POST['pid'],
				'taste' 	=> $_POST['select-taste'],
				'weight' 	=> $_POST['select-weight'],
				'qty' 		=> intval($_POST['qty'])
			);

			$push = true;
			foreach ($cart as &$p) {
				if ($p['id'] == $product['id'] AND $p['taste'] == $product['taste'] AND $p['weight'] == $product['weight']) {
					$p['qty'] += $product['qty'];
					$push = false;
				}
			}

			if ($push)
				array_push($cart, $product);

			$cart = serialize($cart);
			Cookie::queue('cart', $cart, 60*24*30);

			return redirect('cart');
		} else {
			if (!session()->exists('userid'))
            	return redirect('ورود?back='.request()->headers->get('referer'));

			$sms = app('App\Http\Controllers\api\drugStore\cartController');
			$sms->add_sms_list($_POST['pid'], $_POST['select-weight'], $_POST['select-taste'], session()->get('userid'));

			return redirect()->back()->with('success', 'پس از موجود شدن این محصول، از طریق پیامک به شما اطلاع رسانی خواهد شد.');
		}
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function update() {
		$cart = Cookie::get('cart');
		if (is_null($cart))
			$cart = array();
		else
			$cart = unserialize($cart);

		$chnageQTY = $_POST["chnageQTY"];
		$item = $_POST["item"];
		$item = explode(',', $item);


		
		foreach ($cart as $k => $p) {
			if ($p['id'] == $item[0] AND $p['taste'] == $item[2] AND $p['weight'] == $item[1]) {
				switch ($chnageQTY) {
					case 'plus':
						$cart[$k]['qty'] ++;
						break;
					case 'minus':
						if ($cart[$k]['qty'] > 1)
							$cart[$k]['qty'] --;
						else
							array_splice($cart, $k, 1);
						break;
					case 'remove':
						array_splice($cart, $k, 1);
						break;
					default:
						abort(401);
						break;
				}
				break;
			}
		}

		$cart = serialize($cart);
		Cookie::queue('cart', $cart, 60*24*30);

		return redirect('cart');
	}

}