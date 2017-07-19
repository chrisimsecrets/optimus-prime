<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ImageUpload extends Controller
{
    /**
     * @param Request $re
     * @return \Illuminate\Http\JsonResponse
     */
    public function iup(Request $re)
    {
        $file = $re->file('file');
        $fileName = date('YmdHis');
        $fileType = $file->getClientMimeType();
        if ($fileType == 'image/jpeg' || $fileType == 'image/png') {

            try {
                Input::file('file')->move(public_path() . '/uploads/', $fileName . "." . $file->getClientOriginalExtension());
                return response()->json(["status" => "success", "fileName" => $fileName . "." . $file->getClientOriginalExtension()]);
            } catch (\Exception $e) {
                echo "error";
            }
        } else {
            echo "invalid File";
        }
    }

    public function contentUpload(Request $request)
    {
        try {
            $img = $request->imageData;
            $fileName = date('YmdHis');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = public_path() . '/uploads/' . $fileName . '.png';
            file_put_contents($file, $data);

//            convert png to jpg

            $jpgImage = imagecreatefrompng(public_path() . '/uploads/' . $fileName . '.png');
            imagejpeg($jpgImage, public_path() . '/uploads/' . $fileName . '.jpg', 90);
            imagedestroy($jpgImage);
            return response()->json([
                "status" => "success",
                "fileName" => $fileName . '.jpg'
            ]);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }


}
