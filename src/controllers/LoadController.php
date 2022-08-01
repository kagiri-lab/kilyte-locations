<?php

namespace locations\controllers;

class LoadController
{

    private function get_content($filename)
    {
        $content = file_get_contents(__DIR__ . "/../json/$filename");
        if (!empty($content))
            return json_decode($content);
        return [];
    }

    public function counties()
    {
        return $this->get_content('counties.json');
    }

    public function constituencies()
    {
        return $this->get_content('constituencies.json');
    }

    public function wards()
    {
        return $this->get_content('wards.json');
    }

    public function polling_stations()
    {
        return $this->get_content('pollingstations.json');
    }
}
