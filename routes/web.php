<?php

use App\Models\User;

Route::group([], function () {
    Auth::login(User::first());
    Route::get('/', 'DashboardController@index');
    Route::get('/update', 'DashboardController@update');
});

Route::post('/webhook/github', 'GitHubWebhookController@gitRepoReceivedPush');

Route::ohDearWebhooks('/oh-dear-webhooks');

