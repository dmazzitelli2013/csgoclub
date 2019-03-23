<form action="<?php echo site_url('main/register') ?>" method="post">
	<input type="text" name="firstname" placeholder="Nombre"></input><br>
	<input type="text" name="lastname" placeholder="Apellido"></input><br>
	<input type="text" name="email" placeholder="E-mail"></input><br>
	<input type="text" name="nickname" placeholder="Nick"></input><br>
	<input type="password" name="password" placeholder="Contraseña"></input><br>
	<input type="password" name="password_again" placeholder="Repita Contraseña"></input><br>
	<input type="text" name="steam_id" placeholder="Steam ID"></input><br><br>
	<input type="submit" value="Registrar"/>
</form>