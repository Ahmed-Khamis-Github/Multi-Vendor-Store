@extends('layouts.dashboard')

@section('title','Edit category')

@section('breadcumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item" active>Edit</li>
@endsection

@section('content')
<form method="POST" action="{{ route('dashboard.categories.update',$category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('dashboard.categories._form')
  </form>
@endsection