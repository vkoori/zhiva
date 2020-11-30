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
										<h1 class="card-title float-left h4">بررسی دیدگاه</h1>
									</div>
									<div class="card-content px-1">
										<p>این دیدگاه برای محصول <b>«{{$comment->fa_name}}»</b> نوشته شده است.</p>
										<form action="{{ url()->current() }}" method="post" accept-charset="utf-8">
											@csrf
											<textarea class="w-100" rows="10" name="comment">{{$comment->comment}}</textarea>
											<input type="submit" name="approved" class="btn btn-success mb-1" value="تایید عمومی">
											<input type="submit" name="approved" class="btn btn-info mb-1" value="تایید خصوصی">
											<input type="submit" name="approved" class="btn btn-danger mb-1" value="عدم تایید">
										</form>
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