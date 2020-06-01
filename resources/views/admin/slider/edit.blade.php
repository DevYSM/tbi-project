@extends('admin.app')
@section('title', 'Edit Slider')
@section('content')

<div class="container-fluid pt-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 order-xl-1">
            <div class="card card-dark">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Edit Slider') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('slider.index') }}"
                                class="btn btn-sm btn-danger">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('slider.update', $slider->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Slider information') }}</h6>

                        {{-- Start Row --}}
                        <div class="row">

                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-8 ">
                                {{-- Start Form Group  --}}
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title-en"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        value="{{ $slider->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- End Grid --}}
                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-4 ">
                                {{-- Start Form Group  --}}
                                <div class="form-group{{ $errors->has('lang_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-lang">{{ __('Language') }}</label>
                                    <select name="lang_code" id="input-lang"
                                        class="form-control form-control-alternative{{ $errors->has('lang_code') ? ' is-invalid' : '' }}">
                                        @foreach ($lang as $ln)
                                        <option value="{{ $ln->code }}" {{ $slider->lang_code == $ln->code ? 'selected' : '' }}>{{ $ln->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('lang'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- End Form Group  --}}
                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-12 ">
                                {{-- Start Form Group  --}}
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description-en" rows="6"
                                        class="textarea form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        value="{{ old('description') }}" required autofocus>{{ $slider->description }}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- End Form Group  --}}
                            {{-- Start Form Group  --}}
                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-12 ">
                                <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Photo') }}</label>
                                    <input  type="file" name="photo" class="dropify" data-max-file-size="2M"
                                        data-min-width="1000" data-max-width="2000" data-min-height="500"
                                        data-allowed-file-extensions="jpg png jpeg "
                                        data-default-file="{{ asset($slider->photo) }}" value="{{ $slider->photo }}"/>
                                    @if ($errors->has('photo'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- End Form Group  --}}


                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-12 ">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger mt-4 w-25">{{ __('Edit') }}</button>
                                </div>
                            </div>



                        </div>
                        {{-- End Row --}}
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

 
</div>
@endsection