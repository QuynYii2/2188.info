@extends('backend-v2.layouts.master')

@section('content')


        <!DOCTYPE html>
<html class="wp-toolbar"
      lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reviews &lsaquo; Wordpress &#8212; WordPress</title>
    <script type="text/javascript">
        addLoadEvent = function(func){if(typeof jQuery!=='undefined')jQuery(function(){func();});else if(typeof wpOnload!=='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
        var ajaxurl = '/wordpress/wp-admin/admin-ajax.php',
            pagenow = 'product_page_product-reviews',
            typenow = 'product',
            adminpage = 'product_page_product-reviews',
            thousandsSeparator = '.',
            decimalPoint = ',',
            isRtl = 0;
    </script>
    <link rel='dns-prefetch' href='//stats.wp.com' />
    <style>
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 0.07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' href='http://localhost/wordpress/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5Bchunk_0%5D=dashicons,admin-bar,common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,wp-pointer,widgets&amp;load%5Bchunk_1%5D=,site-icon,l10n,buttons,wp-auth-check,wp-color-picker&amp;ver=6.2.2' media='all' />
    <link rel='stylesheet' id='acf-global-css' href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/css/acf-global.css?ver=6.1.6' media='all' />
    <link rel='stylesheet' id='woocommerce-twenty-twenty-one-admin-css' href='//localhost/wordpress/wp-content/plugins/woocommerce/assets/css/twenty-twenty-one-admin.css?ver=7.9.0' media='all' />
    <link rel='stylesheet' id='woocommerce_admin_menu_styles-css' href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/menu.css?ver=7.9.0' media='all' />
    <link rel='stylesheet' id='woocommerce_admin_styles-css' href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/admin.css?ver=7.9.0' media='all' />
    <link rel='stylesheet' id='jquery-ui-style-css' href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/jquery-ui/jquery-ui.min.css?ver=7.9.0' media='all' />
    <link rel='stylesheet' id='woocommerce-activation-css' href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/activation.css?ver=7.9.0' media='all' />
    <script>
        window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/localhost\/wordpress\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.2.2"}};
        /*! This file is auto-generated */
        !function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){p.clearRect(0,0,i.width,i.height),p.fillText(e,0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(t,0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(p&&p.fillText)switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s("\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f","\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f")?!1:!s("\ud83c\uddfa\ud83c\uddf3","\ud83c\uddfa\u200b\ud83c\uddf3")&&!s("\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f","\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");case"emoji":return!s("\ud83e\udef1\ud83c\udffb\u200d\ud83e\udef2\ud83c\udfff","\ud83e\udef1\ud83c\udffb\u200b\ud83e\udef2\ud83c\udfff")}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(e=t.source||{}).concatemoji?c(e.concatemoji):e.wpemoji&&e.twemoji&&(c(e.twemoji),c(e.wpemoji)))}(window,document,window._wpemojiSettings);
    </script>
    <script id='woocommerce_admin-js-extra'>
        var woocommerce_admin = {"i18n_decimal_error":"Please enter a value with one decimal point (.) without thousand separators.","i18n_mon_decimal_error":"Please enter a value with one monetary decimal point (.) without thousand separators and currency symbols.","i18n_country_iso_error":"Please enter in country code with two capital letters.","i18n_sale_less_than_regular_error":"Please enter in a value less than the regular price.","i18n_delete_product_notice":"This product has produced sales and may be linked to existing orders. Are you sure you want to delete it?","i18n_remove_personal_data_notice":"This action cannot be reversed. Are you sure you wish to erase personal data from the selected orders?","i18n_confirm_delete":"Are you sure you wish to delete this item?","decimal_point":".","mon_decimal_point":".","ajax_url":"http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php","strings":{"import_products":"Import","export_products":"Export"},"nonces":{"gateway_toggle":"7ec6e2e491"},"urls":{"add_product":null,"import_products":"http:\/\/localhost\/wordpress\/wp-admin\/edit.php?post_type=product&page=product_importer","export_products":"http:\/\/localhost\/wordpress\/wp-admin\/edit.php?post_type=product&page=product_exporter"}};
    </script>
    <script id='wc-enhanced-select-js-extra'>
        var wc_enhanced_select_params = {"i18n_no_matches":"No matches found","i18n_ajax_error":"Loading failed","i18n_input_too_short_1":"Please enter 1 or more characters","i18n_input_too_short_n":"Please enter %qty% or more characters","i18n_input_too_long_1":"Please delete 1 character","i18n_input_too_long_n":"Please delete %qty% characters","i18n_selection_too_long_1":"You can only select 1 item","i18n_selection_too_long_n":"You can only select %qty% items","i18n_load_more":"Loading more results\u2026","i18n_searching":"Searching\u2026","ajax_url":"http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php","search_products_nonce":"093252d73f","search_customers_nonce":"e3ce86693d","search_categories_nonce":"dc61600d7d","search_taxonomy_terms_nonce":"d62dc938d5","search_product_attributes_nonce":"f41499f1f4","search_pages_nonce":"e7d02a5cd6"};
    </script>

    <script>
        /* <![CDATA[ */
        var userSettings = {"url":"\/wordpress\/","uid":"1","time":"1689674649","secure":""};/* ]]> */
    </script>
    <script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=wp-polyfill-inert,regenerator-runtime,wp-polyfill,wp-hooks,jquery-core,jquery-migrate,utils,jquery-ui-core,jquery-ui-mouse,jquer&amp;load%5Bchunk_1%5D=y-ui-sortable&amp;ver=6.2.2'></script>
    <script src='https://stats.wp.com/w.js?ver=202329' id='woo-tracks-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70' id='jquery-blockui-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js?ver=7.9.0' id='jquery-tiptip-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/woocommerce_admin.min.js?ver=7.9.0' id='woocommerce_admin-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.6' id='selectWoo-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/wc-enhanced-select.min.js?ver=7.9.0' id='wc-enhanced-select-js'></script>
    <script type="text/javascript">var _wpColorScheme = {"icons":{"base":"#a7aaad","focus":"#72aee6","current":"#fff"}};</script>
    <link id="wp-admin-canonical" rel="canonical" href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews" />
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, document.getElementById( 'wp-admin-canonical' ).href + window.location.hash );
        }
    </script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"><style media="print">#wpadminbar { display:none; }</style>
</head>
<body class="wp-admin wp-core-ui no-js theme-twentytwentyone  acf-admin-5-3 acf-browser-chrome wc-wp-version-gte-53 wc-wp-version-gte-55 product_page_product-reviews auto-fold admin-bar post-type-product branch-6-2 version-6-2-2 admin-color-fresh locale-vi no-customize-support no-svg">
<script type="text/javascript">
    document.body.className = document.body.className.replace('no-js','js');
</script>

<script>
    (function() {
        var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

        request = true;

        b[c] = b[c].replace( rcs, ' ' );
        // The customizer requires postMessage and CORS (if the site is cross domain).
        b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
    }());
</script>

