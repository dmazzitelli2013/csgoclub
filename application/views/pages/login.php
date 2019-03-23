<form action="<?php echo site_url('main/login') ?>" method="post">
	<input type="text" name="email" placeholder="E-mail" value="<?php echo @$email; ?>" required></input><br>
	<input type="password" name="password" placeholder="Contraseña" required></input><br><br>
	<?php if($this->session->flashdata('login_error')) { ?><span class="error"><?php echo $this->session->flashdata('login_error'); ?></span><br><br><?php } ?>
	<input type="submit" value="Entrar"/>
</form>