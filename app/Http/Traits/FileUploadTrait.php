<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 11:58 PM
 */

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


trait FileUploadTrait
{
    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFiles(Request $request)
    {

        $uploadPath = "storage/gallery/uploads";
        $thumbPath = "storage/gallery/thumbs";
        $previewPath = "storage/gallery/preview";
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0775, true);
            mkdir($thumbPath, 0775, true);
        }

        $finalRequest = $request;

        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                if ($request->has($key . '_max_width') && $request->has($key . '_max_height')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();

                    $ext = $request->file($key)->clientExtension();
                    if(!strpos($filename, '.')) {
                        $filename .= '.' . $ext;
                    }
                    $file = $request->file($key);
                    $image = Image::make($file);
                    if (!file_exists($thumbPath)) {
                        mkdir($thumbPath, 0775, true);
                    }
                    if (!file_exists($previewPath)) {
                        mkdir($previewPath, 0775, true);
                    }
                    Image::make($file)->resize(100, 100)->save($thumbPath . '/' . $filename);
                    Image::make($file)->resize(480, 480)->save($previewPath . '/' . $filename);
                    $width = $image->width();
                    $height = $image->height();
                    if ($width > $request->{$key . '_max_width'} && $height > $request->{$key . '_max_height'}) {
                        $image->resize($request->{$key . '_max_width'}, $request->{$key . '_max_height'});
                    } elseif ($width > $request->{$key . '_max_width'}) {
                        $image->resize($request->{$key . '_max_width'}, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } elseif ($height > $request->{$key . '_max_width'}) {
                        $image->resize(null, $request->{$key . '_max_height'}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $image->save($uploadPath . '/' . $filename, 75);
                    $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                } else {
                    $file = $request->file($key);
                    if (!file_exists($thumbPath)) {
                        mkdir($thumbPath, 0775, true);
                    }
                    $filename = time() . '-' . config('photo');

                    Image::make($file)->resize(150, 150)->save($thumbPath . '/' . $filename);
                    $request->file($key)->move($uploadPath, $filename);
                    $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                }
            }
        }

        return $finalRequest;
    }

    protected function uploadPath()
    {
        throw new \Exception('Method must be overriden');
    }

    protected function previewPath()
    {
        throw new \Exception('Method must be overriden');
    }

    protected function thumbsPath()
    {
        throw new \Exception('Method must be overriden');
    }
}