<div id="wpwrap">

    <div id="adminmenumain" role="navigation" aria-label="Menu chính">
        <a href="#wpbody-content" class="screen-reader-shortcut">Chuyển đến nội dung chính</a>
        <a href="#wp-toolbar" class="screen-reader-shortcut">Chuyển đến thanh công cụ</a>
        <div id="adminmenuback"></div>
        <div id="adminmenuwrap">
            <ul id="adminmenu">


                <li class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-first menu-top-last" id="menu-dashboard">
                    <a href='index.php' class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-first menu-top-last" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-dashboard' aria-hidden='true'><br /></div><div class='wp-menu-name'>Bảng tin</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Bảng tin</li><li class="wp-first-item"><a href='index.php' class="wp-first-item">Trang chủ</a></li><li><a href='update-core.php'>Cập nhật <span class="update-plugins count-1"><span class="update-count">1</span></span></a></li></ul></li>
                <li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true"><div class="separator"></div></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-post open-if-no-js menu-top-first" id="menu-posts">
                    <a href='edit.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-post open-if-no-js menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-post' aria-hidden='true'><br /></div><div class='wp-menu-name'>Bài viết</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Bài viết</li><li class="wp-first-item"><a href='edit.php' class="wp-first-item">Tất cả bài viết</a></li><li><a href='post-new.php'>Viết bài mới</a></li><li><a href='edit-tags.php?taxonomy=category'>Chuyên mục</a></li><li><a href='edit-tags.php?taxonomy=post_tag'>Thẻ</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" id="menu-media">
                    <a href='upload.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-media' aria-hidden='true'><br /></div><div class='wp-menu-name'>Media</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Media</li><li class="wp-first-item"><a href='upload.php' class="wp-first-item">Thư viện</a></li><li><a href='media-new.php'>Thêm mới</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
                    <a href='edit.php?post_type=page' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-page' aria-hidden='true'><br /></div><div class='wp-menu-name'>Trang</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Trang</li><li class="wp-first-item"><a href='edit.php?post_type=page' class="wp-first-item">Tất cả các trang</a></li><li><a href='post-new.php?post_type=page'>Thêm trang mới</a></li></ul></li>
                <li class="wp-not-current-submenu menu-top menu-icon-comments menu-top-last" id="menu-comments">
                    <a href='edit-comments.php' class="wp-not-current-submenu menu-top menu-icon-comments menu-top-last" ><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-comments' aria-hidden='true'><br /></div><div class='wp-menu-name'>Phản hồi <span class="awaiting-mod count-0"><span class="pending-count" aria-hidden="true">0</span><span class="comments-in-moderation-text screen-reader-text">0 bình luận cần kiểm duyệt</span></span></div></a></li>
                <li class="wp-not-current-submenu wp-menu-separator woocommerce" aria-hidden="true"><div class="separator"></div></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce menu-top-first" id="toplevel_page_woocommerce"><a href='admin.php?page=wc-admin' class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image svg' style="background-image:url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDI0IDEwMjQiPjxwYXRoIGZpbGw9IiNhMmFhYjIiIGQ9Ik02MTIuMTkyIDQyNi4zMzZjMC02Ljg5Ni0zLjEzNi01MS42LTI4LTUxLjYtMzcuMzYgMC00Ni43MDQgNzIuMjU2LTQ2LjcwNCA4Mi42MjQgMCAzLjQwOCAzLjE1MiA1OC40OTYgMjguMDMyIDU4LjQ5NiAzNC4xOTItLjAzMiA0Ni42NzItNzIuMjg4IDQ2LjY3Mi04OS41MnptMjAyLjE5MiAwYzAtNi44OTYtMy4xNTItNTEuNi0yOC4wMzItNTEuNi0zNy4yOCAwLTQ2LjYwOCA3Mi4yNTYtNDYuNjA4IDgyLjYyNCAwIDMuNDA4IDMuMDcyIDU4LjQ5NiAyNy45NTIgNTguNDk2IDM0LjE5Mi0uMDMyIDQ2LjY4OC03Mi4yODggNDYuNjg4LTg5LjUyek0xNDEuMjk2Ljc2OGMtNjguMjI0IDAtMTIzLjUwNCA1NS40ODgtMTIzLjUwNCAxMjMuOTJ2NjUwLjcyYzAgNjguNDMyIDU1LjI5NiAxMjMuOTIgMTIzLjUwNCAxMjMuOTJoMzM5LjgwOGwxMjMuNTA0IDEyMy45MzZWODk5LjMyOGgyNzguMDQ4YzY4LjIyNCAwIDEyMy41Mi01NS40NzIgMTIzLjUyLTEyMy45MnYtNjUwLjcyYzAtNjguNDMyLTU1LjI5Ni0xMjMuOTItMTIzLjUyLTEyMy45MmgtNzQxLjM2em01MjYuODY0IDQyMi4xNmMwIDU1LjA4OC0zMS4wODggMTU0Ljg4LTEwMi42NCAxNTQuODgtNi4yMDggMC0xOC40OTYtMy42MTYtMjUuNDI0LTYuMDE2LTMyLjUxMi0xMS4xNjgtNTAuMTkyLTQ5LjY5Ni01Mi4zNTItNjYuMjU2IDAgMC0zLjA3Mi0xNy43OTItMy4wNzItNDAuNzUyIDAtMjIuOTkyIDMuMDcyLTQ1LjMyOCAzLjA3Mi00NS4zMjggMTUuNTUyLTc1LjcyOCA0My41NTItMTA2LjczNiA5Ni40NDgtMTA2LjczNiA1OS4wNzItLjAzMiA4My45NjggNTguNTI4IDgzLjk2OCAxMTAuMjA4ek00ODYuNDk2IDMwMi40YzAgMy4zOTItNDMuNTUyIDE0MS4xNjgtNDMuNTUyIDIxMy40MjR2NzUuNzEyYy0yLjU5MiAxMi4wOC00LjE2IDI0LjE0NC0yMS44MjQgMjQuMTQ0LTQ2LjYwOCAwLTg4Ljg4LTE1MS40NzItOTIuMDE2LTE2MS44NC02LjIwOCA2Ljg5Ni02Mi4yNCAxNjEuODQtOTYuNDQ4IDE2MS44NC0yNC44NjQgMC00My41NTItMTEzLjY0OC00Ni42MDgtMTIzLjkzNkMxNzYuNzA0IDQzNi42NzIgMTYwIDMzNC4yMjQgMTYwIDMyNy4zMjhjMC0yMC42NzIgMS4xNTItMzguNzM2IDI2LjA0OC0zOC43MzYgNi4yMDggMCAyMS42IDYuMDY0IDIzLjcxMiAxNy4xNjggMTEuNjQ4IDYyLjAzMiAxNi42ODggMTIwLjUxMiAyOS4xNjggMTg1Ljk2OCAxLjg1NiAyLjkyOCAxLjUwNCA3LjAwOCA0LjU2IDEwLjQzMiAzLjE1Mi0xMC4yODggNjYuOTI4LTE2OC43ODQgOTQuOTYtMTY4Ljc4NCAyMi41NDQgMCAzMC40IDQ0LjU5MiAzMy41MzYgNjEuODI0IDYuMjA4IDIwLjY1NiAxMy4wODggNTUuMjE2IDIyLjQxNiA4Mi43NTIgMC0xMy43NzYgMTIuNDgtMjAzLjEyIDY1LjM5Mi0yMDMuMTIgMTguNTkyLjAzMiAyNi43MDQgNi45MjggMjYuNzA0IDI3LjU2OHpNODcwLjMyIDQyMi45MjhjMCA1NS4wODgtMzEuMDg4IDE1NC44OC0xMDIuNjQgMTU0Ljg4LTYuMTkyIDAtMTguNDQ4LTMuNjE2LTI1LjQyNC02LjAxNi0zMi40MzItMTEuMTY4LTUwLjE3Ni00OS42OTYtNTIuMjg4LTY2LjI1NiAwIDAtMy44ODgtMTcuOTItMy44ODgtNDAuODk2czMuODg4LTQ1LjE4NCAzLjg4OC00NS4xODRjMTUuNTUyLTc1LjcyOCA0My40ODgtMTA2LjczNiA5Ni4zODQtMTA2LjczNiA1OS4xMDQtLjAzMiA4My45NjggNTguNTI4IDgzLjk2OCAxMTAuMjA4eiIvPjwvc3ZnPg==')" aria-hidden='true'><br /></div><div class='wp-menu-name'>WooCommerce</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>WooCommerce</li><li class="wp-first-item"><a href='admin.php?page=wc-admin' class="wp-first-item">Home <span class="awaiting-mod update-plugins remaining-tasks-badge count-4">4</span></a></li><li><a href='edit.php?post_type=shop_order'>Orders</a></li><li><a href='admin.php?page=wc-admin&#038;path=/customers'>Customers</a></li><li><a href='admin.php?page=coupons-moved'>Coupons</a></li><li><a href='admin.php?page=wc-reports'>Reports</a></li><li><a href='admin.php?page=wc-settings'>Settings</a></li><li><a href='admin.php?page=wc-status'>Status</a></li><li><a href='admin.php?page=wc-addons'>Extensions </a></li></ul></li>
                <li class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-product" id="menu-posts-product">
                    <a href='edit.php?post_type=product' class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-product" ><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-archive' aria-hidden='true'><br /></div><div class='wp-menu-name'>Products</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Products</li><li class="wp-first-item"><a href='edit.php?post_type=product' class="wp-first-item">All Products</a></li><li><a href='post-new.php?post_type=product'>Add New</a></li><li><a href='edit-tags.php?taxonomy=product_cat&amp;post_type=product'>Categories</a></li><li><a href='edit-tags.php?taxonomy=product_tag&amp;post_type=product'>Tags</a></li><li><a href='edit.php?post_type=product&#038;page=product_attributes'>Attributes</a></li><li class="current"><a href='edit.php?post_type=product&#038;page=product-reviews' class="current" aria-current="page">Reviews</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wc-admin&amp;path=/analytics/overview" id="toplevel_page_wc-admin-path--analytics-overview"><a href='admin.php?page=wc-admin&path=/analytics/overview' class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wc-admin&amp;path=/analytics/overview" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-chart-bar' aria-hidden='true'><br /></div><div class='wp-menu-name'>Analytics</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Analytics</li><li class="wp-first-item"><a href='admin.php?page=wc-admin&#038;path=/analytics/overview' class="wp-first-item">Overview</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/products'>Products</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/revenue'>Revenue</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/orders'>Orders</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/variations'>Variations</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/categories'>Categories</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/coupons'>Coupons</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/taxes'>Taxes</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/downloads'>Downloads</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/stock'>Stock</a></li><li><a href='admin.php?page=wc-admin&#038;path=/analytics/settings'>Settings</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce-marketing menu-top-last" id="toplevel_page_woocommerce-marketing">
                    <a href='admin.php?page=wc-admin&path=/marketing' class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce-marketing menu-top-last" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-megaphone' aria-hidden='true'><br /></div><div class='wp-menu-name'>Marketing</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Marketing</li><li class="wp-first-item"><a href='admin.php?page=wc-admin&path=/marketing' class="wp-first-item">Overview</a></li><li><a href='edit.php?post_type=shop_coupon'>Coupons</a></li></ul></li>
                <li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true"><div class="separator"></div></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first" id="menu-appearance">
                    <a href='themes.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-appearance' aria-hidden='true'><br /></div><div class='wp-menu-name'>Giao diện</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Giao diện</li><li class="wp-first-item"><a href='themes.php' class="wp-first-item">Giao diện <span class="update-plugins count-0"><span class="theme-count">0</span></span></a></li><li class="hide-if-no-customize"><a href='customize.php?return=%2Fwordpress%2Fwp-admin%2Fedit.php%3Fpost_type%3Dproduct%26page%3Dproduct-reviews' class="hide-if-no-customize">Tùy biến</a></li><li><a href='widgets.php'>Widget</a></li><li><a href='nav-menus.php'>Menu</a></li><li class="hide-if-no-customize"><a href='customize.php?return=%2Fwordpress%2Fwp-admin%2Fedit.php%3Fpost_type%3Dproduct%26page%3Dproduct-reviews&#038;autofocus%5Bcontrol%5D=background_image' class="hide-if-no-customize">Nền</a></li><li><a href='themes.php?page=custom-background'>Nền</a></li><li><a href='theme-editor.php'>Theme File Editor</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins" id="menu-plugins">
                    <a href='plugins.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-plugins' aria-hidden='true'><br /></div><div class='wp-menu-name'>Plugin <span class="update-plugins count-0"><span class="plugin-count">0</span></span></div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Plugin <span class="update-plugins count-0"><span class="plugin-count">0</span></span></li><li class="wp-first-item"><a href='plugins.php' class="wp-first-item">Plugin đã cài đặt</a></li><li><a href='plugin-install.php'>Cài mới</a></li><li><a href='plugin-editor.php'>Plugin File Editor</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users" id="menu-users">
                    <a href='users.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-users' aria-hidden='true'><br /></div><div class='wp-menu-name'>Thành viên</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Thành viên</li><li class="wp-first-item"><a href='users.php' class="wp-first-item">Tất cả người dùng</a></li><li><a href='user-new.php'>Thêm mới</a></li><li><a href='profile.php'>Hồ sơ</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools" id="menu-tools">
                    <a href='tools.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-tools' aria-hidden='true'><br /></div><div class='wp-menu-name'>Công cụ</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Công cụ</li><li class="wp-first-item"><a href='tools.php' class="wp-first-item">Các công cụ</a></li><li><a href='import.php'>Nhập</a></li><li><a href='export.php'>Xuất ra</a></li><li><a href='site-health.php'>Site Health <span class="menu-counter site-health-counter count-0"><span class="count">0</span></span></a></li><li><a href='export-personal-data.php'>Xuất dữ liệu cá nhân</a></li><li><a href='erase-personal-data.php'>Xóa dữ liệu cá nhân</a></li><li><a href='tools.php?page=action-scheduler'>Scheduled Actions</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings" id="menu-settings">
                    <a href='options-general.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-admin-settings' aria-hidden='true'><br /></div><div class='wp-menu-name'>Cài đặt</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>Cài đặt</li><li class="wp-first-item"><a href='options-general.php' class="wp-first-item">Tổng quan</a></li><li><a href='options-writing.php'>Viết</a></li><li><a href='options-reading.php'>Đọc</a></li><li><a href='options-discussion.php'>Thảo luận</a></li><li><a href='options-media.php'>Media</a></li><li><a href='options-permalink.php'>Đường dẫn tĩnh</a></li><li><a href='options-privacy.php'>Riêng tư</a></li></ul></li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_edit?post_type=acf-field-group menu-top-last" id="toplevel_page_edit-post_type-acf-field-group">
                    <a href='edit.php?post_type=acf-field-group' class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_edit?post_type=acf-field-group menu-top-last" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image dashicons-before dashicons-welcome-widgets-menus' aria-hidden='true'><br /></div><div class='wp-menu-name'>ACF</div></a>
                    <ul class='wp-submenu wp-submenu-wrap'><li class='wp-submenu-head' aria-hidden='true'>ACF</li><li class="wp-first-item"><a href='edit.php?post_type=acf-field-group' class="wp-first-item">Field Groups</a></li><li><a href='edit.php?post_type=acf-post-type'>Post Types</a></li><li><a href='edit.php?post_type=acf-taxonomy'>Taxonomies</a></li><li><a href='edit.php?post_type=acf-field-group&#038;page=acf-tools'>Tools</a></li><li><a href='edit.php?post_type=acf-field-group&#038;page=acf-settings-updates'>Updates</a></li></ul></li><li id="collapse-menu" class="hide-if-no-js"><button type="button" id="collapse-button" aria-label="Thu nhỏ menu chính" aria-expanded="true"><span class="collapse-button-icon" aria-hidden="true"></span><span class="collapse-button-label">Thu gọn menu</span></button></li></ul>
        </div>
    </div>
    <div id="wpcontent">

        <div id="wpadminbar" class="nojq nojs">
            <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Thanh công cụ">
                <ul id='wp-admin-bar-root-default' class="ab-top-menu"><li id='wp-admin-bar-menu-toggle'><a class='ab-item' href='#'><span class="ab-icon" aria-hidden="true"></span><span class="screen-reader-text">Menu</span></a></li><li id='wp-admin-bar-wp-logo' class="menupop"><a class='ab-item' aria-haspopup="true" href='http://localhost/wordpress/wp-admin/about.php'><span class="ab-icon" aria-hidden="true"></span><span class="screen-reader-text">Giới thiệu về WordPress</span></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-wp-logo-default' class="ab-submenu"><li id='wp-admin-bar-about'><a class='ab-item' href='http://localhost/wordpress/wp-admin/about.php'>Giới thiệu về WordPress</a></li></ul><ul id='wp-admin-bar-wp-logo-external' class="ab-sub-secondary ab-submenu"><li id='wp-admin-bar-wporg'><a class='ab-item' href='https://vi.wordpress.org/'>WordPress.org</a></li><li id='wp-admin-bar-documentation'><a class='ab-item' href='https://wordpress.org/documentation/'>Tài liệu</a></li><li id='wp-admin-bar-support-forums'><a class='ab-item' href='https://wordpress.org/support/forums/'>Hỗ trợ</a></li><li id='wp-admin-bar-feedback'><a class='ab-item' href='https://wordpress.org/support/forum/requests-and-feedback'>Thông tin phản hồi</a></li></ul></div></li><li id='wp-admin-bar-site-name' class="menupop"><a class='ab-item' aria-haspopup="true" href='http://localhost/wordpress/'>Wordpress</a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-site-name-default' class="ab-submenu"><li id='wp-admin-bar-view-site'><a class='ab-item' href='http://localhost/wordpress/'>Xem trang</a></li><li id='wp-admin-bar-view-store'><a class='ab-item' href='http://localhost/wordpress/shop/'>Visit Store</a></li></ul></div></li><li id='wp-admin-bar-updates'><a class='ab-item' href='http://localhost/wordpress/wp-admin/update-core.php'><span class="ab-icon" aria-hidden="true"></span><span class="ab-label" aria-hidden="true">1</span><span class="screen-reader-text updates-available-text">1 cập nhật mới</span></a></li><li id='wp-admin-bar-comments'><a class='ab-item' href='http://localhost/wordpress/wp-admin/edit-comments.php'><span class="ab-icon" aria-hidden="true"></span><span class="ab-label awaiting-mod pending-count count-0" aria-hidden="true">0</span><span class="screen-reader-text comments-in-moderation-text">0 bình luận cần kiểm duyệt</span></a></li><li id='wp-admin-bar-new-content' class="menupop"><a class='ab-item' aria-haspopup="true" href='http://localhost/wordpress/wp-admin/post-new.php'><span class="ab-icon" aria-hidden="true"></span><span class="ab-label">Mới</span></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-new-content-default' class="ab-submenu"><li id='wp-admin-bar-new-post'><a class='ab-item' href='http://localhost/wordpress/wp-admin/post-new.php'>Bài viết</a></li><li id='wp-admin-bar-new-media'><a class='ab-item' href='http://localhost/wordpress/wp-admin/media-new.php'>Tập tin</a></li><li id='wp-admin-bar-new-page'><a class='ab-item' href='http://localhost/wordpress/wp-admin/post-new.php?post_type=page'>Trang</a></li><li id='wp-admin-bar-new-product'><a class='ab-item' href='http://localhost/wordpress/wp-admin/post-new.php?post_type=product'>Product</a></li><li id='wp-admin-bar-new-shop_order'><a class='ab-item' href='http://localhost/wordpress/wp-admin/post-new.php?post_type=shop_order'>Order</a></li><li id='wp-admin-bar-new-shop_coupon'><a class='ab-item' href='http://localhost/wordpress/wp-admin/post-new.php?post_type=shop_coupon'>Coupon</a></li><li id='wp-admin-bar-new-user'><a class='ab-item' href='http://localhost/wordpress/wp-admin/user-new.php'>Thành viên</a></li></ul></div></li></ul><ul id='wp-admin-bar-top-secondary' class="ab-top-secondary ab-top-menu"><li id='wp-admin-bar-my-account' class="menupop with-avatar"><a class='ab-item' aria-haspopup="true" href='http://localhost/wordpress/wp-admin/profile.php'>Chào, <span class="display-name">root</span><img alt='' src='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=26&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=52&#038;d=mm&#038;r=g 2x' class='avatar avatar-26 photo' height='26' width='26' loading='lazy' decoding='async'/></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-user-actions' class="ab-submenu"><li id='wp-admin-bar-user-info'><a class='ab-item' tabindex="-1" href='http://localhost/wordpress/wp-admin/profile.php'><img alt='' src='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=64&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=128&#038;d=mm&#038;r=g 2x' class='avatar avatar-64 photo' height='64' width='64' loading='lazy' decoding='async'/><span class='display-name'>root</span></a></li><li id='wp-admin-bar-edit-profile'><a class='ab-item' href='http://localhost/wordpress/wp-admin/profile.php'>Sửa Hồ sơ</a></li><li id='wp-admin-bar-logout'><a class='ab-item' href='http://localhost/wordpress/wp-login.php?action=logout&#038;_wpnonce=9ecf2025ef'>Đăng xuất</a></li></ul></div></li></ul>			</div>
            <a class="screen-reader-shortcut" href="http://localhost/wordpress/wp-login.php?action=logout&#038;_wpnonce=9ecf2025ef">Đăng xuất</a>
        </div>


        <div id="wpbody" role="main">

            <div id="wpbody-content">
                <div id="screen-meta" class="metabox-prefs">

                    <div id="contextual-help-wrap" class="hidden" tabindex="-1" aria-label="Khung Trợ Giúp Ngữ Cảnh">
                        <div id="contextual-help-back"></div>
                        <div id="contextual-help-columns">
                            <div class="contextual-help-tabs">
                                <ul>

                                    <li id="tab-link-woocommerce_support_tab" class="active">
                                        <a href="#tab-panel-woocommerce_support_tab" aria-controls="tab-panel-woocommerce_support_tab">
                                            Help &amp; Support								</a>
                                    </li>

                                    <li id="tab-link-woocommerce_bugs_tab">
                                        <a href="#tab-panel-woocommerce_bugs_tab" aria-controls="tab-panel-woocommerce_bugs_tab">
                                            Found a bug?								</a>
                                    </li>

                                    <li id="tab-link-woocommerce_onboard_tab">
                                        <a href="#tab-panel-woocommerce_onboard_tab" aria-controls="tab-panel-woocommerce_onboard_tab">
                                            Setup wizard								</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="contextual-help-sidebar">
                                <p><strong>For more information:</strong></p><p><a href="https://woocommerce.com/?utm_source=helptab&utm_medium=product&utm_content=about&utm_campaign=woocommerceplugin" target="_blank">About WooCommerce</a></p><p><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WordPress.org project</a></p><p><a href="https://github.com/woocommerce/woocommerce/" target="_blank">GitHub project</a></p><p><a href="https://woocommerce.com/storefront/?utm_source=helptab&utm_medium=product&utm_content=wcthemes&utm_campaign=woocommerceplugin" target="_blank">Official theme</a></p><p><a href="https://woocommerce.com/product-category/woocommerce-extensions/?utm_source=helptab&utm_medium=product&utm_content=wcextensions&utm_campaign=woocommerceplugin" target="_blank">Official extensions</a></p>					</div>

                            <div class="contextual-help-tabs-wrap">

                                <div id="tab-panel-woocommerce_support_tab" class="help-tab-content active">
                                    <h2>Help &amp; Support</h2><p>Should you need help understanding, using, or extending WooCommerce, <a href="https://docs.woocommerce.com/documentation/plugins/woocommerce/?utm_source=helptab&utm_medium=product&utm_content=docs&utm_campaign=woocommerceplugin">please read our documentation</a>. You will find all kinds of resources including snippets, tutorials and much more.</p><p>For further assistance with WooCommerce core, use the <a href="https://wordpress.org/support/plugin/woocommerce">community forum</a>. For help with premium extensions sold on WooCommerce.com, <a href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&utm_medium=product&utm_content=tickets&utm_campaign=woocommerceplugin">open a support request at WooCommerce.com</a>.</p><p>Before asking for help, we recommend checking the system status page to identify any problems with your configuration.</p><p><a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status" class="button button-primary">System status</a> <a href="https://wordpress.org/support/plugin/woocommerce" class="button">Community forum</a> <a href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&utm_medium=product&utm_content=tickets&utm_campaign=woocommerceplugin" class="button">WooCommerce.com support</a></p>							</div>

                                <div id="tab-panel-woocommerce_bugs_tab" class="help-tab-content">
                                    <h2>Found a bug?</h2><p>If you find a bug within WooCommerce core you can create a ticket via <a href="https://github.com/woocommerce/woocommerce/issues?state=open">GitHub issues</a>. Ensure you read the <a href="https://github.com/woocommerce/woocommerce/blob/trunk/.github/CONTRIBUTING.md">contribution guide</a> prior to submitting your report. To help us solve your issue, please be as descriptive as possible and include your <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status">system status report</a>.</p><p><a href="https://github.com/woocommerce/woocommerce/issues/new?assignees=&labels=&template=1-bug-report.yml" class="button button-primary">Report a bug</a> <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status" class="button">System status</a></p>							</div>

                                <div id="tab-panel-woocommerce_onboard_tab" class="help-tab-content">
                                    <h2>WooCommerce Onboarding</h2><h3>Profile Setup Wizard</h3><p>If you need to access the setup wizard again, please click on the button below.</p><p><a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&path=/setup-wizard" class="button button-primary">Setup wizard</a></p><h3>Task List</h3><p>If you need to enable or disable the task lists, please click on the button below.</p><p><a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&reset_task_list=0" class="button button-primary">Disable</a></p><h3>Extended task List</h3><p>If you need to enable or disable the extended task lists, please click on the button below.</p><p><a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&reset_extended_task_list=0" class="button button-primary">Disable</a></p>							</div>
                            </div>
                        </div>
                    </div>
                    <div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="Khung Tùy Biến Màn Hình">
                        <form id='adv-settings' method='post'>
                            <fieldset class="metabox-prefs">
                                <legend>Cột</legend>
                                <label><input class="hide-column-tog" name="type-hide" type="checkbox" id="type-hide" value="type" checked='checked' />Type</label>
                                <label><input class="hide-column-tog" name="author-hide" type="checkbox" id="author-hide" value="author" checked='checked' />Author</label>
                                <label><input class="hide-column-tog" name="rating-hide" type="checkbox" id="rating-hide" value="rating" checked='checked' />Rating</label>
                                <label><input class="hide-column-tog" name="response-hide" type="checkbox" id="response-hide" value="response" checked='checked' />Product</label>
                                <label><input class="hide-column-tog" name="date-hide" type="checkbox" id="date-hide" value="date" checked='checked' />Submitted on</label>
                            </fieldset>

                            <input type="hidden" id="screenoptionnonce" name="screenoptionnonce" value="c20e051585" />
                        </form>
                    </div>		</div>
                <div id="screen-meta-links">
                    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
                        <button type="button" id="show-settings-link" class="button show-settings" aria-controls="screen-options-wrap" aria-expanded="false">Tùy chọn hiển thị</button>
                    </div>
                    <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
                        <button type="button" id="contextual-help-link" class="button show-settings" aria-controls="contextual-help-wrap" aria-expanded="false">Trợ giúp</button>
                    </div>
                </div>
                <div id="message" class="updated woocommerce-message">
                    <a class="woocommerce-message-close notice-dismiss" href="/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;wc-hide-notice=no_secure_connection&#038;_wc_notice_nonce=60fef79ab1">Dismiss</a>

                    <p>
                        Your store does not appear to be using a secure connection. We highly recommend serving your entire website over an HTTPS connection to help keep customer data secure. <a href="https://docs.woocommerce.com/document/ssl-and-https/">Learn more here.</a>	</p>
                </div>
                <div class="wrap">
                    <h2>Reviews</h2>

                    <ul class='subsubsub'>
                        <li class='all'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;comment_status=all" class="current" aria-current="page">All <span class="count">(<span class="all-count">1</span>)</span></a> |</li>
                        <li class='moderated'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;comment_status=moderated">Pending <span class="count">(<span class="pending-count">0</span>)</span></a> |</li>
                        <li class='approved'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;comment_status=approved">Approved <span class="count">(<span class="approved-count">1</span>)</span></a> |</li>
                        <li class='spam'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;comment_status=spam">Spam <span class="count">(<span class="spam-count">0</span>)</span></a> |</li>
                        <li class='trash'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;comment_status=trash">Trash <span class="count">(<span class="trash-count">0</span>)</span></a></li>
                    </ul>
                    <form id="reviews-filter" method="get">

                        <input type="hidden" name="page" value="product-reviews" />
                        <input type="hidden" name="post_type" value="product" />
                        <input type="hidden" name="pagegen_timestamp" value="2023-07-18 10:04:09" />

                        <p class="search-box">
                            <label class="screen-reader-text" for="reviews-search-input">Search Reviews:</label>
                            <input type="search" id="reviews-search-input" name="s" value="" />
                            <input type="submit" id="search-submit" class="button" value="Search Reviews"  /></p>

                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="84f28aef61" /><input type="hidden" name="_wp_http_referer" value="/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews" />	<div class="tablenav top">

                            <div class="alignleft actions bulkactions">
                                <label for="bulk-action-selector-top" class="screen-reader-text">Lựa chọn thao tác hàng loạt</label><select name="action" id="bulk-action-selector-top">
                                    <option value="-1">Hành động</option>
                                    <option value="unapprove">Unapprove</option>
                                    <option value="approve">Approve</option>
                                    <option value="spam">Mark as spam</option>
                                    <option value="trash">Move to Trash</option>
                                </select>
                                <input type="submit" id="doaction" class="button action" value="Áp dụng"  />
                            </div>
                            <div class="alignleft actions"><input type="hidden" name="comment_status" value="all" />		<label class="screen-reader-text" for="filter-by-review-type">Filter by review type</label>
                                <select id="filter-by-review-type" name="review_type">
                                    <option value="all" >All types</option>
                                    <option value="comment" >Replies</option>
                                    <option value="review" >Reviews</option>
                                </select>
                                <label class="screen-reader-text" for="filter-by-review-rating">Filter by review rating</label>
                                <select id="filter-by-review-rating" name="review_rating">
                                    <option value="0"  selected='selected' title="All ratings">All ratings</option>
                                    <option value="1"  title="1-star rating">&#9733;</option>
                                    <option value="2"  title="2-star rating">&#9733;&#9733;</option>
                                    <option value="3"  title="3-star rating">&#9733;&#9733;&#9733;</option>
                                    <option value="4"  title="4-star rating">&#9733;&#9733;&#9733;&#9733;</option>
                                    <option value="5"  title="5-star rating">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                </select>
                                <label class="screen-reader-text" for="filter-by-product">Filter by product</label>
                                <select
                                        id="filter-by-product"
                                        class="wc-product-search"
                                        name="product_id"
                                        style="width: 200px;"
                                        data-placeholder="Search for a product&hellip;"
                                        data-action="woocommerce_json_search_products"
                                        data-allow_clear="true">
                                </select>
                                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter"  /></div><div class='tablenav-pages one-page'><span class="displaying-num">1 mục</span>
                                <span class='pagination-links'><span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Trang hiện tại</label><input class='current-page' id='current-page-selector' type='text' name='paged' value='1' size='1' aria-describedby='table-paging' /><span class='tablenav-paging-text'> trên <span class='total-pages'>1</span></span></span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span></span></div>
                            <br class="clear" />
                        </div>
                        <table class="wp-list-table widefat fixed striped table-view-list product-reviews">
                            <thead>
                            <tr>
                                <td  id='cb' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-1">Chọn toàn bộ</label><input id="cb-select-all-1" type="checkbox" /></td><th scope="col" id='type' class='manage-column column-type sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_type&#038;order=asc"><span>Type</span><span class="sorting-indicator"></span></a></th><th scope="col" id='author' class='manage-column column-author sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_author&#038;order=asc"><span>Author</span><span class="sorting-indicator"></span></a></th><th scope="col" id='rating' class='manage-column column-rating sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=rating&#038;order=asc"><span>Rating</span><span class="sorting-indicator"></span></a></th><th scope="col" id='comment' class='manage-column column-comment column-primary'>Review</th><th scope="col" id='response' class='manage-column column-response sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_post_ID&#038;order=asc"><span>Product</span><span class="sorting-indicator"></span></a></th><th scope="col" id='date' class='manage-column column-date sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_date_gmt&#038;order=asc"><span>Submitted on</span><span class="sorting-indicator"></span></a></th>			</tr>
                            </thead>
                            <tbody id="the-comment-list" data-wp-lists="list:comment">
                            <tr id="comment-2" class="comment comment byuser comment-author-root bypostauthor even thread-even depth-1 approved">
                                <th scope="row" class="check-column">			<label class="screen-reader-text" for="cb-select-2">Select review</label>
                                    <input
                                            id="cb-select-2"
                                            type="checkbox"
                                            name="delete_comments[]"
                                            value="2"
                                    />
                                </th><td class='type column-type' data-colname="Type">Reply</td><td class='author column-author' data-colname="Author"><strong><img alt='' src='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=32&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=64&#038;d=mm&#038;r=g 2x' class='avatar avatar-32 photo' height='32' width='32' loading='lazy' decoding='async'/>root</strong><br>			<a title="http://localhost/wordpress" href="http://localhost/wordpress" rel="noopener noreferrer">localhost/wordpress</a>
                                    <br>
                                    <a href="mailto:kienhue98@gmail.com">kienhue98@gmail.com</a><br>
                                    <a href="admin.php?s=%3A%3A1&#038;page=product-reviews&#038;mode=detail">::1</a>
                                </td><td class='rating column-rating' data-colname="Rating"></td><td class='comment column-comment has-row-actions column-primary' data-colname="Review"><div class="comment-text">123</div>			<div id="inline-2" class="hidden">
                                        <textarea class="comment" rows="1" cols="1">123</textarea>
                                        <div class="author-email">kienhue98@gmail.com</div>
                                        <div class="author">root</div>
                                        <div class="author-url">http://localhost/wordpress</div>
                                        <div class="comment_status">1</div>
                                    </div>
                                    <div class="row-actions"><span class='approve'><a href="http://localhost/wordpress/wp-admin/comment.php?c=2&#038;action=approvecomment&#038;_wpnonce=46e616d6d9" data-wp-lists="dim:the-comment-list:comment-2:unapproved:e7e7d3:e7e7d3:new=approved" class="vim-a aria-button-if-js" aria-label="Approve this review">Approve</a></span><span class='unapprove'><a href="http://localhost/wordpress/wp-admin/comment.php?c=2&#038;action=unapprovecomment&#038;_wpnonce=46e616d6d9" data-wp-lists="dim:the-comment-list:comment-2:unapproved:e7e7d3:e7e7d3:new=unapproved" class="vim-u aria-button-if-js" aria-label="Unapprove this review">Unapprove</a></span><span class='reply hide-if-no-js'> | <button type="button" data-comment-id="2" data-post-id="42" data-action="replyto" class="vim-r comment-inline button-link" aria-expanded="false" aria-label="Reply to this review">Reply</button></span><span class='quickedit hide-if-no-js'> | <button type="button" data-comment-id="2" data-post-id="42" data-action="edit" class="vim-q comment-inline button-link" aria-expanded="false" aria-label="Quick edit this review inline">Quick Edit</button></span><span class='edit'> | <a href="http://localhost/wordpress/wp-admin/comment.php?action=editcomment&#038;c=2" aria-label="Edit this review">Edit</a></span><span class='spam'> | <a href="http://localhost/wordpress/wp-admin/comment.php?c=2&#038;action=spamcomment&#038;_wpnonce=91e8f24268" data-wp-lists="delete:the-comment-list:comment-2::spam=1" class="vim-s vim-destructive aria-button-if-js" aria-label="Mark this review as spam">Spam</a></span><span class='trash'> | <a href="http://localhost/wordpress/wp-admin/comment.php?c=2&#038;action=trashcomment&#038;_wpnonce=91e8f24268" data-wp-lists="delete:the-comment-list:comment-2::trash=1" class="delete vim-d vim-destructive aria-button-if-js" aria-label="Move this review to the Trash">Trash</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class='response column-response' data-colname="Product">			<div class="response-links">
                                        <a href='http://localhost/wordpress/wp-admin/post.php?post=42&#038;action=edit' class='comments-edit-item-link'>hihi</a>				<a href="http://localhost/wordpress/product/hihi/" class="comments-view-item-link">
                                            View product				</a>
                                        <span class="post-com-count-wrapper post-com-count-42">
					<a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;product_id=42&#038;comment_status=approved" class="post-com-count post-com-count-approved"><span class="comment-count-approved" aria-hidden="true">1</span><span class="screen-reader-text">1 review</span></a><span class="post-com-count post-com-count-pending post-com-count-no-pending"><span class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span class="screen-reader-text">No pending reviews</span></span>				</span>
                                    </div>
                                </td><td class='date column-date' data-colname="Submitted on">		<div class="submitted-on">
                                        <a href="http://localhost/wordpress/product/hihi/#comment-2">2023/07/18 at 10:04 sáng</a>		</div>
                                </td>		</tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td   class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-2">Chọn toàn bộ</label><input id="cb-select-all-2" type="checkbox" /></td><th scope="col"  class='manage-column column-type sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_type&#038;order=asc"><span>Type</span><span class="sorting-indicator"></span></a></th><th scope="col"  class='manage-column column-author sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_author&#038;order=asc"><span>Author</span><span class="sorting-indicator"></span></a></th><th scope="col"  class='manage-column column-rating sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=rating&#038;order=asc"><span>Rating</span><span class="sorting-indicator"></span></a></th><th scope="col"  class='manage-column column-comment column-primary'>Review</th><th scope="col"  class='manage-column column-response sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_post_ID&#038;order=asc"><span>Product</span><span class="sorting-indicator"></span></a></th><th scope="col"  class='manage-column column-date sortable desc'><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=product&#038;page=product-reviews&#038;orderby=comment_date_gmt&#038;order=asc"><span>Submitted on</span><span class="sorting-indicator"></span></a></th>			</tr>
                            </tfoot>
                        </table>
                        <div class="tablenav bottom">

                            <div class="alignleft actions bulkactions">
                                <label for="bulk-action-selector-bottom" class="screen-reader-text">Lựa chọn thao tác hàng loạt</label><select name="action2" id="bulk-action-selector-bottom">
                                    <option value="-1">Hành động</option>
                                    <option value="unapprove">Unapprove</option>
                                    <option value="approve">Approve</option>
                                    <option value="spam">Mark as spam</option>
                                    <option value="trash">Move to Trash</option>
                                </select>
                                <input type="submit" id="doaction2" class="button action" value="Áp dụng"  />
                            </div>
                            <div class="alignleft actions"></div><div class='tablenav-pages one-page'><span class="displaying-num">1 mục</span>
                                <span class='pagination-links'><span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>
