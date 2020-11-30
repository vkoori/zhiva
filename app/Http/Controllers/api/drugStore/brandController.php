<?php

namespace App\Http\Controllers\api\drugStore;
use Illuminate\Support\Facades\DB;

class brandController
{
    /**
     * 
     * 
     * @return 
     */
    public function get_countries() {
        $countries = DB::table('dr_countries')->get();
        return $countries;
    }

    /**
     * 
     * 
     * @return 
     */
    public function get_brans() {
        $brans = DB::table('dr_manufacturers')
                ->join('dr_countries', 'dr_countries.id', '=', 'dr_manufacturers.countryid')
                ->select('dr_manufacturers.id', 'dr_manufacturers.company', 'dr_manufacturers.website', 'dr_countries.country', 'dr_countries.flag')
                ->get();
        return $brans;
    }

    /**
     * 
     * 
     * @return 
     */
    public function add_brand($countryid, $company, $companyEn, $website) {
        $insert = DB::table('dr_manufacturers')->insert([
            'id'            => null,
            'countryid'     => $countryid,
            'company'       => $company,
            'company_en'    => $companyEn,
            'website'       => $website
        ]);
        return $insert;
    }

}