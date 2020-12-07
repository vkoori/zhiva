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
	@if (Request::is('/'))
		{{-- <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css"> --}}
		<link rel="stylesheet" href="{{ asset('public/assets/styles/libraries/flickity.min.css') }}">
		<link rel="stylesheet" href="{{ asset('public/assets/styles/supplements/home.css') }}">
	@elseif (Route::current()->getName() == "dr_category")
		<link rel="stylesheet" href="{{ asset('public/assets/styles/supplements/category.css') }}">
		{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.min.css"> <!-- price range --> --}}
		<link rel="stylesheet" href="{{ asset('public/assets/styles/libraries/semantic.min.css') }}">
	@elseif (Route::current()->getName() == "product")
		{{-- <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css"> --}}
		<link rel="stylesheet" href="{{ asset('public/assets/styles/libraries/flickity.min.css') }}">
		{{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/flickity-fullscreen@1/fullscreen.css"> --}}
		<link rel="stylesheet" href="{{ asset('public/assets/styles/supplements/product.css') }}">
	@elseif (Request::is('cart'))
		<link rel="stylesheet" href="{{ asset('public/assets/styles/supplements/cart.css') }}">
	@elseif (Request::is('finalize-order'))
		<link rel="stylesheet" href="{{ asset('public/assets/styles/libraries/flickity.min.css') }}">
	@endif

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

</head>
<body>
	<header>
		<div class="container">
			<div id="top-bar" class="flex">
				<div>
					<a href="{{ url('/') }}" class="logo">
						<img src="{{ asset('public/assets/images/items/logo.svg') }}" alt="ژیوافیت">
					</a>
				</div>
				<div class="grow1" id="search-box">
					<form id="search-form" class="relative" action="" method="get" accept-charset="utf-8">
						<input class="img-rounded" type="text" name="search" placeholder="جستجو ...">
						<button class="img-rounded" type="submit"><img src="{{ asset('public/assets/images/items/search.svg') }}" alt=""></button>
					</form>
				</div>
				<div id="quick-link">
					<a href="" title="">
						<img src="{{ asset('public/assets/images/items/fire.svg') }}" alt="" width="30px" height="30px">
						<span>فروش ویژه</span>
					</a>
					@if (!Session::has('userid'))
						<a href="{{ url('ورود').'?back='.url()->full() }}" title="ورود - ثبت نام">
							<img src="{{ asset('public/assets/images/items/login.svg') }}" alt="ورود - ثبت نام" width="30px" height="30px">
							<span>ورود / ثبت&zwnj;نام</span>
						</a>
					@else
						<div class="relative">
							<a id="profile-toggle" href="{{url('user/dashboard')}}" title="حساب کاربری">
								<img src="{{ asset('public/assets/images/items/user.svg') }}" alt="پروفایل" width="30px" height="30px">
								<span>حساب کاربری</span>
							</a>
							<div class="expand-menu">
								<ul>
									<li><a href="{{url('user/order')}}" title="سفارش ها">سفارش ها من</a></li>
									<li><a href="{{url('user/profile')}}" title="پروفایل">پروفایل</a></li>
									<li><a href="{{url("خروج")}}" title="خروج">خروج</a></li>
								</ul>
							</div>
						</div>
					@endif
					<a href="{{ url('cart') }}" title="سبد خرید">
						<img src="{{ asset('public/assets/images/items/cart.svg') }}" alt="" width="30px" height="30px">
						<span>سبد خرید</span>
					</a>
				</div>
			</div>
		</div>
		<nav class="container">
			<span id="toggle-nav">
				<img src="{{ asset('public/assets/images/items/menu.svg') }}" alt="" width="25px" height="25px">
			</span>
			<ul id="nav">
				{!!request()->instance()->query('nav')!!}
			</ul>
		</nav>
	</header><!-- /header -->