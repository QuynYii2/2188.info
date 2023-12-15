@extends('backend.layouts.master')
@section('title', 'List Post')
@section('content')
    <style>
        th, td {
            border: none !important;
        }
    </style>
    <h3 class="text-center">{{ __('home.List Post') }}</h3>
    <div class="">
        <table class="table element-bordered" id="tableMemberShip">
            <tbody>
            <tr>
                <th rowspan="2" scope="col">#</th>
                <th rowspan="2" scope="col">{{ __('home.Product Name') }}</th>
                <th rowspan="2" scope="col">{{ __('home.Purchase Quantity') }}</th>
                <th rowspan="2" scope="col">{{ __('home.Target Price') }}</th>
                <th rowspan="2" scope="col">{{ __('home.Max Budget') }}</th>
                <th rowspan="2" scope="col">{{ __('home.Status') }}</th>
                <th rowspan="2" scope="col">{{ __('home.Action') }}</th>
            </tr>
            <tr>

            </tr>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$post->product_name}}</td>
                    <td>{{$post->purchase_quantity}}</td>
                    <td>{{$post->target_price}}</td>
                    <td>{{$post->max_budget}}</td>
                    <td>{{$post->status}}</td>
                    <td class="d-flex">
                        <a href="{{route('user.post.rfq.detail', $post->id)}}"
                           class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <path d="M12 20.0002H21M3 20.0002H4.67454C5.16372 20.0002 5.40832 20.0002 5.63849 19.945C5.84256 19.896 6.03765 19.8152 6.2166 19.7055C6.41843 19.5818 6.59138 19.4089 6.93729 19.063L19.5 6.50023C20.3285 5.6718 20.3285 4.32865 19.5 3.50023C18.6716 2.6718 17.3285 2.6718 16.5 3.50023L3.93726 16.063C3.59136 16.4089 3.4184 16.5818 3.29472 16.7837C3.18506 16.9626 3.10425 17.1577 3.05526 17.3618C3 17.5919 3 17.8365 3 18.3257V20.0002Z"
                                      stroke="#929292" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <form method="post" action="{{route('user.post.rfq.delete', $post->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none">
                                    <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6"
                                          stroke="#E90000" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
