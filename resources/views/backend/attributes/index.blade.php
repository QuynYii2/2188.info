@php use App\Enums\AttributeStatus;use App\Models\Properties; @endphp
@extends('backend.layouts.master')
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
            <div id="col-container">
                <div id="col-right">
                    <div class="col-wrap">
                        <table class="widefat attributes-table wp-list-table ui-sortable style-zkG8L" id="style-zkG8L">
                            <thead>
                            <tr>
                                <th scope="col">
                                    {{ __('home.Name') }}
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
                                                <a href="{{route('properties.index', $attribute->id)}}">
                                                    {{$attribute->name}}
                                                </a>
                                            </strong>
                                            <div class="row-actions">
                                                <span class="edit">
                                                    <a href="{{route('attributes.detail', $attribute->id)}}">
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
                                                            <form action="{{route('attributes.delete', $attribute->id)}}" method="post">
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
                                            <a href="{{route('properties.index', $attribute->id)}}"
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
                            <form action="{{route('attributes.store')}}" method="post">
                                @csrf
                                <div class="form-field">
                                    <label for="attribute_name">
                                        {{ __('home.Name') }}
                                    </label>
                                    <input name="attribute_name" id="attribute_name" type="text" value="">
                                </div>
                                <div class="form-field">
                                    <label for="attribute_slug">
                                        Slug
                                    </label>
                                    <input name="attribute_slug" id="attribute_slug" type="text" value=""
                                           maxlength="28">
                                </div>
                                <div class="form-field">
                                    <label for="attribute_public">
                                        <input name="attribute_public" id="attribute_public" type="checkbox" value="1">
                                        Enable Archives?
                                    </label>
                                </div>
                                <div class="form-field">
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
