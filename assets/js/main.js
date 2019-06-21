  $(document).ready(function(){  

	load_data();
    
	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	}
	
	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});
	
	// Busca no Banco pelo nome
	$('#buscar').click(function() {
    var nome = $('#nomebuscar').val();
	var estadobuscar = $('#estadobuscar').val();

    $.ajax({
        type: 'POST',
        url: 'find.php',
        data: { nomebuscar: nome,estadobuscar:estadobuscar},
        success: function(response) {
            $('#user_data').html(response);
        }
    });
	});

	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Novo usuario');
		$('#action').val('insert');
		$('#form_action').val('Salvar');
		$('button[name=limparform]').show();
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_first_name = '';
		var error_last_name = '';
		if($('#nome').val() == '')
		{
			error_first_name = 'Nome  obrigatorio';
			$('#error_first_name').text(error_first_name);
			$('#nome').css('border-color', '#cc0000');
		}
		else
		{
			error_first_name = '';
			$('#error_first_name').text(error_first_name);
			$('#nome').css('border-color', '');
		}
		if($('#login').val() == '')
		{
			error_last_name = 'Login obrigatorio';
			$('#error_last_name').text(error_last_name);
			$('#login').css('border-color', '#cc0000');
		}
		else
		{
			error_last_name = '';
			$('#error_last_name').text(error_last_name);
			$('#login').css('border-color', '');
		}
		if($('#senha').val() != $('#conf_senha').val())
		{
			error_last_name = 'Senhas diferentes';
			$('#error_last_name').text(error_last_name);
			$('#senha').css('border-color', '#cc0000');
		}
		else
		{
			error_last_name = '';
			$('#error_last_name').text(error_last_name);
			$('#senha').css('border-color', '');
		}
		
		if(error_first_name != '' || error_last_name != '')
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});
	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				 console.log(data);
				$('#nome').val(data.nome);
				$('#login').val(data.login);
				$('#senha').val(data.senha);
				$('#conf_senha').val(data.senha);
				$('#estado').val(data.estado);
				$('#user_dialog').attr('title', 'Editar usuario');
				$('#action').val('update');
				$('button[name=limparform]').hide();
				$('#hidden_id').val(id);
				$('#form_action').val('Atualizar');
				$('#user_dialog').dialog('open');
			}
		});
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
	
});