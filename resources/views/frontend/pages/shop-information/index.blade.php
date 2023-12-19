@extends('frontend.layouts.master')

@section('title', 'Information Shop')

@section('content')
    <div class="container-fluid shop-info-page">
        @if($company)
            <div class="shop-header row bg-white">
                <div class="col-xl-4 col-md-6 col-sm-8 shop-key">
                    <div class="shop-info d-flex align-items-center">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="" class="image-shop">
                        <div class="shop-name">
                            <div class="name text-uppercase s18w6">
                                {{ $company->name }}
                            </div>
                            <div class="code c929292s10w4">
                                <span class="">ID: </span> {{ $memberPerson->code }}
                            </div>
                            <div class="level s10w6">
                                <span class="c929292s10w4">Membership level: </span> {{ $company->member }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-8 shop-value d-flex align-items-center">
                    @php
                        $list_name = null;
                        foreach ($categories as $category){
                            if ($list_name){
                                $list_name = $list_name . ', ' . $category->name;
                            } else{
                                $list_name = $category->name;
                            }
                        }
                    @endphp
                    <div class="company">
                        <div class="category s12w6">
                            <span class="c929292s12w4">Company category: </span> {{ $list_name }}
                        </div>
                        <div class="enterprise s12w6">
                            <span class="c929292s12w4">Elite enterprise: </span> {{ $company->member }}
                        </div>
                        <div class="rate s12w6">
                            <span class="c929292s12w4">Customer rating score: </span> {{ $averageRatingsFormatted }}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-8 shop-contact d-flex align-items-center">
                    <div class="company">
                        <div class="title s18w6">
                            Your Sourcing Specialist
                        </div>
                        <div class="phone pt-2">
                            <i class="fa-solid fa-phone-volume" style="font-size: 16px"></i> <span
                                    class="s12w6">{{ $company->phone }}</span>
                        </div>
                        <div class="email">
                            <i class="fa-solid fa-envelope" style="font-size: 16px"></i> <span
                                    class="s12w6">{{ $company->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-product bg-white">
                <table class="table table-list-products">
                    <thead>
                    <tr>
                        <th scope="col" class="c929292s12w4">Image</th>
                        <th scope="col" class="c929292s12w4">Name</th>
                        <th scope="col" class="c929292s12w4">Price</th>
                        <th scope="col" class="c929292s12w4">Category</th>
                        <th scope="col" class="c929292s12w4">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listProduct as $product)
                        <tr>
                            <td>
                                @php
                                    $thumbnail = checkThumbnail($product->thumbnail);
                                @endphp
                                <img src="{{ $thumbnail }}" alt="" class="image-product">
                            </td>
                            <td class="s12w5">
                                <div class="product-item">
                                    <div class="product-name">
                                        <a href="{{ route('detail_product.show', $product->id) }}">
                                            @if(locationHelper() == 'kr')
                                                {{($product->name_ko)}}
                                            @elseif(locationHelper() == 'cn')
                                                {{($product->name_zh)}}
                                            @elseif(locationHelper() == 'jp')
                                                {{($product->name_ja)}}
                                            @elseif(locationHelper() == 'vi')
                                                {{($product->name)}}
                                            @else
                                                {{($product->name_en)}}
                                            @endif
                                        </a>
                                    </div>
                                    @if(Auth::check())
                                        @if($user->id == Auth::user()->id)
                                            <div class="action d-flex align-items-end mt-3">
                                                <a class="action-edit" href="{{route('seller.products.edit', $product->id)}}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a class="action-delete" data-toggle="modal"
                                                   data-target="#modalDeleteProduct{{$product->id}}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                                <div class="modal fade text-black"
                                                     id="modalDeleteProduct{{$product->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{route('seller.products.destroy', $product)}}"
                                                              method="post">
                                                            @method('DELETE')
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
                                                                        {{ __('home.Bạn có chắc chắn muốn xoá') }}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó!Chúng tôi sẽ không chịu trách nhiệm cho việc này!') }}
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Yes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="s12w5">
                                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}
                            </td>
                            <td class="s12w5">
                                @php
                                    $categoryProduct = $product->list_category;
                                    $arrayCategory = explode(',', $categoryProduct);
                                    $arrayCategoryProduct = \App\Models\Category::whereIn('id', $arrayCategory)
                                            ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                                            ->get();
                                    $name = null;
                                    foreach ($arrayCategoryProduct as $item){
                                        if ($name){
                                            $name = $name . ', '. $item->name;
                                        } else {
                                            $name = $item->name;
                                        }
                                    }
                                @endphp
                                {{ $name }}
                            </td>
                            <td class="s12w5">
                                {{ $product->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
