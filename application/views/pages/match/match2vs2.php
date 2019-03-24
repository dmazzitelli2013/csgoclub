<div class="match_2vs2_board">
	<div class="team_2vs2">
		<div class="player">
			<?php echo $match->team_1->player_1; ?>
		</div>
		<div class="player">
			<?php echo $match->team_1->player_2; ?>
		</div>
	</div>
	<div class="vs">
		VS
	</div>
	<div class="team_2vs2">
		<div class="player">
			<?php echo $match->team_2->player_1; ?>
		</div>
		<div class="player">
			<?php echo $match->team_2->player_2; ?>
		</div>
	</div>
	<div class="map">
		<?php echo $match->map; ?>
	</div>
</div>