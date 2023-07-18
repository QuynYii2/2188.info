@extends('backend-v2.layouts.master')


@section('content')

        <!DOCTYPE html>
<html class="wp-toolbar"
      lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Product categories &lsaquo; Wordpress &#8212; WordPress</title>
    <script type="text/javascript">
        addLoadEvent = function (func) {
            if (typeof jQuery !== 'undefined') jQuery(function () {
                func();
            }); else if (typeof wpOnload !== 'function') {
                wpOnload = func;
            } else {
                var oldonload = wpOnload;
                wpOnload = function () {
                    oldonload();
                    func();
                }
            }
        };
        var ajaxurl = '/wordpress/wp-admin/admin-ajax.php',
            pagenow = 'edit-product_cat',
            typenow = 'product',
            adminpage = 'edit-tags-php',
            thousandsSeparator = '.',
            decimalPoint = ',',
            isRtl = 0;
    </script>
    <link rel="preload"
          href="http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/components/style.css?ver=7.9.0"
          as="style"/>
    <link rel="preload"
          href="http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/app/style.css?ver=7.9.0"
          as="style"/>
    <link rel="preload"
          href="http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/app/index.js?ver=7.9.0"
          as="script"/>
    <link rel="preload"
          href="http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/components/index.js?ver=7.9.0"
          as="script"/>
    <link rel='dns-prefetch' href='//stats.wp.com'/>
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
    <link rel='stylesheet'
          href='http://localhost/wordpress/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5Bchunk_0%5D=dashicons,admin-bar,common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,wp-pointer,widgets&amp;load%5Bchunk_1%5D=,site-icon,l10n,buttons,wp-auth-check,wp-color-picker,media-views,wp-components&amp;ver=6.2.2'
          media='all'/>
    <link rel='stylesheet' id='acf-global-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/css/acf-global.css?ver=6.1.6'
          media='all'/>
    <link rel='stylesheet' id='woocommerce-twenty-twenty-one-admin-css'
          href='//localhost/wordpress/wp-content/plugins/woocommerce/assets/css/twenty-twenty-one-admin.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='woocommerce_admin_menu_styles-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/menu.css?ver=7.9.0' media='all'/>
    <link rel='stylesheet' id='woocommerce_admin_styles-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/admin.css?ver=7.9.0' media='all'/>
    <link rel='stylesheet' id='jquery-ui-style-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/jquery-ui/jquery-ui.min.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='mediaelement-css'
          href='http://localhost/wordpress/wp-includes/js/mediaelement/mediaelementplayer-legacy.min.css?ver=4.2.17'
          media='all'/>
    <link rel='stylesheet' id='wp-mediaelement-css'
          href='http://localhost/wordpress/wp-includes/js/mediaelement/wp-mediaelement.min.css?ver=6.2.2' media='all'/>
    <link rel='stylesheet' id='imgareaselect-css'
          href='http://localhost/wordpress/wp-includes/js/imgareaselect/imgareaselect.css?ver=0.9.8' media='all'/>
    <link rel='stylesheet' id='wc-components-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/components/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-admin-layout-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/admin-layout/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-customer-effort-score-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/customer-effort-score/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-product-editor-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/product-editor/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-experimental-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/experimental/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-admin-app-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/app/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='wc-onboarding-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/onboarding/style.css?ver=7.9.0'
          media='all'/>
    <link rel='stylesheet' id='acf-input-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/css/acf-input.css?ver=6.1.6'
          media='all'/>
    <link rel='stylesheet' id='acf-pro-input-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/css/pro/acf-pro-input.css?ver=6.1.6'
          media='all'/>
    <link rel='stylesheet' id='select2-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/inc/select2/4/select2.min.css?ver=4.0.13'
          media='all'/>
    <link rel='stylesheet' id='acf-datepicker-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/inc/datepicker/jquery-ui.min.css?ver=1.11.4'
          media='all'/>
    <link rel='stylesheet' id='acf-timepicker-css'
          href='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/inc/timepicker/jquery-ui-timepicker-addon.min.css?ver=1.6.1'
          media='all'/>
    <link rel='stylesheet' id='woocommerce-activation-css'
          href='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/css/activation.css?ver=7.9.0'
          media='all'/>
    <script>
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/",
            "svgExt": ".svg",
            "source": {"concatemoji": "http:\/\/localhost\/wordpress\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.2.2"}
        };
        /*! This file is auto-generated */
        !function (e, a, t) {
            var n, r, o, i = a.createElement("canvas"), p = i.getContext && i.getContext("2d");

            function s(e, t) {
                p.clearRect(0, 0, i.width, i.height), p.fillText(e, 0, 0);
                e = i.toDataURL();
                return p.clearRect(0, 0, i.width, i.height), p.fillText(t, 0, 0), e === i.toDataURL()
            }

            function c(e) {
                var t = a.createElement("script");
                t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
            }

            for (o = Array("flag", "emoji"), t.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, r = 0; r < o.length; r++) t.supports[o[r]] = function (e) {
                if (p && p.fillText) switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
                    case"flag":
                        return s("\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f", "\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f") ? !1 : !s("\ud83c\uddfa\ud83c\uddf3", "\ud83c\uddfa\u200b\ud83c\uddf3") && !s("\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f", "\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");
                    case"emoji":
                        return !s("\ud83e\udef1\ud83c\udffb\u200d\ud83e\udef2\ud83c\udfff", "\ud83e\udef1\ud83c\udffb\u200b\ud83e\udef2\ud83c\udfff")
                }
                return !1
            }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
            t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () {
                t.DOMReady = !0
            }, t.supports.everything || (n = function () {
                t.readyCallback()
            }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () {
                "complete" === a.readyState && t.readyCallback()
            })), (e = t.source || {}).concatemoji ? c(e.concatemoji) : e.wpemoji && e.twemoji && (c(e.twemoji), c(e.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>

    <script>
        /* <![CDATA[ */
        var userSettings = {"url": "\/wordpress\/", "uid": "1", "time": "1689666614", "secure": ""};/* ]]> */
    </script>
    <script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=wp-polyfill-inert,regenerator-runtime,wp-polyfill,wp-hooks,jquery-core,jquery-migrate,utils&amp;ver=6.2.2'></script>
    <script src='https://stats.wp.com/w.js?ver=202329' id='woo-tracks-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/i18n.min.js?ver=9e794f35a71bb98672ae'
            id='wp-i18n-js'></script>
    <script id='wp-i18n-js-after'>
        wp.i18n.setLocaleData({'text direction\u0004ltr': ['ltr']});
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/core.min.js?ver=1.13.2'
            id='jquery-ui-core-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/mouse.min.js?ver=1.13.2'
            id='jquery-ui-mouse-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/draggable.min.js?ver=1.13.2'
            id='jquery-ui-draggable-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/slider.min.js?ver=1.13.2'
            id='jquery-ui-slider-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/jquery.ui.touch-punch.js?ver=0.2.2'
            id='jquery-touch-punch-js'></script>
    <script src='http://localhost/wordpress/wp-admin/js/iris.min.js?ver=1.1.1' id='iris-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70'
            id='jquery-blockui-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/sortable.min.js?ver=1.13.2'
            id='jquery-ui-sortable-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js?ver=7.9.0'
            id='jquery-tiptip-js'></script>
    <script id='woocommerce_admin-js-extra'>
        var woocommerce_admin = {
            "i18n_decimal_error": "Please enter a value with one decimal point (.) without thousand separators.",
            "i18n_mon_decimal_error": "Please enter a value with one monetary decimal point (.) without thousand separators and currency symbols.",
            "i18n_country_iso_error": "Please enter in country code with two capital letters.",
            "i18n_sale_less_than_regular_error": "Please enter in a value less than the regular price.",
            "i18n_delete_product_notice": "This product has produced sales and may be linked to existing orders. Are you sure you want to delete it?",
            "i18n_remove_personal_data_notice": "This action cannot be reversed. Are you sure you wish to erase personal data from the selected orders?",
            "i18n_confirm_delete": "Are you sure you wish to delete this item?",
            "decimal_point": ".",
            "mon_decimal_point": ".",
            "ajax_url": "http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php",
            "strings": {"import_products": "Import", "export_products": "Export"},
            "nonces": {"gateway_toggle": "7de403a408"},
            "urls": {
                "add_product": null,
                "import_products": "http:\/\/localhost\/wordpress\/wp-admin\/edit.php?post_type=product&page=product_importer",
                "export_products": "http:\/\/localhost\/wordpress\/wp-admin\/edit.php?post_type=product&page=product_exporter"
            }
        };
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/woocommerce_admin.min.js?ver=7.9.0'
            id='woocommerce_admin-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.6'
            id='selectWoo-js'></script>
    <script id='wc-enhanced-select-js-extra'>
        var wc_enhanced_select_params = {
            "i18n_no_matches": "No matches found",
            "i18n_ajax_error": "Loading failed",
            "i18n_input_too_short_1": "Please enter 1 or more characters",
            "i18n_input_too_short_n": "Please enter %qty% or more characters",
            "i18n_input_too_long_1": "Please delete 1 character",
            "i18n_input_too_long_n": "Please delete %qty% characters",
            "i18n_selection_too_long_1": "You can only select 1 item",
            "i18n_selection_too_long_n": "You can only select %qty% items",
            "i18n_load_more": "Loading more results\u2026",
            "i18n_searching": "Searching\u2026",
            "ajax_url": "http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php",
            "search_products_nonce": "237c848c22",
            "search_customers_nonce": "83d078d449",
            "search_categories_nonce": "6fe78ff6a1",
            "search_taxonomy_terms_nonce": "0ed80e8699",
            "search_product_attributes_nonce": "7200bfd342",
            "search_pages_nonce": "d2dbc36dae"
        };
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/wc-enhanced-select.min.js?ver=7.9.0'
            id='wc-enhanced-select-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/plupload/moxie.min.js?ver=1.3.5' id='moxiejs-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/plupload/plupload.min.js?ver=2.1.9'
            id='plupload-js'></script>
    <!--[if lt IE 8]>
    <script src='http://localhost/wordpress/wp-includes/js/json2.min.js?ver=2015-05-03' id='json2-js'></script>
    <![endif]-->
    <script id='woocommerce_term_ordering-js-extra'>
        var woocommerce_term_ordering_params = {"taxonomy": "product_cat"};
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/term-ordering.min.js?ver=7.9.0'
            id='woocommerce_term_ordering-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/resizable.min.js?ver=1.13.2'
            id='jquery-ui-resizable-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/js/acf.min.js?ver=6.1.6'
            id='acf-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/js/acf-input.min.js?ver=6.1.6'
            id='acf-input-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/build/js/pro/acf-pro-input.min.js?ver=6.1.6'
            id='acf-pro-input-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/select2/select2.full.min.js?ver=4.0.3'
            id='select2-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.13.2'
            id='jquery-ui-datepicker-js'></script>
    <script id='jquery-ui-datepicker-js-after'>
        jQuery(function (jQuery) {
            jQuery.datepicker.setDefaults({
                "closeText": "\u0110\u00f3ng",
                "currentText": "H\u00f4m nay",
                "monthNames": ["Th\u00e1ng M\u1ed9t", "Th\u00e1ng Hai", "Th\u00e1ng Ba", "Th\u00e1ng T\u01b0", "Th\u00e1ng N\u0103m", "Th\u00e1ng S\u00e1u", "Th\u00e1ng B\u1ea3y", "Th\u00e1ng T\u00e1m", "Th\u00e1ng Ch\u00edn", "Th\u00e1ng M\u01b0\u1eddi", "Th\u00e1ng M\u01b0\u1eddi M\u1ed9t", "Th\u00e1ng M\u01b0\u1eddi Hai"],
                "monthNamesShort": ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
                "nextText": "Ti\u1ebfp theo",
                "prevText": "Quay v\u1ec1",
                "dayNames": ["Ch\u1ee7 Nh\u1eadt", "Th\u1ee9 Hai", "Th\u1ee9 Ba", "Th\u1ee9 T\u01b0", "Th\u1ee9 N\u0103m", "Th\u1ee9 S\u00e1u", "Th\u1ee9 B\u1ea3y"],
                "dayNamesShort": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                "dayNamesMin": ["C", "H", "B", "T", "N", "S", "B"],
                "dateFormat": "MM d, yy",
                "firstDay": 1,
                "isRTL": false
            });
        });
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/inc/timepicker/jquery-ui-timepicker-addon.min.js?ver=1.6.1'
            id='acf-timepicker-js'></script>
    <script id='wp-color-picker-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-08-03 11:30:24+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Clear color": ["Xo\u00e1 m\u00e0u"],
                    "Select default color": ["Ch\u1ecdn m\u00e0u m\u1eb7c \u0111\u1ecbnh"],
                    "Color value": ["M\u00e3 m\u00e0u"],
                    "Select Color": ["Ch\u1ecdn m\u00e0u"],
                    "Clear": ["X\u00f3a"],
                    "Default": ["M\u1eb7c \u0111\u1ecbnh"]
                }
            },
            "comment": {"reference": "wp-admin\/js\/color-picker.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/color-picker.min.js?ver=6.2.2' id='wp-color-picker-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/advanced-custom-fields-pro/assets/inc/color-picker-alpha/wp-color-picker-alpha.js?ver=3.0.0'
            id='acf-color-picker-alpha-js'></script>

    <meta name='apple-itunes-app' content='app-id=1389130815'>
    <script type="text/javascript">var _wpColorScheme = {
            "icons": {
                "base": "#a7aaad",
                "focus": "#72aee6",
                "current": "#fff"
            }
        };</script>
    <link id="wp-admin-canonical" rel="canonical"
          href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product"/>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, document.getElementById('wp-admin-canonical').href + window.location.hash);
        }
    </script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style media="print">#wpadminbar {
            display: none;
        }</style>
</head>
<body class="wp-admin wp-core-ui no-js theme-twentytwentyone  acf-admin-5-3 acf-browser-chrome woocommerce-feature-enabled-activity-panels woocommerce-feature-enabled-analytics woocommerce-feature-enabled-product-block-editor woocommerce-feature-enabled-coupons woocommerce-feature-enabled-core-profiler woocommerce-feature-enabled-customer-effort-score-tracks woocommerce-feature-enabled-import-products-task woocommerce-feature-enabled-experimental-fashion-sample-products woocommerce-feature-enabled-shipping-smart-defaults woocommerce-feature-enabled-shipping-setting-tour woocommerce-feature-enabled-homescreen woocommerce-feature-enabled-marketing woocommerce-feature-enabled-mobile-app-banner woocommerce-feature-enabled-navigation woocommerce-feature-enabled-onboarding woocommerce-feature-enabled-onboarding-tasks woocommerce-feature-enabled-remote-inbox-notifications woocommerce-feature-enabled-remote-free-extensions woocommerce-feature-enabled-payment-gateway-suggestions woocommerce-feature-enabled-shipping-label-banner woocommerce-feature-enabled-subscriptions woocommerce-feature-enabled-store-alerts woocommerce-feature-enabled-transient-notices woocommerce-feature-enabled-woo-mobile-welcome woocommerce-feature-enabled-wc-pay-promotion woocommerce-feature-enabled-wc-pay-welcome-page woocommerce-page woocommerce-embed-page  wc-wp-version-gte-53 wc-wp-version-gte-55 edit-tags-php auto-fold admin-bar post-type-product taxonomy-product_cat branch-6-2 version-6-2-2 admin-color-fresh locale-vi no-customize-support no-svg">
<script type="text/javascript">
    document.body.className = document.body.className.replace('no-js', 'js');
</script>

<script>
    (function () {
        var request, b = document.body, c = 'className', cs = 'customize-support',
            rcs = new RegExp('(^|\\s+)(no-)?' + cs + '(\\s+|$)');

        request = true;

        b[c] = b[c].replace(rcs, ' ');
        // The customizer requires postMessage and CORS (if the site is cross domain).
        b[c] += (window.postMessage && request ? ' ' : ' no-') + cs;
    }());
</script>

<div id="wpwrap">

    <div id="adminmenumain" role="navigation" aria-label="Menu chính">
        <a href="#wpbody-content" class="screen-reader-shortcut">Chuyển đến nội dung chính</a>
        <a href="#wp-toolbar" class="screen-reader-shortcut">Chuyển đến thanh công cụ</a>
        <div id="adminmenuback"></div>
        <div id="adminmenuwrap">
            <ul id="adminmenu">


                <li class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-first menu-top-last"
                    id="menu-dashboard">
                    <a href='index.php'
                       class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-first menu-top-last"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-dashboard' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Bảng tin</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Bảng tin</li>
                        <li class="wp-first-item"><a href='index.php' class="wp-first-item">Trang chủ</a></li>
                        <li><a href='update-core.php'>Cập nhật <span class="update-plugins count-1"><span
                                            class="update-count">1</span></span></a></li>
                    </ul>
                </li>
                <li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true">
                    <div class="separator"></div>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-post open-if-no-js menu-top-first"
                    id="menu-posts">
                    <a href='edit.php'
                       class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-post open-if-no-js menu-top-first"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-post' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Bài viết</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Bài viết</li>
                        <li class="wp-first-item"><a href='edit.php' class="wp-first-item">Tất cả bài viết</a></li>
                        <li><a href='post-new.php'>Viết bài mới</a></li>
                        <li><a href='edit-tags.php?taxonomy=category'>Chuyên mục</a></li>
                        <li><a href='edit-tags.php?taxonomy=post_tag'>Thẻ</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media" id="menu-media">
                    <a href='upload.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-media' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Media</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Media</li>
                        <li class="wp-first-item"><a href='upload.php' class="wp-first-item">Thư viện</a></li>
                        <li><a href='media-new.php'>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" id="menu-pages">
                    <a href='edit.php?post_type=page'
                       class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-page" aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-page' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Trang</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Trang</li>
                        <li class="wp-first-item"><a href='edit.php?post_type=page' class="wp-first-item">Tất cả các
                                trang</a></li>
                        <li><a href='post-new.php?post_type=page'>Thêm trang mới</a></li>
                    </ul>
                </li>
                <li class="wp-not-current-submenu menu-top menu-icon-comments menu-top-last" id="menu-comments">
                    <a href='edit-comments.php'
                       class="wp-not-current-submenu menu-top menu-icon-comments menu-top-last">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-comments' aria-hidden='true'><br/>
                        </div>
                        <div class='wp-menu-name'>Phản hồi <span class="awaiting-mod count-0"><span
                                        class="pending-count" aria-hidden="true">0</span><span
                                        class="comments-in-moderation-text screen-reader-text">0 bình luận cần kiểm duyệt</span></span>
                        </div>
                    </a></li>
                <li class="wp-not-current-submenu wp-menu-separator woocommerce" aria-hidden="true">
                    <div class="separator"></div>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce menu-top-first"
                    id="toplevel_page_woocommerce"><a href='admin.php?page=wc-admin'
                                                      class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce menu-top-first"
                                                      aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image svg'
                             style="background-image:url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDI0IDEwMjQiPjxwYXRoIGZpbGw9IiNhMmFhYjIiIGQ9Ik02MTIuMTkyIDQyNi4zMzZjMC02Ljg5Ni0zLjEzNi01MS42LTI4LTUxLjYtMzcuMzYgMC00Ni43MDQgNzIuMjU2LTQ2LjcwNCA4Mi42MjQgMCAzLjQwOCAzLjE1MiA1OC40OTYgMjguMDMyIDU4LjQ5NiAzNC4xOTItLjAzMiA0Ni42NzItNzIuMjg4IDQ2LjY3Mi04OS41MnptMjAyLjE5MiAwYzAtNi44OTYtMy4xNTItNTEuNi0yOC4wMzItNTEuNi0zNy4yOCAwLTQ2LjYwOCA3Mi4yNTYtNDYuNjA4IDgyLjYyNCAwIDMuNDA4IDMuMDcyIDU4LjQ5NiAyNy45NTIgNTguNDk2IDM0LjE5Mi0uMDMyIDQ2LjY4OC03Mi4yODggNDYuNjg4LTg5LjUyek0xNDEuMjk2Ljc2OGMtNjguMjI0IDAtMTIzLjUwNCA1NS40ODgtMTIzLjUwNCAxMjMuOTJ2NjUwLjcyYzAgNjguNDMyIDU1LjI5NiAxMjMuOTIgMTIzLjUwNCAxMjMuOTJoMzM5LjgwOGwxMjMuNTA0IDEyMy45MzZWODk5LjMyOGgyNzguMDQ4YzY4LjIyNCAwIDEyMy41Mi01NS40NzIgMTIzLjUyLTEyMy45MnYtNjUwLjcyYzAtNjguNDMyLTU1LjI5Ni0xMjMuOTItMTIzLjUyLTEyMy45MmgtNzQxLjM2em01MjYuODY0IDQyMi4xNmMwIDU1LjA4OC0zMS4wODggMTU0Ljg4LTEwMi42NCAxNTQuODgtNi4yMDggMC0xOC40OTYtMy42MTYtMjUuNDI0LTYuMDE2LTMyLjUxMi0xMS4xNjgtNTAuMTkyLTQ5LjY5Ni01Mi4zNTItNjYuMjU2IDAgMC0zLjA3Mi0xNy43OTItMy4wNzItNDAuNzUyIDAtMjIuOTkyIDMuMDcyLTQ1LjMyOCAzLjA3Mi00NS4zMjggMTUuNTUyLTc1LjcyOCA0My41NTItMTA2LjczNiA5Ni40NDgtMTA2LjczNiA1OS4wNzItLjAzMiA4My45NjggNTguNTI4IDgzLjk2OCAxMTAuMjA4ek00ODYuNDk2IDMwMi40YzAgMy4zOTItNDMuNTUyIDE0MS4xNjgtNDMuNTUyIDIxMy40MjR2NzUuNzEyYy0yLjU5MiAxMi4wOC00LjE2IDI0LjE0NC0yMS44MjQgMjQuMTQ0LTQ2LjYwOCAwLTg4Ljg4LTE1MS40NzItOTIuMDE2LTE2MS44NC02LjIwOCA2Ljg5Ni02Mi4yNCAxNjEuODQtOTYuNDQ4IDE2MS44NC0yNC44NjQgMC00My41NTItMTEzLjY0OC00Ni42MDgtMTIzLjkzNkMxNzYuNzA0IDQzNi42NzIgMTYwIDMzNC4yMjQgMTYwIDMyNy4zMjhjMC0yMC42NzIgMS4xNTItMzguNzM2IDI2LjA0OC0zOC43MzYgNi4yMDggMCAyMS42IDYuMDY0IDIzLjcxMiAxNy4xNjggMTEuNjQ4IDYyLjAzMiAxNi42ODggMTIwLjUxMiAyOS4xNjggMTg1Ljk2OCAxLjg1NiAyLjkyOCAxLjUwNCA3LjAwOCA0LjU2IDEwLjQzMiAzLjE1Mi0xMC4yODggNjYuOTI4LTE2OC43ODQgOTQuOTYtMTY4Ljc4NCAyMi41NDQgMCAzMC40IDQ0LjU5MiAzMy41MzYgNjEuODI0IDYuMjA4IDIwLjY1NiAxMy4wODggNTUuMjE2IDIyLjQxNiA4Mi43NTIgMC0xMy43NzYgMTIuNDgtMjAzLjEyIDY1LjM5Mi0yMDMuMTIgMTguNTkyLjAzMiAyNi43MDQgNi45MjggMjYuNzA0IDI3LjU2OHpNODcwLjMyIDQyMi45MjhjMCA1NS4wODgtMzEuMDg4IDE1NC44OC0xMDIuNjQgMTU0Ljg4LTYuMTkyIDAtMTguNDQ4LTMuNjE2LTI1LjQyNC02LjAxNi0zMi40MzItMTEuMTY4LTUwLjE3Ni00OS42OTYtNTIuMjg4LTY2LjI1NiAwIDAtMy44ODgtMTcuOTItMy44ODgtNDAuODk2czMuODg4LTQ1LjE4NCAzLjg4OC00NS4xODRjMTUuNTUyLTc1LjcyOCA0My40ODgtMTA2LjczNiA5Ni4zODQtMTA2LjczNiA1OS4xMDQtLjAzMiA4My45NjggNTguNTI4IDgzLjk2OCAxMTAuMjA4eiIvPjwvc3ZnPg==')"
                             aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>WooCommerce</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>WooCommerce</li>
                        <li class="wp-first-item"><a href='admin.php?page=wc-admin' class="wp-first-item">Home <span
                                        class="awaiting-mod update-plugins remaining-tasks-badge count-4">4</span></a>
                        </li>
                        <li><a href='edit.php?post_type=shop_order'>Orders</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/customers'>Customers</a></li>
                        <li><a href='admin.php?page=coupons-moved'>Coupons</a></li>
                        <li><a href='admin.php?page=wc-reports'>Reports</a></li>
                        <li><a href='admin.php?page=wc-settings'>Settings</a></li>
                        <li><a href='admin.php?page=wc-status'>Status</a></li>
                        <li><a href='admin.php?page=wc-addons'>Extensions </a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-product"
                    id="menu-posts-product">
                    <a href='edit.php?post_type=product'
                       class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-product">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-archive' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Products</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Products</li>
                        <li class="wp-first-item"><a href='edit.php?post_type=product' class="wp-first-item">All
                                Products</a></li>
                        <li><a href='post-new.php?post_type=product'>Add New</a></li>
                        <li class="current"><a href='edit-tags.php?taxonomy=product_cat&amp;post_type=product'
                                               class="current" aria-current="page">Categories</a></li>
                        <li><a href='edit-tags.php?taxonomy=product_tag&amp;post_type=product'>Tags</a></li>
                        <li><a href='edit.php?post_type=product&#038;page=product_attributes'>Attributes</a></li>
                        <li><a href='edit.php?post_type=product&#038;page=product-reviews'>Reviews</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wc-admin&amp;path=/analytics/overview"
                    id="toplevel_page_wc-admin-path--analytics-overview"><a
                            href='admin.php?page=wc-admin&path=/analytics/overview'
                            class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_wc-admin&amp;path=/analytics/overview"
                            aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-chart-bar' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Analytics</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Analytics</li>
                        <li class="wp-first-item"><a href='admin.php?page=wc-admin&#038;path=/analytics/overview'
                                                     class="wp-first-item">Overview</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/products'>Products</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/revenue'>Revenue</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/orders'>Orders</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/variations'>Variations</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/categories'>Categories</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/coupons'>Coupons</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/taxes'>Taxes</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/downloads'>Downloads</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/stock'>Stock</a></li>
                        <li><a href='admin.php?page=wc-admin&#038;path=/analytics/settings'>Settings</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce-marketing menu-top-last"
                    id="toplevel_page_woocommerce-marketing">
                    <a href='admin.php?page=wc-admin&path=/marketing'
                       class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_woocommerce-marketing menu-top-last"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-megaphone' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Marketing</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Marketing</li>
                        <li class="wp-first-item"><a href='admin.php?page=wc-admin&path=/marketing'
                                                     class="wp-first-item">Overview</a></li>
                        <li><a href='edit.php?post_type=shop_coupon'>Coupons</a></li>
                    </ul>
                </li>
                <li class="wp-not-current-submenu wp-menu-separator" aria-hidden="true">
                    <div class="separator"></div>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first"
                    id="menu-appearance">
                    <a href='themes.php'
                       class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-appearance menu-top-first"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-appearance' aria-hidden='true'><br/>
                        </div>
                        <div class='wp-menu-name'>Giao diện</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Giao diện</li>
                        <li class="wp-first-item"><a href='themes.php' class="wp-first-item">Giao diện <span
                                        class="update-plugins count-0"><span class="theme-count">0</span></span></a>
                        </li>
                        <li class="hide-if-no-customize"><a
                                    href='customize.php?return=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct'
                                    class="hide-if-no-customize">Tùy biến</a></li>
                        <li><a href='widgets.php'>Widget</a></li>
                        <li><a href='nav-menus.php'>Menu</a></li>
                        <li class="hide-if-no-customize"><a
                                    href='customize.php?return=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&#038;autofocus%5Bcontrol%5D=background_image'
                                    class="hide-if-no-customize">Nền</a></li>
                        <li><a href='themes.php?page=custom-background'>Nền</a></li>
                        <li><a href='theme-editor.php'>Theme File Editor</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins" id="menu-plugins">
                    <a href='plugins.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-plugins"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-plugins' aria-hidden='true'><br/>
                        </div>
                        <div class='wp-menu-name'>Plugin <span class="update-plugins count-0"><span
                                        class="plugin-count">0</span></span></div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Plugin <span class="update-plugins count-0"><span
                                        class="plugin-count">0</span></span></li>
                        <li class="wp-first-item"><a href='plugins.php' class="wp-first-item">Plugin đã cài đặt</a></li>
                        <li><a href='plugin-install.php'>Cài mới</a></li>
                        <li><a href='plugin-editor.php'>Plugin File Editor</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users" id="menu-users">
                    <a href='users.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-users"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-users' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Thành viên</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Thành viên</li>
                        <li class="wp-first-item"><a href='users.php' class="wp-first-item">Tất cả người dùng</a></li>
                        <li><a href='user-new.php'>Thêm mới</a></li>
                        <li><a href='profile.php'>Hồ sơ</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools" id="menu-tools">
                    <a href='tools.php' class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-tools"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-tools' aria-hidden='true'><br/></div>
                        <div class='wp-menu-name'>Công cụ</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Công cụ</li>
                        <li class="wp-first-item"><a href='tools.php' class="wp-first-item">Các công cụ</a></li>
                        <li><a href='import.php'>Nhập</a></li>
                        <li><a href='export.php'>Xuất ra</a></li>
                        <li><a href='site-health.php'>Site Health <span
                                        class="menu-counter site-health-counter count-0"><span
                                            class="count">0</span></span></a></li>
                        <li><a href='export-personal-data.php'>Xuất dữ liệu cá nhân</a></li>
                        <li><a href='erase-personal-data.php'>Xóa dữ liệu cá nhân</a></li>
                        <li><a href='tools.php?page=action-scheduler'>Scheduled Actions</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings" id="menu-settings">
                    <a href='options-general.php'
                       class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-settings" aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-admin-settings' aria-hidden='true'><br/>
                        </div>
                        <div class='wp-menu-name'>Cài đặt</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>Cài đặt</li>
                        <li class="wp-first-item"><a href='options-general.php' class="wp-first-item">Tổng quan</a></li>
                        <li><a href='options-writing.php'>Viết</a></li>
                        <li><a href='options-reading.php'>Đọc</a></li>
                        <li><a href='options-discussion.php'>Thảo luận</a></li>
                        <li><a href='options-media.php'>Media</a></li>
                        <li><a href='options-permalink.php'>Đường dẫn tĩnh</a></li>
                        <li><a href='options-privacy.php'>Riêng tư</a></li>
                    </ul>
                </li>
                <li class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_edit?post_type=acf-field-group menu-top-last"
                    id="toplevel_page_edit-post_type-acf-field-group">
                    <a href='edit.php?post_type=acf-field-group'
                       class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_edit?post_type=acf-field-group menu-top-last"
                       aria-haspopup="true">
                        <div class="wp-menu-arrow">
                            <div></div>
                        </div>
                        <div class='wp-menu-image dashicons-before dashicons-welcome-widgets-menus' aria-hidden='true'>
                            <br/></div>
                        <div class='wp-menu-name'>ACF</div>
                    </a>
                    <ul class='wp-submenu wp-submenu-wrap'>
                        <li class='wp-submenu-head' aria-hidden='true'>ACF</li>
                        <li class="wp-first-item"><a href='edit.php?post_type=acf-field-group' class="wp-first-item">Field
                                Groups</a></li>
                        <li><a href='edit.php?post_type=acf-post-type'>Post Types</a></li>
                        <li><a href='edit.php?post_type=acf-taxonomy'>Taxonomies</a></li>
                        <li><a href='edit.php?post_type=acf-field-group&#038;page=acf-tools'>Tools</a></li>
                        <li><a href='edit.php?post_type=acf-field-group&#038;page=acf-settings-updates'>Updates</a></li>
                    </ul>
                </li>
                <li id="collapse-menu" class="hide-if-no-js">
                    <button type="button" id="collapse-button" aria-label="Thu nhỏ menu chính" aria-expanded="true">
                        <span class="collapse-button-icon" aria-hidden="true"></span><span
                                class="collapse-button-label">Thu gọn menu</span></button>
                </li>
            </ul>
        </div>
    </div>
    <div id="wpcontent">

        <div id="wpadminbar" class="nojq nojs">
            <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Thanh công cụ">
                <ul id='wp-admin-bar-root-default' class="ab-top-menu">
                    <li id='wp-admin-bar-menu-toggle'><a class='ab-item' href='#'><span class="ab-icon"
                                                                                        aria-hidden="true"></span><span
                                    class="screen-reader-text">Menu</span></a></li>
                    <li id='wp-admin-bar-wp-logo' class="menupop"><a class='ab-item' aria-haspopup="true"
                                                                     href='http://localhost/wordpress/wp-admin/about.php'><span
                                    class="ab-icon" aria-hidden="true"></span><span class="screen-reader-text">Giới thiệu về WordPress</span></a>
                        <div class="ab-sub-wrapper">
                            <ul id='wp-admin-bar-wp-logo-default' class="ab-submenu">
                                <li id='wp-admin-bar-about'><a class='ab-item'
                                                               href='http://localhost/wordpress/wp-admin/about.php'>Giới
                                        thiệu về WordPress</a></li>
                            </ul>
                            <ul id='wp-admin-bar-wp-logo-external' class="ab-sub-secondary ab-submenu">
                                <li id='wp-admin-bar-wporg'><a class='ab-item' href='https://vi.wordpress.org/'>WordPress.org</a>
                                </li>
                                <li id='wp-admin-bar-documentation'><a class='ab-item'
                                                                       href='https://wordpress.org/documentation/'>Tài
                                        liệu</a></li>
                                <li id='wp-admin-bar-support-forums'><a class='ab-item'
                                                                        href='https://wordpress.org/support/forums/'>Hỗ
                                        trợ</a></li>
                                <li id='wp-admin-bar-feedback'><a class='ab-item'
                                                                  href='https://wordpress.org/support/forum/requests-and-feedback'>Thông
                                        tin phản hồi</a></li>
                            </ul>
                        </div>
                    </li>
                    <li id='wp-admin-bar-site-name' class="menupop"><a class='ab-item' aria-haspopup="true"
                                                                       href='http://localhost/wordpress/'>Wordpress</a>
                        <div class="ab-sub-wrapper">
                            <ul id='wp-admin-bar-site-name-default' class="ab-submenu">
                                <li id='wp-admin-bar-view-site'><a class='ab-item' href='http://localhost/wordpress/'>Xem
                                        trang</a></li>
                                <li id='wp-admin-bar-view-store'><a class='ab-item'
                                                                    href='http://localhost/wordpress/shop/'>Visit
                                        Store</a></li>
                            </ul>
                        </div>
                    </li>
                    <li id='wp-admin-bar-updates'><a class='ab-item'
                                                     href='http://localhost/wordpress/wp-admin/update-core.php'><span
                                    class="ab-icon" aria-hidden="true"></span><span class="ab-label" aria-hidden="true">1</span><span
                                    class="screen-reader-text updates-available-text">1 cập nhật mới</span></a></li>
                    <li id='wp-admin-bar-comments'><a class='ab-item'
                                                      href='http://localhost/wordpress/wp-admin/edit-comments.php'><span
                                    class="ab-icon" aria-hidden="true"></span><span
                                    class="ab-label awaiting-mod pending-count count-0" aria-hidden="true">0</span><span
                                    class="screen-reader-text comments-in-moderation-text">0 bình luận cần kiểm duyệt</span></a>
                    </li>
                    <li id='wp-admin-bar-new-content' class="menupop"><a class='ab-item' aria-haspopup="true"
                                                                         href='http://localhost/wordpress/wp-admin/post-new.php'><span
                                    class="ab-icon" aria-hidden="true"></span><span class="ab-label">Mới</span></a>
                        <div class="ab-sub-wrapper">
                            <ul id='wp-admin-bar-new-content-default' class="ab-submenu">
                                <li id='wp-admin-bar-new-post'><a class='ab-item'
                                                                  href='http://localhost/wordpress/wp-admin/post-new.php'>Bài
                                        viết</a></li>
                                <li id='wp-admin-bar-new-media'><a class='ab-item'
                                                                   href='http://localhost/wordpress/wp-admin/media-new.php'>Tập
                                        tin</a></li>
                                <li id='wp-admin-bar-new-page'><a class='ab-item'
                                                                  href='http://localhost/wordpress/wp-admin/post-new.php?post_type=page'>Trang</a>
                                </li>
                                <li id='wp-admin-bar-new-product'><a class='ab-item'
                                                                     href='http://localhost/wordpress/wp-admin/post-new.php?post_type=product'>Product</a>
                                </li>
                                <li id='wp-admin-bar-new-shop_order'><a class='ab-item'
                                                                        href='http://localhost/wordpress/wp-admin/post-new.php?post_type=shop_order'>Order</a>
                                </li>
                                <li id='wp-admin-bar-new-shop_coupon'><a class='ab-item'
                                                                         href='http://localhost/wordpress/wp-admin/post-new.php?post_type=shop_coupon'>Coupon</a>
                                </li>
                                <li id='wp-admin-bar-new-user'><a class='ab-item'
                                                                  href='http://localhost/wordpress/wp-admin/user-new.php'>Thành
                                        viên</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul id='wp-admin-bar-top-secondary' class="ab-top-secondary ab-top-menu">
                    <li id='wp-admin-bar-my-account' class="menupop with-avatar"><a class='ab-item' aria-haspopup="true"
                                                                                    href='http://localhost/wordpress/wp-admin/profile.php'>Chào,
                            <span class="display-name">root</span><img alt=''
                                                                       src='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=26&#038;d=mm&#038;r=g'
                                                                       srcset='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=52&#038;d=mm&#038;r=g 2x'
                                                                       class='avatar avatar-26 photo' height='26'
                                                                       width='26' loading='lazy' decoding='async'/></a>
                        <div class="ab-sub-wrapper">
                            <ul id='wp-admin-bar-user-actions' class="ab-submenu">
                                <li id='wp-admin-bar-user-info'><a class='ab-item' tabindex="-1"
                                                                   href='http://localhost/wordpress/wp-admin/profile.php'><img
                                                alt=''
                                                src='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=64&#038;d=mm&#038;r=g'
                                                srcset='http://0.gravatar.com/avatar/f9ce72f769705888cbf794370e57ea10?s=128&#038;d=mm&#038;r=g 2x'
                                                class='avatar avatar-64 photo' height='64' width='64' loading='lazy'
                                                decoding='async'/><span class='display-name'>root</span></a></li>
                                <li id='wp-admin-bar-edit-profile'><a class='ab-item'
                                                                      href='http://localhost/wordpress/wp-admin/profile.php'>Sửa
                                        Hồ sơ</a></li>
                                <li id='wp-admin-bar-logout'><a class='ab-item'
                                                                href='http://localhost/wordpress/wp-login.php?action=logout&#038;_wpnonce=7c6248b21e'>Đăng
                                        xuất</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="screen-reader-shortcut"
               href="http://localhost/wordpress/wp-login.php?action=logout&#038;_wpnonce=7c6248b21e">Đăng xuất</a>
        </div>

        <div id="woocommerce-embedded-root" class="is-embed-loading">
            <div class="woocommerce-layout">
                <div class="woocommerce-layout__header is-embed-loading">
                    <h1 class="woocommerce-layout__header-heading">
                        Product categories </h1>
                </div>
            </div>
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
                                        <a href="#tab-panel-woocommerce_support_tab"
                                           aria-controls="tab-panel-woocommerce_support_tab">
                                            Help &amp; Support </a>
                                    </li>

                                    <li id="tab-link-woocommerce_bugs_tab">
                                        <a href="#tab-panel-woocommerce_bugs_tab"
                                           aria-controls="tab-panel-woocommerce_bugs_tab">
                                            Found a bug? </a>
                                    </li>

                                    <li id="tab-link-woocommerce_onboard_tab">
                                        <a href="#tab-panel-woocommerce_onboard_tab"
                                           aria-controls="tab-panel-woocommerce_onboard_tab">
                                            Setup wizard </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="contextual-help-sidebar">
                                <p><strong>For more information:</strong></p>
                                <p>
                                    <a href="https://woocommerce.com/?utm_source=helptab&utm_medium=product&utm_content=about&utm_campaign=woocommerceplugin"
                                       target="_blank">About WooCommerce</a></p>
                                <p><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WordPress.org
                                        project</a></p>
                                <p><a href="https://github.com/woocommerce/woocommerce/" target="_blank">GitHub
                                        project</a></p>
                                <p>
                                    <a href="https://woocommerce.com/storefront/?utm_source=helptab&utm_medium=product&utm_content=wcthemes&utm_campaign=woocommerceplugin"
                                       target="_blank">Official theme</a></p>
                                <p>
                                    <a href="https://woocommerce.com/product-category/woocommerce-extensions/?utm_source=helptab&utm_medium=product&utm_content=wcextensions&utm_campaign=woocommerceplugin"
                                       target="_blank">Official extensions</a></p></div>

                            <div class="contextual-help-tabs-wrap">

                                <div id="tab-panel-woocommerce_support_tab" class="help-tab-content active">
                                    <h2>Help &amp; Support</h2>
                                    <p>Should you need help understanding, using, or extending WooCommerce, <a
                                                href="https://docs.woocommerce.com/documentation/plugins/woocommerce/?utm_source=helptab&utm_medium=product&utm_content=docs&utm_campaign=woocommerceplugin">please
                                            read our documentation</a>. You will find all kinds of resources including
                                        snippets, tutorials and much more.</p>
                                    <p>For further assistance with WooCommerce core, use the <a
                                                href="https://wordpress.org/support/plugin/woocommerce">community
                                            forum</a>. For help with premium extensions sold on WooCommerce.com, <a
                                                href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&utm_medium=product&utm_content=tickets&utm_campaign=woocommerceplugin">open
                                            a support request at WooCommerce.com</a>.</p>
                                    <p>Before asking for help, we recommend checking the system status page to identify
                                        any problems with your configuration.</p>
                                    <p><a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status"
                                          class="button button-primary">System status</a> <a
                                                href="https://wordpress.org/support/plugin/woocommerce" class="button">Community
                                            forum</a> <a
                                                href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&utm_medium=product&utm_content=tickets&utm_campaign=woocommerceplugin"
                                                class="button">WooCommerce.com support</a></p></div>

                                <div id="tab-panel-woocommerce_bugs_tab" class="help-tab-content">
                                    <h2>Found a bug?</h2>
                                    <p>If you find a bug within WooCommerce core you can create a ticket via <a
                                                href="https://github.com/woocommerce/woocommerce/issues?state=open">GitHub
                                            issues</a>. Ensure you read the <a
                                                href="https://github.com/woocommerce/woocommerce/blob/trunk/.github/CONTRIBUTING.md">contribution
                                            guide</a> prior to submitting your report. To help us solve your issue,
                                        please be as descriptive as possible and include your <a
                                                href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status">system
                                            status report</a>.</p>
                                    <p>
                                        <a href="https://github.com/woocommerce/woocommerce/issues/new?assignees=&labels=&template=1-bug-report.yml"
                                           class="button button-primary">Report a bug</a> <a
                                                href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status"
                                                class="button">System status</a></p></div>

                                <div id="tab-panel-woocommerce_onboard_tab" class="help-tab-content">
                                    <h2>WooCommerce Onboarding</h2>
                                    <h3>Profile Setup Wizard</h3>
                                    <p>If you need to access the setup wizard again, please click on the button
                                        below.</p>
                                    <p>
                                        <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&path=/setup-wizard"
                                           class="button button-primary">Setup wizard</a></p>
                                    <h3>Task List</h3>
                                    <p>If you need to enable or disable the task lists, please click on the button
                                        below.</p>
                                    <p>
                                        <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&reset_task_list=0"
                                           class="button button-primary">Disable</a></p>
                                    <h3>Extended task List</h3>
                                    <p>If you need to enable or disable the extended task lists, please click on the
                                        button below.</p>
                                    <p>
                                        <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&reset_extended_task_list=0"
                                           class="button button-primary">Disable</a></p></div>
                            </div>
                        </div>
                    </div>
                    <div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="Khung Tùy Biến Màn Hình">
                        <form id='adv-settings' method='post'>
                            <fieldset class="metabox-prefs">
                                <legend>Cột</legend>
                                <label><input class="hide-column-tog" name="thumb-hide" type="checkbox" id="thumb-hide"
                                              value="thumb" checked='checked'/>Image</label>
                                <label><input class="hide-column-tog" name="description-hide" type="checkbox"
                                              id="description-hide" value="description" checked='checked'/>Mô tả</label>
                                <label><input class="hide-column-tog" name="slug-hide" type="checkbox" id="slug-hide"
                                              value="slug" checked='checked'/>Đường dẫn</label>
                                <label><input class="hide-column-tog" name="posts-hide" type="checkbox" id="posts-hide"
                                              value="posts" checked='checked'/>Lượt</label>
                            </fieldset>
                            <fieldset class="screen-options">
                                <legend>Phân trang</legend>
                                <label for="edit_product_cat_per_page">Số đối tượng trên một trang.</label>
                                <input type="number" step="1" min="1" max="999" class="screen-per-page"
                                       name="wp_screen_options[value]"
                                       id="edit_product_cat_per_page" maxlength="3"
                                       value="20"/>
                                <input type="hidden" name="wp_screen_options[option]"
                                       value="edit_product_cat_per_page"/>
                            </fieldset>
                            <p class="submit"><input type="submit" name="screen-options-apply" id="screen-options-apply"
                                                     class="button button-primary" value="Áp dụng"/></p>
                            <input type="hidden" id="screenoptionnonce" name="screenoptionnonce" value="2a733e0c63"/>
                        </form>
                    </div>
                </div>
                <div id="screen-meta-links">
                    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
                        <button type="button" id="show-settings-link" class="button show-settings"
                                aria-controls="screen-options-wrap" aria-expanded="false">Tùy chọn hiển thị
                        </button>
                    </div>
                    <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
                        <button type="button" id="contextual-help-link" class="button show-settings"
                                aria-controls="contextual-help-wrap" aria-expanded="false">Trợ giúp
                        </button>
                    </div>
                </div>
                <div class="woocommerce-layout__jitm" id="jp-admin-notices"></div>
                <div class="woocommerce-layout__notice-list-hide" id="wp__notice-list">
                    <div id="message" class="updated woocommerce-message">
                        <a class="woocommerce-message-close notice-dismiss"
                           href="/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;wc-hide-notice=no_secure_connection&#038;_wc_notice_nonce=cf3fdcc69b">Dismiss</a>

                        <p>
                            Your store does not appear to be using a secure connection. We highly recommend serving your
                            entire website over an HTTPS connection to help keep customer data secure. <a
                                    href="https://docs.woocommerce.com/document/ssl-and-https/">Learn more here.</a></p>
                    </div>
                </div>
                <div class="wrap nosubsub">
                    <h1 class="wp-heading-inline">Product categories</h1>


                    <hr class="wp-header-end">

                    <div id="ajax-response"></div>

                    <form class="search-form wp-clearfix" method="get">
                        <input type="hidden" name="taxonomy" value="product_cat"/>
                        <input type="hidden" name="post_type" value="product"/>

                        <p class="search-box">
                            <label class="screen-reader-text" for="tag-search-input">Search categories:</label>
                            <input type="search" id="tag-search-input" name="s" value=""/>
                            <input type="submit" id="search-submit" class="button" value="Search categories"/></p>

                    </form>

                    <div id="col-container" class="wp-clearfix">

                        <div id="col-left">
                            <div class="col-wrap">

                                <p>Product categories for your store can be managed here. To change the order of
                                    categories on the front-end you can drag and drop to sort them. To see more
                                    categories listed click the "screen options" link at the top-right of this page.</p>

                                <div class="form-wrap">
                                    <h2>Add new category</h2>
                                    <form id="addtag" method="post" action="edit-tags.php" class="validate"
                                    >
                                        <input type="hidden" name="action" value="add-tag"/>
                                        <input type="hidden" name="screen" value="edit-product_cat"/>
                                        <input type="hidden" name="taxonomy" value="product_cat"/>
                                        <input type="hidden" name="post_type" value="product"/>
                                        <input type="hidden" id="_wpnonce_add-tag" name="_wpnonce_add-tag"
                                               value="c048b9f8ac"/><input type="hidden" name="_wp_http_referer"
                                                                          value="/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product"/>
                                        <div class="form-field form-required term-name-wrap">
                                            <label for="tag-name">Tên</label>
                                            <input name="tag-name" id="tag-name" type="text" value="" size="40"
                                                   aria-required="true" aria-describedby="name-description"/>
                                            <p id="name-description">The name is how it appears on your site.</p>
                                        </div>
                                        <div class="form-field term-slug-wrap">
                                            <label for="tag-slug">Đường dẫn</label>
                                            <input name="slug" id="tag-slug" type="text" value="" size="40"
                                                   aria-describedby="slug-description"/>
                                            <p id="slug-description">&#8220;slug&#8221; là đường dẫn thân thiện của tên.
                                                Nó thường chỉ bao gồm kí tự viết thường, số và dấu gạch ngang, không
                                                dùng tiếng Việt.</p>
                                        </div>
                                        <div class="form-field term-parent-wrap">
                                            <label for="parent">Parent category</label>
                                            <select name='parent' id='parent' class='postform'
                                                    aria-describedby="parent-description">
                                                <option value='-1'>Trống</option>
                                                <option class="level-0" value="19">gì cơ</option>
                                                <option class="level-0" value="18">Uncategorized</option>
                                            </select>
                                            <p id="parent-description">Chỉ định một chuyên mục cha để tạo đa cấp. Chẳng
                                                hạn, chuyên mục Nhạc sẽ là chuyên mục cha của Hiphop và Jazz.</p>
                                        </div>
                                        <div class="form-field term-description-wrap">
                                            <label for="tag-description">Mô tả</label>
                                            <textarea name="description" id="tag-description" rows="5" cols="40"
                                                      aria-describedby="description-description"></textarea>
                                            <p id="description-description">The description is not prominent by default;
                                                however, some themes may show it.</p>
                                        </div>

                                        <div class="form-field term-display-type-wrap">
                                            <label for="display_type">Display type</label>
                                            <select id="display_type" name="display_type" class="postform">
                                                <option value="">Default</option>
                                                <option value="products">Products</option>
                                                <option value="subcategories">Subcategories</option>
                                                <option value="both">Both</option>
                                            </select>
                                        </div>
                                        <div class="form-field term-thumbnail-wrap">
                                            <label>Thumbnail</label>
                                            <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;">
                                                <img src="http://localhost/wordpress/wp-content/uploads/woocommerce-placeholder.png"
                                                     width="60px" height="60px"/></div>
                                            <div style="line-height: 60px;">
                                                <input type="hidden" id="product_cat_thumbnail_id"
                                                       name="product_cat_thumbnail_id"/>
                                                <button type="button" class="upload_image_button button">Upload/Add
                                                    image
                                                </button>
                                                <button type="button" class="remove_image_button button">Remove image
                                                </button>
                                            </div>
                                            <script type="text/javascript">

                                                // Only show the "remove image" button when needed
                                                if (!jQuery('#product_cat_thumbnail_id').val()) {
                                                    jQuery('.remove_image_button').hide();
                                                }

                                                // Uploading files
                                                var file_frame;

                                                jQuery(document).on('click', '.upload_image_button', function (event) {

                                                    event.preventDefault();

                                                    // If the media frame already exists, reopen it.
                                                    if (file_frame) {
                                                        file_frame.open();
                                                        return;
                                                    }

                                                    // Create the media frame.
                                                    file_frame = wp.media.frames.downloadable_file = wp.media({
                                                        title: 'Choose an image',
                                                        button: {
                                                            text: 'Use image'
                                                        },
                                                        multiple: false
                                                    });

                                                    // When an image is selected, run a callback.
                                                    file_frame.on('select', function () {
                                                        var attachment = file_frame.state().get('selection').first().toJSON();
                                                        var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                                                        jQuery('#product_cat_thumbnail_id').val(attachment.id);
                                                        jQuery('#product_cat_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                                                        jQuery('.remove_image_button').show();
                                                    });

                                                    // Finally, open the modal.
                                                    file_frame.open();
                                                });

                                                jQuery(document).on('click', '.remove_image_button', function () {
                                                    jQuery('#product_cat_thumbnail').find('img').attr('src', 'http://localhost/wordpress/wp-content/uploads/woocommerce-placeholder.png');
                                                    jQuery('#product_cat_thumbnail_id').val('');
                                                    jQuery('.remove_image_button').hide();
                                                    return false;
                                                });

                                                jQuery(document).ajaxComplete(function (event, request, options) {
                                                    if (request && 4 === request.readyState && 200 === request.status
                                                        && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                                                        var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                                                        if (!res || res.errors) {
                                                            return;
                                                        }
                                                        // Clear Thumbnail fields on submit
                                                        jQuery('#product_cat_thumbnail').find('img').attr('src', 'http://localhost/wordpress/wp-content/uploads/woocommerce-placeholder.png');
                                                        jQuery('#product_cat_thumbnail_id').val('');
                                                        jQuery('.remove_image_button').hide();
                                                        // Clear Display type field on submit
                                                        jQuery('#display_type').val('');
                                                        return;
                                                    }
                                                });

                                            </script>
                                            <div class="clear"></div>
                                        </div>
                                        <p class="submit">
                                            <input type="submit" name="submit" id="submit" class="button button-primary"
                                                   value="Add new category"/> <span class="spinner"></span>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /col-left -->

                        <div id="col-right">
                            <div class="col-wrap">


                                <form id="posts-filter" method="post">
                                    <input type="hidden" name="taxonomy" value="product_cat"/>
                                    <input type="hidden" name="post_type" value="product"/>

                                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="0ba0d6e873"/><input
                                            type="hidden" name="_wp_http_referer"
                                            value="/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product"/>
                                    <div class="tablenav top">

                                        <div class="alignleft actions bulkactions">
                                            <label for="bulk-action-selector-top" class="screen-reader-text">Lựa chọn
                                                thao tác hàng loạt</label><select name="action"
                                                                                  id="bulk-action-selector-top">
                                                <option value="-1">Hành động</option>
                                                <option value="delete">Xóa</option>
                                            </select>
                                            <input type="submit" id="doaction" class="button action" value="Áp dụng"/>
                                        </div>
                                        <div class='tablenav-pages one-page'><span class="displaying-num">2 mục</span>
                                            <span class='pagination-links'><span
                                                        class="tablenav-pages-navspan button disabled"
                                                        aria-hidden="true">&laquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Trang hiện tại</label><input
            class='current-page' id='current-page-selector' type='text' name='paged' value='1' size='1'
            aria-describedby='table-paging'/><span class='tablenav-paging-text'> trên <span class='total-pages'>1</span></span></span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span></span></div>
                                        <br class="clear"/>
                                    </div>
                                    <h2 class='screen-reader-text'>Danh sách chuyên mục</h2>
                                    <table class="wp-list-table widefat fixed striped table-view-list tags">
                                        <thead>
                                        <tr>
                                            <td id='cb' class='manage-column column-cb check-column'><label
                                                        class="screen-reader-text" for="cb-select-all-1">Chọn toàn
                                                    bộ</label><input id="cb-select-all-1" type="checkbox"/></td>
                                            <th scope="col" id='thumb' class='manage-column column-thumb'>Image</th>
                                            <th scope="col" id='name'
                                                class='manage-column column-name column-primary sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=name&#038;order=asc"><span>Tên</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" id='description'
                                                class='manage-column column-description sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=description&#038;order=asc"><span>Mô tả</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" id='slug' class='manage-column column-slug sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=slug&#038;order=asc"><span>Đường dẫn</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" id='posts'
                                                class='manage-column column-posts num sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=count&#038;order=asc"><span>Lượt</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" id='handle' class='manage-column column-handle'></th>
                                        </tr>
                                        </thead>

                                        <tbody id="the-list"
                                               data-wp-lists='list:tag'>
                                        <tr id="tag-18" class="level-0">
                                            <th scope="row" class="check-column">&nbsp;</th>
                                            <td class='thumb column-thumb' data-colname="Image"><span
                                                        class="woocommerce-help-tip" tabindex="0"
                                                        aria-label="This is the default category and it cannot be deleted. It will be automatically assigned to products with no category."
                                                        data-tip="This is the default category and it cannot be deleted. It will be automatically assigned to products with no category."></span><img
                                                        src="http://localhost/wordpress/wp-content/uploads/woocommerce-placeholder.png"
                                                        alt="Thumbnail" class="wp-post-image" height="48" width="48"/>
                                            </td>
                                            <td class='name column-name has-row-actions column-primary'
                                                data-colname="Tên"><strong><a class="row-title"
                                                                              href="http://localhost/wordpress/wp-admin/term.php?taxonomy=product_cat&#038;tag_ID=18&#038;post_type=product&#038;wp_http_referer=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct"
                                                                              aria-label="&#8220;Uncategorized&#8221; (Chỉnh sửa)">Uncategorized</a></strong><br/>
                                                <div class="hidden" id="inline_18">
                                                    <div class="name">Uncategorized</div>
                                                    <div class="slug">uncategorized</div>
                                                    <div class="parent">0</div>
                                                </div>
                                                <div class="row-actions"><span class='edit'><a
                                                                href="http://localhost/wordpress/wp-admin/term.php?taxonomy=product_cat&#038;tag_ID=18&#038;post_type=product&#038;wp_http_referer=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct"
                                                                aria-label="Sửa &#8220;Uncategorized&#8221;">Chỉnh sửa</a> | </span><span
                                                            class='inline hide-if-no-js'><button type="button"
                                                                                                 class="button-link editinline"
                                                                                                 aria-label="Chỉnh sửa nhanh &#8220;Uncategorized&#8221;"
                                                                                                 aria-expanded="false">Sửa nhanh</button> | </span><span
                                                            class='view'><a
                                                                href="http://localhost/wordpress/product-category/uncategorized/"
                                                                aria-label="Xem lưu trữ &#8220;Uncategorized&#8221;">Xem</a></span>
                                                </div>
                                                <button type="button" class="toggle-row"><span
                                                            class="screen-reader-text">Hiển thị chi tiết</span></button>
                                            </td>
                                            <td class='description column-description' data-colname="Mô tả"><span
                                                        aria-hidden="true">&#8212;</span><span
                                                        class="screen-reader-text">Không có mô tả</span></td>
                                            <td class='slug column-slug' data-colname="Đường dẫn">uncategorized</td>
                                            <td class='posts column-posts' data-colname="Lượt"><a
                                                        href='edit.php?product_cat=uncategorized&#038;post_type=product'>1</a>
                                            </td>
                                            <td class='handle column-handle' data-colname=""><input type="hidden"
                                                                                                    name="term_id"
                                                                                                    value="18"/></td>
                                        </tr>
                                        <tr id="tag-19" class="level-0">
                                            <th scope="row" class="check-column"><label class="screen-reader-text"
                                                                                        for="cb-select-19">Chọn gì
                                                    cơ</label><input type="checkbox" name="delete_tags[]" value="19"
                                                                     id="cb-select-19"/></th>
                                            <td class='thumb column-thumb' data-colname="Image"><img
                                                        src="http://localhost/wordpress/wp-content/uploads/woocommerce-placeholder.png"
                                                        alt="Thumbnail" class="wp-post-image" height="48" width="48"/>
                                            </td>
                                            <td class='name column-name has-row-actions column-primary'
                                                data-colname="Tên"><strong><a class="row-title"
                                                                              href="http://localhost/wordpress/wp-admin/term.php?taxonomy=product_cat&#038;tag_ID=19&#038;post_type=product&#038;wp_http_referer=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct"
                                                                              aria-label="&#8220;gì cơ&#8221; (Chỉnh sửa)">gì
                                                        cơ</a></strong><br/>
                                                <div class="hidden" id="inline_19">
                                                    <div class="name">gì cơ</div>
                                                    <div class="slug">gi-co</div>
                                                    <div class="parent">0</div>
                                                </div>
                                                <div class="row-actions"><span class='edit'><a
                                                                href="http://localhost/wordpress/wp-admin/term.php?taxonomy=product_cat&#038;tag_ID=19&#038;post_type=product&#038;wp_http_referer=%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct"
                                                                aria-label="Sửa &#8220;gì cơ&#8221;">Chỉnh sửa</a> | </span><span
                                                            class='inline hide-if-no-js'><button type="button"
                                                                                                 class="button-link editinline"
                                                                                                 aria-label="Chỉnh sửa nhanh &#8220;gì cơ&#8221;"
                                                                                                 aria-expanded="false">Sửa nhanh</button> | </span><span
                                                            class='delete'><a
                                                                href="edit-tags.php?action=delete&amp;taxonomy=product_cat&amp;tag_ID=19&amp;_wpnonce=36eb827e0b"
                                                                class="delete-tag aria-button-if-js"
                                                                aria-label="Xóa &#8220;gì cơ&#8221;">Xóa</a> | </span><span
                                                            class='view'><a
                                                                href="http://localhost/wordpress/product-category/gi-co/"
                                                                aria-label="Xem lưu trữ &#8220;gì cơ&#8221;">Xem</a> | </span><span
                                                            class='make_default'><a
                                                                href="edit-tags.php?action=make_default&amp;taxonomy=product_cat&amp;post_type=product&amp;tag_ID=19&amp;_wpnonce=56fa3667eb"
                                                                aria-label="Make &#8220;gì cơ&#8221; the default category">Make default</a></span>
                                                </div>
                                                <button type="button" class="toggle-row"><span
                                                            class="screen-reader-text">Hiển thị chi tiết</span></button>
                                            </td>
                                            <td class='description column-description' data-colname="Mô tả"><span
                                                        aria-hidden="true">&#8212;</span><span
                                                        class="screen-reader-text">Không có mô tả</span></td>
                                            <td class='slug column-slug' data-colname="Đường dẫn">gi-co</td>
                                            <td class='posts column-posts' data-colname="Lượt"><a
                                                        href='edit.php?product_cat=gi-co&#038;post_type=product'>0</a>
                                            </td>
                                            <td class='handle column-handle' data-colname=""><input type="hidden"
                                                                                                    name="term_id"
                                                                                                    value="19"/></td>
                                        </tr>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <td class='manage-column column-cb check-column'><label
                                                        class="screen-reader-text" for="cb-select-all-2">Chọn toàn
                                                    bộ</label><input id="cb-select-all-2" type="checkbox"/></td>
                                            <th scope="col" class='manage-column column-thumb'>Image</th>
                                            <th scope="col"
                                                class='manage-column column-name column-primary sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=name&#038;order=asc"><span>Tên</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" class='manage-column column-description sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=description&#038;order=asc"><span>Mô tả</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" class='manage-column column-slug sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=slug&#038;order=asc"><span>Đường dẫn</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" class='manage-column column-posts num sortable desc'><a
                                                        href="http://localhost/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&#038;post_type=product&#038;orderby=count&#038;order=asc"><span>Lượt</span><span
                                                            class="sorting-indicator"></span></a></th>
                                            <th scope="col" class='manage-column column-handle'></th>
                                        </tr>
                                        </tfoot>

                                    </table>
                                    <div class="tablenav bottom">

                                        <div class="alignleft actions bulkactions">
                                            <label for="bulk-action-selector-bottom" class="screen-reader-text">Lựa chọn
                                                thao tác hàng loạt</label><select name="action2"
                                                                                  id="bulk-action-selector-bottom">
                                                <option value="-1">Hành động</option>
                                                <option value="delete">Xóa</option>
                                            </select>
                                            <input type="submit" id="doaction2" class="button action" value="Áp dụng"/>
                                        </div>
                                        <div class='tablenav-pages one-page'><span class="displaying-num">2 mục</span>
                                            <span class='pagination-links'><span
                                                        class="tablenav-pages-navspan button disabled"
                                                        aria-hidden="true">&laquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>
<span class="screen-reader-text">Trang hiện tại</span><span id="table-paging" class="paging-input"><span
                                                            class="tablenav-paging-text">1 trên <span
                                                                class='total-pages'>1</span></span></span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>
<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span></span></div>
                                        <br class="clear"/>
                                    </div>

                                </form>

                                <div class="form-wrap edit-term-notes">
                                    <p>
                                        <strong>Note:</strong><br>
                                        Deleting a category does not delete the products in that category. Instead,
                                        products that were only assigned to the deleted category are set to the category
                                        <strong>Uncategorized</strong>. </p>
                                </div>
                            </div>
                        </div><!-- /col-right -->

                    </div><!-- /col-container -->

                </div><!-- /wrap -->

                <script type="text/javascript">
                    try {
                        document.forms.addtag['tag-name'].focus();
                    } catch (e) {
                    }
                </script>

                <form method="get">
                    <table style="display: none">
                        <tbody id="inlineedit">

                        <tr id="inline-edit" class="inline-edit-row" style="display: none">
                            <td colspan="7" class="colspanchange">
                                <div class="inline-edit-wrapper">

                                    <fieldset>
                                        <legend class="inline-edit-legend">Sửa nhanh</legend>
                                        <div class="inline-edit-col">
                                            <label>
                                                <span class="title">Tên</span>
                                                <span class="input-text-wrap"><input type="text" name="name"
                                                                                     class="ptitle" value=""/></span>
                                            </label>

                                            <label>
                                                <span class="title">Đường dẫn</span>
                                                <span class="input-text-wrap"><input type="text" name="slug"
                                                                                     class="ptitle" value=""/></span>
                                            </label>
                                        </div>
                                    </fieldset>


                                    <div class="inline-edit-save submit">
                                        <button type="button" class="save button button-primary">Update category
                                        </button>
                                        <button type="button" class="cancel button">Hủy</button>
                                        <span class="spinner"></span>

                                        <input type="hidden" id="_inline_edit" name="_inline_edit" value="31dc2b2aec"/>
                                        <input type="hidden" name="taxonomy" value="product_cat"/>
                                        <input type="hidden" name="post_type" value="product"/>

                                        <div class="notice notice-error notice-alt inline hidden">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </form>

                <div class="clear"></div>
            </div><!-- wpbody-content -->
            <div class="clear"></div>
        </div><!-- wpbody -->
        <div class="clear"></div>
    </div><!-- wpcontent -->

    <div id="wpfooter" role="contentinfo">
        <p id="footer-left" class="alignleft">
            If you like <strong>WooCommerce</strong> please leave us a <a
                    href="https://wordpress.org/support/plugin/woocommerce/reviews?rate=5#new-post" target="_blank"
                    class="wc-rating-link" aria-label="five star" data-rated="Thanks :)">&#9733;&#9733;&#9733;&#9733;&#9733;</a>
            rating. A huge thanks in advance! </p>
        <p id="footer-upgrade" class="alignright">
            Phiên bản 6.2.2 </p>
        <div class="clear"></div>
    </div>
    <img style="position: fixed;"
         src="https://pixel.wp.com/t.gif?_en=wcadmin_categories_view&#038;_ts=1689666615083&#038;_via_ua=Mozilla%2F5.0+%28Windows+NT+10.0%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F113.0.0.0+Safari%2F537.36&#038;_via_ip=%3A%3A1&#038;_lg=vi-VN%2Cvi%3Bq%3D0.9%2Cfr-FR%3Bq%3D0.8%2Cfr%3Bq%3D0.7%2Cen-US%3Bq%3D0.6%2Cen%3Bq%3D0.5&#038;_dr=&#038;_dl=http%3A%2F%2Flocalhost%2Fwordpress%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&#038;_ut=anon&#038;_ui=woo%3AEEBklBp2rgtxED1NngC1MGG8&#038;url=http%3A%2F%2Flocalhost%2Fwordpress&#038;blog_lang=vi&#038;blog_id=0&#038;products_count=0&#038;wc_version=7.9.0&#038;browser_type=php-agent"/>
    <script type="text/javascript">
        (function ($) {

            // Define vars.
            var view = 'add';
            var $form = $('#' + view + 'tag');
            var $submit = $('#' + view + 'tag input[type="submit"]:last');

            // Add missing spinner.
            if (!$submit.next('.spinner').length) {
                $submit.after('<span class="spinner"></span>');
            }


            // vars
            var $fields = $('#acf-term-fields');
            var html = '';

            // Store a copy of the $fields html used later to replace after AJAX request.
            // Hook into 'prepare' action to allow ACF core helpers to first modify DOM.
            // Fixes issue where hidden #acf-hidden-wp-editor is initialized again.
            acf.addAction('prepare', function () {
                html = $fields.html();
            }, 6);

            // WP triggers click as primary action
            $submit.on('click', function (e) {

                // validate
                var valid = acf.validateForm({
                    form: $form,
                    event: e,
                    reset: true
                });

                // if not valid, stop event and allow validation to continue
                if (!valid) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            });

            // listen to AJAX add-tag complete
            $(document).ajaxComplete(function (event, xhr, settings) {

                // bail early if is other ajax call
                if (settings.data.indexOf('action=add-tag') == -1) {
                    return;
                }

                // bail early if response contains error
                if (xhr.responseText.indexOf('wp_error') !== -1) {
                    return;
                }

                // action for 3rd party customization
                acf.doAction('remove', $fields);

                // reset HTML
                $fields.html(html);

                // action for 3rd party customization
                acf.doAction('append', $fields);

                // reset unload
                acf.unload.reset();
            });


        })(jQuery);
    </script>

    <script type="text/html" id="tmpl-media-frame">
        <div class="media-frame-title" id="media-frame-title"></div>
        <h2 class="media-frame-menu-heading">Hành động</h2>
        <button type="button" class="button button-link media-frame-menu-toggle" aria-expanded="false">
            Menu <span class="dashicons dashicons-arrow-down" aria-hidden="true"></span>
        </button>
        <div class="media-frame-menu"></div>
        <div class="media-frame-tab-panel">
            <div class="media-frame-router"></div>
            <div class="media-frame-content"></div>
        </div>
        <h2 class="media-frame-actions-heading screen-reader-text">
            Hành động cho các media đã được chọn </h2>
        <div class="media-frame-toolbar"></div>
        <div class="media-frame-uploader"></div>
    </script>

    <script type="text/html" id="tmpl-media-modal">
        <div tabindex="0" class="media-modal wp-core-ui" role="dialog" aria-labelledby="media-frame-title">
            <# if ( data.hasCloseButton ) { #>
            <button type="button" class="media-modal-close"><span class="media-modal-icon"><span
                            class="screen-reader-text">
					Đóng hộp thoại				</span></span></button>
            <# } #>
            <div class="media-modal-content" role="document"></div>
        </div>
        <div class="media-modal-backdrop"></div>
    </script>

    <script type="text/html" id="tmpl-uploader-window">
        <div class="uploader-window-content">
            <div class="uploader-editor-title">Thả các tập tin để tải lên</div>
        </div>
    </script>

    <script type="text/html" id="tmpl-uploader-editor">
        <div class="uploader-editor-content">
            <div class="uploader-editor-title">Thả các tập tin để tải lên</div>
        </div>
    </script>

    <script type="text/html" id="tmpl-uploader-inline">
        <# var messageClass = data.message ? 'has-upload-message' : 'no-upload-message'; #>
        <# if ( data.canClose ) { #>
        <button class="close dashicons dashicons-no"><span class="screen-reader-text">
			Đóng trình tải lên		</span></button>
        <# } #>
        <div class="uploader-inline-content {{ messageClass }}">
            <# if ( data.message ) { #>
            <h2 class="upload-message">{{ data.message }}</h2>
            <# } #>
            <div class="upload-ui">
                <h2 class="upload-instructions drop-instructions">Thả các tập tin để tải lên</h2>
                <p class="upload-instructions drop-instructions">hoặc</p>
                <button type="button" class="browser button button-hero" aria-labelledby="post-upload-info">Chọn tập
                    tin
                </button>
            </div>

            <div class="upload-inline-status"></div>

            <div class="post-upload-ui" id="post-upload-info">

                <p class="max-upload-size">
                    Kích thước tập tin tải lên tối đa: 40 MB </p>

                <# if ( data.suggestedWidth && data.suggestedHeight ) { #>
                <p class="suggested-dimensions">
                    Kích thước ảnh để nghị: {{data.suggestedWidth}} x {{data.suggestedHeight}} pixels. </p>
                <# } #>

            </div>
        </div>
    </script>

    <script type="text/html" id="tmpl-media-library-view-switcher">
        <a href="http://localhost/wordpress/wp-admin/upload.php?mode=list" class="view-list">
			<span class="screen-reader-text">
				Xem dạng danh sách			</span>
        </a>
        <a href="http://localhost/wordpress/wp-admin/upload.php?mode=grid" class="view-grid current"
           aria-current="page">
			<span class="screen-reader-text">
				Xem dạng lưới			</span>
        </a>
    </script>

    <script type="text/html" id="tmpl-uploader-status">
        <h2>Đang tải lên</h2>

        <div class="media-progress-bar">
            <div></div>
        </div>
        <div class="upload-details">
			<span class="upload-count">
				<span class="upload-index"></span> / <span class="upload-total"></span>
			</span>
            <span class="upload-detail-separator">&ndash;</span>
            <span class="upload-filename"></span>
        </div>
        <div class="upload-errors"></div>
        <button type="button" class="button upload-dismiss-errors">Bỏ qua lỗi</button>
    </script>

    <script type="text/html" id="tmpl-uploader-status-error">
        <span class="upload-error-filename">{{{ data.filename }}}</span>
        <span class="upload-error-message">{{ data.message }}</span>
    </script>

    <script type="text/html" id="tmpl-edit-attachment-frame">
        <div class="edit-media-header">
            <button class="left dashicons"
            <# if ( ! data.hasPrevious ) { #> disabled<# } #>><span
                    class="screen-reader-text">Chỉnh sửa media trước</span></button>
            <button class="right dashicons"
            <# if ( ! data.hasNext ) { #> disabled<# } #>><span
                    class="screen-reader-text">Chỉnh sửa media tiếp theo</span></button>
            <button type="button" class="media-modal-close"><span class="media-modal-icon"><span
                            class="screen-reader-text">Đóng hộp thoại</span></span></button>
        </div>
        <div class="media-frame-title"></div>
        <div class="media-frame-content"></div>
    </script>

    <script type="text/html" id="tmpl-attachment-details-two-column">
        <div class="attachment-media-view {{ data.orientation }}">
            <h2 class="screen-reader-text">Xem trước file đính kèm</h2>
            <div class="thumbnail thumbnail-{{ data.type }}">
                <# if ( data.uploading ) { #>
                <div class="media-progress-bar">
                    <div></div>
                </div>
                <# } else if ( data.sizes && data.sizes.full ) { #>
                <img class="details-image" src="{{ data.sizes.full.url }}" draggable="false" alt=""/>
                <# } else if ( data.sizes && data.sizes.large ) { #>
                <img class="details-image" src="{{ data.sizes.large.url }}" draggable="false" alt=""/>
                <# } else if ( -1 === jQuery.inArray( data.type, [ 'audio', 'video' ] ) ) { #>
                <img class="details-image icon" src="{{ data.icon }}" draggable="false" alt=""/>
                <# } #>

                <# if ( 'audio' === data.type ) { #>
                <div class="wp-media-wrapper wp-audio">
                    <audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">
                        <source type="{{ data.mime }}" src="{{ data.url }}"/>
                    </audio>
                </div>
                <# } else if ( 'video' === data.type ) {
                var w_rule = '';
                if ( data.width ) {
                w_rule = 'width: ' + data.width + 'px;';
                } else if ( wp.media.view.settings.contentWidth ) {
                w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';
                }
                #>
                <div style="{{ w_rule }}" class="wp-media-wrapper wp-video">
                    <video controls="controls" class="wp-video-shortcode" preload="metadata"
                    <# if ( data.width ) { #>width="{{ data.width }}"<# } #>
                    <# if ( data.height ) { #>height="{{ data.height }}"<# } #>
                    <# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
                    <source type="{{ data.mime }}" src="{{ data.url }}"/>
                    </video>
                </div>
                <# } #>

                <div class="attachment-actions">
                    <# if ( 'image' === data.type && ! data.uploading && data.sizes && data.can.save ) { #>
                    <button type="button" class="button edit-attachment">Sửa ảnh</button>
                    <# } else if ( 'pdf' === data.subtype && data.sizes ) { #>
                    <p>Xem trước tài liệu</p>
                    <# } #>
                </div>
            </div>
        </div>
        <div class="attachment-info">
			<span class="settings-save-status" role="status">
				<span class="spinner"></span>
				<span class="saved">Đã lưu.</span>
			</span>
            <div class="details">
                <h2 class="screen-reader-text">
                    Chi tiết </h2>
                <div class="uploaded"><strong>Đã tải lên vào lúc:</strong> {{ data.dateFormatted }}</div>
                <div class="uploaded-by">
                    <strong>Đã tải lên bởi:</strong>
                    <# if ( data.authorLink ) { #>
                    <a href="{{ data.authorLink }}">{{ data.authorName }}</a>
                    <# } else { #>
                    {{ data.authorName }}
                    <# } #>
                </div>
                <# if ( data.uploadedToTitle ) { #>
                <div class="uploaded-to">
                    <strong>Đã tải lên:</strong>
                    <# if ( data.uploadedToLink ) { #>
                    <a href="{{ data.uploadedToLink }}">{{ data.uploadedToTitle }}</a>
                    <# } else { #>
                    {{ data.uploadedToTitle }}
                    <# } #>
                </div>
                <# } #>
                <div class="filename"><strong>Tên tập tin:</strong> {{ data.filename }}</div>
                <div class="file-type"><strong>Loại tập tin:</strong> {{ data.mime }}</div>
                <div class="file-size"><strong>Dung lượng tệp:</strong> {{ data.filesizeHumanReadable }}</div>
                <# if ( 'image' === data.type && ! data.uploading ) { #>
                <# if ( data.width && data.height ) { #>
                <div class="dimensions"><strong>Kích thước:</strong>
                    {{ data.width }} dài và rộng {{ data.height }} pixel
                </div>
                <# } #>

                <# if ( data.originalImageURL && data.originalImageName ) { #>
                <div class="word-wrap-break-word">
                    <strong>Ảnh gốc:</strong>
                    <a href="{{ data.originalImageURL }}">{{data.originalImageName}}</a>
                </div>
                <# } #>
                <# } #>

                <# if ( data.fileLength && data.fileLengthHumanReadable ) { #>
                <div class="file-length"><strong>Độ dài:</strong>
                    <span aria-hidden="true">{{ data.fileLength }}</span>
                    <span class="screen-reader-text">{{ data.fileLengthHumanReadable }}</span>
                </div>
                <# } #>

                <# if ( 'audio' === data.type && data.meta.bitrate ) { #>
                <div class="bitrate">
                    <strong>Bitrate:</strong> {{ Math.round( data.meta.bitrate / 1000 ) }}kb/s
                    <# if ( data.meta.bitrate_mode ) { #>
                    {{ ' ' + data.meta.bitrate_mode.toUpperCase() }}
                    <# } #>
                </div>
                <# } #>

                <# if ( data.mediaStates ) { #>
                <div class="media-states"><strong>Được dùng như:</strong> {{ data.mediaStates }}</div>
                <# } #>

                <div class="compat-meta">
                    <# if ( data.compat && data.compat.meta ) { #>
                    {{{ data.compat.meta }}}
                    <# } #>
                </div>
            </div>

            <div class="settings">
                <# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
                <# if ( 'image' === data.type ) { #>
                <span class="setting alt-text has-description" data-setting="alt">
						<label for="attachment-details-two-column-alt-text" class="name">Văn bản thay thế</label>
						<textarea id="attachment-details-two-column-alt-text"
                                  aria-describedby="alt-text-description" {{ maybeReadOnly }}>{{ data.alt }}</textarea>
					</span>
                <p class="description" id="alt-text-description"><a
                            href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank" rel="noopener">Xem
                        cách mô tả nội dung ảnh<span class="screen-reader-text"> (mở trong cửa sổ mới)</span></a>. Để
                    trống nếu ảnh chỉ dùng làm hiệu ứng trang trí.</p>
                <# } #>
                <span class="setting" data-setting="title">
					<label for="attachment-details-two-column-title" class="name">Tiêu đề</label>
					<input type="text" id="attachment-details-two-column-title" value="{{ data.title }}" {{ maybeReadOnly }} />
				</span>
                <# if ( 'audio' === data.type ) { #>
                <span class="setting" data-setting="artist">
					<label for="attachment-details-two-column-artist" class="name">Nghệ sĩ</label>
					<input type="text" id="attachment-details-two-column-artist"
                           value="{{ data.artist || data.meta.artist || '' }}"/>
				</span>
                <span class="setting" data-setting="album">
					<label for="attachment-details-two-column-album" class="name">Album</label>
					<input type="text" id="attachment-details-two-column-album"
                           value="{{ data.album || data.meta.album || '' }}"/>
				</span>
                <# } #>
                <span class="setting" data-setting="caption">
					<label for="attachment-details-two-column-caption" class="name">Chú thích</label>
					<textarea
                            id="attachment-details-two-column-caption" {{ maybeReadOnly }}>{{ data.caption }}</textarea>
				</span>
                <span class="setting" data-setting="description">
					<label for="attachment-details-two-column-description" class="name">Mô tả</label>
					<textarea
                            id="attachment-details-two-column-description" {{ maybeReadOnly }}>{{ data.description }}</textarea>
				</span>
                <span class="setting" data-setting="url">
					<label for="attachment-details-two-column-copy-link" class="name">File URL:</label>
					<input type="text" class="attachment-details-copy-link" id="attachment-details-two-column-copy-link"
                           value="{{ data.url }}" readonly/>
					<span class="copy-to-clipboard-container">
						<button type="button" class="button button-small copy-attachment-url"
                                data-clipboard-target="#attachment-details-two-column-copy-link">Sao chép URL vào bộ nhớ tạm</button>
						<span class="success hidden" aria-hidden="true">Đã sao chép!</span>
					</span>
				</span>
                <div class="attachment-compat"></div>
            </div>

            <div class="actions">
                <# if ( data.link ) { #>
                <a class="view-attachment" href="{{ data.link }}">Xem trang đính kèm</a>
                <# } #>
                <# if ( data.can.save ) { #>
                <# if ( data.link ) { #>
                <span class="links-separator">|</span>
                <# } #>
                <a href="{{ data.editLink }}">Chỉnh sửa chi tiết hơn</a>
                <# } #>
                <# if ( data.can.save && data.link ) { #>
                <span class="links-separator">|</span>
                <a href="{{ data.url }}" download>Download file</a>
                <# } #>
                <# if ( ! data.uploading && data.can.remove ) { #>
                <# if ( data.link || data.can.save ) { #>
                <span class="links-separator">|</span>
                <# } #>
                <button type="button" class="button-link delete-attachment">Xóa vĩnh viễn</button>
                <# } #>
            </div>
        </div>
    </script>

    <script type="text/html" id="tmpl-attachment">
        <div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
            <div class="thumbnail">
                <# if ( data.uploading ) { #>
                <div class="media-progress-bar">
                    <div style="width: {{ data.percent }}%"></div>
                </div>
                <# } else if ( 'image' === data.type && data.size && data.size.url ) { #>
                <div class="centered">
                    <img src="{{ data.size.url }}" draggable="false" alt=""/>
                </div>
                <# } else { #>
                <div class="centered">
                    <# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
                    <img src="{{ data.image.src }}" class="thumbnail" draggable="false" alt=""/>
                    <# } else if ( data.sizes && data.sizes.medium ) { #>
                    <img src="{{ data.sizes.medium.url }}" class="thumbnail" draggable="false" alt=""/>
                    <# } else { #>
                    <img src="{{ data.icon }}" class="icon" draggable="false" alt=""/>
                    <# } #>
                </div>
                <div class="filename">
                    <div>{{ data.filename }}</div>
                </div>
                <# } #>
            </div>
            <# if ( data.buttons.close ) { #>
            <button type="button" class="button-link attachment-close media-modal-icon"><span
                        class="screen-reader-text">
					Xóa bỏ				</span></button>
            <# } #>
        </div>
        <# if ( data.buttons.check ) { #>
        <button type="button" class="check" tabindex="-1"><span class="media-modal-icon"></span><span
                    class="screen-reader-text">
				Bỏ chọn			</span></button>
        <# } #>
        <#
        var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
        if ( data.describe ) {
        if ( 'image' === data.type ) { #>
        <input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
               aria-label="Chú thích"
               placeholder="Chú thích&hellip;" {{ maybeReadOnly }} />
        <# } else { #>
        <input type="text" value="{{ data.title }}" class="describe" data-setting="title"
        <# if ( 'video' === data.type ) { #>
        aria-label="Tiêu đề video"
        placeholder="Tiêu đề video&hellip;"
        <# } else if ( 'audio' === data.type ) { #>
        aria-label="Tiêu đề âm thanh"
        placeholder="Tiêu đề âm thanh&hellip;"
        <# } else { #>
        aria-label="Tiêu đề media"
        placeholder="Tiêu đề media&hellip;"
        <# } #> {{ maybeReadOnly }} />
        <# }
        } #>
    </script>

    <script type="text/html" id="tmpl-attachment-details">
        <h2>
            Chi tiết đính kèm <span class="settings-save-status" role="status">
				<span class="spinner"></span>
				<span class="saved">Đã lưu.</span>
			</span>
        </h2>
        <div class="attachment-info">

            <# if ( 'audio' === data.type ) { #>
            <div class="wp-media-wrapper wp-audio">
                <audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">
                    <source type="{{ data.mime }}" src="{{ data.url }}"/>
                </audio>
            </div>
            <# } else if ( 'video' === data.type ) {
            var w_rule = '';
            if ( data.width ) {
            w_rule = 'width: ' + data.width + 'px;';
            } else if ( wp.media.view.settings.contentWidth ) {
            w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';
            }
            #>
            <div style="{{ w_rule }}" class="wp-media-wrapper wp-video">
                <video controls="controls" class="wp-video-shortcode" preload="metadata"
                <# if ( data.width ) { #>width="{{ data.width }}"<# } #>
                <# if ( data.height ) { #>height="{{ data.height }}"<# } #>
                <# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
                <source type="{{ data.mime }}" src="{{ data.url }}"/>
                </video>
            </div>
            <# } else { #>
            <div class="thumbnail thumbnail-{{ data.type }}">
                <# if ( data.uploading ) { #>
                <div class="media-progress-bar">
                    <div></div>
                </div>
                <# } else if ( 'image' === data.type && data.size && data.size.url ) { #>
                <img src="{{ data.size.url }}" draggable="false" alt=""/>
                <# } else { #>
                <img src="{{ data.icon }}" class="icon" draggable="false" alt=""/>
                <# } #>
            </div>
            <# } #>

            <div class="details">
                <div class="filename">{{ data.filename }}</div>
                <div class="uploaded">{{ data.dateFormatted }}</div>

                <div class="file-size">{{ data.filesizeHumanReadable }}</div>
                <# if ( 'image' === data.type && ! data.uploading ) { #>
                <# if ( data.width && data.height ) { #>
                <div class="dimensions">
                    {{ data.width }} dài và rộng {{ data.height }} pixel
                </div>
                <# } #>

                <# if ( data.originalImageURL && data.originalImageName ) { #>
                <div class="word-wrap-break-word">
                    Ảnh gốc: <a href="{{ data.originalImageURL }}">{{data.originalImageName}}</a>
                </div>
                <# } #>

                <# if ( data.can.save && data.sizes ) { #>
                <a class="edit-attachment" href="{{ data.editLink }}&amp;image-editor" target="_blank">Sửa ảnh</a>
                <# } #>
                <# } #>

                <# if ( data.fileLength && data.fileLengthHumanReadable ) { #>
                <div class="file-length">Độ dài: <span aria-hidden="true">{{ data.fileLength }}</span>
                    <span class="screen-reader-text">{{ data.fileLengthHumanReadable }}</span>
                </div>
                <# } #>

                <# if ( data.mediaStates ) { #>
                <div class="media-states"><strong>Được dùng như:</strong> {{ data.mediaStates }}</div>
                <# } #>

                <# if ( ! data.uploading && data.can.remove ) { #>
                <button type="button" class="button-link delete-attachment">Xóa vĩnh viễn</button>
                <# } #>

                <div class="compat-meta">
                    <# if ( data.compat && data.compat.meta ) { #>
                    {{{ data.compat.meta }}}
                    <# } #>
                </div>
            </div>
        </div>
        <# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
        <# if ( 'image' === data.type ) { #>
        <span class="setting alt-text has-description" data-setting="alt">
				<label for="attachment-details-alt-text" class="name">Văn bản thay thế</label>
				<textarea id="attachment-details-alt-text"
                          aria-describedby="alt-text-description" {{ maybeReadOnly }}>{{ data.alt }}</textarea>
			</span>
        <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree"
                                                            target="_blank" rel="noopener">Xem cách mô tả nội dung
                ảnh<span class="screen-reader-text"> (mở trong cửa sổ mới)</span></a>. Để trống nếu ảnh chỉ dùng làm
            hiệu ứng trang trí.</p>
        <# } #>
        <span class="setting" data-setting="title">
			<label for="attachment-details-title" class="name">Tiêu đề</label>
			<input type="text" id="attachment-details-title" value="{{ data.title }}" {{ maybeReadOnly }} />
		</span>
        <# if ( 'audio' === data.type ) { #>
        <span class="setting" data-setting="artist">
			<label for="attachment-details-artist" class="name">Nghệ sĩ</label>
			<input type="text" id="attachment-details-artist" value="{{ data.artist || data.meta.artist || '' }}"/>
		</span>
        <span class="setting" data-setting="album">
			<label for="attachment-details-album" class="name">Album</label>
			<input type="text" id="attachment-details-album" value="{{ data.album || data.meta.album || '' }}"/>
		</span>
        <# } #>
        <span class="setting" data-setting="caption">
			<label for="attachment-details-caption" class="name">Chú thích</label>
			<textarea id="attachment-details-caption" {{ maybeReadOnly }}>{{ data.caption }}</textarea>
		</span>
        <span class="setting" data-setting="description">
			<label for="attachment-details-description" class="name">Mô tả</label>
			<textarea id="attachment-details-description" {{ maybeReadOnly }}>{{ data.description }}</textarea>
		</span>
        <span class="setting" data-setting="url">
			<label for="attachment-details-copy-link" class="name">File URL:</label>
			<input type="text" class="attachment-details-copy-link" id="attachment-details-copy-link"
                   value="{{ data.url }}" readonly/>
			<div class="copy-to-clipboard-container">
				<button type="button" class="button button-small copy-attachment-url"
                        data-clipboard-target="#attachment-details-copy-link">Sao chép URL vào bộ nhớ tạm</button>
				<span class="success hidden" aria-hidden="true">Đã sao chép!</span>
			</div>
		</span>
    </script>

    <script type="text/html" id="tmpl-media-selection">
        <div class="selection-info">
            <span class="count"></span>
            <# if ( data.editable ) { #>
            <button type="button" class="button-link edit-selection">Sửa lựa chọn</button>
            <# } #>
            <# if ( data.clearable ) { #>
            <button type="button" class="button-link clear-selection">Xóa</button>
            <# } #>
        </div>
        <div class="selection-view"></div>
    </script>

    <script type="text/html" id="tmpl-attachment-display-settings">
        <h2>Tùy chọn hiển thị nội dung đính kèm</h2>

        <# if ( 'image' === data.type ) { #>
        <span class="setting align">
				<label for="attachment-display-settings-alignment" class="name">Căn chỉnh</label>
				<select id="attachment-display-settings-alignment" class="alignment"
                        data-setting="align"
					<# if ( data.userSettings ) { #>
						data-user-setting="align"
					<# } #>>

					<option value="left">
						Trái					</option>
					<option value="center">
						Chính giữa					</option>
					<option value="right">
						Phải					</option>
					<option value="none" selected>
						Trống					</option>
            </select>
			</span>
        <# } #>

        <span class="setting">
			<label for="attachment-display-settings-link-to" class="name">
				<# if ( data.model.canEmbed ) { #>
					Nhúng hoặc Liên kết				<# } else { #>
					Liên kết tới				<# } #>
			</label>
			<select id="attachment-display-settings-link-to" class="link-to"
                    data-setting="link"
				<# if ( data.userSettings && ! data.model.canEmbed ) { #>
					data-user-setting="urlbutton"
				<# } #>>

			<# if ( data.model.canEmbed ) { #>
				<option value="embed" selected>
					Trình điều khiển đa phương tiện nhúng				</option>
				<option value="file">
			<# } else { #>
				<option value="none" selected>
					Trống				</option>
				<option value="file">
			<# } #>
				<# if ( data.model.canEmbed ) { #>
					Liên kết tới tập tin đa phương tiện				<# } else { #>
					Tập tin đa phương tiện				<# } #>
				</option>
				<option value="post">
				<# if ( data.model.canEmbed ) { #>
					Liên kết tới trang nội dung đính kèm				<# } else { #>
					Trang nội dung đính kèm				<# } #>
				</option>
			<# if ( 'image' === data.type ) { #>
				<option value="custom">
					URL tùy chỉnh				</option>
			<# } #>
            </select>
		</span>
        <span class="setting">
			<label for="attachment-display-settings-link-to-custom" class="name">URL</label>
			<input type="text" id="attachment-display-settings-link-to-custom" class="link-to-custom"
                   data-setting="linkUrl"/>
		</span>

        <# if ( 'undefined' !== typeof data.sizes ) { #>
        <span class="setting">
				<label for="attachment-display-settings-size" class="name">Kích cỡ</label>
				<select id="attachment-display-settings-size" class="size" name="size"
                        data-setting="size"
					<# if ( data.userSettings ) { #>
						data-user-setting="imgsize"
					<# } #>>
											<#
						var size = data.sizes['thumbnail'];
						if ( size ) { #>
							<option value="thumbnail">
								Ảnh thu nhỏ &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['medium'];
						if ( size ) { #>
							<option value="medium">
								Trung bình &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['large'];
						if ( size ) { #>
							<option value="large">
								Lớn &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['full'];
						if ( size ) { #>
							<option value="full" selected='selected'>
								Kích thước đầy đủ &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
            </select>
			</span>
        <# } #>
    </script>

    <script type="text/html" id="tmpl-gallery-settings">
        <h2>Tùy chọn hiển thị bộ sưu tập</h2>

        <span class="setting">
			<label for="gallery-settings-link-to" class="name">Liên kết tới</label>
			<select id="gallery-settings-link-to" class="link-to"
                    data-setting="link"
				<# if ( data.userSettings ) { #>
					data-user-setting="urlbutton"
				<# } #>>

				<option value="post" <# if ( ! wp.media.galleryDefaults.link || 'post' === wp.media.galleryDefaults.link ) {
					#>selected="selected"<# }
				#>>
					Trang nội dung đính kèm                </option>
            <option value="file" <# if ( 'file' === wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
					Tập tin đa phương tiện                </option>
            <option value="none" <# if ( 'none' === wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
					Trống                </option>
            </select>
		</span>

        <span class="setting">
			<label for="gallery-settings-columns" class="name select-label-inline">Cột</label>
			<select id="gallery-settings-columns" class="columns" name="columns"
                    data-setting="columns">
									<option value="1" <#
						if ( 1 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						1                    </option>
                <option value="2" <#
						if ( 2 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						2                    </option>
                <option value="3" <#
						if ( 3 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						3                    </option>
                <option value="4" <#
						if ( 4 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						4                    </option>
                <option value="5" <#
						if ( 5 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						5                    </option>
                <option value="6" <#
						if ( 6 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						6                    </option>
                <option value="7" <#
						if ( 7 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						7                    </option>
                <option value="8" <#
						if ( 8 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						8                    </option>
                <option value="9" <#
						if ( 9 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						9                    </option>
							</select>
		</span>

        <span class="setting">
			<input type="checkbox" id="gallery-settings-random-order" data-setting="_orderbyRandom"/>
			<label for="gallery-settings-random-order" class="checkbox-label-inline">Thứ tự ngẫu nhiên</label>
		</span>

        <span class="setting size">
			<label for="gallery-settings-size" class="name">Kích cỡ</label>
			<select id="gallery-settings-size" class="size" name="size"
                    data-setting="size"
				<# if ( data.userSettings ) { #>
					data-user-setting="imgsize"
				<# } #>
				>
									<option value="thumbnail">
						Ảnh thu nhỏ					</option>
									<option value="medium">
						Trung bình					</option>
									<option value="large">
						Lớn					</option>
									<option value="full">
						Kích thước đầy đủ					</option>
            </select>
		</span>
    </script>

    <script type="text/html" id="tmpl-playlist-settings">
        <h2>Cài đặt danh sách phát nhạc</h2>

        <# var emptyModel = _.isEmpty( data.model ),
        isVideo = 'video' === data.controller.get('library').props.get('type'); #>

        <span class="setting">
			<input type="checkbox" id="playlist-settings-show-list" data-setting="tracklist" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<label for="playlist-settings-show-list" class="checkbox-label-inline">
				<# if ( isVideo ) { #>
				Hiển thị danh sách video				<# } else { #>
				Hiện danh sách bài hát				<# } #>
			</label>
		</span>

        <# if ( ! isVideo ) { #>
        <span class="setting">
			<input type="checkbox" id="playlist-settings-show-artist" data-setting="artists" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<label for="playlist-settings-show-artist" class="checkbox-label-inline">
				Hiện tên nghệ sĩ trong danh sách bài hát			</label>
		</span>
        <# } #>

        <span class="setting">
			<input type="checkbox" id="playlist-settings-show-images" data-setting="images" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<label for="playlist-settings-show-images" class="checkbox-label-inline">
				Hiện hình ảnh			</label>
		</span>
    </script>

    <script type="text/html" id="tmpl-embed-link-settings">
        <span class="setting link-text">
			<label for="embed-link-settings-link-text" class="name">Tên đường dẫn</label>
			<input type="text" id="embed-link-settings-link-text" class="alignment" data-setting="linkText"/>
		</span>
        <div class="embed-container" style="display: none;">
            <div class="embed-preview"></div>
        </div>
    </script>

    <script type="text/html" id="tmpl-embed-image-settings">
        <div class="wp-clearfix">
            <div class="thumbnail">
                <img src="{{ data.model.url }}" draggable="false" alt=""/>
            </div>
        </div>

        <span class="setting alt-text has-description">
			<label for="embed-image-settings-alt-text" class="name">Văn bản thay thế</label>
			<textarea id="embed-image-settings-alt-text" data-setting="alt"
                      aria-describedby="alt-text-description"></textarea>
		</span>
        <p class="description" id="alt-text-description"><a href="https://www.w3.org/WAI/tutorials/images/decision-tree"
                                                            target="_blank" rel="noopener">Xem cách mô tả nội dung
                ảnh<span class="screen-reader-text"> (mở trong cửa sổ mới)</span></a>. Để trống nếu ảnh chỉ dùng làm
            hiệu ứng trang trí.</p>

        <span class="setting caption">
				<label for="embed-image-settings-caption" class="name">Chú thích</label>
				<textarea id="embed-image-settings-caption" data-setting="caption"></textarea>
			</span>

        <fieldset class="setting-group">
            <legend class="name">Cân dòng</legend>
            <span class="setting align">
				<span class="button-group button-large" data-setting="align">
					<button class="button" value="left">
						Trái					</button>
					<button class="button" value="center">
						Chính giữa					</button>
					<button class="button" value="right">
						Phải					</button>
					<button class="button active" value="none">
						Trống					</button>
				</span>
			</span>
        </fieldset>

        <fieldset class="setting-group">
            <legend class="name">Liên kết tới</legend>
            <span class="setting link-to">
				<span class="button-group button-large" data-setting="link">
					<button class="button" value="file">
						Đường dẫn của ảnh					</button>
					<button class="button" value="custom">
						URL tùy chỉnh					</button>
					<button class="button active" value="none">
						Trống					</button>
				</span>
			</span>
            <span class="setting">
				<label for="embed-image-settings-link-to-custom" class="name">URL</label>
				<input type="text" id="embed-image-settings-link-to-custom" class="link-to-custom"
                       data-setting="linkUrl"/>
			</span>
        </fieldset>
    </script>

    <script type="text/html" id="tmpl-image-details">
        <div class="media-embed">
            <div class="embed-media-settings">
                <div class="column-settings">
					<span class="setting alt-text has-description">
						<label for="image-details-alt-text" class="name">Văn bản thay thế</label>
						<textarea id="image-details-alt-text" data-setting="alt"
                                  aria-describedby="alt-text-description">{{ data.model.alt }}</textarea>
					</span>
                    <p class="description" id="alt-text-description"><a
                                href="https://www.w3.org/WAI/tutorials/images/decision-tree" target="_blank"
                                rel="noopener">Xem cách mô tả nội dung ảnh<span class="screen-reader-text"> (mở trong cửa sổ mới)</span></a>.
                        Để trống nếu ảnh chỉ dùng làm hiệu ứng trang trí.</p>

                    <span class="setting caption">
							<label for="image-details-caption" class="name">Chú thích</label>
							<textarea id="image-details-caption"
                                      data-setting="caption">{{ data.model.caption }}</textarea>
						</span>

                    <h2>Cài đặt hiển thị</h2>
                    <fieldset class="setting-group">
                        <legend class="legend-inline">Cân dòng</legend>
                        <span class="setting align">
							<span class="button-group button-large" data-setting="align">
								<button class="button" value="left">
									Trái								</button>
								<button class="button" value="center">
									Chính giữa								</button>
								<button class="button" value="right">
									Phải								</button>
								<button class="button active" value="none">
									Trống								</button>
							</span>
						</span>
                    </fieldset>

                    <# if ( data.attachment ) { #>
                    <# if ( 'undefined' !== typeof data.attachment.sizes ) { #>
                    <span class="setting size">
								<label for="image-details-size" class="name">Kích cỡ</label>
								<select id="image-details-size" class="size" name="size"
                                        data-setting="size"
									<# if ( data.userSettings ) { #>
										data-user-setting="imgsize"
									<# } #>>
																			<#
										var size = data.sizes['thumbnail'];
										if ( size ) { #>
											<option value="thumbnail">
												Ảnh thu nhỏ &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['medium'];
										if ( size ) { #>
											<option value="medium">
												Trung bình &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['large'];
										if ( size ) { #>
											<option value="large">
												Lớn &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['full'];
										if ( size ) { #>
											<option value="full">
												Kích thước đầy đủ &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																		<option value="custom">
										Tùy chỉnh kích thước									</option>
                        </select>
							</span>
                    <# } #>
                    <div class="custom-size wp-clearfix<# if ( data.model.size !== 'custom' ) { #> hidden<# } #>">
								<span class="custom-size-setting">
									<label for="image-details-size-width">Rộng</label>
									<input type="number" id="image-details-size-width"
                                           aria-describedby="image-size-desc" data-setting="customWidth" step="1"
                                           value="{{ data.model.customWidth }}"/>
								</span>
                        <span class="sep" aria-hidden="true">&times;</span>
                        <span class="custom-size-setting">
									<label for="image-details-size-height">Cao</label>
									<input type="number" id="image-details-size-height"
                                           aria-describedby="image-size-desc" data-setting="customHeight" step="1"
                                           value="{{ data.model.customHeight }}"/>
								</span>
                        <p id="image-size-desc" class="description">Kích thước ảnh bằng đơn vị pixel</p>
                    </div>
                    <# } #>

                    <span class="setting link-to">
						<label for="image-details-link-to" class="name">Liên kết tới</label>
						<select id="image-details-link-to" data-setting="link">
						<# if ( data.attachment ) { #>
							<option value="file">
								Tập tin đa phương tiện							</option>
							<option value="post">
								Trang nội dung đính kèm							</option>
						<# } else { #>
							<option value="file">
								Đường dẫn của ảnh							</option>
						<# } #>
							<option value="custom">
								URL tùy chỉnh							</option>
							<option value="none">
								Trống							</option>
						</select>
					</span>
                    <span class="setting">
						<label for="image-details-link-to-custom" class="name">URL</label>
						<input type="text" id="image-details-link-to-custom" class="link-to-custom"
                               data-setting="linkUrl"/>
					</span>

                    <div class="advanced-section">
                        <h2>
                            <button type="button" class="button-link advanced-toggle">Tùy chọn nâng cao</button>
                        </h2>
                        <div class="advanced-settings hidden">
                            <div class="advanced-image">
								<span class="setting title-text">
									<label for="image-details-title-attribute"
                                           class="name">Thuộc tính tiêu đề hình ảnh</label>
									<input type="text" id="image-details-title-attribute" data-setting="title"
                                           value="{{ data.model.title }}"/>
								</span>
                                <span class="setting extra-classes">
									<label for="image-details-css-class" class="name">Lớp ảnh CSS</label>
									<input type="text" id="image-details-css-class" data-setting="extraClasses"
                                           value="{{ data.model.extraClasses }}"/>
								</span>
                            </div>
                            <div class="advanced-link">
								<span class="setting link-target">
									<input type="checkbox" id="image-details-link-target" data-setting="linkTargetBlank"
                                           value="_blank" <# if ( data.model.linkTargetBlank ) { #>checked="checked"<# } #>>
									<label for="image-details-link-target" class="checkbox-label">Mở liên kết trong 1 thẻ mới</label>
								</span>
                                <span class="setting link-rel">
									<label for="image-details-link-rel" class="name">Đường dẫn</label>
									<input type="text" id="image-details-link-rel" data-setting="linkRel"
                                           value="{{ data.model.linkRel }}"/>
								</span>
                                <span class="setting link-class-name">
									<label for="image-details-link-css-class" class="name">Liên kết lớp CSS</label>
									<input type="text" id="image-details-link-css-class" data-setting="linkClassName"
                                           value="{{ data.model.linkClassName }}"/>
								</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column-image">
                    <div class="image">
                        <img src="{{ data.model.url }}" draggable="false" alt=""/>
                        <# if ( data.attachment && window.imageEdit ) { #>
                        <div class="actions">
                            <input type="button" class="edit-attachment button" value="Sửa bản gốc"/>
                            <input type="button" class="replace-attachment button" value="Thay thế"/>
                        </div>
                        <# } #>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/html" id="tmpl-image-editor">
        <div id="media-head-{{ data.id }}"></div>
        <div id="image-editor-{{ data.id }}"></div>
    </script>

    <script type="text/html" id="tmpl-audio-details">
        <# var ext, html5types = {
        mp3: wp.media.view.settings.embedMimes.mp3,
        ogg: wp.media.view.settings.embedMimes.ogg
        }; #>

        <div class="media-embed media-embed-details">
            <div class="embed-media-settings embed-audio-settings">
                <audio style="visibility: hidden"
                       controls
                       class="wp-audio-shortcode"
                       width="{{ _.isUndefined( data.model.width ) ? 400 : data.model.width }}"
                       preload="{{ _.isUndefined( data.model.preload ) ? 'none' : data.model.preload }}"
                <#
                if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
                #> autoplay<#
                }
                if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
                #> loop<#
                }
                #>
                >
                <# if ( ! _.isEmpty( data.model.src ) ) { #>
                <source src="{{ data.model.src }}"
                        type="{{ wp.media.view.settings.embedMimes[ data.model.src.split('.').pop() ] }}"/>
                <# } #>

                <# if ( ! _.isEmpty( data.model.mp3 ) ) { #>
                <source src="{{ data.model.mp3 }}" type="{{ wp.media.view.settings.embedMimes[ 'mp3' ] }}"/>
                <# } #>
                <# if ( ! _.isEmpty( data.model.ogg ) ) { #>
                <source src="{{ data.model.ogg }}" type="{{ wp.media.view.settings.embedMimes[ 'ogg' ] }}"/>
                <# } #>
                <# if ( ! _.isEmpty( data.model.flac ) ) { #>
                <source src="{{ data.model.flac }}" type="{{ wp.media.view.settings.embedMimes[ 'flac' ] }}"/>
                <# } #>
                <# if ( ! _.isEmpty( data.model.m4a ) ) { #>
                <source src="{{ data.model.m4a }}" type="{{ wp.media.view.settings.embedMimes[ 'm4a' ] }}"/>
                <# } #>
                <# if ( ! _.isEmpty( data.model.wav ) ) { #>
                <source src="{{ data.model.wav }}" type="{{ wp.media.view.settings.embedMimes[ 'wav' ] }}"/>
                <# } #>
                </audio>

                <# if ( ! _.isEmpty( data.model.src ) ) {
                ext = data.model.src.split('.').pop();
                if ( html5types[ ext ] ) {
                delete html5types[ ext ];
                }
                #>
                <span class="setting">
					<label for="audio-details-source" class="name">URL</label>
					<input type="text" id="audio-details-source" readonly data-setting="src"
                           value="{{ data.model.src }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>
                <# if ( ! _.isEmpty( data.model.mp3 ) ) {
                if ( ! _.isUndefined( html5types.mp3 ) ) {
                delete html5types.mp3;
                }
                #>
                <span class="setting">
					<label for="audio-details-mp3-source" class="name">MP3</label>
					<input type="text" id="audio-details-mp3-source" readonly data-setting="mp3"
                           value="{{ data.model.mp3 }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>
                <# if ( ! _.isEmpty( data.model.ogg ) ) {
                if ( ! _.isUndefined( html5types.ogg ) ) {
                delete html5types.ogg;
                }
                #>
                <span class="setting">
					<label for="audio-details-ogg-source" class="name">OGG</label>
					<input type="text" id="audio-details-ogg-source" readonly data-setting="ogg"
                           value="{{ data.model.ogg }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>
                <# if ( ! _.isEmpty( data.model.flac ) ) {
                if ( ! _.isUndefined( html5types.flac ) ) {
                delete html5types.flac;
                }
                #>
                <span class="setting">
					<label for="audio-details-flac-source" class="name">FLAC</label>
					<input type="text" id="audio-details-flac-source" readonly data-setting="flac"
                           value="{{ data.model.flac }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>
                <# if ( ! _.isEmpty( data.model.m4a ) ) {
                if ( ! _.isUndefined( html5types.m4a ) ) {
                delete html5types.m4a;
                }
                #>
                <span class="setting">
					<label for="audio-details-m4a-source" class="name">M4A</label>
					<input type="text" id="audio-details-m4a-source" readonly data-setting="m4a"
                           value="{{ data.model.m4a }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>
                <# if ( ! _.isEmpty( data.model.wav ) ) {
                if ( ! _.isUndefined( html5types.wav ) ) {
                delete html5types.wav;
                }
                #>
                <span class="setting">
					<label for="audio-details-wav-source" class="name">WAV</label>
					<input type="text" id="audio-details-wav-source" readonly data-setting="wav"
                           value="{{ data.model.wav }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn audio</button>
				</span>
                <# } #>

                <# if ( ! _.isEmpty( html5types ) ) { #>
                <fieldset class="setting-group">
                    <legend class="name">Thêm các nguồn thay thế để hỗ trợ tối đa HTML5:</legend>
                    <span class="setting">
						<span class="button-large">
						<# _.each( html5types, function (mime, type) { #>
							<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
						<# } ) #>
						</span>
					</span>
                </fieldset>
                <# } #>

                <fieldset class="setting-group">
                    <legend class="name">Tải trước</legend>
                    <span class="setting preload">
						<span class="button-group button-large" data-setting="preload">
							<button class="button" value="auto">Tự động</button>
							<button class="button" value="metadata">Metadata</button>
							<button class="button active" value="none">Trống</button>
						</span>
					</span>
                </fieldset>

                <span class="setting-group">
					<span class="setting checkbox-setting autoplay">
						<input type="checkbox" id="audio-details-autoplay" data-setting="autoplay"/>
						<label for="audio-details-autoplay" class="checkbox-label">Phát tự động</label>
					</span>

					<span class="setting checkbox-setting">
						<input type="checkbox" id="audio-details-loop" data-setting="loop"/>
						<label for="audio-details-loop" class="checkbox-label">Lặp lại</label>
					</span>
				</span>
            </div>
        </div>
    </script>

    <script type="text/html" id="tmpl-video-details">
        <# var ext, html5types = {
        mp4: wp.media.view.settings.embedMimes.mp4,
        ogv: wp.media.view.settings.embedMimes.ogv,
        webm: wp.media.view.settings.embedMimes.webm
        }; #>

        <div class="media-embed media-embed-details">
            <div class="embed-media-settings embed-video-settings">
                <div class="wp-video-holder">
                    <#
                    var w = ! data.model.width || data.model.width > 640 ? 640 : data.model.width,
                    h = ! data.model.height ? 360 : data.model.height;

                    if ( data.model.width && w !== data.model.width ) {
                    h = Math.ceil( ( h * w ) / data.model.width );
                    }
                    #>

                    <# var w_rule = '', classes = [],
                    w, h, settings = wp.media.view.settings,
                    isYouTube = isVimeo = false;

                    if ( ! _.isEmpty( data.model.src ) ) {
                    isYouTube = data.model.src.match(/youtube|youtu\.be/);
                    isVimeo = -1 !== data.model.src.indexOf('vimeo');
                    }

                    if ( settings.contentWidth && data.model.width >= settings.contentWidth ) {
                    w = settings.contentWidth;
                    } else {
                    w = data.model.width;
                    }

                    if ( w !== data.model.width ) {
                    h = Math.ceil( ( data.model.height * w ) / data.model.width );
                    } else {
                    h = data.model.height;
                    }

                    if ( w ) {
                    w_rule = 'width: ' + w + 'px; ';
                    }

                    if ( isYouTube ) {
                    classes.push( 'youtube-video' );
                    }

                    if ( isVimeo ) {
                    classes.push( 'vimeo-video' );
                    }

                    #>
                    <div style="{{ w_rule }}" class="wp-video">
                        <video controls
                               class="wp-video-shortcode {{ classes.join( ' ' ) }}"
                        <# if ( w ) { #>width="{{ w }}"<# } #>
                        <# if ( h ) { #>height="{{ h }}"<# } #>
                        <#
                        if ( ! _.isUndefined( data.model.poster ) && data.model.poster ) {
                        #> poster="{{ data.model.poster }}"<#
                        } #>
                        preload ="{{ _.isUndefined( data.model.preload ) ? 'metadata' : data.model.preload }}"
                        <#
                        if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
                        #> autoplay<#
                        }
                        if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
                        #> loop<#
                        }
                        #>
                        >
                        <# if ( ! _.isEmpty( data.model.src ) ) {
                        if ( isYouTube ) { #>
                        <source src="{{ data.model.src }}" type="video/youtube"/>
                        <# } else if ( isVimeo ) { #>
                        <source src="{{ data.model.src }}" type="video/vimeo"/>
                        <# } else { #>
                        <source src="{{ data.model.src }}"
                                type="{{ settings.embedMimes[ data.model.src.split('.').pop() ] }}"/>
                        <# }
                        } #>

                        <# if ( data.model.mp4 ) { #>
                        <source src="{{ data.model.mp4 }}" type="{{ settings.embedMimes[ 'mp4' ] }}"/>
                        <# } #>
                        <# if ( data.model.m4v ) { #>
                        <source src="{{ data.model.m4v }}" type="{{ settings.embedMimes[ 'm4v' ] }}"/>
                        <# } #>
                        <# if ( data.model.webm ) { #>
                        <source src="{{ data.model.webm }}" type="{{ settings.embedMimes[ 'webm' ] }}"/>
                        <# } #>
                        <# if ( data.model.ogv ) { #>
                        <source src="{{ data.model.ogv }}" type="{{ settings.embedMimes[ 'ogv' ] }}"/>
                        <# } #>
                        <# if ( data.model.flv ) { #>
                        <source src="{{ data.model.flv }}" type="{{ settings.embedMimes[ 'flv' ] }}"/>
                        <# } #>
                        {{{ data.model.content }}}
                        </video>
                    </div>

                    <# if ( ! _.isEmpty( data.model.src ) ) {
                    ext = data.model.src.split('.').pop();
                    if ( html5types[ ext ] ) {
                    delete html5types[ ext ];
                    }
                    #>
                    <span class="setting">
					<label for="video-details-source" class="name">URL</label>
					<input type="text" id="video-details-source" readonly data-setting="src"
                           value="{{ data.model.src }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                    <# if ( ! _.isEmpty( data.model.mp4 ) ) {
                    if ( ! _.isUndefined( html5types.mp4 ) ) {
                    delete html5types.mp4;
                    }
                    #>
                    <span class="setting">
					<label for="video-details-mp4-source" class="name">MP4</label>
					<input type="text" id="video-details-mp4-source" readonly data-setting="mp4"
                           value="{{ data.model.mp4 }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                    <# if ( ! _.isEmpty( data.model.m4v ) ) {
                    if ( ! _.isUndefined( html5types.m4v ) ) {
                    delete html5types.m4v;
                    }
                    #>
                    <span class="setting">
					<label for="video-details-m4v-source" class="name">M4V</label>
					<input type="text" id="video-details-m4v-source" readonly data-setting="m4v"
                           value="{{ data.model.m4v }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                    <# if ( ! _.isEmpty( data.model.webm ) ) {
                    if ( ! _.isUndefined( html5types.webm ) ) {
                    delete html5types.webm;
                    }
                    #>
                    <span class="setting">
					<label for="video-details-webm-source" class="name">WEBM</label>
					<input type="text" id="video-details-webm-source" readonly data-setting="webm"
                           value="{{ data.model.webm }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                    <# if ( ! _.isEmpty( data.model.ogv ) ) {
                    if ( ! _.isUndefined( html5types.ogv ) ) {
                    delete html5types.ogv;
                    }
                    #>
                    <span class="setting">
					<label for="video-details-ogv-source" class="name">OGV</label>
					<input type="text" id="video-details-ogv-source" readonly data-setting="ogv"
                           value="{{ data.model.ogv }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                    <# if ( ! _.isEmpty( data.model.flv ) ) {
                    if ( ! _.isUndefined( html5types.flv ) ) {
                    delete html5types.flv;
                    }
                    #>
                    <span class="setting">
					<label for="video-details-flv-source" class="name">FLV</label>
					<input type="text" id="video-details-flv-source" readonly data-setting="flv"
                           value="{{ data.model.flv }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ nguồn video</button>
				</span>
                    <# } #>
                </div>

                <# if ( ! _.isEmpty( html5types ) ) { #>
                <fieldset class="setting-group">
                    <legend class="name">Thêm các nguồn thay thế để hỗ trợ tối đa HTML5:</legend>
                    <span class="setting">
						<span class="button-large">
						<# _.each( html5types, function (mime, type) { #>
							<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
						<# } ) #>
						</span>
					</span>
                </fieldset>
                <# } #>

                <# if ( ! _.isEmpty( data.model.poster ) ) { #>
                <span class="setting">
					<label for="video-details-poster-image" class="name">Ảnh poster</label>
					<input type="text" id="video-details-poster-image" readonly data-setting="poster"
                           value="{{ data.model.poster }}"/>
					<button type="button" class="button-link remove-setting">Loại bỏ ảnh quảng cáo</button>
				</span>
                <# } #>

                <fieldset class="setting-group">
                    <legend class="name">Tải trước</legend>
                    <span class="setting preload">
						<span class="button-group button-large" data-setting="preload">
							<button class="button" value="auto">Tự động</button>
							<button class="button" value="metadata">Metadata</button>
							<button class="button active" value="none">Trống</button>
						</span>
					</span>
                </fieldset>

                <span class="setting-group">
					<span class="setting checkbox-setting autoplay">
						<input type="checkbox" id="video-details-autoplay" data-setting="autoplay"/>
						<label for="video-details-autoplay" class="checkbox-label">Phát tự động</label>
					</span>

					<span class="setting checkbox-setting">
						<input type="checkbox" id="video-details-loop" data-setting="loop"/>
						<label for="video-details-loop" class="checkbox-label">Lặp lại</label>
					</span>
				</span>

                <span class="setting" data-setting="content">
					<#
					var content = '';
					if ( ! _.isEmpty( data.model.content ) ) {
						var tracks = jQuery( data.model.content ).filter( 'track' );
						_.each( tracks.toArray(), function( track, index ) {
							content += track.outerHTML; #>
						<label for="video-details-track-{{ index }}" class="name">Bài hát (phụ đề, chú thích, mô tả, chương, hoặc siêu dữ liệu)</label>
						<input class="content-track" type="text" id="video-details-track-{{ index }}"
                               aria-describedby="video-details-track-desc-{{ index }}" value="{{ track.outerHTML }}"/>
						<span class="description" id="video-details-track-desc-{{ index }}">
						Giá trị srclang, label, và kind có thể đã được chỉnh sửa để thêm phụ đề và thể loại.						</span>
						<button type="button"
                                class="button-link remove-setting remove-track">Loại bỏ video</button><br/>
						<# } ); #>
					<# } else { #>
					<span class="name">Bài hát (phụ đề, chú thích, mô tả, chương, hoặc siêu dữ liệu)</span><br/>
					<em>Không có phụ đề liên quan.</em>
					<# } #>
					<textarea class="hidden content-setting">{{ content }}</textarea>
				</span>
            </div>
        </div>
    </script>

    <script type="text/html" id="tmpl-editor-gallery">
        <# if ( data.attachments.length ) { #>
        <div class="gallery gallery-columns-{{ data.columns }}">
            <# _.each( data.attachments, function( attachment, index ) { #>
            <dl class="gallery-item">
                <dt class="gallery-icon">
                    <# if ( attachment.thumbnail ) { #>
                    <img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}"
                         height="{{ attachment.thumbnail.height }}" alt="{{ attachment.alt }}"/>
                    <# } else { #>
                    <img src="{{ attachment.url }}" alt="{{ attachment.alt }}"/>
                    <# } #>
                </dt>
                <# if ( attachment.caption ) { #>
                <dd class="wp-caption-text gallery-caption">
                    {{{ data.verifyHTML( attachment.caption ) }}}
                </dd>
                <# } #>
            </dl>
            <# if ( index % data.columns === data.columns - 1 ) { #>
            <br style="clear: both;"/>
            <# } #>
            <# } ); #>
        </div>
        <# } else { #>
        <div class="wpview-error">
            <div class="dashicons dashicons-format-gallery"></div>
            <p>Không có mục nào được tìm thấy.</p>
        </div>
        <# } #>
    </script>

    <script type="text/html" id="tmpl-crop-content">
        <img class="crop-image" src="{{ data.url }}"
             alt="Xem trước vùng cắt hình ảnh khu vực. Yêu cầu tương tác với chuột."/>
        <div class="upload-errors"></div>
    </script>

    <script type="text/html" id="tmpl-site-icon-preview">
        <h2>Xem thử</h2>
        <strong aria-hidden="true">Là một biểu tượng trình duyệt</strong>
        <div class="favicon-preview">
            <img src="http://localhost/wordpress/wp-admin/images/browser.png" class="browser-preview" width="182"
                 height="" alt=""/>

            <div class="favicon">
                <img id="preview-favicon" src="{{ data.url }}" alt="Xem trước biểu tượng trình duyệt"/>
            </div>
            <span class="browser-title" aria-hidden="true"><# print( 'Wordpress' ) #></span>
        </div>

        <strong aria-hidden="true">Xem trước như là một biểu tượng ứng dụng</strong>
        <div class="app-icon-preview">
            <img id="preview-app-icon" src="{{ data.url }}" alt="Xem trước biểu tượng ứng dụng"/>
        </div>
    </script>

    <!-- WooCommerce Tracks -->
    <script type="text/javascript">
        window.wcTracks = window.wcTracks || {};
        window.wcTracks.isEnabled = true;
        window._tkq = window._tkq || [];

        window.wcTracks.validateEvent = function (eventName, props = {}) {
            let isValid = true;
            if (!/^(([a-z0-9]+)_){1}([a-z0-9_]+)$/.test(eventName)) {
                if (false) {
                    /* eslint-disable no-console */
                    console.error(
                        `A valid event name must be specified. The event name: "${eventName}" is not valid.`
                    );
                    /* eslint-enable no-console */
                }
                isValid = false;
            }
            for (const prop of Object.keys(props)) {
                if (!/^[a-z_][a-z0-9_]*$/.test(prop)) {
                    if (false) {
                        /* eslint-disable no-console */
                        console.error(
                            `A valid prop name must be specified. The property name: "${prop}" is not valid.`
                        );
                        /* eslint-enable no-console */
                    }
                    isValid = false;
                }
            }
            return isValid;
        }
        window.wcTracks.recordEvent = function (name, properties) {
            if (!window.wcTracks.isEnabled) {
                return;
            }

            const eventName = 'wcadmin_' + name;
            let eventProperties = properties || {};
            eventProperties = {
                ...eventProperties, ...{
                    "_via_ua": "Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/113.0.0.0 Safari\/537.36",
                    "_via_ip": "::1",
                    "_lg": "vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
                    "_dr": "",
                    "_dl": "http:\/\/localhost\/wordpress\/wp-admin\/edit-tags.php?taxonomy=product_cat&post_type=product",
                    "url": "http:\/\/localhost\/wordpress",
                    "blog_lang": "vi",
                    "blog_id": false,
                    "products_count": 0,
                    "wc_version": "7.9.0"
                }
            };
            if (window.wp && window.wp.hooks && window.wp.hooks.applyFilters) {
                eventProperties = window.wp.hooks.applyFilters('woocommerce_tracks_client_event_properties', eventProperties, eventName);
                delete (eventProperties._ui);
                delete (eventProperties._ut);
            }

            if (!window.wcTracks.validateEvent(eventName, eventProperties)) {
                return;
            }
            window._tkq.push(['recordEvent', eventName, eventProperties]);
        }
    </script>
    <!-- WooCommerce JavaScript -->
    <script type="text/javascript">
        jQuery(function ($) {
            (function ($) {
                'use strict';
                // Hook on submit button and sets a 500ms interval function
                // to determine successful add tag or otherwise.
                $('#addtag #submit').on('click', function () {
                    const initialCount = $('.tags tbody > tr').length;
                    const interval = setInterval(function () {
                        if ($('.tags tbody > tr').length > initialCount) {
                            // New tag detected.
                            clearInterval(interval);
                            wp.data.dispatch('wc/customer-effort-score').addCesSurvey({
                                action: 'add_product_categories',
                                title: 'How easy was it to add product category?',
                                firstQuestion: 'The product category details screen is easy to use.',
                                secondQuestion: 'The product category details screen\'s functionality meets my needs.',
                                onsubmitLabel: 'Thank you for your feedback!'
                            });
                        } else {
                            // Form is no longer loading, most likely failed.
                            if ($('#addtag .submit .spinner.is-active').length < 1) {
                                clearInterval(interval);
                            }
                        }
                    }, 500);
                });
            })(jQuery);

            jQuery('a.wc-rating-link').on('click', function () {
                jQuery.post('/wordpress/wp-admin/admin-ajax.php', {action: 'woocommerce_rated'});
                jQuery(this).parent().text(jQuery(this).data('rated'));
            });

            (function ($) {
                'use strict';
                var product_cat = $('tr#tag-18');
                product_cat.find('th').empty();
                product_cat.find('td.thumb span').detach('span').appendTo(product_cat.find('th'));
            })(jQuery);

            jQuery(function ($) {
                function wcFreeShippingShowHideMinAmountField(el) {
                    var form = $(el).closest('form');
                    var minAmountField = $('#woocommerce_free_shipping_min_amount', form).closest('tr');
                    var ignoreDiscountField = $('#woocommerce_free_shipping_ignore_discounts', form).closest('tr');
                    if ('coupon' === $(el).val() || '' === $(el).val()) {
                        minAmountField.hide();
                        ignoreDiscountField.hide();
                    } else {
                        minAmountField.show();
                        ignoreDiscountField.show();
                    }
                }

                $(document.body).on('change', '#woocommerce_free_shipping_requires', function () {
                    wcFreeShippingShowHideMinAmountField(this);
                });

                // Change while load.
                $('#woocommerce_free_shipping_requires').trigger('change');
                $(document.body).on('wc_backbone_modal_loaded', function (evt, target) {
                    if ('wc-modal-shipping-method-settings' === target) {
                        wcFreeShippingShowHideMinAmountField($('#wc-backbone-modal-dialog #woocommerce_free_shipping_requires', evt.currentTarget));
                    }
                });
            });
        });
    </script>
    <div id="wp-auth-check-wrap" class="hidden">
        <div id="wp-auth-check-bg"></div>
        <div id="wp-auth-check">
            <button type="button" class="wp-auth-check-close button-link"><span class="screen-reader-text">
		Đóng hộp thoại	</span></button>
            <div id="wp-auth-check-form" class="loading"
                 data-src="http://localhost/wordpress/wp-login.php?interim-login=1&#038;wp_lang=vi"></div>
            <div class="wp-auth-fallback">
                <p><b class="wp-auth-fallback-expired" tabindex="0">Phiên làm việc đã hết hạn</b></p>
                <p><a href="http://localhost/wordpress/wp-login.php" target="_blank">Hãy đăng nhập lại.</a>
                    Trang đăng nhập sẽ được mở trong cửa sổ mới. Sau khi đăng nhập, bạn có thể đóng cửa sổ và quay lại
                    trang hiện tại.</p>
            </div>
        </div>
    </div>
    <script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=hoverIntent&amp;ver=6.2.2'></script>
    <script id='common-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-08-03 11:30:24+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {"domain": "messages", "plural-forms": "nplurals=1; plural=0;", "lang": "vi_VN"},
                    "%1$s is deprecated since version %2$s with no alternative available.": ["%1$s \u0111\u00e3 ng\u1eebng ho\u1ea1t \u0111\u1ed9ng t\u1eeb phi\u00ean b\u1ea3n %2$s v\u00e0 kh\u00f4ng c\u00f3 ph\u01b0\u01a1ng \u00e1n thay th\u1ebf."],
                    "%1$s is deprecated since version %2$s! Use %3$s instead.": ["%1$s \u0111\u00e3 b\u1ecb ng\u1eebng s\u1eed d\u1ee5ng t\u1eeb phi\u00ean b\u1ea3n %2$s! H\u00e3y s\u1eed d\u1ee5ng %3$s."],
                    "Expand Main menu": ["M\u1edf r\u1ed9ng menu ch\u00ednh"],
                    "Dismiss this notice.": ["B\u1ecf qua th\u00f4ng b\u00e1o n\u00e0y "],
                    "You are about to permanently delete these items from your site.\nThis action cannot be undone.\n'Cancel' to stop, 'OK' to delete.": ["B\u1ea1n s\u1eafp x\u00f3a v\u0129nh vi\u1ec5n nh\u1eefng m\u1ee5c n\u00e0y kh\u1ecfi trang web c\u1ee7a b\u1ea1n.\nH\u00e0nh \u0111\u1ed9ng n\u00e0y kh\u00f4ng th\u1ec3 ho\u00e0n t\u00e1c.\n 'H\u1ee7y' \u0111\u1ec3 d\u1eebng, 'OK' \u0111\u1ec3 x\u00f3a."],
                    "Collapse Main menu": ["Thu nh\u1ecf menu ch\u00ednh"]
                }
            },
            "comment": {"reference": "wp-admin\/js\/common.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/common.min.js?ver=6.2.2' id='common-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/hoverintent-js.min.js?ver=2.2.1'
            id='hoverintent-js-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/admin-bar.min.js?ver=6.2.2' id='admin-bar-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca'
            id='wp-dom-ready-js'></script>
    <script id='wp-a11y-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    }, "Notifications": ["Th\u00f4ng b\u00e1o"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/a11y.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/a11y.min.js?ver=ecce20f002eda4c19664'
            id='wp-a11y-js'></script>
    <script id='wp-ajax-response-js-extra'>
        var wpAjax = {
            "noPerm": "Xin l\u1ed7i, b\u1ea1n kh\u00f4ng \u0111\u01b0\u1ee3c ph\u00e9p l\u00e0m \u0111i\u1ec1u \u0111\u00f3.",
            "broken": "C\u00f3 l\u1ed7i g\u00ec \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-ajax-response.min.js?ver=6.2.2'
            id='wp-ajax-response-js'></script>
    <script id='admin-tags-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Something went wrong.": ["C\u00f3 l\u1ed7i g\u00ec \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."],
                    "Sorry, you are not allowed to do that.": ["Xin l\u1ed7i, b\u1ea1n kh\u00f4ng \u0111\u01b0\u1ee3c ph\u00e9p l\u00e0m \u0111i\u1ec1u \u0111\u00f3."]
                }
            },
            "comment": {"reference": "wp-admin\/js\/tags.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/tags.min.js?ver=6.2.2' id='admin-tags-js'></script>
    <script id='inline-edit-tax-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-08-03 11:30:24+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Error while saving the changes.": ["C\u00f3 l\u1ed7i x\u1ea3y ra khi l\u01b0u c\u00e1c thay \u0111\u1ed5i."],
                    "Changes saved.": ["Thay \u0111\u1ed5i \u0111\u00e3 \u0111\u01b0\u1ee3c l\u01b0u."]
                }
            },
            "comment": {"reference": "wp-admin\/js\/inline-edit-tax.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/inline-edit-tax.min.js?ver=6.2.2'
            id='inline-edit-tax-js'></script>
    <script src='http://localhost/wordpress/wp-admin/js/svg-painter.js?ver=6.2.2' id='svg-painter-js'></script>
    <script id='heartbeat-js-extra'>
        var heartbeatSettings = {"nonce": "1772a0636c"};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/heartbeat.min.js?ver=6.2.2' id='heartbeat-js'></script>
    <script id='wp-auth-check-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Your session has expired. You can log in again from this page or go to the login page.": ["Phi\u00ean l\u00e0m vi\u1ec7c c\u1ee7a b\u1ea1n \u0111\u00e3 h\u1ebft h\u1ea1n. H\u00e3y \u0111\u0103ng nh\u1eadp l\u1ea1i t\u1ea1i \u0111\u00e2y ho\u1eb7c t\u1ea1i trang \u0111\u0103ng nh\u1eadp."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/wp-auth-check.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-auth-check.min.js?ver=6.2.2'
            id='wp-auth-check-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/menu.min.js?ver=1.13.2'
            id='jquery-ui-menu-js'></script>
    <script id='jquery-ui-autocomplete-js-extra'>
        var uiAutocompleteL10n = {
            "noResults": "Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3.",
            "oneResult": "\u0110\u00e3 t\u00ecm th\u1ea5y 1 k\u1ebft qu\u1ea3. H\u00e3y d\u00f9ng ph\u00edm l\u00ean v\u00e0 xu\u1ed1ng \u0111\u1ec3 di chuy\u1ec3n.",
            "manyResults": "%d k\u1ebft qu\u1ea3 \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y. S\u1eed d\u1ee5ng ph\u00edm l\u00ean \/ xu\u1ed1ng \u0111\u1ec3 xem.",
            "itemSelected": "M\u1ee5c \u0111\u01b0\u1ee3c ch\u1ecdn."
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/jquery/ui/autocomplete.min.js?ver=1.13.2'
            id='jquery-ui-autocomplete-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/underscore.min.js?ver=1.13.4' id='underscore-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/shortcode.min.js?ver=6.2.2' id='shortcode-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/backbone.min.js?ver=1.4.1' id='backbone-js'></script>
    <script id='wp-util-js-extra'>
        var _wpUtilSettings = {"ajax": {"url": "\/wordpress\/wp-admin\/admin-ajax.php"}};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-util.min.js?ver=6.2.2' id='wp-util-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/wp-backbone.min.js?ver=6.2.2' id='wp-backbone-js'></script>
    <script id='media-models-js-extra'>
        var _wpMediaModelsL10n = {"settings": {"ajaxurl": "\/wordpress\/wp-admin\/admin-ajax.php", "post": {"id": 0}}};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/media-models.min.js?ver=6.2.2' id='media-models-js'></script>
    <script id='wp-plupload-js-extra'>
        var pluploadL10n = {
            "queue_limit_exceeded": "B\u1ea1n cho qu\u00e1 nhi\u1ec1u t\u1eadp tin v\u00e0o danh s\u00e1ch.",
            "file_exceeds_size_limit": "T\u1eadp tin %s c\u00f3 dung l\u01b0\u1ee3ng v\u01b0\u1ee3t qu\u00e1 m\u1ee9c t\u1ed1i \u0111a \u0111\u01b0\u1ee3c ph\u00e9p t\u1ea3i l\u00ean.",
            "zero_byte_file": "T\u1eadp tin r\u1ed7ng. H\u00e3y th\u1eed l\u1ea1i t\u1eadp tin kh\u00e1c.",
            "invalid_filetype": "R\u1ea5t ti\u1ebfc, b\u1ea1n kh\u00f4ng \u0111\u01b0\u1ee3c ph\u00e9p t\u1ea3i l\u00ean \u0111\u1ecbnh d\u1ea1ng t\u1eadp tin n\u00e0y.",
            "not_an_image": "T\u1eadp tin n\u00e0y kh\u00f4ng ph\u1ea3i l\u00e0 h\u00ecnh \u1ea3nh. H\u00e3y th\u1eed t\u1eadp tin kh\u00e1c.",
            "image_memory_exceeded": "Kh\u00f4ng \u0111\u1ee7 b\u1ed9 nh\u1edb. Vui l\u00f2ng th\u1eed t\u1eadp tin kh\u00e1c nh\u1eb9 h\u01a1n.",
            "image_dimensions_exceeded": "T\u1eadp tin n\u00e0y l\u1edbn h\u01a1n dung l\u01b0\u1ee3ng t\u1ed1i \u0111a cho ph\u00e9p. H\u00e3y th\u1eed t\u1eadp tin kh\u00e1c.",
            "default_error": "L\u1ed7i khi t\u1ea3i l\u00ean. H\u00e3y th\u1eed l\u1ea1i sau.",
            "missing_upload_url": "L\u1ed7i c\u00e0i \u0111\u1eb7t. H\u00e3y li\u00ean h\u1ec7 v\u1edbi qu\u1ea3n l\u00fd c\u1ee7a m\u00e1y ch\u1ee7.",
            "upload_limit_exceeded": "B\u1ea1n ch\u1ec9 \u0111\u01b0\u1ee3c t\u1ea3i m\u1ed9t t\u1eadp tin l\u00ean.",
            "http_error": "C\u00f3 ph\u1ea3n h\u1ed3i kh\u00f4ng mong mu\u1ed1n t\u1eeb m\u00e1y ch\u1ee7. C\u00e1c file c\u00f3 th\u1ec3 \u0111\u00e3 \u0111\u01b0\u1ee3c t\u1ea3i l\u00ean th\u00e0nh c\u00f4ng. Ki\u1ec3m tra trong Th\u01b0 vi\u1ec7n ho\u1eb7c t\u1ea3i l\u1ea1i trang.",
            "http_error_image": "The server cannot process the image. This can happen if the server is busy or does not have enough resources to complete the task. Uploading a smaller image may help. Suggested maximum size is 2560 pixels.",
            "upload_failed": "T\u1ea3i l\u00ean kh\u00f4ng th\u00e0nh c\u00f4ng.",
            "big_upload_failed": "Xin vui l\u00f2ng th\u1eed t\u1ea3i l\u00ean t\u1eadp tin n\u00e0y v\u1edbi %1$sbrowser uploader%2$s.",
            "big_upload_queued": "%s v\u01b0\u1ee3t qu\u00e1 k\u00edch th\u01b0\u1edbc t\u1ea3i l\u00ean t\u1ed1i \u0111a trong ch\u01b0\u01a1ng tr\u00ecnh T\u1ea3i l\u00ean b\u1eb1ng tr\u00ecnh duy\u1ec7t c\u1ee7a b\u1ea1n",
            "io_error": "L\u1ed7i IO.",
            "security_error": "L\u1ed7i b\u1ea3o m\u1eadt.",
            "file_cancelled": "T\u1eadp tin b\u1ecb h\u1ee7y b\u1ecf.",
            "upload_stopped": "T\u1ea3i l\u00ean b\u1ecb d\u1eebng.",
            "dismiss": "H\u1ee7y",
            "crunching": "\u0110ang x\u1eed l\u00fd\u2026",
            "deleted": "\u0111\u00e3 b\u1ecb chuy\u1ec3n v\u00e0o Th\u00f9ng r\u00e1c.",
            "error_uploading": "\u201c%s\u201d kh\u00f4ng th\u1ec3 t\u1ea3i l\u00ean.",
            "unsupported_image": "H\u00ecnh \u1ea3nh n\u00e0y kh\u00f4ng th\u1ec3 \u0111\u01b0\u1ee3c hi\u1ec3n th\u1ecb trong tr\u00ecnh duy\u1ec7t web. \u0110\u1ec3 c\u00f3 k\u1ebft qu\u1ea3 t\u1ed1t nh\u1ea5t, h\u00e3y chuy\u1ec3n n\u00f3 th\u00e0nh JPEG tr\u01b0\u1edbc khi t\u1ea3i l\u00ean.",
            "noneditable_image": "M\u00e1y ch\u1ee7 web kh\u00f4ng th\u1ec3 x\u1eed l\u00fd h\u00ecnh \u1ea3nh n\u00e0y. Chuy\u1ec3n \u0111\u1ed5i n\u00f3 th\u00e0nh JPEG ho\u1eb7c PNG tr\u01b0\u1edbc khi t\u1ea3i l\u00ean.",
            "file_url_copied": "URL c\u1ee7a file \u0111\u00e3 \u0111\u01b0\u1ee3c sao ch\u00e9p v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m"
        };
        var _wpPluploadSettings = {
            "defaults": {
                "file_data_name": "async-upload",
                "url": "\/wordpress\/wp-admin\/async-upload.php",
                "filters": {
                    "max_file_size": "41943040b",
                    "mime_types": [{"extensions": "jpg,jpeg,jpe,gif,png,bmp,tiff,tif,webp,ico,heic,asf,asx,wmv,wmx,wm,avi,divx,flv,mov,qt,mpeg,mpg,mpe,mp4,m4v,ogv,webm,mkv,3gp,3gpp,3g2,3gp2,txt,asc,c,cc,h,srt,csv,tsv,ics,rtx,css,htm,html,vtt,dfxp,mp3,m4a,m4b,aac,ra,ram,wav,ogg,oga,flac,mid,midi,wma,wax,mka,rtf,js,pdf,class,tar,zip,gz,gzip,rar,7z,psd,xcf,doc,pot,pps,ppt,wri,xla,xls,xlt,xlw,mdb,mpp,docx,docm,dotx,dotm,xlsx,xlsm,xlsb,xltx,xltm,xlam,pptx,pptm,ppsx,ppsm,potx,potm,ppam,sldx,sldm,onetoc,onetoc2,onetmp,onepkg,oxps,xps,odt,odp,ods,odg,odc,odb,odf,wp,wpd,key,numbers,pages"}]
                },
                "heic_upload_error": true,
                "multipart_params": {"action": "upload-attachment", "_wpnonce": "8cc5fd3763"}
            }, "browser": {"mobile": false, "supported": true}, "limitExceeded": false
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/plupload/wp-plupload.min.js?ver=6.2.2'
            id='wp-plupload-js'></script>
    <script id='mediaelement-core-js-before'>
        var mejsL10n = {
            "language": "vi", "strings": {
                "mejs.download-file": "T\u1ea3i v\u1ec1 t\u1eadp tin",
                "mejs.install-flash": "B\u1ea1n \u0111ang s\u1eed d\u1ee5ng tr\u00ecnh duy\u1ec7t kh\u00f4ng h\u1ed7 tr\u1ee3 Flash player. Vui l\u00f2ng b\u1eadt ho\u1eb7c c\u00e0i \u0111\u1eb7t \n phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t t\u1ea1i https:\/\/get.adobe.com\/flashplayer\/",
                "mejs.fullscreen": "To\u00e0n m\u00e0n h\u00ecnh",
                "mejs.play": "Ch\u1ea1y",
                "mejs.pause": "T\u1ea1m d\u1eebng",
                "mejs.time-slider": "Th\u1eddi gian tr\u00ecnh chi\u1ebfu",
                "mejs.time-help-text": "S\u1eed d\u1ee5ng c\u00e1c ph\u00edm m\u0169i t\u00ean Tr\u00e1i\/Ph\u1ea3i \u0111\u1ec3 ti\u1ebfn m\u1ed9t gi\u00e2y, m\u0169i t\u00ean L\u00ean\/Xu\u1ed1ng \u0111\u1ec3 ti\u1ebfn m\u01b0\u1eddi gi\u00e2y.",
                "mejs.live-broadcast": "Tr\u1ef1c ti\u1ebfp",
                "mejs.volume-help-text": "S\u1eed d\u1ee5ng c\u00e1c ph\u00edm m\u0169i t\u00ean L\u00ean\/Xu\u1ed1ng \u0111\u1ec3 t\u0103ng ho\u1eb7c gi\u1ea3m \u00e2m l\u01b0\u1ee3ng.",
                "mejs.unmute": "B\u1eadt ti\u1ebfng",
                "mejs.mute": "T\u1eaft ti\u1ebfng",
                "mejs.volume-slider": "\u00c2m l\u01b0\u1ee3ng Tr\u00ecnh chi\u1ebfu",
                "mejs.video-player": "Tr\u00ecnh ch\u01a1i Video",
                "mejs.audio-player": "Tr\u00ecnh ch\u01a1i Audio",
                "mejs.captions-subtitles": "Ph\u1ee5 \u0111\u1ec1",
                "mejs.captions-chapters": "C\u00e1c m\u1ee5c",
                "mejs.none": "Tr\u1ed1ng",
                "mejs.afrikaans": "Ti\u1ebfng Nam Phi",
                "mejs.albanian": "Ti\u1ebfng Albani",
                "mejs.arabic": "Ti\u1ebfng \u1ea2 R\u1eadp",
                "mejs.belarusian": "Ti\u1ebfng Belarus",
                "mejs.bulgarian": "Ti\u1ebfng Bulgari",
                "mejs.catalan": "Ti\u1ebfng Catalan",
                "mejs.chinese": "Ti\u1ebfng Trung Qu\u1ed1c",
                "mejs.chinese-simplified": "Ti\u1ebfng Trung Qu\u1ed1c (gi\u1ea3n th\u1ec3)",
                "mejs.chinese-traditional": "Ti\u1ebfng Trung ( Ph\u1ed3n th\u1ec3 )",
                "mejs.croatian": "Ti\u1ebfng Croatia",
                "mejs.czech": "Ti\u1ebfng S\u00e9c",
                "mejs.danish": "Ti\u1ebfng \u0110an M\u1ea1ch",
                "mejs.dutch": "Ti\u1ebfng H\u00e0 Lan",
                "mejs.english": "Ti\u1ebfng Anh",
                "mejs.estonian": "Ti\u1ebfng Estonia",
                "mejs.filipino": "Ti\u1ebfng Philippin",
                "mejs.finnish": "Ti\u1ebfng Ph\u1ea7n Lan",
                "mejs.french": "Ti\u1ebfng Ph\u00e1p",
                "mejs.galician": "Ti\u1ebfng Galicia",
                "mejs.german": "Ti\u1ebfng \u0110\u1ee9c",
                "mejs.greek": "Ti\u1ebfng Hy L\u1ea1p",
                "mejs.haitian-creole": "Ti\u1ebfng Haiti",
                "mejs.hebrew": "Ti\u1ebfng Do Th\u00e1i",
                "mejs.hindi": "Ti\u1ebfng Hindu",
                "mejs.hungarian": "Ti\u1ebfng Hungary",
                "mejs.icelandic": "Ti\u1ebfng Ailen",
                "mejs.indonesian": "Ti\u1ebfng Indonesia",
                "mejs.irish": "Ti\u1ebfng Ailen",
                "mejs.italian": "Ti\u1ebfng \u00dd",
                "mejs.japanese": "Ti\u1ebfng Nh\u1eadt",
                "mejs.korean": "Ti\u1ebfng H\u00e0n Qu\u1ed1c",
                "mejs.latvian": "Ti\u1ebfng Latvia",
                "mejs.lithuanian": "Ti\u1ebfng Lithuani",
                "mejs.macedonian": "Ti\u1ebfng Macedonia",
                "mejs.malay": "Ti\u1ebfng Malaysia",
                "mejs.maltese": "Ti\u1ebfng Maltese",
                "mejs.norwegian": "Ti\u1ebfng Na Uy",
                "mejs.persian": "Ti\u1ebfng Ba T\u01b0",
                "mejs.polish": "Ti\u1ebfng Ba Lan",
                "mejs.portuguese": "Ti\u1ebfng B\u1ed3 \u0110\u00e0o Nha",
                "mejs.romanian": "Ti\u1ebfng Romani",
                "mejs.russian": "Ti\u1ebfng Nga",
                "mejs.serbian": "Ti\u1ebfng Serbia",
                "mejs.slovak": "Ti\u1ebfng Slovakia",
                "mejs.slovenian": "Ti\u1ebfng Slovenia",
                "mejs.spanish": "Ti\u1ebfng T\u00e2y Ban Nha",
                "mejs.swahili": "Ti\u1ebfng Swahili",
                "mejs.swedish": "Ti\u1ebfng Th\u1ee5y \u0110i\u1ec3n",
                "mejs.tagalog": "Ti\u1ebfng Tagalog",
                "mejs.thai": "Ti\u1ebfng Th\u00e1i",
                "mejs.turkish": "Ti\u1ebfng Th\u1ed5 Nh\u0129 K\u00ec",
                "mejs.ukrainian": "Ti\u1ebfng Ukraina",
                "mejs.vietnamese": "Ti\u1ebfng Vi\u1ec7t",
                "mejs.welsh": "Ti\u1ebfng Welsh",
                "mejs.yiddish": "Ti\u1ebfng Yiddish"
            }
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=4.2.17'
            id='mediaelement-core-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/mediaelement/mediaelement-migrate.min.js?ver=6.2.2'
            id='mediaelement-migrate-js'></script>
    <script id='mediaelement-js-extra'>
        var _wpmejsSettings = {
            "pluginPath": "\/wordpress\/wp-includes\/js\/mediaelement\/",
            "classPrefix": "mejs-",
            "stretching": "responsive",
            "audioShortcodeLibrary": "mediaelement",
            "videoShortcodeLibrary": "mediaelement"
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=6.2.2'
            id='wp-mediaelement-js'></script>
    <script id='wp-api-request-js-extra'>
        var wpApiSettings = {
            "root": "http:\/\/localhost\/wordpress\/wp-json\/",
            "nonce": "2f275b4af8",
            "versionString": "wp\/v2\/"
        };
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/api-request.min.js?ver=6.2.2'
            id='wp-api-request-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/clipboard.min.js?ver=2.0.11' id='clipboard-js'></script>
    <script id='media-views-js-extra'>
        var _wpMediaViewsL10n = {
            "mediaFrameDefaultTitle": "Media",
            "url": "URL",
            "addMedia": "Th\u00eam media",
            "search": "T\u00ecm ki\u1ebfm",
            "select": "Ch\u1ecdn",
            "cancel": "H\u1ee7y",
            "update": "C\u1eadp nh\u1eadt",
            "replace": "Thay th\u1ebf",
            "remove": "X\u00f3a b\u1ecf",
            "back": "Tr\u1edf l\u1ea1i",
            "selected": "%d \u0111\u01b0\u1ee3c ch\u1ecdn",
            "dragInfo": "K\u00e9o v\u00e0 th\u1ea3 \u0111\u1ec3 s\u1eafp x\u1ebfp l\u1ea1i v\u1ecb tr\u00ed c\u1ee7a c\u00e1c file \u0111a ph\u01b0\u01a1ng ti\u1ec7n.",
            "uploadFilesTitle": "T\u1ea3i file",
            "uploadImagesTitle": "T\u1ea3i \u1ea3nh",
            "mediaLibraryTitle": "Media",
            "insertMediaTitle": "Th\u00eam media",
            "createNewGallery": "T\u1ea1o m\u1ed9t b\u1ed9 s\u01b0u t\u1eadp m\u1edbi",
            "createNewPlaylist": "T\u1ea1o m\u1ed9t danh s\u00e1ch ch\u01a1i nh\u1ea1c m\u1edbi",
            "createNewVideoPlaylist": "T\u1ea1o m\u1ed9t danh s\u00e1ch video m\u1edbi",
            "returnToLibrary": "\u2190 T\u1edbi th\u01b0 vi\u1ec7n",
            "allMediaItems": "T\u1ea5t c\u1ea3",
            "allDates": "T\u1ea5t c\u1ea3 c\u00e1c ng\u00e0y",
            "noItemsFound": "Kh\u00f4ng c\u00f3 m\u1ee5c n\u00e0o \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y.",
            "insertIntoPost": "Ch\u00e8n v\u00e0o b\u00e0i vi\u1ebft",
            "unattached": "Ch\u01b0a \u0111\u01b0\u1ee3c \u0111\u00ednh k\u00e8m",
            "mine": "C\u1ee7a b\u1ea1n",
            "trash": "Th\u00f9ng r\u00e1c",
            "uploadedToThisPost": "\u0110\u00e3 t\u1ea3i l\u00ean v\u00e0o b\u00e0i n\u00e0y",
            "warnDelete": "B\u1ea1n s\u1ebd xo\u00e1 v\u0129nh vi\u1ec5n nh\u1eefng m\u1ee5c n\u00e0y kh\u1ecfi trang web c\u1ee7a b\u1ea1n.\nH\u00e0nh \u0111\u1ed9ng n\u00e0y kh\u00f4ng th\u1ec3 ho\u00e0n t\u00e1c.\nClick v\u00e0o 'H\u1ee7y b\u1ecf' \u0111\u1ec3 d\u1eebng l\u1ea1i, ho\u1eb7c 'OK' \u0111\u1ec3 xo\u00e1.",
            "warnBulkDelete": "B\u1ea1n s\u1eafp x\u00f3a v\u0129nh vi\u1ec5n nh\u1eefng m\u1ee5c n\u00e0y kh\u1ecfi trang web c\u1ee7a b\u1ea1n.\nH\u00e0nh \u0111\u1ed9ng n\u00e0y kh\u00f4ng th\u1ec3 ho\u00e0n t\u00e1c.\n 'H\u1ee7y' \u0111\u1ec3 d\u1eebng, 'OK' \u0111\u1ec3 x\u00f3a.",
            "warnBulkTrash": "B\u1ea1n chu\u1ea9n b\u1ecb x\u00f3a c\u00e1c m\u1ee5c n\u00e0y.\n'Cancel' \u0111\u1ec3 d\u1eebng l\u1ea1i, 'OK' \u0111\u1ec3 x\u00f3a.",
            "bulkSelect": "Ch\u1ecdn nhi\u1ec1u",
            "trashSelected": "B\u1ecf v\u00e0o th\u00f9ng r\u00e1c",
            "restoreSelected": "Kh\u00f4i ph\u1ee5c t\u1eeb Th\u00f9ng r\u00e1c",
            "deletePermanently": "X\u00f3a v\u0129nh vi\u1ec5n",
            "errorDeleting": "Error in deleting the attachment.",
            "apply": "\u00c1p d\u1ee5ng",
            "filterByDate": "L\u1ecdc theo ng\u00e0y",
            "filterByType": "L\u1ecdc theo lo\u1ea1i",
            "searchLabel": "T\u00ecm ki\u1ebfm",
            "searchMediaLabel": "T\u00ecm media",
            "searchMediaPlaceholder": "T\u00ecm c\u00e1c m\u1ee5c media...",
            "mediaFound": "S\u1ed1 m\u1ee5c media \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y: %d",
            "noMedia": "Kh\u00f4ng t\u00ecm th\u1ea5y file media n\u00e0o.",
            "noMediaTryNewSearch": "Kh\u00f4ng c\u00f3 media n\u00e0o \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y. H\u00e3y th\u1eed m\u1ed9t t\u00ecm ki\u1ebfm kh\u00e1c.",
            "attachmentDetails": "Chi ti\u1ebft \u0111\u00ednh k\u00e8m",
            "insertFromUrlTitle": "Ch\u00e8n t\u1eeb URL",
            "setFeaturedImageTitle": "\u1ea2nh \u0111\u1ea1i di\u1ec7n",
            "setFeaturedImage": "\u0110\u1eb7t \u1ea3nh \u0111\u1ea1i di\u1ec7n",
            "createGalleryTitle": "T\u1ea1o gallery",
            "editGalleryTitle": "S\u1eeda th\u01b0 vi\u1ec7n",
            "cancelGalleryTitle": "\u2190 Hu\u1ef7 gallery",
            "insertGallery": "Ch\u00e8n b\u1ed9 s\u01b0u t\u1eadp",
            "updateGallery": "C\u1eadp nh\u1eadt b\u1ed9 s\u01b0u t\u1eadp",
            "addToGallery": "Th\u00eam v\u00e0o b\u1ed9 s\u01b0u t\u1eadp",
            "addToGalleryTitle": "Th\u00eam v\u00e0o b\u1ed9 s\u01b0u t\u1eadp",
            "reverseOrder": "\u0110\u1ea3o ng\u01b0\u1ee3c th\u1ee9 t\u1ef1",
            "imageDetailsTitle": "Chi ti\u1ebft h\u00ecnh \u1ea3nh",
            "imageReplaceTitle": "Thay th\u1ebf \u1ea3nh",
            "imageDetailsCancel": "H\u1ee7y b\u1ecf s\u1eeda",
            "editImage": "S\u1eeda \u1ea3nh",
            "chooseImage": "Ch\u1ecdn \u1ea3nh",
            "selectAndCrop": "Ch\u1ecdn v\u00e0 c\u1eaft",
            "skipCropping": "B\u1ecf c\u1eaft",
            "cropImage": "C\u1eaft \u1ea3nh",
            "cropYourImage": "C\u1eaft \u1ea3nh c\u1ee7a b\u1ea1n",
            "cropping": "C\u1eaft&hellip",
            "suggestedDimensions": "K\u00edch th\u01b0\u1edbc \u1ea3nh \u0111\u1ec3 ngh\u1ecb: %1$s x %2$s pixels.",
            "cropError": "Hi\u1ec7n \u0111\u00e3 c\u00f3 m\u1ed9t l\u1ed7i c\u1eaft h\u00ecnh \u1ea3nh c\u1ee7a b\u1ea1n.",
            "audioDetailsTitle": "Chi ti\u1ebft Audio",
            "audioReplaceTitle": "Thay th\u1ebf Audio",
            "audioAddSourceTitle": "Th\u00eam ngu\u1ed3n audio",
            "audioDetailsCancel": "H\u1ee7y b\u1ecf s\u1eeda",
            "videoDetailsTitle": "Chi ti\u1ebft video",
            "videoReplaceTitle": "Thay th\u1ebf video",
            "videoAddSourceTitle": "Th\u00eam ngu\u1ed3n video",
            "videoDetailsCancel": "H\u1ee7y b\u1ecf s\u1eeda",
            "videoSelectPosterImageTitle": "Ch\u1ecdn h\u00ecnh \u1ea3nh \u00e1p ph\u00edch",
            "videoAddTrackTitle": "Th\u00eam ph\u1ee5 \u0111\u1ec1",
            "playlistDragInfo": "K\u00e9o v\u00e0 th\u1ea3 \u0111\u1ec3 s\u1eafp x\u1ebfp danh s\u00e1ch b\u00e0i h\u00e1t",
            "createPlaylistTitle": "T\u1ea1o Danh s\u00e1ch Audio",
            "editPlaylistTitle": "S\u1eeda Danh s\u00e1ch Audio",
            "cancelPlaylistTitle": "\u2190 H\u1ee7y Danh s\u00e1ch audio",
            "insertPlaylist": "Ch\u00e8n danh s\u00e1ch audio",
            "updatePlaylist": "C\u1eadp nh\u1eadt danh s\u00e1ch audio",
            "addToPlaylist": "Th\u00eam v\u00e0o danh s\u00e1ch audio",
            "addToPlaylistTitle": "Th\u00eam v\u00e0o Danh s\u00e1ch nh\u1ea1c",
            "videoPlaylistDragInfo": "K\u00e9o v\u00e0 th\u1ea3 \u0111\u1ec3 s\u1eafp x\u1ebfp l\u1ea1i danh s\u00e1ch video",
            "createVideoPlaylistTitle": "T\u1ea1o danh s\u00e1ch ph\u00e1t video",
            "editVideoPlaylistTitle": "S\u1eeda danh s\u00e1ch Video",
            "cancelVideoPlaylistTitle": "\u2190 Hu\u1ef7 danh s\u00e1ch video",
            "insertVideoPlaylist": "Ch\u00e8n danh s\u00e1ch ph\u00e1t video",
            "updateVideoPlaylist": "C\u1eadp nh\u1eadt sanh s\u00e1ch ch\u01a1i video",
            "addToVideoPlaylist": "Th\u00eam v\u00e0o danh s\u00e1ch ch\u01a1i video",
            "addToVideoPlaylistTitle": "Th\u00eam v\u00e0o danh s\u00e1ch video",
            "filterAttachments": "L\u1ecdc media",
            "attachmentsList": "Danh s\u00e1ch media",
            "settings": {
                "tabs": [],
                "tabUrl": "http:\/\/localhost\/wordpress\/wp-admin\/media-upload.php?chromeless=1",
                "mimeTypes": {
                    "image": "H\u00ecnh \u1ea3nh",
                    "audio": "Audio",
                    "video": "Video",
                    "application\/msword,application\/vnd.openxmlformats-officedocument.wordprocessingml.document,application\/vnd.ms-word.document.macroEnabled.12,application\/vnd.ms-word.template.macroEnabled.12,application\/vnd.oasis.opendocument.text,application\/vnd.apple.pages,application\/pdf,application\/vnd.ms-xpsdocument,application\/oxps,application\/rtf,application\/wordperfect,application\/octet-stream": "T\u00e0i li\u1ec7u",
                    "application\/vnd.apple.numbers,application\/vnd.oasis.opendocument.spreadsheet,application\/vnd.ms-excel,application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application\/vnd.ms-excel.sheet.macroEnabled.12,application\/vnd.ms-excel.sheet.binary.macroEnabled.12": "B\u1ea3ng t\u00ednh",
                    "application\/x-gzip,application\/rar,application\/x-tar,application\/zip,application\/x-7z-compressed": "L\u01b0u tr\u1eef"
                },
                "captions": true,
                "nonce": {"sendToEditor": "566709e887", "setAttachmentThumbnail": "082581b9f9"},
                "post": {"id": 0},
                "defaultProps": {"link": "none", "align": "", "size": ""},
                "attachmentCounts": {"audio": 1, "video": 1},
                "oEmbedProxyUrl": "http:\/\/localhost\/wordpress\/wp-json\/oembed\/1.0\/proxy",
                "embedExts": ["mp3", "ogg", "flac", "m4a", "wav", "mp4", "m4v", "webm", "ogv", "flv"],
                "embedMimes": {
                    "mp3": "audio\/mpeg",
                    "ogg": "audio\/ogg",
                    "flac": "audio\/flac",
                    "m4a": "audio\/mpeg",
                    "wav": "audio\/wav",
                    "mp4": "video\/mp4",
                    "m4v": "video\/mp4",
                    "webm": "video\/webm",
                    "ogv": "video\/ogg",
                    "flv": "video\/x-flv"
                },
                "contentWidth": 750,
                "months": [{"year": "2023", "month": "7", "text": "Th\u00e1ng B\u1ea3y 2023"}],
                "mediaTrash": 0,
                "infiniteScrolling": 0
            }
        };
    </script>
    <script id='media-views-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {"domain": "messages", "plural-forms": "nplurals=1; plural=0;", "lang": "vi_VN"},
                    "Jump to first loaded item": ["Chuy\u1ec3n \u0111\u1ebfn m\u1ee5c \u0111\u01b0\u1ee3c t\u1ea3i \u0111\u1ea7u ti\u00ean"],
                    "Load more": ["T\u1ea3i th\u00eam"],
                    "Showing %1$s of %2$s media items": ["\u0110ang hi\u1ec3n th\u1ecb %1$s c\u1ee7a %2$s file media"],
                    "Number of media items displayed: %d. Click load more for more results.": ["S\u1ed1 m\u1ee5c media \u0111\u01b0\u1ee3c hi\u1ec3n th\u1ecb: %d. Nh\u1ea5p v\u00e0o t\u1ea3i th\u00eam \u0111\u1ec3 xem nhi\u1ec1u h\u01a1n."],
                    "The file URL has been copied to your clipboard": ["URL c\u1ee7a file \u0111\u00e3 \u0111\u01b0\u1ee3c sao ch\u00e9p v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m"],
                    "%s item selected": ["\u0111\u00e3 ch\u1ecdn %s item"],
                    "Number of media items displayed: %d. Scroll the page for more results.": ["S\u1ed1 m\u1ee5c media  \u0111\u01b0\u1ee3c hi\u1ec3n th\u1ecb: %d. K\u00e9o xu\u1ed1ng \u0111\u1ec3 c\u00f3 nhi\u1ec1u k\u1ebft qu\u1ea3 h\u01a1n. Th\u1eed m\u1ed9t t\u00ecm ki\u1ebfm kh\u00e1c."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/media-views.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/media-views.min.js?ver=6.2.2' id='media-views-js'></script>
    <script id='media-editor-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Could not set that as the thumbnail image. Try a different attachment.": ["Kh\u00f4ng th\u1ec3 s\u1eed d\u1ee5ng t\u1eadp tin b\u1ea1n ch\u1ecdn l\u00e0m \u1ea3nh thu nh\u1ecf, h\u00e3y th\u1eed t\u1eadp tin kh\u00e1c."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/media-editor.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/media-editor.min.js?ver=6.2.2' id='media-editor-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/media-audiovideo.min.js?ver=6.2.2'
            id='media-audiovideo-js'></script>
    <script id='mce-view-js-extra'>
        var mceViewL10n = {"shortcodes": ["wp_caption", "caption", "gallery", "playlist", "audio", "video", "embed", "acf", "product", "product_page", "product_category", "product_categories", "add_to_cart", "add_to_cart_url", "products", "recent_products", "sale_products", "best_selling_products", "top_rated_products", "featured_products", "product_attribute", "related_products", "shop_messages", "woocommerce_order_tracking", "woocommerce_cart", "woocommerce_checkout", "woocommerce_my_account", "woocommerce_messages"]};
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/mce-view.min.js?ver=6.2.2' id='mce-view-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/imgareaselect/jquery.imgareaselect.min.js?ver=6.2.2'
            id='imgareaselect-js'></script>
    <script id='image-edit-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-08-03 11:30:24+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Could not load the preview image.": ["Kh\u00f4ng th\u1ec3 t\u1ea3i \u1ea3nh xem th\u1eed."],
                    "Could not load the preview image. Please reload the page and try again.": ["Kh\u00f4ng th\u1ec3 t\u1ea3i \u1ea3nh xem th\u1eed. Vui l\u00f2n t\u1ea3i l\u1ea1i trang v\u00e0 th\u1eed l\u1ea1i."]
                }
            },
            "comment": {"reference": "wp-admin\/js\/image-edit.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-admin/js/image-edit.min.js?ver=6.2.2' id='image-edit-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/vendor/lodash.min.js?ver=4.17.19'
            id='lodash-js'></script>
    <script id='lodash-js-after'>
        window.lodash = _.noConflict();
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/vendor/moment.min.js?ver=2.29.4'
            id='moment-js'></script>
    <script id='moment-js-after'>
        moment.updateLocale('vi', {
            "months": ["Th\u00e1ng M\u1ed9t", "Th\u00e1ng Hai", "Th\u00e1ng Ba", "Th\u00e1ng T\u01b0", "Th\u00e1ng N\u0103m", "Th\u00e1ng S\u00e1u", "Th\u00e1ng B\u1ea3y", "Th\u00e1ng T\u00e1m", "Th\u00e1ng Ch\u00edn", "Th\u00e1ng M\u01b0\u1eddi", "Th\u00e1ng M\u01b0\u1eddi M\u1ed9t", "Th\u00e1ng M\u01b0\u1eddi Hai"],
            "monthsShort": ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
            "weekdays": ["Ch\u1ee7 Nh\u1eadt", "Th\u1ee9 Hai", "Th\u1ee9 Ba", "Th\u1ee9 T\u01b0", "Th\u1ee9 N\u0103m", "Th\u1ee9 S\u00e1u", "Th\u1ee9 B\u1ea3y"],
            "weekdaysShort": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            "week": {"dow": 1},
            "longDateFormat": {
                "LT": "g:i a",
                "LTS": null,
                "L": null,
                "LL": "F j, Y",
                "LLL": "j F, Y g:i a",
                "LLLL": null
            }
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/vendor/react.min.js?ver=18.2.0' id='react-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/vendor/react-dom.min.js?ver=18.2.0'
            id='react-dom-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/url.min.js?ver=16185fce2fb043a0cfed'
            id='wp-url-js'></script>
    <script id='wp-api-fetch-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "You are probably offline.": ["C\u00f3 th\u1ec3 b\u1ea1n \u0111ang ngo\u1ea1i tuy\u1ebfn."],
                    "Media upload failed. If this is a photo or a large image, please scale it down and try again.": ["T\u1ea3i l\u00ean media kh\u00f4ng th\u00e0nh c\u00f4ng. N\u1ebfu \u0111\u00e2y l\u00e0 h\u00ecnh \u1ea3nh c\u00f3 k\u00edch th\u01b0\u1edbc l\u1edbn, vui l\u00f2ng thu nh\u1ecf n\u00f3 xu\u1ed1ng v\u00e0 th\u1eed l\u1ea1i."],
                    "The response is not a valid JSON response.": ["Ph\u1ea3n h\u1ed3i kh\u00f4ng ph\u1ea3i l\u00e0 m\u1ed9t JSON h\u1ee3p l\u1ec7."],
                    "An unknown error occurred.": ["C\u00f3 l\u1ed7i n\u00e0o \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/api-fetch.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/api-fetch.min.js?ver=bc0029ca2c943aec5311'
            id='wp-api-fetch-js'></script>
    <script id='wp-api-fetch-js-after'>
        wp.apiFetch.use(wp.apiFetch.createRootURLMiddleware("http://localhost/wordpress/wp-json/"));
        wp.apiFetch.nonceMiddleware = wp.apiFetch.createNonceMiddleware("2f275b4af8");
        wp.apiFetch.use(wp.apiFetch.nonceMiddleware);
        wp.apiFetch.use(wp.apiFetch.mediaUploadMiddleware);
        wp.apiFetch.nonceEndpoint = "http://localhost/wordpress/wp-admin/admin-ajax.php?action=rest-nonce";
    </script>
    <script id='wc-settings-js-before'>
        var wcSettings = wcSettings || JSON.parse(decodeURIComponent('%7B%22shippingCostRequiresAddress%22%3Afalse%2C%22adminUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-admin%5C%2F%22%2C%22countries%22%3A%7B%22AF%22%3A%22Afghanistan%22%2C%22AX%22%3A%22%5Cu00c5land%20Islands%22%2C%22AL%22%3A%22Albania%22%2C%22DZ%22%3A%22Algeria%22%2C%22AS%22%3A%22American%20Samoa%22%2C%22AD%22%3A%22Andorra%22%2C%22AO%22%3A%22Angola%22%2C%22AI%22%3A%22Anguilla%22%2C%22AQ%22%3A%22Antarctica%22%2C%22AG%22%3A%22Antigua%20and%20Barbuda%22%2C%22AR%22%3A%22Argentina%22%2C%22AM%22%3A%22Armenia%22%2C%22AW%22%3A%22Aruba%22%2C%22AU%22%3A%22Australia%22%2C%22AT%22%3A%22Austria%22%2C%22AZ%22%3A%22Azerbaijan%22%2C%22BS%22%3A%22Bahamas%22%2C%22BH%22%3A%22Bahrain%22%2C%22BD%22%3A%22Bangladesh%22%2C%22BB%22%3A%22Barbados%22%2C%22BY%22%3A%22Belarus%22%2C%22PW%22%3A%22Belau%22%2C%22BE%22%3A%22Belgium%22%2C%22BZ%22%3A%22Belize%22%2C%22BJ%22%3A%22Benin%22%2C%22BM%22%3A%22Bermuda%22%2C%22BT%22%3A%22Bhutan%22%2C%22BO%22%3A%22Bolivia%22%2C%22BQ%22%3A%22Bonaire%2C%20Saint%20Eustatius%20and%20Saba%22%2C%22BA%22%3A%22Bosnia%20and%20Herzegovina%22%2C%22BW%22%3A%22Botswana%22%2C%22BV%22%3A%22Bouvet%20Island%22%2C%22BR%22%3A%22Brazil%22%2C%22IO%22%3A%22British%20Indian%20Ocean%20Territory%22%2C%22BN%22%3A%22Brunei%22%2C%22BG%22%3A%22Bulgaria%22%2C%22BF%22%3A%22Burkina%20Faso%22%2C%22BI%22%3A%22Burundi%22%2C%22KH%22%3A%22Cambodia%22%2C%22CM%22%3A%22Cameroon%22%2C%22CA%22%3A%22Canada%22%2C%22CV%22%3A%22Cape%20Verde%22%2C%22KY%22%3A%22Cayman%20Islands%22%2C%22CF%22%3A%22Central%20African%20Republic%22%2C%22TD%22%3A%22Chad%22%2C%22CL%22%3A%22Chile%22%2C%22CN%22%3A%22China%22%2C%22CX%22%3A%22Christmas%20Island%22%2C%22CC%22%3A%22Cocos%20%28Keeling%29%20Islands%22%2C%22CO%22%3A%22Colombia%22%2C%22KM%22%3A%22Comoros%22%2C%22CG%22%3A%22Congo%20%28Brazzaville%29%22%2C%22CD%22%3A%22Congo%20%28Kinshasa%29%22%2C%22CK%22%3A%22Cook%20Islands%22%2C%22CR%22%3A%22Costa%20Rica%22%2C%22HR%22%3A%22Croatia%22%2C%22CU%22%3A%22Cuba%22%2C%22CW%22%3A%22Cura%26ccedil%3Bao%22%2C%22CY%22%3A%22Cyprus%22%2C%22CZ%22%3A%22Czech%20Republic%22%2C%22DK%22%3A%22Denmark%22%2C%22DJ%22%3A%22Djibouti%22%2C%22DM%22%3A%22Dominica%22%2C%22DO%22%3A%22Dominican%20Republic%22%2C%22EC%22%3A%22Ecuador%22%2C%22EG%22%3A%22Egypt%22%2C%22SV%22%3A%22El%20Salvador%22%2C%22GQ%22%3A%22Equatorial%20Guinea%22%2C%22ER%22%3A%22Eritrea%22%2C%22EE%22%3A%22Estonia%22%2C%22SZ%22%3A%22Eswatini%22%2C%22ET%22%3A%22Ethiopia%22%2C%22FK%22%3A%22Falkland%20Islands%22%2C%22FO%22%3A%22Faroe%20Islands%22%2C%22FJ%22%3A%22Fiji%22%2C%22FI%22%3A%22Finland%22%2C%22FR%22%3A%22France%22%2C%22GF%22%3A%22French%20Guiana%22%2C%22PF%22%3A%22French%20Polynesia%22%2C%22TF%22%3A%22French%20Southern%20Territories%22%2C%22GA%22%3A%22Gabon%22%2C%22GM%22%3A%22Gambia%22%2C%22GE%22%3A%22Georgia%22%2C%22DE%22%3A%22Germany%22%2C%22GH%22%3A%22Ghana%22%2C%22GI%22%3A%22Gibraltar%22%2C%22GR%22%3A%22Greece%22%2C%22GL%22%3A%22Greenland%22%2C%22GD%22%3A%22Grenada%22%2C%22GP%22%3A%22Guadeloupe%22%2C%22GU%22%3A%22Guam%22%2C%22GT%22%3A%22Guatemala%22%2C%22GG%22%3A%22Guernsey%22%2C%22GN%22%3A%22Guinea%22%2C%22GW%22%3A%22Guinea-Bissau%22%2C%22GY%22%3A%22Guyana%22%2C%22HT%22%3A%22Haiti%22%2C%22HM%22%3A%22Heard%20Island%20and%20McDonald%20Islands%22%2C%22HN%22%3A%22Honduras%22%2C%22HK%22%3A%22Hong%20Kong%22%2C%22HU%22%3A%22Hungary%22%2C%22IS%22%3A%22Iceland%22%2C%22IN%22%3A%22India%22%2C%22ID%22%3A%22Indonesia%22%2C%22IR%22%3A%22Iran%22%2C%22IQ%22%3A%22Iraq%22%2C%22IE%22%3A%22Ireland%22%2C%22IM%22%3A%22Isle%20of%20Man%22%2C%22IL%22%3A%22Israel%22%2C%22IT%22%3A%22Italy%22%2C%22CI%22%3A%22Ivory%20Coast%22%2C%22JM%22%3A%22Jamaica%22%2C%22JP%22%3A%22Japan%22%2C%22JE%22%3A%22Jersey%22%2C%22JO%22%3A%22Jordan%22%2C%22KZ%22%3A%22Kazakhstan%22%2C%22KE%22%3A%22Kenya%22%2C%22KI%22%3A%22Kiribati%22%2C%22KW%22%3A%22Kuwait%22%2C%22KG%22%3A%22Kyrgyzstan%22%2C%22LA%22%3A%22Laos%22%2C%22LV%22%3A%22Latvia%22%2C%22LB%22%3A%22Lebanon%22%2C%22LS%22%3A%22Lesotho%22%2C%22LR%22%3A%22Liberia%22%2C%22LY%22%3A%22Libya%22%2C%22LI%22%3A%22Liechtenstein%22%2C%22LT%22%3A%22Lithuania%22%2C%22LU%22%3A%22Luxembourg%22%2C%22MO%22%3A%22Macao%22%2C%22MG%22%3A%22Madagascar%22%2C%22MW%22%3A%22Malawi%22%2C%22MY%22%3A%22Malaysia%22%2C%22MV%22%3A%22Maldives%22%2C%22ML%22%3A%22Mali%22%2C%22MT%22%3A%22Malta%22%2C%22MH%22%3A%22Marshall%20Islands%22%2C%22MQ%22%3A%22Martinique%22%2C%22MR%22%3A%22Mauritania%22%2C%22MU%22%3A%22Mauritius%22%2C%22YT%22%3A%22Mayotte%22%2C%22MX%22%3A%22Mexico%22%2C%22FM%22%3A%22Micronesia%22%2C%22MD%22%3A%22Moldova%22%2C%22MC%22%3A%22Monaco%22%2C%22MN%22%3A%22Mongolia%22%2C%22ME%22%3A%22Montenegro%22%2C%22MS%22%3A%22Montserrat%22%2C%22MA%22%3A%22Morocco%22%2C%22MZ%22%3A%22Mozambique%22%2C%22MM%22%3A%22Myanmar%22%2C%22NA%22%3A%22Namibia%22%2C%22NR%22%3A%22Nauru%22%2C%22NP%22%3A%22Nepal%22%2C%22NL%22%3A%22Netherlands%22%2C%22NC%22%3A%22New%20Caledonia%22%2C%22NZ%22%3A%22New%20Zealand%22%2C%22NI%22%3A%22Nicaragua%22%2C%22NE%22%3A%22Niger%22%2C%22NG%22%3A%22Nigeria%22%2C%22NU%22%3A%22Niue%22%2C%22NF%22%3A%22Norfolk%20Island%22%2C%22KP%22%3A%22North%20Korea%22%2C%22MK%22%3A%22North%20Macedonia%22%2C%22MP%22%3A%22Northern%20Mariana%20Islands%22%2C%22NO%22%3A%22Norway%22%2C%22OM%22%3A%22Oman%22%2C%22PK%22%3A%22Pakistan%22%2C%22PS%22%3A%22Palestinian%20Territory%22%2C%22PA%22%3A%22Panama%22%2C%22PG%22%3A%22Papua%20New%20Guinea%22%2C%22PY%22%3A%22Paraguay%22%2C%22PE%22%3A%22Peru%22%2C%22PH%22%3A%22Philippines%22%2C%22PN%22%3A%22Pitcairn%22%2C%22PL%22%3A%22Poland%22%2C%22PT%22%3A%22Portugal%22%2C%22PR%22%3A%22Puerto%20Rico%22%2C%22QA%22%3A%22Qatar%22%2C%22RE%22%3A%22Reunion%22%2C%22RO%22%3A%22Romania%22%2C%22RU%22%3A%22Russia%22%2C%22RW%22%3A%22Rwanda%22%2C%22BL%22%3A%22Saint%20Barth%26eacute%3Blemy%22%2C%22SH%22%3A%22Saint%20Helena%22%2C%22KN%22%3A%22Saint%20Kitts%20and%20Nevis%22%2C%22LC%22%3A%22Saint%20Lucia%22%2C%22SX%22%3A%22Saint%20Martin%20%28Dutch%20part%29%22%2C%22MF%22%3A%22Saint%20Martin%20%28French%20part%29%22%2C%22PM%22%3A%22Saint%20Pierre%20and%20Miquelon%22%2C%22VC%22%3A%22Saint%20Vincent%20and%20the%20Grenadines%22%2C%22WS%22%3A%22Samoa%22%2C%22SM%22%3A%22San%20Marino%22%2C%22ST%22%3A%22S%26atilde%3Bo%20Tom%26eacute%3B%20and%20Pr%26iacute%3Bncipe%22%2C%22SA%22%3A%22Saudi%20Arabia%22%2C%22SN%22%3A%22Senegal%22%2C%22RS%22%3A%22Serbia%22%2C%22SC%22%3A%22Seychelles%22%2C%22SL%22%3A%22Sierra%20Leone%22%2C%22SG%22%3A%22Singapore%22%2C%22SK%22%3A%22Slovakia%22%2C%22SI%22%3A%22Slovenia%22%2C%22SB%22%3A%22Solomon%20Islands%22%2C%22SO%22%3A%22Somalia%22%2C%22ZA%22%3A%22South%20Africa%22%2C%22GS%22%3A%22South%20Georgia%5C%2FSandwich%20Islands%22%2C%22KR%22%3A%22South%20Korea%22%2C%22SS%22%3A%22South%20Sudan%22%2C%22ES%22%3A%22Spain%22%2C%22LK%22%3A%22Sri%20Lanka%22%2C%22SD%22%3A%22Sudan%22%2C%22SR%22%3A%22Suriname%22%2C%22SJ%22%3A%22Svalbard%20and%20Jan%20Mayen%22%2C%22SE%22%3A%22Sweden%22%2C%22CH%22%3A%22Switzerland%22%2C%22SY%22%3A%22Syria%22%2C%22TW%22%3A%22Taiwan%22%2C%22TJ%22%3A%22Tajikistan%22%2C%22TZ%22%3A%22Tanzania%22%2C%22TH%22%3A%22Thailand%22%2C%22TL%22%3A%22Timor-Leste%22%2C%22TG%22%3A%22Togo%22%2C%22TK%22%3A%22Tokelau%22%2C%22TO%22%3A%22Tonga%22%2C%22TT%22%3A%22Trinidad%20and%20Tobago%22%2C%22TN%22%3A%22Tunisia%22%2C%22TR%22%3A%22Turkey%22%2C%22TM%22%3A%22Turkmenistan%22%2C%22TC%22%3A%22Turks%20and%20Caicos%20Islands%22%2C%22TV%22%3A%22Tuvalu%22%2C%22UG%22%3A%22Uganda%22%2C%22UA%22%3A%22Ukraine%22%2C%22AE%22%3A%22United%20Arab%20Emirates%22%2C%22GB%22%3A%22United%20Kingdom%20%28UK%29%22%2C%22US%22%3A%22United%20States%20%28US%29%22%2C%22UM%22%3A%22United%20States%20%28US%29%20Minor%20Outlying%20Islands%22%2C%22UY%22%3A%22Uruguay%22%2C%22UZ%22%3A%22Uzbekistan%22%2C%22VU%22%3A%22Vanuatu%22%2C%22VA%22%3A%22Vatican%22%2C%22VE%22%3A%22Venezuela%22%2C%22VN%22%3A%22Vietnam%22%2C%22VG%22%3A%22Virgin%20Islands%20%28British%29%22%2C%22VI%22%3A%22Virgin%20Islands%20%28US%29%22%2C%22WF%22%3A%22Wallis%20and%20Futuna%22%2C%22EH%22%3A%22Western%20Sahara%22%2C%22YE%22%3A%22Yemen%22%2C%22ZM%22%3A%22Zambia%22%2C%22ZW%22%3A%22Zimbabwe%22%7D%2C%22currency%22%3A%7B%22code%22%3A%22USD%22%2C%22precision%22%3A2%2C%22symbol%22%3A%22%24%22%2C%22symbolPosition%22%3A%22left%22%2C%22decimalSeparator%22%3A%22.%22%2C%22thousandSeparator%22%3A%22%2C%22%2C%22priceFormat%22%3A%22%251%24s%252%24s%22%7D%2C%22currentUserId%22%3A1%2C%22currentUserIsAdmin%22%3Atrue%2C%22homeUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2F%22%2C%22locale%22%3A%7B%22siteLocale%22%3A%22vi%22%2C%22userLocale%22%3A%22vi%22%2C%22weekdaysShort%22%3A%5B%22CN%22%2C%22T2%22%2C%22T3%22%2C%22T4%22%2C%22T5%22%2C%22T6%22%2C%22T7%22%5D%7D%2C%22dashboardUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fmy-account%5C%2F%22%2C%22orderStatuses%22%3A%7B%22pending%22%3A%22Pending%20payment%22%2C%22processing%22%3A%22Processing%22%2C%22on-hold%22%3A%22On%20hold%22%2C%22completed%22%3A%22Completed%22%2C%22cancelled%22%3A%22Cancelled%22%2C%22refunded%22%3A%22Refunded%22%2C%22failed%22%3A%22Failed%22%2C%22checkout-draft%22%3A%22Draft%22%7D%2C%22placeholderImgSrc%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-content%5C%2Fuploads%5C%2Fwoocommerce-placeholder.png%22%2C%22productsSettings%22%3A%7B%22cartRedirectAfterAdd%22%3Afalse%7D%2C%22siteTitle%22%3A%22Wordpress%22%2C%22storePages%22%3A%7B%22myaccount%22%3A%7B%22id%22%3A40%2C%22title%22%3A%22My%20account%22%2C%22permalink%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fmy-account%5C%2F%22%7D%2C%22shop%22%3A%7B%22id%22%3A37%2C%22title%22%3A%22Shop%22%2C%22permalink%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fshop%5C%2F%22%7D%2C%22cart%22%3A%7B%22id%22%3A38%2C%22title%22%3A%22Cart%22%2C%22permalink%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fcart%5C%2F%22%7D%2C%22checkout%22%3A%7B%22id%22%3A39%2C%22title%22%3A%22Checkout%22%2C%22permalink%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fcheckout%5C%2F%22%7D%2C%22privacy%22%3A%7B%22id%22%3A0%2C%22title%22%3A%22%22%2C%22permalink%22%3Afalse%7D%2C%22terms%22%3A%7B%22id%22%3A0%2C%22title%22%3A%22%22%2C%22permalink%22%3Afalse%7D%7D%2C%22wcAssetUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-content%5C%2Fplugins%5C%2Fwoocommerce%5C%2Fassets%5C%2F%22%2C%22wcVersion%22%3A%227.9.0%22%2C%22wpLoginUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-login.php%22%2C%22wpVersion%22%3A%226.2.2%22%2C%22countryStates%22%3A%7B%22AF%22%3A%5B%5D%2C%22AL%22%3A%7B%22AL-01%22%3A%22Berat%22%2C%22AL-09%22%3A%22Dib%5Cu00ebr%22%2C%22AL-02%22%3A%22Durr%5Cu00ebs%22%2C%22AL-03%22%3A%22Elbasan%22%2C%22AL-04%22%3A%22Fier%22%2C%22AL-05%22%3A%22Gjirokast%5Cu00ebr%22%2C%22AL-06%22%3A%22Kor%5Cu00e7%5Cu00eb%22%2C%22AL-07%22%3A%22Kuk%5Cu00ebs%22%2C%22AL-08%22%3A%22Lezh%5Cu00eb%22%2C%22AL-10%22%3A%22Shkod%5Cu00ebr%22%2C%22AL-11%22%3A%22Tirana%22%2C%22AL-12%22%3A%22Vlor%5Cu00eb%22%7D%2C%22AO%22%3A%7B%22BGO%22%3A%22Bengo%22%2C%22BLU%22%3A%22Benguela%22%2C%22BIE%22%3A%22Bi%5Cu00e9%22%2C%22CAB%22%3A%22Cabinda%22%2C%22CNN%22%3A%22Cunene%22%2C%22HUA%22%3A%22Huambo%22%2C%22HUI%22%3A%22Hu%5Cu00edla%22%2C%22CCU%22%3A%22Kuando%20Kubango%22%2C%22CNO%22%3A%22Kwanza-Norte%22%2C%22CUS%22%3A%22Kwanza-Sul%22%2C%22LUA%22%3A%22Luanda%22%2C%22LNO%22%3A%22Lunda-Norte%22%2C%22LSU%22%3A%22Lunda-Sul%22%2C%22MAL%22%3A%22Malanje%22%2C%22MOX%22%3A%22Moxico%22%2C%22NAM%22%3A%22Namibe%22%2C%22UIG%22%3A%22U%5Cu00edge%22%2C%22ZAI%22%3A%22Zaire%22%7D%2C%22AR%22%3A%7B%22C%22%3A%22Ciudad%20Aut%5Cu00f3noma%20de%20Buenos%20Aires%22%2C%22B%22%3A%22Buenos%20Aires%22%2C%22K%22%3A%22Catamarca%22%2C%22H%22%3A%22Chaco%22%2C%22U%22%3A%22Chubut%22%2C%22X%22%3A%22C%5Cu00f3rdoba%22%2C%22W%22%3A%22Corrientes%22%2C%22E%22%3A%22Entre%20R%5Cu00edos%22%2C%22P%22%3A%22Formosa%22%2C%22Y%22%3A%22Jujuy%22%2C%22L%22%3A%22La%20Pampa%22%2C%22F%22%3A%22La%20Rioja%22%2C%22M%22%3A%22Mendoza%22%2C%22N%22%3A%22Misiones%22%2C%22Q%22%3A%22Neuqu%5Cu00e9n%22%2C%22R%22%3A%22R%5Cu00edo%20Negro%22%2C%22A%22%3A%22Salta%22%2C%22J%22%3A%22San%20Juan%22%2C%22D%22%3A%22San%20Luis%22%2C%22Z%22%3A%22Santa%20Cruz%22%2C%22S%22%3A%22Santa%20Fe%22%2C%22G%22%3A%22Santiago%20del%20Estero%22%2C%22V%22%3A%22Tierra%20del%20Fuego%22%2C%22T%22%3A%22Tucum%5Cu00e1n%22%7D%2C%22AT%22%3A%5B%5D%2C%22AU%22%3A%7B%22ACT%22%3A%22Australian%20Capital%20Territory%22%2C%22NSW%22%3A%22New%20South%20Wales%22%2C%22NT%22%3A%22Northern%20Territory%22%2C%22QLD%22%3A%22Queensland%22%2C%22SA%22%3A%22South%20Australia%22%2C%22TAS%22%3A%22Tasmania%22%2C%22VIC%22%3A%22Victoria%22%2C%22WA%22%3A%22Western%20Australia%22%7D%2C%22AX%22%3A%5B%5D%2C%22BD%22%3A%7B%22BD-05%22%3A%22Bagerhat%22%2C%22BD-01%22%3A%22Bandarban%22%2C%22BD-02%22%3A%22Barguna%22%2C%22BD-06%22%3A%22Barishal%22%2C%22BD-07%22%3A%22Bhola%22%2C%22BD-03%22%3A%22Bogura%22%2C%22BD-04%22%3A%22Brahmanbaria%22%2C%22BD-09%22%3A%22Chandpur%22%2C%22BD-10%22%3A%22Chattogram%22%2C%22BD-12%22%3A%22Chuadanga%22%2C%22BD-11%22%3A%22Cox%27s%20Bazar%22%2C%22BD-08%22%3A%22Cumilla%22%2C%22BD-13%22%3A%22Dhaka%22%2C%22BD-14%22%3A%22Dinajpur%22%2C%22BD-15%22%3A%22Faridpur%20%22%2C%22BD-16%22%3A%22Feni%22%2C%22BD-19%22%3A%22Gaibandha%22%2C%22BD-18%22%3A%22Gazipur%22%2C%22BD-17%22%3A%22Gopalganj%22%2C%22BD-20%22%3A%22Habiganj%22%2C%22BD-21%22%3A%22Jamalpur%22%2C%22BD-22%22%3A%22Jashore%22%2C%22BD-25%22%3A%22Jhalokati%22%2C%22BD-23%22%3A%22Jhenaidah%22%2C%22BD-24%22%3A%22Joypurhat%22%2C%22BD-29%22%3A%22Khagrachhari%22%2C%22BD-27%22%3A%22Khulna%22%2C%22BD-26%22%3A%22Kishoreganj%22%2C%22BD-28%22%3A%22Kurigram%22%2C%22BD-30%22%3A%22Kushtia%22%2C%22BD-31%22%3A%22Lakshmipur%22%2C%22BD-32%22%3A%22Lalmonirhat%22%2C%22BD-36%22%3A%22Madaripur%22%2C%22BD-37%22%3A%22Magura%22%2C%22BD-33%22%3A%22Manikganj%20%22%2C%22BD-39%22%3A%22Meherpur%22%2C%22BD-38%22%3A%22Moulvibazar%22%2C%22BD-35%22%3A%22Munshiganj%22%2C%22BD-34%22%3A%22Mymensingh%22%2C%22BD-48%22%3A%22Naogaon%22%2C%22BD-43%22%3A%22Narail%22%2C%22BD-40%22%3A%22Narayanganj%22%2C%22BD-42%22%3A%22Narsingdi%22%2C%22BD-44%22%3A%22Natore%22%2C%22BD-45%22%3A%22Nawabganj%22%2C%22BD-41%22%3A%22Netrakona%22%2C%22BD-46%22%3A%22Nilphamari%22%2C%22BD-47%22%3A%22Noakhali%22%2C%22BD-49%22%3A%22Pabna%22%2C%22BD-52%22%3A%22Panchagarh%22%2C%22BD-51%22%3A%22Patuakhali%22%2C%22BD-50%22%3A%22Pirojpur%22%2C%22BD-53%22%3A%22Rajbari%22%2C%22BD-54%22%3A%22Rajshahi%22%2C%22BD-56%22%3A%22Rangamati%22%2C%22BD-55%22%3A%22Rangpur%22%2C%22BD-58%22%3A%22Satkhira%22%2C%22BD-62%22%3A%22Shariatpur%22%2C%22BD-57%22%3A%22Sherpur%22%2C%22BD-59%22%3A%22Sirajganj%22%2C%22BD-61%22%3A%22Sunamganj%22%2C%22BD-60%22%3A%22Sylhet%22%2C%22BD-63%22%3A%22Tangail%22%2C%22BD-64%22%3A%22Thakurgaon%22%7D%2C%22BE%22%3A%5B%5D%2C%22BG%22%3A%7B%22BG-01%22%3A%22Blagoevgrad%22%2C%22BG-02%22%3A%22Burgas%22%2C%22BG-08%22%3A%22Dobrich%22%2C%22BG-07%22%3A%22Gabrovo%22%2C%22BG-26%22%3A%22Haskovo%22%2C%22BG-09%22%3A%22Kardzhali%22%2C%22BG-10%22%3A%22Kyustendil%22%2C%22BG-11%22%3A%22Lovech%22%2C%22BG-12%22%3A%22Montana%22%2C%22BG-13%22%3A%22Pazardzhik%22%2C%22BG-14%22%3A%22Pernik%22%2C%22BG-15%22%3A%22Pleven%22%2C%22BG-16%22%3A%22Plovdiv%22%2C%22BG-17%22%3A%22Razgrad%22%2C%22BG-18%22%3A%22Ruse%22%2C%22BG-27%22%3A%22Shumen%22%2C%22BG-19%22%3A%22Silistra%22%2C%22BG-20%22%3A%22Sliven%22%2C%22BG-21%22%3A%22Smolyan%22%2C%22BG-23%22%3A%22Sofia%20District%22%2C%22BG-22%22%3A%22Sofia%22%2C%22BG-24%22%3A%22Stara%20Zagora%22%2C%22BG-25%22%3A%22Targovishte%22%2C%22BG-03%22%3A%22Varna%22%2C%22BG-04%22%3A%22Veliko%20Tarnovo%22%2C%22BG-05%22%3A%22Vidin%22%2C%22BG-06%22%3A%22Vratsa%22%2C%22BG-28%22%3A%22Yambol%22%7D%2C%22BH%22%3A%5B%5D%2C%22BI%22%3A%5B%5D%2C%22BJ%22%3A%7B%22AL%22%3A%22Alibori%22%2C%22AK%22%3A%22Atakora%22%2C%22AQ%22%3A%22Atlantique%22%2C%22BO%22%3A%22Borgou%22%2C%22CO%22%3A%22Collines%22%2C%22KO%22%3A%22Kouffo%22%2C%22DO%22%3A%22Donga%22%2C%22LI%22%3A%22Littoral%22%2C%22MO%22%3A%22Mono%22%2C%22OU%22%3A%22Ou%5Cu00e9m%5Cu00e9%22%2C%22PL%22%3A%22Plateau%22%2C%22ZO%22%3A%22Zou%22%7D%2C%22BO%22%3A%7B%22BO-B%22%3A%22Beni%22%2C%22BO-H%22%3A%22Chuquisaca%22%2C%22BO-C%22%3A%22Cochabamba%22%2C%22BO-L%22%3A%22La%20Paz%22%2C%22BO-O%22%3A%22Oruro%22%2C%22BO-N%22%3A%22Pando%22%2C%22BO-P%22%3A%22Potos%5Cu00ed%22%2C%22BO-S%22%3A%22Santa%20Cruz%22%2C%22BO-T%22%3A%22Tarija%22%7D%2C%22BR%22%3A%7B%22AC%22%3A%22Acre%22%2C%22AL%22%3A%22Alagoas%22%2C%22AP%22%3A%22Amap%5Cu00e1%22%2C%22AM%22%3A%22Amazonas%22%2C%22BA%22%3A%22Bahia%22%2C%22CE%22%3A%22Cear%5Cu00e1%22%2C%22DF%22%3A%22Distrito%20Federal%22%2C%22ES%22%3A%22Esp%5Cu00edrito%20Santo%22%2C%22GO%22%3A%22Goi%5Cu00e1s%22%2C%22MA%22%3A%22Maranh%5Cu00e3o%22%2C%22MT%22%3A%22Mato%20Grosso%22%2C%22MS%22%3A%22Mato%20Grosso%20do%20Sul%22%2C%22MG%22%3A%22Minas%20Gerais%22%2C%22PA%22%3A%22Par%5Cu00e1%22%2C%22PB%22%3A%22Para%5Cu00edba%22%2C%22PR%22%3A%22Paran%5Cu00e1%22%2C%22PE%22%3A%22Pernambuco%22%2C%22PI%22%3A%22Piau%5Cu00ed%22%2C%22RJ%22%3A%22Rio%20de%20Janeiro%22%2C%22RN%22%3A%22Rio%20Grande%20do%20Norte%22%2C%22RS%22%3A%22Rio%20Grande%20do%20Sul%22%2C%22RO%22%3A%22Rond%5Cu00f4nia%22%2C%22RR%22%3A%22Roraima%22%2C%22SC%22%3A%22Santa%20Catarina%22%2C%22SP%22%3A%22S%5Cu00e3o%20Paulo%22%2C%22SE%22%3A%22Sergipe%22%2C%22TO%22%3A%22Tocantins%22%7D%2C%22CA%22%3A%7B%22AB%22%3A%22Alberta%22%2C%22BC%22%3A%22British%20Columbia%22%2C%22MB%22%3A%22Manitoba%22%2C%22NB%22%3A%22New%20Brunswick%22%2C%22NL%22%3A%22Newfoundland%20and%20Labrador%22%2C%22NT%22%3A%22Northwest%20Territories%22%2C%22NS%22%3A%22Nova%20Scotia%22%2C%22NU%22%3A%22Nunavut%22%2C%22ON%22%3A%22Ontario%22%2C%22PE%22%3A%22Prince%20Edward%20Island%22%2C%22QC%22%3A%22Quebec%22%2C%22SK%22%3A%22Saskatchewan%22%2C%22YT%22%3A%22Yukon%20Territory%22%7D%2C%22CH%22%3A%7B%22AG%22%3A%22Aargau%22%2C%22AR%22%3A%22Appenzell%20Ausserrhoden%22%2C%22AI%22%3A%22Appenzell%20Innerrhoden%22%2C%22BL%22%3A%22Basel-Landschaft%22%2C%22BS%22%3A%22Basel-Stadt%22%2C%22BE%22%3A%22Bern%22%2C%22FR%22%3A%22Fribourg%22%2C%22GE%22%3A%22Geneva%22%2C%22GL%22%3A%22Glarus%22%2C%22GR%22%3A%22Graub%5Cu00fcnden%22%2C%22JU%22%3A%22Jura%22%2C%22LU%22%3A%22Luzern%22%2C%22NE%22%3A%22Neuch%5Cu00e2tel%22%2C%22NW%22%3A%22Nidwalden%22%2C%22OW%22%3A%22Obwalden%22%2C%22SH%22%3A%22Schaffhausen%22%2C%22SZ%22%3A%22Schwyz%22%2C%22SO%22%3A%22Solothurn%22%2C%22SG%22%3A%22St.%20Gallen%22%2C%22TG%22%3A%22Thurgau%22%2C%22TI%22%3A%22Ticino%22%2C%22UR%22%3A%22Uri%22%2C%22VS%22%3A%22Valais%22%2C%22VD%22%3A%22Vaud%22%2C%22ZG%22%3A%22Zug%22%2C%22ZH%22%3A%22Z%5Cu00fcrich%22%7D%2C%22CL%22%3A%7B%22CL-AI%22%3A%22Ais%5Cu00e9n%20del%20General%20Carlos%20Iba%5Cu00f1ez%20del%20Campo%22%2C%22CL-AN%22%3A%22Antofagasta%22%2C%22CL-AP%22%3A%22Arica%20y%20Parinacota%22%2C%22CL-AR%22%3A%22La%20Araucan%5Cu00eda%22%2C%22CL-AT%22%3A%22Atacama%22%2C%22CL-BI%22%3A%22Biob%5Cu00edo%22%2C%22CL-CO%22%3A%22Coquimbo%22%2C%22CL-LI%22%3A%22Libertador%20General%20Bernardo%20O%27Higgins%22%2C%22CL-LL%22%3A%22Los%20Lagos%22%2C%22CL-LR%22%3A%22Los%20R%5Cu00edos%22%2C%22CL-MA%22%3A%22Magallanes%22%2C%22CL-ML%22%3A%22Maule%22%2C%22CL-NB%22%3A%22%5Cu00d1uble%22%2C%22CL-RM%22%3A%22Regi%5Cu00f3n%20Metropolitana%20de%20Santiago%22%2C%22CL-TA%22%3A%22Tarapac%5Cu00e1%22%2C%22CL-VS%22%3A%22Valpara%5Cu00edso%22%7D%2C%22CN%22%3A%7B%22CN1%22%3A%22Yunnan%20%5C%2F%20%5Cu4e91%5Cu5357%22%2C%22CN2%22%3A%22Beijing%20%5C%2F%20%5Cu5317%5Cu4eac%22%2C%22CN3%22%3A%22Tianjin%20%5C%2F%20%5Cu5929%5Cu6d25%22%2C%22CN4%22%3A%22Hebei%20%5C%2F%20%5Cu6cb3%5Cu5317%22%2C%22CN5%22%3A%22Shanxi%20%5C%2F%20%5Cu5c71%5Cu897f%22%2C%22CN6%22%3A%22Inner%20Mongolia%20%5C%2F%20%5Cu5167%5Cu8499%5Cu53e4%22%2C%22CN7%22%3A%22Liaoning%20%5C%2F%20%5Cu8fbd%5Cu5b81%22%2C%22CN8%22%3A%22Jilin%20%5C%2F%20%5Cu5409%5Cu6797%22%2C%22CN9%22%3A%22Heilongjiang%20%5C%2F%20%5Cu9ed1%5Cu9f99%5Cu6c5f%22%2C%22CN10%22%3A%22Shanghai%20%5C%2F%20%5Cu4e0a%5Cu6d77%22%2C%22CN11%22%3A%22Jiangsu%20%5C%2F%20%5Cu6c5f%5Cu82cf%22%2C%22CN12%22%3A%22Zhejiang%20%5C%2F%20%5Cu6d59%5Cu6c5f%22%2C%22CN13%22%3A%22Anhui%20%5C%2F%20%5Cu5b89%5Cu5fbd%22%2C%22CN14%22%3A%22Fujian%20%5C%2F%20%5Cu798f%5Cu5efa%22%2C%22CN15%22%3A%22Jiangxi%20%5C%2F%20%5Cu6c5f%5Cu897f%22%2C%22CN16%22%3A%22Shandong%20%5C%2F%20%5Cu5c71%5Cu4e1c%22%2C%22CN17%22%3A%22Henan%20%5C%2F%20%5Cu6cb3%5Cu5357%22%2C%22CN18%22%3A%22Hubei%20%5C%2F%20%5Cu6e56%5Cu5317%22%2C%22CN19%22%3A%22Hunan%20%5C%2F%20%5Cu6e56%5Cu5357%22%2C%22CN20%22%3A%22Guangdong%20%5C%2F%20%5Cu5e7f%5Cu4e1c%22%2C%22CN21%22%3A%22Guangxi%20Zhuang%20%5C%2F%20%5Cu5e7f%5Cu897f%5Cu58ee%5Cu65cf%22%2C%22CN22%22%3A%22Hainan%20%5C%2F%20%5Cu6d77%5Cu5357%22%2C%22CN23%22%3A%22Chongqing%20%5C%2F%20%5Cu91cd%5Cu5e86%22%2C%22CN24%22%3A%22Sichuan%20%5C%2F%20%5Cu56db%5Cu5ddd%22%2C%22CN25%22%3A%22Guizhou%20%5C%2F%20%5Cu8d35%5Cu5dde%22%2C%22CN26%22%3A%22Shaanxi%20%5C%2F%20%5Cu9655%5Cu897f%22%2C%22CN27%22%3A%22Gansu%20%5C%2F%20%5Cu7518%5Cu8083%22%2C%22CN28%22%3A%22Qinghai%20%5C%2F%20%5Cu9752%5Cu6d77%22%2C%22CN29%22%3A%22Ningxia%20Hui%20%5C%2F%20%5Cu5b81%5Cu590f%22%2C%22CN30%22%3A%22Macao%20%5C%2F%20%5Cu6fb3%5Cu95e8%22%2C%22CN31%22%3A%22Tibet%20%5C%2F%20%5Cu897f%5Cu85cf%22%2C%22CN32%22%3A%22Xinjiang%20%5C%2F%20%5Cu65b0%5Cu7586%22%7D%2C%22CO%22%3A%7B%22CO-AMA%22%3A%22Amazonas%22%2C%22CO-ANT%22%3A%22Antioquia%22%2C%22CO-ARA%22%3A%22Arauca%22%2C%22CO-ATL%22%3A%22Atl%5Cu00e1ntico%22%2C%22CO-BOL%22%3A%22Bol%5Cu00edvar%22%2C%22CO-BOY%22%3A%22Boyac%5Cu00e1%22%2C%22CO-CAL%22%3A%22Caldas%22%2C%22CO-CAQ%22%3A%22Caquet%5Cu00e1%22%2C%22CO-CAS%22%3A%22Casanare%22%2C%22CO-CAU%22%3A%22Cauca%22%2C%22CO-CES%22%3A%22Cesar%22%2C%22CO-CHO%22%3A%22Choc%5Cu00f3%22%2C%22CO-COR%22%3A%22C%5Cu00f3rdoba%22%2C%22CO-CUN%22%3A%22Cundinamarca%22%2C%22CO-DC%22%3A%22Capital%20District%22%2C%22CO-GUA%22%3A%22Guain%5Cu00eda%22%2C%22CO-GUV%22%3A%22Guaviare%22%2C%22CO-HUI%22%3A%22Huila%22%2C%22CO-LAG%22%3A%22La%20Guajira%22%2C%22CO-MAG%22%3A%22Magdalena%22%2C%22CO-MET%22%3A%22Meta%22%2C%22CO-NAR%22%3A%22Nari%5Cu00f1o%22%2C%22CO-NSA%22%3A%22Norte%20de%20Santander%22%2C%22CO-PUT%22%3A%22Putumayo%22%2C%22CO-QUI%22%3A%22Quind%5Cu00edo%22%2C%22CO-RIS%22%3A%22Risaralda%22%2C%22CO-SAN%22%3A%22Santander%22%2C%22CO-SAP%22%3A%22San%20Andr%5Cu00e9s%20%26%20Providencia%22%2C%22CO-SUC%22%3A%22Sucre%22%2C%22CO-TOL%22%3A%22Tolima%22%2C%22CO-VAC%22%3A%22Valle%20del%20Cauca%22%2C%22CO-VAU%22%3A%22Vaup%5Cu00e9s%22%2C%22CO-VID%22%3A%22Vichada%22%7D%2C%22CR%22%3A%7B%22CR-A%22%3A%22Alajuela%22%2C%22CR-C%22%3A%22Cartago%22%2C%22CR-G%22%3A%22Guanacaste%22%2C%22CR-H%22%3A%22Heredia%22%2C%22CR-L%22%3A%22Lim%5Cu00f3n%22%2C%22CR-P%22%3A%22Puntarenas%22%2C%22CR-SJ%22%3A%22San%20Jos%5Cu00e9%22%7D%2C%22CZ%22%3A%5B%5D%2C%22DE%22%3A%7B%22DE-BW%22%3A%22Baden-W%5Cu00fcrttemberg%22%2C%22DE-BY%22%3A%22Bavaria%22%2C%22DE-BE%22%3A%22Berlin%22%2C%22DE-BB%22%3A%22Brandenburg%22%2C%22DE-HB%22%3A%22Bremen%22%2C%22DE-HH%22%3A%22Hamburg%22%2C%22DE-HE%22%3A%22Hesse%22%2C%22DE-MV%22%3A%22Mecklenburg-Vorpommern%22%2C%22DE-NI%22%3A%22Lower%20Saxony%22%2C%22DE-NW%22%3A%22North%20Rhine-Westphalia%22%2C%22DE-RP%22%3A%22Rhineland-Palatinate%22%2C%22DE-SL%22%3A%22Saarland%22%2C%22DE-SN%22%3A%22Saxony%22%2C%22DE-ST%22%3A%22Saxony-Anhalt%22%2C%22DE-SH%22%3A%22Schleswig-Holstein%22%2C%22DE-TH%22%3A%22Thuringia%22%7D%2C%22DK%22%3A%5B%5D%2C%22DO%22%3A%7B%22DO-01%22%3A%22Distrito%20Nacional%22%2C%22DO-02%22%3A%22Azua%22%2C%22DO-03%22%3A%22Baoruco%22%2C%22DO-04%22%3A%22Barahona%22%2C%22DO-33%22%3A%22Cibao%20Nordeste%22%2C%22DO-34%22%3A%22Cibao%20Noroeste%22%2C%22DO-35%22%3A%22Cibao%20Norte%22%2C%22DO-36%22%3A%22Cibao%20Sur%22%2C%22DO-05%22%3A%22Dajab%5Cu00f3n%22%2C%22DO-06%22%3A%22Duarte%22%2C%22DO-08%22%3A%22El%20Seibo%22%2C%22DO-37%22%3A%22El%20Valle%22%2C%22DO-07%22%3A%22El%5Cu00edas%20Pi%5Cu00f1a%22%2C%22DO-38%22%3A%22Enriquillo%22%2C%22DO-09%22%3A%22Espaillat%22%2C%22DO-30%22%3A%22Hato%20Mayor%22%2C%22DO-19%22%3A%22Hermanas%20Mirabal%22%2C%22DO-39%22%3A%22Hig%5Cu00fcamo%22%2C%22DO-10%22%3A%22Independencia%22%2C%22DO-11%22%3A%22La%20Altagracia%22%2C%22DO-12%22%3A%22La%20Romana%22%2C%22DO-13%22%3A%22La%20Vega%22%2C%22DO-14%22%3A%22Mar%5Cu00eda%20Trinidad%20S%5Cu00e1nchez%22%2C%22DO-28%22%3A%22Monse%5Cu00f1or%20Nouel%22%2C%22DO-15%22%3A%22Monte%20Cristi%22%2C%22DO-29%22%3A%22Monte%20Plata%22%2C%22DO-40%22%3A%22Ozama%22%2C%22DO-16%22%3A%22Pedernales%22%2C%22DO-17%22%3A%22Peravia%22%2C%22DO-18%22%3A%22Puerto%20Plata%22%2C%22DO-20%22%3A%22Saman%5Cu00e1%22%2C%22DO-21%22%3A%22San%20Crist%5Cu00f3bal%22%2C%22DO-31%22%3A%22San%20Jos%5Cu00e9%20de%20Ocoa%22%2C%22DO-22%22%3A%22San%20Juan%22%2C%22DO-23%22%3A%22San%20Pedro%20de%20Macor%5Cu00eds%22%2C%22DO-24%22%3A%22S%5Cu00e1nchez%20Ram%5Cu00edrez%22%2C%22DO-25%22%3A%22Santiago%22%2C%22DO-26%22%3A%22Santiago%20Rodr%5Cu00edguez%22%2C%22DO-32%22%3A%22Santo%20Domingo%22%2C%22DO-41%22%3A%22Valdesia%22%2C%22DO-27%22%3A%22Valverde%22%2C%22DO-42%22%3A%22Yuma%22%7D%2C%22DZ%22%3A%7B%22DZ-01%22%3A%22Adrar%22%2C%22DZ-02%22%3A%22Chlef%22%2C%22DZ-03%22%3A%22Laghouat%22%2C%22DZ-04%22%3A%22Oum%20El%20Bouaghi%22%2C%22DZ-05%22%3A%22Batna%22%2C%22DZ-06%22%3A%22B%5Cu00e9ja%5Cu00efa%22%2C%22DZ-07%22%3A%22Biskra%22%2C%22DZ-08%22%3A%22B%5Cu00e9char%22%2C%22DZ-09%22%3A%22Blida%22%2C%22DZ-10%22%3A%22Bouira%22%2C%22DZ-11%22%3A%22Tamanghasset%22%2C%22DZ-12%22%3A%22T%5Cu00e9bessa%22%2C%22DZ-13%22%3A%22Tlemcen%22%2C%22DZ-14%22%3A%22Tiaret%22%2C%22DZ-15%22%3A%22Tizi%20Ouzou%22%2C%22DZ-16%22%3A%22Algiers%22%2C%22DZ-17%22%3A%22Djelfa%22%2C%22DZ-18%22%3A%22Jijel%22%2C%22DZ-19%22%3A%22S%5Cu00e9tif%22%2C%22DZ-20%22%3A%22Sa%5Cu00efda%22%2C%22DZ-21%22%3A%22Skikda%22%2C%22DZ-22%22%3A%22Sidi%20Bel%20Abb%5Cu00e8s%22%2C%22DZ-23%22%3A%22Annaba%22%2C%22DZ-24%22%3A%22Guelma%22%2C%22DZ-25%22%3A%22Constantine%22%2C%22DZ-26%22%3A%22M%5Cu00e9d%5Cu00e9a%22%2C%22DZ-27%22%3A%22Mostaganem%22%2C%22DZ-28%22%3A%22M%5Cu2019Sila%22%2C%22DZ-29%22%3A%22Mascara%22%2C%22DZ-30%22%3A%22Ouargla%22%2C%22DZ-31%22%3A%22Oran%22%2C%22DZ-32%22%3A%22El%20Bayadh%22%2C%22DZ-33%22%3A%22Illizi%22%2C%22DZ-34%22%3A%22Bordj%20Bou%20Arr%5Cu00e9ridj%22%2C%22DZ-35%22%3A%22Boumerd%5Cu00e8s%22%2C%22DZ-36%22%3A%22El%20Tarf%22%2C%22DZ-37%22%3A%22Tindouf%22%2C%22DZ-38%22%3A%22Tissemsilt%22%2C%22DZ-39%22%3A%22El%20Oued%22%2C%22DZ-40%22%3A%22Khenchela%22%2C%22DZ-41%22%3A%22Souk%20Ahras%22%2C%22DZ-42%22%3A%22Tipasa%22%2C%22DZ-43%22%3A%22Mila%22%2C%22DZ-44%22%3A%22A%5Cu00efn%20Defla%22%2C%22DZ-45%22%3A%22Naama%22%2C%22DZ-46%22%3A%22A%5Cu00efn%20T%5Cu00e9mouchent%22%2C%22DZ-47%22%3A%22Gharda%5Cu00efa%22%2C%22DZ-48%22%3A%22Relizane%22%7D%2C%22EE%22%3A%5B%5D%2C%22EC%22%3A%7B%22EC-A%22%3A%22Azuay%22%2C%22EC-B%22%3A%22Bol%5Cu00edvar%22%2C%22EC-F%22%3A%22Ca%5Cu00f1ar%22%2C%22EC-C%22%3A%22Carchi%22%2C%22EC-H%22%3A%22Chimborazo%22%2C%22EC-X%22%3A%22Cotopaxi%22%2C%22EC-O%22%3A%22El%20Oro%22%2C%22EC-E%22%3A%22Esmeraldas%22%2C%22EC-W%22%3A%22Gal%5Cu00e1pagos%22%2C%22EC-G%22%3A%22Guayas%22%2C%22EC-I%22%3A%22Imbabura%22%2C%22EC-L%22%3A%22Loja%22%2C%22EC-R%22%3A%22Los%20R%5Cu00edos%22%2C%22EC-M%22%3A%22Manab%5Cu00ed%22%2C%22EC-S%22%3A%22Morona-Santiago%22%2C%22EC-N%22%3A%22Napo%22%2C%22EC-D%22%3A%22Orellana%22%2C%22EC-Y%22%3A%22Pastaza%22%2C%22EC-P%22%3A%22Pichincha%22%2C%22EC-SE%22%3A%22Santa%20Elena%22%2C%22EC-SD%22%3A%22Santo%20Domingo%20de%20los%20Ts%5Cu00e1chilas%22%2C%22EC-U%22%3A%22Sucumb%5Cu00edos%22%2C%22EC-T%22%3A%22Tungurahua%22%2C%22EC-Z%22%3A%22Zamora-Chinchipe%22%7D%2C%22EG%22%3A%7B%22EGALX%22%3A%22Alexandria%22%2C%22EGASN%22%3A%22Aswan%22%2C%22EGAST%22%3A%22Asyut%22%2C%22EGBA%22%3A%22Red%20Sea%22%2C%22EGBH%22%3A%22Beheira%22%2C%22EGBNS%22%3A%22Beni%20Suef%22%2C%22EGC%22%3A%22Cairo%22%2C%22EGDK%22%3A%22Dakahlia%22%2C%22EGDT%22%3A%22Damietta%22%2C%22EGFYM%22%3A%22Faiyum%22%2C%22EGGH%22%3A%22Gharbia%22%2C%22EGGZ%22%3A%22Giza%22%2C%22EGIS%22%3A%22Ismailia%22%2C%22EGJS%22%3A%22South%20Sinai%22%2C%22EGKB%22%3A%22Qalyubia%22%2C%22EGKFS%22%3A%22Kafr%20el-Sheikh%22%2C%22EGKN%22%3A%22Qena%22%2C%22EGLX%22%3A%22Luxor%22%2C%22EGMN%22%3A%22Minya%22%2C%22EGMNF%22%3A%22Monufia%22%2C%22EGMT%22%3A%22Matrouh%22%2C%22EGPTS%22%3A%22Port%20Said%22%2C%22EGSHG%22%3A%22Sohag%22%2C%22EGSHR%22%3A%22Al%20Sharqia%22%2C%22EGSIN%22%3A%22North%20Sinai%22%2C%22EGSUZ%22%3A%22Suez%22%2C%22EGWAD%22%3A%22New%20Valley%22%7D%2C%22ES%22%3A%7B%22C%22%3A%22A%20Coru%5Cu00f1a%22%2C%22VI%22%3A%22Araba%5C%2F%5Cu00c1lava%22%2C%22AB%22%3A%22Albacete%22%2C%22A%22%3A%22Alicante%22%2C%22AL%22%3A%22Almer%5Cu00eda%22%2C%22O%22%3A%22Asturias%22%2C%22AV%22%3A%22%5Cu00c1vila%22%2C%22BA%22%3A%22Badajoz%22%2C%22PM%22%3A%22Baleares%22%2C%22B%22%3A%22Barcelona%22%2C%22BU%22%3A%22Burgos%22%2C%22CC%22%3A%22C%5Cu00e1ceres%22%2C%22CA%22%3A%22C%5Cu00e1diz%22%2C%22S%22%3A%22Cantabria%22%2C%22CS%22%3A%22Castell%5Cu00f3n%22%2C%22CE%22%3A%22Ceuta%22%2C%22CR%22%3A%22Ciudad%20Real%22%2C%22CO%22%3A%22C%5Cu00f3rdoba%22%2C%22CU%22%3A%22Cuenca%22%2C%22GI%22%3A%22Girona%22%2C%22GR%22%3A%22Granada%22%2C%22GU%22%3A%22Guadalajara%22%2C%22SS%22%3A%22Gipuzkoa%22%2C%22H%22%3A%22Huelva%22%2C%22HU%22%3A%22Huesca%22%2C%22J%22%3A%22Ja%5Cu00e9n%22%2C%22LO%22%3A%22La%20Rioja%22%2C%22GC%22%3A%22Las%20Palmas%22%2C%22LE%22%3A%22Le%5Cu00f3n%22%2C%22L%22%3A%22Lleida%22%2C%22LU%22%3A%22Lugo%22%2C%22M%22%3A%22Madrid%22%2C%22MA%22%3A%22M%5Cu00e1laga%22%2C%22ML%22%3A%22Melilla%22%2C%22MU%22%3A%22Murcia%22%2C%22NA%22%3A%22Navarra%22%2C%22OR%22%3A%22Ourense%22%2C%22P%22%3A%22Palencia%22%2C%22PO%22%3A%22Pontevedra%22%2C%22SA%22%3A%22Salamanca%22%2C%22TF%22%3A%22Santa%20Cruz%20de%20Tenerife%22%2C%22SG%22%3A%22Segovia%22%2C%22SE%22%3A%22Sevilla%22%2C%22SO%22%3A%22Soria%22%2C%22T%22%3A%22Tarragona%22%2C%22TE%22%3A%22Teruel%22%2C%22TO%22%3A%22Toledo%22%2C%22V%22%3A%22Valencia%22%2C%22VA%22%3A%22Valladolid%22%2C%22BI%22%3A%22Biscay%22%2C%22ZA%22%3A%22Zamora%22%2C%22Z%22%3A%22Zaragoza%22%7D%2C%22ET%22%3A%5B%5D%2C%22FI%22%3A%5B%5D%2C%22FR%22%3A%5B%5D%2C%22GF%22%3A%5B%5D%2C%22GH%22%3A%7B%22AF%22%3A%22Ahafo%22%2C%22AH%22%3A%22Ashanti%22%2C%22BA%22%3A%22Brong-Ahafo%22%2C%22BO%22%3A%22Bono%22%2C%22BE%22%3A%22Bono%20East%22%2C%22CP%22%3A%22Central%22%2C%22EP%22%3A%22Eastern%22%2C%22AA%22%3A%22Greater%20Accra%22%2C%22NE%22%3A%22North%20East%22%2C%22NP%22%3A%22Northern%22%2C%22OT%22%3A%22Oti%22%2C%22SV%22%3A%22Savannah%22%2C%22UE%22%3A%22Upper%20East%22%2C%22UW%22%3A%22Upper%20West%22%2C%22TV%22%3A%22Volta%22%2C%22WP%22%3A%22Western%22%2C%22WN%22%3A%22Western%20North%22%7D%2C%22GP%22%3A%5B%5D%2C%22GR%22%3A%7B%22I%22%3A%22Attica%22%2C%22A%22%3A%22East%20Macedonia%20and%20Thrace%22%2C%22B%22%3A%22Central%20Macedonia%22%2C%22C%22%3A%22West%20Macedonia%22%2C%22D%22%3A%22Epirus%22%2C%22E%22%3A%22Thessaly%22%2C%22F%22%3A%22Ionian%20Islands%22%2C%22G%22%3A%22West%20Greece%22%2C%22H%22%3A%22Central%20Greece%22%2C%22J%22%3A%22Peloponnese%22%2C%22K%22%3A%22North%20Aegean%22%2C%22L%22%3A%22South%20Aegean%22%2C%22M%22%3A%22Crete%22%7D%2C%22GT%22%3A%7B%22GT-AV%22%3A%22Alta%20Verapaz%22%2C%22GT-BV%22%3A%22Baja%20Verapaz%22%2C%22GT-CM%22%3A%22Chimaltenango%22%2C%22GT-CQ%22%3A%22Chiquimula%22%2C%22GT-PR%22%3A%22El%20Progreso%22%2C%22GT-ES%22%3A%22Escuintla%22%2C%22GT-GU%22%3A%22Guatemala%22%2C%22GT-HU%22%3A%22Huehuetenango%22%2C%22GT-IZ%22%3A%22Izabal%22%2C%22GT-JA%22%3A%22Jalapa%22%2C%22GT-JU%22%3A%22Jutiapa%22%2C%22GT-PE%22%3A%22Pet%5Cu00e9n%22%2C%22GT-QZ%22%3A%22Quetzaltenango%22%2C%22GT-QC%22%3A%22Quich%5Cu00e9%22%2C%22GT-RE%22%3A%22Retalhuleu%22%2C%22GT-SA%22%3A%22Sacatep%5Cu00e9quez%22%2C%22GT-SM%22%3A%22San%20Marcos%22%2C%22GT-SR%22%3A%22Santa%20Rosa%22%2C%22GT-SO%22%3A%22Solol%5Cu00e1%22%2C%22GT-SU%22%3A%22Suchitep%5Cu00e9quez%22%2C%22GT-TO%22%3A%22Totonicap%5Cu00e1n%22%2C%22GT-ZA%22%3A%22Zacapa%22%7D%2C%22HK%22%3A%7B%22HONG%20KONG%22%3A%22Hong%20Kong%20Island%22%2C%22KOWLOON%22%3A%22Kowloon%22%2C%22NEW%20TERRITORIES%22%3A%22New%20Territories%22%7D%2C%22HN%22%3A%7B%22HN-AT%22%3A%22Atl%5Cu00e1ntida%22%2C%22HN-IB%22%3A%22Bay%20Islands%22%2C%22HN-CH%22%3A%22Choluteca%22%2C%22HN-CL%22%3A%22Col%5Cu00f3n%22%2C%22HN-CM%22%3A%22Comayagua%22%2C%22HN-CP%22%3A%22Cop%5Cu00e1n%22%2C%22HN-CR%22%3A%22Cort%5Cu00e9s%22%2C%22HN-EP%22%3A%22El%20Para%5Cu00edso%22%2C%22HN-FM%22%3A%22Francisco%20Moraz%5Cu00e1n%22%2C%22HN-GD%22%3A%22Gracias%20a%20Dios%22%2C%22HN-IN%22%3A%22Intibuc%5Cu00e1%22%2C%22HN-LE%22%3A%22Lempira%22%2C%22HN-LP%22%3A%22La%20Paz%22%2C%22HN-OC%22%3A%22Ocotepeque%22%2C%22HN-OL%22%3A%22Olancho%22%2C%22HN-SB%22%3A%22Santa%20B%5Cu00e1rbara%22%2C%22HN-VA%22%3A%22Valle%22%2C%22HN-YO%22%3A%22Yoro%22%7D%2C%22HU%22%3A%7B%22BK%22%3A%22B%5Cu00e1cs-Kiskun%22%2C%22BE%22%3A%22B%5Cu00e9k%5Cu00e9s%22%2C%22BA%22%3A%22Baranya%22%2C%22BZ%22%3A%22Borsod-Aba%5Cu00faj-Zempl%5Cu00e9n%22%2C%22BU%22%3A%22Budapest%22%2C%22CS%22%3A%22Csongr%5Cu00e1d-Csan%5Cu00e1d%22%2C%22FE%22%3A%22Fej%5Cu00e9r%22%2C%22GS%22%3A%22Gy%5Cu0151r-Moson-Sopron%22%2C%22HB%22%3A%22Hajd%5Cu00fa-Bihar%22%2C%22HE%22%3A%22Heves%22%2C%22JN%22%3A%22J%5Cu00e1sz-Nagykun-Szolnok%22%2C%22KE%22%3A%22Kom%5Cu00e1rom-Esztergom%22%2C%22NO%22%3A%22N%5Cu00f3gr%5Cu00e1d%22%2C%22PE%22%3A%22Pest%22%2C%22SO%22%3A%22Somogy%22%2C%22SZ%22%3A%22Szabolcs-Szatm%5Cu00e1r-Bereg%22%2C%22TO%22%3A%22Tolna%22%2C%22VA%22%3A%22Vas%22%2C%22VE%22%3A%22Veszpr%5Cu00e9m%22%2C%22ZA%22%3A%22Zala%22%7D%2C%22ID%22%3A%7B%22AC%22%3A%22Daerah%20Istimewa%20Aceh%22%2C%22SU%22%3A%22Sumatera%20Utara%22%2C%22SB%22%3A%22Sumatera%20Barat%22%2C%22RI%22%3A%22Riau%22%2C%22KR%22%3A%22Kepulauan%20Riau%22%2C%22JA%22%3A%22Jambi%22%2C%22SS%22%3A%22Sumatera%20Selatan%22%2C%22BB%22%3A%22Bangka%20Belitung%22%2C%22BE%22%3A%22Bengkulu%22%2C%22LA%22%3A%22Lampung%22%2C%22JK%22%3A%22DKI%20Jakarta%22%2C%22JB%22%3A%22Jawa%20Barat%22%2C%22BT%22%3A%22Banten%22%2C%22JT%22%3A%22Jawa%20Tengah%22%2C%22JI%22%3A%22Jawa%20Timur%22%2C%22YO%22%3A%22Daerah%20Istimewa%20Yogyakarta%22%2C%22BA%22%3A%22Bali%22%2C%22NB%22%3A%22Nusa%20Tenggara%20Barat%22%2C%22NT%22%3A%22Nusa%20Tenggara%20Timur%22%2C%22KB%22%3A%22Kalimantan%20Barat%22%2C%22KT%22%3A%22Kalimantan%20Tengah%22%2C%22KI%22%3A%22Kalimantan%20Timur%22%2C%22KS%22%3A%22Kalimantan%20Selatan%22%2C%22KU%22%3A%22Kalimantan%20Utara%22%2C%22SA%22%3A%22Sulawesi%20Utara%22%2C%22ST%22%3A%22Sulawesi%20Tengah%22%2C%22SG%22%3A%22Sulawesi%20Tenggara%22%2C%22SR%22%3A%22Sulawesi%20Barat%22%2C%22SN%22%3A%22Sulawesi%20Selatan%22%2C%22GO%22%3A%22Gorontalo%22%2C%22MA%22%3A%22Maluku%22%2C%22MU%22%3A%22Maluku%20Utara%22%2C%22PA%22%3A%22Papua%22%2C%22PB%22%3A%22Papua%20Barat%22%7D%2C%22IE%22%3A%7B%22CW%22%3A%22Carlow%22%2C%22CN%22%3A%22Cavan%22%2C%22CE%22%3A%22Clare%22%2C%22CO%22%3A%22Cork%22%2C%22DL%22%3A%22Donegal%22%2C%22D%22%3A%22Dublin%22%2C%22G%22%3A%22Galway%22%2C%22KY%22%3A%22Kerry%22%2C%22KE%22%3A%22Kildare%22%2C%22KK%22%3A%22Kilkenny%22%2C%22LS%22%3A%22Laois%22%2C%22LM%22%3A%22Leitrim%22%2C%22LK%22%3A%22Limerick%22%2C%22LD%22%3A%22Longford%22%2C%22LH%22%3A%22Louth%22%2C%22MO%22%3A%22Mayo%22%2C%22MH%22%3A%22Meath%22%2C%22MN%22%3A%22Monaghan%22%2C%22OY%22%3A%22Offaly%22%2C%22RN%22%3A%22Roscommon%22%2C%22SO%22%3A%22Sligo%22%2C%22TA%22%3A%22Tipperary%22%2C%22WD%22%3A%22Waterford%22%2C%22WH%22%3A%22Westmeath%22%2C%22WX%22%3A%22Wexford%22%2C%22WW%22%3A%22Wicklow%22%7D%2C%22IN%22%3A%7B%22AP%22%3A%22Andhra%20Pradesh%22%2C%22AR%22%3A%22Arunachal%20Pradesh%22%2C%22AS%22%3A%22Assam%22%2C%22BR%22%3A%22Bihar%22%2C%22CT%22%3A%22Chhattisgarh%22%2C%22GA%22%3A%22Goa%22%2C%22GJ%22%3A%22Gujarat%22%2C%22HR%22%3A%22Haryana%22%2C%22HP%22%3A%22Himachal%20Pradesh%22%2C%22JK%22%3A%22Jammu%20and%20Kashmir%22%2C%22JH%22%3A%22Jharkhand%22%2C%22KA%22%3A%22Karnataka%22%2C%22KL%22%3A%22Kerala%22%2C%22LA%22%3A%22Ladakh%22%2C%22MP%22%3A%22Madhya%20Pradesh%22%2C%22MH%22%3A%22Maharashtra%22%2C%22MN%22%3A%22Manipur%22%2C%22ML%22%3A%22Meghalaya%22%2C%22MZ%22%3A%22Mizoram%22%2C%22NL%22%3A%22Nagaland%22%2C%22OR%22%3A%22Odisha%22%2C%22PB%22%3A%22Punjab%22%2C%22RJ%22%3A%22Rajasthan%22%2C%22SK%22%3A%22Sikkim%22%2C%22TN%22%3A%22Tamil%20Nadu%22%2C%22TS%22%3A%22Telangana%22%2C%22TR%22%3A%22Tripura%22%2C%22UK%22%3A%22Uttarakhand%22%2C%22UP%22%3A%22Uttar%20Pradesh%22%2C%22WB%22%3A%22West%20Bengal%22%2C%22AN%22%3A%22Andaman%20and%20Nicobar%20Islands%22%2C%22CH%22%3A%22Chandigarh%22%2C%22DN%22%3A%22Dadra%20and%20Nagar%20Haveli%22%2C%22DD%22%3A%22Daman%20and%20Diu%22%2C%22DL%22%3A%22Delhi%22%2C%22LD%22%3A%22Lakshadeep%22%2C%22PY%22%3A%22Pondicherry%20%28Puducherry%29%22%7D%2C%22IR%22%3A%7B%22KHZ%22%3A%22Khuzestan%20%28%5Cu062e%5Cu0648%5Cu0632%5Cu0633%5Cu062a%5Cu0627%5Cu0646%29%22%2C%22THR%22%3A%22Tehran%20%28%5Cu062a%5Cu0647%5Cu0631%5Cu0627%5Cu0646%29%22%2C%22ILM%22%3A%22Ilaam%20%28%5Cu0627%5Cu06cc%5Cu0644%5Cu0627%5Cu0645%29%22%2C%22BHR%22%3A%22Bushehr%20%28%5Cu0628%5Cu0648%5Cu0634%5Cu0647%5Cu0631%29%22%2C%22ADL%22%3A%22Ardabil%20%28%5Cu0627%5Cu0631%5Cu062f%5Cu0628%5Cu06cc%5Cu0644%29%22%2C%22ESF%22%3A%22Isfahan%20%28%5Cu0627%5Cu0635%5Cu0641%5Cu0647%5Cu0627%5Cu0646%29%22%2C%22YZD%22%3A%22Yazd%20%28%5Cu06cc%5Cu0632%5Cu062f%29%22%2C%22KRH%22%3A%22Kermanshah%20%28%5Cu06a9%5Cu0631%5Cu0645%5Cu0627%5Cu0646%5Cu0634%5Cu0627%5Cu0647%29%22%2C%22KRN%22%3A%22Kerman%20%28%5Cu06a9%5Cu0631%5Cu0645%5Cu0627%5Cu0646%29%22%2C%22HDN%22%3A%22Hamadan%20%28%5Cu0647%5Cu0645%5Cu062f%5Cu0627%5Cu0646%29%22%2C%22GZN%22%3A%22Ghazvin%20%28%5Cu0642%5Cu0632%5Cu0648%5Cu06cc%5Cu0646%29%22%2C%22ZJN%22%3A%22Zanjan%20%28%5Cu0632%5Cu0646%5Cu062c%5Cu0627%5Cu0646%29%22%2C%22LRS%22%3A%22Luristan%20%28%5Cu0644%5Cu0631%5Cu0633%5Cu062a%5Cu0627%5Cu0646%29%22%2C%22ABZ%22%3A%22Alborz%20%28%5Cu0627%5Cu0644%5Cu0628%5Cu0631%5Cu0632%29%22%2C%22EAZ%22%3A%22East%20Azarbaijan%20%28%5Cu0622%5Cu0630%5Cu0631%5Cu0628%5Cu0627%5Cu06cc%5Cu062c%5Cu0627%5Cu0646%20%5Cu0634%5Cu0631%5Cu0642%5Cu06cc%29%22%2C%22WAZ%22%3A%22West%20Azarbaijan%20%28%5Cu0622%5Cu0630%5Cu0631%5Cu0628%5Cu0627%5Cu06cc%5Cu062c%5Cu0627%5Cu0646%20%5Cu063a%5Cu0631%5Cu0628%5Cu06cc%29%22%2C%22CHB%22%3A%22Chaharmahal%20and%20Bakhtiari%20%28%5Cu0686%5Cu0647%5Cu0627%5Cu0631%5Cu0645%5Cu062d%5Cu0627%5Cu0644%20%5Cu0648%20%5Cu0628%5Cu062e%5Cu062a%5Cu06cc%5Cu0627%5Cu0631%5Cu06cc%29%22%2C%22SKH%22%3A%22South%20Khorasan%20%28%5Cu062e%5Cu0631%5Cu0627%5Cu0633%5Cu0627%5Cu0646%20%5Cu062c%5Cu0646%5Cu0648%5Cu0628%5Cu06cc%29%22%2C%22RKH%22%3A%22Razavi%20Khorasan%20%28%5Cu062e%5Cu0631%5Cu0627%5Cu0633%5Cu0627%5Cu0646%20%5Cu0631%5Cu0636%5Cu0648%5Cu06cc%29%22%2C%22NKH%22%3A%22North%20Khorasan%20%28%5Cu062e%5Cu0631%5Cu0627%5Cu0633%5Cu0627%5Cu0646%20%5Cu0634%5Cu0645%5Cu0627%5Cu0644%5Cu06cc%29%22%2C%22SMN%22%3A%22Semnan%20%28%5Cu0633%5Cu0645%5Cu0646%5Cu0627%5Cu0646%29%22%2C%22FRS%22%3A%22Fars%20%28%5Cu0641%5Cu0627%5Cu0631%5Cu0633%29%22%2C%22QHM%22%3A%22Qom%20%28%5Cu0642%5Cu0645%29%22%2C%22KRD%22%3A%22Kurdistan%20%5C%2F%20%5Cu06a9%5Cu0631%5Cu062f%5Cu0633%5Cu062a%5Cu0627%5Cu0646%29%22%2C%22KBD%22%3A%22Kohgiluyeh%20and%20BoyerAhmad%20%28%5Cu06a9%5Cu0647%5Cu06af%5Cu06cc%5Cu0644%5Cu0648%5Cu06cc%5Cu06cc%5Cu0647%20%5Cu0648%20%5Cu0628%5Cu0648%5Cu06cc%5Cu0631%5Cu0627%5Cu062d%5Cu0645%5Cu062f%29%22%2C%22GLS%22%3A%22Golestan%20%28%5Cu06af%5Cu0644%5Cu0633%5Cu062a%5Cu0627%5Cu0646%29%22%2C%22GIL%22%3A%22Gilan%20%28%5Cu06af%5Cu06cc%5Cu0644%5Cu0627%5Cu0646%29%22%2C%22MZN%22%3A%22Mazandaran%20%28%5Cu0645%5Cu0627%5Cu0632%5Cu0646%5Cu062f%5Cu0631%5Cu0627%5Cu0646%29%22%2C%22MKZ%22%3A%22Markazi%20%28%5Cu0645%5Cu0631%5Cu06a9%5Cu0632%5Cu06cc%29%22%2C%22HRZ%22%3A%22Hormozgan%20%28%5Cu0647%5Cu0631%5Cu0645%5Cu0632%5Cu06af%5Cu0627%5Cu0646%29%22%2C%22SBN%22%3A%22Sistan%20and%20Baluchestan%20%28%5Cu0633%5Cu06cc%5Cu0633%5Cu062a%5Cu0627%5Cu0646%20%5Cu0648%20%5Cu0628%5Cu0644%5Cu0648%5Cu0686%5Cu0633%5Cu062a%5Cu0627%5Cu0646%29%22%7D%2C%22IS%22%3A%5B%5D%2C%22IT%22%3A%7B%22AG%22%3A%22Agrigento%22%2C%22AL%22%3A%22Alessandria%22%2C%22AN%22%3A%22Ancona%22%2C%22AO%22%3A%22Aosta%22%2C%22AR%22%3A%22Arezzo%22%2C%22AP%22%3A%22Ascoli%20Piceno%22%2C%22AT%22%3A%22Asti%22%2C%22AV%22%3A%22Avellino%22%2C%22BA%22%3A%22Bari%22%2C%22BT%22%3A%22Barletta-Andria-Trani%22%2C%22BL%22%3A%22Belluno%22%2C%22BN%22%3A%22Benevento%22%2C%22BG%22%3A%22Bergamo%22%2C%22BI%22%3A%22Biella%22%2C%22BO%22%3A%22Bologna%22%2C%22BZ%22%3A%22Bolzano%22%2C%22BS%22%3A%22Brescia%22%2C%22BR%22%3A%22Brindisi%22%2C%22CA%22%3A%22Cagliari%22%2C%22CL%22%3A%22Caltanissetta%22%2C%22CB%22%3A%22Campobasso%22%2C%22CE%22%3A%22Caserta%22%2C%22CT%22%3A%22Catania%22%2C%22CZ%22%3A%22Catanzaro%22%2C%22CH%22%3A%22Chieti%22%2C%22CO%22%3A%22Como%22%2C%22CS%22%3A%22Cosenza%22%2C%22CR%22%3A%22Cremona%22%2C%22KR%22%3A%22Crotone%22%2C%22CN%22%3A%22Cuneo%22%2C%22EN%22%3A%22Enna%22%2C%22FM%22%3A%22Fermo%22%2C%22FE%22%3A%22Ferrara%22%2C%22FI%22%3A%22Firenze%22%2C%22FG%22%3A%22Foggia%22%2C%22FC%22%3A%22Forl%5Cu00ec-Cesena%22%2C%22FR%22%3A%22Frosinone%22%2C%22GE%22%3A%22Genova%22%2C%22GO%22%3A%22Gorizia%22%2C%22GR%22%3A%22Grosseto%22%2C%22IM%22%3A%22Imperia%22%2C%22IS%22%3A%22Isernia%22%2C%22SP%22%3A%22La%20Spezia%22%2C%22AQ%22%3A%22L%27Aquila%22%2C%22LT%22%3A%22Latina%22%2C%22LE%22%3A%22Lecce%22%2C%22LC%22%3A%22Lecco%22%2C%22LI%22%3A%22Livorno%22%2C%22LO%22%3A%22Lodi%22%2C%22LU%22%3A%22Lucca%22%2C%22MC%22%3A%22Macerata%22%2C%22MN%22%3A%22Mantova%22%2C%22MS%22%3A%22Massa-Carrara%22%2C%22MT%22%3A%22Matera%22%2C%22ME%22%3A%22Messina%22%2C%22MI%22%3A%22Milano%22%2C%22MO%22%3A%22Modena%22%2C%22MB%22%3A%22Monza%20e%20della%20Brianza%22%2C%22NA%22%3A%22Napoli%22%2C%22NO%22%3A%22Novara%22%2C%22NU%22%3A%22Nuoro%22%2C%22OR%22%3A%22Oristano%22%2C%22PD%22%3A%22Padova%22%2C%22PA%22%3A%22Palermo%22%2C%22PR%22%3A%22Parma%22%2C%22PV%22%3A%22Pavia%22%2C%22PG%22%3A%22Perugia%22%2C%22PU%22%3A%22Pesaro%20e%20Urbino%22%2C%22PE%22%3A%22Pescara%22%2C%22PC%22%3A%22Piacenza%22%2C%22PI%22%3A%22Pisa%22%2C%22PT%22%3A%22Pistoia%22%2C%22PN%22%3A%22Pordenone%22%2C%22PZ%22%3A%22Potenza%22%2C%22PO%22%3A%22Prato%22%2C%22RG%22%3A%22Ragusa%22%2C%22RA%22%3A%22Ravenna%22%2C%22RC%22%3A%22Reggio%20Calabria%22%2C%22RE%22%3A%22Reggio%20Emilia%22%2C%22RI%22%3A%22Rieti%22%2C%22RN%22%3A%22Rimini%22%2C%22RM%22%3A%22Roma%22%2C%22RO%22%3A%22Rovigo%22%2C%22SA%22%3A%22Salerno%22%2C%22SS%22%3A%22Sassari%22%2C%22SV%22%3A%22Savona%22%2C%22SI%22%3A%22Siena%22%2C%22SR%22%3A%22Siracusa%22%2C%22SO%22%3A%22Sondrio%22%2C%22SU%22%3A%22Sud%20Sardegna%22%2C%22TA%22%3A%22Taranto%22%2C%22TE%22%3A%22Teramo%22%2C%22TR%22%3A%22Terni%22%2C%22TO%22%3A%22Torino%22%2C%22TP%22%3A%22Trapani%22%2C%22TN%22%3A%22Trento%22%2C%22TV%22%3A%22Treviso%22%2C%22TS%22%3A%22Trieste%22%2C%22UD%22%3A%22Udine%22%2C%22VA%22%3A%22Varese%22%2C%22VE%22%3A%22Venezia%22%2C%22VB%22%3A%22Verbano-Cusio-Ossola%22%2C%22VC%22%3A%22Vercelli%22%2C%22VR%22%3A%22Verona%22%2C%22VV%22%3A%22Vibo%20Valentia%22%2C%22VI%22%3A%22Vicenza%22%2C%22VT%22%3A%22Viterbo%22%7D%2C%22IL%22%3A%5B%5D%2C%22IM%22%3A%5B%5D%2C%22JM%22%3A%7B%22JM-01%22%3A%22Kingston%22%2C%22JM-02%22%3A%22Saint%20Andrew%22%2C%22JM-03%22%3A%22Saint%20Thomas%22%2C%22JM-04%22%3A%22Portland%22%2C%22JM-05%22%3A%22Saint%20Mary%22%2C%22JM-06%22%3A%22Saint%20Ann%22%2C%22JM-07%22%3A%22Trelawny%22%2C%22JM-08%22%3A%22Saint%20James%22%2C%22JM-09%22%3A%22Hanover%22%2C%22JM-10%22%3A%22Westmoreland%22%2C%22JM-11%22%3A%22Saint%20Elizabeth%22%2C%22JM-12%22%3A%22Manchester%22%2C%22JM-13%22%3A%22Clarendon%22%2C%22JM-14%22%3A%22Saint%20Catherine%22%7D%2C%22JP%22%3A%7B%22JP01%22%3A%22Hokkaido%22%2C%22JP02%22%3A%22Aomori%22%2C%22JP03%22%3A%22Iwate%22%2C%22JP04%22%3A%22Miyagi%22%2C%22JP05%22%3A%22Akita%22%2C%22JP06%22%3A%22Yamagata%22%2C%22JP07%22%3A%22Fukushima%22%2C%22JP08%22%3A%22Ibaraki%22%2C%22JP09%22%3A%22Tochigi%22%2C%22JP10%22%3A%22Gunma%22%2C%22JP11%22%3A%22Saitama%22%2C%22JP12%22%3A%22Chiba%22%2C%22JP13%22%3A%22Tokyo%22%2C%22JP14%22%3A%22Kanagawa%22%2C%22JP15%22%3A%22Niigata%22%2C%22JP16%22%3A%22Toyama%22%2C%22JP17%22%3A%22Ishikawa%22%2C%22JP18%22%3A%22Fukui%22%2C%22JP19%22%3A%22Yamanashi%22%2C%22JP20%22%3A%22Nagano%22%2C%22JP21%22%3A%22Gifu%22%2C%22JP22%22%3A%22Shizuoka%22%2C%22JP23%22%3A%22Aichi%22%2C%22JP24%22%3A%22Mie%22%2C%22JP25%22%3A%22Shiga%22%2C%22JP26%22%3A%22Kyoto%22%2C%22JP27%22%3A%22Osaka%22%2C%22JP28%22%3A%22Hyogo%22%2C%22JP29%22%3A%22Nara%22%2C%22JP30%22%3A%22Wakayama%22%2C%22JP31%22%3A%22Tottori%22%2C%22JP32%22%3A%22Shimane%22%2C%22JP33%22%3A%22Okayama%22%2C%22JP34%22%3A%22Hiroshima%22%2C%22JP35%22%3A%22Yamaguchi%22%2C%22JP36%22%3A%22Tokushima%22%2C%22JP37%22%3A%22Kagawa%22%2C%22JP38%22%3A%22Ehime%22%2C%22JP39%22%3A%22Kochi%22%2C%22JP40%22%3A%22Fukuoka%22%2C%22JP41%22%3A%22Saga%22%2C%22JP42%22%3A%22Nagasaki%22%2C%22JP43%22%3A%22Kumamoto%22%2C%22JP44%22%3A%22Oita%22%2C%22JP45%22%3A%22Miyazaki%22%2C%22JP46%22%3A%22Kagoshima%22%2C%22JP47%22%3A%22Okinawa%22%7D%2C%22KE%22%3A%7B%22KE01%22%3A%22Baringo%22%2C%22KE02%22%3A%22Bomet%22%2C%22KE03%22%3A%22Bungoma%22%2C%22KE04%22%3A%22Busia%22%2C%22KE05%22%3A%22Elgeyo-Marakwet%22%2C%22KE06%22%3A%22Embu%22%2C%22KE07%22%3A%22Garissa%22%2C%22KE08%22%3A%22Homa%20Bay%22%2C%22KE09%22%3A%22Isiolo%22%2C%22KE10%22%3A%22Kajiado%22%2C%22KE11%22%3A%22Kakamega%22%2C%22KE12%22%3A%22Kericho%22%2C%22KE13%22%3A%22Kiambu%22%2C%22KE14%22%3A%22Kilifi%22%2C%22KE15%22%3A%22Kirinyaga%22%2C%22KE16%22%3A%22Kisii%22%2C%22KE17%22%3A%22Kisumu%22%2C%22KE18%22%3A%22Kitui%22%2C%22KE19%22%3A%22Kwale%22%2C%22KE20%22%3A%22Laikipia%22%2C%22KE21%22%3A%22Lamu%22%2C%22KE22%22%3A%22Machakos%22%2C%22KE23%22%3A%22Makueni%22%2C%22KE24%22%3A%22Mandera%22%2C%22KE25%22%3A%22Marsabit%22%2C%22KE26%22%3A%22Meru%22%2C%22KE27%22%3A%22Migori%22%2C%22KE28%22%3A%22Mombasa%22%2C%22KE29%22%3A%22Murang%5Cu2019a%22%2C%22KE30%22%3A%22Nairobi%20County%22%2C%22KE31%22%3A%22Nakuru%22%2C%22KE32%22%3A%22Nandi%22%2C%22KE33%22%3A%22Narok%22%2C%22KE34%22%3A%22Nyamira%22%2C%22KE35%22%3A%22Nyandarua%22%2C%22KE36%22%3A%22Nyeri%22%2C%22KE37%22%3A%22Samburu%22%2C%22KE38%22%3A%22Siaya%22%2C%22KE39%22%3A%22Taita-Taveta%22%2C%22KE40%22%3A%22Tana%20River%22%2C%22KE41%22%3A%22Tharaka-Nithi%22%2C%22KE42%22%3A%22Trans%20Nzoia%22%2C%22KE43%22%3A%22Turkana%22%2C%22KE44%22%3A%22Uasin%20Gishu%22%2C%22KE45%22%3A%22Vihiga%22%2C%22KE46%22%3A%22Wajir%22%2C%22KE47%22%3A%22West%20Pokot%22%7D%2C%22KN%22%3A%7B%22KNK%22%3A%22Saint%20Kitts%22%2C%22KNN%22%3A%22Nevis%22%2C%22KN01%22%3A%22Christ%20Church%20Nichola%20Town%22%2C%22KN02%22%3A%22Saint%20Anne%20Sandy%20Point%22%2C%22KN03%22%3A%22Saint%20George%20Basseterre%22%2C%22KN04%22%3A%22Saint%20George%20Gingerland%22%2C%22KN05%22%3A%22Saint%20James%20Windward%22%2C%22KN06%22%3A%22Saint%20John%20Capisterre%22%2C%22KN07%22%3A%22Saint%20John%20Figtree%22%2C%22KN08%22%3A%22Saint%20Mary%20Cayon%22%2C%22KN09%22%3A%22Saint%20Paul%20Capisterre%22%2C%22KN10%22%3A%22Saint%20Paul%20Charlestown%22%2C%22KN11%22%3A%22Saint%20Peter%20Basseterre%22%2C%22KN12%22%3A%22Saint%20Thomas%20Lowland%22%2C%22KN13%22%3A%22Saint%20Thomas%20Middle%20Island%22%2C%22KN15%22%3A%22Trinity%20Palmetto%20Point%22%7D%2C%22KR%22%3A%5B%5D%2C%22KW%22%3A%5B%5D%2C%22LA%22%3A%7B%22AT%22%3A%22Attapeu%22%2C%22BK%22%3A%22Bokeo%22%2C%22BL%22%3A%22Bolikhamsai%22%2C%22CH%22%3A%22Champasak%22%2C%22HO%22%3A%22Houaphanh%22%2C%22KH%22%3A%22Khammouane%22%2C%22LM%22%3A%22Luang%20Namtha%22%2C%22LP%22%3A%22Luang%20Prabang%22%2C%22OU%22%3A%22Oudomxay%22%2C%22PH%22%3A%22Phongsaly%22%2C%22SL%22%3A%22Salavan%22%2C%22SV%22%3A%22Savannakhet%22%2C%22VI%22%3A%22Vientiane%20Province%22%2C%22VT%22%3A%22Vientiane%22%2C%22XA%22%3A%22Sainyabuli%22%2C%22XE%22%3A%22Sekong%22%2C%22XI%22%3A%22Xiangkhouang%22%2C%22XS%22%3A%22Xaisomboun%22%7D%2C%22LB%22%3A%5B%5D%2C%22LI%22%3A%5B%5D%2C%22LR%22%3A%7B%22BM%22%3A%22Bomi%22%2C%22BN%22%3A%22Bong%22%2C%22GA%22%3A%22Gbarpolu%22%2C%22GB%22%3A%22Grand%20Bassa%22%2C%22GC%22%3A%22Grand%20Cape%20Mount%22%2C%22GG%22%3A%22Grand%20Gedeh%22%2C%22GK%22%3A%22Grand%20Kru%22%2C%22LO%22%3A%22Lofa%22%2C%22MA%22%3A%22Margibi%22%2C%22MY%22%3A%22Maryland%22%2C%22MO%22%3A%22Montserrado%22%2C%22NM%22%3A%22Nimba%22%2C%22RV%22%3A%22Rivercess%22%2C%22RG%22%3A%22River%20Gee%22%2C%22SN%22%3A%22Sinoe%22%7D%2C%22LU%22%3A%5B%5D%2C%22MD%22%3A%7B%22C%22%3A%22Chi%5Cu0219in%5Cu0103u%22%2C%22BL%22%3A%22B%5Cu0103l%5Cu021bi%22%2C%22AN%22%3A%22Anenii%20Noi%22%2C%22BS%22%3A%22Basarabeasca%22%2C%22BR%22%3A%22Briceni%22%2C%22CH%22%3A%22Cahul%22%2C%22CT%22%3A%22Cantemir%22%2C%22CL%22%3A%22C%5Cu0103l%5Cu0103ra%5Cu0219i%22%2C%22CS%22%3A%22C%5Cu0103u%5Cu0219eni%22%2C%22CM%22%3A%22Cimi%5Cu0219lia%22%2C%22CR%22%3A%22Criuleni%22%2C%22DN%22%3A%22Dondu%5Cu0219eni%22%2C%22DR%22%3A%22Drochia%22%2C%22DB%22%3A%22Dub%5Cu0103sari%22%2C%22ED%22%3A%22Edine%5Cu021b%22%2C%22FL%22%3A%22F%5Cu0103le%5Cu0219ti%22%2C%22FR%22%3A%22Flore%5Cu0219ti%22%2C%22GE%22%3A%22UTA%20G%5Cu0103g%5Cu0103uzia%22%2C%22GL%22%3A%22Glodeni%22%2C%22HN%22%3A%22H%5Cu00eence%5Cu0219ti%22%2C%22IL%22%3A%22Ialoveni%22%2C%22LV%22%3A%22Leova%22%2C%22NS%22%3A%22Nisporeni%22%2C%22OC%22%3A%22Ocni%5Cu021ba%22%2C%22OR%22%3A%22Orhei%22%2C%22RZ%22%3A%22Rezina%22%2C%22RS%22%3A%22R%5Cu00ee%5Cu0219cani%22%2C%22SG%22%3A%22S%5Cu00eengerei%22%2C%22SR%22%3A%22Soroca%22%2C%22ST%22%3A%22Str%5Cu0103%5Cu0219eni%22%2C%22SD%22%3A%22%5Cu0218old%5Cu0103ne%5Cu0219ti%22%2C%22SV%22%3A%22%5Cu0218tefan%20Vod%5Cu0103%22%2C%22TR%22%3A%22Taraclia%22%2C%22TL%22%3A%22Telene%5Cu0219ti%22%2C%22UN%22%3A%22Ungheni%22%7D%2C%22MF%22%3A%5B%5D%2C%22MQ%22%3A%5B%5D%2C%22MT%22%3A%5B%5D%2C%22MX%22%3A%7B%22DF%22%3A%22Ciudad%20de%20M%5Cu00e9xico%22%2C%22JA%22%3A%22Jalisco%22%2C%22NL%22%3A%22Nuevo%20Le%5Cu00f3n%22%2C%22AG%22%3A%22Aguascalientes%22%2C%22BC%22%3A%22Baja%20California%22%2C%22BS%22%3A%22Baja%20California%20Sur%22%2C%22CM%22%3A%22Campeche%22%2C%22CS%22%3A%22Chiapas%22%2C%22CH%22%3A%22Chihuahua%22%2C%22CO%22%3A%22Coahuila%22%2C%22CL%22%3A%22Colima%22%2C%22DG%22%3A%22Durango%22%2C%22GT%22%3A%22Guanajuato%22%2C%22GR%22%3A%22Guerrero%22%2C%22HG%22%3A%22Hidalgo%22%2C%22MX%22%3A%22Estado%20de%20M%5Cu00e9xico%22%2C%22MI%22%3A%22Michoac%5Cu00e1n%22%2C%22MO%22%3A%22Morelos%22%2C%22NA%22%3A%22Nayarit%22%2C%22OA%22%3A%22Oaxaca%22%2C%22PU%22%3A%22Puebla%22%2C%22QT%22%3A%22Quer%5Cu00e9taro%22%2C%22QR%22%3A%22Quintana%20Roo%22%2C%22SL%22%3A%22San%20Luis%20Potos%5Cu00ed%22%2C%22SI%22%3A%22Sinaloa%22%2C%22SO%22%3A%22Sonora%22%2C%22TB%22%3A%22Tabasco%22%2C%22TM%22%3A%22Tamaulipas%22%2C%22TL%22%3A%22Tlaxcala%22%2C%22VE%22%3A%22Veracruz%22%2C%22YU%22%3A%22Yucat%5Cu00e1n%22%2C%22ZA%22%3A%22Zacatecas%22%7D%2C%22MY%22%3A%7B%22JHR%22%3A%22Johor%22%2C%22KDH%22%3A%22Kedah%22%2C%22KTN%22%3A%22Kelantan%22%2C%22LBN%22%3A%22Labuan%22%2C%22MLK%22%3A%22Malacca%20%28Melaka%29%22%2C%22NSN%22%3A%22Negeri%20Sembilan%22%2C%22PHG%22%3A%22Pahang%22%2C%22PNG%22%3A%22Penang%20%28Pulau%20Pinang%29%22%2C%22PRK%22%3A%22Perak%22%2C%22PLS%22%3A%22Perlis%22%2C%22SBH%22%3A%22Sabah%22%2C%22SWK%22%3A%22Sarawak%22%2C%22SGR%22%3A%22Selangor%22%2C%22TRG%22%3A%22Terengganu%22%2C%22PJY%22%3A%22Putrajaya%22%2C%22KUL%22%3A%22Kuala%20Lumpur%22%7D%2C%22MZ%22%3A%7B%22MZP%22%3A%22Cabo%20Delgado%22%2C%22MZG%22%3A%22Gaza%22%2C%22MZI%22%3A%22Inhambane%22%2C%22MZB%22%3A%22Manica%22%2C%22MZL%22%3A%22Maputo%20Province%22%2C%22MZMPM%22%3A%22Maputo%22%2C%22MZN%22%3A%22Nampula%22%2C%22MZA%22%3A%22Niassa%22%2C%22MZS%22%3A%22Sofala%22%2C%22MZT%22%3A%22Tete%22%2C%22MZQ%22%3A%22Zamb%5Cu00e9zia%22%7D%2C%22NA%22%3A%7B%22ER%22%3A%22Erongo%22%2C%22HA%22%3A%22Hardap%22%2C%22KA%22%3A%22Karas%22%2C%22KE%22%3A%22Kavango%20East%22%2C%22KW%22%3A%22Kavango%20West%22%2C%22KH%22%3A%22Khomas%22%2C%22KU%22%3A%22Kunene%22%2C%22OW%22%3A%22Ohangwena%22%2C%22OH%22%3A%22Omaheke%22%2C%22OS%22%3A%22Omusati%22%2C%22ON%22%3A%22Oshana%22%2C%22OT%22%3A%22Oshikoto%22%2C%22OD%22%3A%22Otjozondjupa%22%2C%22CA%22%3A%22Zambezi%22%7D%2C%22NG%22%3A%7B%22AB%22%3A%22Abia%22%2C%22FC%22%3A%22Abuja%22%2C%22AD%22%3A%22Adamawa%22%2C%22AK%22%3A%22Akwa%20Ibom%22%2C%22AN%22%3A%22Anambra%22%2C%22BA%22%3A%22Bauchi%22%2C%22BY%22%3A%22Bayelsa%22%2C%22BE%22%3A%22Benue%22%2C%22BO%22%3A%22Borno%22%2C%22CR%22%3A%22Cross%20River%22%2C%22DE%22%3A%22Delta%22%2C%22EB%22%3A%22Ebonyi%22%2C%22ED%22%3A%22Edo%22%2C%22EK%22%3A%22Ekiti%22%2C%22EN%22%3A%22Enugu%22%2C%22GO%22%3A%22Gombe%22%2C%22IM%22%3A%22Imo%22%2C%22JI%22%3A%22Jigawa%22%2C%22KD%22%3A%22Kaduna%22%2C%22KN%22%3A%22Kano%22%2C%22KT%22%3A%22Katsina%22%2C%22KE%22%3A%22Kebbi%22%2C%22KO%22%3A%22Kogi%22%2C%22KW%22%3A%22Kwara%22%2C%22LA%22%3A%22Lagos%22%2C%22NA%22%3A%22Nasarawa%22%2C%22NI%22%3A%22Niger%22%2C%22OG%22%3A%22Ogun%22%2C%22ON%22%3A%22Ondo%22%2C%22OS%22%3A%22Osun%22%2C%22OY%22%3A%22Oyo%22%2C%22PL%22%3A%22Plateau%22%2C%22RI%22%3A%22Rivers%22%2C%22SO%22%3A%22Sokoto%22%2C%22TA%22%3A%22Taraba%22%2C%22YO%22%3A%22Yobe%22%2C%22ZA%22%3A%22Zamfara%22%7D%2C%22NL%22%3A%5B%5D%2C%22NO%22%3A%5B%5D%2C%22NP%22%3A%7B%22BAG%22%3A%22Bagmati%22%2C%22BHE%22%3A%22Bheri%22%2C%22DHA%22%3A%22Dhaulagiri%22%2C%22GAN%22%3A%22Gandaki%22%2C%22JAN%22%3A%22Janakpur%22%2C%22KAR%22%3A%22Karnali%22%2C%22KOS%22%3A%22Koshi%22%2C%22LUM%22%3A%22Lumbini%22%2C%22MAH%22%3A%22Mahakali%22%2C%22MEC%22%3A%22Mechi%22%2C%22NAR%22%3A%22Narayani%22%2C%22RAP%22%3A%22Rapti%22%2C%22SAG%22%3A%22Sagarmatha%22%2C%22SET%22%3A%22Seti%22%7D%2C%22NI%22%3A%7B%22NI-AN%22%3A%22Atl%5Cu00e1ntico%20Norte%22%2C%22NI-AS%22%3A%22Atl%5Cu00e1ntico%20Sur%22%2C%22NI-BO%22%3A%22Boaco%22%2C%22NI-CA%22%3A%22Carazo%22%2C%22NI-CI%22%3A%22Chinandega%22%2C%22NI-CO%22%3A%22Chontales%22%2C%22NI-ES%22%3A%22Estel%5Cu00ed%22%2C%22NI-GR%22%3A%22Granada%22%2C%22NI-JI%22%3A%22Jinotega%22%2C%22NI-LE%22%3A%22Le%5Cu00f3n%22%2C%22NI-MD%22%3A%22Madriz%22%2C%22NI-MN%22%3A%22Managua%22%2C%22NI-MS%22%3A%22Masaya%22%2C%22NI-MT%22%3A%22Matagalpa%22%2C%22NI-NS%22%3A%22Nueva%20Segovia%22%2C%22NI-RI%22%3A%22Rivas%22%2C%22NI-SJ%22%3A%22R%5Cu00edo%20San%20Juan%22%7D%2C%22NZ%22%3A%7B%22NTL%22%3A%22Northland%22%2C%22AUK%22%3A%22Auckland%22%2C%22WKO%22%3A%22Waikato%22%2C%22BOP%22%3A%22Bay%20of%20Plenty%22%2C%22TKI%22%3A%22Taranaki%22%2C%22GIS%22%3A%22Gisborne%22%2C%22HKB%22%3A%22Hawke%5Cu2019s%20Bay%22%2C%22MWT%22%3A%22Manawatu-Wanganui%22%2C%22WGN%22%3A%22Wellington%22%2C%22NSN%22%3A%22Nelson%22%2C%22MBH%22%3A%22Marlborough%22%2C%22TAS%22%3A%22Tasman%22%2C%22WTC%22%3A%22West%20Coast%22%2C%22CAN%22%3A%22Canterbury%22%2C%22OTA%22%3A%22Otago%22%2C%22STL%22%3A%22Southland%22%7D%2C%22PA%22%3A%7B%22PA-1%22%3A%22Bocas%20del%20Toro%22%2C%22PA-2%22%3A%22Cocl%5Cu00e9%22%2C%22PA-3%22%3A%22Col%5Cu00f3n%22%2C%22PA-4%22%3A%22Chiriqu%5Cu00ed%22%2C%22PA-5%22%3A%22Dari%5Cu00e9n%22%2C%22PA-6%22%3A%22Herrera%22%2C%22PA-7%22%3A%22Los%20Santos%22%2C%22PA-8%22%3A%22Panam%5Cu00e1%22%2C%22PA-9%22%3A%22Veraguas%22%2C%22PA-10%22%3A%22West%20Panam%5Cu00e1%22%2C%22PA-EM%22%3A%22Ember%5Cu00e1%22%2C%22PA-KY%22%3A%22Guna%20Yala%22%2C%22PA-NB%22%3A%22Ng%5Cu00f6be-Bugl%5Cu00e9%22%7D%2C%22PE%22%3A%7B%22CAL%22%3A%22El%20Callao%22%2C%22LMA%22%3A%22Municipalidad%20Metropolitana%20de%20Lima%22%2C%22AMA%22%3A%22Amazonas%22%2C%22ANC%22%3A%22Ancash%22%2C%22APU%22%3A%22Apur%5Cu00edmac%22%2C%22ARE%22%3A%22Arequipa%22%2C%22AYA%22%3A%22Ayacucho%22%2C%22CAJ%22%3A%22Cajamarca%22%2C%22CUS%22%3A%22Cusco%22%2C%22HUV%22%3A%22Huancavelica%22%2C%22HUC%22%3A%22Hu%5Cu00e1nuco%22%2C%22ICA%22%3A%22Ica%22%2C%22JUN%22%3A%22Jun%5Cu00edn%22%2C%22LAL%22%3A%22La%20Libertad%22%2C%22LAM%22%3A%22Lambayeque%22%2C%22LIM%22%3A%22Lima%22%2C%22LOR%22%3A%22Loreto%22%2C%22MDD%22%3A%22Madre%20de%20Dios%22%2C%22MOQ%22%3A%22Moquegua%22%2C%22PAS%22%3A%22Pasco%22%2C%22PIU%22%3A%22Piura%22%2C%22PUN%22%3A%22Puno%22%2C%22SAM%22%3A%22San%20Mart%5Cu00edn%22%2C%22TAC%22%3A%22Tacna%22%2C%22TUM%22%3A%22Tumbes%22%2C%22UCA%22%3A%22Ucayali%22%7D%2C%22PH%22%3A%7B%22ABR%22%3A%22Abra%22%2C%22AGN%22%3A%22Agusan%20del%20Norte%22%2C%22AGS%22%3A%22Agusan%20del%20Sur%22%2C%22AKL%22%3A%22Aklan%22%2C%22ALB%22%3A%22Albay%22%2C%22ANT%22%3A%22Antique%22%2C%22APA%22%3A%22Apayao%22%2C%22AUR%22%3A%22Aurora%22%2C%22BAS%22%3A%22Basilan%22%2C%22BAN%22%3A%22Bataan%22%2C%22BTN%22%3A%22Batanes%22%2C%22BTG%22%3A%22Batangas%22%2C%22BEN%22%3A%22Benguet%22%2C%22BIL%22%3A%22Biliran%22%2C%22BOH%22%3A%22Bohol%22%2C%22BUK%22%3A%22Bukidnon%22%2C%22BUL%22%3A%22Bulacan%22%2C%22CAG%22%3A%22Cagayan%22%2C%22CAN%22%3A%22Camarines%20Norte%22%2C%22CAS%22%3A%22Camarines%20Sur%22%2C%22CAM%22%3A%22Camiguin%22%2C%22CAP%22%3A%22Capiz%22%2C%22CAT%22%3A%22Catanduanes%22%2C%22CAV%22%3A%22Cavite%22%2C%22CEB%22%3A%22Cebu%22%2C%22COM%22%3A%22Compostela%20Valley%22%2C%22NCO%22%3A%22Cotabato%22%2C%22DAV%22%3A%22Davao%20del%20Norte%22%2C%22DAS%22%3A%22Davao%20del%20Sur%22%2C%22DAC%22%3A%22Davao%20Occidental%22%2C%22DAO%22%3A%22Davao%20Oriental%22%2C%22DIN%22%3A%22Dinagat%20Islands%22%2C%22EAS%22%3A%22Eastern%20Samar%22%2C%22GUI%22%3A%22Guimaras%22%2C%22IFU%22%3A%22Ifugao%22%2C%22ILN%22%3A%22Ilocos%20Norte%22%2C%22ILS%22%3A%22Ilocos%20Sur%22%2C%22ILI%22%3A%22Iloilo%22%2C%22ISA%22%3A%22Isabela%22%2C%22KAL%22%3A%22Kalinga%22%2C%22LUN%22%3A%22La%20Union%22%2C%22LAG%22%3A%22Laguna%22%2C%22LAN%22%3A%22Lanao%20del%20Norte%22%2C%22LAS%22%3A%22Lanao%20del%20Sur%22%2C%22LEY%22%3A%22Leyte%22%2C%22MAG%22%3A%22Maguindanao%22%2C%22MAD%22%3A%22Marinduque%22%2C%22MAS%22%3A%22Masbate%22%2C%22MSC%22%3A%22Misamis%20Occidental%22%2C%22MSR%22%3A%22Misamis%20Oriental%22%2C%22MOU%22%3A%22Mountain%20Province%22%2C%22NEC%22%3A%22Negros%20Occidental%22%2C%22NER%22%3A%22Negros%20Oriental%22%2C%22NSA%22%3A%22Northern%20Samar%22%2C%22NUE%22%3A%22Nueva%20Ecija%22%2C%22NUV%22%3A%22Nueva%20Vizcaya%22%2C%22MDC%22%3A%22Occidental%20Mindoro%22%2C%22MDR%22%3A%22Oriental%20Mindoro%22%2C%22PLW%22%3A%22Palawan%22%2C%22PAM%22%3A%22Pampanga%22%2C%22PAN%22%3A%22Pangasinan%22%2C%22QUE%22%3A%22Quezon%22%2C%22QUI%22%3A%22Quirino%22%2C%22RIZ%22%3A%22Rizal%22%2C%22ROM%22%3A%22Romblon%22%2C%22WSA%22%3A%22Samar%22%2C%22SAR%22%3A%22Sarangani%22%2C%22SIQ%22%3A%22Siquijor%22%2C%22SOR%22%3A%22Sorsogon%22%2C%22SCO%22%3A%22South%20Cotabato%22%2C%22SLE%22%3A%22Southern%20Leyte%22%2C%22SUK%22%3A%22Sultan%20Kudarat%22%2C%22SLU%22%3A%22Sulu%22%2C%22SUN%22%3A%22Surigao%20del%20Norte%22%2C%22SUR%22%3A%22Surigao%20del%20Sur%22%2C%22TAR%22%3A%22Tarlac%22%2C%22TAW%22%3A%22Tawi-Tawi%22%2C%22ZMB%22%3A%22Zambales%22%2C%22ZAN%22%3A%22Zamboanga%20del%20Norte%22%2C%22ZAS%22%3A%22Zamboanga%20del%20Sur%22%2C%22ZSI%22%3A%22Zamboanga%20Sibugay%22%2C%2200%22%3A%22Metro%20Manila%22%7D%2C%22PK%22%3A%7B%22JK%22%3A%22Azad%20Kashmir%22%2C%22BA%22%3A%22Balochistan%22%2C%22TA%22%3A%22FATA%22%2C%22GB%22%3A%22Gilgit%20Baltistan%22%2C%22IS%22%3A%22Islamabad%20Capital%20Territory%22%2C%22KP%22%3A%22Khyber%20Pakhtunkhwa%22%2C%22PB%22%3A%22Punjab%22%2C%22SD%22%3A%22Sindh%22%7D%2C%22PL%22%3A%5B%5D%2C%22PR%22%3A%5B%5D%2C%22PT%22%3A%5B%5D%2C%22PY%22%3A%7B%22PY-ASU%22%3A%22Asunci%5Cu00f3n%22%2C%22PY-1%22%3A%22Concepci%5Cu00f3n%22%2C%22PY-2%22%3A%22San%20Pedro%22%2C%22PY-3%22%3A%22Cordillera%22%2C%22PY-4%22%3A%22Guair%5Cu00e1%22%2C%22PY-5%22%3A%22Caaguaz%5Cu00fa%22%2C%22PY-6%22%3A%22Caazap%5Cu00e1%22%2C%22PY-7%22%3A%22Itap%5Cu00faa%22%2C%22PY-8%22%3A%22Misiones%22%2C%22PY-9%22%3A%22Paraguar%5Cu00ed%22%2C%22PY-10%22%3A%22Alto%20Paran%5Cu00e1%22%2C%22PY-11%22%3A%22Central%22%2C%22PY-12%22%3A%22%5Cu00d1eembuc%5Cu00fa%22%2C%22PY-13%22%3A%22Amambay%22%2C%22PY-14%22%3A%22Canindey%5Cu00fa%22%2C%22PY-15%22%3A%22Presidente%20Hayes%22%2C%22PY-16%22%3A%22Alto%20Paraguay%22%2C%22PY-17%22%3A%22Boquer%5Cu00f3n%22%7D%2C%22RE%22%3A%5B%5D%2C%22RO%22%3A%7B%22AB%22%3A%22Alba%22%2C%22AR%22%3A%22Arad%22%2C%22AG%22%3A%22Arge%5Cu0219%22%2C%22BC%22%3A%22Bac%5Cu0103u%22%2C%22BH%22%3A%22Bihor%22%2C%22BN%22%3A%22Bistri%5Cu021ba-N%5Cu0103s%5Cu0103ud%22%2C%22BT%22%3A%22Boto%5Cu0219ani%22%2C%22BR%22%3A%22Br%5Cu0103ila%22%2C%22BV%22%3A%22Bra%5Cu0219ov%22%2C%22B%22%3A%22Bucure%5Cu0219ti%22%2C%22BZ%22%3A%22Buz%5Cu0103u%22%2C%22CL%22%3A%22C%5Cu0103l%5Cu0103ra%5Cu0219i%22%2C%22CS%22%3A%22Cara%5Cu0219-Severin%22%2C%22CJ%22%3A%22Cluj%22%2C%22CT%22%3A%22Constan%5Cu021ba%22%2C%22CV%22%3A%22Covasna%22%2C%22DB%22%3A%22D%5Cu00e2mbovi%5Cu021ba%22%2C%22DJ%22%3A%22Dolj%22%2C%22GL%22%3A%22Gala%5Cu021bi%22%2C%22GR%22%3A%22Giurgiu%22%2C%22GJ%22%3A%22Gorj%22%2C%22HR%22%3A%22Harghita%22%2C%22HD%22%3A%22Hunedoara%22%2C%22IL%22%3A%22Ialomi%5Cu021ba%22%2C%22IS%22%3A%22Ia%5Cu0219i%22%2C%22IF%22%3A%22Ilfov%22%2C%22MM%22%3A%22Maramure%5Cu0219%22%2C%22MH%22%3A%22Mehedin%5Cu021bi%22%2C%22MS%22%3A%22Mure%5Cu0219%22%2C%22NT%22%3A%22Neam%5Cu021b%22%2C%22OT%22%3A%22Olt%22%2C%22PH%22%3A%22Prahova%22%2C%22SJ%22%3A%22S%5Cu0103laj%22%2C%22SM%22%3A%22Satu%20Mare%22%2C%22SB%22%3A%22Sibiu%22%2C%22SV%22%3A%22Suceava%22%2C%22TR%22%3A%22Teleorman%22%2C%22TM%22%3A%22Timi%5Cu0219%22%2C%22TL%22%3A%22Tulcea%22%2C%22VL%22%3A%22V%5Cu00e2lcea%22%2C%22VS%22%3A%22Vaslui%22%2C%22VN%22%3A%22Vrancea%22%7D%2C%22SN%22%3A%7B%22SNDB%22%3A%22Diourbel%22%2C%22SNDK%22%3A%22Dakar%22%2C%22SNFK%22%3A%22Fatick%22%2C%22SNKA%22%3A%22Kaffrine%22%2C%22SNKD%22%3A%22Kolda%22%2C%22SNKE%22%3A%22K%5Cu00e9dougou%22%2C%22SNKL%22%3A%22Kaolack%22%2C%22SNLG%22%3A%22Louga%22%2C%22SNMT%22%3A%22Matam%22%2C%22SNSE%22%3A%22S%5Cu00e9dhiou%22%2C%22SNSL%22%3A%22Saint-Louis%22%2C%22SNTC%22%3A%22Tambacounda%22%2C%22SNTH%22%3A%22Thi%5Cu00e8s%22%2C%22SNZG%22%3A%22Ziguinchor%22%7D%2C%22SG%22%3A%5B%5D%2C%22SK%22%3A%5B%5D%2C%22SI%22%3A%5B%5D%2C%22SV%22%3A%7B%22SV-AH%22%3A%22Ahuachap%5Cu00e1n%22%2C%22SV-CA%22%3A%22Caba%5Cu00f1as%22%2C%22SV-CH%22%3A%22Chalatenango%22%2C%22SV-CU%22%3A%22Cuscatl%5Cu00e1n%22%2C%22SV-LI%22%3A%22La%20Libertad%22%2C%22SV-MO%22%3A%22Moraz%5Cu00e1n%22%2C%22SV-PA%22%3A%22La%20Paz%22%2C%22SV-SA%22%3A%22Santa%20Ana%22%2C%22SV-SM%22%3A%22San%20Miguel%22%2C%22SV-SO%22%3A%22Sonsonate%22%2C%22SV-SS%22%3A%22San%20Salvador%22%2C%22SV-SV%22%3A%22San%20Vicente%22%2C%22SV-UN%22%3A%22La%20Uni%5Cu00f3n%22%2C%22SV-US%22%3A%22Usulut%5Cu00e1n%22%7D%2C%22TH%22%3A%7B%22TH-37%22%3A%22Amnat%20Charoen%22%2C%22TH-15%22%3A%22Ang%20Thong%22%2C%22TH-14%22%3A%22Ayutthaya%22%2C%22TH-10%22%3A%22Bangkok%22%2C%22TH-38%22%3A%22Bueng%20Kan%22%2C%22TH-31%22%3A%22Buri%20Ram%22%2C%22TH-24%22%3A%22Chachoengsao%22%2C%22TH-18%22%3A%22Chai%20Nat%22%2C%22TH-36%22%3A%22Chaiyaphum%22%2C%22TH-22%22%3A%22Chanthaburi%22%2C%22TH-50%22%3A%22Chiang%20Mai%22%2C%22TH-57%22%3A%22Chiang%20Rai%22%2C%22TH-20%22%3A%22Chonburi%22%2C%22TH-86%22%3A%22Chumphon%22%2C%22TH-46%22%3A%22Kalasin%22%2C%22TH-62%22%3A%22Kamphaeng%20Phet%22%2C%22TH-71%22%3A%22Kanchanaburi%22%2C%22TH-40%22%3A%22Khon%20Kaen%22%2C%22TH-81%22%3A%22Krabi%22%2C%22TH-52%22%3A%22Lampang%22%2C%22TH-51%22%3A%22Lamphun%22%2C%22TH-42%22%3A%22Loei%22%2C%22TH-16%22%3A%22Lopburi%22%2C%22TH-58%22%3A%22Mae%20Hong%20Son%22%2C%22TH-44%22%3A%22Maha%20Sarakham%22%2C%22TH-49%22%3A%22Mukdahan%22%2C%22TH-26%22%3A%22Nakhon%20Nayok%22%2C%22TH-73%22%3A%22Nakhon%20Pathom%22%2C%22TH-48%22%3A%22Nakhon%20Phanom%22%2C%22TH-30%22%3A%22Nakhon%20Ratchasima%22%2C%22TH-60%22%3A%22Nakhon%20Sawan%22%2C%22TH-80%22%3A%22Nakhon%20Si%20Thammarat%22%2C%22TH-55%22%3A%22Nan%22%2C%22TH-96%22%3A%22Narathiwat%22%2C%22TH-39%22%3A%22Nong%20Bua%20Lam%20Phu%22%2C%22TH-43%22%3A%22Nong%20Khai%22%2C%22TH-12%22%3A%22Nonthaburi%22%2C%22TH-13%22%3A%22Pathum%20Thani%22%2C%22TH-94%22%3A%22Pattani%22%2C%22TH-82%22%3A%22Phang%20Nga%22%2C%22TH-93%22%3A%22Phatthalung%22%2C%22TH-56%22%3A%22Phayao%22%2C%22TH-67%22%3A%22Phetchabun%22%2C%22TH-76%22%3A%22Phetchaburi%22%2C%22TH-66%22%3A%22Phichit%22%2C%22TH-65%22%3A%22Phitsanulok%22%2C%22TH-54%22%3A%22Phrae%22%2C%22TH-83%22%3A%22Phuket%22%2C%22TH-25%22%3A%22Prachin%20Buri%22%2C%22TH-77%22%3A%22Prachuap%20Khiri%20Khan%22%2C%22TH-85%22%3A%22Ranong%22%2C%22TH-70%22%3A%22Ratchaburi%22%2C%22TH-21%22%3A%22Rayong%22%2C%22TH-45%22%3A%22Roi%20Et%22%2C%22TH-27%22%3A%22Sa%20Kaeo%22%2C%22TH-47%22%3A%22Sakon%20Nakhon%22%2C%22TH-11%22%3A%22Samut%20Prakan%22%2C%22TH-74%22%3A%22Samut%20Sakhon%22%2C%22TH-75%22%3A%22Samut%20Songkhram%22%2C%22TH-19%22%3A%22Saraburi%22%2C%22TH-91%22%3A%22Satun%22%2C%22TH-17%22%3A%22Sing%20Buri%22%2C%22TH-33%22%3A%22Sisaket%22%2C%22TH-90%22%3A%22Songkhla%22%2C%22TH-64%22%3A%22Sukhothai%22%2C%22TH-72%22%3A%22Suphan%20Buri%22%2C%22TH-84%22%3A%22Surat%20Thani%22%2C%22TH-32%22%3A%22Surin%22%2C%22TH-63%22%3A%22Tak%22%2C%22TH-92%22%3A%22Trang%22%2C%22TH-23%22%3A%22Trat%22%2C%22TH-34%22%3A%22Ubon%20Ratchathani%22%2C%22TH-41%22%3A%22Udon%20Thani%22%2C%22TH-61%22%3A%22Uthai%20Thani%22%2C%22TH-53%22%3A%22Uttaradit%22%2C%22TH-95%22%3A%22Yala%22%2C%22TH-35%22%3A%22Yasothon%22%7D%2C%22TR%22%3A%7B%22TR01%22%3A%22Adana%22%2C%22TR02%22%3A%22Ad%5Cu0131yaman%22%2C%22TR03%22%3A%22Afyon%22%2C%22TR04%22%3A%22A%5Cu011fr%5Cu0131%22%2C%22TR05%22%3A%22Amasya%22%2C%22TR06%22%3A%22Ankara%22%2C%22TR07%22%3A%22Antalya%22%2C%22TR08%22%3A%22Artvin%22%2C%22TR09%22%3A%22Ayd%5Cu0131n%22%2C%22TR10%22%3A%22Bal%5Cu0131kesir%22%2C%22TR11%22%3A%22Bilecik%22%2C%22TR12%22%3A%22Bing%5Cu00f6l%22%2C%22TR13%22%3A%22Bitlis%22%2C%22TR14%22%3A%22Bolu%22%2C%22TR15%22%3A%22Burdur%22%2C%22TR16%22%3A%22Bursa%22%2C%22TR17%22%3A%22%5Cu00c7anakkale%22%2C%22TR18%22%3A%22%5Cu00c7ank%5Cu0131r%5Cu0131%22%2C%22TR19%22%3A%22%5Cu00c7orum%22%2C%22TR20%22%3A%22Denizli%22%2C%22TR21%22%3A%22Diyarbak%5Cu0131r%22%2C%22TR22%22%3A%22Edirne%22%2C%22TR23%22%3A%22Elaz%5Cu0131%5Cu011f%22%2C%22TR24%22%3A%22Erzincan%22%2C%22TR25%22%3A%22Erzurum%22%2C%22TR26%22%3A%22Eski%5Cu015fehir%22%2C%22TR27%22%3A%22Gaziantep%22%2C%22TR28%22%3A%22Giresun%22%2C%22TR29%22%3A%22G%5Cu00fcm%5Cu00fc%5Cu015fhane%22%2C%22TR30%22%3A%22Hakkari%22%2C%22TR31%22%3A%22Hatay%22%2C%22TR32%22%3A%22Isparta%22%2C%22TR33%22%3A%22%5Cu0130%5Cu00e7el%22%2C%22TR34%22%3A%22%5Cu0130stanbul%22%2C%22TR35%22%3A%22%5Cu0130zmir%22%2C%22TR36%22%3A%22Kars%22%2C%22TR37%22%3A%22Kastamonu%22%2C%22TR38%22%3A%22Kayseri%22%2C%22TR39%22%3A%22K%5Cu0131rklareli%22%2C%22TR40%22%3A%22K%5Cu0131r%5Cu015fehir%22%2C%22TR41%22%3A%22Kocaeli%22%2C%22TR42%22%3A%22Konya%22%2C%22TR43%22%3A%22K%5Cu00fctahya%22%2C%22TR44%22%3A%22Malatya%22%2C%22TR45%22%3A%22Manisa%22%2C%22TR46%22%3A%22Kahramanmara%5Cu015f%22%2C%22TR47%22%3A%22Mardin%22%2C%22TR48%22%3A%22Mu%5Cu011fla%22%2C%22TR49%22%3A%22Mu%5Cu015f%22%2C%22TR50%22%3A%22Nev%5Cu015fehir%22%2C%22TR51%22%3A%22Ni%5Cu011fde%22%2C%22TR52%22%3A%22Ordu%22%2C%22TR53%22%3A%22Rize%22%2C%22TR54%22%3A%22Sakarya%22%2C%22TR55%22%3A%22Samsun%22%2C%22TR56%22%3A%22Siirt%22%2C%22TR57%22%3A%22Sinop%22%2C%22TR58%22%3A%22Sivas%22%2C%22TR59%22%3A%22Tekirda%5Cu011f%22%2C%22TR60%22%3A%22Tokat%22%2C%22TR61%22%3A%22Trabzon%22%2C%22TR62%22%3A%22Tunceli%22%2C%22TR63%22%3A%22%5Cu015eanl%5Cu0131urfa%22%2C%22TR64%22%3A%22U%5Cu015fak%22%2C%22TR65%22%3A%22Van%22%2C%22TR66%22%3A%22Yozgat%22%2C%22TR67%22%3A%22Zonguldak%22%2C%22TR68%22%3A%22Aksaray%22%2C%22TR69%22%3A%22Bayburt%22%2C%22TR70%22%3A%22Karaman%22%2C%22TR71%22%3A%22K%5Cu0131r%5Cu0131kkale%22%2C%22TR72%22%3A%22Batman%22%2C%22TR73%22%3A%22%5Cu015e%5Cu0131rnak%22%2C%22TR74%22%3A%22Bart%5Cu0131n%22%2C%22TR75%22%3A%22Ardahan%22%2C%22TR76%22%3A%22I%5Cu011fd%5Cu0131r%22%2C%22TR77%22%3A%22Yalova%22%2C%22TR78%22%3A%22Karab%5Cu00fck%22%2C%22TR79%22%3A%22Kilis%22%2C%22TR80%22%3A%22Osmaniye%22%2C%22TR81%22%3A%22D%5Cu00fczce%22%7D%2C%22TZ%22%3A%7B%22TZ01%22%3A%22Arusha%22%2C%22TZ02%22%3A%22Dar%20es%20Salaam%22%2C%22TZ03%22%3A%22Dodoma%22%2C%22TZ04%22%3A%22Iringa%22%2C%22TZ05%22%3A%22Kagera%22%2C%22TZ06%22%3A%22Pemba%20North%22%2C%22TZ07%22%3A%22Zanzibar%20North%22%2C%22TZ08%22%3A%22Kigoma%22%2C%22TZ09%22%3A%22Kilimanjaro%22%2C%22TZ10%22%3A%22Pemba%20South%22%2C%22TZ11%22%3A%22Zanzibar%20South%22%2C%22TZ12%22%3A%22Lindi%22%2C%22TZ13%22%3A%22Mara%22%2C%22TZ14%22%3A%22Mbeya%22%2C%22TZ15%22%3A%22Zanzibar%20West%22%2C%22TZ16%22%3A%22Morogoro%22%2C%22TZ17%22%3A%22Mtwara%22%2C%22TZ18%22%3A%22Mwanza%22%2C%22TZ19%22%3A%22Coast%22%2C%22TZ20%22%3A%22Rukwa%22%2C%22TZ21%22%3A%22Ruvuma%22%2C%22TZ22%22%3A%22Shinyanga%22%2C%22TZ23%22%3A%22Singida%22%2C%22TZ24%22%3A%22Tabora%22%2C%22TZ25%22%3A%22Tanga%22%2C%22TZ26%22%3A%22Manyara%22%2C%22TZ27%22%3A%22Geita%22%2C%22TZ28%22%3A%22Katavi%22%2C%22TZ29%22%3A%22Njombe%22%2C%22TZ30%22%3A%22Simiyu%22%7D%2C%22LK%22%3A%5B%5D%2C%22RS%22%3A%7B%22RS00%22%3A%22Belgrade%22%2C%22RS14%22%3A%22Bor%22%2C%22RS11%22%3A%22Brani%5Cu010devo%22%2C%22RS02%22%3A%22Central%20Banat%22%2C%22RS10%22%3A%22Danube%22%2C%22RS23%22%3A%22Jablanica%22%2C%22RS09%22%3A%22Kolubara%22%2C%22RS08%22%3A%22Ma%5Cu010dva%22%2C%22RS17%22%3A%22Morava%22%2C%22RS20%22%3A%22Ni%5Cu0161ava%22%2C%22RS01%22%3A%22North%20Ba%5Cu010dka%22%2C%22RS03%22%3A%22North%20Banat%22%2C%22RS24%22%3A%22P%5Cu010dinja%22%2C%22RS22%22%3A%22Pirot%22%2C%22RS13%22%3A%22Pomoravlje%22%2C%22RS19%22%3A%22Rasina%22%2C%22RS18%22%3A%22Ra%5Cu0161ka%22%2C%22RS06%22%3A%22South%20Ba%5Cu010dka%22%2C%22RS04%22%3A%22South%20Banat%22%2C%22RS07%22%3A%22Srem%22%2C%22RS12%22%3A%22%5Cu0160umadija%22%2C%22RS21%22%3A%22Toplica%22%2C%22RS05%22%3A%22West%20Ba%5Cu010dka%22%2C%22RS15%22%3A%22Zaje%5Cu010dar%22%2C%22RS16%22%3A%22Zlatibor%22%2C%22RS25%22%3A%22Kosovo%22%2C%22RS26%22%3A%22Pe%5Cu0107%22%2C%22RS27%22%3A%22Prizren%22%2C%22RS28%22%3A%22Kosovska%20Mitrovica%22%2C%22RS29%22%3A%22Kosovo-Pomoravlje%22%2C%22RSKM%22%3A%22Kosovo-Metohija%22%2C%22RSVO%22%3A%22Vojvodina%22%7D%2C%22RW%22%3A%5B%5D%2C%22SE%22%3A%5B%5D%2C%22UA%22%3A%7B%22UA05%22%3A%22Vinnychchyna%22%2C%22UA07%22%3A%22Volyn%22%2C%22UA09%22%3A%22Luhanshchyna%22%2C%22UA12%22%3A%22Dnipropetrovshchyna%22%2C%22UA14%22%3A%22Donechchyna%22%2C%22UA18%22%3A%22Zhytomyrshchyna%22%2C%22UA21%22%3A%22Zakarpattia%22%2C%22UA23%22%3A%22Zaporizhzhya%22%2C%22UA26%22%3A%22Prykarpattia%22%2C%22UA30%22%3A%22Kyiv%22%2C%22UA32%22%3A%22Kyivshchyna%22%2C%22UA35%22%3A%22Kirovohradschyna%22%2C%22UA40%22%3A%22Sevastopol%22%2C%22UA43%22%3A%22Crimea%22%2C%22UA46%22%3A%22Lvivshchyna%22%2C%22UA48%22%3A%22Mykolayivschyna%22%2C%22UA51%22%3A%22Odeshchyna%22%2C%22UA53%22%3A%22Poltavshchyna%22%2C%22UA56%22%3A%22Rivnenshchyna%22%2C%22UA59%22%3A%22Sumshchyna%22%2C%22UA61%22%3A%22Ternopilshchyna%22%2C%22UA63%22%3A%22Kharkivshchyna%22%2C%22UA65%22%3A%22Khersonshchyna%22%2C%22UA68%22%3A%22Khmelnychchyna%22%2C%22UA71%22%3A%22Cherkashchyna%22%2C%22UA74%22%3A%22Chernihivshchyna%22%2C%22UA77%22%3A%22Chernivtsi%20Oblast%22%7D%2C%22UG%22%3A%7B%22UG314%22%3A%22Abim%22%2C%22UG301%22%3A%22Adjumani%22%2C%22UG322%22%3A%22Agago%22%2C%22UG323%22%3A%22Alebtong%22%2C%22UG315%22%3A%22Amolatar%22%2C%22UG324%22%3A%22Amudat%22%2C%22UG216%22%3A%22Amuria%22%2C%22UG316%22%3A%22Amuru%22%2C%22UG302%22%3A%22Apac%22%2C%22UG303%22%3A%22Arua%22%2C%22UG217%22%3A%22Budaka%22%2C%22UG218%22%3A%22Bududa%22%2C%22UG201%22%3A%22Bugiri%22%2C%22UG235%22%3A%22Bugweri%22%2C%22UG420%22%3A%22Buhweju%22%2C%22UG117%22%3A%22Buikwe%22%2C%22UG219%22%3A%22Bukedea%22%2C%22UG118%22%3A%22Bukomansimbi%22%2C%22UG220%22%3A%22Bukwa%22%2C%22UG225%22%3A%22Bulambuli%22%2C%22UG416%22%3A%22Buliisa%22%2C%22UG401%22%3A%22Bundibugyo%22%2C%22UG430%22%3A%22Bunyangabu%22%2C%22UG402%22%3A%22Bushenyi%22%2C%22UG202%22%3A%22Busia%22%2C%22UG221%22%3A%22Butaleja%22%2C%22UG119%22%3A%22Butambala%22%2C%22UG233%22%3A%22Butebo%22%2C%22UG120%22%3A%22Buvuma%22%2C%22UG226%22%3A%22Buyende%22%2C%22UG317%22%3A%22Dokolo%22%2C%22UG121%22%3A%22Gomba%22%2C%22UG304%22%3A%22Gulu%22%2C%22UG403%22%3A%22Hoima%22%2C%22UG417%22%3A%22Ibanda%22%2C%22UG203%22%3A%22Iganga%22%2C%22UG418%22%3A%22Isingiro%22%2C%22UG204%22%3A%22Jinja%22%2C%22UG318%22%3A%22Kaabong%22%2C%22UG404%22%3A%22Kabale%22%2C%22UG405%22%3A%22Kabarole%22%2C%22UG213%22%3A%22Kaberamaido%22%2C%22UG427%22%3A%22Kagadi%22%2C%22UG428%22%3A%22Kakumiro%22%2C%22UG101%22%3A%22Kalangala%22%2C%22UG222%22%3A%22Kaliro%22%2C%22UG122%22%3A%22Kalungu%22%2C%22UG102%22%3A%22Kampala%22%2C%22UG205%22%3A%22Kamuli%22%2C%22UG413%22%3A%22Kamwenge%22%2C%22UG414%22%3A%22Kanungu%22%2C%22UG206%22%3A%22Kapchorwa%22%2C%22UG236%22%3A%22Kapelebyong%22%2C%22UG126%22%3A%22Kasanda%22%2C%22UG406%22%3A%22Kasese%22%2C%22UG207%22%3A%22Katakwi%22%2C%22UG112%22%3A%22Kayunga%22%2C%22UG407%22%3A%22Kibaale%22%2C%22UG103%22%3A%22Kiboga%22%2C%22UG227%22%3A%22Kibuku%22%2C%22UG432%22%3A%22Kikuube%22%2C%22UG419%22%3A%22Kiruhura%22%2C%22UG421%22%3A%22Kiryandongo%22%2C%22UG408%22%3A%22Kisoro%22%2C%22UG305%22%3A%22Kitgum%22%2C%22UG319%22%3A%22Koboko%22%2C%22UG325%22%3A%22Kole%22%2C%22UG306%22%3A%22Kotido%22%2C%22UG208%22%3A%22Kumi%22%2C%22UG333%22%3A%22Kwania%22%2C%22UG228%22%3A%22Kween%22%2C%22UG123%22%3A%22Kyankwanzi%22%2C%22UG422%22%3A%22Kyegegwa%22%2C%22UG415%22%3A%22Kyenjojo%22%2C%22UG125%22%3A%22Kyotera%22%2C%22UG326%22%3A%22Lamwo%22%2C%22UG307%22%3A%22Lira%22%2C%22UG229%22%3A%22Luuka%22%2C%22UG104%22%3A%22Luwero%22%2C%22UG124%22%3A%22Lwengo%22%2C%22UG114%22%3A%22Lyantonde%22%2C%22UG223%22%3A%22Manafwa%22%2C%22UG320%22%3A%22Maracha%22%2C%22UG105%22%3A%22Masaka%22%2C%22UG409%22%3A%22Masindi%22%2C%22UG214%22%3A%22Mayuge%22%2C%22UG209%22%3A%22Mbale%22%2C%22UG410%22%3A%22Mbarara%22%2C%22UG423%22%3A%22Mitooma%22%2C%22UG115%22%3A%22Mityana%22%2C%22UG308%22%3A%22Moroto%22%2C%22UG309%22%3A%22Moyo%22%2C%22UG106%22%3A%22Mpigi%22%2C%22UG107%22%3A%22Mubende%22%2C%22UG108%22%3A%22Mukono%22%2C%22UG334%22%3A%22Nabilatuk%22%2C%22UG311%22%3A%22Nakapiripirit%22%2C%22UG116%22%3A%22Nakaseke%22%2C%22UG109%22%3A%22Nakasongola%22%2C%22UG230%22%3A%22Namayingo%22%2C%22UG234%22%3A%22Namisindwa%22%2C%22UG224%22%3A%22Namutumba%22%2C%22UG327%22%3A%22Napak%22%2C%22UG310%22%3A%22Nebbi%22%2C%22UG231%22%3A%22Ngora%22%2C%22UG424%22%3A%22Ntoroko%22%2C%22UG411%22%3A%22Ntungamo%22%2C%22UG328%22%3A%22Nwoya%22%2C%22UG331%22%3A%22Omoro%22%2C%22UG329%22%3A%22Otuke%22%2C%22UG321%22%3A%22Oyam%22%2C%22UG312%22%3A%22Pader%22%2C%22UG332%22%3A%22Pakwach%22%2C%22UG210%22%3A%22Pallisa%22%2C%22UG110%22%3A%22Rakai%22%2C%22UG429%22%3A%22Rubanda%22%2C%22UG425%22%3A%22Rubirizi%22%2C%22UG431%22%3A%22Rukiga%22%2C%22UG412%22%3A%22Rukungiri%22%2C%22UG111%22%3A%22Sembabule%22%2C%22UG232%22%3A%22Serere%22%2C%22UG426%22%3A%22Sheema%22%2C%22UG215%22%3A%22Sironko%22%2C%22UG211%22%3A%22Soroti%22%2C%22UG212%22%3A%22Tororo%22%2C%22UG113%22%3A%22Wakiso%22%2C%22UG313%22%3A%22Yumbe%22%2C%22UG330%22%3A%22Zombo%22%7D%2C%22UM%22%3A%7B%2281%22%3A%22Baker%20Island%22%2C%2284%22%3A%22Howland%20Island%22%2C%2286%22%3A%22Jarvis%20Island%22%2C%2267%22%3A%22Johnston%20Atoll%22%2C%2289%22%3A%22Kingman%20Reef%22%2C%2271%22%3A%22Midway%20Atoll%22%2C%2276%22%3A%22Navassa%20Island%22%2C%2295%22%3A%22Palmyra%20Atoll%22%2C%2279%22%3A%22Wake%20Island%22%7D%2C%22US%22%3A%7B%22AL%22%3A%22Alabama%22%2C%22AK%22%3A%22Alaska%22%2C%22AZ%22%3A%22Arizona%22%2C%22AR%22%3A%22Arkansas%22%2C%22CA%22%3A%22California%22%2C%22CO%22%3A%22Colorado%22%2C%22CT%22%3A%22Connecticut%22%2C%22DE%22%3A%22Delaware%22%2C%22DC%22%3A%22District%20Of%20Columbia%22%2C%22FL%22%3A%22Florida%22%2C%22GA%22%3A%22Georgia%22%2C%22HI%22%3A%22Hawaii%22%2C%22ID%22%3A%22Idaho%22%2C%22IL%22%3A%22Illinois%22%2C%22IN%22%3A%22Indiana%22%2C%22IA%22%3A%22Iowa%22%2C%22KS%22%3A%22Kansas%22%2C%22KY%22%3A%22Kentucky%22%2C%22LA%22%3A%22Louisiana%22%2C%22ME%22%3A%22Maine%22%2C%22MD%22%3A%22Maryland%22%2C%22MA%22%3A%22Massachusetts%22%2C%22MI%22%3A%22Michigan%22%2C%22MN%22%3A%22Minnesota%22%2C%22MS%22%3A%22Mississippi%22%2C%22MO%22%3A%22Missouri%22%2C%22MT%22%3A%22Montana%22%2C%22NE%22%3A%22Nebraska%22%2C%22NV%22%3A%22Nevada%22%2C%22NH%22%3A%22New%20Hampshire%22%2C%22NJ%22%3A%22New%20Jersey%22%2C%22NM%22%3A%22New%20Mexico%22%2C%22NY%22%3A%22New%20York%22%2C%22NC%22%3A%22North%20Carolina%22%2C%22ND%22%3A%22North%20Dakota%22%2C%22OH%22%3A%22Ohio%22%2C%22OK%22%3A%22Oklahoma%22%2C%22OR%22%3A%22Oregon%22%2C%22PA%22%3A%22Pennsylvania%22%2C%22RI%22%3A%22Rhode%20Island%22%2C%22SC%22%3A%22South%20Carolina%22%2C%22SD%22%3A%22South%20Dakota%22%2C%22TN%22%3A%22Tennessee%22%2C%22TX%22%3A%22Texas%22%2C%22UT%22%3A%22Utah%22%2C%22VT%22%3A%22Vermont%22%2C%22VA%22%3A%22Virginia%22%2C%22WA%22%3A%22Washington%22%2C%22WV%22%3A%22West%20Virginia%22%2C%22WI%22%3A%22Wisconsin%22%2C%22WY%22%3A%22Wyoming%22%2C%22AA%22%3A%22Armed%20Forces%20%28AA%29%22%2C%22AE%22%3A%22Armed%20Forces%20%28AE%29%22%2C%22AP%22%3A%22Armed%20Forces%20%28AP%29%22%7D%2C%22UY%22%3A%7B%22UY-AR%22%3A%22Artigas%22%2C%22UY-CA%22%3A%22Canelones%22%2C%22UY-CL%22%3A%22Cerro%20Largo%22%2C%22UY-CO%22%3A%22Colonia%22%2C%22UY-DU%22%3A%22Durazno%22%2C%22UY-FS%22%3A%22Flores%22%2C%22UY-FD%22%3A%22Florida%22%2C%22UY-LA%22%3A%22Lavalleja%22%2C%22UY-MA%22%3A%22Maldonado%22%2C%22UY-MO%22%3A%22Montevideo%22%2C%22UY-PA%22%3A%22Paysand%5Cu00fa%22%2C%22UY-RN%22%3A%22R%5Cu00edo%20Negro%22%2C%22UY-RV%22%3A%22Rivera%22%2C%22UY-RO%22%3A%22Rocha%22%2C%22UY-SA%22%3A%22Salto%22%2C%22UY-SJ%22%3A%22San%20Jos%5Cu00e9%22%2C%22UY-SO%22%3A%22Soriano%22%2C%22UY-TA%22%3A%22Tacuaremb%5Cu00f3%22%2C%22UY-TT%22%3A%22Treinta%20y%20Tres%22%7D%2C%22VE%22%3A%7B%22VE-A%22%3A%22Capital%22%2C%22VE-B%22%3A%22Anzo%5Cu00e1tegui%22%2C%22VE-C%22%3A%22Apure%22%2C%22VE-D%22%3A%22Aragua%22%2C%22VE-E%22%3A%22Barinas%22%2C%22VE-F%22%3A%22Bol%5Cu00edvar%22%2C%22VE-G%22%3A%22Carabobo%22%2C%22VE-H%22%3A%22Cojedes%22%2C%22VE-I%22%3A%22Falc%5Cu00f3n%22%2C%22VE-J%22%3A%22Gu%5Cu00e1rico%22%2C%22VE-K%22%3A%22Lara%22%2C%22VE-L%22%3A%22M%5Cu00e9rida%22%2C%22VE-M%22%3A%22Miranda%22%2C%22VE-N%22%3A%22Monagas%22%2C%22VE-O%22%3A%22Nueva%20Esparta%22%2C%22VE-P%22%3A%22Portuguesa%22%2C%22VE-R%22%3A%22Sucre%22%2C%22VE-S%22%3A%22T%5Cu00e1chira%22%2C%22VE-T%22%3A%22Trujillo%22%2C%22VE-U%22%3A%22Yaracuy%22%2C%22VE-V%22%3A%22Zulia%22%2C%22VE-W%22%3A%22Federal%20Dependencies%22%2C%22VE-X%22%3A%22La%20Guaira%20%28Vargas%29%22%2C%22VE-Y%22%3A%22Delta%20Amacuro%22%2C%22VE-Z%22%3A%22Amazonas%22%7D%2C%22VN%22%3A%5B%5D%2C%22YT%22%3A%5B%5D%2C%22ZA%22%3A%7B%22EC%22%3A%22Eastern%20Cape%22%2C%22FS%22%3A%22Free%20State%22%2C%22GP%22%3A%22Gauteng%22%2C%22KZN%22%3A%22KwaZulu-Natal%22%2C%22LP%22%3A%22Limpopo%22%2C%22MP%22%3A%22Mpumalanga%22%2C%22NC%22%3A%22Northern%20Cape%22%2C%22NW%22%3A%22North%20West%22%2C%22WC%22%3A%22Western%20Cape%22%7D%2C%22ZM%22%3A%7B%22ZM-01%22%3A%22Western%22%2C%22ZM-02%22%3A%22Central%22%2C%22ZM-03%22%3A%22Eastern%22%2C%22ZM-04%22%3A%22Luapula%22%2C%22ZM-05%22%3A%22Northern%22%2C%22ZM-06%22%3A%22North-Western%22%2C%22ZM-07%22%3A%22Southern%22%2C%22ZM-08%22%3A%22Copperbelt%22%2C%22ZM-09%22%3A%22Lusaka%22%2C%22ZM-10%22%3A%22Muchinga%22%7D%7D%2C%22collectableMethodIds%22%3A%5B%5D%2C%22admin%22%3A%7B%22orderStatuses%22%3A%7B%22pending%22%3A%22Pending%20payment%22%2C%22processing%22%3A%22Processing%22%2C%22on-hold%22%3A%22On%20hold%22%2C%22completed%22%3A%22Completed%22%2C%22cancelled%22%3A%22Cancelled%22%2C%22refunded%22%3A%22Refunded%22%2C%22failed%22%3A%22Failed%22%2C%22checkout-draft%22%3A%22Draft%22%7D%2C%22stockStatuses%22%3A%7B%22instock%22%3A%22In%20stock%22%2C%22outofstock%22%3A%22Out%20of%20stock%22%2C%22onbackorder%22%3A%22On%20backorder%22%7D%2C%22currency%22%3A%7B%22code%22%3A%22USD%22%2C%22precision%22%3A2%2C%22symbol%22%3A%22%24%22%2C%22symbolPosition%22%3A%22left%22%2C%22decimalSeparator%22%3A%22.%22%2C%22thousandSeparator%22%3A%22%2C%22%2C%22priceFormat%22%3A%22%251%24s%252%24s%22%7D%2C%22locale%22%3A%7B%22siteLocale%22%3A%22vi%22%2C%22userLocale%22%3A%22vi%22%2C%22weekdaysShort%22%3A%5B%22CN%22%2C%22T2%22%2C%22T3%22%2C%22T4%22%2C%22T5%22%2C%22T6%22%2C%22T7%22%5D%7D%2C%22preloadOptions%22%3A%7B%22woocommerce_default_homepage_layout%22%3Afalse%2C%22woocommerce_admin_install_timestamp%22%3A%221689650163%22%2C%22woocommerce_admin_transient_notices_queue%22%3Afalse%7D%2C%22preloadSettings%22%3A%7B%22general%22%3A%7B%22store_address%22%3A%22%22%2C%22woocommerce_store_address%22%3A%22%22%2C%22woocommerce_store_address_2%22%3A%22%22%2C%22woocommerce_store_city%22%3A%22%22%2C%22woocommerce_default_country%22%3A%22VN%22%2C%22woocommerce_store_postcode%22%3A%22%22%2C%22general_options%22%3A%22%22%2C%22woocommerce_allowed_countries%22%3A%22all%22%2C%22woocommerce_all_except_countries%22%3A%5B%5D%2C%22woocommerce_specific_allowed_countries%22%3A%5B%5D%2C%22woocommerce_ship_to_countries%22%3A%22%22%2C%22woocommerce_specific_ship_to_countries%22%3A%5B%5D%2C%22woocommerce_default_customer_address%22%3A%22base%22%2C%22woocommerce_calc_taxes%22%3A%22no%22%2C%22woocommerce_enable_coupons%22%3A%22yes%22%2C%22woocommerce_calc_discounts_sequentially%22%3A%22no%22%2C%22pricing_options%22%3A%22%22%2C%22woocommerce_currency%22%3A%22USD%22%2C%22woocommerce_currency_pos%22%3A%22left%22%2C%22woocommerce_price_thousand_sep%22%3A%22%2C%22%2C%22woocommerce_price_decimal_sep%22%3A%22.%22%2C%22woocommerce_price_num_decimals%22%3A%222%22%7D%7D%2C%22currentUserData%22%3A%7B%22id%22%3A1%2C%22username%22%3A%22root%22%2C%22name%22%3A%22root%22%2C%22first_name%22%3A%22%22%2C%22last_name%22%3A%22%22%2C%22email%22%3A%22kienhue98%40gmail.com%22%2C%22url%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%22%2C%22description%22%3A%22%22%2C%22link%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fauthor%5C%2Froot%5C%2F%22%2C%22locale%22%3A%22vi%22%2C%22nickname%22%3A%22root%22%2C%22slug%22%3A%22root%22%2C%22roles%22%3A%5B%22administrator%22%2C%22erp_hr_manager%22%2C%22erp_ac_manager%22%5D%2C%22registered_date%22%3A%222023-07-08T04%3A06%3A43%2B00%3A00%22%2C%22capabilities%22%3A%7B%22switch_themes%22%3Atrue%2C%22edit_themes%22%3Atrue%2C%22activate_plugins%22%3Atrue%2C%22edit_plugins%22%3Atrue%2C%22edit_users%22%3Atrue%2C%22edit_files%22%3Atrue%2C%22manage_options%22%3Atrue%2C%22moderate_comments%22%3Atrue%2C%22manage_categories%22%3Atrue%2C%22manage_links%22%3Atrue%2C%22upload_files%22%3Atrue%2C%22import%22%3Atrue%2C%22unfiltered_html%22%3Atrue%2C%22edit_posts%22%3Atrue%2C%22edit_others_posts%22%3Atrue%2C%22edit_published_posts%22%3Atrue%2C%22publish_posts%22%3Atrue%2C%22edit_pages%22%3Atrue%2C%22read%22%3Atrue%2C%22level_10%22%3Atrue%2C%22level_9%22%3Atrue%2C%22level_8%22%3Atrue%2C%22level_7%22%3Atrue%2C%22level_6%22%3Atrue%2C%22level_5%22%3Atrue%2C%22level_4%22%3Atrue%2C%22level_3%22%3Atrue%2C%22level_2%22%3Atrue%2C%22level_1%22%3Atrue%2C%22level_0%22%3Atrue%2C%22edit_others_pages%22%3Atrue%2C%22edit_published_pages%22%3Atrue%2C%22publish_pages%22%3Atrue%2C%22delete_pages%22%3Atrue%2C%22delete_others_pages%22%3Atrue%2C%22delete_published_pages%22%3Atrue%2C%22delete_posts%22%3Atrue%2C%22delete_others_posts%22%3Atrue%2C%22delete_published_posts%22%3Atrue%2C%22delete_private_posts%22%3Atrue%2C%22edit_private_posts%22%3Atrue%2C%22read_private_posts%22%3Atrue%2C%22delete_private_pages%22%3Atrue%2C%22edit_private_pages%22%3Atrue%2C%22read_private_pages%22%3Atrue%2C%22delete_users%22%3Atrue%2C%22create_users%22%3Atrue%2C%22unfiltered_upload%22%3Atrue%2C%22edit_dashboard%22%3Atrue%2C%22update_plugins%22%3Atrue%2C%22delete_plugins%22%3Atrue%2C%22install_plugins%22%3Atrue%2C%22update_themes%22%3Atrue%2C%22install_themes%22%3Atrue%2C%22update_core%22%3Atrue%2C%22list_users%22%3Atrue%2C%22remove_users%22%3Atrue%2C%22promote_users%22%3Atrue%2C%22edit_theme_options%22%3Atrue%2C%22delete_themes%22%3Atrue%2C%22export%22%3Atrue%2C%22edit_wpcrm-contact%22%3Atrue%2C%22read_wpcrm-contact%22%3Atrue%2C%22delete_wpcrm-contact%22%3Atrue%2C%22edit_wpcrm-contacts%22%3Atrue%2C%22edit_others_wpcrm-contacts%22%3Atrue%2C%22publish_wpcrm-contacts%22%3Atrue%2C%22read_private_wpcrm-contacts%22%3Atrue%2C%22delete_wpcrm-contacts%22%3Atrue%2C%22delete_private_wpcrm-contacts%22%3Atrue%2C%22delete_published_wpcrm-contacts%22%3Atrue%2C%22delete_others_wpcrm-contacts%22%3Atrue%2C%22edit_private_wpcrm-contacts%22%3Atrue%2C%22edit_published_wpcrm-contacts%22%3Atrue%2C%22create_wpcrm-contacts%22%3Atrue%2C%22manage_wp_crm%22%3Atrue%2C%22edit_wpcrm-task%22%3Atrue%2C%22read_wpcrm-task%22%3Atrue%2C%22delete_wpcrm-task%22%3Atrue%2C%22edit_wpcrm-tasks%22%3Atrue%2C%22edit_others_wpcrm-tasks%22%3Atrue%2C%22publish_wpcrm-tasks%22%3Atrue%2C%22read_private_wpcrm-tasks%22%3Atrue%2C%22delete_wpcrm-tasks%22%3Atrue%2C%22delete_private_wpcrm-tasks%22%3Atrue%2C%22delete_published_wpcrm-tasks%22%3Atrue%2C%22delete_others_wpcrm-tasks%22%3Atrue%2C%22edit_private_wpcrm-tasks%22%3Atrue%2C%22edit_published_wpcrm-tasks%22%3Atrue%2C%22create_wpcrm-tasks%22%3Atrue%2C%22edit_wpcrm-organization%22%3Atrue%2C%22read_wpcrm-organization%22%3Atrue%2C%22delete_wpcrm-organization%22%3Atrue%2C%22edit_wpcrm-organizations%22%3Atrue%2C%22edit_others_wpcrm-organizations%22%3Atrue%2C%22publish_wpcrm-organizations%22%3Atrue%2C%22read_private_wpcrm-organizations%22%3Atrue%2C%22delete_wpcrm-organizations%22%3Atrue%2C%22delete_private_wpcrm-organizations%22%3Atrue%2C%22delete_published_wpcrm-organizations%22%3Atrue%2C%22delete_others_wpcrm-organizations%22%3Atrue%2C%22edit_private_wpcrm-organizations%22%3Atrue%2C%22edit_published_wpcrm-organizations%22%3Atrue%2C%22create_wpcrm-organizations%22%3Atrue%2C%22edit_wpcrm-opportunity%22%3Atrue%2C%22read_wpcrm-opportunity%22%3Atrue%2C%22delete_wpcrm-opportunity%22%3Atrue%2C%22edit_wpcrm-opportunitys%22%3Atrue%2C%22edit_others_wpcrm-opportunitys%22%3Atrue%2C%22publish_wpcrm-opportunitys%22%3Atrue%2C%22read_private_wpcrm-opportunitys%22%3Atrue%2C%22delete_wpcrm-opportunitys%22%3Atrue%2C%22delete_private_wpcrm-opportunitys%22%3Atrue%2C%22delete_published_wpcrm-opportunitys%22%3Atrue%2C%22delete_others_wpcrm-opportunitys%22%3Atrue%2C%22edit_private_wpcrm-opportunitys%22%3Atrue%2C%22edit_published_wpcrm-opportunitys%22%3Atrue%2C%22create_wpcrm-opportunitys%22%3Atrue%2C%22edit_wpcrm-project%22%3Atrue%2C%22read_wpcrm-project%22%3Atrue%2C%22delete_wpcrm-project%22%3Atrue%2C%22edit_wpcrm-projects%22%3Atrue%2C%22edit_others_wpcrm-projects%22%3Atrue%2C%22publish_wpcrm-projects%22%3Atrue%2C%22read_private_wpcrm-projects%22%3Atrue%2C%22delete_wpcrm-projects%22%3Atrue%2C%22delete_private_wpcrm-projects%22%3Atrue%2C%22delete_published_wpcrm-projects%22%3Atrue%2C%22delete_others_wpcrm-projects%22%3Atrue%2C%22edit_private_wpcrm-projects%22%3Atrue%2C%22edit_published_wpcrm-projects%22%3Atrue%2C%22create_wpcrm-projects%22%3Atrue%2C%22edit_wpcrm-campaign%22%3Atrue%2C%22read_wpcrm-campaign%22%3Atrue%2C%22delete_wpcrm-campaign%22%3Atrue%2C%22edit_wpcrm-campaigns%22%3Atrue%2C%22edit_others_wpcrm-campaigns%22%3Atrue%2C%22publish_wpcrm-campaigns%22%3Atrue%2C%22read_private_wpcrm-campaigns%22%3Atrue%2C%22delete_wpcrm-campaigns%22%3Atrue%2C%22delete_private_wpcrm-campaigns%22%3Atrue%2C%22delete_published_wpcrm-campaigns%22%3Atrue%2C%22delete_others_wpcrm-campaigns%22%3Atrue%2C%22edit_private_wpcrm-campaigns%22%3Atrue%2C%22edit_published_wpcrm-campaigns%22%3Atrue%2C%22create_wpcrm-campaigns%22%3Atrue%2C%22manage_woocommerce%22%3Atrue%2C%22view_woocommerce_reports%22%3Atrue%2C%22edit_product%22%3Atrue%2C%22read_product%22%3Atrue%2C%22delete_product%22%3Atrue%2C%22edit_products%22%3Atrue%2C%22edit_others_products%22%3Atrue%2C%22publish_products%22%3Atrue%2C%22read_private_products%22%3Atrue%2C%22delete_products%22%3Atrue%2C%22delete_private_products%22%3Atrue%2C%22delete_published_products%22%3Atrue%2C%22delete_others_products%22%3Atrue%2C%22edit_private_products%22%3Atrue%2C%22edit_published_products%22%3Atrue%2C%22manage_product_terms%22%3Atrue%2C%22edit_product_terms%22%3Atrue%2C%22delete_product_terms%22%3Atrue%2C%22assign_product_terms%22%3Atrue%2C%22edit_shop_order%22%3Atrue%2C%22read_shop_order%22%3Atrue%2C%22delete_shop_order%22%3Atrue%2C%22edit_shop_orders%22%3Atrue%2C%22edit_others_shop_orders%22%3Atrue%2C%22publish_shop_orders%22%3Atrue%2C%22read_private_shop_orders%22%3Atrue%2C%22delete_shop_orders%22%3Atrue%2C%22delete_private_shop_orders%22%3Atrue%2C%22delete_published_shop_orders%22%3Atrue%2C%22delete_others_shop_orders%22%3Atrue%2C%22edit_private_shop_orders%22%3Atrue%2C%22edit_published_shop_orders%22%3Atrue%2C%22manage_shop_order_terms%22%3Atrue%2C%22edit_shop_order_terms%22%3Atrue%2C%22delete_shop_order_terms%22%3Atrue%2C%22assign_shop_order_terms%22%3Atrue%2C%22edit_shop_coupon%22%3Atrue%2C%22read_shop_coupon%22%3Atrue%2C%22delete_shop_coupon%22%3Atrue%2C%22edit_shop_coupons%22%3Atrue%2C%22edit_others_shop_coupons%22%3Atrue%2C%22publish_shop_coupons%22%3Atrue%2C%22read_private_shop_coupons%22%3Atrue%2C%22delete_shop_coupons%22%3Atrue%2C%22delete_private_shop_coupons%22%3Atrue%2C%22delete_published_shop_coupons%22%3Atrue%2C%22delete_others_shop_coupons%22%3Atrue%2C%22edit_private_shop_coupons%22%3Atrue%2C%22edit_published_shop_coupons%22%3Atrue%2C%22manage_shop_coupon_terms%22%3Atrue%2C%22edit_shop_coupon_terms%22%3Atrue%2C%22delete_shop_coupon_terms%22%3Atrue%2C%22assign_shop_coupon_terms%22%3Atrue%2C%22erp_view_list%22%3Atrue%2C%22erp_list_employee%22%3Atrue%2C%22erp_create_employee%22%3Atrue%2C%22erp_view_employee%22%3Atrue%2C%22erp_edit_employee%22%3Atrue%2C%22erp_delete_employee%22%3Atrue%2C%22erp_create_review%22%3Atrue%2C%22erp_delete_review%22%3Atrue%2C%22erp_manage_review%22%3Atrue%2C%22erp_crate_announcement%22%3Atrue%2C%22erp_view_announcement%22%3Atrue%2C%22erp_manage_announcement%22%3Atrue%2C%22erp_manage_jobinfo%22%3Atrue%2C%22erp_view_jobinfo%22%3Atrue%2C%22erp_manage_department%22%3Atrue%2C%22erp_manage_designation%22%3Atrue%2C%22erp_leave_create_request%22%3Atrue%2C%22erp_leave_manage%22%3Atrue%2C%22erp_manage_hr_settings%22%3Atrue%2C%22erp_create_experience%22%3Atrue%2C%22erp_edit_experience%22%3Atrue%2C%22erp_view_experience%22%3Atrue%2C%22erp_delete_experience%22%3Atrue%2C%22erp_create_education%22%3Atrue%2C%22erp_edit_education%22%3Atrue%2C%22erp_view_education%22%3Atrue%2C%22erp_delete_education%22%3Atrue%2C%22erp_can_terminate%22%3Atrue%2C%22erp_create_dependent%22%3Atrue%2C%22erp_edit_dependent%22%3Atrue%2C%22erp_view_dependent%22%3Atrue%2C%22erp_delete_dependent%22%3Atrue%2C%22erp_create_document%22%3Atrue%2C%22erp_edit_document%22%3Atrue%2C%22erp_view_document%22%3Atrue%2C%22erp_delete_document%22%3Atrue%2C%22erp_create_attendance%22%3Atrue%2C%22erp_edit_attendance%22%3Atrue%2C%22erp_view_attendance%22%3Atrue%2C%22erp_delete_attendance%22%3Atrue%2C%22erp_ac_view_dashboard%22%3Atrue%2C%22erp_ac_view_customer%22%3Atrue%2C%22erp_ac_view_single_customer%22%3Atrue%2C%22erp_ac_view_other_customers%22%3Atrue%2C%22erp_ac_create_customer%22%3Atrue%2C%22erp_ac_edit_customer%22%3Atrue%2C%22erp_ac_edit_other_customers%22%3Atrue%2C%22erp_ac_delete_customer%22%3Atrue%2C%22erp_ac_delete_other_customers%22%3Atrue%2C%22erp_ac_view_vendor%22%3Atrue%2C%22erp_ac_view_other_vendors%22%3Atrue%2C%22erp_ac_create_vendor%22%3Atrue%2C%22erp_ac_edit_vendor%22%3Atrue%2C%22erp_ac_edit_other_vendors%22%3Atrue%2C%22erp_ac_delete_vendor%22%3Atrue%2C%22erp_ac_delete_other_vendors%22%3Atrue%2C%22erp_ac_view_sale%22%3Atrue%2C%22erp_ac_view_single_vendor%22%3Atrue%2C%22erp_ac_view_other_sales%22%3Atrue%2C%22erp_ac_view_sales_summary%22%3Atrue%2C%22erp_ac_create_sales_payment%22%3Atrue%2C%22erp_ac_publish_sales_payment%22%3Atrue%2C%22erp_ac_create_sales_invoice%22%3Atrue%2C%22erp_ac_publish_sales_invoice%22%3Atrue%2C%22erp_ac_view_expense%22%3Atrue%2C%22erp_ac_view_other_expenses%22%3Atrue%2C%22erp_ac_view_expenses_summary%22%3Atrue%2C%22erp_ac_create_expenses_voucher%22%3Atrue%2C%22erp_ac_publish_expenses_voucher%22%3Atrue%2C%22erp_ac_create_expenses_credit%22%3Atrue%2C%22erp_ac_publish_expenses_credit%22%3Atrue%2C%22erp_ac_view_account_lists%22%3Atrue%2C%22erp_ac_view_single_account%22%3Atrue%2C%22erp_ac_create_account%22%3Atrue%2C%22erp_ac_edit_account%22%3Atrue%2C%22erp_ac_delete_account%22%3Atrue%2C%22erp_ac_view_bank_accounts%22%3Atrue%2C%22erp_ac_create_bank_transfer%22%3Atrue%2C%22erp_ac_view_journal%22%3Atrue%2C%22erp_ac_view_other_journals%22%3Atrue%2C%22erp_ac_create_journal%22%3Atrue%2C%22erp_ac_view_reports%22%3Atrue%2C%22administrator%22%3Atrue%2C%22erp_hr_manager%22%3Atrue%2C%22erp_crm_manager%22%3Atrue%2C%22erp_ac_manager%22%3Atrue%7D%2C%22extra_capabilities%22%3A%7B%22administrator%22%3Atrue%2C%22erp_hr_manager%22%3Atrue%2C%22erp_crm_manager%22%3Atrue%2C%22erp_ac_manager%22%3Atrue%7D%2C%22avatar_urls%22%3A%7B%2224%22%3A%22http%3A%5C%2F%5C%2F0.gravatar.com%5C%2Favatar%5C%2Ff9ce72f769705888cbf794370e57ea10%3Fs%3D24%26d%3Dmm%26r%3Dg%22%2C%2248%22%3A%22http%3A%5C%2F%5C%2F0.gravatar.com%5C%2Favatar%5C%2Ff9ce72f769705888cbf794370e57ea10%3Fs%3D48%26d%3Dmm%26r%3Dg%22%2C%2296%22%3A%22http%3A%5C%2F%5C%2F0.gravatar.com%5C%2Favatar%5C%2Ff9ce72f769705888cbf794370e57ea10%3Fs%3D96%26d%3Dmm%26r%3Dg%22%7D%2C%22meta%22%3A%7B%22persisted_preferences%22%3A%7B%22core%5C%2Fedit-post%22%3A%7B%22isComplementaryAreaVisible%22%3Atrue%2C%22welcomeGuide%22%3Afalse%2C%22openPanels%22%3A%5B%22post-status%22%2C%22taxonomy-panel-post_tag%22%2C%22featured-image%22%2C%22post-excerpt%22%2C%22discussion-panel%22%5D%7D%2C%22_modified%22%3A%222023-07-08T04%3A14%3A42.988Z%22%2C%22core%5C%2Fedit-site%22%3A%7B%22welcomeGuide%22%3Afalse%7D%7D%7D%2C%22is_super_admin%22%3Atrue%2C%22woocommerce_meta%22%3A%7B%22variable_product_tour_shown%22%3A%22%22%2C%22activity_panel_inbox_last_read%22%3A%22%22%2C%22activity_panel_reviews_last_read%22%3A%22%22%2C%22categories_report_columns%22%3A%22%22%2C%22coupons_report_columns%22%3A%22%22%2C%22customers_report_columns%22%3A%22%22%2C%22orders_report_columns%22%3A%22%22%2C%22products_report_columns%22%3A%22%22%2C%22revenue_report_columns%22%3A%22%22%2C%22taxes_report_columns%22%3A%22%22%2C%22variations_report_columns%22%3A%22%22%2C%22dashboard_sections%22%3A%22%22%2C%22dashboard_chart_type%22%3A%22%22%2C%22dashboard_chart_interval%22%3A%22%22%2C%22dashboard_leaderboard_rows%22%3A%22%22%2C%22homepage_layout%22%3A%22%22%2C%22homepage_stats%22%3A%22%22%2C%22task_list_tracked_started_tasks%22%3A%22%7B%5C%22products%5C%22%3A1%7D%22%2C%22help_panel_highlight_shown%22%3A%22%22%2C%22android_app_banner_dismissed%22%3A%22%22%7D%7D%2C%22reviewsEnabled%22%3A%22yes%22%2C%22manageStock%22%3A%22yes%22%2C%22commentModeration%22%3A%220%22%2C%22notifyLowStockAmount%22%3A%222%22%2C%22wcAdminAssetUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-content%5C%2Fplugins%5C%2Fwoocommerce%5C%2Fassets%5C%2Fimages%22%2C%22wcVersion%22%3A%227.9.0%22%2C%22siteUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%22%2C%22shopUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fshop%5C%2F%22%2C%22homeUrl%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%22%2C%22dateFormat%22%3A%22F%20j%2C%20Y%22%2C%22timeZone%22%3A%22%2B00%3A00%22%2C%22plugins%22%3A%7B%22installedPlugins%22%3A%5B%22advanced-custom-fields-pro%22%2C%22classic-editor%22%2C%22woocommerce%22%5D%2C%22activePlugins%22%3A%5B%22advanced-custom-fields-pro%22%2C%22classic-editor%22%2C%22woocommerce%22%5D%7D%2C%22woocommerceTranslation%22%3A%22WooCommerce%22%2C%22unregisteredOrderStatuses%22%3A%5B%5D%2C%22variationTitleAttributesSeparator%22%3A%22%20-%20%22%2C%22dataEndpoints%22%3A%7B%22performanceIndicators%22%3A%5B%7B%22stat%22%3A%22revenue%5C%2Ftotal_sales%22%2C%22chart%22%3A%22total_sales%22%2C%22label%22%3A%22Total%20sales%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Frevenue%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Frevenue%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22revenue%5C%2Fnet_revenue%22%2C%22chart%22%3A%22net_revenue%22%2C%22label%22%3A%22Net%20sales%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Frevenue%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Frevenue%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22orders%5C%2Forders_count%22%2C%22chart%22%3A%22orders_count%22%2C%22label%22%3A%22Orders%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Forders%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Forders%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22orders%5C%2Favg_order_value%22%2C%22chart%22%3A%22avg_order_value%22%2C%22label%22%3A%22Average%20order%20value%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Forders%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Forders%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22products%5C%2Fitems_sold%22%2C%22chart%22%3A%22items_sold%22%2C%22label%22%3A%22Products%20sold%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Fproducts%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Fproducts%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22revenue%5C%2Frefunds%22%2C%22chart%22%3A%22refunds%22%2C%22label%22%3A%22Returns%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Frevenue%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Frevenue%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22coupons%5C%2Forders_count%22%2C%22chart%22%3A%22orders_count%22%2C%22label%22%3A%22Discounted%20orders%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Fcoupons%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Fcoupons%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22coupons%5C%2Famount%22%2C%22chart%22%3A%22amount%22%2C%22label%22%3A%22Net%20discount%20amount%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Fcoupons%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Fcoupons%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22taxes%5C%2Ftotal_tax%22%2C%22chart%22%3A%22total_tax%22%2C%22label%22%3A%22Total%20tax%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Ftaxes%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Ftaxes%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22taxes%5C%2Forder_tax%22%2C%22chart%22%3A%22order_tax%22%2C%22label%22%3A%22Order%20tax%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Ftaxes%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Ftaxes%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22taxes%5C%2Fshipping_tax%22%2C%22chart%22%3A%22shipping_tax%22%2C%22label%22%3A%22Shipping%20tax%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Ftaxes%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Ftaxes%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22revenue%5C%2Fshipping%22%2C%22chart%22%3A%22shipping%22%2C%22label%22%3A%22Shipping%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Frevenue%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Frevenue%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22downloads%5C%2Fdownload_count%22%2C%22chart%22%3A%22download_count%22%2C%22label%22%3A%22Downloads%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Fdownloads%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Fdownloads%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22revenue%5C%2Fgross_sales%22%2C%22chart%22%3A%22gross_sales%22%2C%22label%22%3A%22Gross%20sales%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Frevenue%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Frevenue%22%7D%5D%7D%7D%2C%7B%22stat%22%3A%22variations%5C%2Fitems_sold%22%2C%22chart%22%3A%22items_sold%22%2C%22label%22%3A%22Variations%20Sold%22%2C%22_links%22%3A%7B%22api%22%3A%5B%7B%22href%22%3A%22http%3A%5C%2F%5C%2Flocalhost%5C%2Fwordpress%5C%2Fwp-json%5C%2Fwc-analytics%5C%2Freports%5C%2Fvariations%5C%2Fstats%22%7D%5D%2C%22report%22%3A%5B%7B%22href%22%3A%22%5C%2Fanalytics%5C%2Fvariations%22%7D%5D%7D%7D%5D%2C%22leaderboards%22%3A%5B%7B%22id%22%3A%22customers%22%2C%22label%22%3A%22Top%20Customers%20-%20Total%20Spend%22%2C%22headers%22%3A%5B%7B%22label%22%3A%22Customer%20Name%22%7D%2C%7B%22label%22%3A%22Orders%22%7D%2C%7B%22label%22%3A%22Total%20Spend%22%7D%5D%7D%2C%7B%22id%22%3A%22coupons%22%2C%22label%22%3A%22Top%20Coupons%20-%20Number%20of%20Orders%22%2C%22headers%22%3A%5B%7B%22label%22%3A%22Coupon%20code%22%7D%2C%7B%22label%22%3A%22Orders%22%7D%2C%7B%22label%22%3A%22Amount%20discounted%22%7D%5D%7D%2C%7B%22id%22%3A%22categories%22%2C%22label%22%3A%22Top%20categories%20-%20Items%20sold%22%2C%22headers%22%3A%5B%7B%22label%22%3A%22Category%22%7D%2C%7B%22label%22%3A%22Items%20sold%22%7D%2C%7B%22label%22%3A%22Net%20sales%22%7D%5D%7D%2C%7B%22id%22%3A%22products%22%2C%22label%22%3A%22Top%20products%20-%20Items%20sold%22%2C%22headers%22%3A%5B%7B%22label%22%3A%22Product%22%7D%2C%7B%22label%22%3A%22Items%20sold%22%7D%2C%7B%22label%22%3A%22Net%20sales%22%7D%5D%7D%5D%7D%2C%22wcAdminSettings%22%3A%7B%22woocommerce_excluded_report_order_statuses%22%3A%5B%22pending%22%2C%22cancelled%22%2C%22failed%22%5D%2C%22woocommerce_actionable_order_statuses%22%3A%5B%22processing%22%2C%22on-hold%22%5D%2C%22woocommerce_default_date_range%22%3A%22period%3Dmonth%26compare%3Dprevious_year%22%2C%22woocommerce_date_type%22%3A%22%22%7D%2C%22embedBreadcrumbs%22%3A%5B%5B%22admin.php%3Fpage%3Dwc-admin%22%2C%22WooCommerce%22%5D%2C%5B%22edit.php%3Fpost_type%3Dproduct%22%2C%22Products%22%5D%2C%22Product%20categories%22%5D%2C%22allowMarketplaceSuggestions%22%3Afalse%2C%22connectNonce%22%3A%22d685103bb5%22%2C%22wcpay_welcome_page_connect_nonce%22%3A%225784ca092b%22%2C%22features%22%3A%7B%22analytics%22%3A%7B%22is_enabled%22%3Atrue%2C%22is_experimental%22%3Afalse%7D%2C%22new_navigation%22%3A%7B%22is_enabled%22%3Afalse%2C%22is_experimental%22%3Afalse%7D%2C%22product_block_editor%22%3A%7B%22is_enabled%22%3Afalse%2C%22is_experimental%22%3Atrue%7D%2C%22custom_order_tables%22%3A%7B%22is_enabled%22%3Afalse%2C%22is_experimental%22%3Atrue%7D%2C%22cart_checkout_blocks%22%3A%7B%22is_enabled%22%3Afalse%2C%22is_experimental%22%3Afalse%7D%7D%2C%22_feature_nonce%22%3A%22b32248693e%22%2C%22onboarding%22%3A%7B%22profile%22%3A%7B%22is_store_country_set%22%3Atrue%2C%22industry%22%3A%5Bnull%5D%2C%22completed%22%3Atrue%2C%22is_plugins_page_skipped%22%3Atrue%7D%7D%2C%22alertCount%22%3A%220%22%2C%22visibleTaskListIds%22%3A%5B%22setup%22%2C%22extended%22%5D%7D%7D'));
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/wc-settings.js?ver=391426b47f4780dfec24522b83617956'
            id='wc-settings-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/number/index.js?ver=7.9.0'
            id='wc-number-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/deprecated.min.js?ver=6c963cb9494ba26b77eb'
            id='wp-deprecated-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/escape-html.min.js?ver=03e27a7b6ae14f7afaa6'
            id='wp-escape-html-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/element.min.js?ver=b3bda690cfc516378771'
            id='wp-element-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/html-entities.min.js?ver=36a4a255da7dd2e1bf8e'
            id='wp-html-entities-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/currency/index.js?ver=7.9.0'
            id='wc-currency-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/date/index.js?ver=7.9.0'
            id='wc-date-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/dom.min.js?ver=e03c89e1dd68aee1cb3a'
            id='wp-dom-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/is-shallow-equal.min.js?ver=20c2b06ecf04afb14fee'
            id='wp-is-shallow-equal-js'></script>
    <script id='wp-keycodes-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    }, "Period": ["Giai \u0111o\u1ea1n"], "Comma": ["D\u1ea5u ph\u1ea9y"], "Backtick": ["Backtick"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/keycodes.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/keycodes.min.js?ver=184b321fa2d3bc7fd173'
            id='wp-keycodes-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/priority-queue.min.js?ver=422e19e9d48b269c5219'
            id='wp-priority-queue-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/compose.min.js?ver=7d5916e3b2ef0ea01400'
            id='wp-compose-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/date.min.js?ver=f8550b1212d715fbf745'
            id='wp-date-js'></script>
    <script id='wp-date-js-after'>
        wp.date.setSettings({
            "l10n": {
                "locale": "vi",
                "months": ["Th\u00e1ng M\u1ed9t", "Th\u00e1ng Hai", "Th\u00e1ng Ba", "Th\u00e1ng T\u01b0", "Th\u00e1ng N\u0103m", "Th\u00e1ng S\u00e1u", "Th\u00e1ng B\u1ea3y", "Th\u00e1ng T\u00e1m", "Th\u00e1ng Ch\u00edn", "Th\u00e1ng M\u01b0\u1eddi", "Th\u00e1ng M\u01b0\u1eddi M\u1ed9t", "Th\u00e1ng M\u01b0\u1eddi Hai"],
                "monthsShort": ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
                "weekdays": ["Ch\u1ee7 Nh\u1eadt", "Th\u1ee9 Hai", "Th\u1ee9 Ba", "Th\u1ee9 T\u01b0", "Th\u1ee9 N\u0103m", "Th\u1ee9 S\u00e1u", "Th\u1ee9 B\u1ea3y"],
                "weekdaysShort": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                "meridiem": {"am": "s\u00e1ng", "pm": "chi\u1ec1u", "AM": "S\u00e1ng", "PM": "Chi\u1ec1u"},
                "relative": {"future": "t\u1eeb gi\u1edd %s", "past": "%s tr\u01b0\u1edbc"},
                "startOfWeek": 1
            },
            "formats": {
                "time": "g:i a",
                "date": "F j, Y",
                "datetime": "j F, Y g:i a",
                "datetimeAbbreviated": "M j, Y g:i a"
            },
            "timezone": {"offset": 0, "string": "", "abbr": ""}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/primitives.min.js?ver=dfac1545e52734396640'
            id='wp-primitives-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/private-apis.min.js?ver=6f247ed2bc3571743bba'
            id='wp-private-apis-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/redux-routine.min.js?ver=d86e7e9f062d7582f76b'
            id='wp-redux-routine-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/data.min.js?ver=90cebfec01d1a3f0368e'
            id='wp-data-js'></script>
    <script id='wp-data-js-after'>
        (function () {
            var userId = 1;
            var storageKey = "WP_DATA_USER_" + userId;
            wp.data
                .use(wp.data.plugins.persistence, {storageKey: storageKey});
        })();
    </script>
    <script id='wp-rich-text-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "%s removed.": ["\u0110\u00e3 x\u00f3a %s."],
                    "%s applied.": ["%s \u0111\u00e3 \u0111\u01b0\u1ee3c \u00e1p d\u1ee5ng."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/rich-text.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/rich-text.min.js?ver=9307ec04c67d79b6e813'
            id='wp-rich-text-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/warning.min.js?ver=4acee5fc2fd9a24cefc2'
            id='wp-warning-js'></script>
    <script id='wp-components-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {"domain": "messages", "plural-forms": "nplurals=1; plural=0;", "lang": "vi_VN"},
                    "January": ["Th\u00e1ng M\u1ed9t"],
                    "February": ["Th\u00e1ng Hai"],
                    "March": ["Th\u00e1ng Ba"],
                    "April": ["Th\u00e1ng T\u01b0"],
                    "May": ["Th\u00e1ng N\u0103m"],
                    "June": ["Th\u00e1ng S\u00e1u"],
                    "July": ["Th\u00e1ng B\u1ea3y"],
                    "August": ["Th\u00e1ng T\u00e1m"],
                    "September": ["Th\u00e1ng Ch\u00edn"],
                    "October": ["Th\u00e1ng M\u01b0\u1eddi"],
                    "November": ["Th\u00e1ng M\u01b0\u1eddi M\u1ed9t"],
                    "December": ["Th\u00e1ng M\u01b0\u1eddi Hai"],
                    "S": ["S"],
                    "M": ["M"],
                    "L": ["L"],
                    "XL": ["XL"],
                    "XXL": ["XXL"],
                    "View next month": ["Xem th\u00e1ng ti\u1ebfp theo"],
                    "View previous month": ["Xem th\u00e1ng tr\u01b0\u1edbc"],
                    "%s reset to default": ["\u0110\u1eb7t l\u1ea1i %s v\u1ec1 m\u1eb7c \u0111\u1ecbnh"],
                    "Custom color picker. The currently selected color is called \"%1$s\" and has a value of \"%2$s\".": ["Ch\u1ecdn m\u00e0u. M\u00e0u g\u1ea7n \u0111\u00e2y \u0111\u00e3 ch\u1ecdn l\u00e0 \"%1$s\" v\u00e0 c\u00f3 gi\u00e1 tr\u1ecb l\u00e0 \"%2$s\"."],
                    "Border color and style picker.": ["Ch\u1ecdn m\u00e0u vi\u1ec1n v\u00e0 ki\u1ec3u d\u00e1ng."],
                    "Border color picker.": ["Ch\u1ecdn m\u00e0u vi\u1ec1n."],
                    "Close border color": ["\u0110\u00f3ng m\u00e0u vi\u1ec1n"],
                    "Reset to default": ["Kh\u00f4i ph\u1ee5c v\u1ec1 m\u1eb7c \u0111\u1ecbnh"],
                    "Top border": ["Vi\u1ec1n tr\u00ean"],
                    "Left border": ["Vi\u1ec1n tr\u00e1i"],
                    "Right border": ["Vi\u1ec1n ph\u1ea3i"],
                    "Bottom border": ["Vi\u1ec1n d\u01b0\u1edbi"],
                    "Unlink sides": ["B\u1ecf li\u00ean k\u1ebft sides"],
                    "Link sides": ["Li\u00ean k\u1ebft sides"],
                    "Reset all": ["\u0110\u1eb7t l\u1ea1i t\u1ea5t c\u1ea3"],
                    "Show %s": ["Xem %s"],
                    "Hide and reset %s": ["\u1ea8n v\u00e0 x\u00f3a b\u1ecf %s"],
                    "Reset %s": ["X\u00f3a b\u1ecf %s"],
                    "Search %s": ["T\u00ecm %s"],
                    "Set custom size": ["\u0110\u1eb7t c\u1ee1 ri\u00eang"],
                    "Use size preset": ["S\u1eed d\u1ee5ng c\u1ee1 c\u00f3 s\u1eb5n"],
                    "Currently selected font size: %s": ["Hi\u1ec7n t\u1ea1i c\u1ee1 ch\u1eef \u0111\u01b0\u1ee3c ch\u1ecdn: %s"],
                    "Highlights": ["T\u00f4 m\u00e0u ch\u1eef"],
                    "Size of a UI element\u0004Extra Large": ["R\u1ea5t l\u1edbn"],
                    "Size of a UI element\u0004Large": ["L\u1edbn"],
                    "Size of a UI element\u0004Medium": ["Trung b\u00ecnh"],
                    "Size of a UI element\u0004Small": ["Nh\u1ecf"],
                    "Size of a UI element\u0004None": ["Kh\u00f4ng"],
                    "Currently selected: %s": ["Hi\u1ec7n \u0111ang ch\u1ecdn: %s"],
                    "No selection": ["Ch\u01b0a ch\u1ecdn"],
                    "Reset colors": ["\u0110\u1eb7t l\u1ea1i m\u00e0u"],
                    "Reset gradient": ["\u0110\u1eb7t l\u1ea1i d\u1ea3i m\u00e0u"],
                    "Remove all colors": ["X\u00f3a t\u1ea5t c\u1ea3 m\u00e0u"],
                    "Remove all gradients": ["X\u00f3a t\u1ea5t c\u1ea3 d\u1ea3i m\u00e0u"],
                    "Color options": ["Tu\u1ef3 ch\u1ec9nh m\u00e0u s\u1eafc"],
                    "Add color": ["Th\u00eam m\u00e0u s\u1eafc"],
                    "Add gradient": ["Th\u00eam d\u1ea3i m\u00e0u"],
                    "Gradient name": ["T\u00ean d\u1ea3i m\u00e0u"],
                    "Color %s": ["M\u00e0u %s "],
                    "Color format": ["\u0110\u1ecbnh d\u1ea1ng m\u00e0u"],
                    "Hex color": ["M\u00e0u hex"],
                    "Gradient options": ["T\u00f9y ch\u1ec9nh d\u1ea3i m\u00e0u"],
                    "Percent (%)": ["Ph\u1ea7n tr\u0103m (%)"],
                    "Shadows": ["\u0110\u1ed5 b\u00f3ng"],
                    "Picas (pc)": ["Picas (pc)"],
                    "Inches (in)": ["Inches (in)"],
                    "Points (pt)": ["Points (pt)"],
                    "Centimeters (cm)": ["Cen-ti-m\u00e9t (cm)"],
                    "Millimeters (mm)": ["Mi-li-m\u00e9t (mm)"],
                    "Width of the zero (0) character (ch)": ["Chi\u1ec1u r\u1ed9ng c\u1ee7a k\u00fd t\u1ef1 kh\u00f4ng (0) (ch)"],
                    "Duotone: %s": ["Hai t\u00f4ng m\u00e0u: %s"],
                    "Duotone code: %s": ["M\u00e3 hai m\u00e0u: %s"],
                    "Relative to parent font size (em)\u0004ems": ["em"],
                    "Relative to root font size (rem)\u0004rems": ["rem"],
                    "Viewport smallest dimension (vmin)": ["K\u00edch th\u01b0\u1edbc nh\u1ecf nh\u1ea5t c\u1ee7a khung h\u00ecnh (vmin)"],
                    "Viewport largest dimension (vmax)": ["K\u00edch th\u01b0\u1edbc l\u1edbn nh\u1ea5t c\u1ee7a khung h\u00ecnh (vmax)"],
                    "x-height of the font (ex)": ["Chi\u1ec1u cao x c\u1ee7a font (ex)"],
                    "Invalid item": ["M\u1ee5c kh\u00f4ng h\u1ee3p l\u1ec7"],
                    "Border width": ["\u0110\u1ed9 r\u1ed9ng c\u1ee7a vi\u1ec1n"],
                    "Dotted": ["Nhi\u1ec1u d\u1ea5u ch\u1ea5m"],
                    "Dashed": ["V\u1ea1ch li\u1ec1n"],
                    "Pixels (px)": ["Pixel (px)"],
                    "Viewport height (vh)": ["Chi\u1ec1u cao m\u00e0n h\u00ecnh (vh)"],
                    "Viewport width (vw)": ["Chi\u1ec1u r\u1ed9ng m\u00e0n h\u00ecnh (vw)"],
                    "Percentage (%)": ["Ph\u1ea7n tr\u0103m (%)"],
                    "Relative to root font size (rem)": ["T\u01b0\u01a1ng quan \u0111\u1ebfn k\u00edch th\u01b0\u1edbc ph\u00f4ng ch\u1eef g\u1ed1c (rem)"],
                    "Relative to parent font size (em)": ["T\u01b0\u01a1ng quan \u0111\u1ebfn k\u00edch th\u01b0\u1edbc ph\u00f4ng ch\u1eef cha (rem)"],
                    "Vertical": ["Theo chi\u1ec1u d\u1ecdc"],
                    "Horizontal": ["Theo chi\u1ec1u ngang"],
                    "Close search": ["\u0110\u00f3ng t\u00ecm ki\u1ebfm"],
                    "Search in %s": ["T\u00ecm trong %s"],
                    "Select unit": ["Ch\u1ecdn \u0111\u01a1n v\u1ecb"],
                    "Media preview": ["Xem th\u1eed media"],
                    "Remove color": ["X\u00f3a m\u00e0u"],
                    "Color name": ["T\u00ean m\u00e0u"],
                    "Coordinated Universal Time": ["Coordinated Universal Time"],
                    "Radial": ["Radial"],
                    "Linear": ["Linear"],
                    "Reset search": ["T\u00ecm ki\u1ebfm l\u1ea1i"],
                    "Box Control": ["H\u1ed9p \u0111i\u1ec1u khi\u1ec3n"],
                    "Bottom Center": ["Ph\u00eda d\u01b0\u1edbi \u1edf gi\u1eefa"],
                    "Center Right": ["\u1ede gi\u1eefa b\u00ean ph\u1ea3i"],
                    "Center Left": ["\u1ede gi\u1eefa b\u00ean tr\u00e1i"],
                    "Top Center": ["Ph\u00eda tr\u00ean \u1edf gi\u1eefa"],
                    "Alignment Matrix Control": ["Alignment Matrix Control"],
                    "Solid": ["\u0110\u01a1n s\u1eafc"],
                    "Finish": ["K\u1ebft th\u00fac"],
                    "Page %1$d of %2$d": ["Trang %1$d of %2$d"],
                    "Guide controls": ["H\u01b0\u1edbng d\u1eabn \u0111i\u1ec1u khi\u1ec3n"],
                    "Gradient code: %s": ["Gradient code: %s"],
                    "Use your left or right arrow keys or drag and drop with the mouse to change the gradient position. Press the button to change the color or remove the control point.": ["S\u1eed d\u1ee5ng c\u00e1c ph\u00edm m\u0169i t\u00ean tr\u00e1i ho\u1eb7c ph\u1ea3i c\u1ee7a b\u1ea1n ho\u1eb7c k\u00e9o th\u1ea3 b\u1eb1ng chu\u1ed9t \u0111\u1ec3 thay \u0111\u1ed5i v\u1ecb tr\u00ed gradient.  Nh\u1ea5n n\u00fat \u0111\u1ec3 thay \u0111\u1ed5i m\u00e0u s\u1eafc ho\u1eb7c lo\u1ea1i b\u1ecf control point."],
                    "Remove Control Point": ["X\u00f3a b\u1ecf Control Point"],
                    "Gradient: %s": ["Gradient: %s"],
                    "Gradient control point at position %1$s%% with color code %2$s.": ["\u0110i\u1ec3m Gradient control t\u1ea1i v\u1ecb tr\u00ed %%1$s% v\u1edbi m\u00e3 m\u00e0u %2$s."],
                    "Extra Large": ["C\u1ef1c l\u1edbn"],
                    "Small": ["Nh\u1ecf"],
                    "Angle": ["G\u00f3c"],
                    "Separate with commas, spaces, or the Enter key.": ["Ph\u00e2n t\u00e1ch b\u1edfi d\u1ea5u ph\u1ea9y, d\u1ea5u c\u00e1ch ho\u1eb7c ph\u00edm Enter."],
                    "Separate with commas or the Enter key.": ["Ph\u00e2n t\u00e1ch b\u1edfi d\u1ea5u ph\u1ea9y ho\u1eb7c ph\u00edm Enter."],
                    "Copied!": ["\u0110\u00e3 sao ch\u00e9p!"],
                    "%d result found.": ["T\u00ecm th\u1ea5y %d k\u1ebft qu\u1ea3."],
                    "%1$s (%2$s of %3$s)": ["%1$s (%2$s c\u1ee7a %3$s)"],
                    "Remove item": ["Lo\u1ea1i b\u1ecf m\u1ee5c"],
                    "Category": ["Chuy\u00ean m\u1ee5c"],
                    "Oldest to newest": ["C\u0169 nh\u1ea5t \u0111\u1ebfn m\u1edbi nh\u1ea5t"],
                    "Newest to oldest": ["M\u1edbi nh\u1ea5t \u0111\u1ebfn c\u0169 nh\u1ea5t"],
                    "Reset": ["\u0110\u1eb7t l\u1ea1i"],
                    "Z \u2192 A": ["Z \t A"],
                    "A \u2192 Z": ["A \t Z"],
                    "Dismiss this notice": ["T\u1eaft th\u00f4ng b\u00e1o"],
                    "Item removed.": ["\u0110\u00e3 x\u00f3a item."],
                    "Item added.": ["\u0110\u00e3 th\u00eam item."],
                    "Add item": ["Th\u00eam item"],
                    "Order by": ["S\u1eafp x\u1ebfp theo"],
                    "Number of items": ["S\u1ed1 \u0111\u1ed1i t\u01b0\u1ee3ng"],
                    "Color: %s": ["M\u00e0u: %s"],
                    "No results.": ["Kh\u00f4ng c\u00f3 k\u1ebft qu\u1ea3."],
                    "Color code: %s": ["M\u00e3 m\u00e0u: %s"],
                    "PgUp\/PgDn": ["PgUp\/PgDn"],
                    "keyboard button\u0004Enter": ["Enter"],
                    "Left and Right Arrows": ["M\u0169i t\u00ean tr\u00e1i v\u00e0 ph\u1ea3i"],
                    "Click to Select": ["B\u1ea5m \u0111\u1ec3 ch\u1ecdn"],
                    "Click the right or left arrows to select other months in the past or the future.": ["B\u1ea5m m\u0169i t\u00ean ph\u1ea3i ho\u1eb7c tr\u00e1i \u0111\u1ec3 ch\u1ecdn th\u00e1ng kh\u00e1c trong qu\u00e1 kh\u1ee9 ho\u1eb7c t\u01b0\u01a1ng lai."],
                    "Minutes": ["Ph\u00fat"],
                    "(opens in a new tab)": ["(m\u1edf trong c\u1eeda s\u1ed5 m\u1edbi)"],
                    "Move backward (PgUp) or forward (PgDn) by one month.": ["Quay l\u1ea1i (PgUp) ho\u1eb7c ti\u1ebfn v\u1ec1 tr\u01b0\u1edbc (PgDn) m\u1ed9t th\u00e1ng."],
                    "%d result found, use up and down arrow keys to navigate.": ["%d k\u1ebft qu\u1ea3 \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y, s\u1eed d\u1ee5ng ph\u00edm l\u00ean v\u00e0 xu\u1ed1ng \u0111\u1ec3 chuy\u1ec3n \u0111\u1ed5i k\u1ebft qu\u1ea3."],
                    "Navigating with a keyboard": ["Di chuy\u1ec3n v\u1edbi c\u00e1c n\u00fat tr\u00ean b\u00e0n ph\u00edm"],
                    "Home\/End": ["Home\/End"],
                    "Home and End": ["Home v\u00e0 End"],
                    "Page Up and Page Down": ["Page Up v\u00e0 Page Down"],
                    "Select the date in focus.": ["Ch\u1ecdn ng\u00e0y khi focus."],
                    "Calendar Help": ["H\u1ed7 tr\u1ee3 d\u00f9ng l\u1ecbch"],
                    "Click the desired day to select it.": ["Ch\u1ecdn m\u1ed9t ng\u00e0y."],
                    "Up and Down Arrows": ["M\u0169i t\u00ean l\u00ean v\u00e0 xu\u1ed1ng"],
                    "Move backward (up) or forward (down) by one week.": ["Chuy\u1ec3n l\u00ean xu\u1ed1ng \u0111\u1ec3 \u0111\u1ed5i tu\u1ea7n."],
                    "Move backward (left) or forward (right) by one day.": ["Chuy\u1ec3n tr\u00e1i ph\u1ea3i \u0111\u1ec3 \u0111\u1ed5i ng\u00e0y."],
                    "Go to the first (Home) or last (End) day of a week.": ["\u0110\u1ebfn ng\u00e0y \u0111\u1ea7u ti\u00ean (Trang ch\u1ee7) ho\u1eb7c cu\u1ed1i c\u00f9ng (Cu\u1ed1i) trong m\u1ed9t tu\u1ea7n."],
                    "Custom color picker.": ["B\u1ed9 ch\u1ecdn m\u00e0u t\u00f9y ch\u1ec9nh."],
                    "Month": ["Th\u00e1ng"],
                    "Day": ["Ban ng\u00e0y"],
                    "Time": ["Th\u1eddi gian"],
                    "Date": ["Th\u1eddi gian"],
                    "Hours": ["Gi\u1edd"],
                    "Item selected.": ["M\u1ee5c \u0111\u01b0\u1ee3c ch\u1ecdn."],
                    "Previous": ["Quay v\u1ec1"],
                    "Border color": ["M\u00e0u vi\u1ec1n"],
                    "Year": ["N\u0103m"],
                    "Custom Size": ["T\u00f9y ch\u1ec9nh k\u00edch th\u01b0\u1edbc"],
                    "Back": ["Tr\u1edf l\u1ea1i"],
                    "Style": ["Style"],
                    "Tools": ["C\u00f4ng c\u1ee5"],
                    "Large": ["L\u1edbn"],
                    "Drop files to upload": ["Th\u1ea3 c\u00e1c t\u1eadp tin \u0111\u1ec3 t\u1ea3i l\u00ean"],
                    "Clear": ["X\u00f3a"],
                    "Mixed": ["Mixed"],
                    "Custom": ["T\u00f9y ch\u1ec9nh"],
                    "Calendar": ["L\u1ecbch"],
                    "Copy": ["Sao ch\u00e9p"],
                    "Top": ["Tr\u00ean"],
                    "Bottom": ["D\u01b0\u1edbi"],
                    "Type": ["\u0110\u1ecbnh d\u1ea1ng"],
                    "Top Left": ["Tr\u00ean b\u00ean tr\u00e1i"],
                    "Top Right": ["Tr\u00ean b\u00ean ph\u1ea3i"],
                    "Bottom Left": ["D\u01b0\u1edbi b\u00ean tr\u00e1i"],
                    "Bottom Right": ["D\u01b0\u1edbi b\u00ean ph\u1ea3i"],
                    "AM": ["S\u00e1ng"],
                    "PM": ["Chi\u1ec1u"],
                    "Next": ["Ti\u1ebfp theo"],
                    "Font size": ["C\u1ee1 ch\u1eef"],
                    "Default": ["M\u1eb7c \u0111\u1ecbnh"],
                    "All": ["T\u1ea5t c\u1ea3"],
                    "No results found.": ["Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3."],
                    "Categories": ["Chuy\u00ean m\u1ee5c"],
                    "Author": ["T\u00e1c gi\u1ea3"],
                    "Done": ["Ho\u00e0n th\u00e0nh"],
                    "Left": ["Tr\u00e1i"],
                    "Center": ["Ch\u00ednh gi\u1eefa"],
                    "Right": ["Ph\u1ea3i"],
                    "Medium": ["Trung b\u00ecnh"],
                    "Size": ["K\u00edch c\u1ee1"],
                    "Cancel": ["H\u1ee7y"],
                    "Search": ["T\u00ecm ki\u1ebfm"],
                    "Close": ["\u0110\u00f3ng"],
                    "OK": ["Ok"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/components.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/components.min.js?ver=bf6e0ec3089253604b52'
            id='wp-components-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/navigation/index.js?ver=7.9.0'
            id='wc-navigation-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/tracks/index.js?ver=7.9.0'
            id='wc-tracks-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/autop.min.js?ver=43197d709df445ccf849'
            id='wp-autop-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/blob.min.js?ver=e7b4ea96175a89b263e2'
            id='wp-blob-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/block-serialization-default-parser.min.js?ver=30ffd7e7e199f10b2a6d'
            id='wp-block-serialization-default-parser-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/shortcode.min.js?ver=7539044b04e6bca57f2e'
            id='wp-shortcode-js'></script>
    <script id='wp-blocks-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "%1$s Block. Row %2$d": ["Block %1$s. H\u00e0ng %2$d"],
                    "Design": ["Thi\u1ebft k\u1ebf"],
                    "%1$s Block. %2$s": ["%1$s Khu\u00f4n. %2$s"],
                    "%1$s Block. Row %2$d. %3$s": ["%1$s Khu\u00f4n. H\u00e0ng %2$d. %3$s"],
                    "%s Block": ["%s block"],
                    "%1$s Block. Column %2$d. %3$s": ["%1$s block. C\u1ed9t %2$d. %3$s"],
                    "%1$s Block. Column %2$d": ["%1$s Block. C\u1ed9t %2$d"],
                    "Embeds": ["Nh\u00fang"],
                    "Reusable blocks": ["Block t\u00e1i s\u1eed d\u1ee5ng"],
                    "Text": ["V\u0103n b\u1ea3n"],
                    "Widgets": ["Widget"],
                    "Theme": ["%d giao di\u1ec7n"],
                    "Media": ["Media"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/blocks.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/blocks.min.js?ver=639e14271099dc3d85bf'
            id='wp-blocks-js'></script>
    <script id='wp-core-data-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Global Styles": ["Phong c\u00e1ch to\u00e0n c\u1ee5c"],
                    "Widget types": ["C\u00e1c ki\u1ec3u widget"],
                    "Menu Item": ["M\u1ee5c Menu"],
                    "Comment": ["B\u00ecnh lu\u1eadn"],
                    "Widget areas": ["Khu v\u1ef1c widget"],
                    "Site": ["Site"],
                    "Taxonomy": ["Ph\u00e2n lo\u1ea1i"],
                    "Post Type": ["Lo\u1ea1i B\u00e0i vi\u1ebft"],
                    "Menu Location": ["V\u1ecb tr\u00ed tr\u00ecnh \u0111\u01a1n"],
                    "Menu": ["Menu"],
                    "User": ["Ng\u01b0\u1eddi d\u00f9ng"],
                    "Base": ["C\u01a1 b\u1ea3n"],
                    "Widgets": ["Widget"],
                    "Themes": ["Giao di\u1ec7n"],
                    "Site Title": ["T\u00ean website"],
                    "(no title)": ["(kh\u00f4ng c\u00f3 ti\u00eau \u0111\u1ec1)"],
                    "Plugins": ["Plugin"],
                    "Media": ["Media"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/core-data.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/core-data.min.js?ver=fc0de6bb17aa25caf698'
            id='wp-core-data-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/data-controls.min.js?ver=e10d473d392daa8501e8'
            id='wp-data-controls-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/data/index.js?ver=7.9.0'
            id='wc-store-data-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/keyboard-shortcuts.min.js?ver=b696c16720133edfc065'
            id='wp-keyboard-shortcuts-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/notices.min.js?ver=9c1575b7a31659f45a45'
            id='wp-notices-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/preferences-persistence.min.js?ver=c5543628aa7ff5bd5be4'
            id='wp-preferences-persistence-js'></script>
    <script id='wp-preferences-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Preference deactivated - %s": ["T\u1eaft k\u00edch ho\u1ea1t \u01b0u ti\u00ean - %s"],
                    "Preference activated - %s": ["K\u00edch ho\u1ea1t \u01b0u ti\u00ean - %s"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/preferences.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/preferences.min.js?ver=c66e137a7e588dab54c3'
            id='wp-preferences-js'></script>
    <script id='wp-preferences-js-after'>
        (function () {
            var serverData = {
                "core\/edit-post": {
                    "isComplementaryAreaVisible": true,
                    "welcomeGuide": false,
                    "openPanels": ["post-status", "taxonomy-panel-post_tag", "featured-image", "post-excerpt", "discussion-panel"]
                }, "_modified": "2023-07-08T04:14:42.988Z", "core\/edit-site": {"welcomeGuide": false}
            };
            var userId = "1";
            var persistenceLayer = wp.preferencesPersistence.__unstableCreatePersistenceLayer(serverData, userId);
            var preferencesStore = wp.preferences.store;
            wp.data.dispatch(preferencesStore).setPersistenceLayer(persistenceLayer);
        })();
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/style-engine.min.js?ver=528e6cf281ffc9b7bd3c'
            id='wp-style-engine-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/token-list.min.js?ver=f2cf0bb3ae80de227e43'
            id='wp-token-list-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/wordcount.min.js?ver=feb9569307aec24292f2'
            id='wp-wordcount-js'></script>
    <script id='wp-block-editor-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {"domain": "messages", "plural-forms": "nplurals=1; plural=0;", "lang": "vi_VN"},
                    "Uncategorized": ["Ch\u01b0a ph\u00e2n lo\u1ea1i"],
                    "Now": ["B\u00e2y gi\u1edd"],
                    "View options": ["Xem t\u00f9y ch\u1ecdn"],
                    "Modify": ["Ch\u1ec9nh s\u1eeda"],
                    "short date format without the year\u0004M j": ["M j"],
                    "Restrict editing": ["H\u1ea1n ch\u1ebf ch\u1ec9nh s\u1eeda"],
                    "Copy block": ["Sao ch\u00e9p kh\u1ed1i"],
                    "Copy blocks": ["Sao ch\u00e9p kh\u1ed1i"],
                    "Font": ["Font ch\u1eef"],
                    "Custom (%s)": ["T\u00f9y ch\u1ec9nh (%s)"],
                    "All sides": ["T\u1ea5t c\u1ea3 c\u00e1c m\u1eb7t"],
                    "Unlink sides": ["B\u1ecf li\u00ean k\u1ebft sides"],
                    "Link sides": ["Li\u00ean k\u1ebft sides"],
                    "Use featured image": ["D\u00f9ng \u1ea3nh minh h\u1ecda"],
                    "Link is empty": ["Li\u00ean k\u1ebft tr\u1ed1ng"],
                    "Enter your own date format": ["Nh\u1eadp \u0111\u1ecbnh d\u1ea1ng c\u1ee7a b\u1ea1n"],
                    "Choose a format": ["Ch\u1ecdn \u0111\u1ecbnh d\u1ea1ng"],
                    "Enter a date or time <Link>format string<\/Link>.": ["Nh\u1eadp ng\u00e0y ho\u1eb7c gi\u1edd <Link>\u0111\u1ecbnh d\u1ea1ng<\/Link>."],
                    "https:\/\/wordpress.org\/support\/article\/formatting-date-and-time\/": ["https:\/\/wordpress.org\/support\/article\/formatting-date-and-time\/"],
                    "Delete selection.": ["X\u00f3a l\u1ef1a ch\u1ecdn."],
                    "Custom format": ["\u0110\u1ecbnh d\u1ea1ng ri\u00eang"],
                    "Date format": ["\u0110\u1ecbnh d\u1ea1ng ng\u00e0y th\u00e1ng"],
                    "Options for %s block": ["T\u00f9y ch\u1ecdn kh\u1ed1i %s"],
                    "Transparent text may be hard for people to read.": ["Ch\u1eef trong su\u1ed1t c\u00f3 th\u1ec3 g\u00e2y kh\u00f3 \u0111\u1ecdc."],
                    "%s deselected.": ["\u0110\u00e3 b\u1ecf ch\u1ecdn %s."],
                    "%s blocks deselected.": ["\u0110\u00e3 b\u1ecf ch\u1ecdn %s kh\u1ed1i."],
                    "%s link": ["%s li\u00ean k\u1ebft"],
                    "Default format": ["\u0110\u1ecbnh d\u1ea1ng m\u1eb7c \u0111\u1ecbnh"],
                    "short date format\u0004n\/j\/Y": ["n\/j\/Y"],
                    "short date format with time\u0004n\/j\/Y g:i A": ["n\/j\/Y g:i A"],
                    "medium date format\u0004M j, Y": ["M j, Y"],
                    "medium date format with time\u0004M j, Y g:i A": ["M j, Y g:i A"],
                    "long date format\u0004F j, Y": ["F j, Y"],
                    "%s link (locked)": ["%s li\u00ean k\u1ebft (\u0111\u00e3 kh\u00f3a)"],
                    "Transform to %s": ["Chuy\u1ec3n th\u00e0nh %s"],
                    "Add default block": ["Th\u00eam m\u1eb7c \u0111\u1ecbnh kh\u1ed1i"],
                    "Lock %s": ["Kh\u00f3a %s"],
                    "Choose specific attributes to restrict or lock all available options.": ["Ch\u1ecdn c\u00e1c thu\u1ed9c t\u00ednh c\u1ee5 th\u1ec3 \u0111\u1ec3 h\u1ea1n ch\u1ebf ho\u1eb7c kh\u00f3a t\u1ea5t c\u1ea3 c\u00e1c t\u00f9y ch\u1ecdn c\u00f3 s\u1eb5n."],
                    "Lock all": ["Kh\u00f3a to\u00e0n b\u1ed9"],
                    "Disable movement": ["T\u1eaft di chuy\u1ec3n"],
                    "Prevent removal": ["Ng\u0103n ch\u1eb7n x\u00f3a"],
                    "Unlock": ["M\u1edf kh\u00f3a"],
                    "Lock": ["Kh\u00f3a"],
                    "Unlock %s": ["M\u1edf kh\u00f3a %s"],
                    "Unwrap": ["M\u1edf ra"],
                    "Align items top": ["C\u0103n m\u1ee5c \u1edf tr\u00ean"],
                    "Align items center": ["C\u0103n m\u1ee5c \u1edf gi\u1eefa"],
                    "Align items bottom": ["C\u0103n m\u1ee5c \u1edf d\u01b0\u1edbi"],
                    "Vertical alignment": ["C\u0103n chi\u1ec1u d\u1ecdc"],
                    "Alignment option\u0004None": ["Kh\u00f4ng"],
                    "Select parent block (%s)": ["Ch\u1ecdn m\u1eabu kh\u1ed1i (%s)"],
                    "single horizontal line\u0004Row": ["H\u00e0ng"],
                    "verb\u0004Stack": ["X\u1ebfp ch\u1ed3ng"],
                    "Add pattern": ["Th\u00eam m\u1eabu"],
                    "font weight\u0004Black": ["\u0110en"],
                    "font weight\u0004Extra Bold": ["R\u1ea5t \u0111\u1eadm"],
                    "font weight\u0004Bold": ["\u0110\u1eadm"],
                    "font weight\u0004Semi Bold": ["\u0110\u1eadm v\u1eeba"],
                    "font weight\u0004Medium": ["Trung b\u00ecnh"],
                    "font weight\u0004Regular": ["B\u00ecnh th\u01b0\u1eddng"],
                    "font weight\u0004Extra Light": ["R\u1ea5t m\u1ea3nh"],
                    "font weight\u0004Light": ["M\u1ea3nh"],
                    "font weight\u0004Thin": ["M\u1ea3nh"],
                    "font style\u0004Italic": ["Nghi\u00eang"],
                    "font style\u0004Regular": ["B\u00ecnh th\u01b0\u1eddng"],
                    "Set custom size": ["\u0110\u1eb7t c\u1ee1 ri\u00eang"],
                    "Use size preset": ["S\u1eed d\u1ee5ng c\u1ee1 c\u00f3 s\u1eb5n"],
                    "link color": ["m\u00e0u li\u00ean k\u1ebft"],
                    "Navigate to the previous view": ["\u0110i\u1ec1u h\u01b0\u1edbng t\u1edbi xem tr\u01b0\u1edbc"],
                    "Transform": ["Chuy\u1ec3n \u0111\u1ed5i"],
                    "Block spacing": ["Kho\u1ea3ng c\u00e1ch kh\u1ed1i"],
                    "Letter spacing": ["Gi\u00e3n c\u00e1ch k\u00fd t\u1ef1"],
                    "Explore all patterns": ["Kh\u00e1m ph\u00e1 t\u1ea5t c\u1ea3 m\u1eabu"],
                    "%1$d pattern found for \"%2$s\"": ["T\u00ecm th\u1ea5y %1$d m\u1eabu cho \"%2$s\""],
                    "https:\/\/wordpress.org\/support\/article\/page-jumps\/": ["https:\/\/wordpress.org\/support\/article\/page-jumps\/"],
                    "Bottom right": ["Ph\u00eda d\u01b0\u1edbi b\u00ean ph\u1ea3i "],
                    "Bottom left": ["Ph\u00eda d\u01b0\u1edbi b\u00ean tr\u00e1i "],
                    "Top right": ["Ph\u00eda tr\u00ean b\u00ean ph\u1ea3i "],
                    "Indicates this palette comes from the theme.\u0004Custom": ["T\u00f9y ch\u1ec9nh"],
                    "Orientation": ["\u0110\u1ecbnh h\u01b0\u1edbng "],
                    "Top left": ["G\u00f3c tr\u00ean b\u00ean tr\u00e1i"],
                    "Radius": ["B\u00e1n k\u00ednh"],
                    "Flex": ["Flex"],
                    "Flow": ["D\u00f2ng ch\u1ea3y"],
                    "Justification": ["C\u0103n l\u1ec1"],
                    "No selected font appearance": ["Ch\u01b0a ch\u1ecdn giao di\u1ec7n ph\u00f4ng ch\u1eef"],
                    "Currently selected font weight: %s": ["Ki\u1ec3u ch\u1eef \u0111ang \u0111\u01b0\u1ee3c ch\u1ecdn: %s"],
                    "Currently selected font style: %s": ["Ki\u1ec3u ch\u1eef \u0111ang \u0111\u01b0\u1ee3c ch\u1ecdn: %s"],
                    "Currently selected font appearance: %s": ["C\u1ee1 ch\u1eef \u0111ang \u0111\u01b0\u1ee3c ch\u1ecdn: %s"],
                    "Max %s wide": ["R\u1ed9ng t\u1ed1i \u0111a %s"],
                    "Allow to wrap to multiple lines": ["Cho ph\u00e9p b\u1ecdc th\u00e0nh nhi\u1ec1u d\u00f2ng"],
                    "Remove %s": ["X\u00f3a %s"],
                    "Create a two-tone color effect without losing your original image.": ["T\u1ea1o hi\u1ec7u \u1ee9ng hai t\u00f4ng m\u00e0u m\u00e0 kh\u00f4ng l\u00e0m m\u1ea5t h\u00ecnh \u1ea3nh g\u1ed1c c\u1ee7a b\u1ea1n."],
                    "Displays more block tools": ["Nhi\u1ec1u h\u01a1n"],
                    "Indicates this palette is created by the user.\u0004Custom": ["T\u00f9y ch\u1ec9nh"],
                    "Indicates this palette comes from WordPress.\u0004Default": ["M\u1eb7c \u0111\u1ecbnh"],
                    "Indicates this palette comes from the theme.\u0004Theme": ["Giao di\u1ec7n"],
                    "Tools provide different interactions for selecting, navigating, and editing blocks. Toggle between select and edit by pressing Escape and Enter.": ["C\u00e1c c\u00f4ng c\u1ee5 cung c\u1ea5p c\u00e1c t\u01b0\u01a1ng t\u00e1c kh\u00e1c nhau \u0111\u1ec3 ch\u1ecdn, di chuy\u1ec3n v\u00e0 ch\u1ec9nh s\u1eeda c\u00e1c kh\u1ed1i. Chuy\u1ec3n \u0111\u1ed5i gi\u1eefa ch\u1ecdn v\u00e0 ch\u1ec9nh s\u1eeda b\u1eb1ng c\u00e1ch nh\u1ea5n Escape v\u00e0 Enter."],
                    "Choose": ["Ch\u1ecdn"],
                    "Select %s": ["Ch\u1ecdn %s"],
                    "Layout": ["B\u1ed1 c\u1ee5c"],
                    "Apply duotone filter": ["\u00c1p d\u1ee5ng l\u1ecdc hai m\u00e0u"],
                    "Duotone": ["Hai m\u00e0u"],
                    "Margin": ["Margin"],
                    "Justify items center": ["C\u0103n c\u00e1c m\u1ee5c \u1edf gi\u1eefa"],
                    "Justify items right": ["C\u0103n c\u00e1c m\u1ee5c sang ph\u1ea3i"],
                    "Justify items left": ["C\u0103n c\u00e1c m\u1ee5c b\u00ean tr\u00e1i"],
                    "Next pattern": ["M\u1eabu ti\u1ebfp theo"],
                    "Previous pattern": ["M\u1eabu tr\u01b0\u1edbc"],
                    "Patterns list": ["Danh s\u00e1ch m\u1eabu"],
                    "Customize the width for all elements that are assigned to the center or wide columns.": ["T\u00f9y ch\u1ec9nh chi\u1ec1u r\u1ed9ng cho t\u1ea5t c\u1ea3 c\u00e1c ph\u1ea7n t\u1eed \u0111\u01b0\u1ee3c g\u00e1n cho c\u00e1c c\u1ed9t \u1edf gi\u1eefa ho\u1eb7c c\u1ed9t r\u1ed9ng."],
                    "Wide": ["R\u1ed9ng"],
                    "Carousel view": ["Ch\u1ebf \u0111\u1ed9 xem slide"],
                    "Type \/ to choose a block": ["G\u00f5 \/ \u0111\u1ec3 ch\u1ecdn block"],
                    "Search for blocks and patterns": ["T\u00ecm ki\u1ebfm c\u00e1c block v\u00e0 m\u1eabu"],
                    "Use left and right arrow keys to move through blocks": ["S\u1eed d\u1ee5ng ph\u00edm tr\u00e1i v\u00e0 ph\u1ea3i \u0111\u1ec3 di chuy\u1ec3n gi\u1eefa c\u00e1c block"],
                    "Space between items": ["Kho\u1ea3ng c\u00e1ch gi\u1eefa c\u00e1c m\u1ee5c"],
                    "Vertical": ["Theo chi\u1ec1u d\u1ecdc"],
                    "Horizontal": ["Theo chi\u1ec1u ngang"],
                    "Manage Reusable blocks": ["Qu\u1ea3n l\u00fd block t\u00e1i s\u1eed d\u1ee5ng"],
                    "Change items justification": ["\u0110\u1ed5i c\u0103n l\u1ec1 m\u1ee5c"],
                    "More": ["Th\u00eam"],
                    "Editor canvas": ["Tr\u00ecnh ch\u1ec9nh s\u1eeda canvas"],
                    "Block vertical alignment setting\u0004Align middle": ["C\u0103n gi\u1eefa"],
                    "Block vertical alignment setting\u0004Align bottom": ["C\u0103n d\u01b0\u1edbi"],
                    "Block vertical alignment setting\u0004Align top": ["C\u0103n tr\u00ean"],
                    "Transform to variation": ["Chuy\u1ec3n th\u00e0nh bi\u1ebfn th\u1ec3"],
                    "Drag": ["K\u00e9o"],
                    "Block Patterns": ["M\u1eabu block"],
                    "Font weight": ["\u0110\u1ed9 d\u00e0y ph\u00f4ng ch\u1eef"],
                    "Toggle full height": ["B\u1eadt chi\u1ec1u cao \u0111\u1ea7y \u0111\u1ee7"],
                    "Font style": ["Ki\u1ec3u ch\u1eef"],
                    "Letter case": ["Vi\u1ebft hoa ch\u1eef c\u00e1i"],
                    "Lowercase": ["Vi\u1ebft th\u01b0\u1eddng"],
                    "Uppercase": ["Vi\u1ebft in hoa"],
                    "Capitalize": ["Vi\u1ebft hoa ch\u1eef c\u00e1i \u0111\u1ea7u"],
                    "Add an anchor": ["Th\u00eam \u0111i\u1ec3m neo li\u00ean k\u1ebft"],
                    "Decoration": ["Trang tr\u00ed"],
                    "Appearance": ["Giao di\u1ec7n"],
                    "Create: <mark>%s<\/mark>": ["T\u1ea1o: <mark>%s<\/mark>"],
                    "Search for patterns": ["T\u00ecm m\u1eabu"],
                    "Block pattern \"%s\" inserted.": ["M\u1eabu block \"%s\" \u0111\u00e3 \u0111\u01b0\u1ee3c th\u00eam."],
                    "Remove blocks": ["X\u00f3a block"],
                    "Rotate": ["Xoay \u1ea3nh"],
                    "Zoom": ["Ph\u00f3ng to"],
                    "Could not edit image. %s": ["Kh\u00f4ng th\u1ec3 s\u1eeda \u1ea3nh. %s"],
                    "2:3": ["2:3"],
                    "3:4": ["3:4"],
                    "9:16": ["9:16"],
                    "10:16": ["10:16"],
                    "3:2": ["3:2"],
                    "4:3": ["4:3"],
                    "16:9": ["16:9"],
                    "16:10": ["16:10"],
                    "Portrait": ["Ch\u00e2n dung"],
                    "Aspect Ratio": ["T\u1ef7 l\u1ec7 khung h\u00ecnh"],
                    "Landscape": ["C\u1ea3nh g\u00f3c r\u1ed9ng"],
                    "Tablet": ["Tablet"],
                    "Desktop": ["M\u00e1y t\u00ednh"],
                    "Mobile": ["Di \u0111\u1ed9ng"],
                    "Creating": ["T\u1ea1o ra"],
                    "An unknown error occurred during creation. Please try again.": ["\u0110\u00e3 x\u1ea3y ra l\u1ed7i kh\u00f4ng x\u00e1c \u0111\u1ecbnh trong qu\u00e1 tr\u00ecnh t\u1ea1o. Vui l\u00f2ng th\u1eed l\u1ea1i."],
                    "Current media URL:": ["URL media hi\u1ec7n t\u1ea1i:"],
                    "Move the selected block(s) down.": ["Di chuy\u1ec3n c\u00e1c block \u0111\u00e3 ch\u1ecdn xu\u1ed1ng."],
                    "Move the selected block(s) up.": ["Di chuy\u1ec3n c\u00e1c block \u0111\u00e3 ch\u1ecdn l\u00ean."],
                    "Block variations": ["Bi\u1ebfn th\u1ec3 block"],
                    "Image size presets": ["K\u00edch th\u01b0\u1edbc \u1ea3nh"],
                    "Move to": ["Di chuy\u1ec3n t\u1edbi"],
                    "Browse all": ["Xem t\u1ea5t c\u1ea3"],
                    "A tip for using the block editor": ["M\u1eb9o s\u1eed d\u1ee5ng tr\u00ecnh ch\u1ec9nh s\u1eeda block."],
                    "%d block added.": ["%d block \u0111\u00e3 \u0111\u01b0\u1ee3c th\u00eam v\u00e0o."],
                    "Use the Tab key and Arrow keys to choose new block location. Use Left and Right Arrow keys to move between nesting levels. Once location is selected press Enter or Space to move the block.": ["S\u1eed d\u1ee5ng ph\u00edm Tab v\u00e0 ph\u00edm M\u0169i t\u00ean \u0111\u1ec3 ch\u1ecdn v\u1ecb tr\u00ed c\u1ee7a block m\u1edbi. S\u1eed d\u1ee5ng c\u00e1c ph\u00edm M\u0169i t\u00ean Tr\u00e1i v\u00e0 Ph\u1ea3i \u0111\u1ec3 di chuy\u1ec3n gi\u1eefa c\u00e1c c\u1ea5p \u0111\u1ed9 l\u1ed3ng v\u00e0o nhau. Khi v\u1ecb tr\u00ed \u0111\u01b0\u1ee3c ch\u1ecdn, nh\u1ea5n Enter ho\u1eb7c D\u1ea5u c\u00e1ch \u0111\u1ec3 di chuy\u1ec3n block."],
                    "Moved \"%s\" to clipboard.": ["\u0110\u00e3 chuy\u1ec3n \"%s\" v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m."],
                    "Copied \"%s\" to clipboard.": ["\u0110\u00e3 sao ch\u00e9p \"%s\" v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m."],
                    "Patterns": ["M\u1eabu"],
                    "Block navigation structure": ["C\u1ea5u tr\u00fac \u0111i\u1ec1u h\u01b0\u1edbng block"],
                    "Block %1$d of %2$d, Level %3$d": ["Block %1$d c\u1ee7a %2$d, Level %3$d"],
                    "Moved %d block to clipboard.": ["\u0110\u00e3 chuy\u1ec3n %d block v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m."],
                    "Copied %d block to clipboard.": ["\u0110\u00e3 sao ch\u00e9p %d block v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m."],
                    "Browse all. This will open the main inserter panel in the editor toolbar.": ["Xem t\u1ea5t c\u1ea3. Thao t\u00e1c n\u00e0y s\u1ebd m\u1edf b\u1ea3ng ch\u00e8n trong thanh c\u00f4ng c\u1ee5 c\u1ee7a tr\u00ecnh ch\u1ec9nh s\u1eeda."],
                    "You are currently in navigation mode. Navigate blocks using the Tab key and Arrow keys. Use Left and Right Arrow keys to move between nesting levels. To exit navigation mode and edit the selected block, press Enter.": ["B\u1ea1n hi\u1ec7n \u0111ang \u1edf ch\u1ebf \u0111\u1ed9 \u0111i\u1ec1u h\u01b0\u1edbng. \u0110i\u1ec1u h\u01b0\u1edbng c\u00e1c block b\u1eb1ng ph\u00edm Tab v\u00e0 c\u00e1c ph\u00edm M\u0169i t\u00ean. S\u1eed d\u1ee5ng c\u00e1c ph\u00edm M\u0169i t\u00ean Tr\u00e1i v\u00e0 Ph\u1ea3i \u0111\u1ec3 di chuy\u1ec3n gi\u1eefa c\u00e1c c\u1ea5p \u0111\u1ed9 l\u1ed3ng v\u00e0o nhau. \u0110\u1ec3 tho\u00e1t kh\u1ecfi ch\u1ebf \u0111\u1ed9 \u0111i\u1ec1u h\u01b0\u1edbng v\u00e0 ch\u1ec9nh s\u1eeda block \u0111\u00e3 ch\u1ecdn, nh\u1ea5n Enter."],
                    "Open Colors Selector": ["M\u1edf B\u1ed9 Ch\u1ecdn m\u00e0u"],
                    "Line height": ["Chi\u1ec1u cao c\u1ee7a d\u00f2ng"],
                    "Typography": ["Ki\u1ec3u ch\u1eef"],
                    "Padding": ["Padding"],
                    "Change a block's type by pressing the block icon on the toolbar.": ["Thay \u0111\u1ed5i lo\u1ea1i block b\u1eb1ng c\u00e1ch nh\u1ea5n v\u00e0o bi\u1ec3u t\u01b0\u1ee3ng block tr\u00ean thanh c\u00f4ng c\u1ee5."],
                    "Change matrix alignment": ["Thay \u0111\u1ed5i c\u0103n ch\u1ec9nh ma tr\u1eadn"],
                    "Drag files into the editor to automatically insert media blocks.": ["K\u00e9o file v\u00e0o tr\u00ecnh ch\u1ec9nh s\u1eeda \u0111\u1ec3 t\u1ef1 \u0111\u1ed9ng ch\u00e8n c\u00e1c block media."],
                    "Outdent a list by pressing <kbd>backspace<\/kbd> at the beginning of a line.": ["Th\u00eam danh s\u00e1ch b\u1eb1ng c\u00e1ch nh\u1ea5n <kbd>backspace<\/kbd> \u1edf \u0111\u1ea7u d\u00f2ng."],
                    "Indent a list by pressing <kbd>space<\/kbd> at the beginning of a line.": ["Th\u1ee5t l\u1ec1 danh s\u00e1ch b\u1eb1ng c\u00e1ch nh\u1ea5n <kbd>d\u1ea5u c\u00e1ch<\/kbd> \u1edf \u0111\u1ea7u d\u00f2ng."],
                    "Block %1$s is at the beginning of the content and can\u2019t be moved left": ["Block %1$s n\u00e0y \u0111ang n\u1eb1m \u1edf ph\u1ea7n \u0111\u1ea7u c\u1ee7a n\u1ed9i d\u1ee5ng v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n sang tr\u00e1i"],
                    "Block %1$s is at the beginning of the content and can\u2019t be moved up": ["Kh\u1ed1i %1$s l\u00e0 kh\u1ed1i \u0111\u1ea7u ti\u00ean v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n l\u00ean tr\u00ean n\u1eefa"],
                    "Block %1$s is at the end of the content and can\u2019t be moved left": ["Block %1$s \u0111ang n\u1eb1m \u1edf ph\u1ea7n cu\u1ed1i c\u1ee7a n\u1ed9i dung v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n sang tr\u00e1i"],
                    "Block %1$s is at the end of the content and can\u2019t be moved down": ["Block %1$s \u0111ang n\u1eb1m \u1edf ph\u1ea7n \u0111\u1ea7u c\u1ee7a n\u1ed9i dung v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n xu\u1ed1ng d\u01b0\u1edbi n\u1eefa"],
                    "Move %1$s block from position %2$d right to position %3$d": ["Di chuy\u1ec3n khu\u00f4n %1$s t\u1eeb v\u1ecb tr\u00ed %2$d sang v\u1ecb tr\u00ed %3$d"],
                    "Move %1$s block from position %2$d left to position %3$d": ["Di chuy\u1ec3n khu\u00f4n %1$s t\u1eeb v\u1ecb tr\u00ed %2$d sang v\u1ecb tr\u00ed %3$d"],
                    "Toggle between using the same value for all screen sizes or using a unique value per screen size.": ["Chuy\u1ec3n \u0111\u1ed5i gi\u1eefa vi\u1ec7c s\u1eed d\u1ee5ng c\u00f9ng m\u1ed9t gi\u00e1 tr\u1ecb cho t\u1ea5t c\u1ea3 c\u00e1c k\u00edch th\u01b0\u1edbc m\u00e0n h\u00ecnh ho\u1eb7c s\u1eed d\u1ee5ng m\u1ed9t gi\u00e1 tr\u1ecb duy nh\u1ea5t cho m\u1ed7i k\u00edch th\u01b0\u1edbc m\u00e0n h\u00ecnh."],
                    "Use the same %s on all screensizes.": ["S\u1eed d\u1ee5ng c\u00f9ng m\u1ed9t %s tr\u00ean t\u1ea5t c\u1ea3 c\u00e1c k\u00edch th\u01b0\u1edbc m\u00e0n h\u00ecnh."],
                    "Large screens": ["M\u00e0n h\u00ecnh l\u1edbn"],
                    "Medium screens": ["M\u00e0n h\u00ecnh v\u1eeba"],
                    "Small screens": ["M\u00e0n h\u00ecnh nh\u1ecf"],
                    "Text labelling a interface as controlling a given layout property (eg: margin) for a given screen size.\u0004Controls the %1$s property for %2$s viewports.": ["Ki\u1ec3m so\u00e1t t\u00e0i s\u1ea3n %1$s cho ch\u1ebf \u0111\u1ed9 xem %2$s."],
                    "Recently updated": ["C\u1eadp nh\u1eadt g\u1ea7n \u0111\u00e2y"],
                    "Search or type url": ["T\u00ecm ki\u1ebfm ho\u1eb7c g\u00f5 URL"],
                    "Press ENTER to add this link": ["Nh\u1ea5n ENTER \u0111\u1ec3 th\u00eam li\u00ean k\u1ebft n\u00e0y"],
                    "Currently selected link settings": ["C\u00e0i \u0111\u1eb7t li\u00ean k\u1ebft hi\u1ec7n \u0111\u01b0\u1ee3c ch\u1ecdn"],
                    "Open Media Library": ["M\u1edf Th\u01b0 vi\u1ec7n ph\u01b0\u01a1ng ti\u1ec7n"],
                    "The media file has been replaced": ["C\u00e1c t\u1eadp tin ph\u01b0\u01a1ng ti\u1ec7n truy\u1ec1n th\u00f4ng \u0111\u00e3 \u0111\u01b0\u1ee3c thay th\u1ebf"],
                    "Currently selected": ["Hi\u1ec7n \u0111\u01b0\u1ee3c ch\u1ecdn"],
                    "Select a variation to start with.": ["Ch\u1ecdn m\u1ed9t bi\u1ebfn th\u1ec3 \u0111\u1ec3 b\u1eaft \u0111\u1ea7u."],
                    "Choose variation": ["Ch\u1ecdn bi\u1ebfn th\u1ec3"],
                    "directly add the only allowed block\u0004Add %s": ["Th\u00eam %s"],
                    "%s block added": ["%s khu\u00f4n th\u00eam"],
                    "Generic label for block inserter button\u0004Add block": ["Th\u00eam block"],
                    "Image size": ["K\u00edch th\u01b0\u1edbc \u1ea3nh"],
                    "Multiple selected blocks": ["Nhi\u1ec1u khu\u00f4n \u0111\u01b0\u1ee3c ch\u1ecdn"],
                    "You are currently in edit mode. To return to the navigation mode, press Escape.": ["B\u1ea1n hi\u1ec7n \u0111ang \u1edf ch\u1ebf \u0111\u1ed9 ch\u1ec9nh s\u1eeda. \u0110\u1ec3 tr\u1edf v\u1ec1 ch\u1ebf \u0111\u1ed9 \u0111i\u1ec1u h\u01b0\u1edbng, nh\u1ea5n Escape."],
                    "Midnight": ["N\u1eeda \u0111\u00eam"],
                    "Electric grass": ["C\u1ecf \u0111i\u1ec7n t\u1eed"],
                    "Pale ocean": ["\u0110\u1ea1i d\u01b0\u01a1ng nh\u1ea1t"],
                    "Luminous dusk": ["Ho\u00e0ng h\u00f4n r\u1ef1c r\u1ee1"],
                    "Blush bordeaux": ["Blush bordeaux"],
                    "Block breadcrumb": ["Kh\u1ed1i breadcrumb"],
                    "Blush light purple": ["Blush light purple"],
                    "Cool to warm spectrum": ["Quang ph\u1ed5 l\u1ea1nh \u0111\u1ebfn \u1ea5m"],
                    "Vivid cyan blue to vivid purple": ["M\u00e0u xanh lam s\u1ed1ng \u0111\u1ed9ng \u0111\u1ebfn m\u00e0u t\u00edm s\u1ed1ng \u0111\u1ed9ng"],
                    "Light green cyan to vivid green cyan": ["M\u00e0u l\u1ee5c nh\u1ea1t \u0111\u1ebfn l\u1ee5c lam"],
                    "Very light gray to cyan bluish gray": ["X\u00e1m nh\u1ea1t \u0111\u1ebfn x\u00e1m l\u1ee5c"],
                    "Luminous vivid amber to luminous vivid orange": ["N\u00e2u \u0111\u1eadm \u0111\u1ebfn m\u00e0u cam"],
                    "Luminous vivid orange to vivid red": ["T\u1eeb m\u00e0u cam ch\u00f3i \u0111\u1ebfn \u0111\u1ecf ch\u00f3i"],
                    "No Preview Available.": ["Kh\u00f4ng c\u00f3 b\u1ea3n xem tr\u01b0\u1edbc n\u00e0o c\u00f3 s\u1eb5n."],
                    "List view": ["Xem d\u1ea1ng danh s\u00e1ch"],
                    "Grid view": ["Xem d\u1ea1ng l\u01b0\u1edbi"],
                    "Move right": ["Di chuy\u1ec3n sang ph\u1ea3i"],
                    "Move left": ["Di chuy\u1ec3n sang tr\u00e1i"],
                    "Link rel": ["Link rel"],
                    "Fill": ["\u0110i\u1ec1n"],
                    "Border radius": ["G\u00f3c bo tr\u00f2n"],
                    "Open in new tab": ["M\u1edf trong Tab M\u1edbi"],
                    "Separate multiple classes with spaces.": ["Ph\u00e2n c\u00e1ch c\u00e1c class b\u1edfi kho\u1ea3ng tr\u1ed1ng."],
                    "Learn more about anchors": ["T\u00ecm hi\u1ec3u th\u00eam v\u1ec1 \u0111i\u1ec3m neo"],
                    "Enter a word or two \u2014 without spaces \u2014 to make a unique web address just for this block, called an \u201canchor.\u201d Then, you\u2019ll be able to link directly to this section of your page.": ["Nh\u1eadp 1 t\u1eeb ho\u1eb7c hai - kh\u00f4ng bao g\u1ed3m kho\u1ea3ng c\u00e1ch - \u0111\u1ec3 t\u1ea1o \u0111\u1ecba ch\u1ec9 ri\u00eang ch\u1ec9 cho block n\u00e0y, \u0111\u01b0\u1ee3c g\u1ecdi l\u00e0 \"neo\". Sau \u0111\u00f3, b\u1ea1n c\u00f3 th\u1ec3 li\u00ean k\u1ebft tr\u1ef1c ti\u1ebfp v\u1edbi khu v\u1ef1c n\u00e0y trong trang."],
                    "Default Style": ["Ki\u1ec3u m\u1eb7c \u0111\u1ecbnh"],
                    "Upload a video file, pick one from your media library, or add one with a URL.": ["T\u1ea3i l\u00ean video, ch\u1ecdn m\u1ed9t file t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n ho\u1eb7c th\u00eam file t\u1eeb \u0111\u1ecba ch\u1ec9 URL."],
                    "Upload an image file, pick one from your media library, or add one with a URL.": ["T\u1ea3i l\u00ean m\u1ed9t file \u1ea3nh, ch\u1ecdn t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n ho\u1eb7c th\u00eam URL."],
                    "Skip": ["B\u1ecf qua"],
                    "This color combination may be hard for people to read.": ["S\u1ef1 k\u1ebft h\u1ee3p m\u00e0u s\u1eafc n\u00e0y c\u00f3 th\u1ec3 kh\u00f3 \u0111\u1ecdc cho m\u1ecdi ng\u01b0\u1eddi."],
                    "Add a block": ["Th\u00eam block"],
                    "Upload a media file or pick one from your media library.": ["T\u1ea3i l\u00ean file media ho\u1eb7c ch\u1ecdn t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n."],
                    "Upload an audio file, pick one from your media library, or add one with a URL.": ["T\u1ea3i l\u00ean file \u00e2m thanh, ch\u1ecdn m\u1ed9t file t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n ho\u1eb7c th\u00eam URL."],
                    "While writing, you can press <kbd>\/<\/kbd> to quickly insert new blocks.": ["Trong khi vi\u1ebft, b\u1ea1n c\u00f3 th\u1ec3 nh\u1ea5n <kbd>\/<\/kbd> \u0111\u1ec3 nhanh ch\u00f3ng ch\u00e8n c\u00e1c block m\u1edbi."],
                    "Vivid purple": ["M\u00e0u t\u00edm s\u1ed1ng \u0111\u1ed9ng"],
                    "Block vertical alignment setting label\u0004Change vertical alignment": ["Thay \u0111\u1ed5i c\u0103n l\u1ec1 chi\u1ec1u d\u1ecdc"],
                    "verb\u0004Group": ["Nh\u00f3m"],
                    "Ungrouping blocks from within a Group block back into individual blocks within the Editor \u0004Ungroup": ["T\u00e1ch nh\u00f3m"],
                    "block style\u0004Default": ["M\u1eb7c \u0111\u1ecbnh"],
                    "Attempt Block Recovery": ["Kh\u00f4i ph\u1ee5c block"],
                    "%s: Change block type or style": ["%s: \u0110\u1ed5i ki\u1ec3u block ho\u1eb7c style"],
                    "%d word": ["%d t\u1eeb"],
                    "To edit this block, you need permission to upload media.": ["\u0110\u1ec3 ch\u1ec9nh s\u1eeda block n\u00e0y, b\u1ea1n c\u1ea7n c\u00f3 quy\u1ec1n t\u1ea3i l\u00ean th\u01b0 vi\u1ec7n."],
                    "Block tools": ["C\u00e1c c\u00f4ng c\u1ee5 c\u1ee7a Block"],
                    "%s block selected.": ["%s block \u0111\u01b0\u1ee3c ch\u1ecdn."],
                    "Align text right": ["C\u0103n ch\u1ec9nh v\u0103n b\u1ea3n sang ph\u1ea3i"],
                    "Align text center": ["C\u0103n ch\u1ec9nh v\u0103n b\u1ea3n ra gi\u1eefa"],
                    "Align text left": ["C\u0103n ch\u1ec9nh v\u0103n b\u1ea3n sang tr\u00e1i"],
                    "Image dimensions": ["K\u00edch th\u01b0\u1edbc h\u00ecnh \u1ea3nh"],
                    "Heading settings": ["C\u1ea5u h\u00ecnh ti\u00eau \u0111\u1ec1"],
                    "Select all text when typing. Press again to select all blocks.": ["Ch\u1ecdn t\u1ea5t c\u1ea3 v\u0103n b\u1ea3n khi nh\u1eadp. Nh\u1ea5n l\u1ea1i \u0111\u1ec3 ch\u1ecdn t\u1ea5t c\u1ea3 c\u00e1c kh\u1ed1i."],
                    "Remove the selected block(s).": ["Lo\u1ea1i b\u1ecf c\u00e1c kh\u1ed1i \u0111\u00e3 ch\u1ecdn."],
                    "Duplicate the selected block(s).": ["Nh\u00e2n \u0111\u00f4i c\u00e1c kh\u1ed1i \u0111\u00e3 ch\u1ecdn."],
                    "Insert a new block before the selected block(s).": ["Ch\u00e8n m\u1ed9t kh\u1ed1i m\u1edbi tr\u01b0\u1edbc c\u00e1c kh\u1ed1i \u0111\u00e3 ch\u1ecdn."],
                    "Document": ["T\u00e0i li\u1ec7u"],
                    "%d block": ["%d block"],
                    "Navigate to the nearest toolbar.": ["\u0110i\u1ec1u h\u01b0\u1edbng \u0111\u1ebfn thanh c\u00f4ng c\u1ee5 g\u1ea7n nh\u1ea5t."],
                    "Insert a new block after the selected block(s).": ["Ch\u00e8n m\u1ed9t kh\u1ed1i m\u1edbi sau (nh\u1eefng) kh\u1ed1i \u0111\u00e3 ch\u1ecdn"],
                    "Reusable blocks": ["Block t\u00e1i s\u1eed d\u1ee5ng"],
                    "Options": ["T\u00f9y ch\u1ecdn"],
                    "Link settings": ["C\u00e0i \u0111\u1eb7t li\u00ean k\u1ebft"],
                    "Additional CSS class(es)": ["L\u1edbp CSS b\u1ed5 sung"],
                    "font size name\u0004Huge": ["R\u1ea5t l\u1edbn"],
                    "font size name\u0004Large": ["L\u1edbn"],
                    "font size name\u0004Medium": ["Trung b\u00ecnh"],
                    "font size name\u0004Small": ["Nh\u1ecf"],
                    "HTML anchor": ["\u0110i\u1ec3m neo HTML"],
                    "Cyan bluish gray": ["Cyan bluish gray"],
                    "Vivid cyan blue": ["Vivid cyan blue"],
                    "Pale cyan blue": ["Pale cyan blue"],
                    "Vivid green cyan": ["Vivid green cyan"],
                    "Light green cyan": ["Light green cyan"],
                    "Luminous vivid amber": ["Luminous vivid amber"],
                    "Luminous vivid orange": ["Luminous vivid orange"],
                    "Vivid red": ["Vivid red"],
                    "Pale pink": ["Pale pink"],
                    "Skip to the selected block": ["Chuy\u1ec3n \u0111\u1ebfn block \u0111\u00e3 ch\u1ecdn"],
                    "Transform to": ["Chuy\u1ec3n sang:"],
                    "Edit visually": ["Ch\u1ec9nh s\u1eeda tr\u1ef1c quan"],
                    "Reusable": ["C\u00f3 th\u1ec3 t\u00e1i s\u1eed d\u1ee5ng"],
                    "Insert after": ["Ch\u00e8n sau"],
                    "Insert before": ["Ch\u00e8n tr\u01b0\u1edbc"],
                    "Change type of %d block": ["Thay \u0111\u1ed5i lo\u1ea1i c\u1ee7a kh\u1ed1i %d"],
                    "More options": ["Th\u00eam t\u00f9y ch\u1ecdn"],
                    "blocks\u0004Most used": ["S\u1eed d\u1ee5ng nhi\u1ec1u"],
                    "Duplicate": ["Nh\u00e2n b\u1ea3n"],
                    "Edit as HTML": ["S\u1eeda nh\u01b0 l\u00e0 HTML"],
                    "Paste or type URL": ["D\u00e1n ho\u1eb7c nh\u1eadp \u0111\u1ecba ch\u1ec9 URL"],
                    "%d result found.": ["T\u00ecm th\u1ea5y %d k\u1ebft qu\u1ea3."],
                    "Blocks cannot be moved down as they are already at the bottom": ["Block kh\u00f4ng th\u1ec3 chuy\u1ec3n xu\u1ed1ng d\u01b0\u1edbi v\u00ec \u0111\u00e2y \u0111\u00e3 l\u00e0 cu\u1ed1i c\u00f9ng"],
                    "Blocks cannot be moved up as they are already at the top": ["Block kh\u00f4ng th\u1ec3 chuy\u1ec3n l\u00ean v\u00ec \u0111\u00e3 \u1edf tr\u00ean c\u00f9ng"],
                    "Block %1$s is at the beginning of the content and can\u2019t be moved right": ["Block %1$s \u0111ang \u1edf \u0111\u1ea7u ti\u00ean v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n l\u00ean tr\u00ean n\u1eefa"],
                    "This color combination may be hard for people to read. Try using a darker background color and\/or a brighter %s.": ["M\u00e0u ph\u1ed1i n\u00e0y c\u00f3 th\u1ec3 g\u00e2y kh\u00f3 \u0111\u1ecdc. H\u00e3y th\u1eed s\u1eed d\u1ee5ng m\u00e0u n\u1ec1n t\u1ed1i h\u01a1n ho\u1eb7c m\u00e0u v\u0103n b\u1ea3n s\u00e1ng h\u01a1n %s."],
                    "This color combination may be hard for people to read. Try using a brighter background color and\/or a darker %s.": ["M\u00e0u ph\u1ed1i n\u00e0y c\u00f3 th\u1ec3 g\u00e2y kh\u00f3 \u0111\u1ecdc. H\u00e3y th\u1eed s\u1eed d\u1ee5ng m\u00e0u n\u1ec1n s\u00e1ng h\u01a1n ho\u1eb7c m\u00e0u v\u0103n b\u1ea3n t\u1ed1i h\u01a1n %s."],
                    "Move %1$s block from position %2$d up to position %3$d": ["Di chuy\u1ec3n kh\u1ed1i %1$s t\u1eeb v\u1ecb tr\u00ed %2$d \u0111\u1ebfn v\u1ecb tr\u00ed %3$d"],
                    "Block %1$s is at the end of the content and can\u2019t be moved right": ["Block %1$s \u0111ang \u1edf cu\u1ed1i c\u00f9ng v\u00e0 kh\u00f4ng th\u1ec3 chuy\u1ec3n xu\u1ed1ng n\u1eefa"],
                    "Reset": ["\u0110\u1eb7t l\u1ea1i"],
                    "Convert to Classic Block": ["Chuy\u1ec3n th\u00e0nh kh\u1ed1i c\u1ed5 \u0111i\u1ec3n"],
                    "Move %1$s block from position %2$d down to position %3$d": ["Di chuy\u1ec3n kh\u1ed1i %1$s t\u1eeb v\u1ecb tr\u00ed %2$d xu\u1ed1ng v\u1ecb tr\u00ed %3$d"],
                    "Current": ["Hi\u1ec7n t\u1ea1i"],
                    "Block: %s": ["Block: %s"],
                    "font size name\u0004Normal": ["B\u00ecnh th\u01b0\u1eddng"],
                    "No block selected.": ["Ch\u01b0a ch\u1ecdn block n\u00e0o."],
                    "Convert to HTML": ["Chuy\u1ec3n \u0111\u1ed5i sang HTML"],
                    "Block %s is the only block, and cannot be moved": ["Block %s kh\u00f4ng th\u1ec3 di chuy\u1ec3n."],
                    "This block contains unexpected or invalid content.": ["Kh\u1ed1i n\u00e0y ch\u01b0a n\u1ed9i dung kh\u00f4ng h\u1ee3p l\u1ec7."],
                    "Convert to Blocks": ["Chuy\u1ec3n th\u00e0nh c\u00e1c kh\u1ed1i"],
                    "Resolve Block": ["X\u1eed l\u00fd l\u1ea1i kh\u1ed1i"],
                    "imperative verb\u0004Resolve": ["X\u1eed l\u00fd l\u1ea1i"],
                    "This block has encountered an error and cannot be previewed.": ["Kh\u1ed1i n\u00e0y \u0111\u00e3 b\u1ecb l\u1ed7i v\u00e0 kh\u00f4ng th\u1ec3 xem tr\u01b0\u1edbc."],
                    "After Conversion": ["Sau chuy\u1ec3n \u0111\u1ed5i"],
                    "Wide width": ["Chi\u1ec1u r\u1ed9ng khung"],
                    "Change text alignment": ["Thay \u0111\u1ed5i c\u0103n l\u1ec1 c\u1ee7a ch\u1eef"],
                    "Change alignment": ["Ch\u1ec9nh c\u0103n l\u1ec1"],
                    "Full width": ["Chi\u1ec1u r\u1ed9ng \u0111\u1ea7y \u0111\u1ee7"],
                    "No results.": ["Kh\u00f4ng c\u00f3 k\u1ebft qu\u1ea3."],
                    "%d result found, use up and down arrow keys to navigate.": ["%d k\u1ebft qu\u1ea3 \u0111\u01b0\u1ee3c t\u00ecm th\u1ea5y, s\u1eed d\u1ee5ng ph\u00edm l\u00ean v\u00e0 xu\u1ed1ng \u0111\u1ec3 chuy\u1ec3n \u0111\u1ed5i k\u1ebft qu\u1ea3."],
                    "Blocks": ["Block"],
                    "Original": ["Nguy\u00ean b\u1ea3n"],
                    "Link selected.": ["\u0110\u00e3 ch\u1ecdn li\u00ean k\u1ebft."],
                    "Paste URL or type to search": ["D\u00e1n URL ho\u1eb7c g\u00f5 \u0111\u1ec3 t\u00ecm ki\u1ebfm"],
                    "%1$s %2$s": ["%1$s %2$s"],
                    "Color": ["M\u00e0u s\u1eafc"],
                    "Link CSS Class": ["Li\u00ean k\u1ebft l\u1edbp CSS"],
                    "Back": ["Tr\u1edf l\u1ea1i"],
                    "Replace": ["Thay th\u1ebf"],
                    "Move down": ["Di chuy\u1ec3n xu\u1ed1ng"],
                    "Move up": ["Di chuy\u1ec3n l\u00ean"],
                    "Align right": ["C\u0103n l\u1ec1 ph\u1ea3i"],
                    "Align center": ["C\u0103n gi\u1eefa"],
                    "Align left": ["C\u0103n l\u1ec1 tr\u00e1i"],
                    "Tools": ["C\u00f4ng c\u1ee5"],
                    "Not set": ["Ch\u01b0a \u0111\u1eb7t"],
                    "Insert from URL": ["Ch\u00e8n t\u1eeb URL"],
                    "Video": ["Video"],
                    "Audio": ["Audio"],
                    "Large": ["L\u1edbn"],
                    "Media Library": ["Media"],
                    "Media File": ["T\u1eadp tin \u0111a ph\u01b0\u01a1ng ti\u1ec7n"],
                    "Attachment Page": ["Trang n\u1ed9i dung \u0111\u00ednh k\u00e8m"],
                    "Clear selection.": ["X\u00f3a l\u1ef1a ch\u1ecdn."],
                    "text color": ["m\u00e0u ch\u1eef"],
                    "Mixed": ["Mixed"],
                    "Upload": ["T\u1ea3i l\u00ean"],
                    "Styles": ["C\u00e1c phong c\u00e1ch hi\u1ec3n th\u1ecb"],
                    "Link": ["Li\u00ean k\u1ebft"],
                    "Square": ["Vu\u00f4ng"],
                    "Custom": ["T\u00f9y ch\u1ec9nh"],
                    "Text": ["V\u0103n b\u1ea3n"],
                    "Insert": ["Ch\u00e8n"],
                    "Font family": ["Ki\u1ec3u ch\u1eef"],
                    "Underline": ["G\u1ea1ch ch\u00e2n"],
                    "Strikethrough": ["G\u1ea1ch gi\u1eefa t\u1eeb"],
                    "Unlink": ["B\u1ecf li\u00ean k\u1ebft"],
                    "Border": ["Vi\u1ec1n"],
                    "Dimensions": ["K\u00edch th\u01b0\u1edbc"],
                    "Top": ["Tr\u00ean"],
                    "Bottom": ["D\u01b0\u1edbi"],
                    "Align": ["C\u00e2n d\u00f2ng"],
                    "Background": ["N\u1ec1n"],
                    "Insert link": ["Th\u00eam \u0111\u01b0\u1eddng d\u1eabn"],
                    "Remove link": ["X\u00f3a \u0111\u01b0\u1eddng d\u1eabn"],
                    "Image": ["\u1ea2nh"],
                    "Font size": ["C\u1ee1 ch\u1eef"],
                    "Black": ["\u0110en"],
                    "White": ["Tr\u1eafng"],
                    "Width": ["R\u1ed9ng"],
                    "Height": ["Cao"],
                    "Default": ["M\u1eb7c \u0111\u1ecbnh"],
                    "All": ["T\u1ea5t c\u1ea3"],
                    "No results found.": ["Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3."],
                    "Edit link": ["S\u1eeda li\u00ean k\u1ebft"],
                    "Search results for \"%s\"": ["K\u1ebft qu\u1ea3 t\u00ecm ki\u1ebfm cho \"%s\""],
                    "Advanced": ["N\u00e2ng cao"],
                    "Done": ["Ho\u00e0n th\u00e0nh"],
                    "Preview": ["Xem th\u1eed"],
                    "Content": ["N\u1ed9i dung"],
                    "Left": ["Tr\u00e1i"],
                    "Right": ["Ph\u1ea3i"],
                    "Medium": ["Trung b\u00ecnh"],
                    "Apply": ["\u00c1p d\u1ee5ng"],
                    "Edit": ["Ch\u1ec9nh s\u1eeda"],
                    "Cancel": ["H\u1ee7y"],
                    "Submit": ["G\u1eedi"],
                    "Search": ["T\u00ecm ki\u1ebfm"],
                    "Thumbnail": ["\u1ea2nh thu nh\u1ecf"],
                    "Full Size": ["K\u00edch th\u01b0\u1edbc \u0111\u1ea7y \u0111\u1ee7"],
                    "Close": ["\u0110\u00f3ng"],
                    "Select": ["Ch\u1ecdn"],
                    "URL": ["URL"],
                    "None": ["Tr\u1ed1ng"],
                    "Publish": ["\u0110\u0103ng"],
                    "Media": ["Media"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/block-editor.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/block-editor.min.js?ver=43e40e04f77d598ede94'
            id='wp-block-editor-js'></script>
    <script id='wp-reusable-blocks-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Create Reusable block": ["T\u1ea1o block t\u00e1i s\u1eed d\u1ee5ng"],
                    "Manage Reusable blocks": ["Qu\u1ea3n l\u00fd block t\u00e1i s\u1eed d\u1ee5ng"],
                    "Reusable block created.": ["Block t\u00e1i s\u1eed d\u1ee5ng \u0111\u00e3 \u0111\u01b0\u1ee3c t\u1ea1o."],
                    "Untitled Reusable block": ["Block t\u00e1i s\u1eed d\u1ee5ng ch\u01b0a c\u00f3 t\u00ean"],
                    "Convert to regular blocks": ["Chuy\u1ec3n v\u1ec1 block c\u01a1 b\u1ea3n"],
                    "Name": ["T\u00ean"],
                    "Save": ["L\u01b0u thay \u0111\u1ed5i"],
                    "Cancel": ["H\u1ee7y"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/reusable-blocks.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/reusable-blocks.min.js?ver=a7367a6154c724b51b31'
            id='wp-reusable-blocks-js'></script>
    <script id='wp-server-side-render-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Block rendered as empty.": ["Kh\u1ed1i \u0111\u00e3 \u0111\u01b0\u1ee3c render r\u1ed7ng."],
                    "Error loading block: %s": ["L\u1ed7i n\u1ea1p kh\u1ed1i: %s"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/server-side-render.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/server-side-render.min.js?ver=d1bc93277666143a3f5e'
            id='wp-server-side-render-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/viewport.min.js?ver=4f6bd168b2b8b45c8a6b'
            id='wp-viewport-js'></script>
    <script src='http://localhost/wordpress/wp-admin/js/editor.min.js?ver=6.2.2' id='editor-js'></script>
    <script id='editor-js-after'>
        window.wp.oldEditor = window.wp.editor;
    </script>
    <script id='wp-block-library-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {"domain": "messages", "plural-forms": "nplurals=1; plural=0;", "lang": "vi_VN"},
                    "Import": ["Nh\u1eadp"],
                    "Post Comments Count block: post not found.": ["Kh\u1ed1i \u0110\u1ebfm b\u00ecnh lu\u1eadn: kh\u00f4ng t\u00ecm th\u1ea5y b\u00e0i vi\u1ebft."],
                    "To show a comment, input the comment ID.": ["\u0110\u1ec3 hi\u1ec7n m\u1ed9t b\u00ecnh lu\u1eadn, nh\u1eadp ID c\u1ee7a b\u00ecnh lu\u1eadn."],
                    "block title\u0004Post Comment": ["B\u00ecnh lu\u1eadn"],
                    "%s comment": ["%s b\u00ecnh lu\u1eadn"],
                    "Post Comments Link block: post not found.": ["Kh\u1ed1i Li\u00ean k\u1ebft B\u00ecnh lu\u1eadn: kh\u00f4ng t\u00ecm th\u1ea5y b\u00e0i vi\u1ebft."],
                    "Avatar Settings": ["C\u00e0i \u0111\u1eb7t \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Author Name": ["T\u00ean t\u00e1c gi\u1ea3"],
                    "Link to author archive": ["Li\u00ean k\u1ebft t\u1edbi trang l\u01b0u tr\u1eef t\u00e1c gi\u1ea3"],
                    "Quote citation": ["Vi\u1ebft tr\u00edch d\u1eabn"],
                    "Loading \u2026": ["\u0110ang t\u1ea3i ..."],
                    "Select which image size to load.": ["Ch\u1ecdn k\u00edch th\u01b0\u1edbc h\u00ecnh \u1ea3nh \u0111\u1ec3 t\u1ea3i."],
                    "The Queen of Hearts.": ["N\u1eef ho\u00e0ng c\u1ee7a tr\u00e1i tim"],
                    "66 \/ 33": ["66 \/ 33"],
                    "33 \/ 66": ["33 \/ 66"],
                    "Convert to static list": ["Chuy\u1ec3n \u0111\u1ed5i sang danh s\u00e1ch t\u0129nh"],
                    "Search Results Title": ["Ti\u00eau \u0111\u1ec1 k\u1ebft qu\u1ea3 t\u00ecm ki\u1ebfm"],
                    "Show search term in title": ["Hi\u1ec3n th\u1ecb c\u1ee5m t\u1eeb t\u00ecm ki\u1ebfm tr\u00ean ti\u00eau \u0111\u1ec1"],
                    "Archive type: Name": ["Ki\u1ec3u l\u01b0u tr\u1eef: T\u00ean"],
                    "Show archive type in title": ["Hi\u1ec3n th\u1ecb ki\u1ec3u l\u01b0u tr\u1eef tr\u00ean ti\u00eau \u0111\u1ec1"],
                    "Parents": ["Cha"],
                    "Suffix": ["H\u1eadu t\u1ed1"],
                    "Prefix": ["Ti\u1ec1n t\u1ed1"],
                    "Display last modified date": ["Hi\u1ec3n th\u1ecb ng\u00e0y s\u1eeda \u0111\u1ed5i cu\u1ed1i c\u00f9ng"],
                    "Replace <BlockTitle \/>": ["Thay th\u1ebf <BlockTitle \/>"],
                    "Only include current page": ["Ch\u1ec9 bao g\u1ed3m trang hi\u1ec7n t\u1ea1i"],
                    "Alice.": ["Alice."],
                    "Search for replacements": ["T\u00ecm \u0111\u1ec3 thay th\u1ebf"],
                    "Show label": ["Hi\u1ec3n th\u1ecb nh\u00e3n"],
                    "Search results for: \u201csearch term\u201d": ["K\u1ebft qu\u1ea3 t\u00ecm ki\u1ebfm cho: \"c\u1ee5m t\u1eeb t\u00ecm ki\u1ebfm\""],
                    "Post Comments Form block: Comments are not enabled for this item.": ["Block form b\u00ecnh lu\u1eadn b\u00e0i vi\u1ebft: B\u00ecnh lu\u1eadn kh\u00f4ng b\u1eadt."],
                    "action that affects the current post\u0004Enable comments": ["B\u1eadt b\u00ecnh lu\u1eadn"],
                    "Links are disabled in the editor.": ["Li\u00ean k\u1ebft \u0111\u01b0\u1ee3c t\u1eaft trong ph\u1ea7n so\u1ea1n th\u1ea3o."],
                    "Post Comments Form block: Comments are not enabled.": ["Block form b\u00ecnh lu\u1eadn b\u00e0i vi\u1ebft: B\u00ecnh lu\u1eadn ch\u01b0a \u0111\u01b0\u1ee3c b\u1eadt."],
                    "Choose a pattern": ["Ch\u1ecdn m\u1ed9t m\u1eabu"],
                    "Show labels": ["Hi\u1ec7n nh\u00e3n"],
                    "Existing template parts": ["Ph\u1ea7n m\u1eabu c\u00f3 s\u1eb5n"],
                    "Choose a %s": ["Ch\u1ecdn m\u1ed9t %s"],
                    "Smallest size": ["C\u1ee1 nh\u1ecf nh\u1ea5t"],
                    "Largest size": ["C\u1ee1 l\u1edbn nh\u1ea5t"],
                    "Choose a pattern for the query loop or start blank.": ["Ch\u1ecdn m\u1ed9t m\u1eabu cho v\u00f2ng l\u1eb7p truy v\u1ea5n ho\u1eb7c t\u1ea1o m\u1edbi."],
                    "Authors": ["T\u00e1c gi\u1ea3"],
                    "Post type": ["Ki\u1ec3u b\u00e0i vi\u1ebft"],
                    "Select the size of the source image.": ["Ch\u1ecdn k\u00edch th\u01b0\u1edbc c\u1ee7a h\u00ecnh \u1ea3nh g\u1ed1c."],
                    "Featured image: %s": ["\u1ea2nh minh h\u1ecda: %s"],
                    "Link to post": ["Li\u00ean k\u1ebft \u0111\u1ebfn b\u00e0i vi\u1ebft"],
                    "Post Comments Form block: Comments are not enabled for this post type (%s).": ["Kh\u1ed1i form b\u00ecnh lu\u1eadn: B\u00ecnh lu\u1eadn ch\u01b0a b\u1eadt cho post type n\u00e0y (%s)."],
                    "Commenter avatars come from": ["H\u00ecnh \u0111\u1ea1i di\u1ec7n ng\u01b0\u1eddi b\u00ecnh lu\u1eadn t\u1eeb"],
                    "A WordPress Commenter": ["M\u1ed9t ng\u01b0\u1eddi b\u00ecnh lu\u1eadn WordPress"],
                    "Hi, this is a comment.": ["Xin ch\u00e0o, \u0111\u00e2y l\u00e0 m\u1ed9t b\u00ecnh lu\u1eadn."],
                    "says": ["b\u00ecnh lu\u1eadn"],
                    "Show arrow": ["Hi\u1ec7n m\u0169i t\u00ean"],
                    "Show icon button": ["Hi\u1ec7n n\u00fat bi\u1ec3u t\u01b0\u1ee3ng"],
                    "Configure the visual appearance of the button opening the overlay menu.": ["Thi\u1ebft l\u1eadp giao di\u1ec7n tr\u1ef1c quan c\u1ee7a n\u00fat m\u1edf menu."],
                    "Author Biography": ["Ti\u1ec3u s\u1eed t\u00e1c gi\u1ea3"],
                    "Convert to Link": ["\u0110\u1ed5i th\u00e0nh Li\u00ean K\u1ebft"],
                    "Failed to create Navigation Menu.": ["Kh\u00f4ng th\u1ec3 t\u1ea1o Menu \u0110i\u1ec1u h\u01b0\u1edbng."],
                    "Classic menu importing.": ["\u0110ang nh\u1eadp menu c\u1ed5 \u0111i\u1ec3n."],
                    "Classic menu imported successfully.": ["Nh\u1eadp menu c\u1ed5 \u0111i\u1ec3n th\u00e0nh c\u00f4ng."],
                    "Classic menu import failed.": ["Nh\u1eadp menu c\u1ed5 \u0111i\u1ec3n th\u1ea5t b\u1ea1i."],
                    "This item has been deleted, or is a draft": ["M\u1ee5c n\u00e0y \u0111\u00e3 b\u1ecb x\u00f3a ho\u1eb7c l\u00e0 b\u1ea3n nh\u00e1p"],
                    "Navigation menu %s successfully deleted.": ["Menu \u0111i\u1ec1u h\u01b0\u1edbng %s \u0111\u00e3 \u0111\u01b0\u1ee3c t\u1ea1o th\u00e0nh c\u00f4ng."],
                    "Home link text": ["Li\u00ean k\u1ebft trang ch\u1ee7"],
                    "Add home link": ["Th\u00eam li\u00ean k\u1ebft trang ch\u1ee7"],
                    "block example\u0004Home Link": ["Li\u00ean k\u1ebft trang ch\u1ee7"],
                    "Create from '%s'": ["T\u1ea1o t\u1eeb '%s'"],
                    "Loading Navigation block setup options.": ["\u0110ang t\u1ea3i t\u00f9y ch\u1ecdn c\u00e0i \u0111\u1eb7t kh\u1ed1i \u0110i\u1ec1u h\u01b0\u1edbng."],
                    "Navigation block setup options ready.": ["T\u00f9y ch\u1ecdn c\u00e0i \u0111\u1eb7t kh\u1ed1i \u0110i\u1ec1u h\u01b0\u1edbng s\u1eb5n s\u00e0ng."],
                    "Unable to fetch classic menu \"%s\" from API.": ["Kh\u00f4ng th\u1ec3 n\u1ea1p menu c\u1ed5 \u0111i\u1ec3n \"%s\" t\u1eeb API."],
                    "Unable to create Navigation Menu \"%s\".": ["Kh\u00f4ng th\u1ec3 t\u1ea1o Menu \u0110i\u1ec1u h\u01b0\u1edbng \"%s\"."],
                    "Creating Navigation Menu.": ["\u0110ang t\u1ea1o Menu \u0110i\u1ec1u h\u01b0\u1edbng."],
                    "Navigation Menu successfully created.": ["\u0110\u00e3 t\u1ea1o Menu \u0110i\u1ec1u h\u01b0\u1edbng th\u00e0nh c\u00f4ng."],
                    "Arrange blocks horizontally.": ["X\u1ebfp c\u00e1c kh\u1ed1i theo chi\u1ec1u ngang."],
                    "Stack": ["X\u1ebfp ch\u1ed3ng"],
                    "Arrange blocks vertically.": ["S\u1eafp x\u1ebfp c\u00e1c kh\u1ed1i theo chi\u1ec1u d\u1ecdc."],
                    "Response to %s": ["Th\u1ea3o lu\u1eadn cho %s"],
                    "Responses to %s": ["Th\u1ea3o lu\u1eadn cho %s"],
                    "Show comments count": ["Hi\u1ec3n th\u1ecb s\u1ed1 b\u00ecnh lu\u1eadn"],
                    "block title\u0004Comment Date": ["Ng\u00e0y b\u00ecnh lu\u1eadn"],
                    "A decorative arrow appended to the next and previous comments link.": ["M\u1ed9t m\u0169i t\u00ean trang tr\u00ed \u0111\u01b0\u1ee3c th\u00eam v\u00e0o li\u00ean k\u1ebft nh\u1eadn x\u00e9t ti\u1ebfp theo v\u00e0 tr\u01b0\u1edbc \u0111\u00f3."],
                    "Arrow option for Comments Pagination Next\/Previous blocks\u0004None": ["Kh\u00f4ng d\u00f9ng"],
                    "Arrow option for Comments Pagination Next\/Previous blocks\u0004Arrow": ["1 M\u0169i T\u00ean"],
                    "Arrow option for Comments Pagination Next\/Previous blocks\u0004Chevron": ["3 M\u0169i T\u00ean"],
                    "Newer comments page link": ["Li\u00ean k\u1ebft trang nh\u1eadn x\u00e9t m\u1edbi h\u01a1n "],
                    "Older comments page link": ["\u0110\u01b0\u1eddng d\u1eabn trang b\u00ecnh lu\u1eadn c\u0169"],
                    "Show post title": ["Hi\u1ec3n th\u1ecb ti\u00eau \u0111\u1ec1 b\u00e0i vi\u1ebft"],
                    "Comments Pagination block: paging comments is disabled in the Discussion Settings": ["Ph\u00e2n trang ph\u1ea7n b\u00ecnh lu\u1eadn: b\u1ecb t\u1eaft trong c\u1ea5u h\u00ecnh ph\u1ea7n Th\u1ea3o lu\u1eadn"],
                    "block title\u0004Comment Author": ["Ng\u01b0\u1eddi b\u00ecnh lu\u1eadn"],
                    "block title\u0004Comment Content": ["N\u1ed9i dung b\u00ecnh lu\u1eadn"],
                    "Link to authors URL": ["Li\u00ean k\u1ebft t\u1edbi trang ng\u01b0\u1eddi b\u00ecnh lu\u1eadn"],
                    "Link to comment": ["Li\u00ean k\u1ebft t\u1edbi b\u00ecnh lu\u1eadn"],
                    "Default Avatar": ["\u1ea2nh \u0111\u1ea1i di\u1ec7n m\u1eb7c \u0111\u1ecbnh"],
                    "Select the avatar user to display, if it is blank it will use the post\/page author.": ["Ch\u1ecdn \u1ea3nh \u0111\u1ea1i di\u1ec7n ng\u01b0\u1eddi d\u00f9ng \u0111\u1ec3 hi\u1ec3n th\u1ecb, n\u1ebfu \u0111\u1ec3 tr\u1ed1ng s\u1ebd d\u00f9ng \u1ea3nh t\u00e1c gi\u1ea3."],
                    "Group by:": ["G\u1ed9p theo:"],
                    "Link to user profile": ["Li\u00ean k\u1ebft t\u1edbi h\u1ed3 s\u01a1 ng\u01b0\u1eddi d\u00f9ng"],
                    "Week": ["Tu\u1ea7n"],
                    "single horizontal line\u0004Row": ["H\u00e0ng"],
                    "%s Avatar": ["\u1ea2nh \u0111\u1ea1i di\u1ec7n %s"],
                    "Newer Comments": ["Nh\u1eefng b\u00ecnh lu\u1eadn m\u1edbi"],
                    "Older Comments": ["Nh\u1eefng b\u00ecnh lu\u1eadn c\u0169"],
                    "Response": ["Th\u1ea3o lu\u1eadn"],
                    "Responses": ["Th\u1ea3o lu\u1eadn"],
                    "Icon background": ["Bi\u1ec3u t\u01b0\u1ee3ng n\u1ec1n"],
                    "Page List: Cannot retrieve Pages.": ["Danh s\u00e1ch Trang: Kh\u00f4ng th\u1ec3 truy xu\u1ea5t Trang."],
                    "Icon": ["Bi\u1ec3u t\u01b0\u1ee3ng"],
                    "Use as site icon": ["D\u00f9ng l\u00e0m bi\u1ec3u t\u01b0\u1ee3ng trang"],
                    "Site Icons are what you see in browser tabs, bookmark bars, and within the WordPress mobile apps. To use a custom icon that is different from your site logo, use the <a>Site Icon settings<\/a>.": ["Bi\u1ec3u t\u01b0\u1ee3ng blog l\u00e0 c\u00e1i b\u1ea1n th\u1ea5y trong c\u00e1c tab tr\u00ecnh duy\u1ec7t, thanh d\u1ea5u trang v\u00e0 trong \u1ee9ng d\u1ee5ng WordPress d\u00e0nh cho thi\u1ebft b\u1ecb di \u0111\u1ed9ng. \u0110\u1ec3 s\u1eed d\u1ee5ng bi\u1ec3u t\u01b0\u1ee3ng t\u00f9y ch\u1ec9nh kh\u00e1c v\u1edbi logo c\u1ee7a b\u1ea1n, h\u00e3y s\u1eed d\u1ee5ng <a>C\u00e0i \u0111\u1eb7t Bi\u1ec3u t\u01b0\u1ee3ng blog<\/a>."],
                    "You do not have permission to edit this Menu. Any changes made will not be saved.": ["B\u1ea1n kh\u00f4ng c\u00f3 quy\u1ec1n s\u1eeda menu n\u00e0y. M\u1ecdi thay \u0111\u1ed5i s\u1ebd kh\u00f4ng \u0111\u01b0\u1ee3c l\u01b0u."],
                    "You do not have permission to create Navigation Menus.": ["B\u1ea1n kh\u00f4ng c\u00f3 quy\u1ec1n t\u1ea1o \u0110i\u1ec1u h\u01b0\u1edbng Menu."],
                    "Preload value\u0004None": ["Kh\u00f4ng c\u00f3"],
                    "Area": ["Khu v\u1ef1c"],
                    "Default based on area (%s)": ["M\u1eb7c \u0111\u1ecbnh d\u1ef1a tr\u00ean v\u00f9ng ch\u1ee9a (%s)"],
                    "Term Description": ["M\u00f4 t\u1ea3 Thu\u1eadt ng\u1eef"],
                    "Choose an existing %s or create a new one.": ["Ch\u1ecdn %s c\u00f3 s\u1eb5n ho\u1eb7c t\u1ea1o m\u1ed9t c\u00e1i m\u1edbi."],
                    "Untitled Template Part": ["Ph\u1ea7n M\u1eabu kh\u00f4ng t\u00ean"],
                    "Name and create your new %s": ["\u0110\u1eb7t t\u00ean v\u00e0 t\u1ea1o %s m\u1edbi"],
                    "Number of tags": ["S\u1ed1 l\u01b0\u1ee3ng th\u1ebb"],
                    "Make title link to home": ["T\u1ea1o ti\u00eau \u0111\u1ec1 li\u00ean k\u1ebft cho trang ch\u1ee7"],
                    "Template Part \"%s\" inserted.": ["Th\u00e0nh ph\u1ea7n m\u1eabu \"%s\" \u0111\u00e3 \u0111\u01b0\u1ee3c th\u00eam."],
                    "Add a site logo": ["Th\u00eam logo cho web"],
                    "Arrow": ["M\u0169i t\u00ean"],
                    "Post Title": ["Ti\u00eau \u0111\u1ec1 b\u00e0i vi\u1ebft"],
                    "Arrow option for Query Pagination Next\/Previous blocks\u0004Arrow": ["M\u0169i t\u00ean"],
                    "Arrow option for Query Pagination Next\/Previous blocks\u0004Chevron": ["3 M\u0169i T\u00ean"],
                    "Arrow option for Query Pagination Next\/Previous blocks\u0004None": ["Kh\u00f4ng c\u00f3"],
                    "A decorative arrow appended to the next and previous page link.": ["M\u1ed9t m\u0169i t\u00ean trang tr\u00ed \u0111\u01b0\u1ee3c th\u00eam v\u00e0o li\u00ean k\u1ebft trang k\u1ebf v\u00e0 trang tr\u01b0\u1edbc."],
                    "Next: ": ["Ti\u1ebfp theo:"],
                    "Display the title as a link": ["Hi\u1ec3n th\u1ecb ti\u00eau \u0111\u1ec1 d\u01b0\u1edbi d\u1ea1ng li\u00ean k\u1ebft"],
                    "Next post": ["B\u00e0i sau"],
                    "Displays the post link that follows the current post.": ["Hi\u1ec3n th\u1ecb li\u00ean k\u1ebft b\u00e0i vi\u1ebft theo sau b\u00e0i vi\u1ebft hi\u1ec7n t\u1ea1i."],
                    "Previous post": ["B\u00e0i tr\u01b0\u1edbc"],
                    "Displays the post link that precedes the current post.": ["Hi\u1ec3n th\u1ecb li\u00ean k\u1ebft b\u00e0i vi\u1ebft tr\u01b0\u1edbc b\u00e0i vi\u1ebft hi\u1ec7n t\u1ea1i."],
                    "If you have entered a custom label, it will be prepended before the title.": ["N\u1ebfu b\u1ea1n \u0111\u00e3 nh\u1eadp nh\u00e3n t\u00f9y ch\u1ec9nh, nh\u00e3n \u0111\u00f3 s\u1ebd \u0111\u01b0\u1ee3c th\u00eam v\u00e0o tr\u01b0\u1edbc t\u1ef1a \u0111\u1ec1."],
                    "Enter character(s) used to separate terms.": ["Nh\u1eadp k\u00fd t\u1ef1 d\u00f9ng \u0111\u1ec3 d\u00f9ng \u0111\u1ec3 ph\u00e2n c\u00e1ch c\u00e1c thu\u1eadt ng\u1eef."],
                    "Include the label as part of the link": ["Bao g\u1ed3m nh\u00e3n nh\u01b0 m\u1ed9t ph\u1ea7n c\u1ee7a li\u00ean k\u1ebft"],
                    "Previous: ": ["Tr\u01b0\u1edbc: "],
                    "Post Date": ["Ng\u00e0y \u0111\u0103ng"],
                    "Scale option for Image dimension control\u0004Cover": ["\u1ea2nh b\u00eca"],
                    "Scale option for Image dimension control\u0004Contain": ["Ch\u1ee9a"],
                    "Scale option for Image dimension control\u0004Fill": ["L\u1ea5p \u0111\u1ea7y"],
                    "Image scaling options\u0004Scale": ["T\u1ec9 l\u1ec7"],
                    "Image is scaled and cropped to fill the entire space without being distorted.": ["H\u00ecnh \u1ea3nh \u0111\u01b0\u1ee3c thu nh\u1ecf v\u00e0 c\u1eaft \u0111\u1ec3 l\u1ea5p \u0111\u1ea7y to\u00e0n b\u1ed9 kh\u00f4ng gian m\u00e0 kh\u00f4ng b\u1ecb bi\u1ebfn d\u1ea1ng."],
                    "Image is scaled to fill the space without clipping nor distorting.": ["H\u00ecnh \u1ea3nh \u0111\u01b0\u1ee3c thu nh\u1ecf \u0111\u1ec3 l\u1ea5p \u0111\u1ea7y kh\u00f4ng gian m\u00e0 kh\u00f4ng b\u1ecb c\u1eaft b\u1edbt ho\u1eb7c bi\u1ebfn d\u1ea1ng."],
                    "Image will be stretched and distorted to completely fill the space.": ["H\u00ecnh \u1ea3nh s\u1ebd b\u1ecb k\u00e9o c\u0103ng v\u00e0 bi\u1ebfn d\u1ea1ng \u0111\u1ec3 l\u1ea5p \u0111\u1ea7y ho\u00e0n to\u00e0n kh\u00f4ng gian."],
                    "Show bio": ["Hi\u1ec7n ti\u1ec3u s\u1eed"],
                    "Avatar size": ["K\u00edch c\u1ee1 \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Show avatar": ["Hi\u1ec3n th\u1ecb \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Post Author": ["T\u00e1c gi\u1ea3 b\u00e0i vi\u1ebft"],
                    "Write byline\u2026": ["Vi\u1ebft theo d\u00f2ng\u2026"],
                    "Post author byline text": ["N\u1ed9i dung t\u00e1c gi\u1ea3 theo d\u00f2ng"],
                    "No comments": ["Ch\u01b0a c\u00f3 b\u00ecnh lu\u1eadn"],
                    "Select tag": ["Ch\u1ecdn th\u1ebb"],
                    "Select category": ["Ch\u1ecdn chuy\u00ean m\u1ee5c"],
                    "Select page": ["Ch\u1ecdn trang"],
                    "Select post": ["Ch\u1ecdn b\u00e0i vi\u1ebft"],
                    "Navigation link text": ["N\u1ed9i dung li\u00ean k\u1ebft \u0111i\u1ec1u h\u01b0\u1edbng"],
                    "Add submenu": ["Th\u00eam menu con"],
                    "Create draft post: <mark>%s<\/mark>": ["T\u1ea1o b\u1ea3n nh\u00e1p: <mark>%s<\/mark>"],
                    "This item is missing a link": ["M\u1ee5c n\u00e0y thi\u1ebfu li\u00ean k\u1ebft"],
                    "Add link": ["Ch\u00e8n li\u00ean k\u1ebft"],
                    "Create draft page: <mark>%s<\/mark>": ["T\u1ea1o trang nh\u00e1p: <mark>%s<\/mark>"],
                    "navigation link preview example\u0004Example Link": ["Li\u00ean k\u1ebft v\u00ed d\u1ee5"],
                    "Always": ["Lu\u00f4n lu\u00f4n"],
                    "Off": ["T\u1eaft "],
                    "Display": ["Hi\u1ec3n th\u1ecb"],
                    "Create a new menu?": ["T\u1ea1o m\u1ed9t menu m\u1edbi?"],
                    "Transform": ["Chuy\u1ec3n \u0111\u1ed5i"],
                    "Contact": ["Li\u00ean h\u1ec7"],
                    "Submenu & overlay text": ["Menu con v\u00e0 l\u1edbp ph\u1ee7 v\u0103n b\u1ea3n"],
                    "Overlay Menu": ["L\u1edbp ph\u1ee7 n\u1ec1n menu"],
                    "Are you sure you want to delete this navigation menu?": ["B\u1ea1n c\u00f3 ch\u1eafc ch\u1eafn mu\u1ed1n x\u00f3a menu n\u00e0y?"],
                    "Menu name": ["T\u00ean menu"],
                    "Delete menu": ["X\u00f3a menu"],
                    "Start empty": ["B\u1eaft \u0111\u1ea7u t\u1eeb \u0111\u1ea7u"],
                    "Switch to '%s'": ["Chuy\u1ec3n th\u00e0nh '%s'"],
                    "Configure overlay menu": ["Thi\u1ebft l\u1eadp menu l\u1edbp ph\u1ee7"],
                    "Collapses the navigation options in a menu icon opening an overlay.": ["Thu g\u1ecdn c\u00e1c t\u00f9y ch\u1ecdn \u0111i\u1ec1u h\u01b0\u1edbng trong bi\u1ec3u t\u01b0\u1ee3ng menu m\u1edf ra m\u1ed9t l\u1edbp ph\u1ee7."],
                    "Submenus": ["Menu con"],
                    "Open on click": ["M\u1edf khi nh\u1ea5n"],
                    "Create new menu": ["T\u1ea1o menu m\u1edbi"],
                    "Delete %s": ["X\u00f3a %s"],
                    "Confirm": ["X\u00e1c nh\u1eadn"],
                    "Navigation menu has been deleted or is unavailable. ": ["Menu \u0111i\u1ec1u h\u01b0\u1edbng \u0111\u00e3 b\u1ecb x\u00f3a ho\u1eb7c kh\u00f4ng kh\u1ea3 d\u1ee5ng."],
                    "Submenu & overlay background": ["Menu con v\u00e0 n\u1ec1n ph\u1ee7"],
                    "Manage menus": ["Qu\u1ea3n l\u00fd menu"],
                    "%s navigation": ["\u0111i\u1ec1u h\u01b0\u1edbng %s"],
                    "The <aside> element should represent a portion of a document whose content is only indirectly related to the document's main content.": ["Ph\u1ea7n t\u1eed <aside> \u0111\u1ea1i di\u1ec7n cho m\u1ed9t ph\u1ea7n c\u1ee7a t\u00e0i li\u1ec7u m\u00e0 n\u1ed9i dung c\u1ee7a n\u00f3 ch\u1ec9 li\u00ean quan gi\u00e1n ti\u1ebfp \u0111\u1ebfn n\u1ed9i dung ch\u00ednh c\u1ee7a t\u00e0i li\u1ec7u."],
                    "The <footer> element should represent a footer for its nearest sectioning element (e.g.: <section>, <article>, <main> etc.).": ["Ph\u1ea7n t\u1eed <footer> \u0111\u1ea1i di\u1ec7n cho m\u1ed9t ch\u00e2n trang c\u1ee7a ph\u1ea7n t\u1eed ph\u00e2n \u0111o\u1ea1n g\u1ea7n nh\u1ea5t c\u1ee7a n\u00f3 (e.g.: <section>, <article>, <main> etc.)."],
                    "The <section> element should represent a standalone portion of the document that can't be better represented by another element.": ["Ph\u1ea7n t\u1eed <section> \u0111\u1ea1i di\u1ec7n cho m\u1ed9t ph\u1ea7n \u0111\u1ed9c l\u1eadp c\u1ee7a t\u00e0i li\u1ec7u m\u00e0 ph\u1ea7n t\u1eed kh\u00e1c kh\u00f4ng th\u1ec3 tr\u00ecnh b\u00e0y t\u1ed1t h\u01a1n."],
                    "Loading options\u2026": ["T\u00f9y ch\u1ecdn t\u1ea3i\u2026"],
                    "The <header> element should represent introductory content, typically a group of introductory or navigational aids.": ["Ph\u1ea7n t\u1eed <header> \u0111\u1ea1i di\u1ec7n cho n\u1ed9i dung gi\u1edbi thi\u1ec7u, th\u01b0\u1eddng l\u00e0 m\u1ed9t nh\u00f3m c\u00e1c c\u00f4ng c\u1ee5 h\u1ed7 tr\u1ee3 gi\u1edbi thi\u1ec7u ho\u1eb7c \u0111i\u1ec1u h\u01b0\u1edbng."],
                    "The <main> element should be used for the primary content of your document only. ": ["Ph\u1ea7n t\u1eed <main> s\u1eed d\u1ee5ng cho n\u1ed9i dung ch\u00ednh c\u1ee7a t\u00e0i li\u1ec7u c\u1ee7a b\u1ea1n."],
                    "All gallery images updated to open in new tab": ["T\u1ea5t c\u1ea3 \u1ea3nh trong b\u1ed9 s\u01b0u t\u1eadp \u0111\u00e3 ch\u1ec9nh th\u00e0nh m\u1edf trong tab m\u1edbi"],
                    "All gallery images updated to not open in new tab": ["T\u1ea5t c\u1ea3 \u1ea3nh trong b\u1ed9 s\u01b0u t\u1eadp \u0111\u00e3 ch\u1ec9nh th\u00e0nh kh\u00f4ng m\u1edf trong tab m\u1edbi"],
                    "All gallery image sizes updated to: %s": ["\u0110\u00e3 c\u1eadp nh\u1eadt k\u00edch th\u01b0\u1edbc \u1ea3nh trong b\u1ed9 s\u01b0u t\u1eadp th\u00e0nh: %s"],
                    "bookmark": ["\u0111\u00e1nh d\u1ea5u"],
                    "Name of the file\u0004Armstrong_Small_Step": ["Thanh_Pho_Buon"],
                    "If uploading to a gallery all files need to be image formats": ["N\u1ebfu t\u1ea3i l\u00ean album \u1ea3nh, t\u1ea5t c\u1ea3 c\u00e1c t\u1eadp tin c\u1ea7n ph\u1ea3i l\u00e0 \u0111\u1ecbnh d\u1ea1ng h\u00ecnh \u1ea3nh"],
                    "All gallery image links updated to: %s": ["T\u1ea5t c\u1ea3 li\u00ean k\u1ebft \u1ea3nh trong b\u1ed9 s\u01b0u t\u1eadp \u0111\u00e3 c\u1eadp nh\u1eadt th\u00e0nh: %s"],
                    "Media item link option\u0004None": ["Kh\u00f4ng"],
                    "Embed Pinterest pins, boards, and profiles.": ["Nh\u00fang Pinterest pins, boards, v\u00e0 h\u1ed3 s\u01a1."],
                    "Embed Wolfram notebook content.": ["Nh\u00fang n\u1ed9i dung t\u1eeb Wolfram Cloud notebook."],
                    "noun; Audio block parameter\u0004Preload": ["T\u1ea3i tr\u01b0\u1edbc"],
                    "No published posts found.": ["Ch\u01b0a \u0111\u0103ng b\u00e0i vi\u1ebft n\u00e0o."],
                    "Show only top level categories": ["Ch\u1ec9 hi\u1ec7n nh\u1eefng chuy\u00ean m\u1ee5c m\u1eb9"],
                    "Drag and drop onto this block, upload, or select existing media from your library.": ["K\u00e9o v\u00e0 th\u1ea3 v\u00e0o kh\u1ed1i n\u00e0y, t\u1ea3i l\u00ean, ho\u1eb7c ch\u1ecdn t\u1eadp tin t\u1eeb th\u01b0 vi\u1ec7n media."],
                    "Template part has been deleted or is unavailable: %s": ["Th\u00e0nh ph\u1ea7n c\u1ee7a m\u1eabu \u0111\u00e3 b\u1ecb x\u00f3a ho\u1eb7c kh\u00f4ng kh\u1ea3 d\u1ee5ng: %s"],
                    "Open menu": ["M\u1edf menu"],
                    "Close menu": ["\u0110\u00f3ng menu"],
                    "No post excerpt found": ["Kh\u00f4ng c\u00f3 \u0111o\u1ea1n gi\u1edbi thi\u1ec7u"],
                    "Post excerpt text": ["\u0110o\u1ea1n gi\u1edbi thi\u1ec7u"],
                    "Add \"read more\" link text": ["Th\u00eam li\u00ean k\u1ebft \"Xem th\u00eam\""],
                    "Archive Title": ["T\u00ean trang l\u01b0u tr\u1eef"],
                    "Archive title": ["Ti\u00eau \u0111\u1ec1 l\u01b0u tr\u1eef"],
                    "Next Page": ["Trang sau"],
                    "Previous Page": ["Trang tr\u01b0\u1edbc"],
                    "Keyword": ["T\u1eeb kh\u00f3a"],
                    "Sticky posts": ["B\u00e0i \u0111\u00ednh l\u00ean"],
                    "Filters": ["L\u1ecdc"],
                    "Posts List": ["Danh s\u00e1ch b\u00e0i vi\u1ebft"],
                    "Image, Date, & Title": ["\u1ea2nh, th\u1eddi gian v\u00e0 ti\u00eau \u0111\u1ec1"],
                    "An example title": ["Ti\u00eau \u0111\u1ec1 m\u1eabu"],
                    "Change Date": ["\u0110\u1ed5i th\u1eddi gian"],
                    "Show link on new line": ["Hi\u1ec3n th\u1ecb li\u00ean k\u1ebft \u1edf d\u00f2ng m\u1edbi"],
                    "Make title a link": ["T\u1ea1o ti\u00eau \u0111\u1ec1 c\u00f3 link"],
                    "No Title": ["Kh\u00f4ng c\u00f3 ti\u00eau \u0111\u1ec1"],
                    "Previous page link": ["Link trang tr\u01b0\u1edbc"],
                    "Provided type is not supported.": ["Lo\u1ea1i \u0111\u01b0\u1ee3c cung c\u1ea5p kh\u00f4ng \u0111\u01b0\u1ee3c h\u1ed7 tr\u1ee3."],
                    "<a>Create a new post<\/a> for this feed.": ["<a>T\u1ea1o m\u1ed9t b\u00e0i \u0111\u0103ng m\u1edbi<\/a> cho ngu\u1ed3n c\u1ea5p d\u1eef li\u1ec7u n\u00e0y."],
                    "Title, Date, & Excerpt": ["Ti\u00eau \u0111\u1ec1, Ng\u00e0y th\u00e1ng & T\u00f3m t\u1eaft"],
                    "Title & Excerpt": ["Ti\u00eau \u0111\u1ec1 & T\u00f3m t\u1eaft"],
                    "Title & Date": ["Ti\u00eau \u0111\u1ec1 & Ng\u00e0y th\u00e1ng"],
                    "Next page link": ["Link trang ti\u1ebfp theo"],
                    "Term items not found.": ["M\u1ee5c term kh\u00f4ng t\u1ed3n t\u1ea1i."],
                    "Display the archive title based on the queried object.": ["Hi\u1ec3n th\u1ecb ti\u00eau \u0111\u1ec1 trang l\u01b0u tr\u1eef d\u1ef1a tr\u00ean \u0111\u1ed1i t\u01b0\u1ee3ng \u0111\u01b0\u1ee3c truy v\u1ea5n."],
                    "Display a list of your most recent posts, excluding sticky posts.": ["Hi\u1ec3n th\u1ecb danh s\u00e1ch c\u00e1c b\u00e0i vi\u1ebft g\u1ea7n \u0111\u00e2y nh\u1ea5t c\u1ee7a b\u1ea1n, kh\u00f4ng bao g\u1ed3m c\u00e1c b\u00e0i n\u1ed5i b\u1eadt."],
                    "Toggle to use the global query context that is set with the current template, such as an archive or search. Disable to customize the settings independently.": ["Thay \u0111\u1ed5i \u0111\u1ec3 s\u1eed d\u1ee5ng ng\u1eef c\u1ea3nh truy v\u1ea5n chung \u0111\u01b0\u1ee3c \u0111\u1eb7t v\u1edbi template hi\u1ec7n t\u1ea1i, ch\u1eb3ng h\u1ea1n nh\u01b0 trang l\u01b0u tr\u1eef ho\u1eb7c trang t\u00ecm ki\u1ebfm. T\u1eaft \u0111\u1ec3 t\u00f9y ch\u1ec9nh \u0111\u1ed9c l\u1eadp."],
                    "Site title text": ["T\u00ean website"],
                    "Add quote": ["Th\u00eam n\u1ed9i dung tr\u00edch d\u1eabn"],
                    "Add caption": ["Th\u00eam ch\u00fa th\u00edch"],
                    "Display login as form": ["Hi\u1ec3n th\u1ecb \u0111\u0103ng nh\u1eadp nh\u01b0 l\u00e0 form"],
                    "Default (<div>)": ["M\u1eb7c \u0111\u1ecbnh (<div>)"],
                    "Image width": ["Chi\u1ec1u r\u1ed9ng \u1ea3nh"],
                    "Display settings": ["C\u00e0i \u0111\u1eb7t hi\u1ec3n th\u1ecb"],
                    "Link image to home": ["Li\u00ean k\u1ebft \u1ea3nh t\u1edbi trang ch\u1ee7"],
                    "HTML element": ["Ph\u1ea7n t\u1eed HTML"],
                    "Redirect to current URL": ["Chuy\u1ec3n h\u01b0\u1edbng URL hi\u1ec7n t\u1ea1i"],
                    "%1$s (%2$d of %3$d)": ["%1$s (%2$d of %3$d)"],
                    "Your site does not have any posts, so there is nothing to display here at the moment.": ["Trang web c\u1ee7a b\u1ea1n kh\u00f4ng c\u00f3 b\u1ea5t k\u1ef3 b\u00e0i vi\u1ebft n\u00e0o, v\u00ec v\u1eady hi\u1ec7n t\u1ea1i kh\u00f4ng c\u00f3 g\u00ec \u0111\u1ec3 hi\u1ec3n th\u1ecb \u1edf \u0111\u00e2y."],
                    "Autoplay may cause usability issues for some users.": ["T\u1ef1 \u0111\u1ed9ng ph\u00e1t c\u00f3 th\u1ec3 g\u00e2y ra c\u00e1c v\u1ea5n \u0111\u1ec1 v\u1ec1 kh\u1ea3 n\u0103ng s\u1eed d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng."],
                    "Max page to show": ["T\u1ed1i \u0111a s\u1ed1 trang hi\u1ec3n th\u1ecb"],
                    "Inherit query from template": ["K\u1ebf th\u1eeba truy v\u1ea5n t\u1eeb template"],
                    "Only": ["Ch\u1ec9"],
                    "Offset": ["B\u1ecf qua"],
                    "Exclude": ["Kh\u00f4ng bao g\u1ed3m"],
                    "Copied URL to clipboard.": ["Sao ch\u00e9p URL v\u00e0o b\u1ed9 nh\u1edb t\u1ea1m."],
                    "Site tagline text": ["Slogan c\u1ee7a trang web"],
                    "Write site tagline\u2026": ["Vi\u1ebft slogan c\u1ee7a web..."],
                    "Items per Page": ["S\u1ed1 m\u1ee5c m\u1ed7i trang"],
                    "Click plus to add": ["\u1ea4n v\u00e0o d\u1ea5u c\u1ed9ng \u0111\u1ec3 th\u00eam"],
                    "Media width": ["Chi\u1ec1u r\u1ed9ng file media"],
                    "PDF embed": ["Nh\u00fang file PDF"],
                    "PDF settings": ["C\u00e0i \u0111\u1eb7t PDF"],
                    "Add citation": ["Th\u00eam ch\u00fa th\u00edch"],
                    "Embed of the selected PDF file.": ["Nh\u00fang file PDF \u0111\u00e3 ch\u1ecdn."],
                    "Show inline embed": ["Hi\u1ec3n th\u1ecb nh\u00fang c\u00f9ng d\u00f2ng"],
                    "Site Title placeholder": ["Hi\u1ec3n th\u1ecb minh h\u1ecda cho T\u00ean trang web"],
                    "Site Tagline placeholder": ["Hi\u1ec3n th\u1ecb minh h\u1ecda cho slogan trang web"],
                    "Note: Most phone and tablet browsers won't display embedded PDFs.": ["L\u01b0u \u00fd: H\u1ea7u h\u1ebft c\u00e1c tr\u00ecnh duy\u1ec7t tr\u00ean \u0111i\u1ec7n tho\u1ea1i v\u00e0 m\u00e1y t\u00ednh b\u1ea3ng s\u1ebd kh\u00f4ng hi\u1ec3n th\u1ecb c\u00e1c file PDF \u0111\u01b0\u1ee3c nh\u00fang."],
                    "Limit the pages you want to show, even if the query has more results. To show all pages use 0 (zero).": ["Gi\u1edbi h\u1ea1n c\u00e1c trang b\u1ea1n mu\u1ed1n hi\u1ec3n th\u1ecb, ngay c\u1ea3 khi truy v\u1ea5n c\u00f3 nhi\u1ec1u k\u1ebft qu\u1ea3 h\u01a1n. \u0110\u1ec3 hi\u1ec3n th\u1ecb t\u1ea5t c\u1ea3 c\u00e1c trang, h\u00e3y nh\u1eadp 0 (kh\u00f4ng)."],
                    "Embed of %s.": ["Nh\u00fang file %s."],
                    "Write site title\u2026": ["Nh\u1eadp t\u00ean trang web..."],
                    "Choose": ["Ch\u1ecdn"],
                    "Start blank": ["B\u1eaft \u0111\u1ea7u kh\u00f4ng c\u1ea7n template"],
                    "Type \/ to choose a block": ["G\u00f5 \/ \u0111\u1ec3 ch\u1ecdn block"],
                    "This content is password protected.": ["N\u1ed9i dung n\u00e0y \u0111\u01b0\u1ee3c b\u1ea3o v\u1ec7 b\u1eb1ng m\u1eadt kh\u1ea9u."],
                    "Normal": ["B\u00ecnh th\u01b0\u1eddng"],
                    "Icon color": ["M\u00e0u icon"],
                    "Huge": ["R\u1ea5t l\u1edbn"],
                    "Table caption text": ["Ch\u00fa th\u00edch b\u1ea3ng"],
                    "Footer cell text": ["Ch\u1eef d\u00f2ng cu\u1ed1i"],
                    "Body cell text": ["Ch\u1eef n\u1ed9i dung ch\u00ednh"],
                    "Header cell text": ["Ch\u1eef d\u00f2ng \u0111\u1ea7u"],
                    "Shortcode text": ["N\u1ed9i dung shortcode"],
                    "Video caption text": ["Ch\u00fa th\u00edch video"],
                    "Wood thrush singing in Central Park, NYC.": ["\u00c2m thanh c\u1ee7a r\u1eebng c\u00e2y \u1edf c\u00f4ng vi\u00ean Trung t\u00e2m - New York."],
                    "Write verse\u2026": ["Vi\u1ebft c\u00e2u th\u01a1\u2026"],
                    "Verse text": ["D\u00f2ng th\u01a1"],
                    "Column %d text": ["C\u1ed9t %d v\u1edbi ch\u1eef"],
                    "Block cannot be rendered inside itself.": ["Block kh\u00f4ng th\u1ec3 render trong ch\u00ednh n\u00f3."],
                    "Pullquote citation text": ["Ch\u00fa th\u00edch c\u1ee7a tr\u00edch d\u1eabn"],
                    "Pullquote text": ["N\u1ed9i dung tr\u00edch d\u1eabn"],
                    "Preformatted text": ["N\u1ed9i dung \u0111\u1ecbnh d\u1ea1ng s\u1eb5n"],
                    "List text": ["N\u1ed9i dung danh s\u00e1ch"],
                    "Unordered": ["Kh\u00f4ng c\u00f3 th\u1ee9 t\u1ef1"],
                    "Ordered": ["C\u00f3 th\u1ee9 t\u1ef1"],
                    "Download button text": ["T\u00ean n\u00fat t\u1ea3i v\u1ec1"],
                    "Image caption text": ["Ch\u00fa th\u00edch \u1ea3nh"],
                    "Add text over image": ["Th\u00eam ch\u1eef \u0111\u00e8 tr\u00ean \u1ea3nh"],
                    "Button width": ["Chi\u1ec1u r\u1ed9ng n\u00fat b\u1ea5m"],
                    "Audio caption text": ["Ch\u00fa th\u00edch audio"],
                    "Gallery caption text": ["Ch\u00fa th\u00edch gallery"],
                    "Heading text": ["Ch\u1eef ti\u00eau \u0111\u1ec1"],
                    "Open links in new tab": ["M\u1edf li\u00ean k\u1ebft trong tab m\u1edbi"],
                    "Edit %s": ["S\u1eeda %s"],
                    "Label": ["Nh\u00e3n"],
                    "Edit track": ["S\u1eeda track"],
                    "Convert to blocks": ["Chuy\u1ec3n th\u00e0nh block"],
                    "Kind": ["Lo\u1ea1i"],
                    "Add tracks": ["Th\u00eam b\u1ea3n nh\u1ea1c"],
                    "Remove track": ["X\u00f3a b\u1ea3n nh\u1ea1c"],
                    "Language tag (en, fr, etc.)": ["Th\u1ebb ng\u00f4n ng\u1eef (en, fr, v.v.)"],
                    "Source language": ["Ng\u00f4n ng\u1eef ngu\u1ed3n"],
                    "Title of track": ["Ti\u00eau \u0111\u1ec1 c\u1ee7a b\u1ea3n nh\u1ea1c"],
                    "Text tracks": ["B\u1ea3n nh\u1ea1c v\u0103n b\u1ea3n"],
                    "Tracks can be subtitles, captions, chapters, or descriptions. They help make your content more accessible to a wider range of users.": ["B\u1ea3n nh\u1ea1c c\u00f3 th\u1ec3 l\u00e0 ph\u1ee5 \u0111\u1ec1, ch\u00fa th\u00edch ho\u1eb7c m\u00f4 t\u1ea3. Ch\u00fang gi\u00fap l\u00e0m cho n\u1ed9i dung c\u1ee7a b\u1ea1n d\u1ec5 ti\u1ebfp c\u1eadn h\u01a1n v\u1edbi nhi\u1ec1u ng\u01b0\u1eddi d\u00f9ng h\u01a1n."],
                    "Captions": ["Ch\u00fa th\u00edch"],
                    "Subtitles": ["Ph\u1ee5 \u0111\u1ec1"],
                    "Button inside": ["N\u00fat b\u00ean trong"],
                    "Button outside": ["N\u00fat b\u00ean ngo\u00e0i"],
                    "No button": ["Kh\u00f4ng c\u00f3 n\u00fat"],
                    "Change button position": ["Thay \u0111\u1ed5i v\u1ecb tr\u00ed n\u00fat"],
                    "Use button with icon": ["S\u1eed d\u1ee5ng n\u00fat b\u1ea5m k\u00e8m bi\u1ec3u t\u01b0\u1ee3ng"],
                    "Toggle search label": ["Nh\u00e3n b\u1eadt t\u1eaft t\u00ecm ki\u1ebfm"],
                    "One column": ["M\u1ed9t c\u1ed9t"],
                    "100": ["100"],
                    "Find out more": ["T\u00ecm hi\u1ec3u th\u00eam"],
                    "Repeated background": ["N\u1ec1n l\u1eb7p l\u1ea1i"],
                    "Add link to featured image": ["Th\u00eam link v\u00e0o \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Search for patterns": ["T\u00ecm m\u1eabu"],
                    "by %s": ["b\u1edfi %s"],
                    "Comment": ["B\u00ecnh lu\u1eadn"],
                    "Display author name": ["Hi\u1ec3n th\u1ecb t\u00ean t\u00e1c gi\u1ea3"],
                    "25 \/ 50 \/ 25": ["25 \/ 50 \/ 25"],
                    "33 \/ 33 \/ 33": ["33 \/ 33 \/ 33"],
                    " \u2026 ": [" \u2026 "],
                    "Change content position": ["\u0110\u1ed5i v\u1ecb tr\u00ed n\u1ed9i dung"],
                    "Minimum height of cover": ["Chi\u1ec1u cao t\u1ed1i thi\u1ec3u c\u1ee7a cover"],
                    "Crop": ["C\u1eaft \u1ea3nh"],
                    "50 \/ 50": ["50 \/ 50"],
                    "social": ["m\u1ea1ng x\u00e3 h\u1ed9i"],
                    "Image uploaded.": ["\u1ea2nh \u0111\u00e3 \u0111\u01b0\u1ee3c t\u1ea3i l\u00ean."],
                    "Upload external image": ["T\u1ea3i \u1ea3nh b\u00ean ngo\u00e0i"],
                    "Browser default": ["Tr\u00ecnh duy\u1ec7t m\u1eb7c \u0111\u1ecbnh"],
                    "survey": ["kh\u1ea3o s\u00e1t"],
                    "This column count exceeds the recommended amount and may cause visual breakage.": ["S\u1ed1 l\u01b0\u1ee3ng c\u1ed9t n\u00e0y v\u01b0\u1ee3t qu\u00e1 s\u1ed1 l\u01b0\u1ee3ng \u0111\u01b0\u1ee3c khuy\u1ebfn ngh\u1ecb v\u00e0 c\u00f3 th\u1ec3 x\u1ea3y ra l\u1ed7i b\u1ed1 c\u1ee5c hi\u1ec3n th\u1ecb."],
                    "Edit gallery image": ["S\u1eeda \u1ea3nh c\u1ee7a album"],
                    "Mobile": ["Di \u0111\u1ed9ng"],
                    "Block variations": ["Bi\u1ebfn th\u1ec3 block"],
                    "Patterns": ["M\u1eabu"],
                    "Template Part": ["Template Part"],
                    "Link label": ["Nh\u00e3n c\u1ee7a li\u00ean k\u1ebft"],
                    "Social Icon": ["Bi\u1ec3u t\u01b0\u1ee3ng m\u1ea1ng x\u00e3 h\u1ed9i"],
                    "Select poster image": ["Ch\u1ecdn h\u00ecnh \u1ea3nh \u00e1p ph\u00edch"],
                    "Poster image": ["H\u00ecnh \u1ea3nh \u00e1p ph\u00edch"],
                    "%s label": ["%s nh\u00e3n hi\u00ea\u0323u"],
                    "Briefly describe the link to help screen reader users.": ["M\u00f4 t\u1ea3 ng\u1eafn g\u1ecdn c\u00e1c li\u00ean k\u1ebft \u0111\u1ec3 ng\u01b0\u1eddi \u0111\u1ecdc hi\u1ec3u."],
                    "WHAT was he doing, the great god Pan,\n\tDown in the reeds by the river?\nSpreading ruin and scattering ban,\nSplashing and paddling with hoofs of a goat,\nAnd breaking the golden lilies afloat\n    With the dragon-fly on the river.": ["WHAT was he doing, the great god Pan,\n\tDown in the reeds by the river?\nSpreading ruin and scattering ban,\nSplashing and paddling with hoofs of a goat,\nAnd breaking the golden lilies afloat\n    With the dragon-fly on the river."],
                    "Footer label": ["Nh\u00e3n ch\u00e2n trang"],
                    "Header label": ["Nh\u00e3n ti\u00eau \u0111\u1ec1"],
                    "Matt Mullenweg": ["Matt Mullenweg"],
                    "EXT. XANADU - FAINT DAWN - 1940 (MINIATURE)\nWindow, very small in the distance, illuminated.\nAll around this is an almost totally black screen. Now, as the camera moves slowly towards the window which is almost a postage stamp in the frame, other forms appear;": ["EXT. XANADU - FAINT DAWN - 1940 (MINIATURE)\nWindow, very small in the distance, illuminated.\nAll around this is an almost totally black screen. Now, as the camera moves slowly towards the window which is almost a postage stamp in the frame, other forms appear;"],
                    "Show:": ["Hi\u1ec3n th\u1ecb:"],
                    "Full post": ["To\u00e0n b\u1ed9 b\u00e0i vi\u1ebft"],
                    "Image alignment": ["C\u0103n l\u1ec1 \u1ea3nh"],
                    "Display featured image": ["Hi\u1ec3n th\u1ecb \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Featured image settings": ["C\u00e0i \u0111\u1eb7t \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Media file": ["T\u1eadp tin \u0111a ph\u01b0\u01a1ng ti\u1ec7n"],
                    "Suspendisse commodo neque lacus, a dictum orci interdum et.": ["Suspendisse commodo neque lacus, a dictum orci interdum et."],
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et eros eu felis.": ["Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et eros eu felis."],
                    "podcast": ["podcast"],
                    "Link to": ["Li\u00ean k\u1ebft t\u1edbi"],
                    "ADD MEDIA": ["th\u00eam v\u00e0o ph\u01b0\u01a1ng ti\u1ec7n truy\u1ec1n th\u00f4ng"],
                    "Level %s. Empty.": ["C\u1ea5p %s. Tr\u1ed1ng."],
                    "Level %1$s. %2$s": ["C\u1ea5p %1$s. %2$s"],
                    "Title attribute": ["Thu\u1ed9c t\u00ednh ti\u00eau \u0111\u1ec1"],
                    "Embed a TikTok video.": ["Nh\u00fang video TikTok."],
                    "Change heading level": ["Thay \u0111\u1ed5i c\u1ea5p \u0111\u1ed9 ti\u00eau \u0111\u1ec1"],
                    "(Note: many devices and browsers do not display this text.)": ["(L\u01b0u \u00fd: nhi\u1ec1u thi\u1ebft b\u1ecb v\u00e0 tr\u00ecnh duy\u1ec7t kh\u00f4ng hi\u1ec3n th\u1ecb v\u0103n b\u1ea3n n\u00e0y.)"],
                    "Describe the role of this image on the page.": ["M\u00f4 t\u1ea3 vai tr\u00f2 c\u1ee7a h\u00ecnh \u1ea3nh n\u00e0y tr\u00ean trang."],
                    "Open Media Library": ["M\u1edf Th\u01b0 vi\u1ec7n ph\u01b0\u01a1ng ti\u1ec7n"],
                    "Image size": ["K\u00edch th\u01b0\u1edbc \u1ea3nh"],
                    "Small": ["Nh\u1ecf"],
                    "List view": ["Xem d\u1ea1ng danh s\u00e1ch"],
                    "Post content": ["N\u1ed9i dung b\u00e0i vi\u1ebft"],
                    "Grid view": ["Xem d\u1ea1ng l\u01b0\u1edbi"],
                    "Enter address": ["Nh\u1eadp \u0111\u1ecba ch\u1ec9"],
                    "Sorting and filtering": ["S\u1eafp x\u1ebfp v\u00e0 l\u1ecdc"],
                    "Post meta settings": ["C\u00e0i \u0111\u1eb7t th\u1ebb b\u00e0i vi\u1ebft"],
                    "Post content settings": ["C\u00e0i \u0111\u1eb7t n\u1ed9i dung b\u00e0i vi\u1ebft"],
                    "menu": ["menu"],
                    "Percentage Width": ["T\u1ef7 l\u1ec7 ph\u1ea7n tr\u0103m chi\u1ec1u r\u1ed9ng"],
                    "There is no poster image currently selected": ["Kh\u00f4ng c\u00f3 \u1ea3nh n\u00e0o \u0111ang \u0111\u01b0\u1ee3c ch\u1ecdn"],
                    "Play inline": ["Ch\u1ea1y c\u00f9ng d\u00f2ng"],
                    "The current poster image url is %s": ["\u0110\u01b0\u1eddng d\u1eabn cho \u1ea3nh hi\u1ec7n t\u1ea1i l\u00e0 %s"],
                    "Column settings": ["C\u00e0i \u0111\u1eb7t c\u1ed9t"],
                    "Nam risus massa, ullamcorper consectetur eros fermentum, porta aliquet ligula. Sed vel mauris nec enim.": ["\u0110\u00e2y l\u00e0 m\u1ed9t \u0111o\u1ea1n ch\u1eef ng\u1eabu nhi\u00ean, \u0111\u01b0\u1ee3c vi\u1ebft \u0111\u1ec3 d\u00f9ng l\u00e0m n\u1ed9i dung m\u1eabu. \u0110\u1eebng qu\u00ean s\u1eeda n\u00f3 nh\u00e9!"],
                    "Etiam et egestas lorem. Vivamus sagittis sit amet dolor quis lobortis. Integer sed fermentum arcu, id vulputate lacus. Etiam fermentum sem eu quam hendrerit.": ["\u0110\u00e2y ch\u1ec9 l\u00e0 m\u1ed9t \u0111o\u1ea1n v\u0103n b\u1ea3n c\u00f3 s\u1eb5n \u0111\u1ec3 b\u1ea1n nh\u00ecn th\u1ea5y b\u1ed1 c\u1ee5c t\u1ed1t h\u01a1n. H\u00e3y s\u1eeda n\u00f3 nh\u00e9."],
                    "Three columns; wide center column": ["Ba c\u1ed9t; c\u1ed9t gi\u1eefa r\u1ed9ng"],
                    "Three columns; equal split": ["Ba c\u1ed9t; b\u1eb1ng nhau"],
                    "Two columns; two-thirds, one-third split": ["Hai c\u1ed9t; hai ph\u1ea7n ba, m\u1ed9t ph\u1ea7n ba"],
                    "Two columns; one-third, two-thirds split": ["Hai c\u1ed9t; chia m\u1ed9t ph\u1ea7n ba, hai ph\u1ea7n ba"],
                    "Link rel": ["Link rel"],
                    "Welcome to the wonderful world of blocks\u2026": ["Ch\u00e0o m\u1eebng \u0111\u1ebfn v\u1edbi th\u1ebf gi\u1edbi tuy\u1ec7t v\u1eddi c\u1ee7a block..."],
                    "Two columns; equal split": ["Hai c\u1ed9t; chia \u0111\u1ec1u"],
                    "Call to Action": ["N\u00fat b\u1ea5m"],
                    "Reverse list numbering": ["\u0110\u1ea3o ng\u01b0\u1ee3c danh s\u00e1ch s\u1ed1"],
                    "Start value": ["Gi\u00e1 tr\u1ecb b\u1eaft \u0111\u1ea7u"],
                    "One of the hardest things to do in technology is disrupt yourself.": ["M\u1ed9t trong nh\u1eefng \u0111i\u1ec1u kh\u00f3 nh\u1ea5t trong c\u00f4ng ngh\u1ec7 l\u00e0 l\u00e0m kh\u00f3 ch\u00ednh m\u00ecnh."],
                    "In quoting others, we cite ourselves.": ["Khi tr\u00edch d\u1eabn ng\u01b0\u1eddi kh\u00e1c, ch\u00fang ta th\u1ef1c ra \u0111ang tr\u00edch d\u1eabn ch\u00ednh m\u00ecnh."],
                    "Ordered list settings": ["Ch\u1ecdn th\u1ee9 t\u1ef1"],
                    "Open in new tab": ["M\u1edf trong Tab M\u1edbi"],
                    "Upload a file or pick one from your media library.": ["T\u1ea3i l\u00ean file ho\u1eb7c ch\u1ecdn t\u1eeb th\u01b0 vi\u1ec7n c\u1ee7a b\u1ea1n."],
                    "Attachment page": ["Trang \u0111\u00ednh k\u00e8m"],
                    "December 6, 2018": ["6 Th\u00e1ng m\u01b0\u1eddi hai, 2018"],
                    "February 21, 2019": ["21 Th\u00e1ng Hai, 2019"],
                    "May 7, 2019": ["7 Th\u00e1ng N\u0103m, 2019"],
                    "Release Date": ["Ng\u00e0y ph\u00e1t h\u00e0nh"],
                    "Create Table": ["T\u1ea1o b\u1ea3ng"],
                    "Align column right": ["C\u0103n l\u1ec1 c\u1ed9t ph\u1ea3i"],
                    "Align column center": ["C\u0103n l\u1ec1 c\u1ed9t gi\u1eefa"],
                    "Align column left": ["C\u0103n l\u1ec1 c\u1ed9t tr\u00e1i"],
                    "Footer section": ["Ph\u1ea7n ch\u00e2n trang"],
                    "Header section": ["Ph\u1ea7n \u0111\u1ea7u trang"],
                    "Change column alignment": ["Thay \u0111\u1ed5i c\u0103n ch\u1ec9nh c\u1ed9t"],
                    "Insert a table for sharing data.": ["Ch\u00e8n m\u1ed9t b\u1ea3ng \u0111\u1ec3 chia s\u1ebb d\u1eef li\u1ec7u."],
                    "Jazz Musician": ["Nh\u1ea1c s\u0129 Jazz"],
                    "<strong>Snow Patrol<\/strong>": ["<strong>Snow Patrol<\/strong>"],
                    "Clear Media": ["X\u00f3a Media"],
                    "Mont Blanc appears\u2014still, snowy, and serene.": ["Ng\u1ecdn n\u00fai Mont Blanc xu\u1ea5t hi\u1ec7n \u2014\bt\u0129nh l\u1eb7ng, \bv\u1edbi tuy\u1ebft, v\u00e0 b\u00ecnh y\u00ean."],
                    "\u2014 Kobayashi Issa (\u4e00\u8336)": ["\u2014 Kobayashi Issa (\u4e00\u8336)"],
                    "Leave empty if the image is purely decorative.": ["\u0110\u1ec3 tr\u1ed1ng n\u1ebfu \u1ea3nh ch\u1ec9 l\u00e0 \u0111\u1ec3 trang tr\u00ed."],
                    "Write gallery caption\u2026": ["Vi\u1ebft ch\u00fa th\u00edch album \u1ea3nh..."],
                    "Describe the purpose of the image": ["M\u00f4 t\u1ea3 n\u1ed9i dung c\u1ee7a \u1ea3nh"],
                    "Crop image to fill entire column": ["C\u1eaft \u1ea3nh \u0111\u1ec3 ch\u00e8n v\u00e0o c\u1ed9t"],
                    "The wren<br>Earns his living<br>Noiselessly.": ["H\u1ea1t g\u1ea1o l\u00e0ng ta<br>C\u00f3 v\u1ecb ph\u00f9 sa<br>C\u1ee7a s\u00f4ng Kinh Th\u1ea7y..."],
                    "Code is Poetry": ["Vi\u1ebft m\u00e3 nh\u01b0 l\u00e0m th\u01a1"],
                    "Move image forward": ["Di chuy\u1ec3n \u1ea3nh v\u1ec1 ph\u00eda tr\u01b0\u1edbc"],
                    "Move image backward": ["Di chuy\u1ec3n \u1ea3nh v\u1ec1 ph\u00eda sau"],
                    "In a village of La Mancha, the name of which I have no desire to call to mind, there lived not long since one of those gentlemen that keep a lance in the lance-rack, an old buckler, a lean hack, and a greyhound for coursing.": ["D\u00f2ng su\u1ed1i \u0111\u1ed5 v\u00e0o s\u00f4ng, s\u00f4ng \u0111\u1ed5 v\u00e0o d\u1ea3i tr\u01b0\u1eddng giang V\u00f4nga, con s\u00f4ng V\u00f4nga \u0111i ra b\u1ec3. L\u00f2ng y\u00eau nh\u00e0, y\u00eau l\u00e0ng x\u00f3m, y\u00eau mi\u1ec1n qu\u00ea tr\u1edf n\u00ean l\u00f2ng y\u00eau T\u1ed5 qu\u1ed1c. C\u00f3 th\u1ec3 n\u00e0o quan ni\u1ec7m \u0111\u01b0\u1ee3c s\u1ee9c m\u00e3nh li\u1ec7t c\u1ee7a t\u00ecnh y\u00eau m\u00e0 kh\u00f4ng \u0111em n\u00f3 v\u00e0o l\u1eeda \u0111\u1ea1n gay go th\u1eed th\u00e1ch."],
                    "Six.": ["S\u00e1u."],
                    "Five.": ["N\u0103m."],
                    "Four.": ["B\u1ed1n."],
                    "Three.": ["Ba."],
                    "Two.": ["Hai."],
                    "One.": ["M\u1ed9t."],
                    "Group": ["Nh\u00f3m"],
                    "Learn more about embeds": ["T\u00ecm hi\u1ec3u th\u00eam v\u1ec1 nh\u00fang"],
                    "https:\/\/wordpress.org\/support\/article\/embeds\/": ["https:\/\/wordpress.org\/support\/article\/embeds\/"],
                    "Paste a link to the content you want to display on your site.": ["D\u00e1n m\u1ed9t li\u00ean k\u1ebft \u0111\u1ebfn n\u1ed9i dung b\u1ea1n mu\u1ed1n hi\u1ec3n th\u1ecb tr\u00ean trang web c\u1ee7a b\u1ea1n."],
                    "Upload a video file, pick one from your media library, or add one with a URL.": ["T\u1ea3i l\u00ean video, ch\u1ecdn m\u1ed9t file t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n ho\u1eb7c th\u00eam file t\u1eeb \u0111\u1ecba ch\u1ec9 URL."],
                    "Upload an image file, pick one from your media library, or add one with a URL.": ["T\u1ea3i l\u00ean m\u1ed9t file \u1ea3nh, ch\u1ecdn t\u1eeb th\u01b0 vi\u1ec7n media c\u1ee7a b\u1ea1n ho\u1eb7c th\u00eam URL."],
                    "Enter URL here\u2026": ["Nh\u1eadp \u0111\u1ecba ch\u1ec9 URL t\u1ea1i \u0111\u00e2y..."],
                    "Add label\u2026": ["Th\u00eam nh\u00e3n..."],
                    "Display date": ["Hi\u1ec3n th\u1ecb ng\u00e0y"],
                    "Display excerpt": ["Hi\u1ec3n th\u1ecb m\u00f4 t\u1ea3 ng\u1eafn"],
                    "Display author": ["Hi\u1ec3n th\u1ecb t\u00e1c gi\u1ea3"],
                    "Use URL": ["S\u1eed d\u1ee5ng URL"],
                    "Edit RSS URL": ["Ch\u1ec9nh s\u1eeda URL RSS"],
                    "Add button text\u2026": ["Th\u00eam ch\u1eef cho n\u00fat..."],
                    "Optional placeholder\u2026": ["Placeholder kh\u00f4ng b\u1eaft bu\u1ed9c..."],
                    "Optional placeholder text": ["Ch\u1eef placeholder kh\u00f4ng b\u1eaft bu\u1ed9c"],
                    "Max number of words in excerpt": ["S\u1ed1 t\u1eeb t\u1ed1i \u0111a trong ph\u1ea7n gi\u1edbi thi\u1ec7u"],
                    "Button text": ["Ch\u1eef cho n\u00fat"],
                    "- Select -": ["- Ch\u1ecdn -"],
                    "ebook": ["ebook"],
                    "Hide the excerpt on the full content page": ["\u1ea8n \u0111o\u1ea1n tr\u00edch tr\u00ean trang n\u1ed9i dung."],
                    "Embed Amazon Kindle content.": ["Nh\u00fang n\u1ed9i dung t\u1eeb Amazon Kindle."],
                    "Sorry, this content could not be embedded.": ["R\u1ea5t ti\u1ebfc, n\u1ed9i dung n\u00e0y kh\u00f4ng th\u1ec3 nh\u00fang \u0111\u01b0\u1ee3c."],
                    "The excerpt is visible.": ["Ph\u1ea7n gi\u1edbi thi\u1ec7u \u0111ang hi\u1ec3n th\u1ecb."],
                    "The excerpt is hidden.": ["Ph\u1ea7n gi\u1edbi thi\u1ec7u b\u1ecb \u1ea9n."],
                    "Focal point picker": ["Focal Point Picker"],
                    "image %1$d of %2$d in gallery": ["\u1ea3nh %1$d c\u1ee7a %2$d trong th\u01b0 vi\u1ec7n"],
                    "Label text": ["N\u1ed9i dung nh\u00e3n"],
                    "Embedded content from %s can't be previewed in the editor.": ["N\u1ed9i dung nh\u00fang t\u1eeb %s kh\u00f4ng th\u1ec3 xem tr\u01b0\u1edbc trong c\u00f4ng c\u1ee5 so\u1ea1n th\u1ea3o."],
                    "Embed Crowdsignal (formerly Polldaddy) content.": ["Nh\u00fang n\u1ed9i dung Crowdsignal (tr\u01b0\u1edbc \u0111\u00e2y l\u00e0 Polldaddy)."],
                    "content placeholder\u0004Content\u2026": ["N\u1ed9i dung..."],
                    "button label\u0004Convert to link": ["Chuy\u1ec3n sang li\u00ean k\u1ebft"],
                    "button label\u0004Try again": ["Th\u1eed l\u1ea1i"],
                    "This image has an empty alt attribute": ["H\u00ecnh \u1ea3nh n\u00e0y ch\u01b0a c\u00f3 thu\u1ed9c t\u00ednh alt"],
                    "This image has an empty alt attribute; its file name is %s": ["H\u00ecnh \u1ea3nh n\u00e0y ch\u01b0a c\u00f3 thu\u1ed9c t\u00ednh alt; t\u00ean t\u1ec7p c\u1ee7a n\u00f3 l\u00e0 %s"],
                    "Paragraph block": ["Block v\u0103n b\u1ea3n"],
                    "Empty block; start writing or type forward slash to choose a block": ["Block tr\u1ed1ng; b\u1eaft \u0111\u1ea7u vi\u1ebft ho\u1eb7c nh\u1eadp d\u1ea5u \/ \u0111\u1ec3 ch\u1ecdn block"],
                    "Stack on mobile": ["X\u1ebfp ch\u1ed3ng tr\u00ean m\u00e0n h\u00ecnh di \u0111\u1ed9ng"],
                    "Playback controls": ["\u0110i\u1ec1u khi\u1ec3n ph\u00e1t l\u1ea1i"],
                    "Muted": ["\u0110\u00e3 t\u1eaft ti\u1ebfng"],
                    "New Column": ["C\u1ed9t m\u1edbi"],
                    "Link removed.": ["\u0110\u00e3 x\u00f3a li\u00ean k\u1ebft."],
                    "Width settings": ["C\u00e0i \u0111\u1eb7t chi\u1ec1u r\u1ed9ng"],
                    "Create": ["T\u1ea1o"],
                    "Column count": ["S\u1ed1 c\u1ed9t"],
                    "Row count": ["S\u1ed1 h\u00e0ng"],
                    "Edit table": ["S\u1eeda b\u1ea3ng"],
                    "Height in pixels": ["Chi\u1ec1u cao b\u1eb1ng pixel"],
                    "Write shortcode here\u2026": ["Nh\u1eadp shortcode \u1edf \u0111\u00e2y..."],
                    "Separator": ["Ng\u0103n c\u00e1ch"],
                    "Shortcode": ["Shortcode"],
                    "Fixed width table cells": ["C\u1ed1 \u0111\u1ecbnh chi\u1ec1u d\u00e0i \u00f4."],
                    "Write preformatted text\u2026": ["Vi\u1ebft text \u0111\u01b0\u1ee3c \u0111\u1ecbnh d\u1ea1ng tr\u01b0\u1edbc..."],
                    "Display post date": ["Hi\u1ec3n th\u1ecb ng\u00e0y \u0111\u0103ng"],
                    "Keep as HTML": ["Gi\u1eef d\u01b0\u1edbi d\u1ea1ng HTML"],
                    "Latest Posts": ["B\u00e0i vi\u1ebft m\u1edbi nh\u1ea5t"],
                    "Convert to ordered list": ["Chuy\u1ec3n sang danh s\u00e1ch c\u00f3 th\u1ee9 t\u1ef1"],
                    "Convert to unordered list": ["Chuy\u1ec3n sang danh s\u00e1ch kh\u00f4ng c\u00f3 th\u1ee9 t\u1ef1"],
                    "Display avatar": ["Hi\u1ec3n th\u1ecb \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "Your site doesn\u2019t include support for the \"%s\" block. You can leave this block intact, convert its content to a Custom HTML block, or remove it entirely.": ["Trang web c\u1ee7a b\u1ea1n kh\u00f4ng h\u1ed7 tr\u1ee3 block \"%s\". B\u1ea1n c\u00f3 th\u1ec3 gi\u1eef nguy\u00ean block n\u00e0y, chuy\u1ec3n n\u1ed9i dung c\u1ee7a n\u00f3 sang block T\u00f9y ch\u1ec9nh HTML ho\u1eb7c x\u00f3a ho\u00e0n to\u00e0n."],
                    "Your site doesn\u2019t include support for the \"%s\" block. You can leave this block intact or remove it entirely.": ["Trang web c\u1ee7a b\u1ea1n kh\u00f4ng h\u1ed7 tr\u1ee3 block \"%s\". B\u1ea1n c\u00f3 th\u1ec3 gi\u1eef nguy\u00ean block n\u00e0y ho\u1eb7c x\u00f3a ho\u00e0n to\u00e0n."],
                    "Drop cap": ["Ch\u1eef vi\u1ebft hoa"],
                    "Media area": ["Khu v\u1ef1c media"],
                    "Show media on right": ["Hi\u1ec3n th\u1ecb h\u00ecnh \u1ea3nh b\u00ean ph\u1ea3i"],
                    "Show media on left": ["Hi\u1ec3n th\u1ecb h\u00ecnh \u1ea3nh b\u00ean tr\u00e1i"],
                    "Indent list item": ["L\u00f9i danh s\u00e1ch v\u00e0o"],
                    "Outdent list item": ["L\u00f9i danh s\u00e1ch ra"],
                    "Showing large initial letter.": ["\u0110ang hi\u1ec3n th\u1ecb ch\u1eef c\u00e1i l\u1edbn."],
                    "Toggle to show a large initial letter.": ["Hi\u1ec3n th\u1ecb ch\u1eef c\u00e1i \u0111\u1ea7u ti\u00ean l\u1edbn"],
                    "Number of comments": ["S\u1ed1 l\u01b0\u1ee3ng b\u00ecnh lu\u1eadn"],
                    "Thumbnails are not cropped.": ["H\u00ecnh thu nh\u1ecf kh\u00f4ng b\u1ecb c\u1eaft."],
                    "Show download button": ["Hi\u1ec3n th\u1ecb n\u00fat t\u1ea3i v\u1ec1"],
                    "Copy URL": ["Sao ch\u00e9p URL"],
                    "Write file name\u2026": ["Vi\u1ebft t\u00ean t\u1ec7p\u2026"],
                    "Edit image": ["S\u1eeda \u1ea3nh"],
                    "Crop images": ["C\u1eaft \u1ea3nh"],
                    "Write HTML\u2026": ["Vi\u1ebft HTML..."],
                    "Alt text (alternative text)": ["Alt Text (Ch\u1eef thay th\u1ebf)"],
                    "Drag images, upload new ones or select files from your library.": ["Th\u1ea3 \u1ea3nh v\u00e0o, t\u1ea3i l\u00ean m\u1edbi ho\u1eb7c ch\u1ecdn t\u1eeb th\u01b0 vi\u1ec7n c\u00f3 s\u1eb5n c\u1ee7a b\u1ea1n."],
                    "button label\u0004Download": ["T\u1ea3i xu\u1ed1ng"],
                    "Thumbnails are cropped to align.": ["\u1ea2nh thu nh\u1ecf \u0111\u01b0\u1ee3c c\u1eaft \u0111\u00fang chi\u1ec1u."],
                    "Heading": ["Ti\u00eau \u0111\u1ec1"],
                    "Heading %d": ["Ti\u00eau \u0111\u1ec1 %d"],
                    "%s URL": ["%s URL"],
                    "Write title\u2026": ["Vi\u1ebft ti\u00eau \u0111\u1ec1\u2026"],
                    "video": ["video"],
                    "audio": ["audio"],
                    "music": ["nh\u1ea1c"],
                    "image": ["\u1ea3nh"],
                    "blog": ["blog"],
                    "post": ["b\u00e0i vi\u1ebft"],
                    "Edit URL": ["S\u1eeda URL"],
                    "Embedded content from %s": ["Nh\u00fang n\u1ed9i dung t\u1eeb %s"],
                    "button label\u0004Embed": ["Nh\u00fang"],
                    "Resize for smaller devices": ["Gi\u1ea3m k\u00edch th\u01b0\u1edbc tr\u00ean m\u00e0n h\u00ecnh nh\u1ecf"],
                    "Media settings": ["C\u00e0i \u0111\u1eb7t media"],
                    "This embed may not preserve its aspect ratio when the browser is resized.": ["Ph\u1ea7n nh\u00fang c\u00f3 th\u1ec3 kh\u00f4ng gi\u1eef nguy\u00ean t\u1ec9 l\u1ec7 khung h\u00ecnh khi tr\u00ecnh duy\u1ec7t thay \u0111\u1ed5i k\u00edch th\u01b0\u1edbc."],
                    "This embed will preserve its aspect ratio when the browser is resized.": ["Ph\u1ea7n nh\u00fang s\u1ebd gi\u1eef nguy\u00ean t\u1ec9 l\u1ec7 khung h\u00ecnh khi tr\u00ecnh duy\u1ec7t thay \u0111\u1ed5i k\u00edch th\u01b0\u1edbc."],
                    "Embed a VideoPress video.": ["Nh\u00fang video VidoPress."],
                    "Embed a WordPress.tv video.": ["Nh\u00fang video WordPress.tv."],
                    "Embed a Tumblr post.": ["Nh\u00fang b\u00e0i vi\u1ebft Tumblr."],
                    "Embed Issuu content.": ["Nh\u00fang n\u1ed9i dung t\u1eeb Issuu."],
                    "Embed Imgur content.": ["Nh\u00fang n\u1ed9i dung Imgur."],
                    "Embed a Dailymotion video.": ["Nh\u00fang video Dailymotion."],
                    "Embed CollegeHumor content.": ["Nh\u00fang n\u1ed9i dung CollegeHumor."],
                    "Embed Cloudup content.": ["Nh\u00fang n\u1ed9i dung Cloudup."],
                    "Embed an Animoto video.": ["Nh\u00fang video Animoto."],
                    "Embed a Vimeo video.": ["Nh\u00fang video Vimeo."],
                    "Embed Flickr content.": ["Nh\u00fang n\u1ed9i dung Flickr."],
                    "Embed Spotify content.": ["Nh\u00fang n\u1ed9i dung Spotify."],
                    "Embed SoundCloud content.": ["Nh\u00fang n\u1ed9i dung SoundCloud."],
                    "Embed an Instagram post.": ["Nh\u00fang b\u00e0i vi\u1ebft Instagram."],
                    "Embed a Facebook post.": ["Nh\u00fang b\u00e0i vi\u1ebft Facebook."],
                    "Embed a YouTube video.": ["Nh\u00fang video Youtube."],
                    "Embed a TED video.": ["Nh\u00fang m\u1ed9t video TED"],
                    "Embed Slideshare content.": ["Nh\u00fang n\u1ed9i dung Slideshare."],
                    "Fixed background": ["N\u1ec1n c\u1ed1 \u0111\u1ecbnh"],
                    "Enter URL to embed here\u2026": ["Nh\u1eadp \u0111\u1ecba ch\u1ec9 web URL \u0111\u1ec3 nh\u00fang..."],
                    "block title\u0004Embed": ["Nh\u00fang"],
                    "Embed a tweet.": ["Nh\u00fang m\u1ed9t tweet."],
                    "Embed Kickstarter content.": ["Nh\u00fang n\u1ed9i dung Kickstarter."],
                    "Embed a Reddit thread.": ["Nh\u00fang m\u1ed9t ch\u1ee7 \u0111\u1ec1 Reddit."],
                    "Embed ReverbNation content.": ["Nh\u00fang n\u1ed9i dung ReverbNation."],
                    "Embed Scribd content.": ["Nh\u00fang n\u1ed9i dung Scribd."],
                    "Embed SmugMug content.": ["Nh\u00fang n\u1ed9i dung SmugMug."],
                    "Embed Speaker Deck content.": ["Nh\u00fang n\u1ed9i dung Speaker Deck."],
                    "Embed Screencast content.": ["Nh\u00fang n\u1ed9i dung Screencast."],
                    "Overlay": ["L\u1edbp ph\u1ee7"],
                    "Embed Mixcloud content.": ["Nh\u00fang n\u1ed9i dung Mixcloud."],
                    "Cover": ["Cover"],
                    "Write code\u2026": ["Vi\u1ebft m\u00e3\u2026"],
                    "Classic": ["C\u1ed5 \u0111i\u1ec3n"],
                    "Add text\u2026": ["Th\u00eam ch\u1eef..."],
                    "Block has been deleted or is unavailable.": ["Block \u0111\u00e3 b\u1ecb x\u00f3a ho\u1eb7c kh\u00f4ng c\u00f3 s\u1eb5n."],
                    "Link settings": ["C\u00e0i \u0111\u1eb7t li\u00ean k\u1ebft"],
                    "Replace image": ["Thay th\u1ebf \u1ea3nh"],
                    "Avatar": ["\u1ea2nh \u0111\u1ea1i di\u1ec7n"],
                    "Convert to regular blocks": ["Chuy\u1ec3n v\u1ec1 block c\u01a1 b\u1ea3n"],
                    "Oldest to newest": ["C\u0169 nh\u1ea5t \u0111\u1ebfn m\u1edbi nh\u1ea5t"],
                    "Newest to oldest": ["M\u1edbi nh\u1ea5t \u0111\u1ebfn c\u0169 nh\u1ea5t"],
                    "Reset": ["\u0110\u1eb7t l\u1ea1i"],
                    "Z \u2192 A": ["Z \t A"],
                    "A \u2192 Z": ["A \t Z"],
                    "Order by": ["S\u1eafp x\u1ebfp theo"],
                    "Number of items": ["S\u1ed1 \u0111\u1ed1i t\u01b0\u1ee3ng"],
                    "Gallery": ["Gallery \u1ea3nh"],
                    "English": ["Ti\u1ebfng Anh"],
                    "Chapters": ["C\u00e1c m\u1ee5c"],
                    "Month": ["Th\u00e1ng"],
                    "Day": ["Ban ng\u00e0y"],
                    "Table of Contents": ["M\u1ee5c l\u1ee5c"],
                    "Contact us": ["Li\u00ean h\u1ec7 ch\u00fang t\u00f4i"],
                    "(Untitled)": ["(Kh\u00f4ng c\u00f3 ti\u00eau \u0111\u1ec1)"],
                    "Read more": ["Xem th\u00eam"],
                    "Embed a WordPress post.": ["Nh\u00fang b\u00e0i vi\u1ebft WordPress."],
                    "Taxonomy": ["Ph\u00e2n lo\u1ea1i"],
                    "The description will be displayed in the menu if the current theme supports it.": ["M\u00f4 t\u1ea3 s\u1ebd \u0111\u01b0\u1ee3c hi\u1ec3n th\u1ecb trong menu n\u1ebfu giao di\u1ec7n c\u00f3 ch\u1ee9c n\u0103ng n\u00e0y."],
                    "%1$s response to %2$s": [" %1$s b\u00ecnh lu\u1eadn cho %2$s"],
                    "Minimum height": ["Chi\u1ec1u cao t\u1ed1i thi\u1ec3u"],
                    "Previous": ["Quay v\u1ec1"],
                    "Display Settings": ["C\u00e0i \u0111\u1eb7t hi\u1ec3n th\u1ecb"],
                    "Year": ["N\u0103m"],
                    "editor button\u0004Left to right": ["Tr\u00e1i sang ph\u1ea3i"],
                    "Autoplay": ["Ph\u00e1t t\u1ef1 \u0111\u1ed9ng"],
                    "Metadata": ["Metadata"],
                    "Auto": ["T\u1ef1 \u0111\u1ed9ng"],
                    "Page break": ["Ng\u1eaft trang"],
                    "Replace": ["Thay th\u1ebf"],
                    "Delete column": ["X\u00f3a c\u1ed9t"],
                    "Tools": ["C\u00f4ng c\u1ee5"],
                    "Table": ["B\u1ea3ng"],
                    "File": ["T\u1ec7p"],
                    "Menu": ["Menu"],
                    "Empty": ["R\u1ed7ng"],
                    "Invalid": ["Kh\u00f4ng h\u1ee3p l\u1ec7"],
                    "Video": ["Video"],
                    "Columns": ["C\u1ed9t"],
                    "Large": ["L\u1edbn"],
                    "Media File": ["T\u1eadp tin \u0111a ph\u01b0\u01a1ng ti\u1ec7n"],
                    "Attachment Page": ["Trang n\u1ed9i dung \u0111\u00ednh k\u00e8m"],
                    "Include": ["Bao g\u1ed3m"],
                    "Remove image": ["X\u00f3a \u1ea3nh"],
                    "Upload": ["T\u1ea3i l\u00ean"],
                    "Remove": ["X\u00f3a b\u1ecf"],
                    "Featured image": ["\u1ea2nh \u0111\u1ea1i di\u1ec7n"],
                    "Link title": ["Ti\u00eau \u0111\u1ec1 li\u00ean k\u1ebft"],
                    "Navigation": ["\u0110i\u1ec1u h\u01b0\u1edbng"],
                    "Link": ["Li\u00ean k\u1ebft"],
                    "Link to %s": ["Li\u00ean k\u1ebft t\u1edbi %s"],
                    "Preload": ["T\u1ea3i tr\u01b0\u1edbc"],
                    "Display as dropdown": ["Hi\u1ec3n th\u1ecb d\u1ea1ng th\u1ea3 xu\u1ed1ng"],
                    "Descriptions": ["M\u00f4 t\u1ea3"],
                    "User": ["Ng\u01b0\u1eddi d\u00f9ng"],
                    "One response": ["M\u1ed9t b\u00ecnh lu\u1eadn"],
                    "Add a featured image": ["Th\u00eam \u1ea3nh \u0111\u1ea1i di\u1ec7n"],
                    "One response to %s": ["M\u1ed9t b\u00ecnh lu\u1eadn cho %s"],
                    "Menus": ["Menu"],
                    "Show post counts": ["Hi\u1ec7n s\u1ed1 b\u00e0i vi\u1ebft"],
                    "Calendar": ["L\u1ecbch"],
                    "Text": ["V\u0103n b\u1ea3n"],
                    "Select Category": ["Ch\u1ecdn chuy\u00ean m\u1ee5c"],
                    "Show hierarchy": ["Hi\u1ec7n theo c\u1ea5p b\u1eadc"],
                    "Log out": ["\u0110\u0103ng xu\u1ea5t"],
                    "Delete row": ["X\u00f3a d\u00f2ng"],
                    "Paragraph": ["\u0110o\u1ea1n"],
                    "Code": ["M\u00e3"],
                    "Outdent": ["\u0110\u1ea9y sang tr\u00e1i"],
                    "Indent": ["\u0110\u1ea9y sang ph\u1ea3i"],
                    "Unlink": ["B\u1ecf li\u00ean k\u1ebft"],
                    "List": ["Danh s\u00e1ch"],
                    "Loop": ["L\u1eb7p l\u1ea1i"],
                    "Background": ["N\u1ec1n"],
                    "There is no excerpt because this is a protected post.": ["Kh\u00f4ng c\u00f3 tr\u00edch d\u1eabn v\u00ec b\u00e0i n\u00e0y \u0111\u01b0\u1ee3c b\u1ea3o v\u1ec7."],
                    "Home": ["Trang ch\u1ee7"],
                    "Image": ["\u1ea2nh"],
                    "Post Comment": ["Ph\u1ea3n h\u1ed3i"],
                    "Next": ["Ti\u1ebfp theo"],
                    "Insert row before": ["Th\u00eam d\u00f2ng v\u00e0o tr\u01b0\u1edbc"],
                    "Insert row after": ["Th\u00eam d\u00f2ng v\u00e0o sau"],
                    "Insert column before": ["Th\u00eam c\u1ed9t v\u00e0o tr\u01b0\u1edbc"],
                    "Insert column after": ["Th\u00eam c\u1ed9t v\u00e0o sau"],
                    "Width": ["R\u1ed9ng"],
                    "About": ["Gi\u1edbi thi\u1ec7u"],
                    "Height": ["Cao"],
                    "Settings": ["C\u00e0i \u0111\u1eb7t"],
                    "HTML": ["HTML"],
                    "Leave a Reply": ["Tr\u1ea3 l\u1eddi"],
                    "No results found.": ["Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3."],
                    "Categories": ["Chuy\u00ean m\u1ee5c"],
                    "Description": ["M\u00f4 t\u1ea3"],
                    "Author": ["T\u00e1c gi\u1ea3"],
                    "Excerpt": ["T\u00f3m t\u1eaft"],
                    "Name": ["T\u00ean"],
                    "Anonymous": ["Kh\u00e1ch"],
                    "Preview": ["Xem th\u1eed"],
                    "Reply": ["Tr\u1ea3 l\u1eddi"],
                    "Size": ["K\u00edch c\u1ee1"],
                    "Add": ["Th\u00eam"],
                    "Version": ["Phi\u00ean b\u1ea3n"],
                    "Apply": ["\u00c1p d\u1ee5ng"],
                    "Edit": ["Ch\u1ec9nh s\u1eeda"],
                    "Save": ["L\u01b0u thay \u0111\u1ed5i"],
                    "Cancel": ["H\u1ee7y"],
                    "Search": ["T\u00ecm ki\u1ebfm"],
                    "Add Media": ["Th\u00eam Media"],
                    "Close": ["\u0110\u00f3ng"],
                    "Select": ["Ch\u1ecdn"],
                    "(no title)": ["(kh\u00f4ng c\u00f3 ti\u00eau \u0111\u1ec1)"],
                    "URL": ["URL"],
                    "None": ["Tr\u1ed1ng"],
                    "Title": ["Ti\u00eau \u0111\u1ec1"],
                    "No posts found.": ["Kh\u00f4ng t\u00ecm th\u1ea5y b\u00e0i vi\u1ebft n\u00e0o."],
                    "Draft": ["B\u1ea3n nh\u00e1p"]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/block-library.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/block-library.min.js?ver=3115f0b5551a55bb6d3b'
            id='wp-block-library-js'></script>
    <script id='wp-media-utils-js-translations'>
        (function (domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2023-07-03 03:51:18+0000",
            "generator": "GlotPress\/4.0.0-alpha.4",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "vi_VN"
                    },
                    "Select or Upload Media": ["Ch\u1ecdn ho\u1eb7c t\u1ea3i l\u00ean ph\u01b0\u01a1ng ti\u1ec7n"],
                    "Error while uploading file %s to the media library.": ["C\u00f3 l\u1ed7i x\u1ea3y ra khi t\u1ea3i file %s l\u00ean th\u01b0 vi\u1ec7n."],
                    "%s: This file is empty.": ["%s: File n\u00e0y tr\u1ed1ng."],
                    "%s: Sorry, this file type is not supported here.": ["%s: Xin l\u1ed7i, lo\u1ea1i file n\u00e0y kh\u00f4ng \u0111\u01b0\u1ee3c h\u1ed7 tr\u1ee3."]
                }
            },
            "comment": {"reference": "wp-includes\/js\/dist\/media-utils.js"}
        });
    </script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/media-utils.min.js?ver=f837b6298c83612cd6f6'
            id='wp-media-utils-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/components/index.js?ver=7.9.0'
            id='wc-components-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/admin-layout/index.js?ver=7.9.0'
            id='wc-admin-layout-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/csv-export/index.js?ver=7.9.0'
            id='wc-csv-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/experimental/index.js?ver=7.9.0'
            id='wc-experimental-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/customer-effort-score/index.js?ver=7.9.0'
            id='wc-customer-effort-score-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/explat/index.js?ver=7.9.0'
            id='wc-explat-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/notices/index.js?ver=7.9.0'
            id='wc-notices-js'></script>
    <script src='http://localhost/wordpress/wp-includes/js/dist/plugins.min.js?ver=0d1b90278bae7df6ecf9'
            id='wp-plugins-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/product-editor/index.js?ver=7.9.0'
            id='wc-product-editor-js'></script>
    <script id='wc-admin-app-js-extra'>
        var wcAdminAssets = {
            "path": "http:\/\/localhost\/wordpress\/wp-content\/plugins\/woocommerce\/assets\/client\/admin\/",
            "version": "7.9.0"
        };
    </script>
    <script id='wc-admin-app-js-before'>
        window.wcAdminFeatures = {
            "activity-panels": true,
            "analytics": true,
            "product-block-editor": true,
            "coupons": true,
            "core-profiler": true,
            "customer-effort-score-tracks": true,
            "import-products-task": true,
            "experimental-fashion-sample-products": true,
            "shipping-smart-defaults": true,
            "shipping-setting-tour": true,
            "homescreen": true,
            "marketing": true,
            "mobile-app-banner": true,
            "navigation": false,
            "onboarding": true,
            "onboarding-tasks": true,
            "remote-inbox-notifications": true,
            "remote-free-extensions": true,
            "payment-gateway-suggestions": true,
            "shipping-label-banner": true,
            "subscriptions": true,
            "store-alerts": true,
            "transient-notices": true,
            "woo-mobile-welcome": true,
            "wc-pay-promotion": true,
            "wc-pay-welcome-page": true
        }
    </script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/app/index.js?ver=7.9.0'
            id='wc-admin-app-js'></script>
    <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/wp-admin-scripts/category-tracking.js?ver=7.9.0'
            id='wc-admin-category-tracking-js'></script>
    <script>
        acf.data = {
            "select2L10n": {
                "matches_1": "One result is available, press enter to select it.",
                "matches_n": "%d results are available, use up and down arrow keys to navigate.",
                "matches_0": "No matches found",
                "input_too_short_1": "Please enter 1 or more characters",
                "input_too_short_n": "Please enter %d or more characters",
                "input_too_long_1": "Please delete 1 character",
                "input_too_long_n": "Please delete %d characters",
                "selection_too_long_1": "You can only select 1 item",
                "selection_too_long_n": "You can only select %d items",
                "load_more": "Loading more results&hellip;",
                "searching": "Searching&hellip;",
                "load_fail": "Loading failed"
            },
            "google_map_api": "https:\/\/maps.googleapis.com\/maps\/api\/js?libraries=places&ver=3&callback=Function.prototype&language=vi",
            "datePickerL10n": {
                "closeText": "Done",
                "currentText": "Today",
                "nextText": "Next",
                "prevText": "Prev",
                "weekHeader": "Wk",
                "monthNames": ["Th\u00e1ng M\u1ed9t", "Th\u00e1ng Hai", "Th\u00e1ng Ba", "Th\u00e1ng T\u01b0", "Th\u00e1ng N\u0103m", "Th\u00e1ng S\u00e1u", "Th\u00e1ng B\u1ea3y", "Th\u00e1ng T\u00e1m", "Th\u00e1ng Ch\u00edn", "Th\u00e1ng M\u01b0\u1eddi", "Th\u00e1ng M\u01b0\u1eddi M\u1ed9t", "Th\u00e1ng M\u01b0\u1eddi Hai"],
                "monthNamesShort": ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
                "dayNames": ["Ch\u1ee7 Nh\u1eadt", "Th\u1ee9 Hai", "Th\u1ee9 Ba", "Th\u1ee9 T\u01b0", "Th\u1ee9 N\u0103m", "Th\u1ee9 S\u00e1u", "Th\u1ee9 B\u1ea3y"],
                "dayNamesMin": ["C", "H", "B", "T", "N", "S", "B"],
                "dayNamesShort": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"]
            },
            "dateTimePickerL10n": {
                "timeOnlyTitle": "Choose Time",
                "timeText": "Time",
                "hourText": "Hour",
                "minuteText": "Minute",
                "secondText": "Second",
                "millisecText": "Millisecond",
                "microsecText": "Microsecond",
                "timezoneText": "Time Zone",
                "currentText": "Now",
                "closeText": "Done",
                "selectText": "Select",
                "amNames": ["AM", "A"],
                "pmNames": ["PM", "P"]
            },
            "colorPickerL10n": {"hex_string": "Hex String", "rgba_string": "RGBA String"},
            "mimeTypeIcon": "http:\/\/localhost\/wordpress\/wp-includes\/images\/media\/default.png",
            "mimeTypes": {
                "jpg|jpeg|jpe": "image\/jpeg",
                "gif": "image\/gif",
                "png": "image\/png",
                "bmp": "image\/bmp",
                "tiff|tif": "image\/tiff",
                "webp": "image\/webp",
                "ico": "image\/x-icon",
                "heic": "image\/heic",
                "asf|asx": "video\/x-ms-asf",
                "wmv": "video\/x-ms-wmv",
                "wmx": "video\/x-ms-wmx",
                "wm": "video\/x-ms-wm",
                "avi": "video\/avi",
                "divx": "video\/divx",
                "flv": "video\/x-flv",
                "mov|qt": "video\/quicktime",
                "mpeg|mpg|mpe": "video\/mpeg",
                "mp4|m4v": "video\/mp4",
                "ogv": "video\/ogg",
                "webm": "video\/webm",
                "mkv": "video\/x-matroska",
                "3gp|3gpp": "video\/3gpp",
                "3g2|3gp2": "video\/3gpp2",
                "txt|asc|c|cc|h|srt": "text\/plain",
                "csv": "text\/csv",
                "tsv": "text\/tab-separated-values",
                "ics": "text\/calendar",
                "rtx": "text\/richtext",
                "css": "text\/css",
                "htm|html": "text\/html",
                "vtt": "text\/vtt",
                "dfxp": "application\/ttaf+xml",
                "mp3|m4a|m4b": "audio\/mpeg",
                "aac": "audio\/aac",
                "ra|ram": "audio\/x-realaudio",
                "wav": "audio\/wav",
                "ogg|oga": "audio\/ogg",
                "flac": "audio\/flac",
                "mid|midi": "audio\/midi",
                "wma": "audio\/x-ms-wma",
                "wax": "audio\/x-ms-wax",
                "mka": "audio\/x-matroska",
                "rtf": "application\/rtf",
                "js": "application\/javascript",
                "pdf": "application\/pdf",
                "class": "application\/java",
                "tar": "application\/x-tar",
                "zip": "application\/zip",
                "gz|gzip": "application\/x-gzip",
                "rar": "application\/rar",
                "7z": "application\/x-7z-compressed",
                "psd": "application\/octet-stream",
                "xcf": "application\/octet-stream",
                "doc": "application\/msword",
                "pot|pps|ppt": "application\/vnd.ms-powerpoint",
                "wri": "application\/vnd.ms-write",
                "xla|xls|xlt|xlw": "application\/vnd.ms-excel",
                "mdb": "application\/vnd.ms-access",
                "mpp": "application\/vnd.ms-project",
                "docx": "application\/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "docm": "application\/vnd.ms-word.document.macroEnabled.12",
                "dotx": "application\/vnd.openxmlformats-officedocument.wordprocessingml.template",
                "dotm": "application\/vnd.ms-word.template.macroEnabled.12",
                "xlsx": "application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "xlsm": "application\/vnd.ms-excel.sheet.macroEnabled.12",
                "xlsb": "application\/vnd.ms-excel.sheet.binary.macroEnabled.12",
                "xltx": "application\/vnd.openxmlformats-officedocument.spreadsheetml.template",
                "xltm": "application\/vnd.ms-excel.template.macroEnabled.12",
                "xlam": "application\/vnd.ms-excel.addin.macroEnabled.12",
                "pptx": "application\/vnd.openxmlformats-officedocument.presentationml.presentation",
                "pptm": "application\/vnd.ms-powerpoint.presentation.macroEnabled.12",
                "ppsx": "application\/vnd.openxmlformats-officedocument.presentationml.slideshow",
                "ppsm": "application\/vnd.ms-powerpoint.slideshow.macroEnabled.12",
                "potx": "application\/vnd.openxmlformats-officedocument.presentationml.template",
                "potm": "application\/vnd.ms-powerpoint.template.macroEnabled.12",
                "ppam": "application\/vnd.ms-powerpoint.addin.macroEnabled.12",
                "sldx": "application\/vnd.openxmlformats-officedocument.presentationml.slide",
                "sldm": "application\/vnd.ms-powerpoint.slide.macroEnabled.12",
                "onetoc|onetoc2|onetmp|onepkg": "application\/onenote",
                "oxps": "application\/oxps",
                "xps": "application\/vnd.ms-xpsdocument",
                "odt": "application\/vnd.oasis.opendocument.text",
                "odp": "application\/vnd.oasis.opendocument.presentation",
                "ods": "application\/vnd.oasis.opendocument.spreadsheet",
                "odg": "application\/vnd.oasis.opendocument.graphics",
                "odc": "application\/vnd.oasis.opendocument.chart",
                "odb": "application\/vnd.oasis.opendocument.database",
                "odf": "application\/vnd.oasis.opendocument.formula",
                "wp|wpd": "application\/wordperfect",
                "key": "application\/vnd.apple.keynote",
                "numbers": "application\/vnd.apple.numbers",
                "pages": "application\/vnd.apple.pages"
            },
            "admin_url": "http:\/\/localhost\/wordpress\/wp-admin\/",
            "ajaxurl": "http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php",
            "nonce": "a3404ce535",
            "acf_version": "6.1.6",
            "wp_version": "6.2.2",
            "browser": "chrome",
            "locale": "vi",
            "rtl": false,
            "screen": null,
            "post_id": null,
            "validation": null,
            "editor": "classic",
            "is_pro": true
        };
    </script>
    <script>
        acf.doAction('prepare');
    </script>

    <div class="clear"></div>
</div><!-- wpwrap -->
<script type="text/javascript">if (typeof wpOnload === 'function') wpOnload();</script>
</body>
</html>


@endsection
