<?php
use App\Models\CategoryDetail;
use App\Models\Language;
use App\Models\PostDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/*
 * add string => '.prefixMin().'
 */

if (!function_exists('getCategoryDetailWithlanguageCode')) {
    function getCategoryDetailWithlanguageCode($categoryId, $code = '')
    {
        $language = Language::where('code', $code)->first();
        $categoryDetail = CategoryDetail::where(['category_id' => $categoryId, 'language_id' => $language->id])->first();

        return $categoryDetail;
    }
}

if (!function_exists('getPostDetailWithlanguageCode')) {
    function getPostDetailWithlanguageCode($postId, $code = '')
    {
        $language = Language::where('code', $code)->first();
        $postDetail = PostDetail::where(['post_id' => $postId, 'language_id' => $language->id])->first();

        return $postDetail;
    }
}

if (!function_exists('getAdminLogin')) {
    function getAdminLogin()
    {
        $adminLogin = Auth::user();

        return $adminLogin;
    }
}

if (!function_exists('uploadFileImage')) {
    function uploadFileImage($file, $pathUpload)
    {
        $result = "";
        if ($file !== null) {
            $type = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $validate = false;
            if (in_array($type, config('constant.type_image'))) {
                $validate = ($size <= config('constant.max_size_image')) ? true : false;
            }
            if ($validate) {
                $imageName = Str::random(10);
                $fileName = time() . '_' . $imageName . '.' . $type;
                if (Storage::disk('public')->putFileAs($pathUpload, $file, $fileName)) {
                    $result = $pathUpload . $fileName;
                } else {
                    throw new \Exception('error upload');
                }
            }
        }
        return $result;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($pathImage)
    {
        return Storage::disk('public')->delete($pathImage);
    }
}

if (!function_exists('assetStorage')) {
    function assetStorage($pathImage)
    {
        return asset('storage/' . $pathImage);
    }
}
