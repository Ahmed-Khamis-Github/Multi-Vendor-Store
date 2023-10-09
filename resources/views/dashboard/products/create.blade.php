@extends('layouts.dashboard')

@section('title','Add new product')

@section('breadcumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
<li class="breadcrumb-item" active>Add</li>
@endsection

@section('content')
<form method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data"> 
    @csrf
   @include('dashboard.products._form')
  </form>
@endsection