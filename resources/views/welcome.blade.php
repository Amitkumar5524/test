@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Products</div>
			<div class="panel-body">
				<div class="container">
					<div class="form-group row add">
						{{ csrf_field() }}
						<div class="col-md-3">
							<input type="text" class="form-control" id="name" name="name"
								placeholder="Enter product name" required>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-3">
							<input type="number" class="form-control" id="price" name="price"
								placeholder="Enter product price" required>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-3">
							<input type="number" class="form-control" id="quantity" name="quantity"
								placeholder="Enter product quantity" required>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-3">
							<button class="btn btn-primary" type="submit" id="add">Add</button>
						</div>
					</div>
					
					<div class="table-responsive text-center">
						<table class="table table-borderless" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Name</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Price</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							@foreach($data as $item)
							<tr class="item{{$item->id}}">
								<td>{{$item->id}}</td>
								<td>{{$item->name}}</td>
								<td>{{$item->quantity}}</td>
								<td>{{$item->price}}</td>
								<td>
									<button class="edit-modal btn btn-info" data-id="{{$item->id}}"
										data-name="{{$item->name}}" data-price="{{$item->price}}" data-quantity="{{$item->quantity}}">
										<span class="glyphicon glyphicon-edit"></span> Edit
									</button>
									<button class="delete-modal btn btn-danger"
										data-id="{{$item->id}}" data-name="{{$item->name}}">
										<span class="glyphicon glyphicon-trash"></span> Delete
									</button>
								</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>     
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="id">ID:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="fid" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="n">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="quantity">Quantity:</label>
						<div class="col-sm-10">
							<input type="number" name="quantity" class="form-control" id="q">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="price">Price:</label>
						<div class="col-sm-10">
							<input type="number" name="price" class="form-control" id="p">
						</div>
					</div>
				</form>
				<div class="deleteContent">
					Are you Sure you want to delete <span class="dname"></span> ? <span
						class="hidden did"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn actionBtn" data-dismiss="modal">
						<span id="footer_action_button" class='glyphicon'> </span>
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
						<span class='glyphicon glyphicon-remove'></span> Close
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection