<?php
//require_once APP_ROOT . '/../common/helper/url.helper.php';

libxml_use_internal_errors(true);
class Page
{
    function __construct($body, $url, $curl)
    {
        $this->url    = $url;
        $this->body   = $body;
        $this->curl   = $curl;
        $this->xpath  = null;
    }

    function fix_charset()
    {
        $this->body = str_replace(

            '<meta charset="gbk"',
            '<meta http-equiv="Content-Type" content="text/html; charset=gbk"',
            $this->body
        );
    }

    function query($xpath, $context = null, $charset = null)
    {
        if (!$this->xpath)
        {
            $doc = new DOMDocument();
            $doc->LoadHTML($this->body);
            libxml_clear_errors();
            $this->xpath = new DOMXPath($doc);
        }
        if ($context) return $this->xpath->query($xpath, $context);
        else          return $this->xpath->query($xpath);
    }

    function get($xpath, $context = null)
    {
        $href = $this->query($xpath, $context)->item(0);
        if ($href && ($url = $href->value))
        {
            return $this->curl->get($url, $this->url);
        }
    }

    function post($xpath, $data, $context = null)
    {
        $href = $this->query($xpath, $context)->item(0);
        if ($href && ($url = $href->value))
        {
            return $this->curl->post($url, $data, $this->url);
        }
    }

    function get_redirect_url($xpath, $context = null)
    {
        $href = $this->query($xpath, $context)->item(0);
        if ($href && ($url = $href->value))
        {
            return $this->curl->get_redirect_url($url, $this->url);
        }
    }

    function get_by_url($url)
    {
        return $this->curl->get($url, $this->url);
    }

    function get_redirect_url_by_url($url)
    {
        return $this->curl->get_redirect_url($url, $this->url);
    }

    function submit($form, $data = null)
    {
        if(is_string($form)) $form = $this->query($form)->item(0);
        $fields = $this->query('.//input', $form);
        $_data = array();
        foreach($fields as $field) {
            if ($field && ($name = $field->getAttribute('name')))
                $_data[$name] = $field->getAttribute('value');
        }
        $data = array_merge($_data, $data);
        $string = '';
        foreach($data as $key => $value) {
            $string .= $key . '=' . urlencode($value) . '&';
        }
        if(strtolower($form->getAttribute('method')) === 'post')
            return $this->curl->post($form->getAttribute('action'), $string, $this->url);
        else
            return $this->curl->get(
                url_add_query_string($form->getAttribute('action'), $string),
                $this->url
            );
    }
}

