<!DOCTYPE html>
<html class="loaded" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
	<meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
	<meta name="author" content="ThemeSelect">
<title>ژیوافیت</title>
<link rel="apple-touch-icon" href="{{ asset('public/assets/images/items/logo2.svg') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/items/logo2.svg') }}">
	<link href="https://fonts.googleapis.com/css?family=Lalezar&display=swap&subset=arabic" rel="stylesheet">
	{{-- <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet"> --}}

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/vendors-rtl.min.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/css/forms/toggle/switchery.min.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/plugins/forms/switch.min.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/core/colors/palette-switch.min.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/css/charts/chartist.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/css/charts/chartist-plugin-tooltip.css"> --}}
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/bootstrap-extended.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/colors.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/components.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/custom-rtl.min.css') }}">
	<!-- END: Theme CSS-->

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/vertical-menu.min.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/core/colors/palette-gradient.min.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/core/colors/palette-gradient.min.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/pages/chat-application.css"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css-rtl/pages/dashboard-analytics.min.css"> --}}
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/styles/style.css') }}">
	<!-- END: Custom CSS-->

	@if (Request::is('admin/menu-management'))
		<link rel="stylesheet" href="{{ asset('public/assets/admin/styles/jquery.domenu-0.100.77.css') }}">
	@endif

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 2-columns fixed-navbar pace-done menu-expanded" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

	<!-- BEGIN: Header-->
	<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light"> 
		<div class="navbar-wrapper">
			<div class="navbar-container content bg-secondary">
				<div class="collapse navbar-collapse show" id="navbar-mobile">
					<ul class="nav navbar-nav mr-auto float-left">
						<li class="nav-item mobile-menu d-md-none mr-auto">
							<a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="ft-menu font-large-1"></i></a>
						</li>
						<li class="nav-item d-none d-md-block">
							<a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="ft-menu"></i></a>
						</li>
						<li class="nav-item d-none d-md-block">
							<a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a>
						</li>
						{{-- <li class="dropdown nav-item mega-dropdown d-none d-md-block">
							<a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
							<ul class="mega-dropdown-menu dropdown-menu row">
								<li class="col-md-2">
									<h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-link"></i> Quick Links</h6>
									<ul>
										<li><a class="my-1" href="chat-application.html"><i class="ft-home"></i> Chat</a></li>
										<li><a class="my-1" href="table-bootstrap.html"><i class="ft-grid"></i> Tables</a></li>
										<li><a class="my-1" href="chartist-charts.html"><i class="ft-bar-chart"></i> Charts</a></li>
										<li><a class="my-1" href="gallery-grid.html"><i class="ft-sidebar"></i> Gallery</a></li>
									</ul>
								</li>
								<li class="col-md-3">
									<h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-star"></i> My Bookmarks</h6>
									<ul class="ml-2">
										<li class="list-style-circle"><a class="my-1" href="card-bootstrap.html">
																							Cards</a></li>
										<li class="list-style-circle"><a class="my-1" href="full-calender.html"> Calender</a></li>
										<li class="list-style-circle"><a class="my-1" href="invoice-template.html"> Invoice</a></li>
										<li class="list-style-circle"><a class="my-1" href="users-contacts.html"> Contact</a></li>
									</ul>
								</li>
								<li class="col-md-3">
									<h6 class="dropdown-menu-header text-uppercase"><i class="ft-layers"></i> Recent Products</h6>
									<div class="carousel slide pt-1" id="carousel-example" data-ride="carousel">
										<div class="carousel-inner" role="listbox">
											<div class="carousel-item active carousel-item-left"><img class="d-block w-100" src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/carousel/08.jpg" alt="First slide"></div>
											<div class="carousel-item carousel-item-next carousel-item-left"><img class="d-block w-100" src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/carousel/03.jpg" alt="Second slide"></div>
											<div class="carousel-item"><img class="d-block w-100" src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/carousel/01.jpg" alt="Third slide"></div>
										</div><a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev"><span class="la la-angle-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next"><span class="la la-angle-right icon-next" aria-hidden="true"></span><span class="sr-only">Next</span></a>
										<h5 class="pt-1">Special title treatment</h5>
										<p>Jelly beans sugar plum.</p>
									</div>
								</li>
								<li class="col-md-4">
									<h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-thumbs-up"></i> Get in touch</h6>
									<form class="form form-horizontal pt-1">
										<div class="form-body">
											<div class="form-group row">
												<label class="col-sm-3 form-control-label" for="inputName1">Name</label>
												<div class="col-sm-9">
													<div class="position-relative has-icon-left">
														<input class="form-control" id="inputName1" type="text" placeholder="John Doe">
														<div class="form-control-position pl-1"><i class="ft-user"></i></div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label" for="inputContact1">Contact</label>
												<div class="col-sm-9">
													<div class="position-relative has-icon-left">
														<input class="form-control" id="inputContact1" type="text" placeholder="(123)-456-7890">
														<div class="form-control-position pl-1"><i class="ft-smartphone"></i></div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
												<div class="col-sm-9">
													<div class="position-relative has-icon-left">
														<input class="form-control" id="inputEmail1" type="email" placeholder="john@example.com">
														<div class="form-control-position pl-1"><i class="ft-mail"></i></div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label" for="inputMessage1">Message</label>
												<div class="col-sm-9">
													<div class="position-relative has-icon-left">
														<textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
														<div class="form-control-position pl-1"><i class="ft-message-circle"></i></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 mb-1">
													<button class="btn btn-danger float-right" type="button"><i class="ft-arrow-right"></i> Submit</button>
												</div>
											</div>
										</div>
									</form>
								</li>
							</ul>
						</li> --}}
						{{-- <li class="dropdown d-none d-md-block mr-1"><a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
															 Apps</a>
							<div class="dropdown-menu">
								<div class="arrow_box"><a class="dropdown-item" href="email-application.html"><i class="ft-user"></i> Email</a><a class="dropdown-item" href="chat-application.html"><i class="ft-mail"></i> Chat</a><a class="dropdown-item" href="project-summary.html"><i class="ft-briefcase"></i> Project Summary            </a><a class="dropdown-item" href="full-calender.html"><i class="ft-calendar"></i> Calendar            </a></div>
							</div>
						</li> --}}
						{{-- <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
							<ul class="dropdown-menu">
								<li class="arrow_box">
									<form>
										<div class="input-group search-box">
											<div class="position-relative has-icon-right full-width">
												<input class="form-control" id="search" type="text" placeholder="Search here...">
												<div class="form-control-position navbar-search-close"><i class="ft-x"></i></div>
											</div>
										</div>
									</form>
								</li>
							</ul>
						</li> --}}
					</ul>
					<ul class="nav navbar-nav float-right">
						{{-- <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language"></span></a>
							<div class="dropdown-menu" aria-labelledby="dropdown-flag">
								<div class="arrow_box"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-ru"></i> Russian</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a></div>
							</div>
						</li> --}}
						<li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i><span class="badge badge-pill badge-sm badge-danger badge-up badge-glow">{{sizeof($news)}}</span></a>
							<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
								<div class="arrow_box_right">
									<li class="dropdown-menu-header">
										<h6 class="dropdown-header m-0"><span class="grey darken-2">اعلان ها</span></h6>
									</li>
									<li class="scrollable-container media-list w-100 ps">
										@foreach ($news as $n)
											<a href="javascript:void(0)">
												<div class="media">
													{{-- <div class="media-left align-self-center">
														<i class="ft-share info font-medium-4 mt-2"></i>
													</div> --}}
													<div class="media-body">
														<h6 class="media-heading primary">{{$n->title}}</h6>
														<p class="notification-text font-small-3 text-muted text-bold-600">{{ Str::limit($n->content, 60) }}</p>
														<small>
															<time dir="ltr" class="media-meta text-muted" datetime="{{$n->created_at}}">{{dateTimeToJalali($n->created_at)}}</time>
														</small>
													</div>
												</div>
											</a>
										@endforeach
									</li>
									<li class="dropdown-menu-footer">
										<a class="dropdown-item info text-right pr-1" href="javascript:void(0)">مشاهده همه</a>
									</li>
								</div>
							</ul>
						</li>
						{{-- <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
							<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
								<div class="arrow_box_right">
									<li class="dropdown-menu-header">
										<h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6>
									</li>
									<li class="scrollable-container media-list w-100 ps"><a href="javascript:void(0)">
											<div class="media">
												<div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"></span></div>
												<div class="media-body">
													<h6 class="media-heading text-bold-700">Sarah Montery<i class="ft-circle font-small-2 success float-right"></i></h6>
													<p class="notification-text font-small-3 text-muted text-bold-600">Everything looks good. I will provide...</p><small>
														<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">3:55 PM</time></small>
												</div>
											</div></a><a href="javascript:void(0)">
											<div class="media">
												<div class="media-left"><span class="avatar avatar-sm rounded-circle"><span class="media-object rounded-circle text-circle bg-warning">E</span></span></div>
												<div class="media-body">
													<h6 class="media-heading text-bold-700">Eliza Elliot<i class="ft-circle font-small-2 danger float-right"></i></h6>
													<p class="notification-text font-small-3 text-muted text-bold-600">Okay. here is some more details...</p><small>
														<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">2:10 AM</time></small>
												</div>
											</div></a><a href="javascript:void(0)">
											<div class="media">
												<div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"></span></div>
												<div class="media-body">
													<h6 class="media-heading text-bold-700">Kelly Reyes<i class="ft-circle font-small-2 warning float-right"></i></h6>
													<p class="notification-text font-small-3 text-muted text-bold-600">Check once and let me know if you...</p><small>
														<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
												</div>
											</div></a><a href="javascript:void(0)">
											<div class="media">
												<div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="https://themeselection.com/demo/chameleon-admin-template/app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"></span></div>
												<div class="media-body">
													<h6 class="media-heading text-bold-700">Tonny Deep<i class="ft-circle font-small-2 danger float-right"></i></h6>
													<p class="notification-text font-small-3 text-muted text-bold-600">We will start new project development...</p><small>
														<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
												</div>
											</div></a><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
									<li class="dropdown-menu-footer"><a class="dropdown-item text-right info pr-1" href="javascript:void(0)">Read all</a></li>
								</div>
							</ul>
						</li> --}}
						<li class="dropdown dropdown-user nav-item">
							<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown" aria-expanded="false">
								<span class="avatar avatar-online">
									<img src="{{ asset('public/assets/admin/images/profile.png') }}" alt="avatar">
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="arrow_box_right">
									<a class="dropdown-item" href="#">
										<span class="avatar avatar-online">
											<img src="{{ asset('public/assets/admin/images/profile.png') }}" alt="avatar">
											<span class="user-name text-bold-700 ml-1">نام کاربری	</span>
										</span>
									</a>
									<div class="dropdown-divider"></div>
										{{-- @if (Session()->get('access') == "5") --}}
											<a class="dropdown-item" href="{{ url('register') }}"><i class="ft-user-plus"></i> ثبت کاربر جدید</a>
										{{-- @endif --}}
										<a class="dropdown-item" href="{{ url('forget') }}"><i class="ft-unlock"></i> تعییر رمز</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ url('quit') }}"><i class="ft-power"></i> خروج</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- END: Header-->
