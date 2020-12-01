<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;

class profileController
{
    /**
     * 
     * 
     * @return 
     */
    public function getCustomer($userid) {
        $customers = DB::table('customers')
                    ->where('userid', '=', $userid)
                    ->get();
        
        return $customers;
    }

    /**
     * 
     * 
     * @return 
     */
    public function addCustomer($condition, $data) {
        DB::table('customers')->updateOrInsert($condition, $data);
        return 1;
    }

    /**
     * 
     * 
     * @return 
     */
    public function getAddress($customerid) {
        $addresses = DB::select("SELECT `address`.`id`, `address`, `postal_code`, `lat`, `lng`, `city`, `province`
                                FROM (SELECT * FROM `addresses` WHERE `customerid`=$customerid) AS `address`
                                INNER JOIN `cities`
                                ON `cities`.`id`=`address`.`cityid`
                                INNER JOIN `provinces`
                                ON `provinces`.`id`=`cities`.`provinceid`
                                ORDER BY `address`.`id` DESC");
        return $addresses;
    }

    /**
     * 
     * 
     * @return 
     */
    public function provinces() {
        $provinces = DB::table('provinces')
                    ->get();
        
        return $provinces;
    }

    /**
     * 
     * 
     * @return 
     */
    public function cities($provinceid) {
        $cities = DB::table('cities')
                    ->select('id', 'city')
                    ->where('provinceid', $provinceid)
                    ->get();
        
        return $cities;
    }

    /**
     * 
     * 
     * @return 
     */
    public function addAddress($data) {
        $addressid = DB::table('addresses')->insertGetId($data);
        return $addressid;
    }
}