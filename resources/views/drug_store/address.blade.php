@include('../layout/header')
		<main class="container">
			<h1 class="h3">آدرس ارسال</h1>
			<div class="row">
				<div class="col-md-8" id="cart-list">
					@if (sizeof($addresses) == 0)
						@include('../profile/address')
					@else
						@foreach ($addresses as $address)
							{{-- expr --}}
						@endforeach
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
							<a class="bt-blue p-1em block text-center" href="{{ url('address') }}" title="ادامه فرآیند خرید">ادامه فرآیند خرید</a>
						</div>
					</div>
				</div>
			</div>
		</main>

@include('../layout/footer')