<span class="screen-reader-text">Trang hiện tại</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 trên <span class='total-pages'>1</span></span></span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span></span></div>
                            <br class="clear" />
                        </div>
                    </form>
                </div>
                <form method="get">
                    <table style="display:none;"><tbody id="com-reply"><tr id="replyrow" class="inline-edit-row" style="display:none;"><td colspan="7" class="colspanchange">
                                <fieldset class="comment-reply">
                                    <legend>
                                        <span class="hidden" id="editlegend">Edit Review</span>
                                        <span class="hidden" id="replyhead">Trả lời phản hồi</span>
                                        <span class="hidden" id="addhead">Thêm Bình luận mới</span>
                                    </legend>

                                    <div id="replycontainer">
                                        <label for="replycontent" class="screen-reader-text">
                                            Bình luận	</label>
                                        <div id="wp-replycontent-wrap" class="wp-core-ui wp-editor-wrap html-active"><link rel='stylesheet' id='editor-buttons-css' href='http://localhost/wordpress/wp-includes/css/editor.min.css?ver=6.2.2' media='all' />
                                            <div id="wp-replycontent-editor-container" class="wp-editor-container"><div id="qt_replycontent_toolbar" class="quicktags-toolbar hide-if-no-js"></div><textarea class="wp-editor-area" rows="20" cols="40" name="replycontent" id="replycontent"></textarea></div>
                                        </div>

                                    </div>

                                    <div id="edithead" style="display:none;">
                                        <div class="inside">
                                            <label for="author-name">Tên</label>
                                            <input type="text" name="newcomment_author" size="50" value="" id="author-name" />
                                        </div>

                                        <div class="inside">
                                            <label for="author-email">Email</label>
                                            <input type="text" name="newcomment_author_email" size="50" value="" id="author-email" />
                                        </div>

                                        <div class="inside">
                                            <label for="author-url">URL</label>
                                            <input type="text" id="author-url" name="newcomment_author_url" class="code" size="103" value="" />
                                        </div>
                                    </div>

                                    <div id="replysubmit" class="submit">
                                        <p class="reply-submit-buttons">
                                            <button type="button" class="save button button-primary">
                                                <span id="addbtn" style="display: none;">Thêm Bình luận</span>
                                                <span id="savebtn" style="display: none;">Cập nhật phản hồi</span>
                                                <span id="replybtn" style="display: none;">Đăng</span>
                                            </button>
                                            <button type="button" class="cancel button">Hủy</button>
                                            <span class="waiting spinner"></span>
                                        </p>
                                        <div class="notice notice-error notice-alt inline hidden">
                                            <p class="error"></p>
                                        </div>
                                    </div>

                                    <input type="hidden" name="action" id="action" value="" />
                                    <input type="hidden" name="comment_ID" id="comment_ID" value="" />
                                    <input type="hidden" name="comment_post_ID" id="comment_post_ID" value="" />
                                    <input type="hidden" name="status" id="status" value="" />
                                    <input type="hidden" name="position" id="position" value="-1" />
                                    <input type="hidden" name="checkbox" id="checkbox" value="1" />
                                    <input type="hidden" name="mode" id="mode" value="detail" />
                                    <input type="hidden" id="_ajax_nonce-replyto-comment" name="_ajax_nonce-replyto-comment" value="adf24cc1b9" /><input type="hidden" id="_wp_unfiltered_html_comment" name="_wp_unfiltered_html_comment" value="e3bd365c95" />	</fieldset>
                            </td></tr></tbody></table>
                </form>
                <div class="hidden" id="trash-undo-holder">
                    <div class="trash-undo-inside">
                        Đã chuyển bình luận của <strong></strong> vào Thùng rác.		<span class="undo untrash"><a href="#">Lùi lại</a></span>
                    </div>
                </div>
                <div class="hidden" id="spam-undo-holder">
                    <div class="spam-undo-inside">
                        Phản hồi của <strong></strong> bị đánh dấu là spam.		<span class="undo unspam"><a href="#">Lùi lại</a></span>
                    </div>
                </div>

                <div class="clear"></div></div><!-- wpbody-content -->
            <div class="clear"></div></div><!-- wpbody -->
        <div class="clear"></div></div><!-- wpcontent -->

    <div id="wpfooter" role="contentinfo">
        <p id="footer-left" class="alignleft">
            If you like <strong>WooCommerce</strong> please leave us a <a href="https://wordpress.org/support/plugin/woocommerce/reviews?rate=5#new-post" target="_blank" class="wc-rating-link" aria-label="five star" data-rated="Thanks :)">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. A huge thanks in advance!	</p>
        <p id="footer-upgrade" class="alignright">
            Phiên bản 6.2.2	</p>
        <div class="clear"></div>
    </div>
    <script type='text/javascript'>list_args = {"class":"WP_Comments_List_Table","screen":{"id":"product_page_product-reviews","base":"product_page_product-reviews"}};</script>
    <!-- WooCommerce Tracks -->
    <script type="text/javascript">
        window.wcTracks = window.wcTracks || {};
        window.wcTracks.isEnabled = true;
        window._tkq = window._tkq || [];

        window.wcTracks.validateEvent = function( eventName, props = {} ) {
            let isValid = true;
            if ( ! /^(([a-z0-9]+)_){1}([a-z0-9_]+)$/.test( eventName ) ) {
                if ( false ) {
                    /* eslint-disable no-console */
                    console.error(
                        `A valid event name must be specified. The event name: "${ eventName }" is not valid.`
                    );
                    /* eslint-enable no-console */
                }
                isValid = false;
            }
            for ( const prop of Object.keys( props ) ) {
                if ( ! /^[a-z_][a-z0-9_]*$/.test( prop ) ) {
                    if ( false ) {
                        /* eslint-disable no-console */
                        console.error(
                            `A valid prop name must be specified. The property name: "${ prop }" is not valid.`
                        );
                        /* eslint-enable no-console */
                    }
                    isValid = false;
                }
            }
            return isValid;
        }
        window.wcTracks.recordEvent = function( name, properties ) {
            if ( ! window.wcTracks.isEnabled ) {
                return;
            }

            const eventName = 'wcadmin_' + name;
            let eventProperties = properties || {};
            eventProperties = { ...eventProperties, ...{"_via_ua":"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/113.0.0.0 Safari\/537.36","_via_ip":"::1","_lg":"vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5","_dr":"http:\/\/localhost\/wordpress\/wp-admin\/post.php?post=42&action=edit","_dl":"http:\/\/localhost\/wordpress\/wp-admin\/edit.php?post_type=product&page=product-reviews","url":"http:\/\/localhost\/wordpress","blog_lang":"vi","blog_id":false,"products_count":0,"wc_version":"7.9.0"} };
            if ( window.wp && window.wp.hooks && window.wp.hooks.applyFilters ) {
                eventProperties = window.wp.hooks.applyFilters( 'woocommerce_tracks_client_event_properties', eventProperties, eventName );
                delete( eventProperties._ui );
                delete( eventProperties._ut );
            }

            if ( ! window.wcTracks.validateEvent( eventName, eventProperties ) ) {
                return;
            }
            window._tkq.push( [ 'recordEvent', eventName, eventProperties ] );
        }
    </script>
    <!-- WooCommerce JavaScript -->
    <script type="text/javascript">
        jQuery(function($) {
            jQuery( 'a.wc-rating-link' ).on( 'click', function() {
                jQuery.post( '/wordpress/wp-admin/admin-ajax.php', { action: 'woocommerce_rated' } );
                jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
            });

            jQuery( function( $ ) {
                function wcFreeShippingShowHideMinAmountField( el ) {
                    var form = $( el ).closest( 'form' );
                    var minAmountField = $( '#woocommerce_free_shipping_min_amount', form ).closest( 'tr' );
                    var ignoreDiscountField = $( '#woocommerce_free_shipping_ignore_discounts', form ).closest( 'tr' );
                    if ( 'coupon' === $( el ).val() || '' === $( el ).val() ) {
                        minAmountField.hide();
                        ignoreDiscountField.hide();
                    } else {
                        minAmountField.show();
                        ignoreDiscountField.show();
                    }
                }

                $( document.body ).on( 'change', '#woocommerce_free_shipping_requires', function() {
                    wcFreeShippingShowHideMinAmountField( this );
                });

                // Change while load.
                $( '#woocommerce_free_shipping_requires' ).trigger( 'change' );
                $( document.body ).on( 'wc_backbone_modal_loaded', function( evt, target ) {
                    if ( 'wc-modal-shipping-method-settings' === target ) {
                        wcFreeShippingShowHideMinAmountField( $( '#wc-backbone-modal-dialog #woocommerce_free_shipping_requires', evt.currentTarget ) );
                    }
                } );
            });
        });
    </script>
    <div id="wp-auth-check-wrap" class="hidden">
        <div id="wp-auth-check-bg"></div>
        <div id="wp-auth-check">
            <button type="button" class="wp-auth-check-close button-link"><span class="screen-reader-text">
		Đóng hộp thoại	</span></button>
            <div id="wp-auth-check-form" class="loading" data-src="http://localhost/wordpress/wp-login.php?interim-login=1&#038;wp_lang=vi"></div>
            <div class="wp-auth-fallback">
                <p><b class="wp-auth-fallback-expired" tabindex="0">Phiên làm việc đã hết hạn</b></p>
                <p><a href="http://localhost/wordpress/wp-login.php" target="_blank">Hãy đăng nhập lại.</a>
                    Trang đăng nhập sẽ được mở trong cửa sổ mới. Sau khi đăng nhập, bạn có thể đóng cửa sổ và quay lại trang hiện tại.</p>
            </div>
        </div>
    </div>
    <script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=hoverIntent&amp;ver=6.2.2'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/i18n.min.js?ver=9e794f35a71bb98672ae' id='wp-i18n-js'></script>
    <script id='wp-i18n-js-after'>
        wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
    </script>
    <script id='common-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", {"translation-revision-date":"2022-08-03 11:30:24+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"%1$s is deprecated since version %2$s with no alternative available.":["%1$s \u0111\u00e3 ng\u1eebng ho\u1ea1t \u0111\u1ed9ng t\u1eeb phi\u00ean b\u1ea3n %2$s v\u00e0 kh\u00f4ng c\u00f3 ph\u01b0\u01a1ng \u00e1n thay th\u1ebf."],"%1$s is deprecated since version %2$s! Use %3$s instead.":["%1$s \u0111\u00e3 b\u1ecb ng\u1eebng s\u1eed d\u1ee5ng t\u1eeb phi\u00ean b\u1ea3n %2$s! H\u00e3y s\u1eed d\u1ee5ng %3$s."],"Expand Main menu":["M\u1edf r\u1ed9ng menu ch\u00ednh"],"Dismiss this notice.":["B\u1ecf qua th\u00f4ng b\u00e1o n\u00e0y "],"You are about to permanently delete these items from your site.\nThis action cannot be undone.\n'Cancel' to stop, 'OK' to delete.":["B\u1ea1n s\u1eafp x\u00f3a v\u0129nh vi\u1ec5n nh\u1eefng m\u1ee5c n\u00e0y kh\u1ecfi trang web c\u1ee7a b\u1ea1n.\nH\u00e0nh \u0111\u1ed9ng n\u00e0y kh\u00f4ng th\u1ec3 ho\u00e0n t\u00e1c.\n 'H\u1ee7y' \u0111\u1ec3 d\u1eebng, 'OK' \u0111\u1ec3 x\u00f3a."],"Collapse Main menu":["Thu nh\u1ecf menu ch\u00ednh"]}},"comment":{"reference":"wp-admin\/js\/common.js"}} );
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/common.min.js?ver=6.2.2' id='common-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/hoverintent-js.min.js?ver=2.2.1' id='hoverintent-js-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/admin-bar.min.js?ver=6.2.2' id='admin-bar-js'></script>
    <script src='http://localhost/wordpress/wp-admin/js/svg-painter.js?ver=6.2.2' id='svg-painter-js'></script>
    <script id='heartbeat-js-extra'>
        var heartbeatSettings = {"nonce":"592fbdf85e"};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/heartbeat.min.js?ver=6.2.2' id='heartbeat-js'></script>
    <script id='wp-auth-check-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", {"translation-revision-date":"2023-07-03 03:51:18+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"Your session has expired. You can log in again from this page or go to the login page.":["Phi\u00ean l\u00e0m vi\u1ec7c c\u1ee7a b\u1ea1n \u0111\u00e3 h\u1ebft h\u1ea1n. H\u00e3y \u0111\u0103ng nh\u1eadp l\u1ea1i t\u1ea1i \u0111\u00e2y ho\u1eb7c t\u1ea1i trang \u0111\u0103ng nh\u1eadp."]}},"comment":{"reference":"wp-includes\/js\/wp-auth-check.js"}} );
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-auth-check.min.js?ver=6.2.2' id='wp-auth-check-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca' id='wp-dom-ready-js'></script>
    <script id='wp-a11y-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", {"translation-revision-date":"2023-07-03 03:51:18+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"Notifications":["Th\u00f4ng b\u00e1o"]}},"comment":{"reference":"wp-includes\/js\/dist\/a11y.js"}} );
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/a11y.min.js?ver=ecce20f002eda4c19664' id='wp-a11y-js'></script>
    <script id='wp-ajax-response-js-extra'>
        var wpAjax = {"noPerm":"Xin l\u1ed7i, b\u1ea1n kh\u00f4ng \u0111\u01b0\u1ee3c ph\u00e9p l\u00e0m \u0111i\u1ec1u \u0111\u00f3.","broken":"C\u00f3 l\u1ed7i g\u00ec \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-ajax-response.min.js?ver=6.2.2' id='wp-ajax-response-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/jquery.color.min.js?ver=2.2.0' id='jquery-color-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-lists.min.js?ver=6.2.2' id='wp-lists-js'></script>
    <script id='quicktags-js-extra'>
        var quicktagsL10n = {"closeAllOpenTags":"\u0110\u00f3ng t\u1ea5t c\u1ea3 c\u00e1c th\u1ebb","closeTags":"\u0111\u00f3ng th\u1ebb","enterURL":"\u0110i\u1ec1n \u0111\u01b0\u1eddng d\u1eabn","enterImageURL":"\u0110i\u1ec1n \u0111\u01b0\u1eddng d\u1eabn c\u1ee7a \u1ea3nh","enterImageDescription":"\u0110i\u1ec1n m\u00f4 t\u1ea3 c\u1ee7a \u1ea3nh","textdirection":"h\u01b0\u1edbng \u0111\u1ecdc v\u0103n b\u1ea3n","toggleTextdirection":"Chuy\u1ec3n \u0111\u1ed5i h\u01b0\u1edbng \u0111\u1ecdc v\u0103n b\u1ea3n c\u1ee7a b\u1ed9 so\u1ea1n th\u1ea3o","dfw":"Ch\u1ebf \u0111\u1ed9 vi\u1ebft ch\u1ed1ng xao nh\u00e3ng","strong":"\u0110\u1eadm","strongClose":"\u0110\u00f3ng nh\u00e3n \u0111\u1eadm","em":"Nghi\u00eang","emClose":"\u0110\u00f3ng nh\u00e3n nghi\u00eang","link":"Th\u00eam \u0111\u01b0\u1eddng d\u1eabn","blockquote":"Tr\u00edch d\u1eabn","blockquoteClose":"\u0110\u00f3ng nh\u00e3n d\u1ea5u nh\u00e1y k\u00e9p","del":"V\u0103n b\u1ea3n \u0111\u00e3 x\u00f3a (g\u1ea1ch ngang gi\u1eefa ch\u1eef)","delClose":"\u0110\u00f3ng nh\u00e3n v\u0103n b\u1ea3n \u0111\u00e3 x\u00f3a","ins":"V\u0103n b\u1ea3n \u0111\u00e3 ch\u00e8n","insClose":"\u0110\u00f3ng th\u1ebb v\u0103n b\u1ea3n \u0111\u00e3 ch\u00e8n","image":"Ch\u00e8n \u1ea3nh","ul":"Danh s\u00e1ch li\u1ec7t k\u00ea \u0111\u01b0\u1ee3c \u0111\u00e1nh s\u1ed1","ulClose":"\u0110\u00f3ng nh\u00e3n danh s\u00e1ch \u0111\u01b0\u1ee3c k\u00ed hi\u1ec7u","ol":"Danh s\u00e1ch \u0111\u01b0\u1ee3c \u0111\u00e1nh s\u1ed1","olClose":"\u0110\u00f3ng nh\u00e3n danh s\u00e1ch \u0111\u01b0\u1ee3c \u0111\u00e1nh s\u1ed1","li":"M\u1ee5c danh s\u00e1ch","liClose":"\u0110\u00f3ng nh\u00e3n m\u1ee5c danh s\u00e1ch","code":"M\u00e3","codeClose":"\u0110\u00f3ng nh\u00e3n m\u00e3","more":"Ch\u00e8n th\u1ebb \u0110\u1ecdc Th\u00eam"};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/quicktags.min.js?ver=6.2.2' id='quicktags-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/jquery.query.js?ver=2.2.3' id='jquery-query-js'></script>
    <script id='admin-comments-js-extra'>
        var adminCommentsSettings = {"hotkeys_highlight_first":"","hotkeys_highlight_last":""};
    </script>
    <script id='admin-comments-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", {"translation-revision-date":"2022-08-03 11:30:24+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"Are you sure you want to do this?\nThe comment changes you made will be lost.":["B\u1ea1n c\u00f3 ch\u1eafc ch\u1eafn mu\u1ed1n l\u00e0m \u0111i\u1ec1u n\u00e0y?\nNh\u1eefng b\u00ecnh lu\u1eadn m\u00e0 b\u1ea1n thay \u0111\u1ed5i s\u1ebd b\u1ecb m\u1ea5t."],"Are you sure you want to edit this comment?\nThe changes you made will be lost.":["B\u1ea1n c\u00f3 ch\u1eafc mu\u1ed1n s\u1eeda b\u00ecnh lu\u1eadn n\u00e0y?\nC\u00e1c thay \u0111\u1ed5i b\u1ea1n \u0111\u00e3 l\u00e0m s\u1ebd b\u1ecb m\u1ea5t."],"Approve and Reply":["Duy\u1ec7t v\u00e0 Tr\u1ea3 l\u1eddi"],"Comments (%s)":["B\u00ecnh lu\u1eadn (%s)"],"Reply":["Tr\u1ea3 l\u1eddi"],"Comments":["B\u00ecnh lu\u1eadn"]}},"comment":{"reference":"wp-admin\/js\/edit-comments.js"}} );
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/edit-comments.min.js?ver=6.2.2' id='admin-comments-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/draggable.min.js?ver=1.13.2' id='jquery-ui-draggable-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/slider.min.js?ver=1.13.2' id='jquery-ui-slider-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/jquery.ui.touch-punch.js?ver=0.2.2' id='jquery-touch-punch-js'></script>
    <script src='http://localhost/wordpress/wp-admin/js/iris.min.js?ver=1.1.1' id='iris-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/menu.min.js?ver=1.13.2' id='jquery-ui-menu-js'></script>
    <script id='jquery-ui-autocomplete-js-extra'>
        var uiAutocompleteL10n = {"noResults":"Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3.","oneResult":"\u0110\u00e3 t\u00ecm th\u1ea5y 1 k\u1ebft qu\u1ea3. H\u00e3y d\u00f9ng ph\u00edm l\u00ean v\u00e0 xu\u1ed1ng \u0111\u1ec3 di chuy\u1ec3n.","manyResults":"%d k\u1ebft qu\u1ea3 \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y. S\u1eed d\u1ee5ng ph\u00edm l\u00ean \/ xu\u1ed1ng \u0111\u1ec3 xem.","itemSelected":"M\u1ee5c \u0111\u01b0\u1ee3c ch\u1ecdn."};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/autocomplete.min.js?ver=1.13.2' id='jquery-ui-autocomplete-js'></script>
    <script id='wplink-js-extra'>
        var wpLinkL10n = {"title":"Th\u00eam\/S\u1eeda \u0111\u01b0\u1eddng d\u1eabn","update":"C\u1eadp nh\u1eadt","save":"Th\u00eam li\u00ean k\u1ebft","noTitle":"(kh\u00f4ng c\u00f3 ti\u00eau \u0111\u1ec1)","noMatchesFound":"Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3.","linkSelected":"\u0110\u00e3 ch\u1ecdn li\u00ean k\u1ebft.","linkInserted":"\u0110\u00e3 ch\u00e8n li\u00ean k\u1ebft.","minInputLength":"3"};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wplink.min.js?ver=6.2.2' id='wplink-js'></script>

    <script type="text/javascript">
        tinyMCEPreInit = {
            baseURL: "http://localhost/wordpress/wp-includes/js/tinymce",
            suffix: ".min",
            mceInit: {},
            qtInit: {'replycontent':{id:"replycontent",buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,close"}},
            ref: {plugins:"",theme:"modern",language:""},
            load_ext: function(url,lang){var sl=tinymce.ScriptLoader;sl.markDone(url+'/langs/'+lang+'.js');sl.markDone(url+'/langs/'+lang+'_dlg.js');}
        };
    </script>
    <script type="text/javascript">

        ( function() {
            var initialized = [];
            var initialize  = function() {
                var init, id, inPostbox, $wrap;
                var readyState = document.readyState;

                if ( readyState !== 'complete' && readyState !== 'interactive' ) {
                    return;
                }

                for ( id in tinyMCEPreInit.mceInit ) {
                    if ( initialized.indexOf( id ) > -1 ) {
                        continue;
                    }

                    init      = tinyMCEPreInit.mceInit[id];
                    $wrap     = tinymce.$( '#wp-' + id + '-wrap' );
                    inPostbox = $wrap.parents( '.postbox' ).length > 0;

                    if (
                        ! init.wp_skip_init &&
                        ( $wrap.hasClass( 'tmce-active' ) || ! tinyMCEPreInit.qtInit.hasOwnProperty( id ) ) &&
                        ( readyState === 'complete' || ( ! inPostbox && readyState === 'interactive' ) )
                    ) {
                        tinymce.init( init );
                        initialized.push( id );

                        if ( ! window.wpActiveEditor ) {
                            window.wpActiveEditor = id;
                        }
                    }
                }
            }

            if ( typeof tinymce !== 'undefined' ) {
                if ( tinymce.Env.ie && tinymce.Env.ie < 11 ) {
                    tinymce.$( '.wp-editor-wrap ' ).removeClass( 'tmce-active' ).addClass( 'html-active' );
                } else {
                    if ( document.readyState === 'complete' ) {
                        initialize();
                    } else {
                        document.addEventListener( 'readystatechange', initialize );
                    }
                }
            }

            if ( typeof quicktags !== 'undefined' ) {
                for ( id in tinyMCEPreInit.qtInit ) {
                    quicktags( tinyMCEPreInit.qtInit[id] );

                    if ( ! window.wpActiveEditor ) {
                        window.wpActiveEditor = id;
                    }
                }
            }
        }());
    </script>
    <div id="wp-link-backdrop" style="display: none"></div>
    <div id="wp-link-wrap" class="wp-core-ui" style="display: none" role="dialog" aria-labelledby="link-modal-title">
        <form id="wp-link" tabindex="-1">
            <input type="hidden" id="_ajax_linking_nonce" name="_ajax_linking_nonce" value="f79d7c4f6c" />		<h1 id="link-modal-title">Thêm/Sửa đường dẫn</h1>
            <button type="button" id="wp-link-close"><span class="screen-reader-text">
			Đóng		</span></button>
            <div id="link-selector">
                <div id="link-options">
                    <p class="howto" id="wplink-enter-url">Nhập địa chỉ đích</p>
                    <div>
                        <label><span>URL</span>
                            <input id="wp-link-url" type="text" aria-describedby="wplink-enter-url" /></label>
                    </div>
                    <div class="wp-link-text-field">
                        <label><span>Tên đường dẫn</span>
                            <input id="wp-link-text" type="text" /></label>
                    </div>
                    <div class="link-target">
                        <label><span></span>
                            <input type="checkbox" id="wp-link-target" /> Mở liên kết trong 1 thẻ mới</label>
                    </div>
                </div>
                <p class="howto" id="wplink-link-existing-content">Hoặc liên kết đến nội dung đã tồn tại</p>
                <div id="search-panel">
                    <div class="link-search-wrapper">
                        <label>
                            <span class="search-label">Tìm kiếm</span>
                            <input type="search" id="wp-link-search" class="link-search-field" autocomplete="off" aria-describedby="wplink-link-existing-content" />
                            <span class="spinner"></span>
                        </label>
                    </div>
                    <div id="search-results" class="query-results" tabindex="0">
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                    <div id="most-recent-results" class="query-results" tabindex="0">
                        <div class="query-notice" id="query-notice-message">
                            <em class="query-notice-default">Thiếu từ khóa tìm kiếm. Hiển thị các bài viết mới nhất.</em>
                            <em class="query-notice-hint screen-reader-text">
                                Tìm hoặc sử dụng phím mũi tên lên và xuống để chọn một mục. 						</em>
                        </div>
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submitbox">
                <div id="wp-link-cancel">
                    <button type="button" class="button">Hủy</button>
                </div>
                <div id="wp-link-update">
                    <input type="submit" value="Thêm liên kết" class="button button-primary" id="wp-link-submit" name="wp-link-submit">
                </div>
            </div>
        </form>
    </div>

    <div class="clear"></div></div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload==='function')wpOnload();</script>
</body>
</html>

@endsection
