<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CloudinaryController extends Controller
{
    private const folder_path = 'tutorial';

    public static function path($path){
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function upload($image, $filename, $folder = null){
        // Fix SSL verification issue on local Windows development
        if (config('app.env') === 'local') {
            // Temporarily disable SSL verification for this request
            $streamOptions = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);
            stream_context_set_default([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);
        }
        
        $newFilename = str_replace(' ', '_', $filename);
        $public_id = date('Y-m-d_His').'_'.$newFilename;
        $uploadFolder = $folder ?? self::folder_path;
        
        $result = cloudinary()->upload($image, [
            "public_id" => self::path($public_id),
            "folder"    => $uploadFolder
        ])->getSecurePath();

        return $result;
    }

    public static function replace($path, $image, $public_id){
        self::delete($path);
        return self::upload($image, $public_id);
    }

    public static function delete($path, $folder = null){
        $deleteFolder = $folder ?? self::folder_path;
        $public_id = $deleteFolder.'/'.self::path($path);
        return cloudinary()->destroy($public_id);
    }
}
