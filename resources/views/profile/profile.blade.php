@include('layout/header')

		<main class="container">
			@if (sizeof($addresses) == 0)
				<div class="row">
			@else
				<form class="needs-validation" action="{{ url('finalize-order') }}" method="POST" accept-charset="utf-8" novalidate>
					@csrf
			@endif
				<div class="col-md-3" id="cart-list">
					@include('profile/layout/menu')
				</div>
				<div class="col-md-9" id="cart-list">
					<h1 class="h3 d-inline-block">آدرس ارسال</h1>
					@if (sizeof($addresses) > 0)
						<p class="d-inline-block mr-x-1em"><a href="{{ url('new-address').'?back='.url()->current() }}" title="ثبت آدرس جدید">(&nbsp;<img width="12" height="12" src="{{ asset('public/assets/images/items/cross.svg') }}" alt="+">&nbsp;&nbsp;&nbsp;&nbsp;ثبت آدرس جدید&nbsp;)</a></p>
					@endif
					@if (sizeof($addresses) == 0)
						@include('profile/layout/add-address')
					@else
						@include('profile/layout/list-address')
					@endif
				</div>
			@if (sizeof($addresses) == 0)
				</div>
			@else
				</form>
			@endif
		</main>

@include('layout/footer')