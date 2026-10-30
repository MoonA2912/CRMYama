<?php

namespace App\Support;

use App\Exceptions\CloudinaryUploadException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class CloudinaryUploader
{
    public function upload(UploadedFile $file): string
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $uploadPreset = config('services.cloudinary.upload_preset');

        if (! is_string($cloudName) || $cloudName === '' || ! is_string($uploadPreset) || $uploadPreset === '') {
            throw new CloudinaryUploadException('Cloudinary is not configured.');
        }

        try {
            $response = Http::connectTimeout(5)
                ->timeout(30)
                ->attach(
                    'file',
                    $file->getContent(),
                    $file->getClientOriginalName()
                )
                ->post(
                    "https://api.cloudinary.com/v1_1/{$cloudName}/auto/upload",
                    ['upload_preset' => $uploadPreset]
                );
        } catch (ConnectionException $exception) {
            throw new CloudinaryUploadException(
                'Cloudinary could not be reached. Please try again.',
                previous: $exception
            );
        }

        if (! $response->successful()) {
            $message = $response->json('error.message');

            throw new CloudinaryUploadException(
                is_string($message) && $message !== ''
                    ? $message
                    : "Cloudinary upload failed with status {$response->status()}."
            );
        }

        $secureUrl = $response->json('secure_url');

        if (
            ! is_string($secureUrl)
            || filter_var($secureUrl, FILTER_VALIDATE_URL) === false
            || ! str_starts_with($secureUrl, 'https://')
        ) {
            throw new CloudinaryUploadException(
                'Cloudinary did not return a valid secure URL.'
            );
        }

        return $secureUrl;
    }
}
