<style>
	.side-menu{
		margin: 0;
		padding: 0;
	}
	.side-menu li{
		display: block;
	}
	.side-menu a{
		padding: 0.5em;
		color: #333333;
	}
	.side-menu a:hover{
		color: #337ab7;
	}
	.side-menu a.selected{
		color: #00aeef;
	}
	.side-menu a:before{
		content: '';
		display: inline-block;
		vertical-align: middle;
		margin-left: 1em;
		width: 20px;
		height: 20px;
		background-image: url('{{ asset('public/assets/images/items/calendar.svg') }}');
		background-size: cover;
	}
</style>
<p class="h3"><br></p>
<div class="p-1em border">
	<ul class="side-menu">
		<li><a class="block {{(Request::is('user/dashboard')) ? 'selected' : '' }}" href="{{ url('user/dashboard') }}" title="داشبورد">داشبورد</a></li>
		<li><a class="block {{(Request::is('user/order')) ? 'selected' : '' }}" href="{{ url('user/order') }}" title="سفارشات من">سفارشات من</a></li>
		<li><a class="block {{(Request::is('user/profile')) ? 'selected' : '' }}" href="{{ url('user/profile') }}" title="پروفایل">پروفایل</a></li>
		<li><a class="block {{(Request::is('user/address') OR Request::is('new-address')) ? 'selected' : '' }}" href="{{ url('user/address') }}" title="آدرس های من">آدرس های من</a></li>
		<li><a class="block {{(Request::is('/')) ? 'selected' : '' }}" href="{{ url('خروج') }}" title="خروج">خروج</a></li>
	</ul>
</div>