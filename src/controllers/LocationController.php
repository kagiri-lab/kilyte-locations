<?php


namespace kilyte\locations\controllers;

use stdClass;

class LocationController extends LoadController
{

    private function hasValue($values, $id): bool
    {
        $hcount = count($values);
        if ($hcount > 0 && $hcount >= $id && $id > 0)
            return true;
        else return false;
    }

    public function get_county($county_id): stdClass
    {
        if (!empty($county_id)) {
            $counties = $this->counties();
            if ($this->hasValue($counties, $county_id))
                return $counties[$county_id - 1];
        }
        return new stdClass;
    }

    public function list_counties(): stdClass{
        $counties = $this->counties();
        return $counties;
    }

    public function get_constituency($constituency_id): stdClass
    {
        if (!empty($constituency_id)) {
            $constituencies = $this->constituencies();
            if ($this->hasValue($constituencies, $constituency_id))
                return $constituencies[$constituency_id - 1];
        }
        return new stdClass;
    }

    public function list_constituencies($county_id): stdClass
    {
        if (!empty($county_id)) {
            $constituency = [];
            $constituencies = $this->constituencies();
            foreach ($constituencies as $consts => $const) {
                if ($const->county == $county_id)
                    $constituency[number_format($const->id)] = $const;
            }
            if (!empty($constituency))
                return json_decode(json_encode($constituency));
        }
        return new stdClass;
    }

    public function list_wards($constituency_id): stdClass
    {

        if (!empty($constituency_id)) {
            $ward = [];
            $wards = $this->wards();
            foreach ($wards as $wds => $wd) {
                if ($wd->constituecy == $constituency_id)
                    $ward[number_format($wd->id)] = $wd;
            }
            if (!empty($ward))
                return json_decode(json_encode($ward));
        }
        return new stdClass;
    }

    public function get_ward($ward_id): stdClass
    {
        if (!empty($ward_id)) {
            $wards = $this->wards();
            if ($this->hasValue($wards, $ward_id))
                return $wards[$ward_id--];
        }
        return new stdClass;
    }

    public function list_polling_stations($ward_id): stdClass
    {
        if (!empty($ward_id)) {
            $polling = [];
            $pollings = $this->polling_stations();
            if ($this->hasValue($pollings, $ward_id)) {
                foreach ($pollings as $polls => $poll)
                    if ($poll->ward == $ward_id)
                        $polling[number_format($poll->center_code)] = $poll;
                if (!empty($polling))
                    return json_decode(json_encode($polling));
            }
        }
        return new stdClass;
    }

    public function get_polling_station($polling_station_id): stdClass
    {
        if (!empty($polling_station_id)) {
            $polling = $this->polling_stations();
            if ($this->hasValue($polling, $polling_station_id))
                return $polling[$polling_station_id--];
        }
        return new stdClass;
    }
}
