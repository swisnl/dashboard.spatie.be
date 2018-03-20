import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Github from './components/Github';
import GithubEvents from './components/GithubEvents';
import InternetConnection from './components/InternetConnection';
import Music from './components/Music';
import Npm from './components/Npm';
import Packagist from './components/Packagist';
import Swis from './components/Swis';
import Tasks from './components/Tasks';
import TimeWeather from './components/TimeWeather';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import Feedback from './components/Feedback';
import GameOfTests from './components/GameOfTests';
import Fussbally from './components/Fussbally';

new Vue({

    el: '#dashboard',

    components: {
        Dashboard,
        Calendar,
        Feedback,
        Fussbally,
        Github,
        GithubEvents,
        InternetConnection,
        Music,
        Npm,
        Packagist,
        Swis,
        Tasks,
        TimeWeather,
        Twitter,
        Uptime,
        GameOfTests,
    },

    created() {

        let options = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            cluster: window.dashboard.pusherCluster,
        };

        if (window.dashboard.usingNodeServer) {
            options = {
                broadcaster: 'socket.io',
                host: 'https://dashboard.swis.nl:6001',
            };
        }

        this.echo = new Echo(options);
    },
});
