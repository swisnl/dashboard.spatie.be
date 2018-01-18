<?php

namespace App\Console\Components\Service;

use App\Events\Service\FeedbackFetched;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use http\Env\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class FetchFeedback extends Command
{
    protected $signature = 'dashboard:fetch-feedback';

    protected $description = 'Fetch service feedback';

    public function handle(HttpClient $client)
    {

        $request = MessageFactoryDiscovery::find()->createRequest('GET', config());
        $feedback = json_decode($client->sendRequest($request), true);

        event(new FeedbackFetched($feedback));
    }
}
