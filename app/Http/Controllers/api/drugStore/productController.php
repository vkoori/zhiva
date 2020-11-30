<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class productController
{
    /**
     * 
     * 
     * @return 
     */
    public function add_meta($title, $description, $keywords, $slug, $canonical=null, $redirect=null) {
        $postfix = 1;
        $prefix = $slug;
        while (1) {
            $exist = DB::table('dr_meta_products')->where('slug', $slug)->get();
            if (sizeof($exist) == 0)
                break;
            $slug = $prefix.'-'.$postfix;
            $postfix ++;
        }
        
        $id = DB::table('dr_meta_products')->insertGetId([
            'id'            => null,
            'title'         => $title,
            'description'   => $description,
            'keywords'      => $keywords,
            'slug'          => $slug,
            'canonical'     => $canonical,
            'redirect'      => $redirect
        ]);

        return $id;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_product($metaid, $fa_name, $en_name, $serving_size, $visit=0, $darft=1) {
        $id = DB::table('dr_products')->insertGetId([
            'id'            => null,
            'metaid'        => $metaid,
            'fa_name'       => $fa_name,
            'en_name'       => $en_name,
            'serving_size'  => $serving_size,
            'visit'         => $visit,
            'darft'         => $darft
        ]);

        return $id;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_properties($productid, $property,$fani) {
        $insert = DB::table('dr_properties')->insert([
            'id'            => null,
            'productid'     => $productid,
            'property'      => $property,
            'fani'      => $fani
        ]);

        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_brand($manufacturerid, $productid) {
        $insert = DB::table('dr_product_manufacturers')->insert([
            'id'                => null,
            'manufacturerid'    => $manufacturerid,
            'productid'         => $productid
        ]);

        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_filter($data) {
        $insert = DB::table('dr_meta_tags')->insert($data);

        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_cat($data) {
        $insert = DB::table('dr_product_navs')->insert($data);

        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_op($data) {
        $id = DB::table('dr_product_options')->insertGetId($data);
        return $id;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_product_taste($data) {
        $insert = DB::table('dr_product_tastes')->insert($data);
        // return DB::getPdo()->lastInsertId();
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_product_detail($data) {
        $insert = DB::table('dr_product_details')->insert($data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_nutrition($data) {
        $insert = DB::table('dr_nutritions')->insert($data);
        return $insert;
    }

    /**
     * 
     * 
     * @return 
     */
    public function update_product($id, $data) {
        $affected = DB::table('dr_products')
              ->where('id', $id)
              ->update($data);
        return $affected;
    }

    /**
     * 
     * 
     * @return 
     */
    public function default_product($category, $slug, $p_optionid, $p_tasteid) {
        if (is_null($p_optionid))
            $condition = "`dr_product_details`.`is_default` = 1";
        else
            $condition = "`dr_product_details`.`p_optionid` = $p_optionid AND `dr_product_details`.`p_tasteid` = $p_tasteid";

        $product = DB::select("select `page`.`title`, `description`, `keywords`, `page`.`slug`, `canonical`, `redirect`, `fa_name`, `en_name`, `serving_size`, `dr_product_details`.`productid`, `dr_product_details`.`p_optionid`, `dr_product_details`.`p_tasteid`, `img`, `stock`, `off`, GROUP_CONCAT(dr_nutritions.title) AS n_title, GROUP_CONCAT(dr_nutritions.amount) AS n_amount, GROUP_CONCAT(dr_nutritions.dailyneed) AS n_dailyneed, `country`, `flag`, `company`, `company_en`, `website`, `property`, `fani`, `price`, `navid` 
        from (SELECT * FROM `dr_meta_products` WHERE `slug` = '".$slug."') AS `page`
        inner join `dr_products` 
        on `dr_products`.`metaid` = `page`.`id` AND `darft` = 0
        inner join `dr_product_details` 
        on `dr_product_details`.`productid` = `dr_products`.`id` AND $condition
        inner join `dr_product_options` 
        on `dr_product_options`.`id` = `dr_product_details`.`p_optionid` 
        left join `dr_nutritions` 
        on `dr_nutritions`.`productid` = `dr_product_details`.`productid` and `dr_nutritions`.`p_optionid` = `dr_product_details`.`p_optionid` and `dr_nutritions`.`p_tasteid` = `dr_product_details`.`p_tasteid` 
        inner join `dr_product_manufacturers` 
        on `dr_product_manufacturers`.`productid` = `dr_products`.`id` 
        inner join `dr_manufacturers` 
        on `dr_product_manufacturers`.`manufacturerid` = `dr_manufacturers`.`id` 
        inner join `dr_countries` 
        on `dr_manufacturers`.`countryid` = `dr_countries`.`id` 
        inner join `dr_properties` 
        on `dr_properties`.`productid` = `dr_products`.`id` 
        inner join `dr_product_navs` 
        on `dr_product_navs`.`productid` = `dr_products`.`id`# AND `dr_product_navs`.`is_default` = 1
        inner join `navigations`
        on `navigations`.`id`=`dr_product_navs`.`navid` AND `navigations`.`slug`='".$category."'");

        return $product;
    }

    /**
     * 
     * 
     * @return 
     */
    public function ajax_price($category, $slug, $p_optionid) {
        if (is_null($p_optionid)) {
            $condition1 = "";
            $condition2 = "`dr_product_details`.`is_default`=1 AND `dr_product_details`.`p_optionid`=`dr_product_options`.`id`";
        } else {
            $condition1 = "AND `dr_product_options`.`id`=$p_optionid";
            $condition2 = "`dr_product_details`.`p_optionid`=`dr_product_options`.`id`";
        }

        $product = DB::select("SELECT `serving_size`, `dr_product_options`.`id` AS `opid`, `price`, `value` AS `op`, `img`, `stock`, `off`, `dr_product_details`.`p_tasteid`, GROUP_CONCAT(`dr_nutritions`.`title`) AS `nutrition_title`, GROUP_CONCAT(`amount`) AS `nutrition_amount`, GROUP_CONCAT(`dailyneed`) AS `nutrition_dailyneed`
                    FROM (SELECT * FROM `dr_meta_products` WHERE `dr_meta_products`.`slug`='".$slug."') AS `page` 
                    INNER JOIN `dr_products` 
                    ON `dr_products`.`metaid`=`page`.`id` AND `dr_products`.`darft`=0
                    INNER JOIN `dr_product_options` 
                    ON `dr_product_options`.`productid`=`dr_products`.`id` ".$condition1." 
                    INNER JOIN `dr_product_navs` 
                    ON `dr_product_navs`.`productid`=`dr_products`.`id` 
                    INNER JOIN `navigations` 
                    ON `navigations`.`slug`='".$category."'
                    INNER JOIN `dr_product_details`
                    ON `dr_product_details`.`productid`=`dr_products`.`id` AND ".$condition2."
                    LEFT JOIN `dr_nutritions`
                    ON `dr_nutritions`.`productid`=`dr_product_details`.`productid` AND `dr_nutritions`.`p_optionid`=`dr_product_details`.`p_optionid` AND `dr_nutritions`.`p_tasteid`=`dr_product_details`.`p_tasteid`
                    GROUP BY `dr_nutritions`.`p_optionid`,`dr_nutritions`.`p_tasteid`");

        return $product;
    }

    /**
     * 
     * 
     * @return 
     */
    public function all_op($pid) {
        $all_op = DB::table('dr_product_options')
                ->where('productid', $pid)
                ->get();

        return $all_op;
    }

    /**
     * 
     * 
     * @return 
     */
    public function all_taste($op) {
        $all_taste = DB::table('dr_product_tastes')
                ->where('optionid', $op)
                ->join('dr_tastes', 'dr_tastes.id', '=', 'dr_product_tastes.tasteid')
                ->select('dr_tastes.*')
                ->get();

        return $all_taste;
    }

    /**
     * 
     * 
     * @return 
     */
    public function product_in_cats($navIds, $brand, $tag, $score, $pageNum, $sort, $pageid=0) {
        // for suggest
        if ($pageid !=0)
            $not_this = " AND `productid`<>{$pageid} ";
        else
            $not_this = '';
        $sql = "SELECT CONCAT(`pids`.`slug`, '/' , `dr_meta_products`.`slug`) AS `slug`, `dr_products`.`visit`, `dr_products`.`fa_name`, `dr_product_options`.`price`, `dr_product_details`.`img`, `dr_product_details`.`stock`, `dr_product_details`.`off`, GROUP_CONCAT(`op2`.`id`) AS op, GROUP_CONCAT(`dr_product_tastes`.`tasteid`) AS taste, `op2`.`type`, `company`, `company_en`, `score`
                FROM (SELECT `dr_product_navs`.`productid`, `slug`, 
                    (CASE
                        WHEN `score1` IS NULL THEN 0
                        ELSE (SUM(`score1`)+SUM(`score2`)+SUM(`score3`))/(3*COUNT(`score3`))*20 
                    END) AS `score`
                        FROM `dr_product_navs` 
                        INNER JOIN `navigations` 
                        ON `navigations`.`id` = `dr_product_navs`.`navid` AND `navigations`.`id` IN (".implode(',', $navIds).")".$not_this."
                        LEFT JOIN `dr_scores`
                        ON `dr_scores`.`productid`=`dr_product_navs`.`productid` 
                        GROUP BY `dr_product_navs`.`productid`
                    ) AS `pids`
                INNER JOIN `dr_products` 
                ON `dr_products`.`id` = `pids`.`productid` AND `dr_products`.`darft` = 0
                INNER JOIN `dr_meta_products` 
                ON `dr_meta_products`.`id` = `dr_products`.`metaid` AND `dr_meta_products`.`redirect` is null
                INNER JOIN `dr_product_details` 
                ON `dr_product_details`.`productid` = `dr_products`.`id` AND `dr_product_details`.`is_default` = 1 
                INNER JOIN `dr_product_options` 
                ON `dr_product_options`.`id` = `dr_product_details`.`p_optionid` 
                INNER JOIN `dr_product_options` as `op2` 
                ON `op2`.`productid` = `dr_products`.`id` 
                LEFT JOIN `dr_product_tastes` 
                ON `dr_product_tastes`.`optionid` = `op2`.`id` 
                INNER JOIN `dr_product_manufacturers` 
                ON `dr_product_manufacturers`.`productid` = `dr_products`.`id` 
                INNER JOIN `dr_manufacturers` ";

            if ($brand != '')
                $sql .= "ON `dr_product_manufacturers`.`manufacturerid` = `dr_manufacturers`.`id` AND `dr_manufacturers`.`id` IN (".implode(',', $brand).") ";
            else
                $sql .= "ON `dr_product_manufacturers`.`manufacturerid` = `dr_manufacturers`.`id` ";

                
                $sql .= "INNER JOIN `dr_meta_tags` ";
            if ($tag != '')
                $sql .= "ON `dr_meta_tags`.`productid` = `dr_products`.`id` AND `dr_meta_tags`.`tagid` IN (".implode(',', $tag).") ";
            else
                $sql .= "ON `dr_meta_tags`.`productid` = `dr_products`.`id` ";

                $sql .= "WHERE `score`>=".strval(intval($score)*20)."
                        GROUP BY `dr_meta_products`.`slug` ";

            switch ($sort) {
                case 2:
                    $sql .= 'ORDER BY dr_product_options.price - dr_product_details.off ASC ';
                    break;
                case 3:
                    $sql .= 'ORDER BY dr_product_options.price - dr_product_details.off DESC ';
                    break;
                case 4:
                    $sql .= 'ORDER BY dr_products.visit ASC ';
                    break;
                case 5:
                    $sql .= 'ORDER BY `dr_product_options`.`price` - `dr_product_details`.`off` ASC '; # not correct
                    break;
                case 'random':
                    $sql .= 'ORDER BY RAND() ';
                    break;
            }

                $sql .= "LIMIT 12 
                OFFSET ".strval(12*$pageNum);

        $products = DB::Select($sql);
        
        return $products;
    }

}