<?php 

namespace almakano\botsmanager;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{

	function logic() {
		return $this->hasOne('Logic', 'id', 'logic_id');
	}
}
