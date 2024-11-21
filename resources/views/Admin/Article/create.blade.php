@extends('Admin.layout.app')
@section('title')
    {{ __('app.add') }} - {{ __('app.article') }}
@endsection
@section('css')
    <style>
        .remove-btn {
            border: none;
            background: transparent;
            color: #dc3545;
            cursor: pointer;
        }

        .remove-btn:hover {
            color: #bb2d3b;
        }
    </style>
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
                                        {{ __('app.add') }} - {{ __('app.article') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- admins add start -->
                    <section class="admins-add">
                        <form action="{{ route('article.store') }}" method="POST" class="form-validate"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                            role="tabpanel">
                                            @php
                                                $website_lang = Setting('website_language');
                                            @endphp
                                            @if ($website_lang == 'ar')
                                                @include('Admin.Article.Create.create_form_ar')
                                            @elseif ($website_lang == 'en')
                                                @include('Admin.Article.Create.create_form_en')
                                            @elseif ($website_lang == 'both')
                                                @include('Admin.Article.Create.create_form_both')
                                            @endif
                                            <!-- admins add account form ends -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div id="input-fields-container">
                                        <div class="card-header">
                                            <h5>{{ __('app.sub_sections') }}</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-dark add-btn" onclick="addInputField()">+
                                                {{ __('app.add_sub_title') }}</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end mt-1">
                                            <button type="submit"
                                                class="btn btn-warning glow mb-1 mb-sm-0">{{ __('app.add') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </section>
                    <!-- admins add ends -->
                </div>
                </section>
                <!-- admins add ends -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Counter to keep track of dynamically added sections
        let sectionCounter = 0;
        let website_lang = "{{ $website_lang }}";

        // Function to add new section with input fields
        function addInputField() {
            // Define the template inside the function so sectionCounter is updated each time
            let new_setion_template = '';

            if (website_lang == 'ar') {
                new_setion_template = `
                    <div class="input-container">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="content_ar_${sectionCounter}" class="form-label">{{ __('app.content') }}</label>
                                <textarea class="form-control" id="content_ar_${sectionCounter}" name="supSections[${sectionCounter}][content_ar]" rows="3" placeholder="{{ __('app.content') }}"></textarea>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-outline-danger remove-btn" onclick="removeInputField(this)">
                                <i class="bi bi-x-circle"></i> {{ __('app.remove') }}
                            </button>
                        </div>
                        <hr>
                    </div>`;
            } else if (website_lang == 'en') {
                new_setion_template = `
                    <div class="input-container">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="content_en_${sectionCounter}" class="form-label">{{ __('app.content') }}</label>
                                <textarea class="form-control" id="content_en_${sectionCounter}" name="supSections[${sectionCounter}][content_en]" rows="3" placeholder="{{ __('app.content') }}"></textarea>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-outline-danger remove-btn" onclick="removeInputField(this)">
                                <i class="bi bi-x-circle"></i> {{ __('app.remove') }}
                            </button>
                        </div>
                        <hr>
                    </div>`;
            } else {
                new_setion_template = `
                    <div class="input-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="content_en_${sectionCounter}" class="form-label">{{ __('app.content_en') }}</label>
                                <textarea class="form-control" id="content_en_${sectionCounter}" name="supSections[${sectionCounter}][content_en]" rows="3" placeholder="{{ __('app.content_en') }}"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="content_ar_${sectionCounter}" class="form-label">{{ __('app.content_ar') }}</label>
                                <textarea class="form-control" id="content_ar_${sectionCounter}" name="supSections[${sectionCounter}][content_ar]" rows="3" placeholder="{{ __('app.content_ar') }}"></textarea>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-outline-danger remove-btn" onclick="removeInputField(this)">
                                <i class="bi bi-x-circle"></i> {{ __('app.remove') }}
                            </button>
                        </div>
                        <hr>
                    </div>`;
            }

            // Append the new section with updated sectionCounter
            $('#input-fields-container').append(new_setion_template);

            // Increment the counter after appending
            sectionCounter++;
            console.log(sectionCounter)
        }

        function removeInputField(button) {
            $(button).closest('.input-container').remove();
        }
    </script>
@endsection
