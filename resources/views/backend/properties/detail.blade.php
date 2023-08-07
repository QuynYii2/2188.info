@extends('backend.layouts.master')

@section('title')
    Detail Property
@endsection
@section('content')
    <div id="wpbody-content">
        <div class="wrap">
            @php
                $attribute = \App\Models\Attribute::find($property->attribute_id);
            @endphp
            <h1>Edit {{$attribute->name}}</h1>

            <div id="ajax-response"></div>

            <form method="post" action="{{route('properties.update', $property->id)}}"
                  class="validate">
                @csrf
                <table class="form-table" role="presentation">
                    <tbody>
                    <tr class="form-field form-required term-name-wrap">
                        <th scope="row"><label for="property_name">Tên</label></th>
                        <td><input name="property_name" id="property_name" type="text" value="{{$property->name}}"
                                   aria-required="true"
                                   aria-describedby="name-description" required>
                        </td>
                    </tr>
                    <tr class="form-field term-slug-wrap">
                        <th scope="row"><label for="property_slug">Đường dẫn</label></th>
                        <td><input name="property_slug" id="property_slug" type="text" value="{{$property->slug}}"
                                   aria-describedby="slug-description">
                        </td>
                    </tr>
                    <tr class="form-field term-description-wrap">
                        <th scope="row"><label for="property_description">Mô tả</label></th>
                        <td><textarea name="property_description" id="property_description" rows="5" cols="50"
                                      class="large-text"
                                      aria-describedby="description-description">{{$property->description}}</textarea>
                    </tr>
                    </tbody>
                </table>

                <div class="edit-tag-actions">
                    <input type="submit" class="btn btn-primary" value="Cập nhật">
                    <span id="delete-link">
                            <a class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModal">
                                Xóa
                            </a>
                    </span>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('properties.v2.delete', $property->id)}}" method="post">
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
@endsection
