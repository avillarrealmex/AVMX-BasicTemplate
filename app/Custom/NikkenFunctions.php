<?php
namespace App\Custom;
/**
 * Clase generada para generar funciones comunes en el desarrollo
 */
class NikkenFunctions {

    /**
     * Constructor de la clase
     */
    public function __construct()
    {

    }

    /**
     * param String = Texto a encriptar
     * return encrypted = texto encriptado
     */
    function aes_sap_encrypt($String = "") {
        $plaintext = $String;
        $password = '}H70 #w3hz+64.b';
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }

    /**
     * param String = Texto encriptado
     * return decrypted = texto desencriptado
     */
    function aes_sap_decrypt($Encrypt = "") {
        $password = '}H70 #w3hz+64.b';
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $decrypted = openssl_decrypt(base64_decode($Encrypt), $method, $password, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

    function getArrayRandomColor($arraySize){
        $arrayColor = [];
        for ($i=0; $i < $arraySize-1 ; $i++) {
            $hex = '#';
            //Create a loop.
            foreach(array('r', 'g', 'b') as $color){
                //Random number between 0 and 255.
                $val = mt_rand(0, 255);
                //Convert the random number into a Hex value.
                $dechex = dechex($val);
                //Pad with a 0 if length is less than 2.
                if(strlen($dechex) < 2){
                    $dechex = "0" . $dechex;
                }
                //Concatenate
                $hex .= $dechex;
            }
            array_push($arrayColor, $hex);
        }
        return $arrayColor;
    }
}
