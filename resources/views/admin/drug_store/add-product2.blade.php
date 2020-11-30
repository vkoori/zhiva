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


				{{-- <ul id="progressbar" class="row">
					<li class="active col">step1</li>
					<li class="active col">step2</li>
					<li class="col">step3</li>
				</ul>
				<div class="alert alert-warning px-3">
					در این مراحل شما مجاز به رفرش صفحه نیستید.
				</div> --}}
				
				<!-- add product -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="row">
							<div class="col-12">
								<h1 class="card-title float-left h2">ثبت جزئیات محصول</h1>
							</div>
						</div>
						<form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
							@csrf
							{{-- begin: options --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h2 class="card-title float-left h4">آپشن ها</h4>
										</div>
										<div class="card-content px-1">
											<div class="form-row mb-1">
												<div class="col-md-4">
													<label>عنوان آپشن</label>
													<select class="custom-select" name="op_type1" required="required">
														<option value="1">وزن</option>
														<option value="2">دز</option>
														<option value="3">تعداد</option>
													</select>
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-4">
													<label>مقدار آپشن</label>
													<input type="text" class="form-control" name="op_value1" placeholder="2.270 کیلوگرم، 140 میلی گرم، 60 عدد" required="required" pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-md-4">
													<label>قیمت محصول</label>
													<input type="number" class="form-control" name="price1" placeholder="قیمت به تومان" required="required" pattern=".{1,}">
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
											</div>
											<div class="form-row mb-1 align-items-end">
												<div class="col-xs-10">
													<label>انتخاب طعم:</label>
													<select class="custom-select" id="select1" required="required">
														<option disabled="disabled" selected="selected" value="">انتخاب کنید ...</option>
														@foreach ($tastes as $taste)
															<option value="{{$taste->id}}">{{$taste->taste}}</option>
														@endforeach
													</select>
													<div class="valid-feedback">ورودی معتبر</div>
													<div class="invalid-feedback">ورودی نامعتبر</div>
												</div>
												<div class="col-xs-2">
													<button type="button" class="btn bg-blue text-white w-100" onclick="addTaste('select1', 1);">افزودن طعم</button>
												</div>
											</div>
											<div id="op1"></div>
											<div class="form-row mb-1">
												<button type="button" class="btn btn-secondary" id="add-new-op" op-count="1" onclick="addOp(this);">افزودن آپشن</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: options --}}
							<input type="submit" class="btn text-white bg-blue my-1" name="submit" value="انتشار">
							<input type="submit" class="btn text-white bg-blue my-1" name="submit" value="پیشنویس">
						</form>
					</div>
				</div>
				<!--/ add product -->
			</div>
		</div>
	</div>
	<!-- END: Content-->
	<script>var allTastes = {!!json_encode($tastes)!!};</script>
@include('admin.layouts.footer')