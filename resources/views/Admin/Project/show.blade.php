@extends('Admin.layout.app')

@section('title')
    {{ __('app.show') }} {{ __('app.project') }}
@endsection
@section('css')
    <style>
        .delete-form:hover {
            cursor: pointer;
        }
    </style>
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
                                    <li class="breadcrumb-item active">{{ __('app.show') }} - {{ __('app.project') }}
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
                                    <h4 class="card-title"></h4>
                                    <div class="card-toolbar">
                                        <div class="mb-2">
                                            <a class="btn  btn btn-dark btn-sm text-white"
                                                href="{{ route('project.edit', $project->id) }}">
                                                <i class="bi bi-file-earmark-excel fs-2 text-white"></i>
                                                {{ __('app.edit') }}
                                            </a>
                                            <form id="deleteForm{{ $project->id }}" style="display: inline"
                                                action="{{ route('project.delete', $project->id) }}" method="POST" class="d-inline btn-sm btn-danger delete-form">
                                                @csrf
                                                <a onclick="deleteProject({{ $project->id }})">{{ __('app.delete') }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <section class="">
                                    <div class="container">
                                        <div class="row gx-5">
                                            <aside class="col-lg-6">
                                                <div class="border-right rounded-4 mb-3 justify-content-center">
                                                    <div class="col-md-12">
                                                        @if (count($project->images) > 0)
                                                            <img src="{{ asset('images/projects/' . $project->images[0]->image) }}"
                                                                class="img-fluid mb-1" alt="Image 1" height="20%" />
                                                        @endif
                                                    </div>
                                                </div>
                                            </aside>
                                            <main class="col-lg-6">
                                                <div class="ps-lg-3 p-2">
                                                    <div class="row">
                                                        <dt class="col-4">{{ __('app.name_en') }}:</dt>
                                                        <dd class="col-8">{{ $project->name_en ?? '---' }}</dd>
                                                        <dt class="col-4">{{ __('app.name_ar') }}:</dt>
                                                        <dd class="col-8">{{ $project->name_ar ?? '---' }}</dd>
                                                        <dt class="col-4">{{ __('app.description_en') }}:</dt>
                                                        <dd class="col-8">{{ $project->description_en ?? '---' }}</dd>
                                                        <dt class="col-4">{{ __('app.description_ar') }}:</dt>
                                                        <dd class="col-8">{{ $project->description_ar ?? '---' }}</dd>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </main>
                                        </div>
                                        <div class="row">
                                            @if (count($project->images) > 1)
                                                <div class="table-responsive">
                                                    <table class="table mb-0 text-center">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>{{ __('app.number') }}</th>
                                                                <th>{{ __('app.image') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i < count($project->images); $i++)
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>
                                                                        <img src="{{ asset('images/projects/' . $project->images[$i]->image) }}"
                                                                            class="img-fluid mb-1" alt="Image 1"
                                                                            width="10%" />
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
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
@endsection
@section('script')
    <script>
        function deleteProject(id) {
            let response = confirm('{{ __('app.are_you_sure') }}');
            if (response == true) {
                $('#deleteForm' + id).submit();
            }
        }
    </script>
@endsection
