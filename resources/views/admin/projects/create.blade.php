@extends('admin.app')
@section('title', 'Projects Management')
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
                            <form method="post" action="{{ route('projects.editservices', $mainTitle->id) }}"
                                autocomplete="off" enctype="multipart/form-data">
                                @else
                                <form method="post" action="{{ route('projects.storeservices') }}" autocomplete="off"
                                    enctype="multipart/form-data">
                                    @endif
                                    @csrf
                                    <div class="row">

                                        <div class="col-12 col-sm-4">
                                            <div
                                                class="form-group{{ $errors->has('main_title') ? ' has-danger' : '' }}">
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
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Tags</label>
                                                <div class="select2-primary">
                                                    <select name="tags[]" class="select2" multiple="multiple"
                                                        data-placeholder="Select a Tags"
                                                        data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                        @if(count($tags)>0)
                                                        @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                                        @endforeach
                                                        @else
                                                        <option disabled>No tags found.</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Technologies</label>
                                                <div class="select2-primary">
                                                    <select name="technologies[]" class="select2" multiple="multiple"
                                                        data-placeholder="Select a Tags"
                                                        data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                        @if(count($technologies)>0)
                                                        @foreach ($technologies as $tech)
                                                        <option value="{{ $tech->id }}">{{ $tech->title }}</option>
                                                        @endforeach
                                                        @else
                                                        <option disabled>No technologies found.</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                    {{-- Start Grid --}}

                                    <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Photo') }}</label>
                                        <input type="file" name="photo" class="dropify" data-max-file-size="2M"
                                            data-allowed-file-extensions="jpg png jpeg "
                                            data-default-file="{{ old('photo') }}" />
                                        @if ($errors->has('photo'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    {{-- End Form Group  --}}



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