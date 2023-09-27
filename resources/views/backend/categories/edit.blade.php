@extends('backend.layouts.master')

@section('title')
    Detail Category
@endsection
@section('content')

    <div class="wrap nosubsub snipcss-yDRNt">
        <h1>{{ __('home.Edit category') }}</h1>
        <div id="col-container" class="wp-clearfix">
            <div class="wrap">
                <form name="edittag" id="edittag" method="post" action="{{route('seller.categories.update', $category->id)}}"
                      class="validate" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="form-table" role="presentation">
                        <tbody>
                        <tr class="form-field form-required term-name-wrap">
                            <th scope="row"><label for="category_name">{{ __('home.Name') }}</label></th>
                            <td><input name="category_name" id="category_name" type="text" value="{{$category->name}}"
                                       size="40"
                                       aria-required="true" aria-describedby="name-description">
                            </td>
                        </tr>
                        <tr class="form-field term-slug-wrap">
                            <th scope="row"><label for="category_slug">{{ __('home.Đường dẫn') }}</label></th>
                            <td><input name="category_slug" id="category_slug" type="text" value="{{$category->slug}}"
                                       size="40"
                                       aria-describedby="slug-description">
                              </td>
                        </tr>
                        <tr class="form-field term-parent-wrap">
                            <th scope="row"><label for="category_parentID">{{ __('home.Parent categor') }}y</label></th>
                            <td>
                                <select name="category_parentID" id="category_parentID" class="postform"
                                        aria-describedby="parent-description">
                                    @if($category->parent_id > 0)
                                        @php
                                            $categoryParent = \App\Models\Category::find($category->parent_id);
                                        @endphp
                                        <option value="{{$category->parent_id}}">{{$categoryParent->name}}</option>
                                    @else
                                        <option value="-1">{{ __('home.Trống') }}</option>
                                    @endif
                                    @foreach($categories as $categoryNews)
                                        @if($categoryNews->id !== $category->parent_id)
                                            <option value="{{$categoryNews->id}}">{{$categoryNews->name}}</option>
                                        @endif
                                    @endforeach
                                    @if($category->parent_id > 0)
                                        <option value="-1">{{ __('home.Trống') }}</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr class="form-field term-description-wrap">
                            <th scope="row"><label for="category_description">{{ __('home.Mô tả') }}</label></th>
                            <td><textarea name="category_description" id="category_description" rows="5" cols="50"
                                          class="large-text"
                                          aria-describedby="description-description">{{$category->description}}</textarea>
                              </td>
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
                            <th scope="row" valign="top"><label>{{ __('home.thumbnail') }}</label></th>
                            <td>
                                <img width="60px" height="60px"
                                     src="{{ asset('storage/'.$category->thumbnail) }}" alt="Thumbnail">
                                <input name="thumbnail" id="thumbnail" type="file">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="edit-tag-actions">

                        <input type="submit" class="button button-primary" value="{{ __('home.Cập nhật') }}">

                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
