<?php


/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */


namespace MyCollegeAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {
    const EXPIRE = 3600;

    public static function generateBearer($id) {
        $token = self::where('user', $id)->first();
        $expire = time() - self::EXPIRE;

        if($token) {
            if($expire > date_timestamp_get($token->updated_at)) {
                $token->value = bin2hex(random_bytes(64));
                $token->save();
            }
            return $token;
        }

        $token = new Token();
        $token->user = $id;
        $token->value = bin2hex(random_bytes(64));
        $token->save();

        return $token;
    }

    public static function validateBearer($value) {
        $token = self::where('value', $value)->first();
        $expire = time() - self::EXPIRE;


        return ($token && $expire < date_timestamp_get($token->updated_at)) ? $token : false;
    }
}