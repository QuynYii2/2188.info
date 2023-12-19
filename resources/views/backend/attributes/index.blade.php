@php use App\Enums\AttributeStatus;use App\Models\Properties; @endphp
@extends('backend.layouts.master')
@section('title')
    List Attributes
@endsection
@section('content')
    <div id="wpbody-content" class="snipcss-rFvJO">
        <div class="wrap woocommerce">
            <h1>
                Attributes
            </h1>
            @if(session('error'))
                <div id="message" class="updated woocommerce-message">
                    <a class="woocommerce-message-close notice-dismiss"
                       href="/wordpress/wp-admin/edit.php?post_type=product&amp;page=product_attributes&amp;wc-hide-notice=no_secure_connection&amp;_wc_notice_nonce=d6748f6d00">
                        Dismiss
                    </a>
                    <p>
                        Your store does not appear to be using a secure connection. We highly recommend serving your
                        entire
                        website over an HTTPS connection to help keep customer data secure.
                        <a href="https://docs.woocommerce.com/document/ssl-and-https/">
                            Learn more here.
                        </a>
                    </p>
                </div>
            @endif
            <div id="col-container">
                <div class="d-flex justify-content-end btn-add-attributes">
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                            <path d="M12.5 5V19M5.5 12H19.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        Add attribute
                    </button>
                </div>

                <div id="col-right">
                    <div class="col-wrap">
                        <table class="w-100" id="style-zkG8L">
                            <thead>
                            <tr class="border-bottom">
                                <th scope="col">
                                    {{ __('home.Name') }}
                                </th>
                                <th scope="col">
                                    Slug
                                </th>
                                <th scope="col">
                                    Order by
                                </th>
                                <th scope="col">
                                    {{ __('home.Terms') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$attributes->isEmpty())
                                @foreach($attributes as $attribute)
                                    <tr class="alternate border-bottom">
                                        <td>
                                            <strong>
                                                <a href="{{route('properties.index', $attribute->id)}}">
                                                    {{$attribute->name}}
                                                </a>
                                            </strong>
                                        </td>
                                        <td>
                                            {{$attribute->slug}}
                                        </td>
                                        <td>
                                            Custom ordering
                                        </td>
                                        <td class="attribute-terms">
                                            @php
                                                $properties = \App\Models\Properties::where('attribute_id', $attribute->id)->get();
                                            @endphp
                                            @if($properties->isEmpty())
                                                <span class="na">
                                                    –
                                                </span>
                                            @else
                                                @foreach($properties as $property)
                                                    <span class="text-success">
                                                        {{$property->name}}
                                                    </span>
                                                    |
                                                @endforeach
                                            @endif
                                            <br>
                                        </td>
                                        <td>
                                            <div class="row-actions">
                                                <a href="{{route('properties.index', $attribute->id)}}"
                                                   class="configure-terms">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                              stroke="black" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M18.7273 14.7273C18.6063 15.0015 18.5702 15.3056 18.6236 15.6005C18.6771 15.8954 18.8177 16.1676 19.0273 16.3818L19.0818 16.4364C19.2509 16.6052 19.385 16.8057 19.4765 17.0265C19.568 17.2472 19.6151 17.4838 19.6151 17.7227C19.6151 17.9617 19.568 18.1983 19.4765 18.419C19.385 18.6397 19.2509 18.8402 19.0818 19.0091C18.913 19.1781 18.7124 19.3122 18.4917 19.4037C18.271 19.4952 18.0344 19.5423 17.7955 19.5423C17.5565 19.5423 17.3199 19.4952 17.0992 19.4037C16.8785 19.3122 16.678 19.1781 16.5091 19.0091L16.4545 18.9545C16.2403 18.745 15.9682 18.6044 15.6733 18.5509C15.3784 18.4974 15.0742 18.5335 14.8 18.6545C14.5311 18.7698 14.3018 18.9611 14.1403 19.205C13.9788 19.4489 13.8921 19.7347 13.8909 20.0273V20.1818C13.8909 20.664 13.6994 21.1265 13.3584 21.4675C13.0174 21.8084 12.5549 22 12.0727 22C11.5905 22 11.1281 21.8084 10.7871 21.4675C10.4461 21.1265 10.2545 20.664 10.2545 20.1818V20.1C10.2475 19.7991 10.1501 19.5073 9.97501 19.2625C9.79991 19.0176 9.55521 18.8312 9.27273 18.7273C8.99853 18.6063 8.69437 18.5702 8.39947 18.6236C8.10456 18.6771 7.83244 18.8177 7.61818 19.0273L7.56364 19.0818C7.39478 19.2509 7.19425 19.385 6.97353 19.4765C6.7528 19.568 6.51621 19.6151 6.27727 19.6151C6.03834 19.6151 5.80174 19.568 5.58102 19.4765C5.36029 19.385 5.15977 19.2509 4.99091 19.0818C4.82186 18.913 4.68775 18.7124 4.59626 18.4917C4.50476 18.271 4.45766 18.0344 4.45766 17.7955C4.45766 17.5565 4.50476 17.3199 4.59626 17.0992C4.68775 16.8785 4.82186 16.678 4.99091 16.5091L5.04545 16.4545C5.25503 16.2403 5.39562 15.9682 5.4491 15.6733C5.50257 15.3784 5.46647 15.0742 5.34545 14.8C5.23022 14.5311 5.03887 14.3018 4.79497 14.1403C4.55107 13.9788 4.26526 13.8921 3.97273 13.8909H3.81818C3.33597 13.8909 2.87351 13.6994 2.53253 13.3584C2.19156 13.0174 2 12.5549 2 12.0727C2 11.5905 2.19156 11.1281 2.53253 10.7871C2.87351 10.4461 3.33597 10.2545 3.81818 10.2545H3.9C4.2009 10.2475 4.49273 10.1501 4.73754 9.97501C4.98236 9.79991 5.16883 9.55521 5.27273 9.27273C5.39374 8.99853 5.42984 8.69437 5.37637 8.39947C5.3229 8.10456 5.18231 7.83244 4.97273 7.61818L4.91818 7.56364C4.74913 7.39478 4.61503 7.19425 4.52353 6.97353C4.43203 6.7528 4.38493 6.51621 4.38493 6.27727C4.38493 6.03834 4.43203 5.80174 4.52353 5.58102C4.61503 5.36029 4.74913 5.15977 4.91818 4.99091C5.08704 4.82186 5.28757 4.68775 5.50829 4.59626C5.72901 4.50476 5.96561 4.45766 6.20455 4.45766C6.44348 4.45766 6.68008 4.50476 6.9008 4.59626C7.12152 4.68775 7.32205 4.82186 7.49091 4.99091L7.54545 5.04545C7.75971 5.25503 8.03183 5.39562 8.32674 5.4491C8.62164 5.50257 8.9258 5.46647 9.2 5.34545H9.27273C9.54161 5.23022 9.77093 5.03887 9.93245 4.79497C10.094 4.55107 10.1807 4.26526 10.1818 3.97273V3.81818C10.1818 3.33597 10.3734 2.87351 10.7144 2.53253C11.0553 2.19156 11.5178 2 12 2C12.4822 2 12.9447 2.19156 13.2856 2.53253C13.6266 2.87351 13.8182 3.33597 13.8182 3.81818V3.9C13.8193 4.19253 13.906 4.47834 14.0676 4.72224C14.2291 4.96614 14.4584 5.15749 14.7273 5.27273C15.0015 5.39374 15.3056 5.42984 15.6005 5.37637C15.8954 5.3229 16.1676 5.18231 16.3818 4.97273L16.4364 4.91818C16.6052 4.74913 16.8057 4.61503 17.0265 4.52353C17.2472 4.43203 17.4838 4.38493 17.7227 4.38493C17.9617 4.38493 18.1983 4.43203 18.419 4.52353C18.6397 4.61503 18.8402 4.74913 19.0091 4.91818C19.1781 5.08704 19.3122 5.28757 19.4037 5.50829C19.4952 5.72901 19.5423 5.96561 19.5423 6.20455C19.5423 6.44348 19.4952 6.68008 19.4037 6.9008C19.3122 7.12152 19.1781 7.32205 19.0091 7.49091L18.9545 7.54545C18.745 7.75971 18.6044 8.03183 18.5509 8.32674C18.4974 8.62164 18.5335 8.9258 18.6545 9.2V9.27273C18.7698 9.54161 18.9611 9.77093 19.205 9.93245C19.4489 10.094 19.7347 10.1807 20.0273 10.1818H20.1818C20.664 10.1818 21.1265 10.3734 21.4675 10.7144C21.8084 11.0553 22 11.5178 22 12C22 12.4822 21.8084 12.9447 21.4675 13.2856C21.1265 13.6266 20.664 13.8182 20.1818 13.8182H20.1C19.8075 13.8193 19.5217 13.906 19.2778 14.0676C19.0339 14.2291 18.8425 14.4584 18.7273 14.7273Z"
                                                              stroke="black" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                                <span class="edit">
                                                    <a href="{{route('attributes.detail', $attribute->id)}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path d="M12 20.0002H21M3.00003 20.0002H4.67457C5.16376 20.0002 5.40835 20.0002 5.63852 19.945C5.84259 19.896 6.03768 19.8152 6.21663 19.7055C6.41846 19.5818 6.59141 19.4089 6.93732 19.063L19.5001 6.50023C20.3285 5.6718 20.3285 4.32865 19.5001 3.50023C18.6716 2.6718 17.3285 2.6718 16.5001 3.50023L3.93729 16.063C3.59139 16.4089 3.41843 16.5818 3.29475 16.7837C3.18509 16.9626 3.10428 17.1577 3.05529 17.3618C3.00003 17.5919 3.00003 17.8365 3.00003 18.3257V20.0002Z"
                                                                  stroke="#929292" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>

                                                </span>
                                                <span class="delete">
                                                    <a class="delete" data-toggle="modal"
                                                       data-target="#modalDeleteAttribute{{$attribute->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6"
                                                                  stroke="#E90000" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteAttribute{{$attribute->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('attributes.delete', $attribute->id)}}"
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
                                                                        {{ __('home.Bạn có chắc chắn muốn xoá thuộc tính') }}: {{$attribute->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó! Chúng tôi sẽ không chịu trách nhiệm cho việc này') }}!
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
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="woocommerce-embedded-layout__primary" id="woocommerce-embedded-layout__primary">
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    {{-- modal add attributes --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Add attribute') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('attributes.store')}}" method="post" class="add-attributes-modal">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <div>
                                <label for="attribute_name">
                                    {{ __('home.Name') }}
                                </label>
                            </div>
                            <div><input class="w-100" name="attribute_name" id="attribute_name" type="text" value=""></div>
                        </div>
                        <div class="form-group">
                            <div><label for="attribute_slug">
                                    Slug
                                </label></div>
                            <div><input class="w-100" name="attribute_slug" id="attribute_slug" type="text" value=""
                                        maxlength="28"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="checkbox" name="attribute_public" id="attribute_public" value="1">
                                <label class="form-check-label text-checkout" for="attribute_public">
                                    Enable Archives?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="w-50 p-2" name="attribute_orderby" id="attribute_orderby">
                                <option value="menu_order">
                                    Custom ordering
                                </option>
                                <option value="name">
                                    {{ __('home.Name') }}
                                </option>
                                <option value="name_num">
                                    Name (numeric)
                                </option>
                                <option value="id">
                                    Term ID
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Cancel') }}</button>
                        <button type="submit" name="add_new_attribute" id="submit" class="btn btn-primary"
                                value="Add attribute"> {{ __('home.Add attribute') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
