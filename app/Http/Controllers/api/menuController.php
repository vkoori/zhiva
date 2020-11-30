<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;

class menuController
{
    /**
     * 
     * 
     * @return 
     */
    public function getMenu() {
        $menu = DB::table('navigations')
                // ->select('id as navid', 'lft', 'rgt', 'name', 'slug', 'feature')
                ->orderBy('lft', 'ASC')->get();
        return $menu;
    }

    /**
     * 
     * 
     * @return 
     */
    public function getMyMenu($id) {
        $menu = DB::table('navigations')
                ->where('navigations.id', $id)
                ->leftJoin('meta_navigations', 'meta_navigations.navid', '=', 'navigations.id')
                ->select('navigations.name', 'meta_navigations.*')
                ->get();
        return $menu;
    }

    /**
     * 
     * 
     * @return 
     */
    public function lastLevel() {
        $menu = DB::table('navigations')
                ->whereRaw('rgt-lft = 1')
                ->get();
        return $menu;
    }

    /**
     * 
     * 
     * @return 
     */
    public function insertMeta($data) {
        $navid = $data['navid'];
        $menu = DB::table('meta_navigations')->updateOrInsert([
            'navid' => $navid,
        ], $data);

        return $menu;
    }

    /**
     * 
     * 
     * @return 
     */
    public function deleteMenu($ids) {
        $delete = DB::table('navigations')->whereNotIn('id', $ids)->delete();
        return $delete;

    }

    /**
     * 
     * 
     * @return 
     */
    public function insertMenu($data) {
        $insert = DB::table('navigations')->insert($data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function updateMenu($data) {
        $id = $data['navid'];
        unset($data['navid']);
        $update = DB::table('navigations')->where('id', $id)->update($data);
        return $update;
    }

    /**
     * 
     * 
     * @return 
     */
    public function all_parent($nodeid) {
        $parents = DB::table(DB::raw('navigations AS n1, navigations AS n2'))
                    ->whereRaw('n2.lft<=n1.lft AND n2.rgt>=n1.rgt AND n1.id='.$nodeid)
                    ->select('n2.*')
                    ->orderBy('n2.lft', 'asc')
                    ->get();
        return $parents;
    }

    /**
     * 
     * 
     * @return 
     */
    public function path_nodes($slug) {
        $parents = DB::table(DB::raw('navigations AS n1, navigations AS n2'))
                    ->whereRaw('((n2.lft<=n1.lft AND n2.rgt>=n1.rgt) OR (n2.lft>n1.lft AND n2.rgt<n1.rgt)) AND n1.slug="'.$slug.'"')
                    ->select('n2.*')
                    ->orderBy('n2.lft', 'asc')
                    ->get();
        return $parents;
    }

}