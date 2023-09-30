@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend.layouts.master')

@section('title')
    Create Product
@endsection
@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\PermissionUserStatus;

    if (auth()->check() != null){
        $permissionUsers = DB::table('permissions')
        ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
        ->select('permissions.*')
        ->get();
    } else {
        $permissionUsers[]= null;
    }

@endphp
<style>
    .btn-success {
        color: white !important;
    }
    .labelCheckboxCategory{
        display: inline-table;
    }
    .name {
        margin-top: 20px;
        font-size: 14px;
        margin-bottom: 5px;
    }

    @media all {

        .attachment .portrait img {
            max-width: 100%;
        }

        .attachment .thumbnail img {
            top: 0;
            left: 0;
            position: absolute;
        }

        .attachment .thumbnail .centered img {
            transform: translate(-50%, -50%);
        }

        .attachment .landscape img {
            max-height: 100%;
        }
    }

    .attribute-form {
        background: white;
        padding: 20px;
    }

    #checkboxes {
        background-color: white;
        height: 30vh;
        overflow-y: auto !important;
        display: none;
        border: 1px #dadada solid;
    }

    .dropdown-content {
        margin-top: 10px;
    }

    #checkboxes label {
        display: block;
    }

    /**/
    select {
        display: none;
    }

    #selectAttribute{
        display: block !important;
    }
