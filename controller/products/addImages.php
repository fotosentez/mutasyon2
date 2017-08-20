<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
require_once(dirname(__FILE__).'/../../model/settings/pic_upload.php'); // Get pic_upload for resize to image

$productId = Get::getValue('productId');

//Get image informations
$image = $_FILES['file']['tmp_name'];
$imagename = $_FILES['file']['name'];
$imagetype = $_FILES['file']['type'];
$imagesize = $_FILES['file']['size'];

$vimage = 0;
$vfolder = 0;
if($imagename){
    if($imagesize <= 2097152 AND $imagesize > 0){
        if($imagetype == "image/jpeg" OR $imagetype == "image/jpg"){
            $vimage = 1;
        }
        else{
            echo Lang::getLang('fileNotJpg');
            exit();
        }
    }
    else{
        echo Lang::getLang('fileVeryBig');
        exit();
    }
}
else{
    echo Lang::getLang('notAnyFile');
    exit();
}

//If images is validate
if($vimage == 1){
    if(Check::control('numeric', $productId, "", true)){
        //Check for product is exist or not
        $checkProduct = Dbase::isExist('products', 'products_id = '.$productId.' ');
        
        if($checkProduct ==1){
            //Make folders 
            $folder = "../../view/img/products/" . $productId;
            $folderBig = "../../view/img/products/" . $productId . "/big";
            $folderSmall = "../../view/img/products/" . $productId . "/small";
            
            if (!file_exists($folderBig) OR !file_exists($folderSmall) OR !file_exists($folder)) {
                if(!file_exists($folder)){
                    mkdir($folder, 0775);
                    copy("../../model/files/index.php", $folder."/index.php");
                }
                if(!file_exists($folderBig)){
                    mkdir($folderBig, 0775);
                    copy("../../model/files/index.php", $folderBig."/index.php");
                }
                if(!file_exists($folderSmall)){
                    mkdir($folderSmall, 0775);
                    copy("../../model/files/index.php", $folderSmall."/index.php");
                }
                $vfolder = 1;
            }
            else{
                $vfolder = 1;
            }
        }
        else{
            Lang::getLang('productNotFound');
            exit();
        }
    }
}

//Copy image to that folder and write to image database
if($vimage == 1 AND $vfolder == 1){
    //Get informations from db of image
    $isCover = Dbase::getRow('products_images', 'products_images_product = '.$productId.' AND products_images_cover = 1', 'products_images_cover');

    if(!$isCover){
        $cover = 1;
    }
    else{
        $cover = 0;
    }
    
    //Write image to database
    $table = 'products_images';
    		$values = array(
                    'products_images_product' => $productId,
                    'products_images_cover' => $cover,
                    'products_images_status' => 1,
        		);
    $insert = Dbase::insert($table, $values );
    $imageId = Dbase::getRow('products_images', 'products_images_product = '.$productId.' AND products_images_cover = '.$cover.' ORDER BY products_images_id DESC ', 'products_images_id');
    
    //Copy image to that folder
    if($imageId){
        $type = "jpg";
        for ($y = 0; $y<2; $y++)
        {
            if($y == 0)
            {
                $sizeX = 490;
                $newImageName = "big";
                $dizin = $folderBig;
            }
            elseif($y == 1)
            {
                $sizeX = 90;
                $newImageName = "small";
                $dizin = $folderSmall;
            }
            $foo = new Upload($image); 
            if ($foo->uploaded) 
            {
                $foo->file_overwrite = true;
                $foo->file_new_name_body = $imageId;
                $foo->jpeg_quality = 90;
                $foo->image_convert = $type;
                $foo->image_resize= true;
                $foo->image_x	= $sizeX;
                $foo->image_ratio_y = true;
                $foo->Process($dizin);
            }
        }//for ($i = 0; $i<2; $i++)
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv(".primages");
    }
    else{
        echo Lang::getLang('writeDBError');
    }
}

