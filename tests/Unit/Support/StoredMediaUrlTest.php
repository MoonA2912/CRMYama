<?php

use App\Support\StoredMediaUrl;
use Tests\TestCase;

uses(TestCase::class);

it('keeps Cloudinary URLs intact', function () {
    $url = 'https://res.cloudinary.com/demo/image/upload/sample.jpg';

    expect(StoredMediaUrl::resolve($url))->toBe($url);
});

it('resolves existing local media paths through public storage', function () {
    expect(StoredMediaUrl::resolve('products/sample.jpg'))
        ->toBe(asset('storage/products/sample.jpg'));
});

it('returns null when no media path is stored', function () {
    expect(StoredMediaUrl::resolve(null))->toBeNull();
});
