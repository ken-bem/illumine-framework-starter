<?php namespace IllumineFramework\Traits;

trait ReflectibleTrait {

    public function reflect(){
        return new \ReflectionClass(get_class($this));
    }
}