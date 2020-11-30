<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class tasteController
{
    /**
     * 
     * 
     * @return 
     */
    public function get_taste() {
        $tastes = DB::table('dr_tastes')->get();
        return $tastes;
    }

    /**
     * 
     * 
     * @return 
     */
    public function insert($data) {
        $insert = DB::table('dr_tastes')->insert($data);
        return $insert;
    }
}