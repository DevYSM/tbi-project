@extends('admin.app')
@section('title', 'Edit Services ')
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
                            <form method="post" action="{{ route('services.editservices', $services->id) }}"
                                autocomplete="off" enctype="multipart/form-data">
                
                                    @csrf
                                    <div class="form-group{{ $errors->has('main_title') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Main Title') }}</label>
                                        <input type="text" name="main_title" id="main_title"
                                            class="form-control form-control-alternative{{ $errors->has('main_title') ? ' is-invalid' : '' }}"
                                            value="@if(!empty($services)){{ $services->main_title }}@else{{ old('main_title') }}@endif"
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
                                                        data-default-file="{{ url('/'.$services->icon) }}" />
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
                                            
                                                        data-default-file="{{ url('/'.$services->photo) }}" />
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
                                        @if (!empty($services))
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
             @if (!empty($services))
            <div class="card">
                <div class="card-header d-flex p-0 bg-light">
                    {{-- {{ dd($lang) }} --}}
                    {{-- {{ dd($data) }} --}}
                    <ul class="nav nav-pills  p-2">
                        @if (count($lang) > 0)
                        @foreach ($lang as $lan)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" href="#tab_{{ $lan->code }}"
                                data-toggle="tab">{{ $lan->title }} </a></li>
                        @endforeach
                        @endif
                    </ul>
                </div><!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content">
                        <?php $x = 0; ?>
                        {{-- Start Loop In Languages --}}
                        @if (count($lang) > 0)
                        @foreach ($lang as $lan)
                        <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="tab_{{  $lan->code }}">

                            {{-- Start Check Count of Data Translated To Create Update Form --}}
                            @if(count($data)>0)
                            {{-- Start Check If Indexed data language code is equel the looping code to create or update form --}}
                            @if ( $data[$x]->lang_code == $lan->code )
                            <form method="post" action="{{ route('services.trans_update', $data[$x]->id) }}"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @else
                                <form method="post" action="{{ route('services.store') }}" autocomplete="off"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @endif
                                    {{-- End Check If Indexed data language code is equel the looping code to create or update form --}}
                                    @else
                                    <form method="post" action="{{ route('services.store') }}" autocomplete="off"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @endif
                                        {{-- End Check Count of Data Translated To Create Update Form --}}


                                        {{-- Start Row --}}
                                        <div class="row">
                                            <input type="hidden" name="lang_code" value="{{ $lan->code }}">
                                            <input type="hidden" name="services_id" value="{{ $services->id }}">
                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-12 ">
                                                {{-- Start Form Group  --}}

                                                <div class="form-group{{ $errors->has('title')? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-name">{{ $lan->title }}
                                                        {{ __('Title') }}</label>

                                                    <input type="text" name="title" id="title"
                                                        class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                        value="@if(count($data)>0){{ $data[$x]->lang_code == $lan->code ? $data[$x]->title : old('title')}}@else{{ old('title') }}@endif"
                                                        autofocus>

                                                    @if ($errors->has('title') )
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Grid --}}

                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-6 ">
                                                {{-- Start Form Group  --}}
                                                <div
                                                    class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="description">{{ $lan->title }}
                                                        {{ __('Description') }}</label>
                                                    <textarea name="description" id="description" rows="8"
                                                        class="textarea form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                        autofocus>@if(count($data)>0){{ $data[$x]->lang_code == $lan->code ? $data[$x]->description : old('description')}}@else {{ old('title') }} @endif</textarea>
                                                    @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}

                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-6 ">
                                                {{-- Start Form Group  --}}
                                                <div
                                                    class="form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="input_meta_title">{{ $lan->title }}
                                                        {{ __('meta title') }}</label>
                                                    <textarea name="meta_title" id="input_meta_title" rows="8"
                                                        class=" form-control form-control-alternative{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                                        autofocus>@if(count($data)>0){{ $data[$x]->lang_code == $lan->code ? $data[$x]->meta_title : old('meta_title')}} @else {{ old('title') }} @endif</textarea>
                                                    @if ($errors->has('meta_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('meta_title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}

                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-6 ">
                                                {{-- Start Form Group  --}}
                                                <div
                                                    class="form-group{{ $errors->has('meta_desc') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="input_meta_desc">{{ $lan->title }}
                                                        {{ __('meta desc') }}</label>
                                                    <textarea name="meta_desc" id="input_meta_desc" rows="8"
                                                        class=" form-control form-control-alternative{{ $errors->has('meta_desc') ? ' is-invalid' : '' }}"
                                                        autofocus>@if(count($data)>0){{ $data[$x]->lang_code == $lan->code ? $data[$x]->meta_desc : old('meta_desc')}}@else {{ old('title') }} @endif</textarea>
                                                    @if ($errors->has('meta_desc'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('meta_desc')}}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}

                                            {{-- Start Grid --}}
                                            <div class="col-12 col-sm-6 ">
                                                {{-- Start Form Group  --}}
                                                <div
                                                    class="form-group{{ $errors->has('meta_keywords') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label"
                                                        for="input_meta_keywords">{{ $lan->title }}
                                                        {{ __('meta keywords') }}</label>
                                                    <textarea name="meta_keywords" id="input_meta_keywords" rows="8"
                                                        class=" form-control form-control-alternative{{ $errors->has('meta_keywords') ? ' is-invalid' : '' }}"
                                                        autofocus>@if(count($data)>0){{ $data[$x]->lang_code == $lan->code ? $data[$x]->meta_keywords : old('meta_keywords')}}@else {{ old('title') }}@endif</textarea>
                                                    @if ($errors->has('meta_keywords'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('meta_keywords') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- End Form Group  --}}
                                            <div class="col-12 col-sm-12 ">
                                                <div class="text-center">
                                                    @if(count($data)>0)
                                                    @if ( $data[$x]->lang_code == $lan->code)
                                                    <button type="submit"
                                                        class="btn btn-danger mt-4  w-25">{{ __('Edit') }}
                                                        <i class="fas fa-check ml-2 fa-sm"></i></button>
                                                    @else
                                                    <button type="submit"
                                                        class="btn btn-info mt-4  w-25">{{ __('Save') }}
                                                        <i class="fas fa-check ml-2 fa-sm"></i></button>
                                                    @endif
                                                    @else
                                                    <button type="submit"
                                                        class="btn btn-info mt-4  w-25">{{ __('Save') }}
                                                        <i class="fas fa-check ml-2 fa-sm"></i></button>
                                                    @endif


                                                </div>
                                            </div>

                                        </div>
                                        {{-- End Row --}}
                                    </form>
                                    <!-- /.tab-pane -->
                        </div>

                        {{-- End tab --}}
                        <?php $x++; ?>
                        @if(count($data) === $x)
                        <?php $x = 0; ?>
                        @endif
                        @endforeach
                        {{-- End Loop In Languages --}}
                        @endif
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->

            </div>
            @else
            <div class="alert alert-danger text-center">
                <h4 class="m-0">You must add main title and other details first to add other language.</h4>
            </div>
            @endif
            <!-- ./card -->






        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>


@endsection