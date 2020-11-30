String.prototype.replaceAll = function(search, replacement) {
	var target = this;
	return target.replace(new RegExp(search, 'g'), replacement);
};

String.prototype.toPersianCharacter =  function () {
	var string = this;
	var obj = {
		'ك' :'ک',
		'دِ': 'د',
		'بِ': 'ب',
		'زِ': 'ز',
		'ذِ': 'ذ',
		'شِ': 'ش',
		'سِ': 'س',
		'ى' :'ی',
		'ي' :'ی',
		'١' :'۱',
		'٢' :'۲',
		'٣' :'۳',
		'٤' :'۴',
		'٥' :'۵',
		'٦' :'۶',
		'٧' :'۷',
		'٨' :'۸',
		'٩' :'۹',
		'٠' :'۰',
	};

	Object.keys(obj).forEach(function(key) {
		string = string.replaceAll(key, obj[key]);
	});
	return string
};

class SEO {
	constructor() {
		this._h1 			= '',
		this._title 		= '',
		this._description 	= '',
		this._firstP 		= '',
		this._lastP 		= '',
		this._content 		= '',
		this._aTags 		= '',
		this._imgTags		= '',
		this._subHeading	= '',
		this._keyphrase 	= '',
		this._synonyms 		= [];
	}
	set h1(h1) {
		this._h1 = h1;
	}
	set title(title) {
		this._title = title;
	}
	set description(description) {
		this._description = description;
	}
	set html(html) {
		var wrapper = document.createElement('div');
		wrapper.innerHTML = html;
		this._imgTags = wrapper.getElementsByTagName("img");
		this._aTags = wrapper.getElementsByTagName("a");
		this._firstP = wrapper.getElementsByTagName("p")[0].innerText;
		this._lastP = wrapper.getElementsByTagName("p")[wrapper.getElementsByTagName("p").length-1].innerText;
		this._content = wrapper.innerText;
		this._subHeading = wrapper.querySelectorAll("h1, h2, h3, h4, h5, h6");
	}
	set keyphrase(keyphrase) {
		this._keyphrase = keyphrase;
	}
	set synonyms(synonyms) {
		var synonyms = synonyms.split(',');
		this._synonyms = synonyms;
	}
	density(wordArr, text) {
		var extra = [' می ',' به ',' ام ',' ای ',' ایم ',' اند ',' اید ', '،', '؛', '‌', '\n', '\r'];
		
		text = text.toPersianCharacter();
		text = text.toLowerCase();
		for (var i = 0; i < wordArr.length; i++) {
			wordArr[i] = wordArr[i].toPersianCharacter();
			wordArr[i] = wordArr[i].toLowerCase();
		}

		for (var j = 0; j < extra.length; j++) {
			text = text.replaceAll(extra[j], " ");
			for (var i = 0; i < wordArr.length; i++) {
				wordArr[i] = wordArr[i].replaceAll(extra[j], " ");
			}
		}

		text = text.replace(/  +/g, ' ');
		var keyphraseArr = [];
		for (var i = 0; i < wordArr.length; i++) {
			wordArr[i] = wordArr[i].replace(/  +/g, ' ');
			var keyphrase = wordArr[i].replace(/ /g, '-');
			keyphraseArr.push(keyphrase);
			text = text.replaceAll(wordArr[i], keyphrase);
		}

		var word_list = text.split(" "); // Split the text into words.

		var counts = {}; // Allocate a dictionary

		for (var i = 0; i < word_list.length; ++i) {
			var word = word_list[i];
			counts[word] = (counts[word] || 0) + 1; // Increment count by one.
		}

		var densities = {};

		for (var i = 0; i < keyphraseArr.length; i++) {
			var keyphrase = keyphraseArr[i];
			densities[keyphrase] = parseFloat(((counts[keyphrase] || 0) / word_list.length) * 100).toFixed(2); // Calculates all the densities percentage.
		}
		
		return densities;
	}
	check() {
		var result = {}
		result.error = [];
		result.warning = [];
		result.success = [];
		if (this._h1.indexOf(this._keyphrase) >= 0)
			result.success.push("کلید واژه کانونی در h1 وجود دارد.");
		else
			result.error.push("کلید واژه کانونی در h1 یافت نشد.");

		if (this._title.indexOf(this._keyphrase) >= 0)
			result.success.push("کلید واژه کانونی در title وجود دارد.");
		else
			result.error.push("کلید واژه کانونی در title یافت نشد.");

		if (this._description.indexOf(this._keyphrase) >= 0)
			result.success.push("کلید واژه کانونی در description وجود دارد.");
		else
			result.error.push("کلید واژه کانونی در description یافت نشد.");

		if (! new RegExp(this._synonyms.join("|")).test(this._description))
			result.warning.push("شما میتوانید از مترادف ها کلید واژه نیز در description استفاده کنید.");

		if (this._firstP.indexOf(this._keyphrase) == -1)
			result.warning.push("در پراگراف اول از کلید واژه کانونی استفاده نشده است.");

		if (this._lastP.indexOf(this._keyphrase) == -1)
			result.warning.push("در پراگراف آخر از کلید واژه کانونی استفاده نشده است.");

		var density1 = this.density([this._keyphrase], this._content);
		Object.keys(density1).forEach(d => {
			if (density1[d] > 3.5 || density1[d] < 1) {
				result.error.push("چگالی کلید واژه کانونی "+density1[d]+" درصد است.");
			} else if (density1[d] >= 3.0 || density1[d] <= 3.5) {
				result.warning.push("چگالی کلید واژه کانونی "+density1[d]+" درصد است.");
			} else {
				result.success.push("چگالی کلید واژه کانونی "+density1[d]+" درصد است.");
			}
		});

		var density2 = this.density(this._synonyms, this._content);
		Object.keys(density2).forEach(d => {
			if (density2[d] > 3.5 || density2[d] < 1) {
				result.error.push("چگالی واژه '"+d+"' "+density2[d]+" درصد است.");
			} else if (density2[d] >= 3.0 || density2[d] <= 3.5) {
				result.warning.push("چگالی واژه '"+d+"' "+density2[d]+" درصد است.");
			} else {
				result.success.push("چگالی واژه '"+d+"' "+density2[d]+" درصد است.");
			}
		});

		if (this._aTags.length == 0) {
			result.error.push("مطلب شما هیچ لینکی ندارد.");
		} else {
			var domain = new RegExp(location.host);
			var internal = 0;
			var external = 0;
			for (var i = 0; i < this._aTags.length; i++) {
				var href = this._aTags[i].getAttribute("href");
				if (domain.test(href))
					internal ++;
				else
					external ++;
			}
			if (external == 0)
				result.warning.push("شما از هیچ لینک خارجی ای استفاده نکرده اید.");
			else
				result.success.push("شما از "+external+" لینک خارجی استفاده کرده اید.");
			if (internal >= 3 && internal <=7)
				result.success.push("شما از "+internal+" لینک داخلی استفاده کرده اید.");
			else
				result.warning.push("شما از "+internal+" لینک داخلی استفاده کرده اید.");
		}

		if (this._imgTags.length == 0) {
			result.error.push("مطلب شما هیچ تصویری ندارد.");
		} else {
			var alt_num = 0;
			for (var i = 0; i < this._imgTags.length; i++) {
				var alt = this._aTags[i].getAttribute("alt");
				if (alt == null || alt == '')
					alt_num ++;
			}
			result.error.push("در "+alt_num+" عدد از تصاویر شما alt یافت نشد.");
		}

		if (this._subHeading.length == 0) {
			result.error.push("شما هیچ زیر عنوانی ندارید.");
		} else {
			// var subHeading = 0;
			// for (var i = 0; i < subHeading.length; i++) {				
			// 	if (subHeading[i].innerText.indexOf(this._keyphrase) >= 0)
			// 		subHeading ++;
			// }
			// if (subHeading > 2 && subHeading/subHeading.length > 0.5)
			// 	// error
		}

		return result;
	}
}