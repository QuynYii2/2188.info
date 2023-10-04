@extends('backend.layouts.master')

@section('content')
	<script src="{{ asset('js/backend/address/jquery-simple-tree-table.js') }}"></script>

	<table id="basic" border="1">
		<tr data-node-id="1">
			<td><a href="#">1</a></td>
			<td>text of 1</td>
		</tr>
		<tr data-node-id="1.1" data-node-pid="1">
			<td><a href="#">1.1</a></td>
			<td>text of 1.1</td>
		</tr>
		<tr data-node-id="1.1.1" data-node-pid="1.1">
			<td><a href="#">1.1.1</a></td>
			<td>text of 1.1.1</td>
		</tr>
		<tr data-node-id="1.1.2" data-node-pid="1.1">
			<td><a href="#">1.1.2</a></td>
			<td>text of 1.1.2</td>
		</tr>
		<tr data-node-id="1.2" data-node-pid="1">
			<td><a href="#">1.2</a></td>
			<td>text of 1.2</td>
		</tr>

		<tr data-node-id="2">
			<td><a href="#">2</a></td>
			<td>text of 2</td>
		</tr>
		<tr data-node-id="2.1" data-node-pid="2">
			<td><a href="#">2.1</a></td>
			<td>text of 2.1</td>
		</tr>
		<tr data-node-id="2.2" data-node-pid="2">
			<td><a href="#">2.2</a></td>
			<td>text of 2.2</td>
		</tr>
	</table>
	<script>
		$('#basic').simpleTreeTable({
			expander: $('#expander'),
			collapser: $('#collapser'),
			store: 'session',
			storeKey: 'simple-tree-table-basic'
		});
	</script>

@endsection
