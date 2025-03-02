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
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .ck-editor__editable_inline {
            min-height: 200px;
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
                            enctype="multipart/form-data" id="form_data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab"
                                            role="tabpanel">
                                            @php
                                                $website_lang = Setting('website_language');
                                            @endphp
                                                {{-- @include('Admin.Article.Create.create_form_ar') --}}

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
                                            <h5>{{ __('app.meta_tags') }}</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-dark add-btn" onclick="addInputField()">+
                                                {{ __('app.add_tag') }}</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end mt-1">
                                            <button type="button" id="article-preview"
                                                class="btn btn-primary glow mb-1 mb-sm-0 mr-1">
                                                {{ __('app.preview') }} </button>
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
    {{-- <script src="{{ asset('assets2/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets2/ckeditor/style.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description_ar'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                },
            })
            .catch(error => {
                console.error(error);
            });
    </script>
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
                                <label for="content_ar_${sectionCounter}" class="form-label">{{ __('app.tag') }}</label>
                                <input type="text" class="form-control" id="content_ar_${sectionCounter}" name="supSections[${sectionCounter}][content_ar]" placeholder="{{ __('app.tag') }}" />
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
        $('#article-preview').on('click', function() {
            let title_ar = $('#title_ar').val();
            let description_ar = $('#description_ar').val();
            if (title_ar == '' || description_ar == '') {
                alert('Please fill all fields')
                return;
            }
            var editor = CKEDITOR.instances['description_ar'];
            var descriptionValue = editor.getData();
            description_ar = descriptionValue
            var formData = new FormData(document.getElementById("form_data")); // Pass the actual DOM element
            formData.append('description_ar', description_ar);
            $.ajax({
                url: "{{ route('article.preview') }}",
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content-type
                success: function(data) {
                    window.open("https://alturkistanilaw.com/", '_blank');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Handle errors
                }
            });

        })
    </script>
@endsection
