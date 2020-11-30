<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class commentController
{
    /**
     * 
     * 
     * @return 
     */
    public function insert($data) {
        $insert = DB::table('dr_comments')->insert($data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function get($page=0) {
        $comments = DB::table('dr_comments')
                    ->whereRaw('dr_comments.approved <> 3')
                    ->leftJoin('customers', 'customers.userid', '=', 'dr_comments.userid')
                    ->join('dr_products', 'dr_products.id', '=', 'dr_comments.productid')
                    ->select('dr_comments.id', 'dr_comments.approved', 'dr_comments.comment', 'dr_comments.replay', 'dr_comments.insert_time', 'customers.name', 'customers.familiy', 'dr_products.fa_name')
                    ->offset(10*$page)
                    ->limit(10)
                    ->orderBy('insert_time', 'desc')
                    ->get();
        return $comments;
    }

    /**
     * 
     * 
     * @return 
     */
    public function get_cm($id) {
        $comment = DB::table('dr_comments')
                    ->where('dr_comments.id', $id)
                    ->join('dr_products', 'dr_products.id', '=', 'dr_comments.productid')
                    ->select('dr_comments.id', 'dr_comments.approved', 'dr_comments.comment', 'dr_comments.replay', 'dr_comments.insert_time', 'dr_products.fa_name')
                    ->get();
        return $comment;
    }

    /**
     * 
     * 
     * @return 
     */
    public function update($id, $data) {
        $insert = DB::table('dr_comments')
                ->where('id', $id)
                ->update($data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function comments_of_page($productid, $offset=0, $limit=5) {
        $len = DB::table('dr_comments')
                ->selectRaw('COUNT(id) AS count')
                ->where('productid', $productid)
                ->where('approved', 1)
                ->whereNull('replay')
                ->count();

        $first_level = DB::table('dr_comments')
                ->select('dr_comments.id')
                ->where('productid', $productid)
                ->where('approved', 1)
                ->whereNull('replay')
                // ->leftjoin('customers', 'customers.userid', '=', 'dr_comments.userid')
                ->offset($offset)
                ->limit($limit)
                ->orderBy('insert_time', 'desc')
                ->pluck('id')
                ->toArray();

        if (sizeof($first_level) > 0)
            $comments = $this->comment_tree(implode(',', $first_level));
        else
            $comments = [];


        $result = array(
            'comments'  => $comments,
            'len'       => $len
        );

        return $result;
    }

    /**
     * 
     * 
     * @return 
     */
    public function comment_tree($first_level) {
        $comments = DB::select(
            'WITH RECURSIVE waterfall_comment (id, userid, comment, insert_time, replay) AS 
            ( 
                SELECT id, userid, comment, insert_time, replay 
                FROM `dr_comments` 
                WHERE `id` IN ('.$first_level.')
                UNION ALL 
                SELECT c.id, c.userid, c.comment, c.insert_time, c.replay
                FROM waterfall_comment AS w
                INNER JOIN dr_comments AS c 
                ON w.id = c.replay AND `c`.`approved`=1
            ) 
            SELECT waterfall_comment.id, replay, comment, insert_time, name, familiy
            FROM waterfall_comment 
            LEFT JOIN `customers`
            ON `customers`.`userid`=`waterfall_comment`.`userid`
            ORDER BY insert_time DESC'
        );
        
        return $comments;
    }
}