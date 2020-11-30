<?php

namespace App\Http\Controllers\admin\drugStore;

class tagController
{
	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		$tags = app('App\Http\Controllers\api\drugStore\tagController');
		$tags = $tags->get_tags();

		return view('admin.drug_store.tag')->with('tags', $tags);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insert() {
		$id = ($_POST['id'] == '') ? null : $_POST['id'];
		$data = array(
			'id' => $id,
			'name' => $_POST['name']
		);

		$tags = app('App\Http\Controllers\api\drugStore\tagController');
		$tags = $tags->insert($data);

		return redirect('admin/drug-store/tags')->with('success', 'ثبت شد');
	}
}