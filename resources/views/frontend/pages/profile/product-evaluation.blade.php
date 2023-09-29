@extends('frontend.layouts.profile')

@section('title', 'Product Evaluation')

@section('sub-content')
    <div class="row mt-2 bg-white rounded">
        <div class="row rounded pt-1 ml-5">
            <h5>{{ __('home.product evaluation') }}</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="col-md-12">
            @if(sizeof($listEvaluate) == 0)
                <div class="tab-content py-3 px-3 px-sm-0">
                    <div class="text-center">
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no product to evaluate') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="tab-content py-3 px-3 px-sm-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('home.Product Name') }}</th>
                            <th scope="col">{{ __('home.star number') }}</th>
                            <th scope="col">{{ __('home.content') }}</th>
                            <th scope="col">{{ __('home.Status') }}</th>
                            <th scope="col">{{ __('home.Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listEvaluate as $key => $evaluate)
                            @php
                                $product = \App\Models\Product::where('id', $evaluate->product_id)->first();
                            @endphp
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $evaluate->star_number }}</td>
                                <td>{{ $evaluate->content }}</td>
                                <td>{{ $evaluate->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#edit-comment" onclick="getCommentById({{ $evaluate->id }})">
                                        {{ __('home.edit-comment') }}
                                    </button>
                                    <button type="button" class="btn btn-info"
                                            onclick="handleDeleteEvaluate({{ $evaluate->id }})">{{ __('home.delete') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="edit-comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('update.evaluate.id')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="text" hidden id="id-cmt-edit" name="id">

                        <input type="text" class="form-control" id="product_id" name="product_id" hidden/>
                        <div class="rating">
                            <input type="radio" name="star_number" id="star-edit-1" value="1" hidden="">
                            <label for="star-edit-1" onclick="starCheckEdit(1)"><i id="icon-star-edit-1"
                                                                                   class="fa fa-star"></i></label>
                            <input type="radio" name="star_number" id="star-edit-2" value="2" hidden="">
                            <label for="star-edit-2" onclick="starCheckEdit(2)"><i id="icon-star-edit-2"
                                                                                   class="fa fa-star"></i></label>
                            <input type="radio" name="star_number" id="star-edit-3" value="3" hidden="">
                            <label for="star-edit-3" onclick="starCheckEdit(3)"><i id="icon-star-edit-3"
                                                                                   class="fa fa-star"></i></label>
                            <input type="radio" name="star_number" id="star-edit-4" value="4" hidden="">
                            <label for="star-edit-4" onclick="starCheckEdit(4)"><i id="icon-star-edit-4"
                                                                                   class="fa fa-star"></i></label>
                            <input type="radio" name="star_number" id="star-edit-5" value="5" hidden="" checked>
                            <label for="star-edit-5" onclick="starCheckEdit(5)"><i id="icon-star-edit-5"
                                                                                   class="fa fa-star"></i></label>
                        </div>
                        <input id="input-star-edit" value="0" hidden="">
                        <div id="text-message" class="text-danger d-none">{{ __('home.Please select star rating') }}
                        </div>

                        <div class="form-group row">
                            <label for=""
                                   class="col-sm-12 col-form-label">{{ __('home.your name') }}</label>
                            <div class="col-sm-12">
                                <input onclick="checkStar()" type="text" class="form-control" id="name-edit"
                                       name="username"
                                       placeholder="{{ __('home.your name') }}" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for=""
                                   class="col-sm-12 col-form-label">{{ __('home.your review') }}</label>
                            <div class="col-sm-12">
                                    <textarea class="form-control" id="content-edit"
                                              name="content"
                                              placeholder="{{ __('home.your review') }}"
                                              rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('home.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var urla = '{{ route('find.evaluate.id', ['id' => ':id']) }}';
        var urlb = '{{ route('product_evaluation.delete', ['id' => ':id']) }}'
    </script>

    <script src="{{asset('js/frontend/pages/profile/evaluation.js')}}"></script>
@endsection
