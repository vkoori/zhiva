$thumbs = $('.thumbs-product').flickity({
    lazyLoad: 1,
    rightToLeft: true,
    wrapAround: true,
    pageDots: false,
});

$thumbs.on( 'change.flickity', function( event, index ) {
    var src = $('.thumbs-product img').eq(index).attr('src');
    src = src.replace('/thumbnail/','/medium/');
    var img = document.getElementById("gallery-product-box");
    img = img.getElementsByTagName("img")[0];
    img.setAttribute('src', src);
});

function options(e,t,d) {
    var dropdown = document.getElementById(d);
    var openDropdown = document.getElementsByClassName("open2");
    if (openDropdown.length && t.className != "label-product p-1em border open") {
        var lable = openDropdown[0].parentElement.getElementsByClassName("label-product p-1em border");
        lable[0].className = lable[0].className.replace(" open", "");
        openDropdown[0].style.display = "none";
        openDropdown[0].className = openDropdown[0].className.replace(" open2", "");
    }
    if (t.className == "label-product p-1em border") {
        t.className += " open";
        dropdown.className += " open2";
        dropdown.style.display = "block";
    } else {
        t.className = t.className.replace(" open", "");
        dropdown.style.display = "none";
        var openDropdown = t.parentElement.getElementsByClassName("options-dropdown open2");
        openDropdown[0].className = openDropdown[0].className.replace(" open2", "");
    }
    e.stopPropagation();
    clickListener(t, dropdown);
}

function clickListener (t, dropdown) {
    document.onclick = function(event) {
        var clickPosition = event.path[0];
        if (dropdown.contains(clickPosition) && clickPosition.tagName == "LI") {
            setOption(clickPosition);
        }
        t.className = t.className.replace(" open", "");
        dropdown.className = dropdown.className.replace(" open2", "");
        dropdown.style.display = "none";
    }
    return;
}

function setOption (selected){
    var option = selected.getAttribute("val");
    var gParent = selected.parentElement.parentElement;
    gParent.getElementsByTagName("input")[0].setAttribute("value", option);
    var name = gParent.getElementsByTagName("input")[0].getAttribute("name");
    document.getElementsByName(name)[1].setAttribute("value", option);
    gParent.getElementsByClassName("label-product p-1em border")[0].innerText = selected.innerText;
    var form = document.getElementById("options-form");
    var href = form.getAttribute("action");
    var op = $(form).serializeArray();
    
    var url = new URL(href);
    for (var i = 0; i < op.length; i++) {
        url.searchParams.set(op[i]['name'], op[i]['value']);
    }
    getPrice(url["href"], false);

    return 0;
}   

// THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
window.onpopstate = function(event) {
    getPrice(window.location.href, true);
};

