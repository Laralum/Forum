<?php

namespace Laralum\Forum\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'laralum_forum_settings';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text_editor', 'public_url'];
}
