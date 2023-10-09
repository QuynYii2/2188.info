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
        $parenIndex=0;
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
                <td><i class="fa-solid fa-star star-icon gray"></i>
                    {{ $nation['name'] }}</td>
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
                        <td><i class="fa-solid fa-star star-icon gray"></i> {{ $state['name']}}</td>
                        <td>{{$state['state_code']}}</td>
                    </tr>
                    @if(!empty($state['child']))
                        @foreach($state['child'] as $city)
                            @php
                                $nodeIndex++;
                            @endphp
                            <tr data-node="treetable-{{$nodeIndex}}" data-pnode="treetable-parent-{{$parenIndex_1}}">
                                <td><input type="checkbox" name="row.id"/></td>
                                <td><i class="fa-solid fa-star star-icon gray"></i> {{ $city['name']}}</td>
                                <td>{{$city['state_code']}}</td>
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
		$(document).ready(function () {
			$('.star-icon').click(function () {
				var $this = $(this);
				var nationId = $this.data('nation-id'); // Lấy ID của quốc gia từ data attribute
				var isShow = $this.data('is-show'); // Lấy trạng thái isShow từ data attribute
				var newIsShow = isShow === 0 ? 1 : 0; // Đảo ngược trạng thái isShow

				$.ajax({
					type: 'POST',
					url: '/update-star/' + nationId,
					data: {
						_token: '{{ csrf_token() }}',
						isShow: newIsShow
					},
					success: function (data) {
						// Thực hiện các thay đổi trên giao diện dựa trên kết quả từ server
						if (newIsShow === 1) {
							$this.removeClass('gray').addClass('orange');
						} else {
							$this.removeClass('orange').addClass('gray');
						}
						$this.data('is-show', newIsShow);
					},
					error: function (xhr, textStatus, errorThrown) {
						console.error('Lỗi khi gửi AJAX request: ' + textStatus);
					}
				});
			});
		});
	</script>
    <script>
        $(function () {
            $("#table").treeFy({
                treeColumn: 1
            });
        });
    </script>
@endsection
