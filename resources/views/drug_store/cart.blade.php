@include('../layout/header')
		<main class="container">
			<h1 class="h3">سبد خرید</h1>
			@if (sizeof($cart) > 0)
				<div class="row">
					<div class="col-md-8" id="cart-list">
					@foreach ($cart as $c)
						{{-- {{dd($c)}} --}}
						<div class="row mr-b-1em p-1em border">
							<div class="col-md-8">
								<a class="block" href="{{url($c->category).'/'.$c->slug.'?'.$c->qs}}" title="{{$c->fa_name}}">
									<div class="d-inline-block align-middle">
										<img src="{{$c->img.'/thumbnail/1.jpg'}}" alt="{{$c->fa_name}}">
									</div>
									<div class="d-inline-block align-middle">
										<div class="cart-details-row">{{$c->fa_name}} ({{$c->en_name}})</div>
										@switch($c->type)
										    @case(1)
												<div class="cart-details-row">
													<img class="d-inline-block align-middle" width="20" height="20" src="{{ asset('public/assets/images/items/kg.svg') }}" alt="وزن">
													<span class="d-inline-block align-middle">{{$c->value}}</span>
												</div>
										        @break
										    @case(2)
												<div class="cart-details-row">
													<img class="d-inline-block align-middle" width="20" height="20" src="{{ asset('public/assets/images/items/dosage.svg') }}" alt="دز">
													<span class="d-inline-block align-middle">{{$c->value}}</span>
												</div>
										        @break
											@case(3)
												<div class="cart-details-row">
													<img class="d-inline-block align-middle" width="20" height="20" src="{{ asset('public/assets/images/items/dosage.svg') }}" alt="قرص">
													<span class="d-inline-block align-middle">{{$c->value}}</span>
												</div>
										        @break
										    @default
										        <div class="cart-details-row">{{$c->value}}</div>
										@endswitch
										<div class="cart-details-row">
											<img class="d-inline-block align-middle" width="20" height="20" src="{{$c->icon}}" alt="{{$c->taste}}">
											<span class="d-inline-block align-middle">{{$c->taste}}</span>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-4">
								<form class="flex flex-center" action="{{ url('cart') }}" method="POST" accept-charset="utf-8">
									<input type="hidden" name="_method" value="PUT">
									@csrf
									<div class="count grow1 relative">
										<input type="hidden" name="item" value="{{$c->item}}">
										<button class="border plus" type="submit" name="chnageQTY" value="plus"><span></span></button>
										<div class="border">{{min($c->stock, $c->qty)}}</div>
										<button class="border minus" type="submit" name="chnageQTY" value="minus"><span></span></button>
									</div>
									<div class="mr-r-1em">
										<button class="remove-btn" type="submit" name="chnageQTY" value="remove">
											<img width="20" height="20" src="{{ asset('public/assets/images/items/delete.svg') }}" alt="حذف">
										</button>
										
									</div>
								</form>
								<div class="cart-price mr-y-1em">
									@if ($c->off > 0)
										<div class="through">{{number_format($c->price * min($c->stock, $c->qty))}}</div>
									@endif
									<div class="green bold">
										<span class="h5 bold">{{number_format(($c->price - $c->off)*min($c->stock, $c->qty))}}</span>تومان
									</div>
								</div>
							</div>
							@if ($c->qty > $c->stock)
								@if ($c->stock == 0)
									<div class="col-md-12 warning">موجودی این محصول به پایان رسیده و از سبد خرید شما حذف خواهد شد.</div>
								@else
									<div class="col-md-12 warning">از این محصول تنها {{$c->stock}} عدد موجود است.</div>
								@endif
							@endif
						</div>
					@endforeach
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
			@else
				<div class="warning p-1em h5">سبد خرید شما خالی است.</div>
			@endif
		</main>
@include('../layout/footer')