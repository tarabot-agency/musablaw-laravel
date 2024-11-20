@extends('Admin.layout.app')

@section('title')
    {{ __('app.admins') }}
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
                                    <li class="breadcrumb-item active">{{ __('app.admins') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card p-2">
                        <form action="{{ route('admins.index') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('app.search') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('app.search_by_name_phone_email') }}"
                                            value="{{ old('search', request('search')) }}" name="search">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for=""></label>
                                    <div class="form-group">
                                        <button type="submit" class="btn  btn btn-warning btn-sm text-white">
                                            {{ __('app.search') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('app.admins') }}</h4>
                                    <div class="card-toolbar">
                                        <!--begin::Add CustomerUser-->
                                        <div class="mb-2">

                                                <a class="btn  btn btn-dark btn-sm text-white"
                                                    href="{{ route('admins.create') }}">
                                                    <i class="bi bi-file-earmark-excel fs-2 text-white"></i>
                                                    {{ __('app.create') }}
                                                </a>

                                        </div>
                                        <!--end::Add CustomerUser-->
                                    </div>
                                </div>
                                <!-- table head dark -->
                                @if (count($admins) > 0)
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>{{ __('app.number') }}</th>
                                                    <th>{{ __('app.name') }}</th>
                                                    <th>{{ __('app.email') }}</th>
                                                    <th>{{ __('app.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admins as $admin)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-bold-500">
                                                            <a href="{{ route('admins.show', $admin->id) }}">
                                                                {{ $admin->name }}
                                                            </a>
                                                        </td>
                                                        <td class="text-bold-500">{{ $admin->email }}</td>
                                                        <td>
                                                            @if ($admin->id == 1)
                                                                ---
                                                            @else
                                                                <a href="{{ route('admins.show', $admin->id) }}"><i
                                                                        class="badge-circle badge-circle-light-secondary bx bx-show-alt font-medium-1 "></i></a>
                                                                    <a href="{{ route('admins.edit', $admin->id) }}"><i
                                                                            class="badge-circle badge-circle-light-secondary bx
                                                            bx-edit-alt font-medium-1 "></i></a>
                                                                    <form id="deleteForm{{ $admin->id }}"
                                                                        style="display: inline"
                                                                        action="{{ route('admins.delete', $admin->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <a onclick="deleteAdmin({{ $admin->id }})"><i
                                                                                class="badge-circle badge-circle-light-secondary bx
                                                                bx-trash-alt font-medium-1 "></i></a>
                                                                    </form>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    @include('no-data-view')
                                @endif
                            </div>
                            <div class="card-footer">
                                {{ $admins->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteAdmin(id) {
            let response = confirm('{{ __('app.are_you_sure') }}');
            if (response == true) {
                $('#deleteForm' + id).submit();
            }
        }
    </script>
@endsection
