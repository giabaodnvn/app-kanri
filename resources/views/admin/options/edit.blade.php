@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Option</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Option Form</li>
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
                        <div class="card-body">
                            <form id="create-category" action="{{ route('admin.options.options-update', $option->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="label">Label <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $option->label) }}">
                                    @if($errors->has('label'))
                                        <small class="text-danger">{{ $errors->first('label') }}</small>
                                    @endif
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($languages as $language)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? ' active' : '' }}" data-toggle="tab" href="#{{ $language->code }}" role="tab">{{ $language->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @foreach($languages as $language)
                                        <div class="tab-pane {{ $loop->first ? ' active' : '' }}" id="{{ $language->code }}" role="tabpanel">
                                            <div class="form-group">
                                                <label for="content-vn">Content ({{ $language->name }})
                                                    @if (config('constant.language_default_code') == $language->code)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <textarea class="form-control" id="content-{{ $language->code }}" name="content[{{ $language->code }}]" rows="3">{{ old('content.' . $language->code, $language->content) }}</textarea>
                                                @if($errors->has('content'))
                                                    <small class="text-danger">{{ $errors->first('content') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
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
