@extends('Admin.layout.app')

@section('title')
    {{ __('app.contact_us') }}
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
                                    <li class="breadcrumb-item active">{{ __('app.contact_us') }}
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
                                    <h4 class="card-title">{{ __('app.contact_us') }}</h4>
                                    <div class="card-toolbar">
                                        <!--begin::Add CustomerUser-->
                                        <div class="mb-2">
                                        </div>
                                        <!--end::Add CustomerUser-->
                                    </div>
                                </div>
                                <!-- table head dark -->
                                @if (count($contact_uss) > 0)
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>{{ __('app.number') }}</th>
                                                    <th>{{ __('app.name') }}</th>
                                                    <th>{{ __('app.phone') }}</th>
                                                    <th>{{ __('app.email') }}</th>
                                                    <th>{{ __('app.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contact_uss as $message)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-bold-500">
                                                            {{ $message->name }}
                                                        </td>
                                                        <td class="text-bold-500">{{ $message->phone }}</td>
                                                        <td class="text-bold-500">{{ $message->email }}</td>
                                                        <td>
                                                            <a href="{{ route('contact-us.show', $message->id) }}"><i
                                                                    class="badge-circle badge-circle-light-secondary bx bx-show-alt font-medium-1 "></i></a>
                                                            <form id="deleteForm{{ $message->id }}"
                                                                style="display: inline"
                                                                action="{{ route('contact-us.delete', $message->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <a onclick="deleteMessage({{ $message->id }})"><i
                                                                        class="badge-circle badge-circle-light-secondary bx
                                                                bx-trash-alt font-medium-1 "></i></a>
                                                            </form>
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
                                {{ $contact_uss->links('pagination::bootstrap-4') }}
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
        function deleteMessage(id) {
            let response = confirm('{{ __('app.are_you_sure') }}');
            if (response == true) {
                $('#deleteForm' + id).submit();
            }
        }
    </script>
@endsection