</style>
@section('content')

    <div id="wpcontent">
        <div id="wpbody" role="main">
            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
                <h5 class="card-title">{{ __('home.Thêm mới sản phẩm') }}</h5>
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('success_update_product') }}
                    </div>
                @endif
            </div>
            <div class="container-fluid">
                <form action="{{ route('seller.products.store') }}" method="post" enctype="multipart/form-data"
                      class="form-horizontal row" role="form">
                    @csrf
                    @if (session('success_update_product'))
                        <div class="alert alert-success">
                            {{ session('error_create_product') }}
                        </div>
                    @endif

                    <div class=".col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">{{ __('home.Tên sản phẩm') }}</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder={{ __('home.Nhập tên sản phẩm')}} required>
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Mã sản phẩm') }}</div>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder={{ __('home.Nhập mã sản phẩm') }} required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">{{ __('home.Mô tả ngắn') }}</label>
                            <textarea id="short_description" class="form-control description" name="short_description"
                                      rows="5">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('home.Mô tả chi tiết') }}</label>
                            <textarea id="description" class="form-control description" name="description" rows="5">
                            </textarea>
                        </div>
                        <div class="form-group mb-3">
                            @include('backend.products.demo')
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">{{ __('home.Giá bán') }}</div>
                            <input type="number" class="form-control" name="giaban" id="name"
                                   placeholder={{ __('home.Nhập giá bán') }}
                                   required min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập giá khuyến mãi(nếu có)') }}</div>
                            <input type="number" class="form-control" name="giakhuyenmai" id="name"
                                   placeholder={{ __('home.Nhập số lượng') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập số lượng') }}</div>
                            <input type="number" class="form-control" name="qty" id="qty"
                                   placeholder={{ __('home.Nhập giá khuyến mãi') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Xuất xứ') }}</div>
                            <input type="text" class="form-control" name="origin" id="origin"
                                   placeholder="{{ __('home.Nhập xuất xứ') }}">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Sản phẩm tối thiểu') }}</div>
                            <input type="number" class="form-control" name="min" id="min"
                                   placeholder={{ __('home.Nhập số lượng tối thiểu') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="name">{{ __('home.Mua nhiều giảm giá') }}</div>
                            </div>
                            <div>
                                <div class="">
                                    <div class="add-fields" data-af_base="#base-package-fields"
                                         data-af_target=".packages">
                                        <div class="packages">

                                        </div>
                                        <button type="button" class="btn add-form-field"><i
                                                    class="fa-solid fa-plus"></i> {{ __('home.Thêm khoảng giá') }}
                                        </button>
                                    </div>
                                    <div id="base-package-fields" hidden>
                                        <div class="form-group form-group-price">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <input type="number" required class="form-control form-price"
                                                           name="starts[]" placeholder={{ __('home.Từ (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" required class="form-control form-price"
                                                           name="ends[]" placeholder={{ __('home.Đến (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" required class="form-control form-price" name="sales[]"
                                                           placeholder={{ __('home.Giảm %') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" required class="form-control form-price" name="days[]"
                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" required class="form-control form-price" name="ships[]"
                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn remove-form-field"><i
                                                                class="fa-regular fa-trash-can"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Tất cả danh mục') }}</div>
                            @php
                                $categories = DB::table('categories')->where('parent_id', null)->get();
                            @endphp
                            <div id="checkboxes" style=" display: block">
                                @foreach($categories as $category)
                                    @if (!in_array($category->id, $categoriesRegister))
                                        <div class="unregister" data-toggle="modal"
                                             data-target="#exampleModal-{{$category->id}}">
                                            <label class="ml-2" for="category-{{$category->id}}">
                                                <input type="checkbox" id="category-{{$category->id}}"
                                                       name="category-{{$category->id}}"
                                                       value="{{$category->id}}"
                                                       class="inputCheckboxCategory mr-2 p-3"
                                                        @php
                                                            echo in_array($category->id, $categoriesRegister) ? '' :'disabled';
                                                        @endphp
                                                />
                                                <span class="labelCheckboxCategory">
                                                    @if(locationHelper() == 'kr')
                                                        <div class="text">{{ $category->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="text">{{$category->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="text">{{$category->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="text">{{$category->name_vi}}</div>
                                                    @else
                                                        <div class="text">{{$category->name_en}}</div>
                                                    @endif
                                                </span>
                                            </label>
                                        </div>
                                        <div class="modal fade" id="exampleModal-{{$category->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true"
                                             data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        This type of category of yours has not been registered
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="button" class="btn btn-primary"><a
                                                                    href="{{route('permission.list.show')}}">Buy now</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @else
                                        <label class="ml-2" for="category-{{$category->id}}">
                                            <input type="checkbox" id="category-{{$category->id}}"
                                                   name="category-{{$category->id}}"
                                                   value="{{$category->id}}"
                                                   class="inputCheckboxCategory mr-2 p-3"/>
                                            <span class="labelCheckboxCategory">
                                                @if(locationHelper() == 'kr')
                                                    <div class="text">{{$category->name_ko }}</div>
                                                @elseif(locationHelper() == 'cn')
                                                    <div class="text">{{$category->name_zh}}</div>
                                                @elseif(locationHelper() == 'jp')
                                                    <div class="text">{{$category->name_ja}}</div>
                                                @elseif(locationHelper() == 'vi')
                                                    <div class="text">{{$category->name_vi}}</div>
                                                @else
                                                    <div class="text">{{$category->name_en}}</div>
                                                @endif

                                           </span>
                                        </label>
                                    @endif
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            @if(!in_array($child->id, $categoriesRegister))
                                                <div class="unregister" data-toggle="modal"
                                                     data-target="#exampleModal-{{$child->id}}">
                                                    <label class="ml-4" for="category-{{$child->id}}">
                                                        <input type="checkbox" id="category-{{$child->id}}"
                                                               name="category-{{$child->id}}"
                                                               value="{{$child->id}}"
                                                               class="inputCheckboxCategory mr-2 p-3"
                                                                @php
                                                                    echo in_array($child->id, $categoriesRegister) ? '' :'disabled';
                                                                @endphp
                                                        />
                                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                                <div class="text">{{$child->name_ko }}</div>
                                                            @elseif(locationHelper() == 'cn')
                                                                <div class="text">{{$child->name_zh}}</div>
                                                            @elseif(locationHelper() == 'jp')
                                                                <div class="text">{{$child->name_ja}}</div>
                                                            @elseif(locationHelper() == 'vi')
                                                                <div class="text">{{$child->name_vi}}</div>
                                                            @else
                                                                <div class="text">{{$child->name_en}}</div>
                                                            @endif
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="modal fade" id="exampleModal-{{$child->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                     data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                This type of category of yours has not been registered
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="button" class="btn btn-primary"><a
                                                                            href="{{route('permission.list.show')}}">Buy
                                                                        now</a>
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <label class="ml-2" for="category-{{$child->id}}">
                                                    <input type="checkbox" id="category-{{$child->id}}"
                                                           name="category-{{$child->id}}"
                                                           value="{{$child->id}}"
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                            <div class="text">{{ $child->name_ko }}</div>
                                                        @elseif(locationHelper() == 'cn')
                                                            <div class="text">{{$child->name_zh}}</div>
                                                        @elseif(locationHelper() == 'jp')
                                                            <div class="text">{{$child->name_ja}}</div>
                                                        @elseif(locationHelper() == 'vi')
                                                            <div class="text">{{$child->name_vi}}</div>
                                                        @else
                                                            <div class="text">{{$child->name_en}}</div>
                                                        @endif

                                                        </span>
                                                </label>
                                            @endif
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                @if(!in_array($child2->id, $categoriesRegister))
                                                    <div class="unregister" data-toggle="modal"
                                                         data-target="#exampleModal-{{$child->id}}">
                                                        <label class="ml-5" for="category-{{$child2->id}}">
                                                            <input type="checkbox" id="category-{{$child2->id}}"
                                                                   name="category-{{$child2->id}}"
                                                                   value="{{$child2->id}}"
                                                                   class="inputCheckboxCategory mr-2 p-3"
                                                                    @php
                                                                        echo in_array($child2->id, $categoriesRegister) ? '' :'disabled';
                                                                    @endphp
                                                            />
                                                            <span class="labelCheckboxCategory">
                                                                @if(locationHelper() == 'kr')
                                                                    <div class="text">{{ $child2->name_ko }}</div>
                                                                @elseif(locationHelper() == 'cn')
                                                                    <div class="text">{{$child2->name_zh}}</div>
                                                                @elseif(locationHelper() == 'jp')
                                                                    <div class="text">{{$child2->name_ja}}</div>
                                                                @elseif(locationHelper() == 'vi')
                                                                    <div class="text">{{$child2->name_vi}}</div>
                                                                @else
                                                                    <div class="text">{{$child2->name_en}}</div>
                                                                @endif
                                                       </span>
                                                        </label>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal-{{$child2->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                         data-backdrop="static">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    This type of category of yours has not been
                                                                    registered
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary"><a
                                                                                href="{{route('permission.list.show')}}">Buy
                                                                            now</a>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <label class="ml-2" for="category-{{$child2->id}}">
                                                        <input type="checkbox" id="category-{{$child2->id}}"
                                                               name="category-{{$child2->id}}"
                                                               value="{{$child2->id}}"
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                                <div class="text">{{ $child2->name_ko }}</div>
                                                            @elseif(locationHelper() == 'cn')
                                                                <div class="text">{{$child2->name_zh}}</div>
                                                            @elseif(locationHelper() == 'jp')
                                                                <div class="text">{{$child2->name_ja}}</div>
                                                            @elseif(locationHelper() == 'vi')
                                                                <div class="text">{{$child2->name_vi}}</div>
                                                            @else
                                                                <div class="text">{{$child2->name_en}}</div>
                                                            @endif

                                                    </span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12 ">
                                @include('backend.products.modal-media')
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12" id="list-img-thumbnail"></div>
                            <div class="form-group col-12 col-sm-12" id="list-img-gallery"></div>
                        </div>
                    </div>
                    <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                    <input type="text" hidden id="imgGallery" value="" name="imgGallery[]">
                    <input type="text" hidden id="imgThumbnail" value="" name="imgThumbnail[]">
                    <div class="form-group col-12 col-md-7 col-sm-8 ">
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var url = `{{ route('product.v2.create.attribute') }}`;
        var token = `{{ csrf_token() }}`;
        var urlCategory = `{{ route('categories.register', ['id' => ':categoryID']) }}`;
    </script>
    <script src="{{ asset('js/backend/products-create.js') }}"></script>
@endsection

