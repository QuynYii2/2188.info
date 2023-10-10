@extends('backend.layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-treefy.css') }}">
    <style>
        .gray {
            color: gray;
        }
        .orange {
            color: orange;
        }
    </style>
    @php
        $nodeIndex = 0;
        $parenIndex = 0;
    @endphp
    <table class="table" id="table">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Code</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($listNation as $index => $nation)
            @php
                $nodeIndex++;
                $parenIndex = $nodeIndex;
            @endphp
            <tr data-node="treetable-{{ $nodeIndex }}">
                <td><input type="checkbox" name="row.id"/></td>
                <td>
                    <input type="radio" name="star" id="star" value="" hidden="">
                    <label for="star" onclick="starCheck({{$nation['id']}}, '{{ \App\Enums\AddressOrderOption::NATION }}')"><i id="icon-star" class="fa fa-star star-check {{ $nation['isShow'] ? 'orange' : '' }}"></i></label>
                    {{ $nation['name'] }}
                </td>
                <td>{{ $nation['country_code'] }}</td>
            </tr>
            @if (!empty($nation['child']))
                @foreach ($nation['child'] as $state)
                    @php
                        $nodeIndex++;
                        $parenIndex_1 = $nodeIndex;
                    @endphp
                    <tr data-node="treetable-{{$nodeIndex}}" data-pnode="treetable-parent-{{$parenIndex}}">
                        <td><input type="checkbox" name="row.id"/></td>
                        <td><label for="star" onclick="starCheck({{$state['id']}}, '{{ \App\Enums\AddressOrderOption::STATE }}')"><i class="fa fa-star star-check {{ $state['isShow'] ? 'orange' : '' }}"></i> {{ $state['name']}}</td>
                        <td>{{$state['state_code']}}</td>
                    </tr>
                    @if(!empty($state['child']))
                        @foreach($state['child'] as $city)
                            @php
                                $nodeIndex++;
                            @endphp
                            <tr data-node="treetable-{{$nodeIndex}}" data-pnode="treetable-parent-{{$parenIndex_1}}">
                                <td><input type="checkbox" name="row.id"/></td>
                                <td><label for="star" onclick="starCheck({{$city['id']}}, '{{ \App\Enums\AddressOrderOption::CITY }}')"><i class="fa fa-star star-check {{ $city['isShow'] ? 'orange' : '' }}"></i> {{ $city['name']}}</td>
                                <td>{{$city['city_code']}}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
    @php
        $paginationInfo = $paginationInfo->links();
    @endphp
    <div class="container">
        <ul class="pagination">
            @if ($paginationInfo->paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginationInfo->paginator->previousPageUrl() }}">Previous</a>
                </li>
            @endif
            @php
                $count = 0;
            @endphp
            @foreach ($paginationInfo->elements as $page => $url)
                @if (is_array($url))
                    @foreach($url as $link)
                        @php
                            $pageNumber = substr($link, strpos($link, "=") + 1);
                        @endphp
                        <li class="page-item"><a class="page-link" href="{{ $link }}">{{ $pageNumber }}</a></li>
                    @endforeach
                @else
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endforeach

            @if ($paginationInfo->paginator->hasMorePages())
                <li class="page-item"><a class="page-link"
                                         href="{{ $paginationInfo->paginator->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </div>
    <script src="{{ asset('js/bootstrap-treefy.js') }}"></script>
    <script>
        function starCheck(element, where) {
            let url = '';
            console.log(element, where)
            switch (where) {
                case '{{ \App\Enums\AddressOrderOption::NATION }}':
                    url = '{{ route('address.manage.update.star.nation', ['id' => ':id']) }}';
                    break;
                case '{{ \App\Enums\AddressOrderOption::STATE }}':
                    url = '{{ route('address.manage.update.star.state', ['id' => ':id']) }}';
                    break;
                case '{{ \App\Enums\AddressOrderOption::CITY }}':
                    url = '{{ route('address.manage.update.star.city', ['id' => ':id']) }}';
                    break;
            }
            url = url.replace(':id', element);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    window.location.reload();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Lỗi khi gửi AJAX request: ' + textStatus);
                }
            });
        }
    </script>
    <script>
        $(function () {
            $("#table").treeFy({
                treeColumn: 1
            });
        });
    </script>
@endsection
