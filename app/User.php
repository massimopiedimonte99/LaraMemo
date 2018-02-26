<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends \Eloquent implements Authenticatable
{
    use AuthenticatableTrait;

	public function memos()
	{
		return $this->hasMany('App\Memo');
	}

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
