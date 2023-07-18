<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Link to Bootstrap CSS -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Products &lsaquo; Wordpress &#8212; WordPress</title>
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
                pagenow = 'edit-product',
                typenow = 'product',
                adminpage = 'edit-php',
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
        <script id='woocommerce_quick-edit-js-extra'>
            var woocommerce_quick_edit = {"strings": {"allow_reviews": "Enable reviews"}};
        </script>

        <script>
            /* <![CDATA[ */
            var userSettings = {"url": "\/wordpress\/", "uid": "1", "time": "1689654379", "secure": ""};
            var _wpUtilSettings = {"ajax": {"url": "\/wordpress\/wp-admin\/admin-ajax.php"}};
            var _wpMediaModelsL10n = {"settings": {"ajaxurl": "\/wordpress\/wp-admin\/admin-ajax.php", "post": {"id": 0}}};/* ]]> */
        </script>
        <script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=wp-polyfill-inert,regenerator-runtime,wp-polyfill,wp-hooks,jquery-core,jquery-migrate,utils,jquery-ui-core,jquery-ui-mouse,jquer&amp;load%5Bchunk_1%5D=y-ui-sortable,underscore,backbone,wp-util,wp-backbone,media-models,moxiejs,plupload&amp;ver=6.2.2'></script>
        <script src='https://stats.wp.com/w.js?ver=202329' id='woo-tracks-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70'
                id='jquery-blockui-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js?ver=7.9.0'
                id='jquery-tiptip-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/woocommerce_admin.min.js?ver=7.9.0'
                id='woocommerce_admin-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.6'
                id='selectWoo-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/wc-enhanced-select.min.js?ver=7.9.0'
                id='wc-enhanced-select-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/quick-edit.min.js?ver=7.9.0'
                id='woocommerce_quick-edit-js'></script>
        <!--[if lt IE 8]>
        <script src='http://localhost/wordpress/wp-includes/js/json2.min.js?ver=2015-05-03' id='json2-js'></script>
        <![endif]-->
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
        <script id='accounting-js-extra'>
            var accounting_params = {"mon_decimal_point": "."};
        </script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/accounting/accounting.min.js?ver=0.4.2'
                id='accounting-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/round/round.min.js?ver=7.9.0'
                id='round-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/stupidtable/stupidtable.min.js?ver=7.9.0'
                id='stupidtable-js'></script>
        <script id='wc-admin-meta-boxes-js-extra'>
            var woocommerce_admin_meta_boxes = {
                "remove_item_notice": "Are you sure you want to remove the selected items?",
                "remove_fee_notice": "Are you sure you want to remove the selected fees?",
                "remove_shipping_notice": "Are you sure you want to remove the selected shipping?",
                "i18n_select_items": "Please select some items.",
                "i18n_do_refund": "Are you sure you wish to process this refund? This action cannot be undone.",
                "i18n_delete_refund": "Are you sure you wish to delete this refund? This action cannot be undone.",
                "i18n_delete_tax": "Are you sure you wish to delete this tax column? This action cannot be undone.",
                "remove_item_meta": "Remove this item meta?",
                "name_label": "Name",
                "remove_label": "Remove",
                "click_to_toggle": "Click to toggle",
                "values_label": "Value(s)",
                "text_attribute_tip": "Enter some text, or some attributes by pipe (|) separating values.",
                "visible_label": "Visible on the product page",
                "used_for_variations_label": "Used for variations",
                "new_attribute_prompt": "Enter a name for the new attribute term:",
                "calc_totals": "Recalculate totals? This will calculate taxes based on the customers country (or the store base country) and update totals.",
                "copy_billing": "Copy billing information to shipping information? This will remove any currently entered shipping information.",
                "load_billing": "Load the customer's billing information? This will remove any currently entered billing information.",
                "load_shipping": "Load the customer's shipping information? This will remove any currently entered shipping information.",
                "featured_label": "Featured",
                "prices_include_tax": "no",
                "tax_based_on": "shipping",
                "round_at_subtotal": "no",
                "no_customer_selected": "No customer selected",
                "plugin_url": "http:\/\/localhost\/wordpress\/wp-content\/plugins\/woocommerce",
                "ajax_url": "http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php",
                "order_item_nonce": "212783cf41",
                "add_attribute_nonce": "e89c58b497",
                "save_attributes_nonce": "89eb8d58de",
                "add_attributes_and_variations": "59ac70432e",
                "calc_totals_nonce": "d7741ee5cd",
                "get_customer_details_nonce": "e1b6ea92a2",
                "search_products_nonce": "237c848c22",
                "grant_access_nonce": "9c11287961",
                "revoke_access_nonce": "133b32be3e",
                "add_order_note_nonce": "f53c723796",
                "delete_order_note_nonce": "e24f8c110e",
                "calendar_image": "http:\/\/localhost\/wordpress\/wp-content\/plugins\/woocommerce\/assets\/images\/calendar.png",
                "post_id": "42",
                "base_country": "VN",
                "currency_format_num_decimals": "2",
                "currency_format_symbol": "$",
                "currency_format_decimal_sep": ".",
                "currency_format_thousand_sep": ",",
                "currency_format": "%s%v",
                "rounding_precision": "6",
                "tax_rounding_mode": "1",
                "product_types": ["simple", "grouped", "variable", "external"],
                "i18n_download_permission_fail": "Could not grant access - the user may already have permission for this file or billing email is not set. Ensure the billing email is set, and the order has been saved.",
                "i18n_permission_revoke": "Are you sure you want to revoke access to this download?",
                "i18n_tax_rate_already_exists": "You cannot add the same tax rate twice!",
                "i18n_delete_note": "Are you sure you wish to delete this note? This action cannot be undone.",
                "i18n_apply_coupon": "Enter a coupon code to apply. Discounts are applied to line totals, before taxes.",
                "i18n_add_fee": "Enter a fixed amount or percentage to apply as a fee.",
                "i18n_attribute_name_placeholder": "New attribute",
                "i18n_product_simple_tip": "<b>Simple \u2013<\/b> covers the vast majority of any products you may sell. Simple products are shipped and have no options. For example, a book.",
                "i18n_product_grouped_tip": "<b>Grouped \u2013<\/b> a collection of related products that can be purchased individually and only consist of simple products. For example, a set of six drinking glasses.",
                "i18n_product_external_tip": "<b>External or Affiliate \u2013<\/b> one that you list and describe on your website but is sold elsewhere.",
                "i18n_product_variable_tip": "<b>Variable \u2013<\/b> a product with variations, each of which may have a different SKU, price, stock option, etc. For example, a t-shirt available in different colors and\/or sizes.",
                "i18n_product_other_tip": "Product types define available product details and attributes, such as downloadable files and variations. They\u2019re also used for analytics and inventory management.",
                "i18n_product_description_tip": "Describe this product. What makes it unique? What are its most important features?",
                "i18n_product_short_description_tip": "Summarize this product in 1-2 short sentences. We\u2019ll show it at the top of the page.",
                "i18n_save_attribute_variation_tip": "Make sure you enter the name and values for each attribute.",
                "i18n_product_image_tip": "For best results, upload JPEG or PNG files that are 1000 by 1000 pixels or larger. Maximum upload file size: 40 MB.",
                "i18n_remove_used_attribute_confirmation_message": "If you remove this attribute, customers will no longer be able to purchase some variations of this product.",
                "i18n_add_attribute_error_notice": "Adding new attribute failed."
            };
        </script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/meta-boxes.min.js?ver=7.9.0'
                id='wc-admin-meta-boxes-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/meta-boxes-product.min.js?ver=7.9.0'
                id='wc-admin-product-meta-boxes-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/jquery-serializejson/jquery.serializejson.min.js?ver=2.8.1'
                id='serializejson-js'></script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/backbone-modal.min.js?ver=7.9.0'
                id='wc-backbone-modal-js'></script>
        <script id='wc-admin-variation-meta-boxes-js-extra'>
            var woocommerce_admin_meta_boxes_variations = {
                "post_id": "42",
                "plugin_url": "http:\/\/localhost\/wordpress\/wp-content\/plugins\/woocommerce",
                "ajax_url": "http:\/\/localhost\/wordpress\/wp-admin\/admin-ajax.php",
                "woocommerce_placeholder_img_src": "http:\/\/localhost\/wordpress\/wp-content\/uploads\/woocommerce-placeholder.png",
                "add_variation_nonce": "bcbfbf20a1",
                "link_variation_nonce": "59e7740c66",
                "delete_variations_nonce": "83828da31a",
                "load_variations_nonce": "a03b3a07c7",
                "save_variations_nonce": "5da9ba4175",
                "bulk_edit_variations_nonce": "8650fd75e4",
                "i18n_link_all_variations": "Do you want to generate all variations? This will create a new variation for each and every possible combination of variation attributes (max 50 per run).",
                "i18n_enter_a_value": "Enter a value",
                "i18n_enter_menu_order": "Variation menu order (determines position in the list of variations)",
                "i18n_enter_a_value_fixed_or_percent": "Enter a value (fixed or %)",
                "i18n_delete_all_variations": "Are you sure you want to delete all variations? This cannot be undone.",
                "i18n_last_warning": "Last warning, are you sure?",
                "i18n_choose_image": "Choose an image",
                "i18n_set_image": "Set variation image",
                "i18n_variation_added": "1 variation added",
                "i18n_variations_added": "%qty% variations added",
                "i18n_remove_variation": "Are you sure you want to remove this variation?",
                "i18n_scheduled_sale_start": "Sale start date (YYYY-MM-DD format or leave blank)",
                "i18n_scheduled_sale_end": "Sale end date (YYYY-MM-DD format or leave blank)",
                "i18n_edited_variations": "Save changes before changing page?",
                "i18n_variation_count_single": "1 variation",
                "i18n_variation_count_plural": "%qty% variations",
                "variations_per_page": "15"
            };
        </script>
        <script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/js/admin/meta-boxes-product-variation.min.js?ver=7.9.0'
                id='wc-admin-variation-meta-boxes-js'></script>

        <meta name='apple-itunes-app' content='app-id=1389130815'>
        <script type="text/javascript">var _wpColorScheme = {
                "icons": {
                    "base": "#a7aaad",
                    "focus": "#72aee6",
                    "current": "#fff"
                }
            };</script>
        <link id="wp-admin-canonical" rel="canonical"
              href="http://localhost/wordpress/wp-admin/edit.php?post_type=product"/>
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
</head>

