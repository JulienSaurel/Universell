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

}
?>