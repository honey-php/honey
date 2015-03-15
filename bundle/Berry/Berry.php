<?php

namespace Berry;

class Berry extends \Slim\Slim
{
    private $filters = array();
    
    public function filter($name, $callable = null)
    {
        if (is_callable($callable)) {
            $this->filters[$name] = $callable;
        } elseif (is_array($name)) {
            if (!is_int(key($name))) {
                foreach ($name as $filterName => $filterCallable) {
                    $this->filters[$filterName] = $filterCallable;
                }
            } else {
                return function($route) use($name){
                    foreach ($name as $filterName) {
                        $this->filters[$filterName]($route);
                    }
                };
            }
        } elseif (isset($this->filters[$name])) {
            return $this->filters[$name];
        }
    }
    
    public function base($withUri = true, $appName = 'default')
    {
        $req = $this->request();
        $uri = $req->getUrl();

        if ($withUri) {
            $uri .= $req->getRootUri();
        }
        return $uri;
    }

    public function currentUrl($withQueryString = true, $appName = 'default')
    {
        $req = $this->request();
        $uri = $req->getUrl() . $req->getPath();

        if ($withQueryString) {
            $env = $this->environment();

            if ($env['QUERY_STRING']) {
                $uri .= '?' . $env['QUERY_STRING'];
            }
        }

        return $uri;
    }
}