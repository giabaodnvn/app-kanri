<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait StorageFile
{
    /**
     * @param $url
     * @return bool
     */
    public function deleteFile($url)
    {
        return Storage::delete('public/'.$url);
    }

    /**
     * @param $file
     * @param string $pathUpload
     * @return string|null
     */
    public function storeFileImage($file, $pathUpload = '')
    {
        try {
            if (isset($file)) {
                $type = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $validate = false;
                if (in_array($type, config('constant.type_image'))) {
                    $validate = ($size <= config('constant.max_size_image')) ? true : false;
                }
                if ($validate) {
                    $name = Str::random(10);
                    $fileName = time() . '_' . $name . '.' . $type;
                    $file->move($pathUpload, $fileName);
                    return $pathUpload . $fileName;

                } else {
                    throw new \Exception('error upload');
                }
            } else {
                return "";
            }
        } catch (\Exception $e) {
            return null;
        }
    }

}
