<?php

namespace Laralum\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use Laralum\Forum\Models\Category;
use Laralum\Forum\Models\Comment;
use Laralum\Users\Models\User;

class Thread extends Model {

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'laralum_forum_threads';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'content'];


	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}


	public function deleteComments()
	{
		foreach($this->comments as $comment) {
			$comment->delete();
		}
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
