<div class="modal fade detail" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-member">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid product" style="border-bottom: 1px solid white">
                    <div class="column-xs-12 column-md-5">
                        <div class="product-gallery">
                            <div class="product-image">
                                <img src="#" alt="" id="img-modal">
                            </div>
                            <ul class="image-list ">
                                {{-- <li class="image-item"><img src="{{ asset('storage/' . $product->thumbnail) }}"></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="column-xs-12 column-md-7">
                        <form action="" method="post" id="form_cart">
                            @csrf
                            <div class="product-name" id="category-modal">Name seller</div>
                            <div class="product-title" id="productName-modal">name</div>
                            <div class="product-rating" id="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>4.7(21)</span>
                            </div>
                            <div class="product-price d-flex" style="gap: 3rem">
                                <div class="price" id="price-sale">price sale</div>
                                <strike id="price-old">price old</strike>
                            </div>
                            <div class="description-text" id="description-text">
                            </div>
                            <input id="input_price" name="price" type="text" class="d-none" value="0">
                            <input id="variable_id" name="variable" hidden>
                            <div class="">
                                <input id="product_id" hidden value="">
                            </div>
                            <div class="count__wrapper count__wrapper--ml mt-3">
                                <span>{{ __('home.Còn lại') }}: </span>
                                <label for="qty" id="qty"></label>
                            </div>
                            <div class="d-flex buy justify-content-center">
                                <div>
                                    <input type="number" name="quantity" class="input" min="" value="" >
                                    <div class="spinner">
                                        <button type="button" class="up button">&rsaquo;</button>
                                        <button type="button" class="down button">&lsaquo;</button>
                                    </div>
                                </div>
                                <button class="add-to-cart" id="add-to-cart">Add To Cart</button>
                                <button class="share"><i class="fa-regular fa-heart"></i></button>
                                <button class="share"><i class="fa-solid fa-share-nodes"></i>
                                </button>
                            </div>
                            <div class="eyes"><i class="fa-regular fa-eye"></i> 19 customers are
                                viewing this
                                product
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="text" hidden="" id="inputUrl" value="{{asset('storage/')}}">

<script src="{{asset('js/frontend/pages/modal-products.js')}}"></script>