function getPrice(href, pop){
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        // cache: false,
        headers: {
            "options":"true",
        },
        beforeSend: function() {
            loading();
        },
        success: function(res) {
            // Change Taste
            if (document.getElementById("taste-name")) {
                document.getElementById("select-taste").innerHTML = res[0]["tastes-list"];
                document.getElementById("taste-name").innerText = res[0]["taste"]["name"];
                document.getElementsByName("select-taste")[0].setAttribute("value", res[0]["taste"]["id"]);
                document.getElementsByName("select-taste")[1].setAttribute("value", res[0]["taste"]["id"]);
            }

            // Change Price
            var priceBox = document.querySelectorAll("#pricing-box > div");
            priceBox[0].innerHTML = '<div class="grow1">قیمت برای مصرف کننده</div>';
            if (res[0]["off"] > 0) {
                priceBox[0].innerHTML += '<div class="through mr-x-1em">'+numberWithCommas(res[0]["price"])+'</div>'+
                                         '<div class="img-rounded bg-green" id="percent">'+Math.ceil(res[0]["off"]/res[0]["price"]*100)+' %</div>';
            }
            priceBox[1].innerHTML = '<span id="final-price">'+numberWithCommas(res[0]["price"]-res[0]["off"])+'</span>تومان';

            // Check Stock and Create Submit Button
            if (res[0]["stock"] == 0) {
                var btnClass = 'warning p-1em';
                var value = 'sms';
                var btnText = 'موجود شد، اطلاع بده';
            } else {
                var btnClass = 'bt-blue p-1em';
                var value = 'add-to-cart';
                var btnText = 'افزودن به سبد خرید';
            }
             document.getElementById("add-to-cart").getElementsByTagName("input")[0].value = value; 
            document.getElementById("add-to-cart").getElementsByTagName("button")[0].className = btnClass;
            document.getElementById("add-to-cart").getElementsByTagName("button")[0].innerText = btnText;

            // Change product's images
            document.getElementById("gallery-product-box").getElementsByTagName("img")[0].setAttribute("src", res[0]["img"]+"/medium/1.jpg");
            $thumbs.flickity('destroy');
            document.getElementsByClassName("thumbs-product")[0].innerHTML = '<div class="carousel-cell"><img data-flickity-lazyload="'+res[0]["img"]+'/thumbnail/1.jpg"></div>';
            for (var k in res[0]["other-img"]) {
                document.getElementsByClassName("thumbs-product")[0].innerHTML += '<div class="carousel-cell"><img data-flickity-lazyload="'+res[0]["img"]+'/thumbnail/'+res[0]["other-img"][k]+'"></div>';
            };
            $thumbs = $('.thumbs-product').flickity({
                lazyLoad: 1,
                rightToLeft: true,
                wrapAround: true,
                pageDots: false,
            });

            // Nutrition Value
            document.getElementById("nutrition-box").innerHTML = res[0]["nutrition"];

            if (!pop) {
                // HISTORY.PUSHSTATE
                var op = res[0]["query-string"];
                var url = new URL(href);
                for(var key in op ) {
                    if (key != '_')
                        url.searchParams.set(key, op[key]);
                }
                delete op["_"];
                history.pushState(op, document.title, url);
            } else {
                // Change Option
                if (document.getElementById("weight-name")) {
                    document.getElementById("weight-name").innerText = res[0]["op"]["name"];
                    document.getElementsByName("select-weight")[0].setAttribute("value", res[0]["op"]["id"]);
                    document.getElementsByName("select-weight")[1].setAttribute("value", res[0]["op"]["id"]);
                }
            }
            
            // Remove Loading
            document.getElementById("box-load").remove();
        },
        error: function(xhr) { // if error occured
            alert("یک خطا پیش آمده است. لطفا مجدد تلاش کنید.");
            console.log(xhr);
            document.getElementById("box-load").remove();
        },
    });
}

function tab(t) {
    if (t.className == "tabs active")
        return;
    var oldTab = document.getElementsByClassName("tabs active")[0];
    oldTab.className = oldTab.className.replace(" active", "");
    var oldId = "tab" + oldTab.getAttribute("tab");
    document.getElementById(oldId).style.display = "none";
    t.className += " active";
    var newId = "tab" + t.getAttribute("tab");
    document.getElementById(newId).style.display = "block";
}

// suggestion

$(".suggest-product").flickity({
    lazyLoad: 5,
    rightToLeft: true,
    // wrapAround: true,
    pageDots: false,
    cellAlign: "right",
});

// $(".suggest-article").flickity({
//     lazyLoad: 5,
//     rightToLeft: true,
//     wrapAround: true,
//     pageDots: false,
//     cellAlign: "right",
// });

