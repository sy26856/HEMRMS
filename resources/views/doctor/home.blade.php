@extends('layouts.doctor')
@section('docLeftBar')
	<div class="menu_box" id="leftbar">
        @if(session('doctor')['docgrade'] == 1)
        	<oneBar></oneBar>
        @endif
        @if(session('doctor')['docgrade'] == 2)
        	<twoBar></twoBar>
        @endif
        @if(session('doctor')['docgrade'] == 3)
        	<threeBar></threeBar>
        @endif
        @if(session('doctor')['docgrade'] == 4)
        	<fourBar></fourBar>
        @endif
        @if(session('doctor')['docgrade'] == 5)
        	<fiveBar></fiveBar>
        @endif
    </div>
@endsection


@section('content')
    <router-view :user="{{ session('doctor') }}"></router-view>
@endsection