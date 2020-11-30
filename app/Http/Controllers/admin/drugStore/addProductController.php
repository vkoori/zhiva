<?php

namespace App\Http\Controllers\admin\drugStore;

class addProductController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show_dr() {
		$brand = app('App\Http\Controllers\api\drugStore\brandController');
		$manufacturers = $brand->get_brans();

		$menu = app('App\Http\Controllers\api\menuController');
		$lastLevel = $menu->lastLevel();

		$tags = app('App\Http\Controllers\api\drugStore\tagController');
		$tags = $tags->get_tags();

		$data = array(
			'manufacturers' => $manufacturers,
			'tags' => $tags,
			'menu' => $lastLevel
		);

		return view('admin.drug_store.add-product')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert_dr() {
		// check validation
		$rules = [
			'fa_name' => array('required'),
			'en_name' => array('required', 'regex:/^[a-zA-Z0-9 ]*$/u'),
			'serving_size' => array('required'),
			'title' => array('required'),
			'slug' => array('nullable'),
			'description' => array('required'),
			'keywords' => array('required'),
			'canonical' => array('nullable'),
			'redirect' => array('nullable'),
			'manufacture' => array('required', 'numeric'),
			'title-general' => array('required'),
			'title-properties' => array('required'),
			'value-general' => array('required'),
			'value-properties' => array('required'),
			'tags' => array('nullable'),
			'cats' => array('nullable'),
			'default-cat' => array('nullable')
		];

		$customMessages = [
			'fa_name.required' => 'نام فارسی وارد نشده است.',
			'en_name.required' => 'نام لاتین وارد نشده است.',
			'en_name.regex' => 'نام لاتین وارد شده نامعتبر است.',
			'serving_size.required' => 'serving size وارد نشده است.',
			'title.required' => 'عنوان گوگل وارد نشده است.',
			'description.required' => 'متا دسکریپشن وارد نشده است.',
			'keywords.required' => 'کلمات کلیدی وارد نشده است.',
			'manufacture.required' => 'کاخارنه ثبت نشده است.',
			'manufacture.numeric' => 'مقدار ارسال شده برای کارخانه نامعتبر است.',
			'title-properties.required' => 'عنوان تب ها وارد نشده است.',
			'value-properties.required' => 'متن تب ها وارد نشده است.'
		];

		request()->validate($rules, $customMessages);

		// call class
		$product = app('App\Http\Controllers\api\drugStore\productController');
		
		// add meta
		$slug = $_POST['slug'];
		if ($slug == '')
			$slug = $_POST['fa_name'];
		$slug = str_replace(' ', '-', mb_strtolower($slug, 'UTF-8'));
		$slug = urlencode($slug);

		if ($_POST['canonical'] == '')
			$_POST['canonical'] = null;

		if ($_POST['redirect'] == '')
			$_POST['redirect'] = null;

		$metaid = $product->add_meta($_POST['title'], $_POST['description'], $_POST['keywords'], $slug, $_POST['canonical'], $_POST['redirect']);

		// add product
		$productid = $product->add_product($metaid, $_POST['fa_name'], $_POST['en_name'], $_POST['serving_size']);

		// add properties
		$fani = (object) array();
		foreach ($_POST['title-general'] as $key => $item) {
			$fani->{$item} = $_POST['value-general'][$key];
		}
		$fani = json_encode($fani);

		$property = (object) array();
		$keyArr = array();
		$valueArr = array();
		$doc = new \DOMDocument();
		for ($i=0; $i < sizeof($_POST['title-properties']); $i++) { 
			$doc->loadHTML($_POST['value-properties'][$i], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
			$images= $doc->getElementsByTagName('img');

			foreach ($images as $img) {
				$src= $img->getAttribute('src');
				$width= $img->getAttribute('width');
				$path_parts = pathinfo($src);
				
				$srcset = $src.' '.$width.'w';
				$sizes = $width.'px';
				if ($width > 720) {
					$srcset .= ','.$path_parts['dirname'].'/tablet/'.$path_parts['basename'].' 720w,'.$path_parts['dirname'].'/mobile/'.$path_parts['basename'].' 400w';
					$sizes = '(max-width: 425px) 400px, (max-width: 768px) 720px ,'.$sizes;
				} elseif ($width > 400) {
					$srcset .= ','.$path_parts['dirname'].'/mobile/'.$path_parts['basename'].' 400w';
					$sizes = '(max-width: 425px) 400px, '.$sizes;
				}

				$img->setAttribute('class', 'lazy');
				$img->setAttribute('srcset', $srcset);
				$img->setAttribute('sizes', $sizes);
				$img->setAttribute('src', asset('public/assets/images/items/load.svg'));
				$img->setAttribute('data-src', $src);
			}

			$value_properties = $doc->saveHTML();
			
			array_push($keyArr, $_POST['title-properties'][$i]);
			array_push($valueArr, $value_properties);
		}
		$property->key = $keyArr;
		$property->value = $valueArr;
		$property = json_encode($property);
		$product->add_properties($productid, $property, $fani);

		// add brand
		$product->add_brand($_POST['manufacture'], $productid);

		// add tag (filter)
		if (isset($_POST['tags']) AND sizeof($_POST['tags'])>0) {
			$filter = array();
			foreach ($_POST['tags'] as $tag) {
				array_push($filter, array('id'=>null,'productid'=>$productid,'tagid'=>$tag));
			}
			$product->add_filter($filter);
		}

		// add category (menu)
		if (sizeof($_POST['cats'])>0) {
			$menu = array();
			foreach ($_POST['cats'] as $cat) {
				if ($_POST['default-cat'] == $cat)
					$is_default = 1;
				else
					$is_default = 0;
				array_push($menu, array('id'=>null,'productid'=>$productid,'navid'=>$cat, 'is_default'=>$is_default));
			}
			$product->add_cat($menu);
		}

		return redirect('admin/drug-store/add-product/'.$productid)->with('success', 'آماده برای ثبت آپشن ها، ارزش غذایی و تصاویر');
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function show_dr2($pid) {
		$tastes = app('App\Http\Controllers\api\drugStore\tasteController');
		$tastes = $tastes->get_taste();

		return view('admin.drug_store.add-product2')->with('tastes', $tastes);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert_dr2($pid) {
		$product = app('App\Http\Controllers\api\drugStore\productController');
		if (sizeof($_FILES) > 0)
			$upload = app('App\Http\Controllers\api\uploadImageController');

		$default = $_POST['default'];
		$default = explode('-', $default);

		$op = 1;
		while (isset($_POST['op_type'.$op])) {
			$data = array(
				'id'		=> null,
				'productid'	=> $pid,
				'type'		=> $_POST['op_type'.$op],
				'value'		=> $_POST['op_value'.$op],
				'price'		=> $_POST['price'.$op]
			);
			
			$opid = $product->add_op($data);
			
			$tasteNum = 1;
			while (isset($_POST['taste'.$op.'-'.$tasteNum])) {
				// $tasteid = ($_POST['taste'.$op.'-'.$tasteNum] == 0) ? null : $_POST['taste'.$op.'-'.$tasteNum];
				$tasteid = $_POST['taste'.$op.'-'.$tasteNum];
				// if (!is_null($tasteid)) {
					$data = array(
						'id'		=> null,
						'optionid'	=> $opid,
						'tasteid'	=> $tasteid
					);

					$product->add_product_taste($data);
					$ptid = $tasteid;
				// } else {
				// 	$ptid = null;
				// }

				if ($default[0] == $op AND $default[1] == $_POST['taste'.$op.'-'.$tasteNum])
					$is_default = 1;
				else
					$is_default = 0;

				$imgdir = $upload->product($pid,$opid,$ptid,"img$op-$tasteNum");

				$data = array(
					'id'			=> null,
					'productid'		=> $pid,
					'p_optionid'	=> $opid,
					'p_tasteid'		=> $ptid,
					'img'			=> $imgdir,
					'stock'			=> $_POST['stock'.$op.'-'.$tasteNum],
					'off'			=> $_POST['off'.$op.'-'.$tasteNum],
					'is_default'	=> $is_default
				);

				$product->add_product_detail($data);
				
				if (isset($_POST['title'.$op.'-'.$tasteNum])) {
					$data = array();
					for ($key=0; $key < sizeof($_POST['title'.$op.'-'.$tasteNum]); $key++) { 
						$row = array(
							'id'			=> null,
							'productid'		=> $pid,
							'p_optionid'	=> $opid,
							'p_tasteid'		=> $ptid,
							'title'			=> $_POST['title'.$op.'-'.$tasteNum][$key],
							'amount'		=> $_POST['amount'.$op.'-'.$tasteNum][$key],
							'dailyneed'		=> $_POST['dailyneed'.$op.'-'.$tasteNum][$key],
						);
						array_push($data, $row);
					}
					$product->add_nutrition($data);
				}
				$tasteNum ++;
			}
			$op ++;
		}
		if ($_POST["submit"] == "انتشار") {
			$data = array(
				'darft' => 0
			);
			$product->update_product($pid, $data);
		}

		return redirect('admin/drug-store/add-product')->with('success', 'محصول با موفقیت ثبت شد');
	}
}