$(document).ready(function() {
    window.mobileAndTabletcheck = function() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };

    function magnifire(e, box, result, lens) {
        var img, lens, result, cx, cy;
        img = document.getElementById(box);
        img = img.getElementsByTagName("img")[0];
        result = document.getElementById(result);
        lens = document.getElementById(lens);
        /* Calculate the ratio between result DIV and lens: */
        cx = result.offsetWidth / lens.offsetWidth;
        cy = result.offsetHeight / lens.offsetHeight;
        // get large image
        src = img.src;
        src = src.replace('/medium/','/large/');
        /* Set background properties for the result DIV */
        result.style.backgroundImage = "url('" + src + "')";
        result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";

            var pos, x, y;
            /* Prevent any other actions that may occur when moving over the image */
            e.preventDefault();
            /* Get the cursor's x and y positions: */
            pos = getCursorPos(e);
            /* Calculate the position of the lens: */
            x = pos.x - (lens.offsetWidth / 2);
            y = pos.y - (lens.offsetHeight / 2);
            /* Prevent the lens from being positioned outside the image: */
            if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
            if (x < 0) {x = 0;}
            if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
            if (y < 0) {y = 0;}
            /* Set the position of the lens: */
            lens.style.left = x + "px";
            lens.style.top = y + "px";
            /* Display what the lens "sees": */
            result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";

        function getCursorPos(e) {
            var a, x = 0, y = 0;
            e = e || window.event;
            /* Get the x and y positions of the image: */
            a = img.getBoundingClientRect();
            /* Calculate the cursor's x and y coordinates, relative to the image: */
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            /* Consider any page scrolling: */
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {x : x, y : y};
        }
    }

    function zoomshow(result, lens) {
        var lens = document.getElementById(lens);
        var zoom = document.getElementById(result);
        zoom.style.display = "block";
        lens.style.display = "block";
        zoom.style.zIndex = "1";
        zoom.style.height = (zoom.clientWidth/1) + "px";
        zoom.className += " fadeshow";
    }
    function zoomhide(result, lens) {
        var lens = document.getElementById(lens);
        var zoom = document.getElementById(result);
        zoom.style.display = "none";
        lens.style.display = "none";
        zoom.style.zIndex = "-1";
        zoom.className = zoom.className.replace(" fadeshow", "");
    }

    function gallery(box, result, lens) {
        if (!mobileAndTabletcheck()) {
            var p_img = document.getElementById(box);
            p_img.onmousemove = function(e){magnifire(e, box, result, lens)};
            p_img.ontouchmove = function(e){magnifire(e, box, result, lens)};

            p_img.onmouseover = function(){zoomshow(result, lens)};
            p_img.ontouchstart = function(){zoomshow(result, lens)};

            p_img.onmouseout = function(){zoomhide(result, lens)};
            p_img.ontouchend = function(){zoomhide(result, lens)};
        }
    }

    gallery("gallery-product-box", "myresult", "img-zoom-lens");

    // score bar of product
    function Utils() {

    }

    Utils.prototype = {
        constructor: Utils,
        isElementInView: function (element, fullyInView) {
            var pageTop = $(window).scrollTop();
            var pageBottom = pageTop + $(window).height();
            var elementTop = $(element).offset().top;
            var elementBottom = elementTop + $(element).height();

            if (fullyInView === true) {
                return ((pageTop < elementTop) && (pageBottom > elementBottom));
            } else {
                return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
            }
        }
    };

    var Utils = new Utils();
    
    var in_view = Utils.isElementInView($('#score-bar'), true);
    $(window).scroll(function() {
        var in_view = Utils.isElementInView($('#score-bar'), true);
        if (in_view) {
            var bars = $('.bar');
            for (var i = 0; i < bars.length; i++) {
                var score = bars.eq(i).attr('data-score') * 20;
                var red = Math.min(255*(100-score)/100+25,190);
                var green = Math.min(255*score/100,190);
                var blue = 25;
                var color = "rgb("+red+" "+green+" "+blue+")";
                bars.eq(i).css({
                    'background': color,
                    'width': score+'%'
                });
            }

            $(window).off("scroll");
        }
    });

    var lastScrollTop = lastScrollTop2 = window.pageYOffset || document.documentElement.scrollTop;
    var direction = "";

    window.addEventListener("scroll", function(){
        var st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > lastScrollTop){
            // downscroll code
            if (direction != "down") {
                direction = "down";
                lastScrollTop2 = window.pageYOffset || document.documentElement.scrollTop;
                lastScrollTop2 -= document.getElementById("detail-product").scrollTop;
            }
       } else {
            // upscroll code
            if (direction != "up") {
                direction = "up";
                lastScrollTop2 = window.pageYOffset || document.documentElement.scrollTop;
                lastScrollTop2 -= document.getElementById("detail-product").scrollTop;
            }
       }
        document.getElementById("detail-product").scrollTop = st - lastScrollTop2;
       // console.log(st , lastScrollTop)
        lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling

    }, false);


    $("#comments-list-box").on('click', '.comment-reply', function() {
        if (!document.getElementById("comment-form")){
            alert('لطفا وارد حساب کاربری خود شوید.');
            return;
        }
        if (document.getElementById("comment-replay"))
            document.getElementById("comment-replay").remove();
        var action = document.getElementById("comment-form").getAttribute("action");
        var t = $(this);
        var parent = t.attr('data-comment');
        t.after('<form id="comment-replay" action="'+action+'" method="POST" accept-charset="utf-8" onsubmit="return setComment(this);">'+
                    '<div class="clearfix"></div>'+
                    '<label for="comment-replay" class="mr-y-1em block">پاسخ خود را با ما در میان بگذارید:</label>'+
                    '<textarea id="comment-replay" name="comment" class="border p-1em" rows="5" placeholder="اینجا بنویسید ..."></textarea>'+
                    '<input type="hidden" name="parent" value="'+parent+'">'+
                    '<div class="text-left">'+
                        '<button type="submit" class="bt-blue p-1em submit-comment">ثبت پاسخ</button>'+
                    '</div>'+
                '</form>');
    });

    $(function() {
        $('#load-more-comment').click(function(e) {
            var href = $(this).attr("href");

            loadComments(href);
            
            e.preventDefault();
        });

    });

    function loadComments(href){
        $.ajax({
            url: href,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                loading();
            },
            success: function(res) {
                $(res["comments"]).insertBefore('#load-more-comment')
                if (res["len"] > 0) {
                    var url = new URL(href);
                    var c = url.searchParams.get("comment");
                    c ++;
                    href = updateQueryStringParameter(href, "comment", c);
                    document.getElementById("load-more-comment").setAttribute("href", href);
                } else {
                    document.getElementById("load-more-comment").remove();
                }
                document.getElementById("box-load").remove();
            },
            error: function(xhr) { // if error occured
                alert("یک خطا پیش آمده است. لطفا مجدد تلاش کنید.");
                console.log(xhr);
                document.getElementById("box-load").remove();
            },
        });
    }

});

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    
    if (uri.match(re))
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    else
        return uri + separator + key + "=" + value;
}

