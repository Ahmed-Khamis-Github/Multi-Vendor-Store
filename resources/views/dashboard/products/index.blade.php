@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div>
        <a href="{{ route('dashboard.products.create') }}" class="ml-2 btn  bg-gradient-primary btn-md mr-2">Add a New
            Product</a>

            <a href="{{ route('dashboard.products.trash') }}" class="ml-2 btn  bg-gradient-dark btn-md">Trash Categories</a>

    </div>




    <x-alert type="success" />




    <div class="container-fluid mb-2">
        <h2 class="text-center display-6">Search</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form  action="{{ URL::current() }}" method="GET">
                    <div class="input-group">

                        <input type="search" class="form-control form-control-lg" name="search" value="{{ request('search') }}"
                            placeholder="Type your keywords here">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <table class="table table-striped projects">
        <thead>
            <tr>
                <th>
                    Image
                </th>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Product Name
                </th>
                <th style="width: 30%">
                    Category
                </th>
                <th style="width: 30%">
                    Store
                </th>



                <th style="width: 8%" class="text-center">
                    Status
                </th>
                <th style="width: 20%">
                </th>
            </tr>
        </thead>



        <tbody>
            @forelse ($products as  $product)
                <tr>

                    <td>
                        <ul class="list-inline">
                            @if ($product->image)
                                <li class="list-inline-item">
                                    <img src="{{ asset('storage/' . $product->image) }}" height="50px">
                                </li>
                            @endif

                        </ul>
                    </td>

                    <td>
                        #
                    </td>
                    <td>
                        <a>
                            {{ $product->name }}
                        </a>
                        <br />
                        <small>
                            {{ $product->created_at }}
                        </small>
                    </td>
                    <td>
                        {{ $product->category->name  }}
                    </td>

                    <td>
                        {{ $product->store->name  }}

                    </td>

                    <td class="project-state">
                        <span class="badge badge-success">{{ $product->status }}</span>
                    </td>


                    <td class="project-actions text-right" style="display: flex" >
                        <button class="btn btn-primary btn-sm" style="margin-right:10px ">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </button>


                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.products.edit', $product->id) }}" style="margin-right:10px ">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <form   action="{{ route('dashboard.products.destroy', $product->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

        </tbody>
    @empty
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            sorry there are no products to be viewed here
        </div>
        @endforelse
    </table>

    {{ $products->withQueryString()->links() }}



@endsection
