<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function uploadFile(Request $request)
    {
        $uploadedImage = $request->file('upload');

        if ( ! $uploadedImage) {
            return [
                'uploaded' => false,
                'error'    => [
                    'message' => 'Не было отправлено изображение'
                ]
            ];
        }

        $path = $uploadedImage->store('uploads', 'public');

        if ($path) {
            return [
                'uploaded' => true,
                'url'      => asset('storage/' . $path)
            ];
        } else {
            return [
                'uploaded' => false,
                'error'    => [
                    'message' => 'Не удалось загрузить изображение'
                ]
            ];
        }
        // Respond to the successful upload with JSON.


    }
}