<body>

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


@include('sweetalert::alert')
<!-- Main Content -->
<div class="container-fluid bg-white card-header">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-sm-3 col-12 col-md-3 col-lg-2" style="padding: 0">
            @include('backend-v2.layouts.partials.side-bar')
        </div>

        <!-- Page Content -->
        <div class="col-sm-9 col-12 col-md-9 col-lg-10" style="padding: 0">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>

<script src='http://localhost/wordpress/wp-admin/load-scripts.php?c=1&amp;load%5Bchunk_0%5D=hoverIntent&amp;ver=6.2.2'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/i18n.min.js?ver=9e794f35a71bb98672ae'
        id='wp-i18n-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/common.min.js?ver=6.2.2' id='common-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/hoverintent-js.min.js?ver=2.2.1'
        id='hoverintent-js-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/admin-bar.min.js?ver=6.2.2' id='admin-bar-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/jquery/ui/menu.min.js?ver=1.13.2'
        id='jquery-ui-menu-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca'
        id='wp-dom-ready-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/a11y.min.js?ver=ecce20f002eda4c19664'
        id='wp-a11y-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/jquery/ui/autocomplete.min.js?ver=1.13.2'
        id='jquery-ui-autocomplete-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/tags-suggest.min.js?ver=6.2.2' id='tags-suggest-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/inline-edit-post.min.js?ver=6.2.2'
        id='inline-edit-post-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/heartbeat.min.js?ver=6.2.2' id='heartbeat-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/svg-painter.js?ver=6.2.2' id='svg-painter-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/wp-auth-check.min.js?ver=6.2.2'
        id='wp-auth-check-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/jquery/ui/draggable.min.js?ver=1.13.2'
        id='jquery-ui-draggable-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/jquery/ui/slider.min.js?ver=1.13.2'
        id='jquery-ui-slider-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/jquery/jquery.ui.touch-punch.js?ver=0.2.2'
        id='jquery-touch-punch-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/iris.min.js?ver=1.1.1' id='iris-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/shortcode.min.js?ver=6.2.2' id='shortcode-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/plupload/wp-plupload.min.js?ver=6.2.2'
        id='wp-plupload-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=4.2.17'
        id='mediaelement-core-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/mediaelement/mediaelement-migrate.min.js?ver=6.2.2'
        id='mediaelement-migrate-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=6.2.2'
        id='wp-mediaelement-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/api-request.min.js?ver=6.2.2'
        id='wp-api-request-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/clipboard.min.js?ver=2.0.11' id='clipboard-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/media-views.min.js?ver=6.2.2' id='media-views-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/media-editor.min.js?ver=6.2.2' id='media-editor-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/media-audiovideo.min.js?ver=6.2.2'
        id='media-audiovideo-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/mce-view.min.js?ver=6.2.2' id='mce-view-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/imgareaselect/jquery.imgareaselect.min.js?ver=6.2.2'
        id='imgareaselect-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/image-edit.min.js?ver=6.2.2' id='image-edit-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/vendor/lodash.min.js?ver=4.17.19'
        id='lodash-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/vendor/moment.min.js?ver=2.29.4'
        id='moment-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/vendor/react.min.js?ver=18.2.0' id='react-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/vendor/react-dom.min.js?ver=18.2.0'
        id='react-dom-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/url.min.js?ver=16185fce2fb043a0cfed'
        id='wp-url-js'></script>
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
<script src='http://localhost/wordpress/wp-includes/js/dist/keycodes.min.js?ver=184b321fa2d3bc7fd173'
        id='wp-keycodes-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/priority-queue.min.js?ver=422e19e9d48b269c5219'
        id='wp-priority-queue-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/compose.min.js?ver=7d5916e3b2ef0ea01400'
        id='wp-compose-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/date.min.js?ver=f8550b1212d715fbf745'
        id='wp-date-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/primitives.min.js?ver=dfac1545e52734396640'
        id='wp-primitives-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/private-apis.min.js?ver=6f247ed2bc3571743bba'
        id='wp-private-apis-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/redux-routine.min.js?ver=d86e7e9f062d7582f76b'
        id='wp-redux-routine-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/data.min.js?ver=90cebfec01d1a3f0368e'
        id='wp-data-js'></script>
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
<script src='http://localhost/wordpress/wp-includes/js/dist/server-side-render.min.js?ver=d1bc93277666143a3f5e'
        id='wp-server-side-render-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/viewport.min.js?ver=4f6bd168b2b8b45c8a6b'
        id='wp-viewport-js'></script>
