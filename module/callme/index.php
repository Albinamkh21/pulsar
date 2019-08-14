<style>
	.callme-button{
        color:#fff;
        background-color: rgba(89, 194, 175, 0.68);
		border-radius: 50%;
		position: fixed;
		border: 1px solid #ccc;
		bottom: 20px;
		right: 20px;
		z-index: 9999;
		padding: 10px 15px;
		font-size: 25px;
		box-shadow: 0 0 10px rgba(0,0,0,.2);
	}
	.callme-loader{
		color: #50a12c;
	}
    .callme-button .glyphicon.glyphicon-earphone {
        font-size:25px !important;
        background-color: rgba(89, 194, 175, 0.01);
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        vertical-align: top;

    }

</style>
<button class="callme-button" data-toggle="modal" data-target="#callme-modal"><span class="glyphicon glyphicon-earphone"></span></button>
<!-- Modal -->
<div class="modal fade" id="callme-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Обратный звонок</h4>
			</div>
			<div class="modal-body">
				<form class="callme-form">
					<div class="form-group">
						<label for="callme_name">Ваше имя</label>
						<input type="text" name="callme_name" class="form-control" placeholder="Ваше имя" required="">
					</div>
					<div class="form-group">
						<label for="callme_phone">Телефон</label>
						<input type="text" name="callme_phone" class="form-control" placeholder="Телефон" required="">
					</div>
					<button type="submit" class="btn btn-default">Отправить</button>
				</form>
			</div>
			<div class="modal-footer text-center">
				
			</div>
		</div>
	</div>
</div>
<script>
	$('.callme-form').submit(function(){
		var $this = $(this);
		$.ajax({
			type: 'POST',
			url: 'callme/send.php',
			data: $this.serialize(),
			beforeSend: function(){
				$this.find('button').attr('disabled', true);
				$this.parent().next().html('<p class="callme-loader text-center"><img src="callme/ajax-loader.gif"></p>');
			},
			success: function(res){
				setTimeout(function(){
					$('.callme-loader').fadeIn(500, function(){
						$this.parent().next().html('<p class="callme-loader text-center">' + res + '</p>');
					});
				}, 1000);
			},
			error: function(){
				alert('Ошибка! Попробуйте позже');
			}
		});
		return false;
	});
</script>