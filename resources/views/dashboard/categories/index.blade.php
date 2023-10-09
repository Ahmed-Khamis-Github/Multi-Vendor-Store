@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div>
        <a href="{{ route('dashboard.categories.create') }}" class="ml-2 btn  bg-gradient-primary btn-md mr-2">Add a New
            Category</a>

            <a href="{{ route('dashboard.categories.trash') }}" class="ml-2 btn  bg-gradient-dark btn-md">Trash Categories</a>

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
                    Products_count
                </th>
                <th style="width: 20%">
                    Category Name
                </th>
                <th style="width: 30%">
                    Parent
                </th>



                <th style="width: 8%" class="text-center">
                    Status
                </th>
                <th style="width: 20%">
                </th>
            </tr>
        </thead>



        <tbody>
            @forelse ($categories as  $category)
                <tr>

                    <td>
                        <ul class="list-inline">
                            @if ($category->image)
                                <li class="list-inline-item">
                                    <img src="{{ asset('storage/' . $category->image) }}" height="50px">
                                </li>
                            @endif

                        </ul>
                    </td>

                    <td>
                        {{ $category->products_count }}
                    </td>
                    <td>
                        <a>
                            {{ $category->name }}
                        </a>
                        <br />
                        <small>
                            {{ $category->created_at }}
                        </small>
                        
                    </td>
                    <td>
                        {{ $category->parent->name }}
                    </td>

                    <td class="project-state">
                        <span class="badge badge-success">{{ $category->status }}</span>
                    </td>
                    <td class="project-actions text-right">
                        

                        <a class="btn btn-primary btn-sm" href="{{ route('dashboard.categories.show', $category->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            View
                        </a>


                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.categories.edit', $category->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <form style="display: inline" action="{{ route('dashboard.categories.destroy', $category->id) }}"
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
            sorry there are no categories to be viewed here
        </div>
        @endforelse
    </table>

    {{ $categories->withQueryString()->links() }}



@endsection
