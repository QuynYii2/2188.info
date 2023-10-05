@extends('backend.layouts.master')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-treefy.css') }}">

	<table class="table" id="table">
		<thead>
		<tr>
			<th></th>
			<th>Column A</th>
			<th>Column B</th>
			<th>Column C</th>
			<th>Column D</th>
		</tr>
		</thead>
		<tbody>
		<tr data-node="treetable-1">
			<td><input type="checkbox" name="row.id"/></td>
			<td>Node</td>
			<td>1</td>
			<td>c</td>
			<td>info</td>
		</tr>
		<tr data-node="treetable-2" data-pnode="treetable-parent-1">
			<td><input type="checkbox" name="row.id"/></td>
			<td>Node</td>
			<td>1-1</td>
			<td>c</td>
			<td>info</td>
		</tr>
		<tr data-node="treetable-3" data-pnode="treetable-parent-1">
			<td><input type="checkbox" name="row.id"/></td>
			<td>Node</td>
			<td>1-2</td>
			<td>c</td>
			<td>info</td>
		</tr>
		<tr data-node="treetable-4">
			<td><input type="checkbox" name="row.id"/></td>
			<td>Node</td>
			<td>2</td>
			<td>c</td>
			<td>info</td>
		</tr>
		</tbody>
	</table>

	<script src="{{ asset('js/bootstrap-treefy.js') }}"></script>
	<script>
		$(function () {
			$("#table").treeFy({
				treeColumn: 1
			});
		});
	</script>

@endsection
