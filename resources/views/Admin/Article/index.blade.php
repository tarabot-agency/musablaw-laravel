@extends('Admin.layout.app')

@section('title')
    {{ __('app.articles') }}
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
                                    <li class="breadcrumb-item active">{{ __('app.articles') }}
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
                                    <h4 class="card-title">{{ __('app.articles') }}</h4>
                                    <div class="card-toolbar">
                                        <!--begin::Add CustomerUser-->
                                        <div class="mb-2">

                                            <a class="btn  btn btn-dark btn-sm text-white"
                                                href="{{ route('article.create') }}">
                                                <i class="bi bi-file-earmark-excel fs-2 text-white"></i>
                                                {{ __('app.create') }}
                                            </a>

                                        </div>
                                        <!--end::Add CustomerUser-->
                                    </div>
                                </div>
                                <!-- table head dark -->
                                @if (count($articles) > 0)
                                    @php
                                        $website_lang = Setting('website_language');
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>{{ __('app.number') }}</th>
                                                    @if ($website_lang == 'ar')
                                                        <th>{{ __('app.title') }}</th>
                                                    @elseif ($website_lang == 'en')
                                                        <th>{{ __('app.title') }}</th>
                                                    @else
                                                        <th>{{ __('app.title_en') }}</th>
                                                        <th>{{ __('app.title_ar') }}</th>
                                                    @endif
                                                    <th>{{ __('app.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($articles as $article)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        @if ($website_lang == 'ar')
                                                            <td>{{ $article->title_ar }}</td>
                                                        @elseif ($website_lang == 'en')
                                                            <th>{{ $article->title_en }}</td>
                                                        @else
                                                            <td>{{ $article->title_en }}</td>
                                                            <td>{{ $article->title_ar }}</td>
                                                        @endif
                                                        <td>

                                                            <a href="{{ route('article.show', $article->id) }}"><i
                                                                    class="badge-circle badge-circle-light-secondary bx bx-show-alt font-medium-1 "></i></a>
                                                            <a href="{{ route('article.edit', $article->id) }}"><i
                                                                    class="badge-circle badge-circle-light-secondary bx
                                                            bx-edit-alt font-medium-1 "></i></a>
                                                            <form id="deleteForm{{ $article->id }}"
                                                                style="display: inline"
                                                                action="{{ route('article.delete', $article->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <a onclick="deleteArticle({{ $article->id }})"><i
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
                                {{ $articles->links('pagination::bootstrap-4') }}
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
        function deleteArticle(id) {
            let response = confirm('{{ __('app.are_you_sure') }}');
            if (response == true) {
                $('#deleteForm' + id).submit();
            }
        }
    </script>
@endsection
