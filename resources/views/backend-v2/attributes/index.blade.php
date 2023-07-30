@extends('backend-v2.layouts.master')
<link rel="stylesheet" href="{{asset('css/backend_v2.css')}}">
@section('title')
    List Attributes
@endsection
@section('content')
    <div id="wpbody-content" class="snipcss-rFvJO">
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