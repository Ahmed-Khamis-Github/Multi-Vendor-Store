@extends('layouts.dashboard')

@section('title','Edit product')

@section('breadcumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Categories</a></li>
<li class="breadcrumb-item" active>Edit</li>
@endsection

@section('content')
<form method="POST" action="{{ route('dashboard.products.update',$product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('dashboard.products._form')
  </form>
@endsection