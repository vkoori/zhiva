<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
{{-- <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}" type="image/x-icon"> --}}
{{-- <link rel="icon" href="icon.svg" sizes="any" type="image/svg+xml"> --}}

<link rel="icon" href="https://www.bodybuilding.com/images/bb-favicon-16.png" sizes="16x16" type="image/png">
<link rel="icon" href="https://www.bodybuilding.com/images/bb-favicon-32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://www.bodybuilding.com/images/bb-favicon-48.png" sizes="48x48" type="image/png">
<link rel="icon" href="https://www.bodybuilding.com/images/bb-favicon-62.png" sizes="62x62" type="image/png">

    <!-- Open Graph data -->
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="website">
<meta property="og:image" content="https://artifacts.bbcomcdn.com/@bbcom/bb-wrapper/41.5.1/images/logo-white.svg" />
    <meta property="og:url" content="{{ Request::url('') }}">
<meta property="og:site_name" content="فروشگاه اینترنتی دکوراسیون داخلی توکامارت">
<meta property="fb:admins" content="100026023324031" />
    <!-- Schema.org markup for Google+ -->
<meta itemprop="image" content="{{ asset('public/assets/images/items/logo.svg') }}">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@tookamart">
<meta name="twitter:image" content="{{ asset('public/assets/images/items/logo.svg') }}">
    <!-- Dublin Core Metadata Set -->
    <meta name="dc.language" CONTENT="fa">
    <meta name="DC.Type" content="physical object">
<!-- <meta name="DC.Type" content="text"> mag -->
    <meta name="dc.source" CONTENT="{{ URL::to('/') }}">
<meta name="dc.subject" CONTENT="فروشگاه اینترنتی دکوراسیون داخلی توکامارت">
<meta name="DC.publisher" content="توکامارت - tookamart">
    
    <meta property="business:contact_data:country_name" content="ایران">
    <meta property="business:contact_data:website" content="{{ URL::to('/') }}">
<meta property="business:contact_data:email" content="info@tookamart.com">
    
    <link rel="stylesheet" href="{{ asset('public/assets/styles/style.css') }}">

<!-- <meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow"> -->
    
{{-- <title>{{ $title }}</title>
<meta property="og:title" content="{{ $title }}">
<meta name="dc.title" CONTENT="{{ $title }}">
<meta name="description" content="{{ $description }}" />
<meta property="og:description" content="{{ $description }}">
<meta name="dc.description" CONTENT="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta property="article:tag" content="{{ $keywords }}">
<meta name="dc.keywords" CONTENT="{{ $keywords }}">
<meta itemprop="name" content="{{ $title }}">
<meta itemprop="description" content="{{ $description }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta property="article:section" content="{{ $title }}"> --}}
    <style>
        input {
            height: 3em;
        }
        section > div{
            max-width: 410px;
            min-width: 390px;
        }
    </style>
</head>
<body>
    <main id="main">
        <section class="flex-center">
            <div class="img-rounded border p-1em text-center">
                <form method="post" action="{{ url()->full() }}" accept-charset="utf-8">
                    @csrf

                    <div>
                        <a href="{{ url('/') }}" class="logo mr-x-auto">
                            <img alt="zhivafit.com" src="{{ asset('public/assets/images/items/logo.svg') }}">
                        </a>
                    </div>

                    <h1 class="h3">ورود / ثبت&zwnj;نام</h1>
                    <p class="mr-b-1em">شماره موبایل  خود را وارد کنید</p>
                    <input class="w-100 mr-b-1em" name="mobile" type="text" placeholder="شماره موبایل">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="submit" class="img-rounded w-100 mr-b-1em bt-blue" value="ادامه">
                    <p>استفاده از سامانه ژیوافیت به منزله پذیرفتن <a href="" title="قوانین">قوانین و مقررات</a> میباشد.</p>
                </form>
            </div>
        </section>
    </main>
</body>
</html>