@extends('Admin.layout.app')
@section('title')
    {{ __('app.add') }} - {{ __('app.slider') }}
@endsection
@section('content')
    <div>
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-12 mb-2 mt-1">
                        <div class="breadcrumbs-top">
                            <h5 class="content-header-title float-left pr-1 mb-0">{{ __('app.dashboard') }}</h5>
                            <div class="breadcrumb-wrapper d-none d-sm-block">
                                <ol class="breadcrumb p-0 mb-0 pl-1">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                                class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {{ __('app.add') }} - {{ __('app.slider') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- slider edit start -->
                    <section class="slider-edit">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                        role="tabpanel">
                                        <form action="{{ route('slider.store') }}" method="POST" class="form-validate"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                @php
                                                    $website_language = Setting('website_language');
                                                @endphp
                                                @if ($website_language == 'ar')
                                                    @include('Admin.Slider.Create.create_ar')
                                                @elseif($website_language == 'en')
                                                    @include('Admin.Slider.Create.create_en')
                                                @else
                                                    @include('Admin.Slider.Create.create_both')
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end mt-1">
                                                    <button type="submit"
                                                        class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.add') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- slider edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- slider edit ends -->
                </div>
                </section>
                <!-- slider edit ends -->
            </div>
        </div>
    </div>
@endsection
