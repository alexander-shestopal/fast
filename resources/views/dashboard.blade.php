@extends('layouts.app')
@section('content')
<div id="dashboard" 
    data-date="{{ now()}}"
    data-name="{{ Auth::user()->name}}"
    data-email="{{ Auth::user()->email}}"
    data-role="{{ Auth::user()->role->role}}"
><div>
@endsection