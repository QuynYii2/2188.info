@extends('backend.layouts.master')

@section('title')
    Detail Attributes
@endsection
@section('content')
    <div id="wpbody-content">
        <div class="wrap woocommerce">
            <h1>Edit attribute</h1>

            <form action="{{route('attributes.update', $attribute->id)}}" method="post">
                @csrf
                <table class="form-table">
                    <tbody>
                    <tr class="form-field form-required">
                        <th scope="row" valign="top">
                            <label for="attribute_name">Name</label>
                        </th>
                        <td>
                            <input name="attribute_name" id="attribute_name" type="text"
                                   value="{{$attribute->name}}" required>
                        </td>
                    </tr>
                    <tr class="form-field form-required">
                        <th scope="row" valign="top">
                            <label for="attribute_slug">Slug</label>
                        </th>
                        <td>
                            <input name="attribute_slug" id="attribute_slug" type="text"
                                   value="{{$attribute->slug}}"
                                   maxlength="50">
                        </td>
                    </tr>
                    <tr class="form-field form-required">
                        <th scope="row" valign="top">
                            <label for="attribute_public">Enable archives?</label>
                        </th>
                        <td>
                            <input name="attribute_public" id="attribute_public" type="checkbox" value="1">
                        </td>
                    </tr>
                    <tr class="form-field form-required">
                        <th scope="row" valign="top">
                            <label for="attribute_orderby">Default sort order</label>
                        </th>
                        <td>
                            <select name="attribute_orderby" id="attribute_orderby">
                                <option value="menu_order" selected="selected">Custom ordering</option>
                                <option value="name">Name</option>
                                <option value="name_num">Name (numeric)</option>
                                <option value="id">Term ID</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="submit">
                    <button type="submit" name="save_attribute" id="submit" class="button-primary" value="Update">
                        Update
                    </button>
                </p>
            </form>
        </div>
        <div>
            <div class="woocommerce-embedded-layout__primary" id="woocommerce-embedded-layout__primary"></div>
        </div>

        <div class="clear"></div>
    </div>
    <div>
        <div class="woocommerce-embedded-layout__primary" id="woocommerce-embedded-layout__primary">
        </div>
    </div>
    <div class="clear">
    </div>
@endsection
