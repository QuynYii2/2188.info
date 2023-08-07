@extends('backend.layouts.master')
@section('title')
    List Propertis
@endsection
@section('content')
    <div id="wpbody-content" class="snipcss-rFvJO">
        <div class="wrap woocommerce">
            <h1>
                {{$attribute->name}}
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
                                    Description
                                </th>
                                <th scope="col">
                                    Slug
                                </th>
                                <th scope="col">
                                    Counts
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$properties->isEmpty())
                                @foreach($properties as $property)
                                    <tr class="alternate">
                                        <td>
                                            <strong>
                                                <a href="{{route('properties.v2.edit', $property->id)}}">
                                                    {{$property->name}}
                                                </a>
                                            </strong>
                                            <div class="row-actions">
                                                <span class="edit">
                                                    <a href="{{route('properties.detail', $property->id)}}">
                                                        Edit
                                                    </a>
                                                    |
                                                </span>
                                                <span class="quick-edit">
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#modalEditAttribute{{$property->id}}">
                                                        Quick Edit
                                                    </a>
                                                    |
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalEditAttribute{{$property->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('properties.update', $property->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update {{$property->name}}</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="form-table" role="presentation">
                                                                            <tbody>
                                                                            <tr class="form-field form-required term-name-wrap">
                                                                                <th scope="row"><label
                                                                                            for="property_name">Tên</label></th>
                                                                                <td><input name="property_name"
                                                                                           id="property_name"
                                                                                           type="text"
                                                                                           value="{{$property->name}}"
                                                                                           aria-required="true"
                                                                                           aria-describedby="name-description"
                                                                                           required>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-slug-wrap">
                                                                                <th scope="row"><label
                                                                                            for="property_slug">Đường dẫn</label></th>
                                                                                <td><input name="property_slug"
                                                                                           id="property_slug"
                                                                                           type="text"
                                                                                           value="{{$property->slug}}"
                                                                                           aria-describedby="slug-description">
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-description-wrap">
                                                                                <th scope="row"><label
                                                                                            for="property_description">Mô tả</label></th>
                                                                                <td><textarea
                                                                                            name="property_description"
                                                                                            id="property_description"
                                                                                            rows="5" cols="50"
                                                                                            class="large-text"
                                                                                            aria-describedby="description-description">{{$property->description}}</textarea>
                                                                                    <p class="description"
                                                                                       id="description-description">The description is not prominent by
                                                                                        default; however, some themes may show it.</p></td>
                                                                            </tr>
                                                                            </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                            class="btn btn-success">Submit</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span class="delete">
                                                    <a class="delete" data-toggle="modal"
                                                       data-target="#modalDeleteAttribute{{$property->id}}">
                                                        Delete
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteAttribute{{$property->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('properties.delete', $property->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-center">
                                                                        Bạn có chắc chắn muốn xoá thuộc tính: {{$property->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        Nếu xoá bạn sẽ không thể không thể tìm thấy nó!
                                                                        Chúng tôi sẽ không chịu trách nhiệm cho việc này!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Yes</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{$property->description}}
                                        </td>
                                        <td>
                                            {{$property->slug}}
                                        </td>
                                        <td class="attribute-terms">
                                            {{count($properties)}}
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
                            <h2>Add new {{$attribute->name}}</h2>
                            <form id="addtag" method="post" action="{{route('properties.store')}}" class="validate">
                                @csrf
                                <input class="form-control" hidden="" name="attribute_id" type="text"
                                       value="{{$attribute->id}}">
                                <div class="form-field form-required term-name-wrap">
                                    <label for="property_name">Tên</label>
                                    <input class="form-control" name="property_name" id="property_name" type="text"
                                           required
                                           aria-required="true" aria-describedby="name-description">
                                </div>
                                <div class="form-field term-slug-wrap">
                                    <label for="property_slug">Đường dẫn</label>
                                    <input class="form-control" name="property_slug" id="property_slug" type="text"
                                           value=""
                                           aria-required="true" aria-describedby="slug-description">
                                </div>
                                <div class="form-field term-description-wrap">
                                    <label for="property_description">Mô tả</label>
                                    <textarea class="form-control" name="property_description" id="property_description"
                                              aria-describedby="description-description"></textarea>
                                </div>

                                <p class="submit">
                                    <input type="submit" name="submit" id="submit" class="button button-primary"
                                           value="Add new {{$attribute->name}}"> <span class="spinner"></span>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
