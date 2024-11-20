@extends('Admin.layout.app')

@section('title')
    {{ __('app.general_settings') }}
@endsection

@section('content')
    <div>
        <!-- BEGIN: Content-->
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
                                    <li class="breadcrumb-item active">{{ __('app.settings') }}
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
                                    <h4 class="card-title">{{ __('app.general_settings') }}</h4>
                                    <div class="card-toolbar">
                                        <!--begin::Add CustomerUser-->

                                        <!--end::Add CustomerUser-->
                                    </div>
                                </div>
                                <div class="p-2">
                                    <form action="{{ route('settings.general.update') }}" method="POST"
                                        class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        <!-- table head dark -->
                                        <div class="row">
                                            @foreach ($settings as $setting)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ $setting->title }} / {{ $setting->unit }}</label>
                                                        @if ($setting->key == 'website_language')
                                                            <select class="form-control" name="website_language">
                                                                <option value="en"
                                                                    {{ $setting->value == 'en' ? 'selected' : '' }}>
                                                                    {{ __('app.english') }}
                                                                </option>
                                                                <option value="ar"
                                                                    {{ $setting->value == 'ar' ? 'selected' : '' }}>
                                                                    {{ __('app.arabic') }}
                                                                </option>
                                                                <option value="both"
                                                                    {{ $setting->value == 'both' ? 'selected' : '' }}>
                                                                    {{ __('app.both') }}</option>
                                                            </select>
                                                        @else
                                                            @if ($setting->unit == 'file')
                                                                <input type="file" class="form-control"
                                                                    name="{{ $setting->key }}" />
                                                            @elseif ($setting->unit == 'url')
                                                                <input type="url" class="form-control"
                                                                    placeholder="{{ $setting->title }}"
                                                                    value="{{ $setting->value }}"
                                                                    name="{{ $setting->key }}" required />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ $setting->title }}"
                                                                    value="{{ $setting->value }}"
                                                                    name="{{ $setting->key }}" required />
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end mt-1">
                                                <button type="submit"
                                                    class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.update') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
