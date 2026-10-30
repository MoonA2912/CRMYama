<?php

use App\Exceptions\CloudinaryUploadException;
use App\Support\CloudinaryUploader;
use Illuminate\Http\Client\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

uses(TestCase::class);

it('returns the secure URL from a successful Cloudinary upload', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'secure_url' => 'https://res.cloudinary.com/test-cloud/image/upload/product.png',
        ]),
    ]);

    $url = app(CloudinaryUploader::class)->upload(
        UploadedFile::fake()->image('product.png')
    );

    expect($url)->toBe('https://res.cloudinary.com/test-cloud/image/upload/product.png');

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.cloudinary.com/v1_1/test-cloud/auto/upload');
});

it('reports Cloudinary API errors without saving an invalid URL', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'error' => ['message' => 'Upload preset is invalid.'],
        ], 400),
    ]);

    expect(fn () => app(CloudinaryUploader::class)->upload(
        UploadedFile::fake()->image('product.png')
    ))->toThrow(CloudinaryUploadException::class, 'Upload preset is invalid.');
});

it('reports a clear error when Cloudinary is not configured', function () {
    config([
        'services.cloudinary.cloud_name' => null,
        'services.cloudinary.upload_preset' => null,
    ]);

    Http::preventStrayRequests();

    expect(fn () => app(CloudinaryUploader::class)->upload(
        UploadedFile::fake()->image('product.png')
    ))->toThrow(CloudinaryUploadException::class, 'Cloudinary is not configured.');
});
