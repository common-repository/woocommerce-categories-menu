=== WooCommerce Categories Menu===
Contributors: alvaron
Donate link: http://www.wpworking.com/
Tags: woocommerce, categories, menu
Requires at least: 3.1.3
Tested up to: 3.9
Stable tag: 1.2.0

== Description ==

Description:Displays a three level product category menu(list or select input field) from WooCommerce Product categories. You can configure it as multiple widgets or short code and add some useful css properties. 

More info about the plugin: http://www.wpworking.com/

Ask for support on wpworking@wpworking.com

Purchase the WCCTM PRO Version on http://www.wpworking.com/shop/ and get total toggle menu, plus control on excluding categories, colouring, style and positioning every element on the menu
Check the live demos on http://www.wpworking.com/wcctmpr-woocommerce-categories-menu-pro-live-demos/


== Installation ==


1. Upload "woocommerce-categories-menu" folder to the "/wp-content/plugins/" directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Register a widget sidebar on your functions file, for example, just paste the code below on your theme functions.php(seescreenshot 1)


You if you have already registered any sidebar, you can drag the `WooCommerce Categories Menu` widget inside it, at wp-admin

4. Configure the widget on your wp-admin pannel and save(see screenshots)
5. Use the code bellow where you want the widget to show, on your theme pages(see screenshots)
/* if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('WooCommerce Categories Menu')) : endif; */



you can use short code: [wcctm tpset="m" selprdtxt = "Select" posmncpos = "relative" ortmncpos = "horizontal" dspseclev = "true"	dspthrlev = "true" ulv1fts = "16" ulv1wid = "120" ulv2fts = "14" ulv2wid = "120" ulv3fts = "12" ulv3wid = "120"]

== Frequently Asked Questions ==

If you have any questions, please let me know  wpworking@wpworking.com

== Screenshots ==

1. Configuring shortcode on wp-admin
2. Configuring multiwidget on wp-admin
3. Displaying list menu on front-end
4. Displaying select menu on front-end

== Changelog ==
1.1.0 corrected bug:Call to undefined function gtpartrat()
1.2.0 corrected all PHP warnings and alerts

== Upgrade Notice ==
See it working on http://www.wpworking.com/

== Other Notes ==
The result div is on div class menu-categs-box, table id div_postlist so you can play with css

Check the live demos on http://www.wpworking.com/wcctmpr-woocommerce-categories-menu-pro-live-demos/

horizontal menu
[wcctm usest = "true" excat = "528,530" tpset="m" selprdtxt = "Select" posmncpos = "relative" ortmncpos = "horizontal" dspseclev = "true" dspthrlev = "true" ulv1fts = "16" ulv1wid = "120" ulv2fts = "14" ulv2wid = "120" ulv3fts = "12" ulv3wid = "120" mngerst="" sbgerst="border:1px #ff9900 solid;background:#f9f9f9"]

select menu
[wcctm usest = "true" excat = "528,530" tpset="s" selprdtxt = "Product Categories" posmncpos = "relative" ortmncpos = "horizontal" dspseclev = "true" dspthrlev = "true" ulv1fts = "16" ulv1wid = "250" ulv2fts = "14" ulv2wid = "120" ulv3fts = "12" ulv3wid = "120" mngerst="" sbgerst="border:1px #ff9933 solid;background:#f9f9f9"]

Parameters
Use Custom Styles: e.g. usest = false
Exclude Categories: e.g. excat = 17,77
Menu Type: tpset="m" // m=list menu , s = select input field menu
Select Field first option text: selprdtxt = "Select, or Anything you want"
Menu CSS position: posmncpos = "relative" // you can set it to absolute, fixed, or any CSS valid value
Menu Orientation:ortmncpos = "horizontal" // you can also choose vertical, works only for list menu
Display Second Level Category: dspseclev = "true" // choose true or false
Display Third Level Category: dspthrlev = "true" // choose true or false
First level category font-size: ulv1fts = "16" , any number works only for list menu
First level category width: ulv1wid = "120" , any number works only for list menu
Second level category font-size: ulv2fts = "14" , any number works only for list menu
Second  level category width: ulv2wid = "120" , any number works only for list menu
Third level category font-size: ulv3fts = "12" , any number works only for list menu
Third  level category width: ulv3wid = "120" , any number works only for list menu
Menu container CSS properties: e.g. mngerst = border:1px #666 solid;background:#f4f4f4
SubMenus lis CSS  properties: e.g. sbgerst = border:1px #999 solid;background:#f9f9f9

PRO Features

Main Container Background Color: e.g. mlibgclr = #ff9933
Main Container Border Style: e.g. mlibrdclr = 1px red solid
First Category List Item Link Font Color: e.g. flifntclr = #ff0033
First Category List Item Link Hover Font Color:  e.g. flihvfntclr = #ff9933				
First Category List Item Border Style: e.g. flibrdclr=1px red solid			
First Category List Item Background Color: e.g. flibgclr=#ff0033
First Category List Item Hover Background Color: e.g. flihvbgclr=#ff9933
First Category List Item Extra Style: e.g. flixtcss=padding:0px;line-height:23px
Select Form Field Font Color: e.g. cbfntclr=#ff9933
Select Form Field Background Color: e.g. cbbgclr=#ff9933
Select Form Field Extra Style: e.g. cbxtcss=padding:0px;line-height:23px
Display First Image Category: e.g. useimg1=true
First level category image width(any number works only for list menu): e.g. widimg1=120
First Level Category Image Extra Style:  e.g. img1xtcss=border:1px green dotted
Display Second Image Category: e.g. useimg2=true
Second level category image width(any number works only for list menu): e.g. widimg2=120
Second Level Category Image Extra Style:  e.g. img2xtcss=border:1px green dotted
Toggle Menu Header Font Color: e.g. plifntclr = #ff0033
Toggle Menu Header Hover Font Color:  e.g. plihvfntclr = #ff9933				
Toggle Menu Header Border Style: e.g. plibrdclr=1px red solid			
Toggle Menu Header Background Color: e.g. plibgclr=#ff0033
Toggle Menu Header Background Color: e.g. plihvbgclr=#ff9933
Manu Extra Style: e.g. xtcss=padding:0px;line-height:23px

== Arbitrary section ==

If you have any questions, please let me know  wpworking@wpworking.com
If you need any help after purchasing, you can count on WpWorking Support http://www.wpworking.com/support/