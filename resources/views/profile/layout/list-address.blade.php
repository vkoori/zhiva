<style>
	.icon-address::before{content:'';width: 20px;height: 20px;display: inline-block;vertical-align: middle;background-size: contain;margin-left: 1em;}
	.my-address::before{background-image: url("{{ asset('public/assets/images/items/location.svg') }}");}
	.my-postalcode::before{background-image: url("{{ asset('public/assets/images/items/postalcode.svg') }}");}
	.address-box{padding-left: 7.5px;padding-right: 7.5px;}
	.address-box > label{display: block;min-height: 200px;margin-bottom: 1em;}
</style>
<div class="row">
	{{-- <p><a href="{{ url('new-address').'?back='.url()->current() }}" title="ثبت آدرس جدید">ثبت آدرس جدید</a></p> --}}
	@foreach ($addresses as $key => $address)
		<div class="col-md-6 address-box">
			<label for="address{{$address->id}}" class="p-1em border">
				<div>
					<input id="address{{$address->id}}" type="radio" name="addressid" value="{{$address->id}}" {{($key==0) ? 'checked=checked' : ''}}>
					<span>به این آدرس ارسال شود</span>
				</div>
				<hr>
				<p class="icon-address my-address">{{$address->province}}، {{$address->city}}، {{$address->address}}</p>
				<p class="icon-address my-postalcode">{{is_null($address->postal_code) ? 'ثبت نشده' : $address->postal_code}}</p>
			</label>
		</div>
	@endforeach
</div>