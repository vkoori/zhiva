	<!-- BEGIN: Footer-->
	<footer class="footer footer-static footer-light navbar-border navbar-shadow">
		<div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
			<span class="float-md-left d-block d-md-inline-block">2020{{  date("Y") == "2020" ? "" : "-".date("Y") }}  © Copyright</span>
			<ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
				<li class="list-inline-item"><a class="my-1" href="{{ url('/') }}"> سامانه ژیوافیت	</a></li>
			</ul>
		</div>
	</footer>
	<!-- END: Footer-->

	@if (Request::is('admin/drug-store/add-product'))
		<style type="text/css">
			.tox-editor-header{
				direction: rtl!important;
			}
		</style>
		<script src="https://cdn.tiny.cloud/1/1bz35v7ionai4dxloj5u3uospgs921ldz1rm3bxnf0o9o2gd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>var uploadURL = '{{ url('api/upload/image/supplements/info') }}';</script>
		<script src="{{ asset('public/assets/admin/scripts/seo.js') }}" type="text/javascript"></script>
		<script src="{{ asset('public/assets/admin/scripts/drug-store/add-product.js') }}" type="text/javascript"></script>
	@elseif (Request::is('admin/menu-details/*'))
		<style type="text/css">
			.tox-editor-header{
				direction: rtl!important;
			}
		</style>
		<script src="https://cdn.tiny.cloud/1/1bz35v7ionai4dxloj5u3uospgs921ldz1rm3bxnf0o9o2gd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
			tinymce.init({
				selector: 'textarea#content-menu',
				directionality : "rtl",
				menubar: false,
				branding: false,
				plugins: "hr image link lists table code autoresize",
				toolbar: 'styleselect | fontsizeselect | image table | forecolor backcolor | link bold italic hr | numlist bullist outdent indent | removeformat | undo redo | code',
				relative_urls : false,
				remove_script_host : false,
				convert_urls : true,
				images_upload_url: '{{ url('api/upload/image/categories') }}'
			});
		</script>
	@elseif (Request::is('admin/drug-store/add-product/*'))
		<script src="{{ asset('public/assets/admin/scripts/drug-store/product_details.js') }}" type="text/javascript"></script>
	@endif

	<!-- BEGIN: Vendor JS-->
	<script src="{{ asset('public/assets/admin/scripts/vendors.min.js') }}" type="text/javascript"></script>
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script> --}}
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script> --}}
	<!-- BEGIN Vendor JS-->

	@if (Request::is('admin/media-library'))
		<script src="{{ asset('public/assets/admin/scripts/media.js') }}" type="text/javascript"></script>
	@elseif (Request::is('admin/menu-management'))
		<script type="text/javascript" src="{{ asset('public/assets/admin/scripts/jquery.domenu-0.100.77.js') }}"></script>
		<script>
			$(document).ready(function() {
				var menu = document.getElementById("my-main-menu").value;
				$('#domenu-0').domenu({
					data: menu
				})
				.parseJson()
				.on(['onItemCollapsed', 'onItemExpanded', 'onItemAdded', 'onSaveEditBoxInput', 'onItemDrop', 'onItemDrag', 'onItemRemoved', 'onItemEndEdit'], function(a, b, c) {
					var myMenu = $('#domenu-0').domenu().toJson();
					document.getElementById("my-main-menu").value = myMenu;
				});
			});
		</script>

	@endif

	<!-- BEGIN: Page Vendor JS-->
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script> --}}
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script> --}}
	<!-- END: Page Vendor JS-->

	<!-- BEGIN: Theme JS-->
	<script src="{{ asset('public/assets/admin/scripts/app-menu.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/assets/admin/scripts/app.min.js') }}" type="text/javascript"></script>
	{{-- <script src="{{ asset('public/assets/admin/scripts/customizer.min.js') }}" type="text/javascript"></script> --}}
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script> --}}
	<!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	{{-- <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/js/scripts/pages/dashboard-analytics.min.js" type="text/javascript"></script> --}}
	<!-- END: Page JS-->

	<!-- BEGIN: Form validation -->
	<script src="{{ asset('public/assets/admin/scripts/validation.js') }}" type="text/javascript"></script>
	<!-- END: Form validation -->

<!-- END: Body-->
</body>
</html>