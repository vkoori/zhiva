<?php

namespace App\Http\Controllers\drugStore;

class productController
{
	private $comment_show = 5;

	/**
	 * 
	 * 
	 * @return 
	 */
	function __construct() {
		$category = request()->route('category');
		$category = 'shop/'.urlencode(urldecode($category));
		$slug = request()->route('slug');
		$slug = urlencode($slug);

        if(!request()->ajax()) {
			return $this->show($category, $slug, isset($_GET['select-weight']) ? $_GET['select-weight'] : NULL , isset($_GET['select-taste']) ? $_GET['select-taste'] : NULL);
        } else {
        	if (isset(getallheaders()['options']))
				return $this->customization($category, $slug, isset($_GET['select-weight']) ? $_GET['select-weight'] : NULL , isset($_GET['select-taste']) ? $_GET['select-taste'] : NULL);
        	else
				return $this->moreComments($category, $slug);
        }
    }
	
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show($category, $slug, $p_optionid, $p_tasteid) {
		$product = app('App\Http\Controllers\api\drugStore\productController');
		$page = $product->default_product($category,$slug, $p_optionid, $p_tasteid);
		$page = $page[0];
		// dd($page);
		if (is_null($page->productid)) 
			abort(404);
		$page->property = json_decode($page->property);
		$page->fani = json_decode($page->fani);
		if (!is_null($page->n_title)) {
			$page->n_title = explode(',', $page->n_title);
			$page->n_amount = explode(',', $page->n_amount);
			$page->n_dailyneed = explode(',', $page->n_dailyneed);
		}

		$all_taste = $product->all_taste($page->p_optionid);
		$tastes = '';

		foreach ($all_taste as $t) {
			if ($t->id == $page->p_tasteid)
				$page->p_taste = $t->taste;
			$tastes .= '<li class="p-1em" val="'.$t->id.'">'.$t->taste.'</li>';
		}

		$all_op = $product->all_op($page->productid);
		$options = '';
		foreach ($all_op as $op) {
			if ($op->id == $page->p_optionid)
				$page->p_option = $op->value;
			$options .= '<li class="p-1em" val="'.$op->id.'">'.$op->value.'</li>';
		}

		$img_path = str_replace(url('public'), public_path(), $page->img);
		$all_img = scandir($img_path.'/large');
		$all_img = array_diff($all_img, array('.', '..', '1.jpg'));

		$menu = app('App\Http\Controllers\api\menuController');
		$path = $menu->all_parent($page->navid);
		unset($path[0]);

        $score = app('App\Http\Controllers\api\drugStore\scoreController');
		$avgScore = $score->avg($page->productid);

        if (isset($_GET['comment']))
        	$cm_page = intval($_GET['comment']);
        else
        	$cm_page = 0;
        $comment = app('App\Http\Controllers\api\drugStore\commentController');
        $offset = 0;
        $limit = ($cm_page+1)*$this->comment_show;
        $comments = $comment->comments_of_page($page->productid, $offset, $limit);
        $comments_len = $comments['len'];
        $comments = $comments['comments'];

        // suggest
        $suggestion = app('App\Http\Controllers\api\drugStore\productController');
		$suggest = $suggestion->product_in_cats(array($path[sizeof($path)]->id), '', '', 0, 0, 'random', $page->productid);
        
		$data = array(
			'breadcrumb' 	=> $path,
			'page' 			=> $page,
			'all_op' 		=> $options,
			'all_taste' 	=> $tastes,
			'all_img' 		=> $all_img,
			'avgScore' 		=> $avgScore[0],
			'comments'		=> $comments,
			'cm_remained'	=> $comments_len - $limit,
			'cm_page'		=> $cm_page,
			'slug'			=> $slug,
			'suggests'		=> $suggest
		);

		if (\Session::has('userid')) {
        	$userid = \Session::get('userid');

        	$score = $score->get($page->productid, $userid);

        	$data['score'] = $score;
		}

		return view('drug_store.product')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function moreComments($category, $slug) {
		$product = app('App\Http\Controllers\api\drugStore\productController');
		$page = $product->default_product($category,$slug);
		$page = $page[0];
		if (is_null($page->title)) 
			abort(404);

		if (isset($_GET['comment']))
        	$cm_page = intval($_GET['comment']);
        else
        	$cm_page = 0;
        $comment = app('App\Http\Controllers\api\drugStore\commentController');
        $offset = $cm_page*$this->comment_show;
        $limit = $this->comment_show;
        $comments = $comment->comments_of_page($page->productid, $offset, $limit);
        $comments['comments'] = build_menu($comments['comments']);
        $comments['len'] = $comments['len'] - ($cm_page+1)*$this->comment_show;
        return $comments;
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function customization($category, $slug, $p_optionid, $p_tasteid) {
		$product = app('App\Http\Controllers\api\drugStore\productController');
		$page = $product->ajax_price($category, $slug, $p_optionid);
		if (sizeof($page) == 0)
			return '404';
		
		if (is_null($p_optionid))
			$p_optionid = $page[0]->opid;

		
		$all_taste = $product->all_taste($p_optionid);
		
		$tastes_op = '';
		foreach ($all_taste as $t) {
			if ($t->id == $p_tasteid)
				$taste = array('id' => $t->id, 'name' => $t->taste);
			$tastes_op .= '<li class="p-1em" val="'.$t->id.'">'.$t->taste.'</li>';
		}

		if (!isset($taste))
			$taste = array('id' => $all_taste[0]->id, 'name' => $all_taste[0]->taste);

		foreach ($page as $k => $p) {
			if ($p->p_tasteid != $taste['id'])
				// array_splice($page, $k, 1);
				unset($page[$k]);
		}
		$page = array_values($page);

		$img_path = str_replace(url('public'), public_path(), $page[0]->img);
		$all_img = scandir($img_path.'/large');
		$all_img = array_diff($all_img, array('.', '..', '1.jpg'));


		if (is_null($page[0]->{"nutrition_title"})) {
			$nutrition = '';
		} else {
			$nutrition_title = explode(',', $page[0]->{"nutrition_title"});
			$nutrition_amount = explode(',', $page[0]->{"nutrition_amount"});
			$nutrition_dailyneed = explode(',', $page[0]->{"nutrition_dailyneed"});
			$nutrition = '<div class="mr-y-1em">
							<div id="nutrition-value">
								<div>
									<table style="width: 100%">
										<caption>
											<div id="option-nutrition" class="flex">
												<div class="grow1">'.$taste["name"].'</div>
												<div>'.$page[0]->{"op"}.'</div>
											</div>
											<div id="Serving-Size">به ازای: '.$page[0]->{"serving_size"}.'</div>
										</caption>
										<thead>
											<tr>
												<th>هر سروینگ شامل</th>
												<th></th>
												<th>نیاز روزانه</th>
											</tr>
										</thead>
										<tbody>';
											for ($i=0; $i < sizeof($nutrition_title); $i++) { 
												$nutrition .= '<tr>
													<td>'.$nutrition_title[$i].'</td>
													<td>'.$nutrition_amount[$i].'</td>
													<td>'.$nutrition_dailyneed[$i].'</td>
												</tr>';
											}
										$nutrition .= '</tbody>
									</table>
								</div>
							</div>
						</div>';
		}
			
		if (isset($_GET["select-taste"]))
			$_GET["select-taste"] = $taste['id'];

		$page[0]->{"taste"} = $taste;
		$page[0]->{"tastes-list"} = $tastes_op;
		$page[0]->{"query-string"} = $_GET;
		$page[0]->{"other-img"} = $all_img;
		$page[0]->{"nutrition"} = $nutrition;
		$page[0]->{"op"} = array('id' => $p_optionid, 'name'=> $page[0]->{"op"});
		unset($page[0]->{"p_tasteid"});
		unset($page[0]->{"serving_size"});
		unset($page[0]->{"nutrition_title"});
		unset($page[0]->{"nutrition_amount"});
		unset($page[0]->{"nutrition_dailyneed"});

		return response($page, 200)
                  ->header('Vary', 'X-Requested-With,Accept-Encoding');
	}
}