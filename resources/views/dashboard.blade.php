@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="6" rows="3">
    <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a3"></twitter>
    <uptime position="a1:a3"></uptime>
    <packagist position="b1"></packagist>
    <npm position="b2"></npm>
    <github position="b3"></github>
    <feedback position="c1"></feedback>
    <game-of-tests position="c1:c2"></game-of-tests>
    <fussbally position="d2"></fussbally>
    <time-weather position="e1" date-format="ddd DD/MM" time-zone="Asia/Kolkata" weather-city="Mira-Bhayandar"></time-weather>
    <time-weather position="f1" date-format="ddd DD/MM" time-zone="Europe/Brussels" weather-city="Antwerp"></time-weather>
    <calendar position="f2:f3"></calendar>
    <internet-connection></internet-connection>
</dashboard>

@endsection
