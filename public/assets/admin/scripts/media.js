function mediaDetail(url){
	if (document.getElementById("mediaDetail"))
		document.getElementById("mediaDetail").remove();

	var div = document.createElement("div");
	div.setAttribute("class","float-right col-md-3 border p-1 mb-1");
	div.setAttribute("id","mediaDetail");
	
	var img = document.createElement("img");
	img.setAttribute("src",url);
	img.setAttribute("class","block");
	
	var input = document.createElement("input");
	input.setAttribute("disabled","disabled");
	input.setAttribute("type","text");
	input.setAttribute("value",url);
	input.setAttribute("class","mt-1");
	input.setAttribute("id","link-copy");

	var btn = document.createElement("button");
	btn.setAttribute("id","btn-copy");
	btn.setAttribute("onclick","copyLink();");

	div.appendChild(img);
	div.appendChild(input);
	div.appendChild(btn);
	var files = document.getElementById("file-col")
	files.insertBefore(div, files.getElementsByTagName("span")[0]);

}

function copyLink() {
	var copyText = document.getElementById("link-copy");
	copyText.removeAttribute("disabled");

	/* Select the text field */
	copyText.focus();
	copyText.select();
	copyText.setSelectionRange(0, 99999); /*For mobile devices*/

	/* Copy the text inside the text field */
	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful';
		console.log('Copying text command was ' + msg);
	} catch (err) {
		console.log('Oops, unable to copy');
	}
	copyText.setAttribute("disabled","disabled");
}