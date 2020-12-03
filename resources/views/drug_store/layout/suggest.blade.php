<div class="mr-y-2em">
	<div class="h4">محصولات مشابه: </div>
	<div class="suggest-product">
		@foreach ($suggests as $suggest)
			<div class="carousel-cell">
				<a class="p-1em" href="{{ url($suggest->slug) }}" title="{{$suggest->fa_name}}">
					<img data-flickity-lazyload="{{ asset($suggest->img.'/medium/1.jpg') }}">
					<hr>
					<div class="h5">{{$suggest->fa_name}}</div>
					<small class="mr-y-1em">{{$suggest->company}} - {{$suggest->company_en}}</small>
					<div class="mr-y-1em suggest-price">
						@if ($suggest->stock==0)
							<div class="green bold">
								<span class="h5 bold">ناموجود</span>
							</div>
						@else
							@if ($suggest->off > 0)
								<div class="flex">
									<div class="through">{{number_format($suggest->price)}}</div>
									<div class="img-rounded border-green green percent">{{ceil($suggest->off/$suggest->price*100)}} %</div>
								</div>
							@endif
							<div class="green bold">
								<span class="h5 bold">{{number_format($suggest->price - $suggest->off)}}</span>تومان
							</div>
						@endif
					</div>
					<div>
						<div class="ratings">
							<div class="empty-stars"></div>
							<div class="full-stars" data-width="{{$suggest->score}}"></div>
						</div>
						<small> ({{number_format($suggest->visit)}} نفر)</small>
					</div>
				</a>
			</div>
		@endforeach
	</div>
</div>