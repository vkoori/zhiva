<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Crypt;

class mediaLibraryController
{
    /**
     * 
     * 
     * @return 
     */
    public function show() {
        if (isset($_GET["dir"]))
            $Mydir = $_GET["dir"];
        else
            $Mydir = "";
        $Mydir = "/".urldecode($Mydir);

        $back = explode("/", $Mydir);
        array_pop($back);
        $back = implode("/", $back);
        $back = ltrim($back, "/");

        if ($Mydir == "/")
            $folders = '';
        else
            $folders = '<a class="mb-1 p-1 block border" href="'.url('admin/media-library').'?dir='.urlencode($back).'" title="back"><i class="ft-folder"></i>..</a>';
        $files = '';

        if ($this->startsWith($Mydir,"/assets") || 
            $this->endsWith($Mydir,"/mobile") || 
            $this->endsWith($Mydir,"/tablet") ||
            $this->contains($Mydir,"/products")) {
            $scan = array();
            $files = '<div class="alert alert-danger d-inline-block">دسترسی شما به این پوشه محدود شده است.</div>';
        } else {
            $scan = public_path().$Mydir;
            $scan = scandir($scan,0);
            $scan = array_slice($scan,2);
        }

        foreach ($scan as $item) {
            $relative_dir = ltrim($Mydir."/".$item,"/");
            if (is_dir(public_path()."/".$relative_dir)) {
                $folders .= '<a class="mb-1 p-1 block border" href="'.url('admin/media-library').'?dir='.urlencode($relative_dir).'" title="'.$item.'"><i class="ft-folder"></i>'.$item.'</a>';
            } else {
                $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                $asset_dir = asset("public/".$relative_dir);
                if (in_array($extension, array("gif", "jpg", "jpeg", "png"))) {
                    $bg = 'style="background-image:url(\''.$asset_dir.'\');"';
                    $txt = '';
                } else {
                    $bg = '';
                    $txt = 'data-name="'.$item.'"';
                }
                $files .= '<span class="border d-inline-block position-relative"'.$bg.' '.$txt.' onclick="mediaDetail(\''.$asset_dir.'\');"></span>';
            }
        }

        $data = array(
            "Mydir" => $Mydir,
            "folders" => $folders,
            "files" => $files
        );
        return view('admin.media')->with($data);
    }

    /**
     * check string start with ...
     * @return boolean
     */
    public function startsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        return substr( $haystack, 0, $length ) === $needle;
    }

    /**
     * check string end with ...
     * @return boolean
     */
    public function endsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length )
            return true;
        return substr( $haystack, -$length ) === $needle;
    }

    /**
     * check string contains ...
     * @return boolean
     */
    public function contains( $haystack, $needle ) {
        if (strpos($haystack, $needle) !== false)
            return true;
        else
            return false;
    }


}