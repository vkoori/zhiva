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
							{{-- begin: add tag --}}
							<div class="row">
								<div class="col-12">
									<div class="card pull-up">
										<div class="card-header">
											<h1 class="card-title float-left h4">ثبت تگ برای مکمل ها</h1>
										</div>
										<div class="card-content px-1">
											<form action="{{ url('admin/drug-store/tags') }}" method="POST" class="needs-validation" novalidate>
												@csrf
												<div class="form-row mb-1">
													<div class="col-xs-2">
														<label>#</label>
														<input type="number" class="form-control" name="id" placeholder="#">
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
													<div class="col-xs-10">
														<label>نام تگ</label>
														<input type="text" class="form-control" name="name" placeholder="نام تگ"  pattern=".{1,}" required="required">
														<div class="valid-feedback">ورودی معتبر</div>
														<div class="invalid-feedback">ورودی نامعتبر</div>
													</div>
												</div>
												<div class="form-row mb-1">
													<div class="col-md-12">
														<button class="btn bg-blue text-white">ثبت یا بروزرسانی</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							{{-- end: add tag --}}
							<div class="row">
								<div class="col-12">
									<table class="table bg-white">
										<thead class="bg-blue text-white">
											<tr>
												<th scope="col">#</th>
												<th scope="col">نام</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($tags as $t)
												<tr>
													<th scope="row">{{$t->id}}</th>
													<td>{{$t->name}}</td>
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