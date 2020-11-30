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
										<h1 class="card-title float-left h4">لیست دیدگاه ها</h1>
									</div>
									<div class="card-content px-1">
										<table class="table table-striped bg-white">
											<thead class="bg-blue text-white">
												<tr>
													<th scope="col">#</th>
													<th scope="col">نام کامل</th>
													<th scope="col">دیدگاه</th>
													<th scope="col">محصول</th>
													<th scope="col">پاسخ</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($comments as $c)
													<tr onclick="window.location='{{ url('admin/drug-store/comments').'/'.$c->id }}';" {{ $c->approved == 0 ? 'class=font-weight-bold' : '' }}>
														<th scope="row">{{$c->id}}</th>
														<td>{{ is_null($c->name) ? 'نا شناس' : $c->name }}<br>{{ is_null($c->familiy) ? 'نا شناس' : $c->familiy }}</td>
														<td>{{ Str::limit($c->comment, 60) }}<br>{{dateTimeToJalali($c->insert_time)}}</td>
														<td>{{$c->fa_name}}</td>
														<td>{{$c->replay}}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
										<a href="{{ url('admin/drug-store/comments').'?page='.strval($page+1) }}" title="صفحه بعد" class="btn btn-secondary mb-1 float-right">صفحه بعد</a>
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