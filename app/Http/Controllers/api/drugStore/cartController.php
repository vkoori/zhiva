<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class cartController
{
    /**
     * 
     * 
     * @return 
     */
    public function add_sms_list($productid, $p_optionid, $p_tasteid, $userid) {
        $sms = DB::select("INSERT INTO `dr_short_message_services`(`id`, `productid`, `userid`) 
                    VALUES (NULL,(SELECT `productid` FROM `dr_product_details` WHERE `productid`=$productid AND `p_optionid`=$p_optionid AND `p_tasteid`=$p_tasteid),$userid)");
        return $sms;
    }

    /**
     * 
     * 
     * @return 
     */
    public function products_of_cart($productid, $p_optionid, $p_tasteid) {
        $cart = DB::select("SELECT `details`.*, `dr_products`.`fa_name`, `dr_products`.`en_name`, `dr_meta_products`.`slug`, `dr_product_options`.`type`, `dr_product_options`.`value`, `dr_product_options`.`price`, `dr_tastes`.`taste`, `dr_tastes`.`icon`, `navigations`.`slug` AS `category` 
                            FROM (SELECT `img`,`stock`,`off` FROM `dr_product_details` WHERE `productid`=$productid AND `p_optionid`=$p_optionid AND `p_tasteid`=$p_tasteid) AS `details`
                            INNER JOIN `dr_products`
                            ON `dr_products`.`id`=$productid
                            INNER JOIN `dr_meta_products`
                            ON `dr_meta_products`.`id`=`dr_products`.`metaid`
                            INNER JOIN `dr_product_options`
                            ON `dr_product_options`.`id`=$p_optionid
                            INNER JOIN `dr_tastes`
                            ON `dr_tastes`.`id`=$p_tasteid
                            INNER JOIN `dr_product_navs`
                            ON `dr_product_navs`.`productid`=$productid AND `dr_product_navs`.`is_default`=1
                            INNER JOIN `navigations`
                            ON `navigations`.`id`=`dr_product_navs`.`navid`");
        return $cart;
    }

}