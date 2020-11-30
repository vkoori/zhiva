<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class tagController
{
    /**
     * 
     * 
     * @return 
     */
    public function get_tags() {
        $tags = DB::table('dr_tags')->get();
        return $tags;
    }

    /**
     * 
     * 
     * @return 
     */
    public function insert($data) {
        $id = $data['id'];
        $insert = $tag = DB::table('dr_tags')->updateOrInsert([
            'id' => $id,
        ], $data);

        return $insert;
    }

}