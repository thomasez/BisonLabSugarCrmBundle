<?php

namespace BisonLab\SugarCrmBundle\Service;


/*
 * Just a service object for the sugar7crm-wrapper class.
 */

class SugarWrapper 
{

    private $sugar;
    private $options;

    public function __construct($base_url, $username, $password)
    {
        $this->options = array('base_url' => $base_url, 
            'username' => $username, 
            'password' => $password);
    }


    public function getSugar()
    {
        if (!$this->sugar) 
            $this->connectSugar();
        return $this->sugar;
    }

    public function connectSugar()
    {
        /* A base URL can include the path.. aka check if someone has..*/
        if (!preg_match("/v10/", $this->options['base_url'])) {
            $this->options['base_url'] = $this->options['base_url'] . '/rest/v10/';
        }
        $this->sugar = new \Spinegar\SugarRestClient\Rest();
        $this->sugar
            ->setUrl($this->options['base_url'])
            ->setUsername($this->options['username'])
            ->setPassword($this->options['password'])
            ;
    }
}
