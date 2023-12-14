@extends('backend.layouts.master')
@section('title', 'Detail Post')
@section('content')
    <h3 class="text-center">Detail Post</h3>
    <div class="container mb-5">
        <form action="{{ route('admin.post.rfq.update', $post->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input disabled type="text" class="form-control" id="product_name" placeholder="1234 Main St"
                       value="{{ $post->product_name }}">
            </div>
            <div class="form-group">
                <label for="description">Detail</label>
                <textarea disabled class="form-control" id="description" rows="6">{{ $post->description }}</textarea>
            </div>
            <div class="list-image d-flex align-items-center">
                <p>List Image: </p>
                @php
                    $thumbanils = $post->thumbnails;
                    $arrayThumbnail = explode(',', $thumbanils);
                @endphp
                @foreach($arrayThumbnail as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="" style="max-width: 100px" class="m-3">
                @endforeach
            </div>
            @php
                $mydata1 = null;
                foreach ($category_1 as $item){
                    if ($mydata1){
                        $mydata1 = $mydata1 . ',' . $item->name;
                    } else {
                         $mydata1 = $item->name;
                    }
                }
            @endphp
            <div class="form-group">
                <label for="code_1">Code 1</label>
                <input disabled type="text" class="form-control" id="code_1" placeholder="1234 Main St"
                       value="{{ $mydata1 }}">
            </div>
            @php
                $mydata2 = null;
                foreach ($category_2 as $item){
                    if ($mydata2){
                        $mydata2 = $mydata2 . ',' . $item->name;
                    } else {
                         $mydata2 = $item->name;
                    }
                }
            @endphp
            <div class="form-group">
                <label for="code_2">Code 2</label>
                <input disabled type="text" class="form-control" id="code_2" placeholder="1234 Main St"
                       value="{{ $mydata2 }}">
            </div>
            @php
                $mydata3 = null;
                foreach ($category_3 as $item){
                    if ($mydata3){
                        $mydata3 = $mydata3 . ',' . $item->name;
                    } else {
                         $mydata3 = $item->name;
                    }
                }
            @endphp
            <div class="form-group">
                <label for="code_3">Code 3</label>
                <input disabled type="text" class="form-control" id="code_3" placeholder="1234 Main St"
                       value="{{ $mydata3 }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="purchase_quantity">Purchase Quantity</label>
                    <input disabled type="text" class="form-control" id="purchase_quantity"
                           value="{{ $post->purchase_quantity }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="unit_quantity">unit_quantity</label>
                    <input disabled value="{{ $post->unit_quantity }}" type="text" class="form-control"
                           id="unit_quantity">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="business_terms">Business Terms</label>
                    <input disabled value="{{ $post->business_terms }}" type="text" class="form-control"
                           id="business_terms">
                </div>
                <div class="form-group col-md-6">
                    <label for="payment_terms">Payment Terms</label>
                    <input disabled value="{{ $post->payment_terms }}" type="text" class="form-control"
                           id="payment_terms">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="target_price">Target Price</label>
                    <input disabled value="{{ $post->target_price }}" type="text" class="form-control"
                           id="target_price">
                </div>
                <div class="form-group col-md-4">
                    <label for="unit_price">Unit Price</label>
                    <input disabled value="{{ $post->unit_price }}" type="text" class="form-control" id="unit_price">
                </div>
                <div class="form-group col-md-4">
                    <label for="max_budget">Max Budget</label>
                    <input disabled value="{{ $post->max_budget }}" type="text" class="form-control" id="max_budget">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="shipping_method">Shipping Method</label>
                    <input disabled value="{{ $post->shipping_method }}" type="text" class="form-control"
                           id="shipping_method">
                </div>
                <div class="form-group col-md-4">
                    <label for="destination_port">Destination Port</label>
                    <input disabled value="{{ $post->destination_port }}" type="text" class="form-control"
                           id="destination_port">
                </div>
                <div class="form-group col-md-4">
                    <label for="ship_in">Ship In</label>
                    <input disabled value="{{ $post->ship_in }}" type="text" class="form-control" id="ship_in">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="create_by">Create By</label>
                    <input disabled value="{{ $user->name }}" type="text" class="form-control" id="create_by">
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option {{ $post->status == \App\Enums\PostRFQStatus::PENDING ? 'selected' : '' }}
                                value="{{ \App\Enums\PostRFQStatus::PENDING }}">
                            {{ \App\Enums\PostRFQStatus::PENDING }}
                        </option>
                        <option {{ $post->status == \App\Enums\PostRFQStatus::APPROVED ? 'selected' : '' }}
                                value="{{ \App\Enums\PostRFQStatus::APPROVED }}">
                            {{ \App\Enums\PostRFQStatus::APPROVED }}
                        </option>
                        <option {{ $post->status == \App\Enums\PostRFQStatus::REFUSE ? 'selected' : '' }}
                                value="{{ \App\Enums\PostRFQStatus::REFUSE }}">
                            {{ \App\Enums\PostRFQStatus::REFUSE }}
                        </option>
                    </select>
                </div>
            </div>
           <div class="text-center">
               <button type="submit" class="btn btn-primary">Save</button>
           </div>
        </form>
    </div>
@endsection
