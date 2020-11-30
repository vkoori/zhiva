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

				<!-- start container -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
							{{-- begin: product name --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h1 class="card-title float-left h4">انتخاب منو</h1>
										</div>
										<div class="card-content px-1">
											<div class="row">
												<div class="col-md-12">
													<form action="{{ url('admin/menu-details/'.$id) }}" method="post" accept-charset="utf-8" class="needs-validation" novalidate>
														@csrf
														<div class="form-row mb-1">
															<div class="col-md-6">
																<label>متا تایتل</label>
																<input type="text" class="form-control" name="title" placeholder="عنوان گوگل"  pattern=".{1,}" required="required" value="{{$menu[0]->title}}">
																<div class="valid-feedback">ورودی معتبر</div>
																<div class="invalid-feedback">ورودی نامعتبر</div>
															</div>
															<div class="col-md-6">
																<label>کلمات کلیدی</label>
																<input type="text" class="form-control" name="keywords" placeholder="کلمات کلیدی"  pattern=".{1,}" required="required" value="{{$menu[0]->keywords}}">
																<div class="valid-feedback">ورودی معتبر</div>
																<div class="invalid-feedback">ورودی نامعتبر</div>
															</div>
														</div>
														<div class="form-row mb-1">
															<div class="col-md-12">
																<label>متا دسکریپشن</label>
																<textarea rows="6" style="resize:none" class="form-control" name="description" id="description" placeholder="توضیحات گوگل" required="required">{{$menu[0]->description}}</textarea>
																<div class="valid-feedback">ورودی معتبر</div>
																<div class="invalid-feedback">ورودی نامعتبر</div>
															</div>
														</div>
														<div class="form-row mb-1">
															<div class="col-md-12">
																<label>متن داخل صفحه</label>
																<textarea id="content-menu" rows="6" style="resize:none" class="form-control" name="content-menu" placeholder="متن داخل صفحه" required="required">{{$menu[0]->content}}</textarea>
																<div class="valid-feedback">ورودی معتبر</div>
																<div class="invalid-feedback">ورودی نامعتبر</div>
															</div>
														</div>
														<div class="form-row mb-1">
															<div class="col-md-12">
																<button class="btn bg-blue text-white">ثبت</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							{{-- end: product name --}}
					</div>
				</div>
				<!--/ end container -->
			</div>
		</div>
	</div>
	<!-- END: Content-->
@include('admin.layouts.footer')