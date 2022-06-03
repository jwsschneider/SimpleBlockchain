<?php

/*
 * @author Jacob Schneider
 * ipdecode.com
 */

class Block {
    
    // attributes of each block
    public $hash;
    public $last_hash;
    public $timestamp;
    public $id;
    
    // generates an MD5 hash of the current block
    function gen_hash() {
        return md5($this->id.$this->timestamp.$this->last_hash);
    }
    
}

?>