@include('layout/header')
		<style>
			.bold-shadow{text-shadow: 0px 0px 0px black;}
			.icon-address::before{content:'';width: 20px;height: 20px;display: inline-block;vertical-align: middle;background-size: contain;margin-left: 1em;}
			.my-address::before{background-image: url("{{ asset('public/assets/images/items/location.svg') }}");}
			.my-postalcode::before{background-image: url("{{ asset('public/assets/images/items/postalcode.svg') }}");}
			.qty-icon::before{background-image: url("{{ asset('public/assets/images/items/qty.svg') }}");}
			.kg-icon::before{background-image: url("{{ asset('public/assets/images/items/kg.svg') }}");}
			.kg-dosage::before{background-image: url("{{ asset('public/assets/images/items/dosage.svg') }}");}
			.cart-details-row{margin-bottom: 0.5em;}
			.order-summary img.flickity-lazyloaded{
				height: auto;
				display: block;
				margin: 0 auto;
			}
			.order-summary .carousel-cell{
				margin: 0 5px;
			}
			.order-summary a{
				width: calc(150px + 2em);
				display: block;
				text-decoration: blink;
			}
		</style>
		<main class="container">
			<h1 class="h3">بررسی نهایی</h1>
			<div class="row">
				<div class="col-md-8" id="cart-list">
					<section class="border p-1em mr-b-1em">
						<h2 class="h5 bold-shadow">محل ارسال</h2>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<p class="icon-address my-address">{{$address->province}}، {{$address->city}}، {{$address->address}}</p>
								<p class="icon-address my-postalcode">{{is_null($address->postal_code) ? 'ثبت نشده' : $address->postal_code}}</p>
							</div>
							
						</div>
					</section>
					<section class="border p-1em mr-b-1em">
						<h2 class="h5 bold-shadow">خلاصه سفارش</h2>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="order-summary">
									{{-- {{dd($cart)}} --}}
									@foreach ($cart as $c)
										<div class="carousel-cell">
											<a class="p-1em" href="{{url($c->category).'/'.$c->slug.'?'.$c->qs}}" title="{{$c->fa_name}}">
												<img width="150" height="150" data-flickity-lazyload="{{ asset($c->img.'/medium/1.jpg') }}">
												<hr>
												<div class="d-inline-block align-middle">
													<div class="cart-details-row">{{$c->fa_name}}</div>
													@switch($c->type)
													    @case(1)
													    	<div class="icon-address kg-icon cart-details-row">{{$c->value}}</div>
													        @break
													    @case(2)
													    	<div class="icon-address dosage-icon cart-details-row">{{$c->value}}</div>
													        @break
														@case(3)
													    	<div class="icon-address dosage-icon cart-details-row">{{$c->value}}</div>
													        @break
													    @default
													        <div class="cart-details-row">{{$c->value}}</div>
													@endswitch
													<div class="cart-details-row">
														<img class="d-inline-block align-middle" width="20" height="20" src="{{$c->icon}}" alt="{{$c->taste}}">
														<span class="d-inline-block align-middle mr-x-1em">{{$c->taste}}</span>
													</div>
												</div>
												<p class="icon-address qty-icon">{{$c->qty}} عدد</p>
											</a>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-4">
					<div class="border p-1em">
						@include('drug_store/layout/cart-summary')
						<hr>
						<style>
							#discount-code{
								padding: 0.5em 1em;
								width: 100%;
								outline: none;
							}
							#discount-code:active,
							#discount-code:focus{
								border: solid 1px #26bff9;
							}
							#discount-code:active + #discount-submit,
							#discount-code:focus + #discount-submit{
								color: #26bff9;
							}
							#discount-submit{
								position: absolute;
								height: calc(100% - 2px);
								left: 1px;
								top: 1px;
								border: none;
								background: #ffffff;
								outline: none;
							}
						</style>
						<form class="relative" action="{{ url('check-discount') }}" method="POST" accept-charset="utf-8" onsubmit="return checkDiscount(this);">
							{{-- @csrf --}}
							<input id="discount-code" class="border" type="text" name="discount-code" placeholder="کد تخفیف">
							<input id="discount-submit" type="submit" value="ثبت">
						</form>
						<hr>
						<form action="{{ url('bank') }}" method="POST" accept-charset="utf-8">
							@csrf
							<input type="hidden" name="addressid" value="{{$address->id}}">
							<input type="hidden" name="cart" value="{{Cookie::get('cart')}}">
							<input type="hidden" name="discount-code" id="discount-order" value="">
							<button type="submit" class="bt-blue p-1em block w-100 text-center" title="پرداخت و ثبت سفارش">پرداخت و ثبت سفارش</button>
						</form>
						<div class="mr-t-1em text-center">
							<a href="{{url('address')}}" title="انتخاب آدرس">مرحله قبل</a>
						</div>
					</div>
				</div>
			</div>
		</main>
@include('layout/footer')