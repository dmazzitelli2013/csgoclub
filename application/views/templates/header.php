<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CS:GO Club</title>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/styles.css'); ?>" />
</head>
<body>
	<div id="header">
		CS:GO Club
	</div>
	<?php if(isset($this->session->userdata['user'])) { ?>
	<div id="header-user">
		<?php echo $this->session->userdata['user']->firstname . ' ' . $this->session->userdata['user']->lastname; ?>
		 - <a href="<?php echo site_url('main/logout'); ?>">[SALIR]</a>
	</div>
	<?php } ?>
	<div id="container">