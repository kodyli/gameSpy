<?php
namespace App\Src\Classes;

final class DamageType{
	public const PHYSICAL_DAMAGE ='Physical Damage';
	public const MAGIC_DAMAGE ='Magic Damage';
	public const TRUE_DAMAGE ='True Damage';



	public static getDamageType($tooltip){
		if(self::isPhysicalDamage($tooltip)){
			return self::PHYSICAL_DAMAGE;
		}else if(self::isMagicDamage($tooltip)){
			return self::MAGIC_DAMAGE;
		}else if(self::isTrueDamage($tooltip)){
			return self::TRUE_DAMAGE;
		}else{
			return '';
		}
	}

	private static function isPhysicalDamage($tooltip){



	}

	private static function isMagicDamage($tooltip){}

	private static function isTrueDamage($tooltip){

	}
	
}