<?php

require_once ('page.helper.php');

class Curl
{
    static function user_agent_string() 
    {
        static $user_agent_string_array;
        if ($user_agent_string_array == null) 
            $user_agent_string_array = require( 'user_agent_string.helper.php');
        return $user_agent_string_array[rand(0, count($user_agent_string_array) -1)];
    }

    function __construct() 
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(
            CURLOPT_USERAGENT      => self::user_agent_string(),
            CURLOPT_COOKIEFILE     => '', #enable cookie handling
            CURLOPT_AUTOREFERER    => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 9,
            CURLOPT_CONNECTTIMEOUT => 19,
#            CURLOPT_PROXY => '192.168.2.3:8888',
#            CURLOPT_VERBOSE => true
        ));
    }

    function get($url, $refer = null)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $url,
            CURLOPT_REFERER => $refer,
        ));
        return new Page(curl_exec($this->curl), curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL), $this);
    }

    function post($url, $data = null, $refer = null)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_REFERER => $refer,
        ));
        $response = curl_exec($this->curl);
        curl_setopt($this->curl, CURLOPT_POST, false);
        return new Page($response, curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL), $this);
    }

    function get_redirect_url($url, $refer = null)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $url,
            CURLOPT_REFERER => $refer,
            CURLOPT_FOLLOWLOCATION => false,
        ));
        curl_exec($this->curl);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        return curl_getinfo($this->curl, CURLINFO_REDIRECT_URL);
    }

#function not used now
    function get_with_header($url, $refer = null)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $url,
            CURLOPT_REFERER => $refer,
            CURLOPT_HEADER  => true,
        ));
        $response = curl_exec($this->curl);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        return array(
            substr($response, 0, $header_size),
            new Page(substr($response, $header_size), $url, $this),
        );
    }

    function enable_debug()
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_HEADER         => true,
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_FOLLOWLOCATION => false,
        ));
    }

    function disable_debug()
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_HEADER         => false,
            CURLINFO_HEADER_OUT    => false,
            CURLOPT_FOLLOWLOCATION => true,
        ));
    }

    function do_debug($response)
    {
        echo curl_getinfo($this->curl, CURLINFO_HEADER_OUT);
        echo $response;
        while (true)
        {
            $redirect_url = curl_getinfo($this->curl, CURLINFO_REDIRECT_URL);
            if ($redirect_url)
                curl_setopt($this->curl, CURLOPT_URL, $redirect_url);
            else break;

            $response = curl_exec($this->curl);
            echo "##########################\n";
            echo curl_getinfo($this->curl, CURLINFO_HEADER_OUT);
            echo $response;
        }
    }
}
