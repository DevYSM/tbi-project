@extends('admin.app')
@section('title', 'Services Management')
@section('content')

<div class="container-fluid ">
    <div class="row pt-5">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="row justify-content-center">
                <div class="col-xl-12 order-xl-1">
                    <div class="card card-info">
                        <div class="card-header  border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Main Title') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    {{-- <a href="{{ route('slider.index') }}" class="btn btn-sm btn-dark"><i
                                        class="fas fa-arrow-left mr-2 fa-sm"></i> {{ __('Back to list') }}</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (!empty($mainTitle))
                            <form method="post" action="{{ route('services.editservices', $mainTitle->id) }}"
                                autocomplete="off" enctype="multipart/form-data">
                                @else
                                <form method="post" action="{{ route('services.storeservices') }}" autocomplete="off"
                                    enctype="multipart/form-data">
                                    @endif
                                    @csrf
                                    <div class="form-group{{ $errors->has('main_title') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Main Title') }}</label>
                                        <input type="text" name="main_title" id="main_title"
                                            class="form-control form-control-alternative{{ $errors->has('main_title') ? ' is-invalid' : '' }}"
                                            value="@if(!empty($mainTitle)){{ $mainTitle->main_title }}@else{{ old('main_title') }}@endif"
                                            autofocus>
                                        @if ($errors->has('main_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('main_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-12 ">
                                                <div class="form-group{{ $errors->has('icon') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="input-name">{{ __('icon') }}</label>
                                                    <input type="file" name="icon" class="dropify"
                                                        data-max-file-size="2M"
                                                        data-allowed-file-extensions="jpg png jpeg "
                                                        data-default-file="{{ old('icon') }}" />
                                                    @if ($errors->has('icon'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('icon') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-12 ">
                                                <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="input-name">{{ __('Photo') }}</label>
                                                    <input type="file" name="photo" class="dropify"
                                                        data-max-file-size="2M" 
                                                        data-allowed-file-extensions="jpg png jpeg "
                                                        data-default-file="{{ old('photo') }}" />
                                                    @if ($errors->has('photo'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('photo') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        @if (!empty($mainTitle))
                                        <button type="submit" class="btn btn-danger mt-4  ">
                                            {{ __('Edit') }}
                                            <i class="fas fa-check ml-2 fa-sm"></i>
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-info mt-4  ">
                                            {{ __('Save') }}
                                            <i class="fas fa-check ml-2 fa-sm"></i>
                                        </button>
                                        @endif

                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @foreach ($data->translations as $item)
            {{ $item->title }}
            @endforeach --}}
                
            <div class="alert alert-danger text-center">
                <h4 class="m-0">You must add main title and other details first to add other language.</h4>
            </div>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>


@endsection