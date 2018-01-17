<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Test</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        Laravel Test
                    </a>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			
			$(document).on('click', '.edit-modal', function() {
				$('#footer_action_button').text("Update");
				$('#footer_action_button').addClass('glyphicon-check');
				$('#footer_action_button').removeClass('glyphicon-trash');
				$('.actionBtn').addClass('btn-success');
				$('.actionBtn').removeClass('btn-danger');
				$('.actionBtn').addClass('edit');
				$('.modal-title').text('Edit');
				$('.deleteContent').hide();
				$('.form-horizontal').show();
				$('#fid').val($(this).data('id'));
				$('#n').val($(this).data('name'));
				$('#q').val($(this).data('quantity'));
				$('#p').val($(this).data('price'));
				$('#myModal').modal('show');
			});
			$(document).on('click', '.delete-modal', function() {
				$('#footer_action_button').text(" Delete");
				$('#footer_action_button').removeClass('glyphicon-check');
				$('#footer_action_button').addClass('glyphicon-trash');
				$('.actionBtn').removeClass('btn-success');
				$('.actionBtn').addClass('btn-danger');
				$('.actionBtn').addClass('delete');
				$('.modal-title').text('Delete');
				$('.did').text($(this).data('id'));
				$('.deleteContent').show();
				$('.form-horizontal').hide();
				$('.dname').html($(this).data('name'));
				$('#myModal').modal('show');
			});
	
			$("#add").click(function() {
				$.ajax({
					type: 'post',
					url: '<?php echo url("/"); ?>/addItem',
					data: {
						'_token': $('input[name=_token]').val(),
						'name': $('input[name=name]').val(),
						'quantity': $('input[name=quantity]').val(),
						'price': $('input[name=price]').val()
					},
					success: function(data) {
						if ((data.errors)){
						  $('.error').removeClass('hidden');
							$('.error').text(data.errors.name);
						}
						else {
							$('.error').addClass('hidden');
							$('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td>" + data.quantity + "</td><td>" + data.price + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
						}
					},
				});
				
				$('input[name=name]').val(''),
				$('input[name=quantity]').val(''),
				$('input[name=price]').val('')
			});
			
			$('.modal-footer').on('click', '.delete', function() {
				$.ajax({
					type: 'post',
					url: '<?php echo url("/"); ?>/deleteItem',
					data: {
						'_token': $('input[name=_token]').val(),
						'id': $('.did').text()
					},
					success: function(data) {
						$('.item' + $('.did').text()).remove();
					}
				});
			});
			
			$('.modal-footer').on('click', '.edit', function() {
				$.ajax({
					type: 'post',
					url: '<?php echo url("/"); ?>/editItem',
					data: {
						'_token': $('input[name=_token]').val(),
						'id': $("#fid").val(),
						'name': $('#n').val(),
						'quantity': $('#q').val(),
						'price': $('#p').val()
					},
					success: function(data) {
						$('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td>" + data.quantity + "</td><td>" + data.price + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
					}
				});
			});
		});
	</script>
</body>
</html>
