<!DOCTYPE html>
<html lang="en">
<head>
	<title>HANK - Reduction Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-tap-highlight" content="no" />
	<link rel="stylesheet" href="/public/jqm/jquery.mobile-1.4.5.min.css" />
	<link rel="stylesheet" href="/public/jqm/themes/hmw.min.css" />
	<link rel="stylesheet" href="/public/jqm/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="/public/jqm/jquery.mobile.structure-1.4.5.min.css" />
	<script src="/public/jquery-1.11.3.min.js" type="text/javascript"></script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<a href="/admin/" data-ajax="false" data-icon="home">Home</a><a href="/reduction/" data-ajax="false" data-icon="back">Back</a>
			<h1>Reduction Creation tool | <?=$bu_name?> | <?=$username?></h1>
		</div>
		<div data-role="content"><?
			if($create) {
			?>
				<?$attributes = array('id' => "reduc", 'name' => "reduc");
				echo form_open("reduction/save", $attributes);?>
					<table width="100%" style="border: 1px solid #dedcd7; margin-top:10px" cellpadding="8">
						<tr>
							<td colspan="2" style="background-color: #fbf19e;">Reduction information :
							</td>
						</tr>
						<tr>
							<td>
								<label for="nature" id="label">Nature:</label>
								<input id="nature" type="text" name="nature" value="">
							</td>
						</tr>
						<tr>
							<td>
								<label for="user" id="label">User saving the discount :</label>
								<select style="background-color:#a1ff7c" name="user" id="user" data-inline="true" data-theme="a" required>
									<option value="0">User</option>
									<?foreach ($users as $user) {?>
										<option value="<?=$user->id?>" <? if(isset($form['user']) AND $form['user']==$user->id) { ?> selected <? } ?>><?=$user->first_name?> <?=$user->last_name?>
										</option>
									<? } ?>
								?></select>
							</td>
						</tr>
					</table>
						<input type="hidden" name="id" value="create">
						<?$attributes = array('id' => "sub", 'name' => "submit");
						echo form_submit($attributes, 'Save');?>
				</form>

						<script>
						$(document).ready(function() {

							var $form = $('#reduc');

							$('#sub').on('click', function() {
								$form.trigger('submit');
								return false;
							});

							$form.on('submit', function() {

								var nature = $('#nature').val();
								var user = $('#user').val();

								if(nature == '') {
									alert('Please fill reduction nature.');
								} else if(user == 0){
									alert('Please indicate who you are.');
								}else {
									$.ajax({
										url: $(this).attr('action'),
										type: $(this).attr('method'),
										data: $(this).serialize(),
										dataType: 'json',
										success: function(json) {
											if(json.reponse == 'ok') {
												alert('Saved!');
											} else {
												alert('WARNING! ERROR at saving : '+ json.reponse);
											}
										}
									}).done(function(data) {
											//OK
									    }).fail(function(data) {
									    	alert('WARNING! ERROR at saving!');
									    });
								}
								return false;
							});
						});

						</script>
			<? } ?>
				</div><!-- /content -->
			</div><!-- /page -->
			<script src="/public/jqm/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
			<script src="/public/jqv/dist/jquery.validate.min.js" type="text/javascript"></script>
			<script src="/public/reduc.js" type="text/javascript"></script>
		</body>
		</html>
