@extends('frontend.layouts.profile')

@section('title', 'My Wishlist')
        <!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
</head>
<body>
<h1>My Wishlist</h1>

@auth
    @if ($userWishlists->isEmpty())
        <p>No wishlist items found.</p>
    @else
        <ul>
            @foreach ($userWishlists as $wishlist)
                <li>
                    <strong>Item Name:</strong> {{ $wishlist->item_name }}<br>
                    <strong>Price:</strong> {{ $wishlist->price }}<br>
                    <strong>Link:</strong> {{ $wishlist->link }}<br>
                    <strong>Added Date:</strong> {{ $wishlist->added_date }}<br>
                </li>
            @endforeach
        </ul>
    @endif
@else
    <p>Please login to view your wishlist.</p>
@endauth

</body>
</html>

@endsection


