<?php

namespace AppBundle\Handler;

/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 17/05/2016
 * Time: 13:25
 */
class SecureHandler
{
    private $file = __DIR__.'/../../../web/secure/secure.txt';

    public function checkAndCreateSecurity(){
        if(file_exists($this->file)){
            return false;
        }
        fopen($this->file, 'w+');
        return true;
    }
    
    public function deletedSecurity(){
        unlink($this->file);
    }
}