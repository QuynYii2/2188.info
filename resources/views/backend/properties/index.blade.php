@extends('backend.layouts.master')
@section('title')
    List Propertis
@endsection
@section('content')
    <div id="wpbody-content" class="snipcss-rFvJO">
        <div class="wrap woocommerce">
            <h1>
                {{$attribute->name}}
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
            <br class="clear">
            <div id="col-container">
                <div id="col-right">
                    <div class="col-wrap">
                        <table class="w-100" id="style-zkG8L">
                            <thead class="border-bottom">
                            <tr>
                                <th scope="col">
                                    {{ __('home.Name') }}
                                </th>
                                <th scope="col">
{{--                                    {{ __('home.countescription') }}--}}
                                </th>
                                <th scope="col">
                                    Slug
                                </th>
                                <th scope="col">
                                    {{ __('home.Count') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$properties->isEmpty())
                                @foreach($properties as $property)
                                    <tr class="alternate border-bottom">
                                        <td>
                                            <strong>
                                                <a href="{{route('properties.update', $property->id)}}">
                                                    {{$property->name}}
                                                </a>
                                            </strong>

                                        </td>
                                        <td>
                                            {{$property->description}}
                                        </td>
                                        <td>
                                            {{$property->slug}}
                                        </td>
                                        <td class="attribute-terms">
                                            {{count($properties)}}
                                        </td>
                                        <td>
                                            <div class="row-actions">
                                                {{--                                                <span class="edit">--}}
                                                {{--                                                    <a href="{{route('properties.detail', $property->id)}}">--}}
                                                {{--                                                        {{ __('home.edit') }}--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                    |--}}
                                                {{--                                                </span>--}}
                                                <span class="quick-edit">
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#modalEditAttribute{{$property->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M12 20.0002H21M3 20.0002H4.67454C5.16372 20.0002 5.40832 20.0002 5.63849 19.945C5.84256 19.896 6.03765 19.8152 6.2166 19.7055C6.41843 19.5818 6.59138 19.4089 6.93729 19.063L19.5 6.50023C20.3285 5.6718 20.3285 4.32865 19.5 3.50023C18.6716 2.6718 17.3285 2.6718 16.5 3.50023L3.93726 16.063C3.59136 16.4089 3.4184 16.5818 3.29472 16.7837C3.18506 16.9626 3.10425 17.1577 3.05526 17.3618C3 17.5919 3 17.8365 3 18.3257V20.0002Z" stroke="#929292" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalEditAttribute{{$property->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('properties.update', $property->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.update') }} {{$property->name}}</h5>
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
                                                                                            for="property_name">{{ __('home.Name') }}</label></th>
                                                                                <td><input name="property_name"
                                                                                           id="property_name"
                                                                                           type="text"
                                                                                           value="{{$property->name}}"
                                                                                           aria-required="true"
                                                                                           aria-describedby="name-description"
                                                                                           required>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-slug-wrap">
                                                                                <th scope="row"><label
                                                                                            for="property_slug">{{ __('home.Đường dẫn') }}</label></th>
                                                                                <td><input name="property_slug"
                                                                                           id="property_slug"
                                                                                           type="text"
                                                                                           value="{{$property->slug}}"
                                                                                           aria-describedby="slug-description">
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="form-field term-description-wrap">
                                                                                <th scope="row"><label
                                                                                            for="property_description">{{ __('home.Mô tả') }}</label></th>
                                                                                <td><textarea
                                                                                            name="property_description"
                                                                                            id="property_description"
                                                                                            rows="5" cols="50"
                                                                                            class="large-text"
                                                                                            aria-describedby="description-description">{{$property->description}}</textarea>
                                                                                    <p class="description"
                                                                                       id="description-description">The description is not prominent by
                                                                                        default; however, some themes may show it.</p></td>
                                                                            </tr>
                                                                            </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-success">{{ __('home.submit') }}</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span class="delete">
                                                    <a class="delete" data-toggle="modal"
                                                       data-target="#modalDeleteAttribute{{$property->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                          <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6" stroke="#E90000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteAttribute{{$property->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('properties.delete', $property->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-center">
                                                                        {{ __('home.Bạn có chắc chắn muốn xoá thuộc tính') }}: {{$property->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó! Chúng tôi sẽ không chịu trách nhiệm cho việc này!') }}
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
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
                <div id="col-left">
                    <div class="col-wrap">
                        <div class="form-wrap">
                            <h2>Add new {{$attribute->name}}</h2>
                            <form id="addtag" method="post" action="{{route('properties.store')}}" class="validate">
                                @csrf
                                <input class="form-control" hidden="" name="attribute_id" type="text"
                                       value="{{$attribute->id}}">
                                <div class="form-field form-required term-name-wrap">
                                    <label for="property_name">Tên</label>
                                    <input class="form-control" name="property_name" id="property_name" type="text"
                                           required
                                           aria-required="true" aria-describedby="name-description">
                                </div>
                                <div class="form-field term-slug-wrap">
                                    <label for="property_slug">Đường dẫn</label>
                                    <input class="form-control" name="property_slug" id="property_slug" type="text"
                                           value=""
                                           aria-required="true" aria-describedby="slug-description">
                                </div>
                                <div class="form-field term-description-wrap">
                                    <label for="property_description">Mô tả</label>
                                    <textarea class="form-control" name="property_description" id="property_description"
                                              aria-describedby="description-description"></textarea>
                                </div>

                                <p class="submit">
                                    <input type="submit" name="submit" id="submit" class="button button-primary"
                                           value="Add new {{$attribute->name}}"> <span class="spinner"></span>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
