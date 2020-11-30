<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class mustLogin {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level='0') {

        if (!session()->exists('userid'))
            return redirect('ورود?back='.url()->full());
        
        $level = explode('-', $level);
        if (in_array('0', $level)) {
            return $next($request);
        } else {
            $userid = session()->get('userid');
            $users = app('App\Http\Controllers\api\userController');
            $accessibility = $users->accessibility($userid);
            $accessibility = $accessibility[0]->accessibility;
            if (in_array(strval($accessibility), $level)) {
                $news = $this->new($userid);
                switch ($accessibility) {
                    case 1:
                        $dr_comments = $this->dr_comments();
                        $blog_comments = $this->blog_comments();
                        $factors = $this->factors();
                        break;
                    case 2:
                        $dr_comments = $this->dr_comments();
                        $blog_comments = 0;
                        break;
                    case 3:
                        # code...
                        break;
                    default:
                        # code...
                        break;
                }

                $notif = array(
                    "news"          => $news,
                    "dr_comments"   => $dr_comments,
                    "blog_comments" => $blog_comments,
                    "factors"       => $factors
                );
                view()->share($notif);

                return $next($request);
            } else {
                abort(403, 'شما اجازه دسترسی به این صفحه را ندارید');
            }
        }
    }

    /**
     *
     *
     * @return 
     */
    private function new($userid) {
        date_default_timezone_set('Asia/Tehran');
        $now = date('Y-m-d H:i:s');

        $news = DB::table('news')
                ->where('userid', $userid)
                ->where('seen', 0)
                ->WhereRaw('(JSON_EXTRACT(`custom`, "$.expire") IS NULL OR JSON_EXTRACT(`custom`, "$.expire") > "'.$now.'")')
                ->orderBy('created_at', 'desc')
                ->get();

        return $news;
    }

    /**
     *
     *
     * @return 
     */
    private function dr_comments() {
        $dr_comments = DB::table('dr_comments')
                        ->where('approved', 0)
                        ->orderBy('insert_time', 'desc')
                        ->selectRaw('count(id) AS dr_c')
                        ->get();

        return $dr_comments[0]->dr_c;
    }

    /**
     *
     *
     * @return 
     */
    private function blog_comments() {
        // $dr_comments = DB::table('dr_comments')
        //                 ->where('approved', 0)
        //                 ->orderBy('insert_time', 'desc')
        //                 ->selectRaw('count(id)')
        //                 ->get();

        return 0;
    }

    /**
     *
     *
     * @return 
     */
    private function factors() {
        // $dr_comments = DB::table('dr_comments')
        //                 ->where('approved', 0)
        //                 ->orderBy('insert_time', 'desc')
        //                 ->selectRaw('count(id)')
        //                 ->get();

        return 0;
    }
}