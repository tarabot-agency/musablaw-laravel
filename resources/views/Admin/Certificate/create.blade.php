@extends('Admin.layout.app')
@section('title')
    {{ __('app.add') }} - {{ __('app.certificate') }}
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
                                        {{ __('app.add') }} - {{ __('app.certificate') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- certificate edit start -->
                    <section class="certificate-edit">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                        role="tabpanel">
                                        <form action="{{ route('certificate.store') }}" method="POST" class="form-validate"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.name') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('app.name') }}" value="{{ old('name') }}"
                                                            name="name" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }}</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}" name="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end mt-1">
                                                    <button type="submit"
                                                        class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.add') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- certificate edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- certificate edit ends -->
                </div>
                </section>
                <!-- certificate edit ends -->
            </div>
        </div>
    </div>
@endsection
