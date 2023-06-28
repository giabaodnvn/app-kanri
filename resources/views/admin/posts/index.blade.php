@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List {{ ($type == config('constant.post_type.post')) ? 'Posts' : 'Pages' }}</h1>
                    @if($type == config('constant.post_type.post'))
                        <div class="form-group mt-3">
                            <div class="input-group input-group-lg">
                                <h5> Category: </h5>
                                <form action="{{ route('admin.posts.posts-list') }}" method="get" style="display: flex">
                                    <select class="form-select ml-5" aria-label="Default select example" name="category_id" id="category_id" style="width: 200px">
                                        <option value=""> ---ALL--- </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (request()->get('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->title_default }}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-1">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-search"></i></button>
                                            <a type="button" class="btn btn-primary" href="{{ route('admin.posts.posts-list') }}"><i class="fas fa-sync-alt"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ ($type == config('constant.post_type.post')) ? 'Posts' : 'Pages' }}</li>
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
                                    @if($type == config('constant.post_type.post'))
                                    <th>Category</th>
                                    @endif
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    @if($type == config('constant.post_type.post'))
                                    <th>Always Show</th>
                                    @endif
{{--                                    <th>Created</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        @if($type == config('constant.post_type.post'))
                                        <td>{{ $post->category->title_default }}</td>
                                        @endif
                                        <td>{{ $post->user->username }}</td>
                                        <td class="w-10 text-center"><img src="{{$post['thumbnail'] ? assetStorage($post['thumbnail']) : ""}}" style="width: 50px;"></td>
                                        <td>{{ $post->title_default }}</td>
                                        <td>{{ config('constant.publish.text.'. $post->publish) }}</td>
{{--                                        <td>{{ $post->created_at }}</td>--}}
                                        @if($type == config('constant.post_type.post'))
                                        <td>
                                            @if($post->category->title_default == 'Blog')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" name="show[{{ $post->id }}]" id="{{ $post->id }}" @if($post->always_show) checked @endif>
                                                </div>
                                            @endif
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.posts.posts-edit', $post->id) }}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-route="{{ route('admin.posts.posts-destroy', $post['id']) }}" data-toggle="modal"
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
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the Post of the selected ID ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="" method="post" id="delete-post" class="form-delete d-inline">
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
            $('#deleteModal').find('#delete-post').attr('action', $(this).data('route'));
        });
        $(function() {
            $('input[type="checkbox"][name^="show"]').on('change', function() {
                let id = $(this).attr('id');
                let url = "{!! route('admin.posts.changeAlwaysShow') !!}";
                let value = this.checked ? 1 : 0;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'value': value
                    },
                })
            });
        });
    </script>
@endprepend
