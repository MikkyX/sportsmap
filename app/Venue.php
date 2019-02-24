<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = ucwords(strtolower($value));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function setPostcodeAttribute($postcode)
    {
        $postcode = preg_replace('/[^A-Z0-9]/', '', strtoupper($postcode));

        $incode_length = 3;
        $outcode_length = strlen($postcode) - $incode_length;

        $this->attributes['postcode'] =
            substr($postcode, 0, $outcode_length)
            .' '
            .substr($postcode, -$incode_length, $incode_length);
    }
}
