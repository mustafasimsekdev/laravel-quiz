<!DOCTYPE html>

@php
    // confiData variable layoutClasses array in Helper.php file.
    $configData = \App\Helpers\Helper::applClasses();
@endphp

<html class="loading" lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
          content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-head')

    <title> @yield('title') | {{__('locale.CRUD')}}</title>
    <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BEGIN: VENDOR CSS - Page Level CSS - Custom CSS-->
    @include('auth.panels.styles')
    <!-- END: VENDOR CSS - Page Level CSS - Custom CSS-->

</head>
<!-- END: Head-->

@include('auth.layouts.layoutMaster')

</html>
