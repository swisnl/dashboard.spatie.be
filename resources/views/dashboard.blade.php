@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="5" rows="4">
    <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a4"></twitter>
    <uptime position="a1:a3"></uptime>
    <github position="b1:b2"></github>
    <packagist position="b3"></packagist>
    <npm position="b4"></npm>
    <github-events position="c1:c2"></github-events>
    <game-of-tests position="c3:c4"></game-of-tests>
    <time-weather position="d1" date-format="ddd DD/MM" time-zone="Europe/Amsterdam" weather-city="Leiden"></time-weather>
    <feedback position="d2"></feedback>
    <fussbally position="d3:d4"></fussbally>
    <swis position="e1"></swis>
    <calendar position="e2:e4"></calendar>
    <internet-connection></internet-connection>
</dashboard>

@endsection
