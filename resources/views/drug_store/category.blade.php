@include('../layout/header')
	<main class="container">
		<div class="row">
			<ul itemscope="" itemtype="http://schema.org/BreadcrumbList" id="your-location">
				@foreach ($breadcrumb as $key => $item)
					<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
						<a class="location-bar" itemprop="item" href="{{ url('/').'/'.$item->slug }}">
							<span itemprop="name">{{$item->name}}</span>
						</a>
						<meta itemprop="position" content="{{$key}}">
					</li>
				@endforeach
			</ul>
		</div>
		<span id="filtering-btn" onclick="showFS('filtering')"><img src="{{ asset('public/assets/images/items/filter.svg') }}" alt=""> فیلتر کردن</span>
		<span id="sorting-label" onclick="showFS('sorting')"><img src="{{ asset('public/assets/images/items/sort.svg') }}" alt=""> مرتب سازی</span>
		<div class="row" id="product-box">
			<div class="col-md-3">
				<form id="filtering" class="p-1em" action="{{url()->current()}}" method="get" accept-charset="utf-8" onsubmit="return filtering(this);">
					<span class="closeFS" onclick="closeFS('filtering')"><img src="{{ asset('public/assets/images/items/cross.svg') }}" alt="close"></span>
					<!-- <div>
						<span class="filder-label">محدوده قیمت:</span>
						<div dir="ltr" id="slider" min-price="12000" max-price="1700000" min-price-selected="12000" max-price-selected="1700000"></div>
						<div id="price-range" class="flex mr-y-1em">
							<div class="grow1 border" id="value-min"></div>
							<div class="grow1 border" id="value-max"></div>
							<input id="min-price" type="hidden" name="min-price">
							<input id="max-price" type="hidden" name="max-price">
						</div>
					</div> -->

					<div>
						<span class="filder-label">انتخاب برند:</span>
						<div class="filter">
							<select class="ui fluid multiple search selection dropdown" name="brand[]" multiple>
								<option value="">همه دسته ها</option>
								@foreach ($companies as $company)
									<option value="{{$company->id}}" {{!is_null(request()->get('brand')) && in_array($company->id, request()->get('brand')) ? 'selected=selected' : '' }}>{{$company->company}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div>
						<span class="filder-label">مناسب برای:</span>
						<div class="filter">
							<select class="ui fluid multiple search selection dropdown" name="tag[]" multiple>
								<option value="">همه گروه ها</option>
								@foreach ($filters as $filter)
									<option value="{{$filter->id}}" {{!is_null(request()->get('tag')) && in_array($filter->id, request()->get('tag')) ? 'selected=selected' : '' }}>{{$filter->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div>
						<span class="filder-label">امتیاز محصول:</span>
						<div class="filter">
							<select class="ui fluid search selection dropdown" name="score">
								<option value="">همه امتیاز ها</option>
								<option value="0" {{request()->get('score')==0 ? 'selected=selected' : '' }}>همه امتیاز ها</option>
								<option value="1" {{request()->get('score')==1 ? 'selected=selected' : '' }}>1 به بالا</option>
								<option value="2" {{request()->get('score')==2 ? 'selected=selected' : '' }}>2 به بالا</option>
								<option value="3" {{request()->get('score')==3 ? 'selected=selected' : '' }}>3 به بالا</option>
								<option value="4" {{request()->get('score')==4 ? 'selected=selected' : '' }}>4 به بالا</option>
							</select>
						</div>
					</div>

					@if (request()->get('sort'))
						<input type="hidden" name="sort" value="{{request()->get('sort')}}">
					@endif

					<button id="filter-submit" class="bt-blue" type="submit">اعمال</button>
				</form>
			</div>
			<div class="col-md-9">
				<div id="sorting">
					<span class="closeFS" onclick="closeFS('sorting')"><img src="{{ asset('public/assets/images/items/cross.svg') }}" alt="close"></span>
					<div>
						<span class="filder-label">مرتب سازی: </span>
						<div>
							<ul>
								<li class="radio-element">
									<a {{is_null(request()->get('sort')) || request()->get('sort')==1 ? 'class=checked-sort' : '' }} href="{{ request()->fullUrlWithQuery(['sort' => '1']) }}" title="پیشفرض">پیشفرض</a>
								</li>
								<li class="radio-element">
									<a  {{request()->get('sort')==2 ? 'class=checked-sort' : '' }} href="{{ request()->fullUrlWithQuery(['sort' => '2']) }}" title="ارزانترین">ارزانترین</a>
								</li>
								<li class="radio-element">
									<a {{request()->get('sort')==3 ? 'class=checked-sort' : '' }} href="{{ request()->fullUrlWithQuery(['sort' => '3']) }}" title="گرانترین">گرانترین</a>
								</li>
								<li class="radio-element">
									<a {{request()->get('sort')==4 ? 'class=checked-sort' : '' }} href="{{ request()->fullUrlWithQuery(['sort' => '4']) }}" title="پربازدید ترین">پربازدید ترین</a>
								</li>
								<li class="radio-element">
									<a {{request()->get('sort')==5 ? 'class=checked-sort' : '' }} href="{{ request()->fullUrlWithQuery(['sort' => '5']) }}" title="محبوب ترین">محبوب ترین</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div id="products-cat" class="flex no-js">
					@if (sizeof($products) == 0)
						<p class="warning p-1em h5">نتیجه ای یافت نشد!</p>
					@endif
					@foreach ($products as $product)
						<div class="product-list border relative">
							<a class="p-1em" href="{{ url($product->slug) }}" title="{{$product->fa_name}}">
								<img class="product-img lazy" data-src="{{ $product->img.'/medium/1.jpg' }}" src="{{ asset('public/assets/images/items/load.svg') }}" alt="{{$product->fa_name}}">
								<noscript>
									<img class="product-img" src="{{ $product->img.'/medium/1.jpg' }}" alt="{{$product->fa_name}}">
								</noscript>
								<hr>
								<div class="product-text">
									<div class="h5">{{$product->fa_name}}</div>
									<small class="mr-y-1em">{{$product->company}} - {{$product->company_en}}</small>
									<div class="mr-y-1em product-price">
										@if ($product->stock==0)
											<div class="warning-text bold">
												<span class="h5 bold">ناموجود</span>
											</div>
											<div class="warning-text">
												<span class="h5 bold">{{number_format($product->price)}}</span>تومان
											</div>
										@else
											@if ($product->off > 0)
												<div class="flex">
													<div class="through">{{number_format($product->price)}}</div>
													<div class="img-rounded border-green green percent">{{ceil($product->off/$product->price*100)}} %</div>
												</div>
											@endif
											<div class="green bold">
												<span class="h5 bold">{{number_format($product->price - $product->off)}}</span>تومان
											</div>
										@endif
									</div>
									<div>
										<div class="ratings">
											<div class="empty-stars"></div>
											<div class="full-stars" data-width="{{$product->score}}"></div>
										</div>
										<small> ({{number_format($product->visit)}} نفر)</small>
									</div>
								</div>
								<div class="product-icon">
									@if ($product->op > 1)
										@if ($product->type == 2)
											<div class="dosage-color">
												<img src="{{ asset('public/assets/images/items/dosage.svg') }}" alt="دز">
												+{{$product->op}}
											</div>
										@else
											<div class="kg-color">
												<img src="{{ asset('public/assets/images/items/kg.svg') }}" alt="وزن">
												+{{$product->op}}
											</div>
										@endif
									@endif
									@if (!is_null($product->taste) && $product->taste>1)
										<div class="taste-color">
											<img src="{{ asset('public/assets/images/items/taste.svg') }}" alt="طعم">
											+{{$product->taste}}
										</div>
									@endif
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</main>
@include('../layout/footer')