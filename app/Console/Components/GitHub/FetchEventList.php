<?php

namespace App\Console\Components\GitHub;

use App\Events\GitHub\EventsFetched;
use Illuminate\Console\Command;
use App\Services\GitHub\GitHubApi;

class FetchEventList extends Command
{
    protected $signature = 'dashboard:fetch-github-events';

    protected $description = 'Fetch GitHub events';

    public function handle(GitHubApi $gitHub)
    {
        $userName = config('services.github.username');

        $events = $gitHub->fetchEvents($userName);

        $githubEvents = $events->map(function($item, $key) {
            $repoParts = explode('/', $item['repo']['name']);
            $reponame = array_pop($repoParts);

            switch($item['type']){
                case 'WatchEvent':
                    $action = 'now watching';
                    break;
                case 'IssuesEvent':
                    $action = $item['payload']['action'] . ' issue #' . $item['payload']['issue']['number'];
                    break;
                case 'PullRequestReviewEvent':
                case 'PullRequestReviewCommentEvent':
                    $action = false;
                    if (in_array($item['payload']['action'], ['created', 'submitted'])) {
                        $action = 'reviewed pull request #' . $item['payload']['pull_request']['number'];
                    }
                    break;
                case 'PullRequestEvent':
                    $payloadAction = $item['payload']['action'];
                    if ($payloadAction === 'closed') {
                        if ($item['payload']['pull_request']['merged'] === true) {
                            $payloadAction = 'merged';
                        } else {
                            $payloadAction = 'declined';
                        }
                    }

                    $action = $payloadAction . ' pull request #' . $item['payload']['pull_request']['number'];
                    break;
                case 'IssueCommentEvent':
                case 'CommitCommentEvent':
                    $action = 'commented';
                    break;
                case 'ReleaseEvent':
                    $action = 'released ' . $item['payload']['release']['tag_name'];
                    break;
                case 'ForkEvent':
                    $action = 'created fork';
                    break;
                // Skipped events
                case 'DeleteEvent':
                case 'CreateEvent':
                case 'PushEvent':
                case 'MemberEvent':
                    $action = false;
                    break;
                default:
                    $action = $item['type'] . '(unhandled)';
            }

            return [
                'type' => $item['type'],
                'actor' => $item['actor']['display_login'],
                'repo' => $reponame,
                'avatar_url' => $item['actor']['avatar_url'],
                'action' => $action,
                'date' => $item['created_at'],
            ];
        });

        event(new EventsFetched($githubEvents));
    }
}
