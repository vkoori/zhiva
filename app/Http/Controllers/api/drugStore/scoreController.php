<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class scoreController
{
    /**
     * 
     * 
     * @return 
     */
    public function insert($condition, $data) {
        $insert = DB::table('dr_scores')->updateOrInsert($condition, $data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function get($productid, $userid) {
        $score = DB::table('dr_scores')
                ->where('productid', $productid)
                ->where('userid', $userid)
                ->get();
        return $score;
    }

    /**
     * 
     * 
     * @return 
     */
    public function avg($productid) {
        $avgScore = DB::table('dr_scores')
                ->where('productid', $productid)
                ->selectRaw('avg(score1) AS s1, avg(score2) AS s2, avg(score3) AS s3, count(id) as countScore')
                ->get();
        return $avgScore;
    }

}