@extends('tLayouts.app')

@section('title', 'Home')

@section('header')
    <x-home-hero-session />
@endsection


@section('content')
    <x-home-pet-session :pets="$pets" />
    <x-home-article-session />
@endsection
