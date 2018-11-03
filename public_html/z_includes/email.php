<form action="" method="POST" id="subscribe_form">
	<input type="text" name="email" id="email_field" class="faded" value="your@email.com" /> <input type="submit" id="subscribe_button" value="Gởi email" />
	<div id="error_message" class="form_message"<?=($error ? ' style="display: block"' : '')?>>
		<?=$error?>
	</div>
	<div id="info_message" class="form_message"<?=($info ? ' style="display: block"' : '')?>>
		<?=$info?>
	</div>
	<div id="loading">
		<img src="<?=$domain?>/images/loading.gif" />
	</div>
</form>
<script language="javascript" type="text/javascript">				
		// Subscription functions
		$('#email_field').focus(email_focus).blur(email_blur);
		$('#subscribe_form').bind('submit', subscribe_submit);
	});
</script>