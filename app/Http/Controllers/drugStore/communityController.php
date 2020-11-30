<?php

namespace App\Http\Controllers\drugStore;
use Browser;

class communityController
{
    /**
     * 
     * 
     * @return 
     */
    public function __construct() {
        if (!\Session::has('userid'))
            return json_encode(false);
    }

    /**
     * 
     * 
     * @return 
     */
    public function setScore() {
        date_default_timezone_set('Asia/Tehran');
        $now = date('Y-m-d H:i:s');

        $condition = array(
            "productid"     => $_POST["pid"],
            "userid"        => \Session::get('userid')
        );
        $data = array(
            "productid"     => $_POST["pid"],
            "score1"        => $_POST["score1"],
            "score2"        => $_POST["score2"],
            "score3"        => $_POST["score3"],
            "userid"        => \Session::get('userid'),
            "insert_time"   => $now,
            "ip"            => request()->ip(),
            "device"        => Browser::deviceFamily().' - '.Browser::platformName().' - '.Browser::browserName()
        );

        $score = app('App\Http\Controllers\api\drugStore\scoreController');
        $result = $score->insert($condition, $data);
        return json_encode($result);
    }

    /**
     * 
     * 
     * @return 
     */
    public function setComment() {
        date_default_timezone_set('Asia/Tehran');
        $now = date('Y-m-d H:i:s');

        $replay = (isset($_POST['parent'])) ? $_POST['parent'] : null ;

        $data = array(
            "id"            => null,
            "productid"     => $_POST["pid"],
            "userid"        => \Session::get('userid'),
            "approved"      => 0,
            "comment"       => $_POST["comment"],
            "replay"        => $replay,
            "insert_time"   => $now,
            "ip"            => request()->ip(),
            "device"        => Browser::deviceFamily().' - '.Browser::platformName().' - '.Browser::browserName()
        );

        $score = app('App\Http\Controllers\api\drugStore\commentController');
        $result = $score->insert($data);
        return $result;
    }

}