$(document).ready(function() {
	$('.ui.fluid.search.dropdown').dropdown();


	// var slider = document.getElementById('slider'),
	// 	minPrice = slider.getAttribute("min-price"),
	// 	maxPrice = slider.getAttribute("max-price"),
	// 	minPriceSelected = slider.getAttribute("min-price-selected"),
	// 	maxPriceSelected = slider.getAttribute("max-price-selected");
	// noUiSlider.create(slider, {
	// 	start: [minPriceSelected, maxPriceSelected],
	// 	connect: true,
	// 	direction: 'rtl',
	// 	step: 10,
	// 	range: {
	// 		'min': parseInt(minPrice),
	// 		'max': parseInt(maxPrice)
	// 	}
	// });

	// var valueMin = document.getElementById('value-min'),
	// 	valueMax = document.getElementById('value-max'),
	// 	inputMin = document.getElementById('min-price'),
	// 	inputMax = document.getElementById('max-price');
	// slider.noUiSlider.on('update', function (values, handle) {
	// 	if (handle) {
	// 		valueMax.innerHTML = numberWithCommas(values[handle]);
	// 		inputMax.value = parseInt(values[handle]);
	// 	} else {
	// 		valueMin.innerHTML = numberWithCommas(values[handle]);
	// 		inputMin.value = parseInt(values[handle]);
	// 	}
	// });

	$(function() {
        $('.radio-element a').click(function(e) {
            e.preventDefault();

            var t = $(this);
            if (t.hasClass('checked-sort'))
            	return;

            $('.checked-sort').removeClass('checked-sort');
            t.addClass('checked-sort');

            var href = t.attr("href");

			var url = new URL(href);
			var sort = url.searchParams.get("sort");

			if (sort != null) {
				url = new URL(window.location.href);
				url.searchParams.set("sort", sort);
				href = url.href;
			}

            filterOrSort(href, false);
        });

    });

});

function filterOrSort(href, pop){
    $.ajax({
        url: href,
        type: 'GET',
        // dataType: 'json',
        beforeSend: function() {
            loading();
        },
        success: function(res) {
            createProductList(res, href, pop);
            document.getElementById("box-load").remove();
        },
        error: function(xhr) { // if error occured
            alert("یک خطا پیش آمده است. لطفا مجدد تلاش کنید.");
            console.log(xhr);
            document.getElementById("box-load").remove();
        },
    });
}


// THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
window.onpopstate = function(event) {
    $("#loading").show();
    filterOrSort(window.location.href, true);
};

