
@extends('admin.admin_master')
@section('admin')
    <h1>Admin index blade </h1>
    <a href={{ route('admin.logout') }}>Logout</a>

    @if(Session::has('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session::get('error')}} </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <h1>Login Admin Name: {{ Auth::guard('admin')->user()->name }} </h1>
    <h1>Login Admin Email: {{ Auth::guard('admin')->user()->email }} </h1>
@endSection

  