<?php

namespace App\Http\Controllers\drugStore;

class categoryController
{
	// /**
	//  * 
	//  * 
	//  * @return 
	//  */
	// function __construct() {
	// 	if (isset($_GET['score']) AND $_GET['score'] == 0) { // when ($_GET['sort'] == 0) is also redirection
	// 		$url = request()->fullUrl();
	// 		$parsed = parse_url($url);
	// 		$query = $parsed['query'];

	// 		parse_str($query, $params);

	// 		unset($params['score']);
	// 		$string = http_build_query($params);
	// 		$url = sprintf('%s://%s%s%s', $parsed['scheme'], $parsed['host'], $parsed['path'], ($string == '') ? '' : '?'.$string );
	// 		return redirect($url)->send();
	// 	}
	// }

	/**
	 * 
	 * 
	 * @return 
	 */
	public function show($slug='') {
		$slug = 'shop/'.urlencode(urldecode($slug));
		$menu = app('App\Http\Controllers\api\menuController');
		$all_nodes = $menu->path_nodes($slug);
		if (sizeof($all_nodes) == 0)
			abort(404);
		
		unset($all_nodes[0]);
		$parents = array();
		$childIds = array();
		if ($slug == 'shop/')
			$insert_to_parents = false;
		else
			$insert_to_parents = true;
		
		foreach ($all_nodes as $node) {
			if ($insert_to_parents)
				array_push($parents, $node);

			if ($node->rgt - $node->lft == 1)
				array_push($childIds, $node->id);

			if ($node->slug == $slug)
				$insert_to_parents = false;
		}

		$score = 0;
		$tag = $brand = '';
		if (isset($_GET['score']))
			$score = $_GET['score'];
		if (isset($_GET['tag']))
			$tag = $_GET['tag'];
		if (isset($_GET['brand']))
			$brand = $_GET['brand'];
		$pageNum = 0;
		if (isset($_GET['page']))
			$pageNum = $_GET['page'];
		$sort = 1;
		if (isset($_GET['sort']))
			$sort = $_GET['sort'];

		$product = app('App\Http\Controllers\api\drugStore\productController');
		$all_products = $product->product_in_cats($childIds, $brand, $tag, $score, $pageNum, $sort);

		foreach ($all_products as $key => $product) {
			$product->op = count(array_unique(explode(',', $product->op)));
			$product->taste = count(array_unique(explode(',', $product->taste)));
		}

		$tag = app('App\Http\Controllers\api\drugStore\tagController');
		$filters = $tag->get_tags();
		$brand = app('App\Http\Controllers\api\drugStore\brandController');
		$company = $brand->get_brans();

		$data = array(
			'breadcrumb' 	=> $parents,
			'products' 		=> $all_products,
			'filters' 		=> $filters,
			'companies' 	=> $company,
		);

		if(request()->ajax()) {
			$data['params'] = $_GET;
			$data['home'] = url('/');
			return response($data, 200)->header('Vary', 'X-Requested-With,Accept-Encoding');
		} else {
			return view('drug_store.category')->with($data);
		}

	}
}