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
							{{-- begin: taste --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h1 class="card-title float-left h4">ایجاد طعم جدید</h1>
										</div>
										<div class="card-content px-1">
											<form action="{{ url('admin/drug-store/taste') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
												@csrf
												<div class="form-row mb-1">
													<div class="col-md-6">
														<label>طعم</label>
														<input type="text" class="form-control" name="name" placeholder="نام" pattern=".{1,}" required="required">
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-md-6">
														<label>آیکون</label>
														<div class="custom-file">
															<input type="file" class="custom-file-input" id="customFile" name="icon" required="required">
															<label class="custom-file-label" for="customFile">انتخاب ...</label>
														</div>
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-md-12">
														<button type="submit" class="btn text-white bg-blue mt-1">ثبت</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							{{-- end: taste --}}
							<div class="row">
								<div class="col-12">
									<table class="table bg-white">
										<thead class="bg-blue text-white">
											<tr>
												<th scope="col">طعم</th>
												<th scope="col">آیکون</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($tastes as $t)
												<tr>
													<th scope="row">{{$t->taste}}</th>
													<td><img src="{{$t->icon}}" alt="{{$t->taste}}"></td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
					</div>
				</div>
				<!--/ end container -->
			</div>
		</div>
	</div>
	<!-- END: Content-->
@include('admin.layouts.footer')