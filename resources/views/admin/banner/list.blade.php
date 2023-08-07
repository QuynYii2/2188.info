@extends('backend.layouts.master')
@section('title', 'List Banner Setup')
@section('content')
    <h3 class="text-center">List Banner Setup</h3>
    <a href="{{ route('admin.banners.processCreate') }}" class="btn btn-success">Thêm mới</a>
    <div class="card">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Thumbnails</th>
                <th scope="col">Sub thumbnails</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(!$banners->isEmpty())
                @foreach($banners as $banner)
                    <tr>
                        <th scope="row">{{$loop->index +1}}</th>
                        <td>
                            @php
                                $thumbnails = $banner->thumbnails;
                                $thumbnails = explode(',', $thumbnails);
                            @endphp
                            @for($i = 0; $i<count($thumbnails); $i++)
                                <img class="img img-100" src="{{ asset('storage/'.$thumbnails[$i]) }}" alt="Thumbnail">
                            @endfor
                        </td>
                        <td>
                            @php
                                $sub_thumbnails = $banner->sub_thumbnails;
                                $sub_thumbnails = explode(',', $sub_thumbnails);
                            @endphp
                            @for($i = 0; $i<count($sub_thumbnails); $i++)
                                <img class="img img-100" src="{{ asset('storage/'.$sub_thumbnails[$i]) }}"
                                     alt="Thumbnail">
                            @endfor
                        </td>
                        <td id="status{{$banner->id}}">{{$banner->status}}</td>
                        <td>
                            @if($banner->status == \App\Enums\BannerStatus::ACTIVE)
                                <label class="switch">
                                    <input value="{{$banner->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$banner->id}}" id="input-check-{{$banner->id}}"
                                           type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <label class="switch">
                                    <input value="{{$banner->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$banner->id}}" id="input-check-{{$banner->id}}"
                                           type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{route('admin.banners.delete', $banner->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>j
<script>
    $(document).ready(function () {
        $(".inputCheckbox").click(function () {
            var banner = jQuery(this).val();

            function toggleAttribute(banner) {
                $.ajax({
                    url: '/admin/banners/' + banner,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        let status = document.getElementById('status' + banner)
                        status.innerText = response['status'];
                    },
                    error: function (exception) {
                        console.log(exception)
                    }
                });
            }

            toggleAttribute(banner);
        });
    });
</script>
