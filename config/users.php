<?php

return [
    'url_prefix' => 'system',
    'model' => \Iyngaran\User\Tests\Models\User::class,
    'defaults' => [
        'per-page' => 5,
        'order-by' => 'created_at',
        'order-in' => 'DESC',
    ],
    'default_status' => 1, // is_active
    'default_role' => ['Guest'],
    'allow_users_to_register' => true,
    'middleware' => ['auth:sanctum'],
    // the fields validation for user registration
    'user_registration_fields' => [
        'name' => 'required',
        'email' => 'required|email',
        'mobile',
        'password' => 'required',
        'password_confirmation' => 'required|same:password',
        'company_name'
    ],
    // the fields validation for user create and update profile
    'user_fields' => [
        'name' => 'required',
        'email' => 'required|email',
        'mobile',
        'password',
        'is_active',
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'mobile',
        'phone',
        'profile_picture',
        'website_address',
        'social_media_links',
        'location_lat',
        'location_lon',
        'extra_fields',
    ],
];
