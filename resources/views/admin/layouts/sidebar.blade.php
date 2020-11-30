		<!-- BEGIN: Main Menu-->
		<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" data-img="{{ asset('public/assets/admin/images/background.jpg') }}">
			<div class="navbar-header">
				<ul class="nav navbar-nav flex-row">
					<li class="nav-item mr-auto">
						<a class="navbar-brand" href="{{ url('/') }}">
							<img class="brand-logo" alt="پنل مدیریت زیوافیت" src="{{ asset('public/assets/images/items/logo2.svg') }}">
							<h3 class="brand-text">سایت ژیوافیت</h3>
						</a>
					</li>
					<li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
				</ul>
			</div>
			<div class="navigation-background"></div>
			<div class="main-menu-content ps ps--active-y">
				<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
					<li class="nav-item {{  Request::is('admin') ? 'active' : '' }}">
						<a href="{{ url('admin') }}">
							<i class="ft-home"></i>
							<span class="menu-title">پیشخوان</span>
						</a>
					</li>
					<li class="nav-item {{  Request::is('admin/media-library') ? 'active' : '' }}">
						<a href="{{ url('admin/media-library') }}">
							<i class="ft-image"></i>
							<span class="menu-title">آپلودها</span>
						</a>
					</li>
					<li class="nav-item has-sub">
						<a href="#">
							<i class="ft-menu"></i>
							<span class="menu-title">منو</span>
						</a>
						<ul class="menu-content">
							<li class="{{ Request::is('admin/menu-management') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/menu-management') }}">چیدمان</a></li>
							<li class="{{ (Request::is('admin/menu-details/*') || Request::is('admin/menu-details')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/menu-details') }}">متا تگ</a></li>
						</ul>
					</li>
					<li class="nav-item has-sub">
						<a href="#">
							<i class="ft-hash"></i>
							<span class="menu-title">تگ</span>
						</a>
						<ul class="menu-content">
							<li class="{{ Request::is('admin/drug-store/tags') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/drug-store/tags') }}">فیلتر مکمل</a></li>
						</ul>
					</li>
					<li class="nav-item has-sub">
						<a href="#">
							<i class="ft-cpu"></i>
							<span class="menu-title">مکمل ها</span>
							{{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
						</a>
						<ul class="menu-content">
							<li class="nav-item {{  Request::is('admin/drug-store/brands') ? 'active' : '' }}"><a href="{{ url('admin/drug-store/brands') }}">برندها</a></li>
							<li class="nav-item {{  Request::is('admin/drug-store/taste') ? 'active' : '' }}"><a href="{{ url('admin/drug-store/taste') }}">طعم</a></li>
							<li class="{{ Request::is('admin/drug-store/add-product') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/drug-store/add-product') }}">ثبت محصول</a></li>
							<li class="{{ Request::is('admin/product-list/*') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/product-list/1') }}">لیست محصولات</a></li>
						</ul>
					</li>
					<li class="nav-item has-sub">
						<a href="#">
							<i class="ft-user"></i>
							<span class="menu-title">مشتریان</span>
							{{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
						</a>
						<ul class="menu-content">
							<li class="{{ Request::is('add-customer') ? 'active' : '' }}"><a class="menu-item" href="{{ url('add-customer') }}">ثبت مشتری </a></li>
							<li class="{{ Request::is('customer-list/*') ? 'active' : '' }}"><a class="menu-item" href="{{ url('customer-list/1') }}">لیست مشتریان</a></li>
						</ul>
					</li>
					<li class="nav-item has-sub">
						<a href="#">
							<i class="ft-shopping-cart"></i>
							<span class="menu-title">فاکتورها</span>
							@if ($factors>0)
								<span class="badge badge bg-blue badge-pill float-right mr-2">{{$factors}}</span>
							@endif
						</a>
						<ul class="menu-content">
							<li class="{{ Request::is('add-pre-factor') ? 'active' : '' }}"><a class="menu-item" href="{{ url('add-pre-factor') }}">ثبت فاکتور</a></li>
							<li class="{{ Request::is('pre-factor') ? 'active' : '' }}"><a class="menu-item" href="{{ url('pre-factor') }}">لیست فاکتورها</a></li>
						</ul>
					</li>
					<li class="nav-item {{  Request::is('admin/comments') ? 'active' : '' }}">
						<a href="#">
							<i class="ft-file-text"></i>
							<span class="menu-title">دیدگاه ها</span>
							@if ($dr_comments + $blog_comments > 0)
								<span class="badge badge bg-blue badge-pill float-right mr-2">{{$dr_comments + $blog_comments}}</span>
							@endif
						</a>
						<ul class="menu-content">
							<div>
								@if ($dr_comments>0)
									<span class="badge badge bg-blue badge-pill float-right mr-2">{{$dr_comments}}</span>
								@endif
								<li class="{{ Request::is('admin/drug-store/comments') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/drug-store/comments') }}">داروخانه</a></li>
							</div>
							<div>
								@if ($blog_comments>0)
									<span class="badge badge badge-info badge-pill float-right mr-2">{{$blog_comments}}</span>
								@endif
								<li class="{{ Request::is('admin/comments/blog') ? 'active' : '' }}"><a class="menu-item" href="{{ url('admin/comments/blog') }}">مجله</a></li>
							</div>
						</ul>
					</li>
					
				</ul>
			</div>
		</div>
		<!-- END: Main Menu-->
