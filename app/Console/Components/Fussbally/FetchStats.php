<?php

namespace App\Console\Components\Fussbally;

use App\Events\Fussbally\StatsFetched;
use App\Events\Service\FeedbackFetched;
use GuzzleHttp\Client;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use http\Env\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class FetchStats extends Command
{
    protected $signature = 'dashboard:fetch-fussbally';

    protected $description = 'Fetch fussbally stats';

    public function handle()
    {
        $client = new Client();
        $stats = json_decode($client->request('GET', config('services.fussbally.url'))->getBody()->getContents(), true);

        $cleanStats = [];
        $i = 0;
        foreach ($stats['stats']['users'] as $user) {
            if ($i++ > 10) {
                break;
            }
            $cleanStats[] = [
                'name' => $user['name'],
                'trueskill' => $user['trueskill'],
                'trueskill_difference' => $user['trueskill_difference'],
            ];
        }

        event(new StatsFetched($cleanStats));
    }
}
