<?php

namespace My\Engine;

use My\App;

class Service {

    static public function requestGet($method, $params = [])
    {
        $service = new static;
        return $service->executeGet($method, $params);
    }
    
    public function executeGet($method, $params)
    {
        $url = $this->getUrl($method);
        if (!empty($params)) {
            $url .= '?'.http_build_query($params);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        return $output;
    }

    public function getUrl($method)
    {
        $count_connector = count($this->connectors);
        $rand_connector = rand(0, $count_connector) % $count_connector;
        $rand_connector = $this->connectors[$rand_connector];
        return 'http://'.$rand_connector['host'].':'.$rand_connector['port'].$this->methods[$method];
    }
}
