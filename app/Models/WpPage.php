<?php namespace  IlluminePlugin1\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Watson\Rememberable\Rememberable;

class WpPage extends Eloquent {
    use Rememberable;

    protected $table = 'posts';
    protected $primaryKey = 'ID';

    public function meta(){
        return $this->hasMany(WpPostMeta::class, 'post_id','ID');
    }
}
