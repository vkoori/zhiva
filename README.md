<pre>
quick-link img bayad be font taghir peyda kone >> check responsive

icon e filtring ezafe she

asd


discountController -> write check

product page: page view 
category page: ajax and change construct 
product page: add to cart and change options and set loading for them 
product page: close from after replay to a comment ajax product.js must be update add page view when product stock update, must sms to users 
product page: موجود شد به من اطلاع بده: disable change qty create popup instead of alert() outofstock and discount in category page am I nedd suggestion in cart page or not need?
Suggest products in cart (or products page) needs to have intelligence when shipping is stable, we need sidebar in cart page رمز یک بار مصرف برای ورود create "
short message service (sms) OR add to cart" with ajax change qty in cart with ajax 
change lat, lng in "resources/views/profile/address.blade.php" (2+1 places) 
address: when select province map must be updated

cart icon in header must be change to ajax 
menu in mobile (selected item for homepage)

meta tags (title,description, ...)

################################ 
performance: "api\drugStore\productController > ajax_price" (call in to "drugStore\productController > customization") : check better 'get product with weight and taste In a moment and if null get again' or 'get all products with weight and get all tastes. after than choose correct product details in logic code'

################################ 
updates: instock product is automatically set as the default product 
product page: change options and set new url

################################ 
bugs: next and back browser when ajax was finshed

################################# 
DB: ALTER TABLE dr_short_message_services DROP FOREIGN KEY sms_product; 
ALTER TABLE dr_short_message_services ADD CONSTRAINT sms_product FOREIGN KEY (productid) REFERENCES dr_product_details(id) ON DELETE CASCADE ON UPDATE RESTRICT; 
ALTER TABLE dr_short_message_services CHANGE productid product_detail_id BIGINT(20) UNSIGNED NOT NULL;

################################## 
optimization: 1- is need check category from URL when user into the product page? 2- is need check stock when user click on the "add to cart" or "sms"?

#################################

.env:
ALLOWED_DOMAINS=localhost,127.0.0.1,zhivafit.com,propeykar.com

</pre>