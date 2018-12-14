<?php
class Security
{

    private static $seed = 'IheoYufrb7H2eXsPMMMF';

    static public function getSeed()
    {
        return self::$seed;
    }

    public static function chiffrer($texte_en_clair)
    {
        $pw=$texte_en_clair.self::$seed;
        $texte_chiffre = hash('sha256', $pw);
        return $texte_chiffre;
    }

    public static function generateRandomHex() {
        // Generate a 32 digits hexadecimal number
        $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex   = bin2hex($bytes);
        return $hex;
    }



}
?>