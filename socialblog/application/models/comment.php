<?php
	class Comment extends Eloquent {
 
    public function comments()
    {
        return $this->belongs_to('Post','postid');
    }
 
}