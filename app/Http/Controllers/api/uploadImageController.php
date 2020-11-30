<?php

namespace App\Http\Controllers\api;
// use Spatie\ImageOptimizer\OptimizerChainFactory;

class uploadImageController
{
    /**
     * 
     * 
     * @return 
     */
    public function upload_single($temp,$origin,$imageFolder) {
        /***************************************************
        * Only these origins are allowed to upload images *
        ***************************************************/
        $accepted_origins = array("http://localhost", "http://127.0.0.1", "http://propeykar.com");

        /*********************************************
        * Change this line to set the upload folder *
        *********************************************/
        if (is_uploaded_file($temp['tmp_name'])){
            if ($origin) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($origin, $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $origin);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }


            // Check if file already exists
            $img_name = $temp['name'];
            $index = 1;
            while (file_exists($imageFolder.$img_name)) {
                $img_name = $index . "-" . $temp['name'];
                $index ++;
            }

            $check = getimagesize($temp["tmp_name"]);
            if($check[0] > 2048 && $check[1] > 2048){
                header("HTTP/1.1 400 ابعاد تصویر باید کوچکتر از 2048 در 2048 باشد.");
            }

            // Check file size
            if ($temp["size"] > 2097152) {
                header("HTTP/1.1 400 حداکثر حجم فایل ".(2097152/1048576)." mb میتواند باشد.");
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            move_uploaded_file($temp['tmp_name'], $imageFolder.$img_name);

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            return $img_name;
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }

    }

    /**
     * 
     * 
     * @return 
     */
    public function upload_multi($temps,$origin,$imageFolder) {
        for ($key=0; $key < sizeof($temps["name"]); $key++) { 
            $temp = array(
                "name"      => $temps["name"][$key],
                "type"      => $temps["type"][$key],
                "tmp_name"  => $temps["tmp_name"][$key],
                "error"     => $temps["error"][$key],
                "size"      => $temps["size"][$key]
            );
            return $this->upload_single($temp,$origin,$imageFolder);
        }
    }

    /**
     * 
     * 
     * @return 
     */
    public function tinyCompress($filetowrite) {
        try {
            \Tinify\setKey("Tm4cDShX32b0TGBDygw8FrFNtYjJmYLt"); // Alternatively, you can store your key in .env file.
            $source = \Tinify\fromFile($filetowrite);
            $source->toFile($filetowrite);
        } catch(\Tinify\AccountException $e) {
            // Verify your API key and account limit.
            return $e->getMessage();
        } catch(\Tinify\ClientException $e) {
            // Check your source image and request options.
            return $e->getMessage();
        } catch(\Tinify\ServerException $e) {
            // Temporary issue with the Tinify API.
            return $e->getMessage();
        } catch(\Tinify\ConnectionException $e) {
            // A network connection error occurred.
            return $e->getMessage();
        } catch(Exception $e) {
            // Something else went wrong, unrelated to the Tinify API.
            return $e->getMessage();
        }
    }


