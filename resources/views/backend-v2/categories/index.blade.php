@extends('backend-v2.layouts.master')
<link rel="stylesheet" href="{{asset('css/backend_v2.css')}}">
@section('title')
    List Category
@endsection
@section('content')

    <div class="wrap nosubsub snipcss-yDRNt">
        <h1 class="wp-heading-inline">
            Product categories
        </h1>
        <hr class="wp-header-end">
        @if(session('error'))
            <div id="message" class="updated woocommerce-message">
                <a class="woocommerce-message-close notice-dismiss"
                   href="/wordpress/wp-admin/edit-tags.php?taxonomy=product_cat&amp;post_type=product&amp;wc-hide-notice=no_secure_connection&amp;_wc_notice_nonce=d6748f6d00">
                    Dismiss
                </a>
                <p>
                    Your store does not appear to be using a secure connection. We highly recommend serving your entire
                    website over an HTTPS connection to help keep customer data secure.
                    <a href="https://docs.woocommerce.com/document/ssl-and-https/">
                        Learn more here.
                    </a>
                </p>
            </div>
        @endif
        <div id="ajax-response">
        </div>
        <form class="search-form wp-clearfix" method="get">
            <input type="hidden" name="taxonomy" value="product_cat">
            <input type="hidden" name="post_type" value="product">
            <p class="search-box">
                <label class="screen-reader-text" for="tag-search-input">
                    Search categories:
                </label>
                <input type="search" id="tag-search-input" name="s" value="">
                <input type="submit" id="search-submit" class="button" value="Search categories">
            </p>
        </form>
        <div id="col-container" class="wp-clearfix">
            <div id="col-left">
                <div class="col-wrap">
                    <p>
                        Product categories for your store can be managed here. To change the order of categories on the
                        front-end you can drag and drop to sort them. To see more categories listed click the "screen
                        options" link at the top-right of this page.
                    </p>
                    <div class="form-wrap">
                        <h2>
                            Add new category
                        </h2>
                        <form id="addtag" method="post" action="{{route('categories.v2.create')}}" class="validate"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-field form-required term-name-wrap">
                                <label for="category_name">
                                    Tên
                                </label>
                                <input name="category_name" id="category_name" type="text" value="" size="40"
                                       aria-required="true"
                                       aria-describedby="name-description" required>
                                <p id="name-description">
                                    The name is how it appears on your site.
                                </p>
                            </div>
                            <div class="form-field term-slug-wrap">
                                <label for="category_slug">
                                    Đường dẫn
                                </label>
                                <input name="category_slug" id="category_slug" type="text" value="" size="40"
                                       aria-describedby="slug-description">
                                <p id="slug-description">
                                    “slug” là đường dẫn thân thiện của tên. Nó thường chỉ bao gồm kí tự viết thường, số
                                    và dấu gạch ngang, không dùng tiếng Việt.
                                </p>
                            </div>
                            <div class="form-field term-parent-wrap">
                                <label for="category_parentID">
                                    Parent category
                                </label>
                                <select name="category_parentID" id="category_parentID" class="postform"
                                        aria-describedby="parent-description">
                                    <option value="-1">
                                        Trống
                                    </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <p id="parent-description">
                                    Chỉ định một chuyên mục cha để tạo đa cấp. Chẳng hạn, chuyên mục Nhạc sẽ là chuyên
                                    mục cha của Hiphop và Jazz.
                                </p>
                            </div>
                            <div class="form-field term-description-wrap">
                                <label for="category_description">
                                    Mô tả
                                </label>
                                <textarea name="category_description" id="category_description" rows="5" cols="40"
                                          aria-describedby="description-description"></textarea>
                                <p id="description-description">
                                    The description is not prominent by default; however, some themes may show it.
                                </p>
                            </div>
                            <div class="form-field term-thumbnail-wrap">
                                <label>
                                    Thumbnail
                                </label>
                                <div id="product_cat_thumbnail" class="style-qrlLd">
                                    <img src=""
                                         width="60px" height="60px">
                                </div>
                                <div id="style-o1yHF" class="style-o1yHF">
                                    <input type="file" name="thumbnail" class="upload_image_button button" required>
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
                                Image
                            </th>
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
                                Count
                            </th>
                        </tr>
                        </thead>
                        <tbody>
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
                                                    }
                                                    $parent0 = \App\Models\Category::find($parent1->parent_id);
                                                    if ($parent0){
                                                        $isParent0 = true;
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
                                            <a href="{{route('categories.v2.edit', $category->id)}}">
                                                {{$category->name}}
                                            </a>
                                        </strong>
                                        <div class="row-actions">
                                                <span class="edit">
                                                    <a href="{{route('categories.v2.edit', $category->id)}}">
                                                        Edit
                                                    </a>
                                                    |
                                                </span>
                                            <span class="quick-edit">
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#modalUpdateCategory{{$category->id}}">
                                                        Quick Edit
                                                    </a>
                                                    |
                                                <!-- Modal -->
                                                 <div class="modal fade text-black"
                                                      id="modalUpdateCategory{{$category->id}}" tabindex="-1"
                                                      role="dialog" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('categories.v2.update', $category->id)}}"
                                                                  method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Update {{$category->name}}
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
                                                                                            for="category_name">Tên</label></th>
                                                                                <td><input name="category_name"
                                                                                           id="category_name"
                                                                                           type="text"
                                                                                           value="{{$category->name}}"
                                                                                           aria-required="true"
                                                                                           aria-describedby="name-description"
                                                                                           required>
                                                                                    <p class="description"
                                                                                       id="name-description">The name is how it appears on your site.</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-slug-wrap">
                                                                                <th scope="row"><label
                                                                                            for="category_slug">Đường dẫn</label></th>
                                                                                <td><input name="category_slug"
                                                                                           id="category_slug"
                                                                                           type="text"
                                                                                           value="{{$category->slug}}"
                                                                                           aria-describedby="slug-description">
                                                                                    <p class="description"
                                                                                       id="slug-description">“slug” là đường dẫn thân thiện của tên. Nó
                                                                                        thường chỉ bao gồm kí tự viết thường, số và dấu gạch ngang, không dùng tiếng Việt.</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-parent-wrap">
                                                                                <th scope="row"><label
                                                                                            for="category_parentID">Đường dẫn</label></th>
                                                                                <td>
                                                                                    <select name="category_parentID"
                                                                                            id="category_parentID"
                                                                                            class="postform"
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
                                                                                    <p id="parent-description">
                                                                                        Chỉ định một chuyên mục cha để tạo đa cấp.
                                                                                        Chẳng hạn, chuyên mục Nhạc sẽ là chuyên
                                                                                        mục cha của Hiphop và Jazz.
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-description-wrap">
                                                                                <th scope="row"><label
                                                                                            for="category_description">Mô tả</label></th>
                                                                                <td><textarea
                                                                                            name="category_description"
                                                                                            id="category_description"
                                                                                            rows="5" cols="50"
                                                                                            class="large-text"
                                                                                            aria-describedby="description-description">{{$category->description}}</textarea>
                                                                                    <p class="description"
                                                                                       id="description-description">The description is not prominent by
                                                                                        default; however, some themes may show it.</p></td>
                                                                            </tr>
                                                                            <tr class="form-field term-image-wrap">
                                                                                <th scope="row"><label
                                                                                            for="thumbnail">Đường dẫn</label></th>
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
                                                                            data-dismiss="modal">Close</button>
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
                                                        Delete
                                                    </a>
                                                <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteCategory{{$category->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('categories.v2.delete', $category->id)}}"
                                                                  method="post">
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
                                                                        Bạn có chắc chắn muốn xoá danh mục: {{$category->name}}
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
                                    <td class="description column-description" data-colname="Mô tả">
                                        @if(!$category->description)
                                            <span aria-hidden="true">—</span>
                                            <span class="screen-reader-text">Không có mô tả</span>
                                        @else
                                            {{$category->description}}
                                        @endif
                                    </td>
                                    <td class="slug column-slug" data-colname="Đường dẫn">
                                        @if(!$category->slug)
                                            <span aria-hidden="true">—</span>
                                            <span class="screen-reader-text">Không có Đường dẫn</span>
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
