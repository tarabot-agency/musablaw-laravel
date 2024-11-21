@extends('Admin.layout.app')
@section('title')
    {{ __('app.dashboard') }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .cardContainer {
            flex-basis: 95%;
            padding: 10px 20px;
            font-family: "Ubuntu", sans-serif;
            text-transform: capitalize;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 4%;
        }

        .card {
            padding: 20px;
            border-radius: 15px;
            background-color: white;
            width: 22%;
            min-height: 30px;
            color: grey;
            margin: 15px 0;
            box-shadow: 3px 4px 8px 2px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: space-between;
            gap: 5%;
            transition: 0.8s
        }

        .card:hover {
            transform: scale(1.1);

        }

        .card div {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-basis: 70%;
            text-align: center;
        }

        .card i {
            background: #7d853b;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            padding: 20px;
            font-size: 25px;
        }

        .card * {
            text-wrap: nowrap;
        }

        .card strong {
            color: black;
            font-weight: 900;
            font-size: 25px;
        }

        @media (max-width: 850px) {
            .cardContainer {
                justify-content: space-between;
                gap: unset;
            }

            .card {
                width: 49%;
            }
        }

        @media (max-width: 400px) {
            .cardContainer {
                justify-content: center;
            }

            .card {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body mt-2">
                <div class="cardContainer">
                    <a class="card" href="{{ route('our-services.index') }}">
                        <div>  <i class='bx bx-buildings'></i>
                            <div><strong>{{ $our_services_count }}</strong> <span>{{ __('app.our_services') }}</span></div>
                        </div>
                    </a>
                    <a class="card" href="{{ route('articles.index') }}">
                        <div><i class='bx bx-book-open'></i>
                            <div><strong>{{ $articles_count }}</strong> <span>{{ __('app.articles') }}</span></div>
                        </div>
                    </a>
                    <a class="card" href="{{ route('contact-us.index') }}">
                        <div> <i class='bx bx-envelope'></i>
                            <div><strong>{{ $contact_uss_count }}</strong> <span>{{ __('app.contact_us') }}</span></div>
                        </div>
                    </a>
                    <a class="card" href="{{ route('parteners.index') }}">
                        <div><i class='bx bxs-user-check'></i>
                            <div><strong>{{ $parteners_count }}</strong> <span>{{ __('app.parteners') }}</span></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
@endsection
