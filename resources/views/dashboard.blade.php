@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="5" rows="3">
    <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a2"></twitter>
    <github-events position="a3:a4"></github-events>
    <uptime position="a1:a3"></uptime>
    <packagist position="b1"></packagist>
    <npm position="b2"></npm>
    <github position="b3:b4"></github>
    <feedback position="c1"></feedback>
    <game-of-tests position="c2:c4"></game-of-tests>
    <time-weather position="d1" date-format="ddd DD/MM" time-zone="Europe/Amsterdam" weather-city="Leiden"></time-weather>
    <fussbally position="d2:d4"></fussbally>
    <swis position="e1"></swis>
    <calendar position="e2:e4"></calendar>
    <internet-connection></internet-connection>
</dashboard>

@endsection
