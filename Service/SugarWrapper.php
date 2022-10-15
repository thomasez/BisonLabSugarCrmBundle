<?php

namespace BisonLab\SugarCrmBundle\Service;


/*
 * Just a service object for the sugar7crm-wrapper class.
 */

class SugarWrapper 
{
    private $sugar;
    private $options;

    public function __construct($base_url, $username, $password, $platform = "sugar-wrapper")
    {
        if (!preg_match("/rest\/v[\d_]+/", $base_url)) {
            $base_url .= '/rest/v11_5/';
        }
        $this->options = [
            'base_url' => $base_url,
            'username' => $username,
            'password' => $password,
            'platform' => $platform
        ];
    }


    public function getSugar()
    {
        if (!$this->sugar) 
            $this->connectSugar();
        return $this->sugar;
    }

    public function connectSugar()
    {
        $this->sugar = new \Spinegar\SugarRestClient\Rest();
        $this->sugar
            ->setUrl($this->options['base_url'])
            ->setUsername($this->options['username'])
            ->setPassword($this->options['password'])
            ->setPlatform($this->options['platform'])
            ;
    }
}
