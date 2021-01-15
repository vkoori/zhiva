@include('layout/header')
		<main class="container">
			<h1 class="h3 d-inline-block">آدرس ارسال</h1>
			@if (sizeof($addresses) > 0)
				<p class="d-inline-block mr-x-1em"><a href="{{ url('new-address').'?back='.url()->current() }}" title="ثبت آدرس جدید">(ثبت آدرس جدید)</a></p>
			@endif
			@if (sizeof($addresses) == 0)
				<div class="row">
			@else
				<form class="needs-validation" action="{{ url('finalize-order') }}" method="POST" accept-charset="utf-8" novalidate>
					@csrf
			@endif
				<div class="col-md-8" id="cart-list">
					@if (sizeof($addresses) == 0)
						@include('profile/layout/add-address')
					@else
						@include('profile/layout/list-address')
					@endif
				</div>
				<div class="col-md-4">
					<div class="border p-1em">
						@include('drug_store/layout/cart-summary')
						<hr>
						<div>
							@if (sizeof($addresses) == 0)
								<p class="warning p-1em text-center">جهت ادامه فرایند آدرس خود را ثبت کنید.</p>
							@else
								<button class="bt-blue p-1em block w-100 text-center" type="submit" title="ادامه فرآیند خرید">ادامه فرآیند خرید</a>
							@endif
						</div>
						<div class="mr-t-1em text-center">
							<a href="{{url('cart')}}" title="سبد خرید">مرحله قبل</a>
						</div>
					</div>
				</div>
			@if (sizeof($addresses) == 0)
				</div>
			@else
				</form>
			@endif
		</main>

@include('layout/footer')