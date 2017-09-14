<?php
namespace App\Src\Classes;

final class DamageType{
	const PHYSICAL_DAMAGE ='colorFF8C00';
	const MAGIC_DAMAGE ='color99FF99';
	const TRUE_DAMAGE ='true';

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
		return '';
	}

	private static function isPhysicalDamage($tooltip){
		return strpos($tooltip,self::PHYSICAL_DAMAGE)>0;
	}

	private static function isMagicDamage($tooltip){
		return strpos($tooltip,self::MAGIC_DAMAGE)>0;
	}

	private static function isTrueDamage($tooltip){

	}
	
}