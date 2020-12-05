@include('layout/header')
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
		@if(session()->has('success'))
			<div class="success p-1em h5">
				{{ session()->get('success') }}
			</div>
		@endif
		@if (sizeof($suggests)>0 AND hasGoogle())
			@include('drug_store/layout/suggest')
		@endif
		<div class="row" id="product-box">
			<div class="col-md-8">
				<div class="col-md-4">
					<div id="slide-show-product">
						<div id="gallery-product-box" class="relative">
							<div id="img-zoom-lens"></div>
							<img src="{{ asset($page->img.'/medium/1.jpg') }}" alt="">
						</div>
						<div class="thumbs-product">
							<div class="carousel-cell"><img data-flickity-lazyload="{{ asset($page->img.'/thumbnail/1.jpg') }}"></div>
							@foreach ($all_img as $img)
								<div class="carousel-cell"><img data-flickity-lazyload="{{ asset($page->img.'/thumbnail/'.$img) }}"></div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div id="myresult" class="img-zoom-result"></div>
					<div class="flex">
						<div class="grow1">
							<h1 class="h3">{{$page->fa_name}}</h1>
							<h2 class="h4 mr-b-1em">{{$page->en_name}}</h2>							
						</div>
						<div id="manufacture" class="text-left">
							<a class="brand" href="" title="">{{$page->company}} - {{$page->company_en}}</a>
							<div>ساخت {{$page->country}}</div>
						</div>
					</div>
					<p class="mr-b-2em mr-t-1em">{{$page->description}}</p>
					<div>
						<div class="ratings">
							<div class="empty-stars"></div>
							<div class="full-stars" data-width="{{round(($avgScore->s1+$avgScore->s2+$avgScore->s3)/3*20,2)}}"></div>
						</div>
						<small> ({{$avgScore->countScore}} نفر)</small>
					</div>
				</div>
			</div>
			<div class="col-md-4" id="detail-product">
				<form id="options-form" action="{{ url()->full() }}" method="get" accept-charset="utf-8">
					<div class="mr-b-1em relative">
						<div id="weight-name" class="label-product p-1em border" onclick="options(event, this,'select-weight')">{{$page->p_option}}</div>
						<ul class="options-dropdown border" id="select-weight">
							{!! $all_op !!}
						</ul>
						<input type="hidden" name="select-weight" value="{{$page->p_optionid}}">
					</div>
					<div class="mr-b-1em relative">
						<div id="taste-name" class="label-product p-1em border" onclick="options(event, this,'select-taste')">{{$page->p_taste}}</div>
						<ul class="options-dropdown border" id="select-taste">
							{!! $all_taste !!}
						</ul>
						<input type="hidden" name="select-taste" value="{{$page->p_tasteid}}">
					</div>
				</form>
				<div id="pricing-box">
					<div class="flex">
						<div class="grow1">قیمت برای مصرف کننده</div>
						@if ($page->off >0)
							<div class="through mr-x-1em">{{number_format($page->price)}}</div>
							<div class="img-rounded bg-green" id="percent">{{ceil($page->off/$page->price*100)}} %</div>
						@endif
					</div>
					<div class="text-left green">
						<span id="final-price">{{number_format($page->price-$page->off)}}</span>تومان
					</div>
				</div>
				<form class="mr-y-1em" action="{{ url('cart') }}" method="POST" accept-charset="utf-8">
					@csrf
					<input type="hidden" name="pid" value="{{$page->productid}}">
					<input type="hidden" name="select-taste" value="{{$page->p_tasteid}}">
					<input type="hidden" name="select-weight" value="{{$page->p_optionid}}">
					<div class="flex">
						<div id="add-to-cart" class="grow1">
							@if ($page->stock==0)
								<input type="hidden" name="action" value="sms">
								<button type="submit" class="warning p-1em">موجود شد، اطلاع بده</button>
							@else
								<input type="hidden" name="action" value="add-to-cart">
								<button type="submit" class="bt-blue p-1em">افزودن به سبد خرید</button>
							@endif
						</div>
						<div id="count" class="grow1 relative">
							<button class="border plus" type="button" onclick="chnageQTY('plus');"><span></span></button>
							<input class="border" type="text" name="qty" value="1" onkeyup="validinput(this);">
							<button class="border minus" type="button" onclick="chnageQTY('minus');"><span></span></button>
						</div>
					</div>
				</form>
				<div id="nutrition-box">
					@if (!is_null($page->n_title))
						<div class="mr-y-1em">
							<div id="nutrition-value">
								<div>
									<table style="width: 100%">
										<caption>
											<div id="option-nutrition" class="flex">
												<div class="grow1">{{$page->p_taste}}</div>
												<div>{{$page->p_option}}</div>
											</div>
											<div id="Serving-Size">به ازای: {{$page->serving_size}}</div>
										</caption>
										<thead>
											<tr>
												<th>هر سروینگ شامل</th>
												<th></th>
												<th>نیاز روزانه</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < sizeof($page->n_title); $i++)
												<tr>
													<td>{{$page->n_title[$i]}}</td>
													<td>{{$page->n_amount[$i]}}</td>
													<td>{{$page->n_dailyneed[$i]}}</td>
												</tr>
											@endfor
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
			<div class="col-md-8">
				<div id="properties" class="mr-y-2em">
					<div class="h4">مشخصات محصول:</div>
					@foreach ($page->fani as $key => $value)
						<div class="row flex">
							<div class="col-xs-5 col-md-4">
								<div class="key-properties border">
									{{$key}}
								</div>
							</div>
							<div class="col-xs-7 col-md-8">
								<div class="value-properties border">
									{{$value}}
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="mr-y-2em">
					@foreach ($page->property->key as $i => $key)
						@if ($i == 0)
							<div class="tabs active" onclick="tab(this);" tab="{{$i}}">{{$key}}</div>
						@else
							<div class="tabs" onclick="tab(this);" tab="{{$i}}">{{$key}}</div>
						@endif
					@endforeach
					@foreach ($page->property->value as $i => $value)
						<div class="content-tabs text-justify p-1em" id="tab{{$i}}">
							{!!$value!!}
						</div>
					@endforeach
				</div>
				@if (sizeof($suggests)>0 AND !hasGoogle())
					@include('drug_store/layout/suggest')
				@endif
				<div class="mr-y-2em">
					<div class="h4">امتیاز این محصول:</div>
					<div class="row flex">
						<div class="col-sm-7 col-md-8 avg-score">
							<div class="border p-1em">
								<div class="h5">
									{{$avgScore->countScore}} نفر به این محصول امتیاز داده اند:
								</div>
								<div id="score-bar">
									<span>اثر بخشی:</span>
									<div class="relative">
										<span class="border img-rounded mr-y-1em"></span>
										<div class="bar" data-score="{{round($avgScore->s1,2)}}"></div>
									</div>
									<span>بسته بندی:</span>
									<div class="relative">
										<span class="border img-rounded mr-y-1em"></span>
										<div class="bar" data-score="{{round($avgScore->s2,2)}}"></div>
									</div>
									<span>ارزش نسبت به قیمت:</span>
									<div class="relative">
										<span class="border img-rounded mr-y-1em"></span>
										<div class="bar" data-score="{{round($avgScore->s3,2)}}"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-5 col-md-4">
							<div class="value-properties border relative set-score">
								<div class="h5">
									امتیاز شما به این محصول:
								</div>
								@if (!Session::has('userid'))
									<div class="flex mr-y-1em">
										<div class="grow1">اثر بخشی:</div>
										<div>☆☆☆☆☆</div>
									</div>
									<div class="flex mr-y-1em">
										<div class="grow1">بسته بندی:</div>
										<div>☆☆☆☆☆</div>
									</div>
									<div class="flex mr-y-1em">
										<div class="grow1">ارزش نسبت به قیمت:</div>
										<div>☆☆☆☆☆</div>
									</div>
									<a class="submit-score bt-blue p-1em text-center" href="{{ url('ورود').'?back='.url()->full() }}" title="ورود یا ثبت نام">وارد شوید</a>
								@else
									<form action="{{ url('drug-store/set-score') }}" method="post" accept-charset="utf-8" onsubmit="return setScore(this);">
										<input type="hidden" name="pid" id="pid" value="{{$page->productid}}">
										<div class="flex mr-y-1em">
											<div class="grow1">اثر بخشی:</div>
											<div class="rating-score">
												@for ($i = 5; $i > 0; $i--)
													@if (sizeof($score) > 0 && $score[0]->score1 == $i)
														<input id="asar{{$i}}" name="score1" type="radio" value="{{$i}}" checked="checked" class="radio-btn hide" />
													@else
														<input id="asar{{$i}}" name="score1" type="radio" value="{{$i}}" class="radio-btn hide" />
													@endif
													<label for="asar{{$i}}" >☆</label>
												@endfor
												<div class="clear"></div>
											</div>
										</div>
										<div class="flex mr-y-1em">
											<div class="grow1">بسته بندی:</div>
											<div class="rating-score">
												@for ($i = 5; $i > 0; $i--)
													@if (sizeof($score) > 0 && $score[0]->score2 == $i)
														<input id="baste{{$i}}" name="score2" type="radio" value="{{$i}}" checked="checked" class="radio-btn hide" />
													@else
														<input id="baste{{$i}}" name="score2" type="radio" value="{{$i}}" class="radio-btn hide" />
													@endif
													<label for="baste{{$i}}" >☆</label>
												@endfor
												<div class="clear"></div>
											</div>
										</div>
										<div class="flex mr-y-1em">
											<div class="grow1">ارزش نسبت به قیمت:</div>
											<div class="rating-score">
												@for ($i = 5; $i > 0; $i--)
													@if (sizeof($score) > 0 && $score[0]->score3 == $i)
														<input id="arzesh{{$i}}" name="score3" type="radio" value="{{$i}}" checked="checked" class="radio-btn hide" />
													@else
														<input id="arzesh{{$i}}" name="score3" type="radio" value="{{$i}}" class="radio-btn hide" />
													@endif
													<label for="arzesh{{$i}}" >☆</label>
												@endfor
												<div class="clear"></div>
											</div>
										</div>
										<button class="submit-score bt-blue p-1em text-center" type="submit">ثبت امتیاز</button>
									</form>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="mr-y-2em">
					<div class="h4">
						دیدگاه کاربران: <small>(80 نفر دیدگاه خود را ثبت کرده اند)</small>
					</div>
					@if (!Session::has('userid'))
						<div class="warning p-1em h5">
							جهت ثبت دیدگاه خود، <a href="{{ url('ورود').'?back='.url()->full() }}" title="ورود یا ثبت نام">وارد</a> حساب کاربریتان شوید.
						</div>
					@else
						<form id="comment-form" action="{{ url('drug-store/set-comment') }}" method="POST" accept-charset="utf-8" onsubmit="return setComment(this);">
							<hr>
							<label for="comment-text" class="mr-y-1em block">پرسش ها و نظرات خود را با ما در میان بگذارید:</label>
							<textarea id="comment-text" name="comment" class="border p-1em" rows="5" placeholder="اینجا بنویسید ..."></textarea>
							<div class="text-left">
								<button type="submit" class="bt-blue p-1em submit-comment">ثبت دیدگاه</button>
							</div>
							<!-- <hr> -->
						</form>
					@endif
					<div class="mr-t-1em" id="comments-list-box">
						{!! build_menu($comments) !!}
						@if ($cm_remained > 0)
							<a id="load-more-comment" href="{{ url()->current().'?'.http_build_query(['comment' => $cm_page+1]) }}" title="">نمایش بیشتر</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</main>
@include('layout/footer')