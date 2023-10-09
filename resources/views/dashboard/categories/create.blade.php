@extends('layouts.dashboard')

@section('title','Add new category')

@section('breadcumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item" active>Add</li>
@endsection

@section('content')
<form method="POST" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data"> 
    @csrf
   @include('dashboard.categories._form')
  </form>
@endsection