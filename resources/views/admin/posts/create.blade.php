@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ ($type == config('constant.post_type.post')) ? 'Post' : 'Page' }} Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ ($type == config('constant.post_type.post')) ? 'Post' : 'Page' }} Form</li>
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
                            <form id="create-post" action="{{ route('admin.pages.pages-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}">
                                @if($type == config('constant.post_type.post'))
                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title_default }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category_id'))
                                            <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
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
                                                <label for="title-{{ $language->code }}">Title ({{ $language->name }})
                                                    @if (config('constant.language_default_code') == $language->code)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control" id="title-{{ $language->code }}" name="title[{{ $language->code }}]" value="{{ old('title.' . $language->code) }}" placeholder="Enter title">
                                                @if($errors->has('title'))
                                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="description-{{ $language->code }}">Description ({{ $language->name }})
                                                    @if (config('constant.language_default_code') == $language->code)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <textarea class="form-control" id="description-{{ $language->code }}" name="description[{{ $language->code }}]" rows="3">{{ old('description.' . $language->code) }}</textarea>
                                                @if($errors->has('description'))
                                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}" placeholder="Enter link">
                                    @if($errors->has('link'))
                                        <small class="text-danger">{{ $errors->first('link') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="publish">Publish <span class="text-danger">*</span></label>
                                    <div class="form-inline">
                                        @foreach(config('constant.publish.text') as $key => $publish)
                                            <div class="radio mr-3 form-inline">
                                                <input class="mr-1" type="radio" name="publish" id="publish{{$key}}"
                                                       @if( $key == old('publish') ) checked @endif value="{{ $key }}">
                                                <label for="publish{{$key}}">{{ $publish }}</label>
                                            </div>
                                        @endforeach
                                    </div>
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
