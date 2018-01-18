<?php

namespace App\Console\Components\Service;

use App\Events\Service\FeedbackFetched;
use GuzzleHttp\Client;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use http\Env\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class FetchFeedback extends Command
{
    protected $signature = 'dashboard:fetch-feedback';

    protected $description = 'Fetch service feedback';

    public function handle()
    {
        $httpClient = new Client();
        $url = config('services.feedback.url');
        $feedback = json_decode($httpClient->request('GET', $url)->getBody()->getContents(), true);

        event(new FeedbackFetched($feedback));
    }
}
