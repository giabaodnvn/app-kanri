@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                        </div>
                        <form id="create-laguage" action="{{ route('admin.users.users-update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="form-group">
                                    <label for="username">UserName <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                                    @if($errors->has('username'))
                                        <small class="text-danger">{{ $errors->first('username') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @if($errors->has('password'))
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">New Password-Confirm</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password-confirm">
                                    @if($errors->has('password-confirm'))
                                        <small class="text-danger">{{ $errors->first('password-confirm') }}</small>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Role <span class="text-danger">*</span></label>
                                            <select name="role" id="role" class="form-control form-control-xl">
                                                @foreach(config('constant.roles') as $key => $role)
                                                    <option value="{{ $key }}" @if($key == $user->role) selected @endif>{{ $role }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('role'))
                                                <small class="text-danger">{{ $errors->first('role') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control form-control-xl">
                                                @foreach(config('constant.user_status') as $key => $status)
                                                    <option value="{{ $key }}" @if($key == $user->status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('status'))
                                                <small class="text-danger">{{ $errors->first('status') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@prepend('scripts')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('static/js/bootstrap.bundle.js') }}"></script>
@endprepend
