@extends('tLayouts.app')

@section('title', 'Home')

@section('content')

    <x-home-hero-session />

    <x-home-pet-session :pets="$pets"/>

    <x-home-article-session />


@endsection
