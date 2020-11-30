function addTaste(sel, opNum) {
	var select = document.getElementById(sel);
	if (select.value == "")
		return alert('یک طعم را انتخاب کنید.');
	var taste = select.options[select.selectedIndex].text;
	var tasteid = select.value;
	var tasteBox = document.getElementById("op"+opNum);
	var tasteCount = tasteBox.getElementsByClassName("mb-1 border border-light rounded p-1").length+1;
	var tatseTag = '<div class="mb-1 border border-light rounded p-1">'+
						'<div class="row">'+
							'<div class="col-md-3">'+
								'<label>'+taste+'</label><input type="hidden" name="taste'+opNum+'-'+tasteCount+'" value="'+tasteid+'">'+
								'<div>'+
									'<input type="radio" name="default" value="'+opNum+'-'+tasteid+'" required="required">'+
									'<label>انتخاب به عنوان پیشفرض</label>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<label>موجودی</label>'+
								'<input type="number" class="form-control" name="stock'+opNum+'-'+tasteCount+'" placeholder="موجودی" required="required">'+
								'<div class="valid-feedback">ورودی معتبر</div>'+
								'<div class="invalid-feedback">ورودی نامعتبر</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<label>تخفیف</label>'+
								'<input type="number" class="form-control" name="off'+opNum+'-'+tasteCount+'" placeholder="تخفیف به تومان" required="required">'+
								'<div class="valid-feedback">ورودی معتبر</div>'+
								'<div class="invalid-feedback">ورودی نامعتبر</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<label>تصاویر محصول</label>'+
								'<div class="custom-file mb-0">'+
									'<input type="file" multiple="multiple" class="custom-file-input" id="img'+opNum+'-'+tasteCount+'" name="img'+opNum+'-'+tasteCount+'[]" required="required">'+
									'<label class="custom-file-label" for="img'+opNum+'-'+tasteCount+'">عکس ها ...</label>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="h4 col mt-1">جدول ارزش غذایی</div>'+
						'</div>'+
						'<div class="nutrition">'+
							'<div class="row">'+
								'<div class="col-md-4">'+
									'<span class="bold">عنوان</span>'+
								'</div>'+
								'<div class="col-md-4">'+
									'<span class="bold">مقدار</span>'+
								'</div>'+
								'<div class="col-md-4">'+
									'<span class="bold">نیاز روزانه</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col">'+
								'<button type="button" class="btn btn-light mt-1 w-100" onclick="addNutrition(this,'+opNum+','+tasteCount+');">ردیف جدید</button>'+
							'</div>'+
						'</div>'+
					'</div>';

	var row = document.createElement('div');
	row.innerHTML = tatseTag;
	tasteBox.appendChild(row);
}

function addNutrition(t, opNum, tasteNum) {
	var nutrition = t.parentElement.parentElement.parentElement.getElementsByClassName("nutrition")[0];
	var nutritionTag = '<div class="col-md-4">'+
							'<input type="text" class="form-control" name="title'+opNum+'-'+tasteNum+'[]" placeholder="شامل" required="required">'+
						'</div>'+
						'<div class="col-md-4">'+
							'<input type="text" class="form-control" name="amount'+opNum+'-'+tasteNum+'[]" placeholder="مقدار" required="required">'+
						'</div>'+
						'<div class="col-md-4">'+
							'<input type="text" class="form-control" name="dailyneed'+opNum+'-'+tasteNum+'[]" placeholder="نیاز روزانه" required="required">'+
						'</div>';
	var row = document.createElement('div');
	row.setAttribute('class', 'row my-1');
	row.innerHTML = nutritionTag;
	nutrition.appendChild(row);
}

function addOp(t) {
	var opNum = parseInt(t.getAttribute('op-count')) + 1;
	t.setAttribute('op-count', opNum);
	var tasteOp = '';
	for (var i = 0; i < allTastes.length; i++) {
		tasteOp += '<option value="'+allTastes[i]['id']+'">'+allTastes[i]['taste']+'</option>';
	}
	var opTag = '<hr class="border-danger">'+
				'<div class="form-row mb-1">'+
					'<div class="col-md-4">'+
						'<label>عنوان آپشن</label>'+
						'<select class="custom-select" name="op_type'+opNum+'" required="required">'+
							'<option value="1">وزن</option>'+
							'<option value="2">دز</option>'+
							'<option value="3">تعداد</option>'+
						'</select>'+
						'<div class="valid-feedback">ورودی معتبر</div>'+
						'<div class="invalid-feedback">ورودی نامعتبر</div>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<label>مقدار آپشن</label>'+
						'<input type="text" class="form-control" name="op_value'+opNum+'" placeholder="2.270 کیلوگرم، 140 میلی گرم، 60 عدد" required="required" pattern=".{1,}">'+
						'<div class="valid-feedback">ورودی معتبر</div>'+
						'<div class="invalid-feedback">ورودی نامعتبر</div>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<label>قیمت محصول</label>'+
						'<input type="number" class="form-control" name="price'+opNum+'" placeholder="قیمت به تومان" required="required" pattern=".{1,}">'+
						'<div class="valid-feedback">ورودی معتبر</div>'+
						'<div class="invalid-feedback">ورودی نامعتبر</div>'+
					'</div>'+
				'</div>'+
				'<div class="form-row mb-1 align-items-end">'+
					'<div class="col-xs-10">'+
						'<label>انتخاب طعم:</label>'+
						'<select class="custom-select" id="select'+opNum+'" required="required">'+
							'<option disabled="disabled" selected="selected" value="">انتخاب کنید ...</option>'+
							tasteOp+
						'</select>'+
						'<div class="valid-feedback">ورودی معتبر</div>'+
						'<div class="invalid-feedback">ورودی نامعتبر</div>'+
					'</div>'+
					'<div class="col-xs-2">'+
						'<button type="button" class="btn bg-blue text-white w-100" onclick="addTaste(\'select'+opNum+'\', '+opNum+');">افزودن طعم</button>'+
					'</div>'+
				'</div>'+
				'<div id="op'+opNum+'"></div>';

	var row = document.createElement('div');
	row.innerHTML = opTag;
	var el = t.parentElement;

	el.parentNode.insertBefore(row, el);

}