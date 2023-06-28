@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-{{session('type')}}">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">X</i>
                                    </button>
                                    <span>
                                    <b> {{ session('message') }} </b></span>
                                </div>
                            @endif
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->user->username }}</td>
                                            <td class="w-10 text-center"><img src="{{$category['thumbnail'] ? assetStorage($category['thumbnail']) : ""}}" style="width: 50px;"></td>
                                            <td>{{ $category->title_default }}</td>
                                            <td>{{ config('constant.publish.text.'. $category->publish) }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.categories.categories-edit', $category->id) }}" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-route="{{ route('admin.categories.categories-destroy', $category['id']) }}" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the Category of the selected ID ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="" method="post" id="delete-category" class="form-delete d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@prepend('scripts')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('static/js/bootstrap.bundle.js') }}"></script>
    <script>
        $(document).on('click','.delete-btn',function(){
            $('#deleteModal').find('#delete-category').attr('action', $(this).data('route'));
        });
    </script>
@endprepend
