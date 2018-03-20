<?php

use App\Models\User;

Route::group([], function () {
    Auth::login(User::first());
    Route::get('/', 'DashboardController@index');
});

Route::post('/webhook/github', 'GitHubWebhookController@gitRepoReceivedPush');

Route::ohDearWebhooks('/oh-dear-webhooks');

