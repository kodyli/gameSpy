<?php	
namespace App\Src\Contracts;

interface IAbility{

	/**
     * The ability name
     * @var string
     */
	//public function setName($name);
	public function getName();

	/**
     * The ability description
     * @var string
     */
	//public function setDesc($desc);
	public function getDesc();

	/**
     * The ability tooltip
     * @var string
     */
	//public function setTooltip($tooltip);
	public function getTooltip();

	/**
     * The ability image url
     * @var string
     */
	//public function setImage($image);
	public function getImageUrl();

}