function createProductList(res, href, pop) {
	if (!pop) {
		// HISTORY.PUSHSTATE
		history.pushState(res["params"], document.title, href.split("?")[0]+"?"+serializeJS(res["params"]));
	} else {
		// Reload filter and sort in UI
		$('.ui.multiple.search.dropdown .delete.icon').click();

		var qs = res["params"];
		if (qs.hasOwnProperty("brand")) {
			$('select[name="brand[]"]').val(qs["brand"]);
			$('select[name="brand[]"]').change();
		}
		if (qs.hasOwnProperty("tag")) {
			$('select[name="tag[]"]').val(qs["tag"]);
			$('select[name="tag[]"]').change();
		}
		if (qs.hasOwnProperty("score"))
			$('select[name="score"]').val(qs["score"]);
		else
			$('select[name="score"]').val(0);
		$('select[name="score"]').change();

		$("#sorting .radio-element a").removeClass('checked-sort');
		if (qs.hasOwnProperty("sort")) {
			$("#sorting .radio-element").eq(qs["sort"]-1).find('a').addClass('checked-sort');
		} else {
			$("#sorting .radio-element").eq(0).find('a').addClass('checked-sort');
		}

	}

	var productsBox = document.getElementById("products-cat");

    if (res["products"].length == 0) {
    	var productsList = '<p class="warning p-1em h5">نتیجه ای یافت نشد!</p>';
    } else {
    	var productsList = '';
    	for (var i = 0; i < res["products"].length; i++) {
    		productsList += '<div class="product-list border relative">'+
								'<a class="p-1em" href="'+res["home"]+"/"+res["products"][i]["slug"]+'" title="'+res["products"][i]["fa_name"]+'">'+
									'<img class="product-img lazy" data-src="'+res["products"][i]["img"]+'/medium/1.jpg" src="http://localhost/zhivafit/public/assets/images/items/load.svg" alt="'+res["products"][i]["img"]["fa_name"]+'">'+
									'<noscript>'+
										'<img class="product-img" src="'+res["products"][i]["img"]+'/medium/1.jpg" alt="'+res["products"][i]["fa_name"]+'">'+
									'</noscript>'+
									'<hr>'+
									'<div class="product-text">'+
										'<div class="h5">'+res["products"][i]["fa_name"]+'</div>'+
										'<small class="mr-y-1em">'+res["products"][i]["company"]+' - '+res["products"][i]["company_en"]+'</small>'+
										'<div class="mr-y-1em product-price">';
											if (res["products"][i]["stock"].length == 0) {
												productsList += '<div class="green bold">'+
													'<span class="h5 bold">ناموجود</span>'+
												'</div>';
											} else {
												if (res["products"][i]["off"] > 0) {
													productsList += '<div class="flex">'+
														'<div class="through">'+numberWithCommas(res["products"][i]["price"])+'</div>'+
														'<div class="img-rounded border-green green percent">'+Math.ceil(res["products"][i]["off"]/res["products"][i]["price"]*100)+' %</div>'+
													'</div>';
												}
											}
											productsList += '<div class="green bold">'+
												'<span class="h5 bold">'+numberWithCommas(res["products"][i]["price"]-res["products"][i]["off"])+'</span>تومان'+
											'</div>'+
										'</div>'+
										'<div>'+
											'<div class="ratings">'+
												'<div class="empty-stars"></div>'+
												'<div class="full-stars" data-width="'+res["products"][i]["score"]+'"></div>'+
											'</div>'+
											'<small> ('+numberWithCommas(res["products"][i]["visit"])+' نفر)</small>'+
										'</div>'+
									'</div>'+
									'<div class="product-icon">';
										if (res["products"][i]["op"] > 1) {
											if (res["products"][i]["type"] == 2) {
												productsList += '<div class="dosage-color">'+
													'<img src="http://localhost/zhivafit/public/assets/images/items/dosage.svg" alt="دز">'+
													res["products"][i]["op"]+
												'</div>';
											} else {
												productsList += '<div class="kg-color">'+
													'<img src="http://localhost/zhivafit/public/assets/images/items/kg.svg" alt="وزن">'+
													res["products"][i]["op"]+
												'</div>';
											}
										}
										if (res["products"][i]["taste"] != null && res["products"][i]["taste"] > 1) {
											productsList += '<div class="taste-color">'+
												'<img src="http://localhost/zhivafit/public/assets/images/items/taste.svg" alt="طعم">'+
												res["products"][i]["taste"]+
											'</div>';
										}
									productsList += '</div>'+
								'</a>'+
							'</div>';
    	}
    }

    productsBox.innerHTML = productsList;
    yall();
    star();
}

serializeJS = function(obj, prefix) {
  var str = [],
    p;
  for (p in obj) {
    if (obj.hasOwnProperty(p)) {
      var k = prefix ? prefix + "[" + p + "]" : p,
        v = obj[p];
      str.push((v !== null && typeof v === "object") ?
        serializeJS(v, k) :
        encodeURIComponent(k) + "=" + encodeURIComponent(v));
    }
  }
  return str.join("&");
}

function filtering(t) {
	var url = new URL(window.location.href);
	var sort = url.searchParams.get("sort");
	var data = $(t).serialize();
	if (sort != null)
		data = "sort="+sort+"&"+data;

	$.ajax({
		url: t.getAttribute("action"),
		type: t.getAttribute("method"),
		data: data,
		// dataType: 'json',
		beforeSend: function() {
		    loading();
		},
		success: function(res) {
			createProductList(res, t.getAttribute("action"), false);
		    document.getElementById("box-load").remove();
		},
		error: function(xhr) { // if error occured
		    alert("یک خطا پیش آمده است. لطفا مجدد تلاش کنید.");
		    console.log(xhr);
		    document.getElementById("box-load").remove();
		},
	});
	return false;
}

function showFS(el) {
	var el = $("#"+el);
	var o = $('.openFS');
	if (el[0] == o[0]) {
		el.removeClass('openFS');
		el.fadeOut();
	} else {
		o.removeClass('openFS');
		o.fadeOut();
		el.addClass('openFS');
		el.fadeIn();
	}
}
function closeFS(el) {
	var o = $('.openFS');
	o.removeClass('openFS');
	$("#"+el).fadeOut();
}
function sorting(t) {
	var el = $("#filtering-btn");
	if (!el.is(":visible")) {
		console.log($("#sorting").serialize());
	}
	return;
}