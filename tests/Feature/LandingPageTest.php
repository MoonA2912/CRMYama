<?php

it('links the explore store button to the public catalog without a duplicate catalog button', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Explore Store')
        ->assertSee('href="'.route('catalog').'"', false)
        ->assertDontSee('Katalog');
});
