tinymce.init({
	selector: 'textarea#tab1',
	directionality : "rtl",
	menubar: false,
	branding: false,
	plugins: "hr image link lists table code autoresize",
	toolbar: 'styleselect | fontsizeselect | image table | forecolor backcolor | link bold italic hr | numlist bullist outdent indent | removeformat | undo redo | code',
	relative_urls : false,
	remove_script_host : false,
	convert_urls : true,
	images_upload_url: uploadURL
});


function checkSEO() {
	var seo = new SEO();
	seo.h1 = document.getElementById("fa_name").value;
	seo.title = document.getElementById("title").value;
	seo.description = document.getElementById("description").value;
	seo.html = tinymce.get("tab1").getContent({format: 'html'});
	seo.keyphrase = document.getElementById("keyphrase").value;
	seo.synonyms = document.getElementById("synonyms").value;
	var result = seo.check();
	
	var seoLog = document.getElementById("seo-log");
	seoLog.innerHTML = '';

	if (result["error"].length > 0) {
		var errors = document.createElement("ul");
		errors.setAttribute("class", "alert alert-danger px-4");
		for (var i = 0; i < result["error"].length; i++) {
			var li = document.createElement("li");
			var text = document.createTextNode(result["error"][i]);
			li.appendChild(text);
			errors.appendChild(li);
		}
		seoLog.appendChild(errors);
	}

	if (result["warning"].length > 0) {
		var warning = document.createElement("ul");
		warning.setAttribute("class", "alert alert-warning px-4");
		for (var i = 0; i < result["warning"].length; i++) {
			var li = document.createElement("li");
			var text = document.createTextNode(result["warning"][i]);
			li.appendChild(text);
			warning.appendChild(li);
		}
		seoLog.appendChild(warning);
	}

	if (result["success"].length > 0) {
		var success = document.createElement("ul");
		success.setAttribute("class", "alert alert-success px-4");
		for (var i = 0; i < result["success"].length; i++) {
			var li = document.createElement("li");
			var text = document.createTextNode(result["success"][i]);
			li.appendChild(text);
			success.appendChild(li);
		}
		seoLog.appendChild(success);
	}
}

function newTAB(t) {
	var row = document.createElement('div');
	row.setAttribute("class", "form-row mb-1");
	
	var titlerow = document.createElement('div');
	titlerow.setAttribute("class", "col-md-12");
	row.appendChild(titlerow);

	var label1 = document.createElement('label');
	var text1 = document.createTextNode('عنوان تب');
	label1.appendChild(text1);
	titlerow.appendChild(label1);

	var input = document.createElement('input');
	input.setAttribute("type", "text");
	input.setAttribute("class", "form-control");
	input.setAttribute("name", "title-properties[]");
	input.setAttribute("placeholder", "عنوان تب جدید");
	input.setAttribute("pattern", ".{1,}");
	input.setAttribute("required", "required");
	titlerow.appendChild(input);

	var valid1 = document.createElement('div');
	valid1.setAttribute("class", "valid-feedback");
	var textValid1 = document.createTextNode('ورودی معتبر');
	valid1.appendChild(textValid1);
	titlerow.appendChild(valid1);

	var invalid1 = document.createElement('div');
	invalid1.setAttribute("class", "invalid-feedback");
	var textInvalid1 = document.createTextNode('ورودی نامعتبر');
	invalid1.appendChild(textInvalid1);
	titlerow.appendChild(invalid1);
	
	var contentrow = document.createElement('div');
	contentrow.setAttribute("class", "col-md-12 cke_rtl mt-1");
	row.appendChild(contentrow);

	var label2 = document.createElement('label');
	var text2 = document.createTextNode('توضیحات');
	label2.appendChild(text2);
	contentrow.appendChild(label2);

	var id = (new Date()).getTime().toString(36);
	var textarea = document.createElement('textarea');
	textarea.setAttribute("id", id);
	textarea.setAttribute("row", "10");
	textarea.setAttribute("style", "resize:none");
	textarea.setAttribute("class", "form-control");
	textarea.setAttribute("name", "value-properties[]");
	textarea.setAttribute("placeholder", "توضیحات این تب");
	textarea.setAttribute("required", "required");
	contentrow.appendChild(textarea);

	var valid2 = document.createElement('div');
	valid2.setAttribute("class", "valid-feedback");
	var textValid2 = document.createTextNode('ورودی معتبر');
	valid2.appendChild(textValid2);
	contentrow.appendChild(valid2);

	var invalid2 = document.createElement('div');
	invalid2.setAttribute("class", "invalid-feedback");
	var textInvalid2 = document.createTextNode('ورودی نامعتبر');
	invalid2.appendChild(textInvalid2);
	contentrow.appendChild(invalid2);

	t.parentElement.insertBefore(row, t);

	var hr = document.createElement('hr');
	t.parentElement.insertBefore(hr, t);

	tinymce.init({
		selector: 'textarea#'+id,
		directionality : "rtl",
		menubar: false,
		branding: false,
		plugins: "hr image link lists table code autoresize",
		toolbar: 'styleselect | fontsizeselect | image table | forecolor backcolor | link bold italic hr | numlist bullist outdent indent | removeformat | undo redo | code',
		relative_urls : false,
		remove_script_host : false,
		convert_urls : true,
		images_upload_url: uploadURL
	});
}

