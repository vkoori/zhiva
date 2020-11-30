<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<style>
	input{outline: none;}
	.valid-feedback {
		font-size: 80%;
		display: none;
		width: 100%;
		margin-top: .25rem;
		color: #5ed84f;
	}
	.invalid-feedback {
		font-size: 80%;
		display: none;
		width: 100%;
		margin-top: .25rem;
		color: #fa626b;
	}
	.was-validated .form-control:invalid {
		padding-left: 2.75rem;
		border-color: #fa626b;
		background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23fa626b\' viewBox=\'-2 -2 7 7\'%3e%3cpath stroke=\'%23fa626b\' d=\'M0 0l3 3m0-3L0 3\'/%3e%3ccircle r=\'.5\'/%3e%3ccircle cx=\'3\' r=\'.5\'/%3e%3ccircle cy=\'3\' r=\'.5\'/%3e%3ccircle cx=\'3\' cy=\'3\' r=\'.5\'/%3e%3c/svg%3E');
		background-repeat: no-repeat;
		background-position: center left -webkit-calc(.3125em + .375rem);
		background-position: center left -moz-calc(.3125em + .375rem);
		background-position: center left calc(.3125em + .375rem);
		-webkit-background-size: -webkit-calc(.625em + .75rem) -webkit-calc(.625em + .75rem);
		background-size: -moz-calc(.625em + .75rem) -moz-calc(.625em + .75rem);
		background-size: calc(.625em + .75rem) calc(.625em + .75rem);
	}
	.form-control.is-valid, .was-validated .form-control:valid {
		padding-left: 2.75rem;
		border-color: #5ed84f;
		background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 8 8\'%3e%3cpath fill=\'%235ed84f\' d=\'M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z\'/%3e%3c/svg%3e');
		background-repeat: no-repeat;
		background-position: center left -webkit-calc(.3125em + .375rem);
		background-position: center left -moz-calc(.3125em + .375rem);
		background-position: center left calc(.3125em + .375rem);
		-webkit-background-size: -webkit-calc(.625em + .75rem) -webkit-calc(.625em + .75rem);
		background-size: -moz-calc(.625em + .75rem) -moz-calc(.625em + .75rem);
		background-size: calc(.625em + .75rem) calc(.625em + .75rem);
	}
	.was-validated .form-control:valid~.valid-feedback,
	.was-validated .form-control:invalid~.invalid-feedback {
		display: block;
	}
	#mapid { height: 360px; }
</style>
<form class="needs-validation row p-1em border" action="{{ $form_url }}" method="POST" accept-charset="utf-8" novalidate>
	@csrf
	<div class="row">
		<div class="col-md-6 mr-b-1em">
			<label for="province">استان *</label>
			<select class="form-control" id="province" name="province" required="required" onchange="getCities('{{ url('api/get-cities') }}', this.value);">
				<option value="">یک استان را انتخاب کنید...</option>
				@foreach ($provinces as $province)
					<option value="{{$province->id}}">{{$province->province}}</option>
				@endforeach
			</select>
			<div class="valid-feedback">ورودی معتبر</div>
			<div class="invalid-feedback">ورودی نامعتبر</div>
		</div>
		<div class="col-md-6 mr-b-1em">
			<label for="city">شهر / شهرستان *</label>
			<select class="form-control" id="city" name="city" required="required">
			</select>
			<div class="valid-feedback">ورودی معتبر</div>
			<div class="invalid-feedback">ورودی نامعتبر</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mr-b-1em">
			<label for="address">آدرس *</label>
			<input type="text" class="form-control" id="address" name="address" placeholder="آدرس" pattern=".{1,}" required="required">
			<div class="valid-feedback">ورودی معتبر</div>
			<div class="invalid-feedback">ورودی نامعتبر</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mr-b-1em">
			<div id="mapid"></div>
			<input class="form-control" type="hidden" name="lat" id="lat" value="35.71640">
			<input class="form-control" type="hidden" name="lng" id="lng" value="51.49403">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 mr-b-1em">
			<label for="postal-code">کد پستی</label>
			<input type="number" class="form-control" id="postal-code" name="postal-code" placeholder="کد پستی" pattern=".{1,}">
			<div class="valid-feedback">ورودی معتبر</div>
			<div class="invalid-feedback">ورودی نامعتبر</div>
		</div>
	</div>

	@if (sizeof($customer) == 0)
		<div class="row">
			<div class="col-md-6 mr-b-1em">
				<label for="first-name">نام *</label>
				<input type="text" class="form-control" id="first-name" name="first-name" placeholder="نام" pattern=".{1,}" required="required">
				<div class="valid-feedback">ورودی معتبر</div>
				<div class="invalid-feedback">ورودی نامعتبر</div>
			</div>
			<div class="col-md-6 mr-b-1em">
				<label for="last-name">نام خانوادگی *</label>
				<input type="text" class="form-control" id="last-name" name="last-name" placeholder="نام خانوادگی" pattern=".{1,}" required="required">
				<div class="valid-feedback">ورودی معتبر</div>
				<div class="invalid-feedback">ورودی نامعتبر</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mr-b-1em">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
				<div class="valid-feedback">ورودی معتبر</div>
				<div class="invalid-feedback">ورودی نامعتبر</div>
			</div>
			<div class="col-md-6 mr-b-1em">
				<label for="phone">شماره ثابت</label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="شماره ثابت" pattern=".{1,}">
				<div class="valid-feedback">ورودی معتبر</div>
				<div class="invalid-feedback">ورودی نامعتبر</div>
			</div>
		</div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<input class="bt-blue p-1em" type="submit" value="ثبت آدرس">
		</div>
	</div>
</form>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<script>
	// map
	var mymap = L.map('mapid').setView([35.71640, 51.49403], 13);
	var marker = L.marker([35.71640, 51.49403]).addTo(mymap);
	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia29vcmkiLCJhIjoiY2toeW9nb21vMXFpaDJ5cDV5eXprYXl1aCJ9.0Itpugluf4nnSuk38qOKsQ', {
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
	}).addTo(mymap);

	mymap.on('click', onMapClick);

	function onMapClick(e) {
		var newLatLng = new L.LatLng(e.latlng.lat, e.latlng.lng);
		marker.setLatLng(newLatLng); 

		document.getElementById("lat").value = e.latlng.lat;
		document.getElementById("lng").value = e.latlng.lng;
	}

	// ajax
	function getCities(url, val) {
		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == XMLHttpRequest.DONE) {	// XMLHttpRequest.DONE == 4
				if (xmlhttp.status == 200) {
					var res = xmlhttp.responseText;
					res = JSON.parse(res);
					var op = '';
					for (var i = 0; i < res.length; i++) {
						op += '<option value="'+res[i]["id"]+'">'+res[i]["city"]+'</option>';
					}
					document.getElementById("city").innerHTML = op;
				} else {
					console.log(xmlhttp.status);
				}
			}
		};

		xmlhttp.open("GET", url+"/"+val, true);
		xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xmlhttp.send();
	}

	// JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>