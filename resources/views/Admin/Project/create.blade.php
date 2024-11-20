@extends('Admin.layout.app')
@section('title')
    {{ __('app.add') }} - {{ __('app.project') }}
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
                                        {{ __('app.add') }} - {{ __('app.project') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- project edit start -->
                    <section class="project-edit">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                        role="tabpanel">
                                        <form action="{{ route('project.store') }}" method="POST" class="form-validate"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.name_en') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('app.name_en') }}" value="{{ old('name_en') }}"
                                                            name="name_en" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.name_ar') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('app.name_ar') }}"
                                                            value="{{ old('name_ar') }}" name="name_ar" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.description_en') }}</label>
                                                        <textarea rows="5" class="form-control"
                                                            placeholder="{{ __('app.description_en') }}"
                                                            name="description_en" required>{{ old('description_en') }} </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.description_ar') }}</label>
                                                        <textarea rows="5" class="form-control"
                                                            placeholder="{{ __('app.description_ar') }}"
                                                             name="description_ar" required>{{ old('description_ar') }} </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 1</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[0]" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 2</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[1]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 3</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[2]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 4</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[3]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 5</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[4]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('app.image') }} 6</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="{{ __('app.image') }}"
                                                          name="image[5]">
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
                                        <!-- project edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- project edit ends -->
                </div>
                </section>
                <!-- project edit ends -->
            </div>
        </div>
    </div>
@endsection
