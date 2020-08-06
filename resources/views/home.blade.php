@extends('layouts.main')

@section('headerContent')
	@yield('dynamicHeader')
@endsection

@section('mainContent')
	@include('layouts.header')
	@yield('dynamicContent')
@endsection

@section('footerContent')
	@yield('dynamicFooter')
@endsection
