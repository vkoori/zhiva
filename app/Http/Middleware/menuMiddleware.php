<?php

namespace App\Http\Middleware;

use Closure;

class menuMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        $jsonFile = app_path().'\Http\Controllers\admin\menu.json';
        $menuJson = fopen($jsonFile, "r") or die("Unable to open menu!");
        $myJson = fread($menuJson,filesize($jsonFile));
        fclose($menuJson);
        $myJson = json_decode($myJson);
        // dd($request->is('shop/*'));
        


        if ($request->is('mag/*')) {

        } elseif ($request->is('coach/*')) {
        
        } else {
            $menu = $myJson[0]->children;
            unset($myJson[0]);
        }

        $nav = '';
        foreach ($menu as $key => $mainMenu) {
            if ($key == 0)
                $class = 'class="sub-nav-active"';
            else
                $class = '';

            $nav .= '<li '.$class.'>
                        <a href="'.url($mainMenu->slug).'" title="'.$mainMenu->name.'">'.$mainMenu->name.'</a>
                        <div class="flex sub-menu">
                            <div class="DesktopSubNavList">
                                <ul>';
                                    foreach ($mainMenu->children as $subMenu) {
                                        $nav .= '<li><a href="'.$subMenu->slug.'" title="'.$subMenu->name.'">'.$subMenu->name.'</a></li>';
                                    }
                                $nav .= '</ul>
                            </div>';
                            switch ($mainMenu->feature) {
                                case '1':
                                    $nav .= $this->protein();
                                    break;
                                case '2':
                                    $nav .= $this->performance();
                                    break;
                                case '3':
                                    $nav .= $this->weightManagement();
                                    break;
                                default:
                                    break;
                            }
                        $nav .= '</div>
                    </li>';
        }



        

        $request->merge(array("nav" => $nav));

        return $next($request);
    }

    /**
     * 
     */
    private function performance() {
        return '<div class="DesktopSubNavFeatures">
                    <h3 class="h4">Performance Features</h3>
                    <div>
                        <ul class="flex">
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/2.jpg').'" alt="">
                                    <h6>Energy Drinks</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/2.jpg').'" alt="">
                                    <h6>Energy Drinks</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/2.jpg').'" alt="">
                                    <h6>Energy Drinks</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/2.jpg').'" alt="">
                                    <h6>Energy Drinks</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
    }

    /**
     * 
     */
    private function protein() {
        return '<div class="DesktopSubNavFeatures">
                    <h3 class="h4">Protein Features</h3>
                    <div>
                        <ul class="flex">
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/1.jpg').'" alt="">
                                    <h6>Signature Series</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/1.jpg').'" alt="">
                                    <h6>Signature Series</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/1.jpg').'" alt="">
                                    <h6>Signature Series</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/1.jpg').'" alt="">
                                    <h6>Signature Series</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
    }

    /**
     * 
     */
    private function weightManagement() {
        return '<div class="DesktopSubNavFeatures">
                    <h3 class="h4">Weight Management Features</h3>
                    <div>
                        <ul class="flex">
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/3.jpg').'" alt="">
                                    <h6>Fat Burners from EVL</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/3.jpg').'" alt="">
                                    <h6>Fat Burners from EVL</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/3.jpg').'" alt="">
                                    <h6>Fat Burners from EVL</h6>
                                </a>
                            </li>
                            <li>
                                <a href="" title="">
                                    <img src="'.asset('public/assets/images/menu/3.jpg').'" alt="">
                                    <h6>Fat Burners from EVL</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
    }

}