<script src='http://localhost/wordpress/wp-admin/js/editor.min.js?ver=6.2.2' id='editor-js'></script>
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
<script src='http://localhost/wordpress/wp-includes/js/dist/style-engine.min.js?ver=528e6cf281ffc9b7bd3c'
        id='wp-style-engine-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/token-list.min.js?ver=f2cf0bb3ae80de227e43'
        id='wp-token-list-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/wordcount.min.js?ver=feb9569307aec24292f2'
        id='wp-wordcount-js'></script>
<script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/app/index.js?ver=7.9.0'
        id='wc-admin-app-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/block-library.min.js?ver=3115f0b5551a55bb6d3b'
        id='wp-block-library-js'></script>
<script src='http://localhost/wordpress/wp-content/plugins/woocommerce/assets/client/admin/wp-admin-scripts/product-tracking.js?ver=7.9.0'
        id='wc-admin-product-tracking-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/reusable-blocks.min.js?ver=a7367a6154c724b51b31'
        id='wp-reusable-blocks-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/block-editor.min.js?ver=43e40e04f77d598ede94'
        id='wp-block-editor-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/preferences.min.js?ver=c66e137a7e588dab54c3'
        id='wp-preferences-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/blocks.min.js?ver=639e14271099dc3d85bf' id='wp-blocks-js'></script>
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
<script src='http://localhost/wordpress/wp-includes/js/dist/rich-text.min.js?ver=9307ec04c67d79b6e813'
        id='wp-rich-text-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/api-fetch.min.js?ver=bc0029ca2c943aec5311'
        id='wp-api-fetch-js'></script>
<script src='http://localhost/wordpress/wp-includes/js/dist/warning.min.js?ver=4acee5fc2fd9a24cefc2'
        id='wp-warning-js'></script>
</html>
