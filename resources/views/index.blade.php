<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="../bower_components/css/index">
	<link rel="stylesheet" href="../bower_components/bootstrap.min/index.css">
	<link rel="stylesheet" href="../bower_components/icon/index">
	<link rel="stylesheet" href="../bower_components/font-awesome.min/index.css">
	<link rel="stylesheet" href="{{ asset('resources/css/note.css') }}">
	<script src="../bower_components/jquery-3.5.1.min/index.js"></script>
	<script src="../bower_components/popper.min/index.js"></script>
	<script src="../bower_components/bootstrap.min/index.js"></script>
</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>{{ trans('message.App_name') }}</h2>
							@if (Session::get('message')!=null)
								{{ Session::get('message') }}
							@endif
						</div>
						<div class="col-sm-6">
							<a href="{{ route('logout') }}" class="btn btn-danger"><i class="material-icons">&#xE15C;</i>
								 <span>{{ trans('message.logout') }}</span></a>
							<a href="{{ route('updateAccountview') }}" class="btn btn-primary"><i class="material-icons">&#xE15C;</i>
								 <span>{{ trans('message.updateAccount') }}</span></a>
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i>
								 <span>{{ trans('message.addnote') }}</span></a>
						</div>
						<div class="dropdown">
							<button class="dropbtn">{{ trans('message.changeLanguage') }}</button>
							<div class="dropdown-content">
							  <a href="{{ route('changeLanguage',['language'=>'en']) }}">{{ trans('message.english') }}</a>
							  <a href="{{ route('changeLanguage',['language'=>'vi']) }}">{{ trans('message.vietnamese') }}</a>
							</div>
						  </div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>{{ trans('message.number') }}</th>
							<th>{{ trans('message.content') }}</th>
							<th>{{ trans('message.action') }}</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($notes as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->content }}</td>
                            <td>
                                <a href="{{ route('editNoteview',['id'=>$item->id]) }}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a onclick="return confirm('Do you want to delete?')" href="{{ route('deleteNote',['id'=>$item->id]) }}" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('addnote') }}">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title">{{ trans('message.addnote') }}</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>{{ trans('message.content') }}</label>
							<input type="text" name="content" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="{{ trans('message.cancel') }}">
						<input type="submit" class="btn btn-success" value="{{ trans('message.add') }}" name="addnote">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->


</body>

</html>
