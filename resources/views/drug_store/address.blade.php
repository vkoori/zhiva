@include('../layout/header')
		<main class="container">
			<h1 class="h3">آدرس ارسال</h1>
			@if (sizeof($addresses) == 0)
				<div class="row">
			@else
				<form class="needs-validation" action="{{ url('finalize-order') }}" method="POST" accept-charset="utf-8" novalidate>
					@csrf
			@endif
				<div class="col-md-8" id="cart-list">
					@if (sizeof($addresses) == 0)
						@include('../profile/add-address')
					@else
						@include('../profile/list-address')
					@endif
				</div>
				<div class="col-md-4">
					<div class="border p-1em">
						<div>ارزش کالا: <span class="pull-left">{{number_format($sumPrice)}} <span class="small">تومان</span></span></div>
						<div>تخفیف: <span class="pull-left">{{number_format($sumOff)}} <span class="small">تومان</span></span></div>
						<div>مبلغ پرداختی: <span class="pull-left">{{number_format($sumPrice - $sumOff)}} <span class="small">تومان</span></span></div>
						<div>هزینه ارسال: <span class="pull-left">به عهده مشتری</span></div>
						<hr>
						<div>
							@if (sizeof($addresses) == 0)
								<p class="warning p-1em text-center">جهت ادامه فرایند آدرس خود را ثبت کنید.</p>
							@else
								<button class="bt-blue p-1em block w-100 text-center" type="submit" title="ادامه فرآیند خرید">ادامه فرآیند خرید</a>
							@endif
						</div>
					</div>
				</div>
			@if (sizeof($addresses) == 0)
				</div>
			@else
				</form>
			@endif
		</main>

@include('../layout/footer')