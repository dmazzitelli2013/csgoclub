<form action="<?php echo site_url('main/register') ?>" method="post">
	<input type="text" name="firstname" placeholder="Nombre" value="<?php echo @$firstname; ?>" required></input><br>
	<input type="text" name="lastname" placeholder="Apellido" value="<?php echo @$lastname; ?>" required></input><br>
	<input type="text" name="email" placeholder="E-mail" value="<?php echo @$email; ?>" required></input><br>
	<input type="text" name="nickname" placeholder="Nick" value="<?php echo @$nickname; ?>" required></input><br>
	<input type="password" name="password" placeholder="Contraseña" required></input><br>
	<input type="password" name="password_again" placeholder="Repita Contraseña" required></input><br>
	<input type="text" name="steam_id" placeholder="Steam ID" value="<?php echo @$steam_id; ?>" required></input><br><br>
	<?php if($this->session->flashdata('register_error')) { ?><span class="error"><?php echo $this->session->flashdata('register_error'); ?></span><br><br><?php } ?>
	<input type="submit" value="Registrar"/>
</form>