<?php

namespace Ragnarok;

class Request
{
    const METHOD_HEAD    = 'HEAD';
    const METHOD_GET     = 'GET';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_PATCH   = 'PATCH';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_PURGE   = 'PURGE';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_TRACE   = 'TRACE';
    const METHOD_CONNECT = 'CONNECT';

    private $storage;

    private $request;

    public function __construct() {
        $this->storage = $this->cleanInput($_REQUEST);
    }

    public function __get($name) {
        if (isset($this->storage[$name])) return $this->storage[$name];
    }

    private function cleanInput($data) {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = $this->cleanInput($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function getRequestEntries()
    {
        return $this -> storage;
    }

}