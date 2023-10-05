@extends('backend.layouts.master')

@section('content')
	<script src="{{ asset('js/backend/address/jquery-simple-tree-table.js') }}"></script>
	<table id="basic" border="1" class="w-100">
		<tbody>
		@foreach($listNation as $index => $nation)
			<tr data-node-id="{{ $index }}">
				<td>{{ $nation['country_code'] }}</td>
				<td>{{ $nation['name'] }}</td>
			</tr>
			@if($nation['total_child'] != 0)
				@foreach($nation['child'] as $index2 => $province)
					@php
						$dot = '.';
                        $childNodeId = $index . $dot . $index2;
					@endphp
					<tr data-node-id="{{ $childNodeId }}" data-node-pid="{{ $index }}">
						<td>{{ $province['state_code'] }}</td>
						<td>{{ $province['name'] }}</td>
					</tr>
					@if($province['total_child'] != 0)
						@foreach($province['child'] as $index3 => $district)
							<tr data-node-id="{{ $childNodeId . $dot . $index3 }}" data-node-pid="{{ $childNodeId }}">
								<td>{{ $district['city_code'] }}</td>
								<td>{{ $district['name'] }}</td>
							</tr>
						@endforeach
					@endif
				@endforeach
			@endif
		@endforeach
		</tbody>
	</table>
	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-end">
			<li class="page-item">
				<a class="page-link" href="{{ $paginationInfo['prev_page_url'] }}">Previous</a>
			</li>
			<li class="page-item"><a class="page-link">{{ $paginationInfo['current_page'] }}</a></li>
			<li class="page-item">
				<a class="page-link" href="{{ $paginationInfo['next_page_url'] }}">Next</a>
			</li>
		</ul>
	</nav>

	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
	<script>
		$('#close1').on('click', function() {
			$('#basic').data('simple-tree-table').closeByID("1");
		});

		$('#basic').simpleTreeTable({
			expander: $('#expander'),
			collapser: $('#collapser'),
			store: 'session',
			storeKey: 'simple-tree-table-basic'
		});
		autoCollaper();
		function autoCollaper() {
			$('#collapser').click();
		}
	</script>

@endsection
