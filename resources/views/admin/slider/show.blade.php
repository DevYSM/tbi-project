@extends('admin.app')
@section('title', 'Show Slider')
@section('content')


<div class="container-fluid">
    <div class="row pt-5">

        <div class="col-12 col-sm-6">
            <div class="card card-dark">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            {{-- <h3 class="mb-0">{{ __('') }}</h3> --}}
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="{{ route('slider.create') }}"
                                class="btn btn-sm btn-success">{{ __('Add New Slider') }}</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="thumbnial-img  ">
                        <img class="w-100" src="{{ asset($slider->photo) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card card-dark">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            {{-- <h3 class="mb-0">{{ __('') }}</h3> --}}
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('slider.create') }}"
                                class="btn btn-sm btn-danger">{{ __('Add New Slider') }} <i class="fas fa-plus-square ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="show-slider ">
                        <h2>{{ $slider->title }}</h2>
                        <div class="mb-3">
                            {!! $slider->description !!}
                        </div>
                        @if($slider->lang_code == 'ar')
                        <span class="btn btn-sm btn-dark">Arabic <i class="fas fa-language ml-2"></i></span>
                        @else
                        <span class="btn btn-sm btn-danger">English <i class="fas fa-language ml-2"></i></span>
                        @endif
                        <span class="btn btn-sm btn-danger">Created at [ {{ $slider->created_at }} ] <i class="fas fa-calendar ml-2"></i></span>

                        @if($slider->status == 0)
                        <span class="btn btn-sm btn-success">Active <i class="fas fa-check ml-2"></i></span>
                        @else
                        <span class="btn btn-sm btn-danger">Unctive <i class="fas fa-times ml-2"></i></span>
                        @endif
                        <a href="{{ route('slider.edit', $slider->id) }} " class="btn btn-info btn-sm"
                            data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>


        {{-- Start Show Page --}}
        @if(!empty($slider))


        @endif
        {{-- End Show Page --}}

    </div>

</div>
@endsection