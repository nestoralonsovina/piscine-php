<?php

trait Serialize {
    public function getJson($id) {
        if (file_exists($this->_file)) {
            $f = file_get_contents($this->_file);
            $data = json_decode($f);


            var_dump($data);
            if (isset($data[$id])) {
                return $data[$id];
            }
        }
        return null;
    }
}

