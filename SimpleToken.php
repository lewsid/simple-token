<?php

/* A basic API token and authentication class. */

class SimpleToken
{
    /* Creates a salt based on the passed key that is good for the current day */
    public static function generateSalt($key)
    {
        return md5($key . date('Y-m-d'));
    }

    /* Crytographically combine the key and the salt to produce a token */
	public static function generateToken($key, $content)
    {
        $package = $content . $key;

        return crypt($package);
    }

    /* Generate a relatively strong SSL key */
    public static function generateKey()
    {
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        //Create a private key
        $res = openssl_pkey_new($config);

        //Extract the private part of the key
        openssl_pkey_export($res, $private_key);

        //Shorten it up for use in an API
        return md5($private_key);
    }
    
    /* Verify the authenticity of the passed key/token pair */
    public static function isAuthentic($key, $content, $token)
    {
        $package = $content . $key;

        if(crypt($package, $token) == $token)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}