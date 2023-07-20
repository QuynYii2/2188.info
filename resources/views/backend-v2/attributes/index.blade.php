@extends('backend-v2.layouts.master')
<link rel="stylesheet" href="{{asset('css/backend_v2.css')}}">
@section('title')
    List Attributes
@endsection
@section('content')
    <div id="wpbody-content" class="snipcss-rFvJO">
        <div id="screen-meta" class="metabox-prefs">
            <div id="contextual-help-wrap" class="hidden" tabindex="-1" aria-label="Khung Trợ Giúp Ngữ Cảnh">
                <div id="contextual-help-back">
                </div>
                <div id="contextual-help-columns">
                    <div class="contextual-help-tabs">
                        <ul>
                            <li id="tab-link-woocommerce_support_tab" class="active">
                                <a href="#tab-panel-woocommerce_support_tab"
                                   aria-controls="tab-panel-woocommerce_support_tab">
                                    Help &amp; Support
                                </a>
                            </li>
                            <li id="tab-link-woocommerce_bugs_tab">
                                <a href="#tab-panel-woocommerce_bugs_tab"
                                   aria-controls="tab-panel-woocommerce_bugs_tab">
                                    Found a bug?
                                </a>
                            </li>
                            <li id="tab-link-woocommerce_onboard_tab">
                                <a href="#tab-panel-woocommerce_onboard_tab"
                                   aria-controls="tab-panel-woocommerce_onboard_tab">
                                    Setup wizard
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="contextual-help-sidebar">
                        <p>
                            <strong>
                                For more information:
                            </strong>
                        </p>
                        <p>
                            <a href="https://woocommerce.com/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=about&amp;utm_campaign=woocommerceplugin"
                               target="_blank">
                                About WooCommerce
                            </a>
                        </p>
                        <p>
                            <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">
                                WordPress.org project
                            </a>
                        </p>
                        <p>
                            <a href="https://github.com/woocommerce/woocommerce/" target="_blank">
                                GitHub project
                            </a>
                        </p>
                        <p>
                            <a href="https://woocommerce.com/storefront/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=wcthemes&amp;utm_campaign=woocommerceplugin"
                               target="_blank">
                                Official theme
                            </a>
                        </p>
                        <p>
                            <a href="https://woocommerce.com/product-category/woocommerce-extensions/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=wcextensions&amp;utm_campaign=woocommerceplugin"
                               target="_blank">
                                Official extensions
                            </a>
                        </p>
                    </div>
                    <div class="contextual-help-tabs-wrap">
                        <div id="tab-panel-woocommerce_support_tab" class="help-tab-content active">
                            <h2>
                                Help &amp; Support
                            </h2>
                            <p>
                                Should you need help understanding, using, or extending WooCommerce,
                                <a href="https://docs.woocommerce.com/documentation/plugins/woocommerce/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=docs&amp;utm_campaign=woocommerceplugin">
                                    please read our documentation
                                </a>
                                . You will find all kinds of resources including snippets, tutorials and much more.
                            </p>
                            <p>
                                For further assistance with WooCommerce core, use the
                                <a href="https://wordpress.org/support/plugin/woocommerce">
                                    community forum
                                </a>
                                . For help with premium extensions sold on WooCommerce.com,
                                <a href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=tickets&amp;utm_campaign=woocommerceplugin">
                                    open a support request at WooCommerce.com
                                </a>
                                .
                            </p>
                            <p>
                                Before asking for help, we recommend checking the system status page to identify any
                                problems with your configuration.
                            </p>
                            <p>
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status"
                                   class="button button-primary">
                                    System status
                                </a>
                                <a href="https://wordpress.org/support/plugin/woocommerce" class="button">
                                    Community forum
                                </a>
                                <a href="https://woocommerce.com/my-account/create-a-ticket/?utm_source=helptab&amp;utm_medium=product&amp;utm_content=tickets&amp;utm_campaign=woocommerceplugin"
                                   class="button">
                                    WooCommerce.com support
                                </a>
                            </p>
                        </div>
                        <div id="tab-panel-woocommerce_bugs_tab" class="help-tab-content">
                            <h2>
                                Found a bug?
                            </h2>
                            <p>
                                If you find a bug within WooCommerce core you can create a ticket via
                                <a href="https://github.com/woocommerce/woocommerce/issues?state=open">
                                    GitHub issues
                                </a>
                                . Ensure you read the
                                <a href="https://github.com/woocommerce/woocommerce/blob/trunk/.github/CONTRIBUTING.md">
                                    contribution guide
                                </a>
                                prior to submitting your report. To help us solve your issue, please be as descriptive
                                as possible and include your
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status">
                                    system status report
                                </a>
                                .
                            </p>
                            <p>
                                <a href="https://github.com/woocommerce/woocommerce/issues/new?assignees=&amp;labels=&amp;template=1-bug-report.yml"
                                   class="button button-primary">
                                    Report a bug
                                </a>
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-status" class="button">
                                    System status
                                </a>
                            </p>
                        </div>
                        <div id="tab-panel-woocommerce_onboard_tab" class="help-tab-content">
                            <h2>
                                WooCommerce Onboarding
                            </h2>
                            <h3>
                                Profile Setup Wizard
                            </h3>
                            <p>
                                If you need to access the setup wizard again, please click on the button below.
                            </p>
                            <p>
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&amp;path=/setup-wizard"
                                   class="button button-primary">
                                    Setup wizard
                                </a>
                            </p>
                            <h3>
                                Task List
                            </h3>
                            <p>
                                If you need to enable or disable the task lists, please click on the button below.
                            </p>
                            <p>
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&amp;reset_task_list=0"
                                   class="button button-primary">
                                    Disable
                                </a>
                            </p>
                            <h3>
                                Extended task List
                            </h3>
                            <p>
                                If you need to enable or disable the extended task lists, please click on the button
                                below.
                            </p>
                            <p>
                                <a href="http://localhost/wordpress/wp-admin/admin.php?page=wc-admin&amp;reset_extended_task_list=0"
                                   class="button button-primary">
                                    Disable
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="screen-meta-links">
            <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
                <button type="button" id="contextual-help-link" class="button show-settings"
                        aria-controls="contextual-help-wrap" aria-expanded="false">
                    Trợ giúp
                </button>
            </div>
        </div>
        <div class="woocommerce-layout__jitm" id="jp-admin-notices">
        </div>
        <div class="woocommerce-layout__notice-list-hide" id="wp__notice-list">
        </div>
        <div>
            <div class="woocommerce-layout">
                <div class="woocommerce-layout__primary" id="woocommerce-layout__primary">
                    <div id="woocommerce-layout__notice-list" class="woocommerce-layout__notice-list">
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap woocommerce">
            <h1>
                Attributes
            </h1>
            @if(session('error'))
                <div id="message" class="updated woocommerce-message">
                    <a class="woocommerce-message-close notice-dismiss"
                       href="/wordpress/wp-admin/edit.php?post_type=product&amp;page=product_attributes&amp;wc-hide-notice=no_secure_connection&amp;_wc_notice_nonce=d6748f6d00">
                        Dismiss
                    </a>
                    <p>
                        Your store does not appear to be using a secure connection. We highly recommend serving your
                        entire
                        website over an HTTPS connection to help keep customer data secure.
                        <a href="https://docs.woocommerce.com/document/ssl-and-https/">
                            Learn more here.
                        </a>
                    </p>
                </div>
            @endif
            <br class="clear">
            <div id="col-container">
                <div id="col-right">
                    <div class="col-wrap">
                        <table class="widefat attributes-table wp-list-table ui-sortable style-zkG8L" id="style-zkG8L">
                            <thead>
                            <tr>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Slug
                                </th>
                                <th scope="col">
                                    Order by
                                </th>
                                <th scope="col">
                                    Terms
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$attributes->isEmpty())
                                @foreach($attributes as $attribute)
                                    <tr class="alternate">
                                        <td>
                                            <strong>
                                                <a href="{{route('properties.v2.show', $attribute->id)}}">
                                                    {{$attribute->name}}
                                                </a>
                                            </strong>
                                            <div class="row-actions">
                                                <span class="edit">
                                                    <a href="{{route('attributes.v2.edit', $attribute->id)}}">
                                                        Edit
                                                    </a>
                                                    |
                                                </span>
                                                <span class="delete">
                                                    <a class="delete" data-toggle="modal" data-target="#modalDeleteAttribute{{$attribute->id}}">
                                                        Delete
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black" id="modalDeleteAttribute{{$attribute->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('attributes.v2.delete', $attribute->id)}}" method="post">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-center">
                                                                        Bạn có chắc chắn muốn xoá thuộc tính: {{$attribute->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        Nếu xoá bạn sẽ không thể không thể tìm thấy nó!
                                                                        Chúng tôi sẽ không chịu trách nhiệm cho việc này!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{$attribute->slug}}
                                        </td>
                                        <td>
                                            Custom ordering
                                        </td>
                                        <td class="attribute-terms">
                                            @php
                                                $properties = \App\Models\Properties::where('attribute_id', $attribute->id)->get();
                                            @endphp
                                            @if($properties->isEmpty())
                                                <span class="na">
                                                    –
                                                </span>
                                            @else
                                                @foreach($properties as $property)
                                                    <span class="text-success">
                                                        {{$property->name}}
                                                    </span>
                                                    |
                                                @endforeach
                                            @endif
                                            <br>
                                            <a href="{{route('properties.v2.show', $attribute->id)}}"
                                               class="configure-terms">
                                                Configure terms
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="col-left">
                    <div class="col-wrap">
                        <div class="form-wrap">
                            <h2>
                                Add new attribute
                            </h2>
                            <p>
                                Attributes let you define extra product data, such as size or color. You can use these
                                attributes in the shop sidebar using the "layered nav" widgets.
                            </p>
                            <form action="{{route('attributes.v2.create')}}" method="post">
                                @csrf
                                <div class="form-field">
                                    <label for="attribute_name">
                                        Name
                                    </label>
                                    <input name="attribute_name" id="attribute_name" type="text" value="">
                                    <p class="description">
                                        Name for the attribute (shown on the front-end).
                                    </p>
                                </div>
                                <div class="form-field">
                                    <label for="attribute_slug">
                                        Slug
                                    </label>
                                    <input name="attribute_slug" id="attribute_slug" type="text" value=""
                                           maxlength="28">
                                    <p class="description">
                                        Unique slug/reference for the attribute; must be no more than 28 characters.
                                    </p>
                                </div>
                                <div class="form-field">
                                    <label for="attribute_public">
                                        <input name="attribute_public" id="attribute_public" type="checkbox" value="1">
                                        Enable Archives?
                                    </label>
                                    <p class="description">
                                        Enable this if you want this attribute to have product archives in your store.
                                    </p>
                                </div>
                                <div class="form-field">
                                    <label for="attribute_orderby">
                                        Default sort order
                                    </label>
                                    <select name="attribute_orderby" id="attribute_orderby">
                                        <option value="menu_order">
                                            Custom ordering
                                        </option>
                                        <option value="name">
                                            Name
                                        </option>
                                        <option value="name_num">
                                            Name (numeric)
                                        </option>
                                        <option value="id">
                                            Term ID
                                        </option>
                                    </select>
                                    <p class="description">
                                        Determines the sort order of the terms on the frontend shop product pages. If
                                        using custom ordering, you can drag and drop the terms in this attribute.
                                    </p>
                                </div>
                                <p class="submit">
                                    <button type="submit" name="add_new_attribute" id="submit"
                                            class="button button-primary" value="Add attribute">
                                        Add attribute
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="woocommerce-embedded-layout__primary" id="woocommerce-embedded-layout__primary">
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

@endsection