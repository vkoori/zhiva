	<footer>
		
	</footer>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
	<script src="{{ asset('public/assets/scripts/libraries/jquery.min.js') }}"></script>
	<script src="{{ asset('public/assets/scripts/js.js') }}"></script>
	@if (Request::is('/'))
		{{-- <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script> --}}
		<script src="{{ asset('public/assets/scripts/libraries/flickity.pkgd.min.js') }}"></script>
	@elseif (Route::current()->getName() == "dr_category")
		{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.min.js"></script> <!-- price range --> --}}
		<script src="{{ asset('public/assets/scripts/supplements/category.js') }}"></script>
		<script src="{{ asset('public/assets/scripts/libraries/semantic.min.js') }}"></script>
	@elseif (Route::current()->getName() == "product")
		{{-- <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script> --}}
		<script src="{{ asset('public/assets/scripts/libraries/flickity.pkgd.min.js') }}"></script>
		<script src="{{ asset('public/assets/scripts/supplements/product.js') }}/"></script>
	@elseif (Request::is('finalize-order'))
		<script src="{{ asset('public/assets/scripts/libraries/flickity.pkgd.min.js') }}"></script>
		<script>
			$(".order-summary").flickity({
			    lazyLoad: 5,
			    rightToLeft: true,
			    // wrapAround: true,
			    pageDots: false,
			    cellAlign: "right",
			});
			// ajax
			function checkDiscount(t) {
				var url = t.getAttribute("action");
				var data = document.getElementById("discount-code").value;
				document.getElementById("discount-order").value = data;
				data = "discount-code="+data;
				
				var xmlhttp = new XMLHttpRequest();

				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == XMLHttpRequest.DONE) {	// XMLHttpRequest.DONE == 4
						if (xmlhttp.status == 200) {
							var res = xmlhttp.responseText;
							console.log(res);
						} else {
							console.log(xmlhttp.status);
						}
					}
				};

				xmlhttp.open("POST", url, true);
				xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
				xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				xmlhttp.setRequestHeader("X-CSRF-TOKEN", "{{csrf_token()}}");
				xmlhttp.send(data);

				return false;
			}
		</script>
	@endif
</body>
</html>