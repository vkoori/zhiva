<?php

namespace App\Http\Controllers\admin;

class menuController
{

	private $navIds = array();
	private $insertMenu = array();
	private $updateMenu = array();
	private $lft = 0;

	/**
	 * 
	 * 
	 * @return 
	 */
	public function show() {
		// $menu = app('App\Http\Controllers\api\menuController');
		// $menuArr = $menu->getMenu();
		// $myJson = $this->fetchMenu($menuArr);
		// $myJson = json_encode($myJson);
		$jsonFile = app_path().'\Http\Controllers\admin\menu.json';
		$menuJson = fopen($jsonFile, "r") or die("Unable to open menu!");
		$myJson = fread($menuJson,filesize($jsonFile));
		fclose($menuJson);

		return view('admin.menu')->with('menu', $myJson);
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	private function fetchMenu($menuArr) {
		$myJson = array();
		foreach ($menuArr as $item) {
			$added = $this->recursiveFindParent($myJson, $item);
			if (!$added) {
				array_push($myJson, $item);
			}
		}
		return $myJson;
	}

	private function recursiveFindParent($myJson, $item) {
		$added = false;
		foreach ($myJson as $arm) {
			if ($item->lft > $arm->lft AND $item->rgt < $arm->rgt) {
				if (isset($arm->children)) {
					$added = $this->recursiveFindParent($arm->children, $item);
					if (!$added) {
						array_push($arm->children, $item);
						return true;
					}
				} else {
					$arm->children = array($item);
					return true;
				}
			}
		}
		return $added;
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function save() {
		$menu = $_POST['menu'];
		
		$jsonFile = app_path().'\Http\Controllers\admin\menu.json';
		$menuJson = fopen($jsonFile, "w") or die("Unable to open menu!");
		fwrite($menuJson, $menu);
		fclose($menuJson);

		$menu = json_decode($menu);

		$this->recursiveWlak($menu);

		$menu = app('App\Http\Controllers\api\menuController');
		# delete
		if (sizeof($this->navIds) > 0) {
			$menu->deleteMenu($this->navIds);
		}

		# update
		foreach ($this->updateMenu as $item) {
			$menu->updateMenu($item);
		}

		#insert
		if (sizeof($this->insertMenu) > 0) {
			$menu->insertMenu($this->insertMenu);
		}


		return redirect('admin/menu-management')->with('success', 'ثبت شد');
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	private function recursiveWlak($menu) {
		foreach ($menu as $item) {
			$this->lft ++;
			switch ($item->cat) {
				case '1':
					$slug = 'shop/';
					break;
				case '2':
					$slug = 'blog/';
					break;
				case '3':
					$slug = 'coaches/';
					break;
				default:
					dd('Error on selecting category');
					break;
			}
			if ($item->slug != '')
				$slug .= urlencode($item->slug);
			// else
			// 	$slug .= urlencode($item->name);

			$navItem = array(
				'name' => $item->name,
				'slug' => $slug,
				'feature' => ($item->feature == "-") ? 0 : $item->feature,
				'lft' => $this->lft
			);
			if (isset($item->children)) {
				$this->recursiveWlak($item->children);
			}
			$this->lft ++;
			$navItem['rgt'] = $this->lft;
			if ($item->navid != "") {
				$navItem['navid'] = $item->navid;
				array_push($this->navIds, $item->navid);
				array_push($this->updateMenu, $navItem);
			} else {
				array_push($this->insertMenu, $navItem);
			}
		}
		return 0;
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function meta($item = null) {
		if ($item == null) {
			$menu = app('App\Http\Controllers\api\menuController');
			$menuArr = $menu->getMenu();
			return view('admin.select-menu')->with('menu', $menuArr);
		} else {
			$menu = app('App\Http\Controllers\api\menuController');
			$thisMenu = $menu->getMyMenu($item);

			$data = array(
				'id' => $item,
				'menu' => $thisMenu
			);

			return view('admin.meta-menu')->with($data);
		}
	}

	/**
	 * 
	 * 
	 * @return 
	 */
	public function insertMeta($navid) {
		$rules = [
			'title' => array('required'),
			'keywords' => array('required'),
			'description' => array('required'),
			'content-menu' => array('required')
		];

		$customMessages = [
			'title.required' => 'تایتل وارد نشده است.',
			'keywords.required' => 'کلمات کلیدی وارد نشده است.',
			'description.required' => 'description وارد نشده است.',
			'content-menu.required' => 'متن صفحه وارد نشده است.'
		];

		request()->validate($rules, $customMessages);
		
		$data = array(
			'navid' => $navid,
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'keywords' => $_POST['keywords'],
			'content' => $_POST['content-menu']
		);

		$menu = app('App\Http\Controllers\api\menuController');
		$thisMenu = $menu->insertMeta($data);

		return redirect('admin/menu-details/'.$navid)->with('success', 'ثبت شد');
	}
}