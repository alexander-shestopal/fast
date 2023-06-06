@extends('layouts.app')

@section('content')
<div className="container">
<div class="card card-nav-tabs text-center">
@if (session('success_buy'))
    <div class="alert alert-success">
        {{@session('success_buy')}}
    </div>
@endif
  <div class="card-header card-header-primary">
    Featured
  </div>
  <div class="card-body">
    <h4 class="card-title">Special title treatment</h4>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

    <form id="my-form" method="POST" action="click/buy">
       @csrf
    <button type="submit">Отправить</button>
    </form>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div>
        </div>
@endsection