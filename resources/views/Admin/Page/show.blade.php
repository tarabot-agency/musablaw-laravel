@extends('Admin.layout.app')

@section('title')
    {{ __('app.show') }} {{ __('app.page') }}
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
                                    <li class="breadcrumb-item active">{{ __('app.show') }} -
                                        @if (app()->getLocale() == 'ar')
                                            {{ $page->title_ar }}
                                        @else
                                            {{ $page->title_en }}
                                        @endif
                                    </li>
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
                                        <!--begin::Add CustomerUser-->
                                        <div class="mb-2">
                                            <a class="btn  btn btn-dark btn-sm text-white"
                                                href="{{ route('page.edit', $page->key) }}">
                                                <i class="bi bi-file-earmark-excel fs-2 text-white"></i>
                                                {{ __('app.edit') }}
                                            </a>
                                        </div>
                                        <!--end::Add CustomerUser-->
                                    </div>
                                </div>
                                <section class="">
                                    <div class="container">
                                        <div class="row gx-5">
                                            <aside class="col-lg-6">
                                                <div class="border-right rounded-4 mb-3 justify-content-center">
                                                    <div class="col-md-12">
                                                        <img src="{{ asset('images/pages/' . $page->image) }}"
                                                            class="img-fluid" alt="Image 1" width="50%">
                                                    </div>
                                                </div>
                                            </aside>
                                            <main class="col-lg-6">
                                                <div class="ps-lg-3 p-2">
                                                    @php
                                                        $website_language = Setting('website_language');
                                                    @endphp
                                                    <div class="row">
                                                        @if ($website_language == 'en')
                                                            <dt class="col-4">{{ __('app.title') }}:</dt>
                                                            <dd class="col-8">{{ $page->title_en ?? '---' }}</dd>
                                                            <dt class="col-4">{{ __('app.description') }}:</dt>
                                                            <dd class="col-8">{!! $page->description_en ?? '---' !!}</dd>
                                                        @elseif($website_language == 'ar')
                                                            <dt class="col-4">{{ __('app.title') }}:</dt>
                                                            <dd class="col-8">{{ $page->title_ar ?? '---' }}</dd>

                                                            <dt class="col-4">{{ __('app.description') }}:</dt>
                                                            <dd class="col-8">{!!$page->description_ar ?? '---' !!}</dd>
                                                        @else
                                                            <dt class="col-4">{{ __('app.title_en') }}:</dt>
                                                            <dd class="col-8">{{ $page->title_en ?? '---' }}</dd>
                                                            <dt class="col-4">{{ __('app.title_ar') }}:</dt>
                                                            <dd class="col-8">{{ $page->title_ar ?? '---' }}</dd>
                                                            <dt class="col-4">{{ __('app.description_en') }}:</dt>
                                                            <dd class="col-8">{!! $page->description_en ?? '---' !!}</dd>
                                                            <dt class="col-4">{{ __('app.description_ar') }}:</dt>
                                                            <dd class="col-8">{!! $page->description_ar ?? '---' !!}</dd>
                                                        @endif
                                                        @if ($page->icon)
                                                            <dt class="col-4">{{ __('app.icon') }}:</dt>
                                                            <dd class="col-8">{{ $page->icon }}</dd>
                                                        @endif
                                                    </div>
                                                    <hr />

                                            </main>
                                        </div>
                                        <div class="row">

                                            @if (count($page->subPages) > 0)
                                                <h6>{{ __('app.sub_sections') }}</h6>
                                                <div class="table-responsive">
                                                    <table class="table mb-0 text-center">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>{{ __('app.number') }}</th>
                                                                @if ($website_language == 'en' || $website_language == 'ar')
                                                                    <th>{{ __('app.content') }}</th>
                                                                @else
                                                                    <th>{{ __('app.content_en') }}</th>
                                                                    <th>{{ __('app.content_ar') }}</th>
                                                                    @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($page->subPages as $subpage)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    @if ($website_language == 'en')
                                                                        <td>{{ $subpage->content_en ?? '---' }}</td>
                                                                    @elseif($website_language == 'ar')
                                                                        <td>{{ $subpage->content_ar ?? '---' }}</td>
                                                                    @else
                                                                        <td>{{ $subpage->content_en ?? '---' }}</td>
                                                                        <td>{{ $subpage->content_ar ?? '---' }}</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="row">
                                            @if (count($page->secondaryImages) > 0)
                                                <div>
                                                    <h5>
                                                        {{ __('app.secondary_images') }}
                                                    </h5>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table mb-0 text-center">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>{{ __('app.number') }}</th>
                                                                <th>{{ __('app.image') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($page->secondaryImages as $image)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        <img src="{{ asset('images/secondary_images/' . $image->image) }}"
                                                                            class="img-fluid" alt="Image 1"
                                                                            width="10%" />
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
@endsection
