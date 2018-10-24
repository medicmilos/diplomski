@extends('layouts.app')
@push('og')
    <meta property="og:url" content="{{$og_url ?? url()->full()}}"/>
    <meta property="og:type" content="{{$og_website ?? 'website'}}"/>
    <meta property="og:site_name" content="ICT galerija"/>
    <meta property="og:image" content="{{$og_image ?? url('/images/og.png')}}"/>
@endpush
