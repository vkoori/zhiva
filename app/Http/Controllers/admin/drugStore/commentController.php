<?php

namespace App\Http\Controllers\admin\drugStore;

class commentController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		if (isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 0;

		$comment = app('App\Http\Controllers\api\drugStore\commentController');
		$comments = $comment->get($page);

		$data = array(
			'comments' => $comments,
			'page' => $page
		);

		return view('admin.drug_store.comment-list')->with($data);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function show_cm($id) {
		$comment = app('App\Http\Controllers\api\drugStore\commentController');
		$cm = $comment->get_cm($id);

		return view('admin.drug_store.comment')->with('comment', $cm[0]);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function update($id) {
		switch ($_POST['approved']) {
			case 'تایید عمومی':
				$approved = 1;
				break;
			case 'تایید خصوصی':
				$approved = 2;
				break;
			default:
				$approved = 3;
				break;
		}
		$data = array(
			'comment' => $_POST['comment'],
			'approved' => $approved
		);
		$comment = app('App\Http\Controllers\api\drugStore\commentController');
		$cm = $comment->update($id, $data);

		return redirect(url('admin/drug-store/comments'));
	}

}