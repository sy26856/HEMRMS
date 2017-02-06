@extends('layouts.admin')
@section('content')
    <router-view :user="{{ Auth::user() }}"></router-view>
@endsection