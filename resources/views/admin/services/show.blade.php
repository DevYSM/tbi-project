@extends('admin.app')
@section('title', 'Show Slider')
@section('content')


<div class="container-fluid">
    <div class="row pt-3">

        <div class="col-12 pb-3 text-center"><h1>{{$services->main_title }}</h1></div>
        <div class="col-12 col-sm-6">
            <div class="card card-dark">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Services Icon</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('services.create') }}"
                                class="btn btn-sm btn-danger">{{ __('Add New Service') }} <i
                                    class="fas fa-plus-square ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="thumbnial-img  text-center">
                        <img class="" src="{{ asset($services->icon) }}" alt="">
                    </div>
                </div>
            </div>

            <div class="card card-dark">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Services Photo</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('services.edit', $services->id) }} " class="btn btn-info btn-sm"
                                data-toggle="tooltip" data-original-title="Edit">
                                Edit <i class="fa fa-edit ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="thumbnial-img  ">
                        <img class="w-100" src="{{ asset($services->photo) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            @if (count($services->translations) > 0)
            @foreach ($services->translations as $get)

            <div class="card card-dark">
                <div class="card-header border-0">
                    <h2>{{ $get->title }}</h2>
                </div>
                <div class="card-body">
                    <div class="show-slider ">
                        <div class="mb-3">
                            <h5 class="text-danger"><strong>- Description:</strong></h5>
                            {!! $get->description !!}
                            <hr>
                            <h5 class="text-success"><strong>- Meta Title:</strong></h5>
                            {!! $get->meta_title !!}
                            <hr>
                            <h5 class="text-info"><strong>- Meta Desc:</strong></h5>
                            {!! $get->meta_desc !!}
                            <hr>
                            <h5 class="text-primary"><strong>- Meta Keywords:</strong></h5>
                            {!! $get->meta_keywords !!}
                        </div>
                        @if($get->lang_code == 'ar')
                        <span class="btn btn-sm btn-dark">Arabic <i class="fas fa-language ml-2"></i></span>
                        @elseif($get->lang_code == 'en')
                        <span class="btn btn-sm btn-info">English <i class="fas fa-language ml-2"></i></span>
                        @else
                        <span class="btn btn-sm btn-primary">{{ $get->lang_code }} <i
                                class="fas fa-language ml-2"></i></span>
                        @endif
                        <span class="btn btn-sm btn-danger">Created at [ {{ $get->created_at }} ] <i
                                class="fas fa-calendar ml-2"></i></span>

                        @if($get->status == 0)
                        <span class="btn btn-sm btn-success">Active <i class="fas fa-check ml-2"></i></span>
                        @else
                        <span class="btn btn-sm btn-danger">Unctive <i class="fas fa-times ml-2"></i></span>
                        @endif
                        <a href="{{ route('services.edit', $services->id) }} " class="btn btn-info btn-sm"
                            data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-edit"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
                  @else
            <div class="alert alert-danger text-center">
                <h4 class="m-0">Ops:(, We dont have any translations to this services.</h4>
            </div>
           
                <a href="{{ route('services.edit', $services->id) }} " class="btn btn-info btn-md w-100"
                    data-toggle="tooltip" data-original-title="Edit">
                    Add Translations <i class="fa fa-edit ml-2"></i></a>
         
            @endif

        </div>




    </div>

</div>
@endsection