@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Language</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Language Form</li>
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
                        <form id="create-laguage" action="{{ route('admin.languages.languages-update', $language->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $language->name }}" placeholder="Ex: vietnamese">
                                    @if($errors->has('name'))
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="code">Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ $language->code }}" placeholder="Ex: vn">
                                    @if($errors->has('code'))
                                        <small class="text-danger">{{ $errors->first('code') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                        <span class="btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">
                                                <input type="file" class="w-100" accept="image/*" name="thumbnail"/>
                                            </span>
                                        </span>
                                    </div>
                                    @if($errors->has('thumbnail'))
                                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                                    @endif
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