function newRow(t) {
	var col1 = document.createElement('div');
	col1.setAttribute("class", "col-md-6");

	var label1 = document.createElement('label');
	var text1 = document.createTextNode('عنوان');
	label1.appendChild(text1);
	col1.appendChild(label1);

	var input1 = document.createElement('input');
	input1.setAttribute("type", "text");
	input1.setAttribute("class", "form-control");
	input1.setAttribute("name", "title-general[]");
	input1.setAttribute("placeholder", "عنوان");
	input1.setAttribute("pattern", ".{1,}");
	input1.setAttribute("required", "required");
	col1.appendChild(input1);

	var valid1 = document.createElement('div');
	valid1.setAttribute("class", "valid-feedback");
	var textValid1 = document.createTextNode('ورودی معتبر');
	valid1.appendChild(textValid1);
	col1.appendChild(valid1);

	var invalid1 = document.createElement('div');
	invalid1.setAttribute("class", "invalid-feedback");
	var textInvalid1 = document.createTextNode('ورودی نامعتبر');
	invalid1.appendChild(textInvalid1);
	col1.appendChild(invalid1);

	var col2 = document.createElement('div');
	col2.setAttribute("class", "col-md-6");

	var label2 = document.createElement('label');
	var text2 = document.createTextNode('عنوان');
	label2.appendChild(text2);
	col2.appendChild(label2);

	var input2 = document.createElement('input');
	input2.setAttribute("type", "text");
	input2.setAttribute("class", "form-control");
	input2.setAttribute("name", "value-general[]");
	input2.setAttribute("placeholder", "عنوان");
	input2.setAttribute("pattern", ".{1,}");
	input2.setAttribute("required", "required");
	col2.appendChild(input2);

	var valid2 = document.createElement('div');
	valid2.setAttribute("class", "valid-feedback");
	var textValid2 = document.createTextNode('ورودی معتبر');
	valid2.appendChild(textValid2);
	col2.appendChild(valid2);

	var invalid2 = document.createElement('div');
	invalid2.setAttribute("class", "invalid-feedback");
	var textInvalid2 = document.createTextNode('ورودی نامعتبر');
	invalid2.appendChild(textInvalid2);
	col2.appendChild(invalid2);

	t = t.parentElement;
	t.parentElement.insertBefore(col1, t);
	t.parentElement.insertBefore(col2, t);
	
}

function defaultCat(t) {
	var value = t.value;
	var txt = t.getAttribute('data-txt');
	if (t.checked) {
		var option = document.getElementById("default-cat").innerHTML;
		option += '<option value="'+value+'">'+txt+'</option>';
		document.getElementById("default-cat").innerHTML = option;
	} else {
		var option = document.getElementById("default-cat").getElementsByTagName("option");
		for (var i = 0; i < option.length; i++) {
			if (option[i].value == value)
				option[i].remove();
		}
	}
}