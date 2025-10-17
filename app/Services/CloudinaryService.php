<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);
    }

    public function uploadVideo($file, $folder = 'lessons')
    {
        $result = $this->cloudinary->uploadApi()->upload($file, [
            'resource_type' => 'video',
            'folder' => $folder,
            'transformation' => [
                'quality' => 'auto',
            ],
        ]);

        return $result;
    }

    public function generateThumbnail($publicId)
    {
        return $this->cloudinary->image($publicId)
            ->format('jpg')
            ->effect('preview')
            ->toUrl();
    }

    public function deleteVideo($publicId)
    {
        return $this->cloudinary->uploadApi()->destroy($publicId, [
            'resource_type' => 'video',
        ]);
    }
}
