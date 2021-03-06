@extends('admin.app')
@section('title', 'Slider Management')
@section('content')

<div class="container-fluid ">
    {{-- Start Section Title And Breadcurmbs --}}
    <div class="row mb-2 pt-3">
        <div class="col-sm-6">
            <h1>Slider Management</h1>
        </div>
        {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Widgets</li>
            </ol>
        </div> --}}
    </div>
    {{-- End Section Title And Breadcurmbs --}}
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countAll }}</h3>
                    <p>All Sliders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-flag"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a> --}}
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $countActive }}</h3>
                    <p>Count Active</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countUnactive }}</h3>
                    <p>Count Unactive</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            {{-- <h3 class="mb-0">{{ __('Sliders') }}</h3> --}}
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('slider.create') }}"
                                class="btn btn-sm btn-danger">{{ __('Add New Slider') }} <i class="fas fa-plus-square ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body ">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table class="table table-bordered table-striped dataTable dtr-inline data-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('No') }}</th>
                                    <th scope="col">{{ __('Photo') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Language') }}</th>
                                    {{-- <th scope="col">{{ __('Status') }}</th> --}}
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($sliders))

                                @foreach ($sliders as $items)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <div class="photo">
                                            <a href="{{ asset($items->photo) }}" data-lightbox="roadtrip">
                                                <img src="{{ asset($items->photo) }}" alt="{{ $items->title }}">
                                            </a>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('slider.show', $items->id) }}"
                                            class="text-danger">{{ $items->title }}</a></td>
                                    <td title="">
                                        @if($items->lang_code == 'ar')
                                        <span class="btn btn-sm btn-dark">Arabic</span>
                                        @else
                                        <span class="btn btn-sm btn-danger">English</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                    @if($items->status == 0)
                                    <span class="btn btn-sm btn-success">Active</span>
                                    @else
                                    <span class="btn btn-sm btn-danger">Unctive</span>
                                    @endif
                                </td> --}}
                                    <td>
                                        <a onclick="confirmDelete('{{ route('slider.destroy', $items->id) }}')">
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-original-title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>

                                        <a href="{{ route('slider.edit', $items->id) }} " class="btn btn-info btn-sm"
                                            data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-edit"></i></a>
                                        @if($items->status == 0)
                                        <a href="{{ route('slider.unactive', $items->id) }}" data-toggle="tooltip"
                                            data-original-title="Unactive" class="btn btn-dark btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('slider.active', $items->id) }}" data-toggle="tooltip"
                                            data-original-title="Active" class="btn btn-success btn-sm"><i
                                                class="fa fa-check"></i> </a>

                                        @endif

                                    </td>
                                    {{-- Start td Actions --}}


                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $sliders->links() }}
                </nav>
            </div> --}}
        </div>

        
    </div>
</div>

{{-- @include('layouts.footers.auth') --}}
</div>
 
@endsection