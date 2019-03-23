<div id="users_grid"></div>
<script>
	var user_token = "<?php echo $user_token; ?>";
	var connection = new WebSocket('ws://localhost:8080');
	
	connection.onopen = function(e) {
		connection.send(user_token);
	};

	connection.onmessage = function(e) {
		if(needsToShowMessage(e.data)) {
			alert(e.data);
			close();
		} else {
			updateGrid(e.data);
		}
	};

	function needsToShowMessage(message) {
		try {
        	JSON.parse(message);
    	} catch(e) {
        	return true;
    	}
    	return false;
	}

	function updateGrid(data) {
		document.getElementById("users_grid").innerHTML = "";
		var users = JSON.parse(data);
		for(var i in users) {
			var element = '<div class="lobby_user">' + users[i] + '</div>';
			document.getElementById("users_grid").innerHTML += element;
		}
	}

	function close() {
		document.location.href = "<?php echo site_url('/'); ?>";
	}
</script>