<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Match_Model extends CI_Model {

	protected $table_matches = 'matches';
	protected $table_teams_2vs2 = 'teams_2vs2';
	protected $table_maps_2vs2 = 'maps_2vs2';
	protected $table_users = 'users';

	public function create_random_2vs2_match($user_ids) {
		shuffle($user_ids);

		$first_team = $this->create_temporary_team_2vs2_match($user_ids[0], $user_ids[1]);
		$second_team = $this->create_temporary_team_2vs2_match($user_ids[2], $user_ids[3]);

		$match_token = $this->generate_match_token();
		$date = date('Y-m-d H:i:s');

		$data = array(
			'match_token' => $match_token,
			'team_1' => $first_team,
			'team_2' => $second_team,
			'match_type' => '2vs2',
			'map' => $this->get_random_2vs2_map(),
			'updated' => $date,
			'created' => $date
		);

		$this->db->insert($this->table_matches, $data);

		return $match_token;
	}

	public function get_match_by_token($match_token) {
		$this->db->where('match_token', $match_token);
		$match = $this->db->get($this->table_matches)->row();

		if(is_null($match)) {
        	return NULL;
        }

        $this->set_teams_to_match($match);

        return $match;
	}

	private function create_temporary_team_2vs2_match($player_1, $player_2) {
		$date = date('Y-m-d H:i:s');

		$data = array(
			'fixed' => 0,
			'player_1' => $player_1,
			'player_2' => $player_2,
			'updated' => $date,
			'created' => $date
		);

		$this->db->insert($this->table_teams_2vs2, $data);

		return $this->db->insert_id();
	}

	private function generate_match_token() {
		$match_token = bin2hex(random_bytes(32));
		
		while(!$this->is_valid_generated_match_token($match_token)) {
			$match_token = bin2hex(random_bytes(32));
		}

		return $match_token;
	}

	private function is_valid_generated_match_token($match_token) {
		$this->db->where('match_token', $match_token);
		$result = $this->db->get($this->table_matches)->result();

		if(count($result) > 0) {
        	return false;
        }

        return true;
	}

	private function get_random_2vs2_map() {
		$this->db->order_by('rand()');
		$this->db->limit(1);
		$result = $this->db->get($this->table_maps_2vs2)->result();
		$result = $result[0];

    	return $result->map_name;
	}

	private function set_teams_to_match(&$match) {
		if($match->match_type == '2vs2') {

			$this->db->where('id', $match->team_1);
			$match->team_1 = $this->db->get($this->table_teams_2vs2)->row();

			$this->db->where('id', $match->team_2);
			$match->team_2 = $this->db->get($this->table_teams_2vs2)->row();

			$this->set_players_to_match($match);

		} else { // 5vs5
			// TODO
		}
	}

	private function set_players_to_match(&$match) {
		if($match->match_type == '2vs2') {

			$this->db->where('id', $match->team_1->player_1);
			$player = $this->db->get($this->table_users)->row();
			$match->team_1->player_1 = $player->nickname;

			$this->db->where('id', $match->team_1->player_2);
			$player = $this->db->get($this->table_users)->row();
			$match->team_1->player_2 = $player->nickname;

			$this->db->where('id', $match->team_2->player_1);
			$player = $this->db->get($this->table_users)->row();
			$match->team_2->player_1 = $player->nickname;

			$this->db->where('id', $match->team_2->player_2);
			$player = $this->db->get($this->table_users)->row();
			$match->team_2->player_2 = $player->nickname;

		} else { // 5vs5
			// TODO
		}
	}

}

?>