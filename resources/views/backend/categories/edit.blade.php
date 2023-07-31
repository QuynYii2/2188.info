@extends('backend.layouts.master')

@section('title')
    Detail Category
@endsection
@section('content')

    <div class="wrap nosubsub snipcss-yDRNt">
        <h1>Edit category</h1>
        <div id="col-container" class="wp-clearfix">
            <div class="wrap">
                <form name="edittag" id="edittag" method="post" action="{{route('seller.categories.update', $category->id)}}"
                      class="validate" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="form-table" role="presentation">
                        <tbody>
                        <tr class="form-field form-required term-name-wrap">
                            <th scope="row"><label for="category_name">Tên</label></th>
                            <td><input name="category_name" id="category_name" type="text" value="{{$category->name}}"
                                       size="40"
                                       aria-required="true" aria-describedby="name-description">
                                <p class="description" id="name-description">The name is how it appears on your
                                    site.</p></td>
                        </tr>
                        <tr class="form-field term-slug-wrap">
                            <th scope="row"><label for="category_slug">Đường dẫn</label></th>
                            <td><input name="category_slug" id="category_slug" type="text" value="{{$category->slug}}"
                                       size="40"
                                       aria-describedby="slug-description">
                                <p class="description" id="slug-description">“slug” là đường dẫn thân thiện của tên. Nó
                                    thường chỉ bao gồm kí tự viết thường, số và dấu gạch ngang, không dùng tiếng
                                    Việt.</p></td>
                        </tr>
                        <tr class="form-field term-parent-wrap">
                            <th scope="row"><label for="category_parentID">Parent category</label></th>
                            <td>
                                <select name="category_parentID" id="category_parentID" class="postform"
                                        aria-describedby="parent-description">
                                    @if($category->parent_id > 0)
                                        @php
                                            $categoryParent = \App\Models\Category::find($category->parent_id);
                                        @endphp
                                        <option value="{{$category->parent_id}}">{{$categoryParent->name}}</option>
                                    @else
                                        <option value="-1">Trống</option>
                                    @endif
                                    @foreach($categories as $categoryNews)
                                        @if($categoryNews->id !== $category->parent_id)
                                            <option value="{{$categoryNews->id}}">{{$categoryNews->name}}</option>
                                        @endif
                                    @endforeach
                                    @if($category->parent_id > 0)
                                        <option value="-1">Trống</option>
                                    @endif
                                </select>
                                <p class="description" id="parent-description">Chỉ định một chuyên mục cha để tạo đa
                                    cấp. Chẳng hạn, chuyên mục Nhạc sẽ là chuyên mục cha của Hiphop và Jazz.</p>
                            </td>
                        </tr>
                        <tr class="form-field term-description-wrap">
                            <th scope="row"><label for="category_description">Mô tả</label></th>
                            <td><textarea name="category_description" id="category_description" rows="5" cols="50"
                                          class="large-text"
                                          aria-describedby="description-description">{{$category->description}}</textarea>
                                <p class="description" id="description-description">The description is not prominent by
                                    default; however, some themes may show it.</p></td>
                        </tr>
                        {{--                        <tr class="form-field term-display-type-wrap">--}}
                        {{--                            <th scope="row" valign="top"><label>Display type</label></th>--}}
                        {{--                            <td>--}}
                        {{--                                <select id="display_type" name="display_type" class="postform">--}}
                        {{--                                    <option value="" selected="selected">Default</option>--}}
                        {{--                                    <option value="products">Products</option>--}}
                        {{--                                    <option value="subcategories">Subcategories</option>--}}
                        {{--                                    <option value="both">Both</option>--}}
                        {{--                                </select>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        <tr class="form-field term-thumbnail-wrap">
                            <th scope="row" valign="top"><label>Thumbnail</label></th>
                            <td>
                                <img width="60px" height="60px"
                                     src="{{ asset('storage/'.$category->thumbnail) }}" alt="Thumbnail">
                                <input name="thumbnail" id="thumbnail" type="file">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="edit-tag-actions">

                        <input type="submit" class="button button-primary" value="Cập nhật">

                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
