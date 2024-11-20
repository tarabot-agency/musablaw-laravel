@extends('Admin.layout.app')
@section('title')
    {{ __('app.add') }} - {{ __('app.article') }}
@endsection
@section('css')
    <style>
        .remove-btn {
            border: none;
            background: transparent;
            color: #dc3545;
            cursor: pointer;
        }

        .remove-btn:hover {
            color: #bb2d3b;
        }
    </style>
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
                                        {{ __('app.add') }} - {{ __('app.article') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- admins add start -->
                    <section class="admins-add">
                        <form action="{{ route('article.store') }}" method="POST" class="form-validate"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                            role="tabpanel">

                                            @php
                                                $website_lang = Setting('website_language');
                                            @endphp
                                            @if ($website_lang == 'ar')
                                                @include('Admin.Article.Create.create_form_ar')
                                            @elseif ($website_lang == 'en')
                                                @include('Admin.Article.Create.create_form_en')
                                            @elseif ($website_lang == 'both')
                                                @include('Admin.Article.Create.create_form_both')
                                            @endif
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end mt-1">
                                                    <button type="submit"
                                                        class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.add') }}</button>
                                                </div>
                                            </div>

                                            <!-- admins add account form ends -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </section>
                    <!-- admins add ends -->
                </div>
                </section>
                <!-- admins add ends -->
            </div>
        </div>
    </div>
@endsection
