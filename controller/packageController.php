<?php
namespace controller;

class packageController extends \Application {

    static function getAllPackages(){
        $data = file_get_contents('http://sphpf.coldstarstudios.com/forge/main/getFree');

        // Avoid strange error :S
        $data = preg_replace('/\﻿\[/', '[', $data);

        return json_decode($data);
    }

    function listAll() {
        $packages = self::getAllPackages();
        
        //foreach($packages as $num => $package){
        //    $package['num'] = $num+1;
        //}
        
        for($i=0; $i<count($packages); $i++)
            $packages[$i]->num = $i+1;
        $this->data['packages'] = $packages;
        return new \coldstarstudios\framework\Response('web/packageList.twig', $this->data);
    }
}