    /**
     * 
     * 
     * @return 
     */
    public function resizeimages ($file, $save , $size) {
        if (!file_exists(dirname($save))) {
            mkdir(dirname($save), 0777, true);
        }

        list($width, $height) = getimagesize($file) ;
        $modwidth = $size;
        $diff = $width / $modwidth;
        $modheight = $height / $diff;
        $tn = imagecreatetruecolor($modwidth, $modheight) ;
        imagealphablending($tn, false);
        imagesavealpha($tn, true);

        switch ( pathinfo( $file, PATHINFO_EXTENSION )) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($file) ;
                imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                imagejpeg($tn, $save, 100) ;
            break;

            case 'png':
                $image = imagecreatefrompng($file);
                imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                imagepng($tn, $save, 4) ;
            break;

            case 'gif':
                $image = imagecreatefromgif($file);
                imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                imagegif($tn, $save) ;
            break;

            default:
                throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
        }
        return 1;
    }

    /**
     * 
     * 
     * @return 
     */
    public function resizeImageTmp ($file, $target_filename , $maxDim) {
        $file_name = $file['tmp_name'];
        list($width, $height, $type, $attr) = getimagesize( $file_name );
        if ( $width > $maxDim || $height > $maxDim ) {
            // $target_filename = $file_name;
            $ratio = $width/$height;
            if( $ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim/$ratio;
            } else {
                $new_width = $maxDim*$ratio;
                $new_height = $maxDim;
            }
            $src = imagecreatefromstring( file_get_contents( $file_name ) );
            $dst = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagedestroy( $src );
            imagepng( $dst, $target_filename ); // adjust format as needed
            imagedestroy( $dst );
            return $target_filename;
        }
        abort(403, 'width or height must be greater than 32px!');
        return;
    }

    /**
     * 
     * 
     * @return 
     */
    public function supplementInfo() {
        $imageFolder = public_path()."/supplement/info/".date("y-m")."/";
        $urlbase = url("public/supplement/info/".date("y-m"));
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder, 0775);
        }

        reset ($_FILES);
        $temp = current($_FILES);

        if (isset($_SERVER['HTTP_ORIGIN']))
            $origin = $_SERVER['HTTP_ORIGIN'];
        else
            $origin = FALSE;

        $img = $this->upload_single($temp,$origin,$imageFolder);
        
        # image optimizer
        // $optimizerChain = OptimizerChainFactory::create();
        // $optimizerChain->optimize($imageFolder.$img);
        # tinypng
        $this->tinyCompress($imageFolder.$img);

        if (getimagesize($imageFolder.$img)[0] > 400) {
            $this->resizeimages ($imageFolder.$img, $imageFolder.'mobile/'.$img , 400); 
            // $optimizerChain->optimize($imageFolder.'mobile/'.$img);
            $this->tinyCompress($imageFolder.'mobile/'.$img);
        }
        if (getimagesize($imageFolder.$img)[0] > 720) {
            $this->resizeimages ($imageFolder.$img, $imageFolder.'tablet/'.$img , 720);
            // $optimizerChain->optimize($imageFolder.'tablet/'.$img);
            $this->tinyCompress($imageFolder.'tablet/'.$img);
        }

        //     sizes="(max-width: 768px) 720px, (max-width: 425px) 400px, orginalpx"

        
        return json_encode(array('location' => $urlbase."/".$img));
    }

    /**
     * 
     * 
     * @return 
     */
    public function categories() {
        $imageFolder = public_path()."/categories/";
        $urlbase = url("public/categories/");
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder, 0775);
        }

        reset ($_FILES);
        $temp = current($_FILES);

        if (isset($_SERVER['HTTP_ORIGIN']))
            $origin = $_SERVER['HTTP_ORIGIN'];
        else
            $origin = FALSE;

        $img = $this->upload_single($temp,$origin,$imageFolder);
        
        # image optimizer
        // $optimizerChain = OptimizerChainFactory::create();
        // $optimizerChain->optimize($imageFolder.$img);
        # tinypng
        $this->tinyCompress($imageFolder.$img);

        if (getimagesize($imageFolder.$img)[0] > 400) {
            $this->resizeimages ($imageFolder.$img, $imageFolder.'mobile/'.$img , 400); 
            // $optimizerChain->optimize($imageFolder.'mobile/'.$img);
            $this->tinyCompress($imageFolder.'mobile/'.$img);
        }
        if (getimagesize($imageFolder.$img)[0] > 720) {
            $this->resizeimages ($imageFolder.$img, $imageFolder.'tablet/'.$img , 720);
            // $optimizerChain->optimize($imageFolder.'tablet/'.$img);
            $this->tinyCompress($imageFolder.'tablet/'.$img);
        }

        //     sizes="(max-width: 768px) 720px, (max-width: 425px) 400px, orginalpx"

        
        return json_encode(array('location' => $urlbase."/".$img));
    }

    public function taste() {
        $imageFolder = public_path()."/taste/";
        $urlbase = url("public/taste/");
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder, 0775);
        }

        reset ($_FILES);
        $temp = current($_FILES);

        if (isset($_SERVER['HTTP_ORIGIN']))
            $origin = $_SERVER['HTTP_ORIGIN'];
        else
            $origin = FALSE;

        // Check if file already exists
        $img_name = $temp['name'];
        $index = 1;
        while (file_exists($imageFolder.$img_name)) {
            $img_name = $index . "-" . $temp['name'];
            $index ++;
        }

        $img = $this->resizeImageTmp($temp,$imageFolder.$img_name,32);
        
        # image optimizer
        // $optimizerChain = OptimizerChainFactory::create();
        // $optimizerChain->optimize($img);
        # tinypng
        $this->tinyCompress($img);

        return $urlbase."/".$img_name;
    }


    public function product($pid,$opid,$ptid,$key) {
        $temp = $_FILES[$key];

        if ($ptid == null)
            $ptid = 0;
        $imageFolder = public_path()."/supplement/products/$pid/$opid-$ptid/large/";
        $imageFolderRoot = public_path()."/supplement/products/$pid/$opid-$ptid/";
        $urlbase = url("public/supplement/products/$pid/$opid-$ptid/");
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder, 0775, true);
        }

        if (isset($_SERVER['HTTP_ORIGIN']))
            $origin = $_SERVER['HTTP_ORIGIN'];
        else
            $origin = FALSE;

        $img = $this->upload_multi($temp,$origin,$imageFolder);
        
        # image optimizer
        // $optimizerChain = OptimizerChainFactory::create();
        // $optimizerChain->optimize($imageFolder.$img);
        # tinypng
        $this->tinyCompress($imageFolder.$img);
        
        if (getimagesize($imageFolder.$img)[0] > 75) {
            $this->resizeimages ($imageFolder.$img, $imageFolderRoot.'thumbnail/'.$img , 75);
            // $optimizerChain->optimize($imageFolder.'thumbnail/'.$img);
            $this->tinyCompress($imageFolder.'thumbnail/'.$img);
        }
        if (getimagesize($imageFolder.$img)[0] > 250) {
            $this->resizeimages ($imageFolder.$img, $imageFolderRoot.'medium/'.$img , 250);
            // $optimizerChain->optimize($imageFolder.'medium/'.$img);
            $this->tinyCompress($imageFolder.'medium/'.$img);
        }

        return $urlbase;
    }

}

// sudo dnf install epel-release
// sudo dnf install jpegoptim
// sudo dnf install optipng
// sudo dnf install pngquant
// sudo npm install -g svgo
// sudo dnf install gifsicle
// sudo dnf install libwebp-tools