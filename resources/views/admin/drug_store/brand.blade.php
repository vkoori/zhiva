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
											<h1 class="card-title float-left h4">ثبت برند</h1>
										</div>
										<div class="card-content px-1">
											<form action="{{ url('admin/drug-store/brands') }}" method="POST" class="needs-validation" novalidate>
												@csrf
												<div class="form-row mb-1">
													<div class="col-md-3">
														<label>نام شرکت (فارسی)</label>
														<input type="text" class="form-control" name="company" placeholder="نام شرکت"  pattern=".{1,}" required="required">
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-md-3">
														<label>نام شرکت (لاتین)</label>
														<input type="text" class="form-control" name="company-en" placeholder="company"  pattern="^[a-zA-Z0-9 ]*$" required="required">
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-md-3">
														<label>کشور سازنده</label>
														<select class="custom-select" name="country">
															@foreach ($countries as $country)
																<option value="{{$country->id}}">{{$country->country}}</option>
															@endforeach
														</select>
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-md-3">
														<label>سایت</label>
														<input type="url" class="form-control" name="website" placeholder="آدرس سایت" pattern="(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})" required="required">
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
							{{-- end: product name --}}
							<div class="row">
								<div class="col-12">
									<table class="table bg-white">
										<thead class="bg-blue text-white">
											<tr>
												<th scope="col">#</th>
												<th scope="col">نام شرکت</th>
												<th scope="col">کشور سازنده</th>
												<th scope="col">سایت</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($manufacturers as $m)
												<tr>
													<th scope="row">{{$m->id}}</th>
													<td>{{$m->company}}</td>
													<td>{{$m->country}}</td>
													<td>{{$m->website}}</td>
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