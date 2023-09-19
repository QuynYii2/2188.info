@extends('backend.layouts.master')

@section('title')
    List Category
@endsection
@section('content')
    <div class="wrap nosubsub snipcss-yDRNt">
        <h1 class="wp-heading-inline">
            {{ __('home.Product categories') }}
        </h1>
        <div id="col-container" class="wp-clearfix">
            <div id="col-left">
                <div class="col-wrap">
                    <div class="form-wrap">
                        <h2>
                            {{ __('home.Add new category') }}
                        </h2>
                        <form id="addtag" method="post" action="{{route('seller.categories.store')}}" class="validate"
                              enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-field form-required term-name-wrap">
                                <label for="category_name">
                                    {{ __('home.Name') }}
                                </label>
                                <input name="category_name" id="category_name" type="text" value="" size="40"
                                       aria-required="true"
                                       aria-describedby="name-description" required>
                            </div>
                            <div class="form-field term-slug-wrap">
                                <label for="category_slug">
                                    {{ __('home.Đường dẫn') }}
                                </label>
                                <input name="category_slug" id="category_slug" type="text" value="" size="40"
                                       aria-describedby="slug-description">
                            </div>
                            <div class="form-field term-parent-wrap">
                                <label for="category_parentID">
                                    {{ __('home.Parent category') }}
                                </label>
                                <select name="category_parentID" id="category_parentID" class="postform w-100"
                                        aria-describedby="parent-description" style="display: block!important;">
                                    <option value="-1">
                                        {{ __('home.Trống') }}
                                    </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif


                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-field term-description-wrap">
                                <label for="category_description">
                                    {{ __('home.Mô tả') }}
                                </label>
                                <textarea name="category_description" id="category_description" rows="5" cols="40"
                                          aria-describedby="description-description"></textarea>
                            </div>
                            <div class="form-field term-thumbnail-wrap">
                                <label>
                                    {{ __('home.thumbnail') }}
                                </label>
                                <div>
                                    <input type="file" name="thumbnail" class="upload_image_button" required>
                                </div>
                                <div class="clear">
                                </div>
                            </div>
                            <p class="submit">
                                <input type="submit" name="submit" id="submit" class="button button-primary"
                                       value="Add new category">
                                <span class="spinner"></span>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div id="col-right">
                <div class="col-wrap">
                    <table class="widefat attributes-table wp-list-table ui-sortable style-zkG8L" id="style-zkG8L">
                        <thead>
                        <tr>
                            <th scope="col">
                                {{ __('home.Image') }}
                            </th>
                            <th scope="col">
                                {{ __('home.Name') }}
                            </th>
                            <th scope="col">
                                {{ __('home.Description') }}
                            </th>
                            <th scope="col">
                                Slug
                            </th>
                            <th scope="col">
                                {{ __('home.Count') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody style="overflow-y: auto; width: 80vh">
                        @if(!$categories->isEmpty())
                            @foreach($categories as $category)
                                <tr class="alternate">
                                    <td>
                                        <img width="60px" height="60px"
                                             src="{{ asset('storage/'.$category->thumbnail) }}" alt="Thumbnail">
                                    </td>
                                    <td>
                                        <strong>
                                            @php
                                                $isParent1 = false;
                                                 $isParent0 = false;
                                            @endphp
                                            @if($category->parent_id)
                                                @php
                                                    $parent1 = \App\Models\Category::find($category->parent_id);
                                                    if ($parent1){
                                                        $isParent1 = true;
                                                        $parent0 = \App\Models\Category::find($parent1->parent_id);
                                                        if ($parent0){
                                                            $isParent0 = true;
                                                        }
                                                    }
                                                @endphp
                                            @endif
                                            @if($isParent1)
                                                <span aria-hidden="true">—</span>
                                                <span aria-hidden="true"> </span>
                                            @endif
                                            @if($isParent0)
                                                <span aria-hidden="true">—</span>
                                            @endif
                                            <a href="{{route('seller.categories.edit', $category->id)}}">
                                                @if(locationHelper() == 'kr')
                                                    <div class="item-text">{{$category->name_ko }}</div>
                                                @elseif(locationHelper() == 'cn')
                                                    <div class="item-text">{{$category->name_zh}}</div>
                                                @elseif(locationHelper() == 'jp')
                                                    <div class="item-text">{{$category->name_ja}}</div>
                                                @elseif(locationHelper() == 'vi')
                                                    <div class="item-text">{{$category->name_vi}}</div>
                                                @else
                                                    <div class="item-text">{{$category->name_en}}</div>
                                                @endif
                                            </a>
                                        </strong>
                                        <div class="row-actions">
                                                <span class="edit">
                                                    <a href="{{route('seller.categories.edit', $category->id)}}">
                                                        {{ __('home.edit') }}
                                                    </a>
                                                    |
                                                </span>
                                            <span class="quick-edit">
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#modalUpdateCategory{{$category->id}}">
                                                        {{ __('home.Quick Edit') }}
                                                    </a>
                                                    |
                                                <!-- Modal -->
                                                 <div class="modal fade text-black"
                                                      id="modalUpdateCategory{{$category->id}}" tabindex="-1"
                                                      role="dialog" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('seller.categories.update', $category->id)}}"
                                                                  method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        {{ __('home.update') }}
                                                                        @if(locationHelper() == 'kr')
                                                                            <div class="item-text">{{$category->name_ko }}</div>
                                                                        @elseif(locationHelper() == 'cn')
                                                                            <div class="item-text">{{$category->name_zh}}</div>
                                                                        @elseif(locationHelper() == 'jp')
                                                                            <div class="item-text">{{$category->name_ja}}</div>
                                                                        @elseif(locationHelper() == 'vi')
                                                                            <div class="item-text">{{$category->name_vi}}</div>
                                                                        @else
                                                                            <div class="item-text">{{$category->name_en}}</div>
                                                                        @endif

                                                                    </h5>
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
                                                                                            for="category_name">{{ __('home.Name') }}</label></th>
                                                                                <td><input name="category_name"
                                                                                           id="category_name"
                                                                                           type="text"
                                                                                           value="{{$category->name}}"
                                                                                           aria-required="true"
                                                                                           aria-describedby="name-description"
                                                                                           required>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-slug-wrap">
                                                                                <th scope="row"><label
                                                                                            for="category_slug">{{ __('home.Đường dẫn') }}</label></th>
                                                                                <td><input name="category_slug"
                                                                                           id="category_slug"
                                                                                           type="text"
                                                                                           value="{{$category->slug}}"
                                                                                           aria-describedby="slug-description">
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-parent-wrap">
                                                                                <th scope="row"><label
                                                                                            for="category_parentID">{{ __('home.Đường dẫn') }}</label></th>
                                                                                <td>
                                                                                    <select name="category_parentID"
                                                                                            id="category_parentID"
                                                                                            class="postform"
                                                                                            aria-describedby="parent-description"
                                                                                            style="display: block!important;">
                                                                                        @if($category->parent_id > 0)
                                                                                            @php
                                                                                                $categoryParent = \App\Models\Category::find($category->parent_id);
                                                                                            @endphp
                                                                                            @if($categoryParent)
                                                                                                <option value="{{$category->parent_id}}">{{$categoryParent->name}}</option>
                                                                                            @endif
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
                                                                                <th scope="row"><label
                                                                                            for="category_description">{{ __('home.Mô tả') }}</label></th>
                                                                                <td><textarea
                                                                                            name="category_description"
                                                                                            id="category_description"
                                                                                            rows="5" cols="50"
                                                                                            class="large-text"
                                                                                            aria-describedby="description-description">{{$category->description}}</textarea>
                                                                                 </td>
                                                                            </tr>
                                                                            <tr class="form-field term-image-wrap">
                                                                                <th scope="row"><label
                                                                                            for="thumbnail">{{ __('home.thumbnail') }}</label></th>
                                                                                <td>
                                                                                   <input type="file" id="thumbnail"
                                                                                          name="thumbnail">
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Yes</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </span>
                                            <span class="delete">
                                                    <a class="delete" data-toggle="modal"
                                                       data-target="#modalDeleteCategory{{$category->id}}">
                                                        {{ __('home.delete') }}
                                                    </a>
                                                <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteCategory{{$category->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('seller.categories.destroy', $category->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                @method('DELETE')
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
                                                                        {{ __('home.Bạn có chắc chắn muốn xoá') }} danh mục: {{$category->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                       {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó!Chúng tôi sẽ không chịu trách nhiệm cho việc này!') }}
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
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
                                    <td class="description column-description" data-colname="Mô tả">
                                        @if(!$category->description)
                                            <span aria-hidden="true">—</span>
                                            <span class="screen-reader-text">{{ __('home.Không có mô tả') }}</span>
                                        @else
                                            {{$category->description}}
                                        @endif
                                    </td>
                                    <td class="slug column-slug" data-colname="Đường dẫn">
                                        @if(!$category->slug)
                                            <span aria-hidden="true">—</span>
                                            <span class="screen-reader-text">{{ __('home.Không có Đường dẫn') }}</span>
                                        @else
                                            {{$category->slug}}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $products = \App\Models\Product::where('category_id', $category->id)->get();
                                        @endphp
                                        {{count($products)}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="form-wrap edit-term-notes">
                        <p>
                            <strong>
                                Note:
                            </strong>
                            <br>
                            Deleting a category does not delete the products in that category. Instead,
                            products that
                            were only assigned to the deleted category are set to the category
                            <strong>
                                Uncategorized
                            </strong>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection