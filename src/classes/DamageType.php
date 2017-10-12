<?php
namespace App\Src\Classes;

class DamageType{
	const PHYSICAL_DAMAGE ='physical Damage';
	const MAGIC_DAMAGE ='magic damage';
	const TRUE_DAMAGE ='true damage';

	public static function getDamageTypeCss($tooltip){
		//echo '$tooltip'+$tooltip;
		$className = '';
		if(self::isPhysicalDamage($tooltip)){
			$className =$className.'physicalDamage ';
			//echo ' physicalDamage';
		}else if(self::isMagicDamage($tooltip)){
			$className =$className.'magicDamage ';
			//echo ' magicDamage';
		}else if(self::isTrueDamage($tooltip)){
			$className =$className.'trueDamage';
			//echo ' trueDamage';
		}else{
			$className = '';
		}
		return $className;
	}

	private static function isPhysicalDamage($tooltip){
		return stripos($tooltip,self::PHYSICAL_DAMAGE) !== false;
	}

	private static function isMagicDamage($tooltip){
		return stripos($tooltip,self::MAGIC_DAMAGE) !== false;
	}

	private static function isTrueDamage($tooltip){
		return stripos($tooltip,self::TRUE_DAMAGE) !== false;
	}
	
}