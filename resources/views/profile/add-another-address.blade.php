@include('layout/header')

		<main class="container">
			<div class="row">
				<div class="col-md-3" id="cart-list">
					@include('profile/layout/menu')
				</div>
				<div class="col-md-9" id="cart-list">
					<h1 class="h3">ثبت آدرس جدید</h1>
					@include('profile/layout/add-address')
				</div>
			</div>
		</main>

@include('layout/footer')