function setScore(t) {
    var s1Val = false;
    var s1 = document.getElementsByName("score1");
    for(var i=0; i<s1.length; i++) {
        s1Val = s1Val || s1[i].checked;
        if (s1Val) {
            var s1Value = s1[i].value;
            break;
        }
    }

    var s2Val = false;
    var s2 = document.getElementsByName("score2");
    for(var i=0; i<s2.length; i++) {
        s2Val = s2Val || s2[i].checked;
        if (s2Val) {
            var s2Value = s2[i].value;
            break;
        }
    }

    var s3Val = false;
    var s3 = document.getElementsByName("score3");
    for(var i=0; i<s3.length; i++) {
        s3Val = s3Val || s3[i].checked;
        if (s3Val) {
            var s3Value = s3[i].value;
            break;
        }
    }

    var error = "";
    if (!(s1Val && s2Val && s3Val)) {
        if (!s1Val)
            error += "لطفا امتیاز «اثر بخشی» را ثبت کنید.\n";
        if (!s2Val)
            error += "لطفا امتیاز «بسته بندی» را ثبت کنید.\n";
        if (!s3Val)
            error += "لطفا امتیاز «ارزش نسبت به قیمت» را ثبت کنید.";
    }

    if (error == "") {
        var querystring = "score1="+s1Value+"&score2="+s2Value+"&score3="+s3Value;
        querystring += "&pid="+document.getElementById("pid").value;
        var url = t.getAttribute("action");

        $.ajax({
            type: "POST",
            url: url,
            data: querystring,
            dataType: "json",
            beforeSend: function() {
                loading();
            },
            success: function(data) {
                if (data) 
                    alert("امتیاز شما با موفقیت در سیستم ثبت شد.\nاز مشارکت شما سپاس گزاریم.");
                else
                    alert("یک خطا غیر منتظره پیش آمد.\nامتیاز شما در سیستم ثبت نشد.");
                document.getElementById("box-load").remove();
            },
            error: function(er) {
                console.log(er);
                document.getElementById("box-load").remove();
            }
        });
    } else {
        alert(error);
    }

    return false;
}

function setComment(t) {

    var comment = t.getElementsByTagName("textarea")[0];
    if (comment.value == "") {
        alert("لطفا دیدگاه خود را یادداشت کنید.");
    } else {
        var querystring = "comment="+comment.value;
        querystring += "&pid="+document.getElementById("pid").value;
        var parent = t.getElementsByTagName("input");
        if (parent.length > 0)
            querystring += "&parent="+parent[0].value;

        var url = t.getAttribute("action");

        $.ajax({
            type: "POST",
            url: url,
            data: querystring,
            dataType: "json",
            beforeSend: function() {
                loading();
            },
            success: function(data) {
                document.getElementById("box-load").remove();
                if (data) 
                    alert("دیدگاه شما با موفقیت در سیستم ثبت شد.\nپس از تایید این دیدگاه قابل مشاهده خواهد بود.\nاز مشارکت شما سپاس گزاریم.");
                else
                    alert("یک خطا غیر منتظره پیش آمد.\nدیدگاه شما در سیستم ثبت نشد.");
                comment.value = "";
                if (parent.length > 0) {
                    document.getElementById("comment-replay").remove();
                }
            },
            error: function(er) {
                console.log(er);
                document.getElementById("box-load").remove();
            }
        });
    }

    return false;

}

function validinput(t){
    var x = parseArabic(t.value).match(/\d+/);
    if(x != null)
        t.value = parseInt(x[0]).toString();
    else
        t.value = 1;
}

function chnageQTY(argument) {
    var qty = document.getElementById("count").getElementsByTagName("input")[0];
    if (argument == "plus")
        qty.value ++;
    else
        qty.value = Math.max(1, qty.value-1);
}