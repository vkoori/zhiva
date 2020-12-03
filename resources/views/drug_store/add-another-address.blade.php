@include('../layout/header')
		<main class="container">
			<h1 class="h3">ثبت آدرس جدید</h1>
			<div class="row">
				<div class="col-md-8" id="cart-list">
					@include('../profile/add-address')
				</div>
				<div class="col-md-4">
					<div class="border p-1em">
						@include('drug_store/layout/cart-summary')
						<hr>
						<div>
							<a class="bt-blue p-1em block w-100 text-center" href="{{ url('address') }}" title="لیست آدرس ها">بازگشت به صفحه لیست آدرس ها</a>
						</div>
					</div>
				</div>
			</div>
		</main>

@include('../layout/footer')