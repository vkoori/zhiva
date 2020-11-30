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
											<h1 class="card-title float-left h4">مدیریت منو</h1>
										</div>
										<div class="card-content px-1">
											<div class="row">
												<div class="col-md-12">

													<div class="dd" id="domenu-0">
														<button class="dd-new-item">+</button>
														<li class="dd-item-blueprint">
															<button class="collapse" data-action="collapse" type="button" style="display: none;">–</button>
															<button class="expand" data-action="expand" type="button" style="display: none;">+</button>
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content">
																<span class="item-name">[item_name]</span>
																<div class="dd-button-container">
																	<button class="item-add">+</button>
																	<button class="item-remove" data-confirm-class="item-remove-confirm">&times;</button>
																</div>
																<div class="dd-edit-box" style="display: none;">
																	<div class="dd-edit-box-2">
																		<div class="row">
																			<div class="col-md-3">
																				<input class="form-control" type="text" name="name" autocomplete="off" data-placeholder="یک عنوان وارد کنید..." data-default-value="منو جدید {?numeric.increment}">
																			</div>
																			<div class="col-md-3">
																				<input class="form-control" type="text" name="slug" autocomplete="off" data-placeholder="slug ..." data-default-value="">
																			</div>
																			<div class="col-md-3">
																				<select class="form-control" name="cat">
																					<option value="1">Drug Store</option>
																					<option value="2">Magazine</option>
																					<option value="3">Coaches</option>
																				</select>
																			</div>
																			<div class="col-md-3">
																				<select class="form-control" name="feature">
																					<option value="-">---</option>
																					<option value="1">Protein</option>
																					<option value="2">Performance</option>
																					<option value="3">Weight Management</option>
																				</select>
																			</div>
																		</div>
																	</div>
																	<input type="hidden" name="navid" value="">
																	<i class="end-edit">save</i>
																</div>
															</div>
														</li>
														<ol class="dd-list"></ol>
													</div>

												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<form action="{{ url('admin/menu-management') }}" method="post" accept-charset="utf-8">
														@csrf
														<textarea class="d-none" name="menu" id="my-main-menu">{{$menu}}</textarea>
														<button type="submit" class="btn text-white bg-blue my-1">ذخیره سازی</button>
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