<?php

app("router")->namespace("TunnelConflux\AutoJWT\Controllers")->group(function ($router) {
    // Authentication Routes...
    //$router->get('login', 'LoginController@showLoginForm')->name('login');
    //$router->post('login', 'LoginController@login');
    //$router->post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    if ($options['register'] ?? false) {
        $router->get('register', 'RegisterController@showRegistrationForm')->name('register');
        $router->post('register', 'RegisterController@register');
    }

    // Password Reset Routes...
    if ($options['reset'] ?? false) {
        $router->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $router->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        $router->post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    }

    // Email Verification Routes...
    if ($options['verify'] ?? false) {
        $router->get('email/verify', 'VerificationController@show')->name('verification.notice');
        $router->get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        $router->get('email/resend', 'VerificationController@resend')->name('verification.resend');
    }

    $router->middleware(['api'])->prefix('api')->name("api.")->group(function ($r) {
        $r->post('login', 'LoginController@login')->name("login");
        $r->post('logout', 'LoginController@logout')->name("logout");
        $r->post('refresh', 'LoginController@refresh')->name("refresh");
    });
});