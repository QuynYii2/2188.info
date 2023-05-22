@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')

    <h2>Giỏ hàng</h2>

    @if ($cartItems->isEmpty())
        <p>Chưa có sản phẩm trong giỏ hàng.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td>{{ $cartItem->product->name }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>{{ $cartItem->price }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>Tổng: ${{ $cartItems->sum('price') }}</p>

        <a href="{{ route('checkout') }}" class="btn btn-primary">Thanh toán</a>
    @endif
@endsection
