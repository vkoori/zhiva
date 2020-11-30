<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;

class userController
{
    /**
     * 
     * 
     * @return 
     */
    public function get($mobile) {
        $user = DB::table('users')
                    ->where('mobile', $mobile)
                    ->get();
        return $user;
    }

    /**
     * 
     * 
     * @return 
     */
    public function accessibility($id) {
        $user = DB::table('users')
                    ->where('id', $id)
                    ->select('accessibility')
                    ->get();
        return $user;
    }

    /**
     * 
     * 
     * @return 
     */
    public function activationKey($token) {
        $userkey = DB::table('activations')
                    ->where('public_key', $token)
                    ->get();
        return $userkey;
    }

    /**
     * 
     * 
     * @return 
     */
    public function activationKey2($userid) {
        $userkey = DB::table('activations')
                    ->where('userid', $userid)
                    ->get();
        return $userkey;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add($data) {
        $id = $data['id'];
        unset($data['id']);
        $userid = DB::table('users')->updateOrInsert([
            'id' => $id,
        ], $data);

        return DB::getPdo()->lastInsertId();
    }

    /**
     * 
     * 
     * @return 
     */
    public function addKey($data) {
        $public_key = $data['public_key'];
        $key = DB::table('activations')->updateOrInsert([
            'public_key' => $public_key,
        ],$data);

        return $key;
    }

    /**
     * 
     * 
     * @return 
     */
    public function pass($token) {
        $pass = DB::table('activations')
                    ->where('public_key', $token)
                    ->join('users', 'users.id', 'activations.userid')
                    ->select('users.pass', 'users.id')
                    ->get();
        return $pass;
    }
}