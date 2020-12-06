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
                        <a href="'.url($this->prefix_slug($mainMenu->cat).$mainMenu->slug).'" title="'.$mainMenu->name.'">'.$mainMenu->name.'</a>
                        <div class="flex sub-menu">
                            <div class="DesktopSubNavList">
                                <ul>';
                                    foreach ($mainMenu->children as $subMenu) {
                                        $nav .= '<li><a href="'.url($this->prefix_slug($mainMenu->cat).$subMenu->slug).'" title="'.$subMenu->name.'">'.$subMenu->name.'</a></li>';
                                    }
                                $nav .= '</ul>
                            </div>';
                            $nav .= $this->feature($mainMenu->feature);
                        $nav .= '</div>
                    </li>';
        }


        $leftNav = '';
        foreach ($myJson as $mainMenu) {
            $leftNav .= '<li class="other-nav">
                            <a href="'.url($this->prefix_slug($mainMenu->cat).$mainMenu->slug).'" title="'.$mainMenu->name.'">'.$mainMenu->name.'</a>
                            <div class="flex sub-menu">';
                                foreach ($mainMenu->children as $key => $subMenu) {
                                    if ($key % 2 == 0) {
                                        if ($key == 0) 
                                            $leftNav .= '<div class="DesktopSubNavList">';
                                        else
                                            $leftNav .= '</div><div class="DesktopSubNavList">';
                                    }
                                    
                                    $leftNav .= '
                                        <h3 class="h5 bold">
                                            <a href="'.url($this->prefix_slug($mainMenu->cat).$subMenu->slug).'">'.$subMenu->name.'</a>
                                        </h3>
                                        <ul>';
                                            foreach ($subMenu->children as $littleSub) {
                                                $leftNav .= '<li><a href="'.url($this->prefix_slug($mainMenu->cat).$littleSub->slug).'" title="'.$littleSub->name.'">'.$littleSub->name.'</a></li>';
                                            }
                                            
                                        $leftNav .= '</ul>';
                                }
                                $leftNav .= '</div>';
                                $leftNav .= $this->feature($mainMenu->feature);
                            $leftNav .= '</div>
                        </li>';
        }
      
        $request->merge(array("nav" => $nav.$leftNav));

        return $next($request);
    }


    /**
     * 
     */
    private function prefix_slug($cat) {
        switch ($cat) {
            case '1':
                $result = 'shop/';
                break;
            case '2':
                $result = 'blog/';
                break;
            case '3':
                $result = 'coaches/';
                break;
            default:
                $result = '';
                break;
        }
        return $result;
    }

    /**
     * 
     */
    private function feature($f) {
        switch ($f) {
            case '1':
                $result = $this->protein();
                break;
            case '2':
                $result = $this->performance();
                break;
            case '3':
                $result = $this->weightManagement();
                break;
            default:
                $result = '';
                break;
        }
        return $result;
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