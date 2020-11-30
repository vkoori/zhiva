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
													<div class="mb-1 menu-links">
														@foreach ($menu as $item)
															<a class="d-block rounded text-center text-white bg-blue mb-1" href="{{ url('admin/menu-details') }}/{{$item->id}}" title="{{$item->name}}">{{$item->name}}</a>
														@endforeach
													</div>
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