<?php

/**
 * @author schneider
 *
 */

class Block {
    
    public $hash;
    public $last_hash;
    public $timestamp;
    public $ip;
    public $platform;
    public $browser;
    public $id;
    
    function gen_hash() {
        return md5($this->id.$this->timestamp.$this->last_hash.$this->ip.$this->platform.$this->browser);
    }
    
}

?>