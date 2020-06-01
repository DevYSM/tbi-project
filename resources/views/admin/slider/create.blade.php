@extends('admin.app')
@section('title', 'Add New Slider')
@section('content')

<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="col-xl-8 order-xl-1 mt-5">
            <div class="card card-info">
                <div class="card-header  border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Slider Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('slider.index') }}"
                                class="btn btn-sm btn-dark"><i class="fas fa-arrow-left mr-2 fa-sm"></i> {{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('slider.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Start Row --}}
                        <div class="row">

                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-8 ">
                                {{-- Start Form Group  --}}
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title-en"
                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        value="{{ old('title') }}" required autofocus>
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
                                        <option value="{{ $ln->code }}">{{ $ln->title }}</option>
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
                                    <textarea  name="description" id="input-description-en" rows="8"
                                        class="textarea form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        required autofocus>{{ old('description') }}</textarea>
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
                                    <input type="file" name="photo" class="dropify" data-max-file-size="2M"
                                        data-min-width="750" data-max-width="2000" data-min-height="500"
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


                            {{-- Start Grid --}}
                            <div class="col-12 col-sm-12 ">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info mt-4  w-25">{{ __('Save') }} <i class="fas fa-check ml-2 fa-sm"></i></button>
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