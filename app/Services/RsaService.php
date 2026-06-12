<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RsaService
{
    private static $privateKeyPath = 'keys/private.key';
    private static $publicKeyPath = 'keys/public.key';

    public static function generateKeysIfNeeded()
    {
        if (!Storage::exists(self::$privateKeyPath) || !Storage::exists(self::$publicKeyPath)) {
            
            $pathToOpenSsl = 'C:/xampp/php/extras/ssl/openssl.cnf'; 

            $config = [
                "digest_alg" => "sha512",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
                "config" => $pathToOpenSsl
            ];

            $res = openssl_pkey_new($config);
            
            if (!$res) {
                throw new \Exception("Gagal bikin kunci RSA bro! Coba cek lagi lokasi file openssl.cnf kamu apakah benar di: " . $pathToOpenSsl);
            }

            openssl_pkey_export($res, $privateKey, null, $config);
            Storage::put(self::$privateKeyPath, $privateKey);

            $keyDetails = openssl_pkey_get_details($res);
            $publicKey = $keyDetails["key"];
            Storage::put(self::$publicKeyPath, $publicKey);
        }
    }

    public static function encrypt($plaintext)
    {
        self::generateKeysIfNeeded(); 
        
        $publicKey = Storage::get(self::$publicKeyPath);
        
        openssl_public_encrypt($plaintext, $encrypted, $publicKey);
        
        return base64_encode($encrypted); 
    }

    public static function decrypt($encryptedText)
    {
        self::generateKeysIfNeeded();
        
        $privateKey = Storage::get(self::$privateKeyPath);
        $encryptedData = base64_decode($encryptedText);
        
        openssl_private_decrypt($encryptedData, $decrypted, $privateKey);
        
        return $decrypted;
    }
}