<?php
namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class Upload {

    public function __construct() {

    }

    /**
     * 上传图片
     * @param $files
     * @param $sizes
     * @param string $path
     * @return array
     */
    public function uploadImage($files, $sizes, $path = false) {
        if(!$path){
            $destinationPath = 'upload/'.date('Ymd');
        }else{
            $destinationPath = 'upload/'.$path.'/'.date('Ymd').'/';
        }

        if (!file_exists(public_path($destinationPath))) {
            mkdir(public_path($destinationPath), 0777, true);
        }

        $filesResponse = array();
        if(is_array($files)){
            foreach($files as $file){
                if(!$file->isValid()){
                    return false;
                }
                $fileName = str_random(10).'.jpg';
                $file->move($destinationPath, $fileName);

                $filesResponse[] = array('relativePath' => $destinationPath, 'name' => $fileName);
            }
        } else {
            if(!$files->isValid()){
                return false;
            }
            $fileName = str_random(10).'.jpg';

            $files->move($destinationPath, $fileName);

            $filesResponse[] = array('relativePath' => $destinationPath, 'name' => $fileName);
        }

        //压缩处理
        foreach($filesResponse as $file){
            foreach($sizes as $name => $size){
                if (!file_exists(public_path($file['relativePath'].'/'.$name))) {
                    mkdir(public_path($file['relativePath'].'/'.$name), 0777);
                }
                $image = Image::make(public_path($file['relativePath'].'/'.$file['name']));
                // 根据照片的exif信息处理（旋转）图片
                $this->execute($image);
                $image->fit($size['width'], $size['height'],null,'center')
                    ->save(public_path($file['relativePath'].'/'.$name.'/'.$file['name']));
            }
        }

        return $filesResponse;
    }


    /**
     * 上传文件
     * @param $files
     * @param string $path
     * @return array
     */
    public function uploadFile($files, $path = false){
        if(!$path){
            $destinationPath = 'upload/file/'.date('Ymd');
        }else{
            $destinationPath = $path;
        }

        if (!file_exists(public_path($destinationPath))) {
            mkdir(public_path($destinationPath), 0777, true);
        }

        $filesResponse = array();
        if(is_array($files)){
            foreach($files as $file){
                if(!$file->isValid()){
                    return false;
                }
                $extension = $file->getClientOriginalExtension();
                $fileName = str_random(10).'.'.$extension;
                $file->move($destinationPath, $fileName);

                $filesResponse[] = array('relativePath' => $destinationPath, 'name' => $fileName);
            }
        } else {
            if(!$files->isValid()){
                return false;
            }
            $extension = $files->getClientOriginalExtension();
            $fileName = str_random(10).'.'.$extension;

            $files->move($destinationPath, $fileName);

            $filesResponse[] = array('relativePath' => $destinationPath, 'name' => $fileName);
        }
        return $filesResponse;
    }

    /**
     * Correct image orientation according to Exif data
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        switch ($image->exif('Orientation')) {

            case 2:
                $image->flip();
                break;

            case 3:
                $image->rotate(180);
                break;

            case 4:
                $image->rotate(180)->flip();
                break;

            case 5:
                $image->rotate(270)->flip();
                break;

            case 6:
                $image->rotate(270);
                break;

            case 7:
                $image->rotate(90)->flip();
                break;

            case 8:
                $image->rotate(90);
                break;
        }

        return true;
    }
}
