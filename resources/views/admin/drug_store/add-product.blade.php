@include('admin.layouts.header')
@include('admin.layouts.sidebar')

	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-wrapper-before"></div>
			<div class="content-header row"></div>
			<div class="content-body">
				@if($errors->any())
					<ul class="alert alert-danger px-3">
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				@if(session()->has('success'))
					<div class="alert alert-success px-3">
						{{ session()->get('success') }}
					</div>
				@endif

				<!-- add product -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="row">
							<div class="col-12">
								<h1 class="card-title float-left h2">ثبت محصول جدید</h1>
							</div>
						</div>
						<form action="{{ url('admin/drug-store/add-product') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
							@csrf
							{{-- begin: product name --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">نام محصول و میزان مصرف</h2>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												<div class="col-md-4">
													<label>فارسی</label>
													<input type="text" class="form-control" name="fa_name" id="fa_name" placeholder="نام محصول"  pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-4">
													<label>انگلیسی</label>
													<input type="text" class="form-control" name="en_name" placeholder="product name"  pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-4">
													<label>serving size</label>
													<input type="text" class="form-control" name="serving_size" placeholder="1 اسکوپ، 4 قرص، ...." pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: product name --}}
							{{-- begin: meta data --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">متا دیتا</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												<div class="col-md-6">
													<label>متا تایتل</label>
													<input type="text" class="form-control" name="title" id="title" placeholder="عنوان گوگل" required="required" pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-6">
													<label>سطح آخر آدرس محصول (اگر خالی بماند از نام فارسی محصول استفاده خواهد شد)</label>
													<input type="text" class="form-control" name="slug" placeholder="آدرس" pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<div class="form-row mb-1">
												<div class="col-md-12">
													<label>متا دسکریپشن</label>
													<textarea rows="4" style="resize:none" class="form-control" name="description" id="description" placeholder="توضیحات گوگل" required="required"></textarea>
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<div class="form-row mb-1">
												<div class="col-md-12">
													<label>کلمات کلیدی</label>
													<input type="text" class="form-control" name="keywords" placeholder="کلمات کلیدی" pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<div class="form-row mb-1">
												<div class="col-md-12">
													<label>کنونیکال (در صورت وجود لینک کامل وارد شود)</label>
													<input type="text" class="form-control" name="canonical" placeholder="canonical url" pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<div class="form-row mb-1">
												<div class="col-md-12">
													<label>ریدایرکت (در صورت وجود لینک کامل وارد شود)</label>
													<input type="text" class="form-control" name="redirect" placeholder="redirection ..." pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: meta data --}}
							{{-- begin: product manufacture --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">کارخانه سازنده</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												<div class="col-md-12">
													<label>کارخانه یا برند مورد نظر را انتخاب کنید:</label>
													<select class="custom-select" name="manufacture">
														@foreach ($manufacturers as $m)
															<option value="{{$m->id}}">{{$m->company}} ({{$m->country}})</option>
														@endforeach
													</select>
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: product manufacture --}}
							{{-- begin: product properties --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">مشخصه های محصول</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb">
												<div class="col-md-12">
													<h2 class="card-title float-left h5">مشخصات فنی</h4>
												</div>
												<div class="col-md-6">
													<label>عنوان</label>
													<input type="text" class="form-control" name="title-general[]" placeholder="عنوان" pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-6">
													<label>مقدار</label>
													<input type="text" class="form-control" name="value-general[]" placeholder="مقدار" pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-12">
													<button type="button" class="btn btn-light w-100 mt-1" onclick="newRow(this)">افزودن سطر</button>
												</div>
											</div>
											<hr>
											<div class="form-row mb">
												<div class="col-md-12">
													<h2 class="card-title float-left h5">تب توضیحات</h4>
												</div>
												<div class="col-md-12">
													<label>عنوان تب</label>
													<input type="text" class="form-control" name="title-properties[]" placeholder="عنوان تب توضیحات" pattern=".{1,}" required="required">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-12 cke_rtl mt-1">
													<label>توضیحات</label>
													<textarea id="tab1" rows="10" style="resize:none" class="form-control" name="value-properties[]" placeholder="توضیحات این تب" required="required"></textarea>
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<hr>
											<button type="button" class="btn btn-secondary mb-1 float-right"  onclick="newTAB(this);">افزودن تب جدید</button>
										</div>
									</div>
								</div>
							</div>
							{{-- end: product properties --}}
							{{-- begin: tags --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">انتخاب فیلتر</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												@foreach ($tags as $k => $t)
													<div class="col-md-3">
														<label class="form-check-label" for="tag{{$k}}">{{$t->name}}</label>
														<input class="form-check-input" type="checkbox" name="tags[]" value="{{$t->id}}" id="tag{{$k}}">
													</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: tags --}}
							{{-- begin: choose menu --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">انتخاب منو</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												@foreach ($menu as $k => $m)
													<div class="col-md-3">
														<label class="form-check-label" for="menu{{$k}}">{{$m->name}}</label>
														<input class="form-check-input" type="checkbox" name="cats[]" value="{{$m->id}}" data-txt="{{$m->name}}" id="menu{{$k}}" onclick="defaultCat(this);">
													</div>
												@endforeach
											</div>
											<div class="form-row mb-1">
												<select class="custom-select" name="default-cat" id="default-cat" required="required"></select>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: choose menu --}}
							<button type="submit" class="btn text-white bg-blue my-1">مرحله بعد</button>
						</form>
					</div>
				</div>
				<!--/ add product -->
				<!--/ seo -->
				<div class="row mt-4">
					<div class="col-lg-12 col-md-12">
						<div class="row">
							<div class="col-12">
								<div class="card pull-up">
									<div class="card-header">
										<h2 class="card-title float-left h4">بررسی متن</h2>
									</div>
									<div class="card-content px-1">
										<div class="form-row mb-1">
											<div class="col-md-6">
												<label>کلمه کلیدی</label>
												<input class="form-control" type="text" id="keyphrase">
											</div>
											<div class="col-md-6">
												<label>مترادف های کلمه کلیدی (کاما = جدا کننده)</label>
												<input class="form-control" type="text" id="synonyms">
											</div>
										</div>
										<div class="form-row mb-1">
											<div class="col-md-12">
												<button class="btn btn-secondary my-1" onclick="checkSEO();">بررسی</button>
											</div>
										</div>
										<div class="form-row mb-1">
											<div class="col-md-12" id="seo-log"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ seo -->
			</div>
		</div>
	</div>
	<!-- END: Content-->
@include('admin.layouts.footer')