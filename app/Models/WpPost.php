<?php namespace IlluminePlugin1\Models;
use Illuminate\Database\Eloquent\Model;

class WpPost extends Model {

    protected $table = 'posts';
    protected $primaryKey = 'ID';

    //protected $guarded = ['ID'];
    protected $hidden = [];

    public function meta(){
        return $this->hasMany(WpPostMeta::class, 'post_id','ID');
    }
    public function getPermalinkAttribute(){

        $postObject = get_post_type_object($this->post_type);

        $slug = $this->post_name;

        if(is_array($postObject->rewrite)){
            $slug = $postObject->rewrite['slug'].'/'.$slug;
        }
        return get_site_url(null, $slug);
    }
}