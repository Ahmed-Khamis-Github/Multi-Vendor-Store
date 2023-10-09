@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item" active>Show</li>
@endsection


@section('content')

 
<div>
    <a href="{{ route('dashboard.categories.index') }}" class="ml-2 btn  bg-gradient-primary btn-md mr-2">Back</a>


</div>



    <table class="table table-striped projects">
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th style="width: 10%">
                    Store
                </th>
                <th style="width: 20%">
                    Status
                </th>
                <th style="width: 30%">
                    Created_at
                </th>




            </tr>
        </thead>



        <tbody>
            @forelse ($products as  $product)
                <tr>

                    <td>
                        {{ $product->name }}
                    </td>

                    <td>
                        {{ $product->store->name }}
                    </td>
                    <td>

                        {{ $product->status }}

                         
                           
                        

                    </td>
                    <td>

                    {{ $product->created_at }}
                </td>




                </tr>

        </tbody>
    @empty
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            sorry there are no products in this category
        </div>
        @endforelse
    </table>

     



@endsection
