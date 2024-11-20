@extends('Admin.layout.app')
@section('title')
    {{ __('app.edit') }} - {{ __('app.admin') }}
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
                                        {{ __('app.edit') }} - {{ __('app.admin') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- users edit start -->
                    <section class="users-edit">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                        role="tabpanel">
                                        <form action="{{ route('admins.update', $admin->id) }}" method="POST" class="form-validate"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('app.name') }}"
                                                        value="{{ $admin->name }}" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.email') }}</label>
                                                    <input type="email" class="form-control"
                                                        placeholder="{{ __('app.email') }}"
                                                        value="{{ $admin->email }}" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.phone') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('app.phone') }}"
                                                        value="{{ $admin->phone }}" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.password') }}</label>
                                                    <input type="password" class="form-control" autocomplete="off"
                                                        placeholder="{{ __('app.password') }}"
                                                        name="password">
                                                        <span
                                                        class="help-block">{{ __('app.if_you_does_not_change_password_please_leave_it_empty') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.photo') }}</label>
                                                    <input type="file" class="form-control"
                                                        placeholder="{{ __('app.photo') }}"
                                                        name="photo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end mt-1">
                                                <button type="submit"
                                                    class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.update') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- users edit ends -->
                </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>

    </div>
@endsection
