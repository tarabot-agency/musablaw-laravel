@extends('Admin.layout.app')

@section('title')
    {{ __('app.show') }} {{ __('app.admin') }}
@endsection
@section('content')
    <div>
        <!-- content -->
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
                                    <li class="breadcrumb-item active">{{ __('app.show') }} - {{ __('app.admin') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <section class="">
                                    <div class="container">
                                        <div class="row gx-5">
                                            <aside class="col-lg-6">
                                                <div class="border-right rounded-4 mb-3 justify-content-center">
                                                    <div class="col-md-12">
                                                        <img src="{{ $admin->image }}" class="img-fluid" alt="Image 1"
                                                            width="50%">
                                                    </div>
                                                </div>
                                            </aside>
                                            <main class="col-lg-6">
                                                <div class="ps-lg-3 p-2">
                                                    <h4 class="title text-dark">
                                                        {{ $admin->name }}
                                                    </h4>
                                                    <div class="row">
                                                        <dt class="col-4">{{ __('app.email') }}:</dt>
                                                        <dd class="col-8">{{ $admin->email ?? '---' }}</dd>
                                                        <dt class="col-4">{{ __('app.phone') }}:</dt>
                                                        <dd class="col-8">{{ $admin->phone ?? '---' }}</dd>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </main>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    </div>
@endsection
