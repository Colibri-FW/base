<?php
namespace Colibri\Base;

/**
 * Абстрактный клас простого доступа к private переменным.
 *
 * Наследуясь от этого класса, вы можете объявлять внутренние переменные
 * (private или protected) с первым символом подчёркивания в имени и
 * иметь сразу простой public доступ к этим переменным, обращаясь к ним
 * без символа подчёркивания. В последствии вы можете некоторые из них
 * закрыть на запись и/или чтение перепереопределив методы __get и __set.
 * Если подобный функционал не требуется, вы можете пронаследоваться
 * только от Error или не наследоваться вообще.
 *
 * <code>
 * class CMyClass extends PropertyAccess
 * {
 *     private $_var1;
 * }
 *
 * $x=new CMyClass();
 * $x->var1='foobar';
 * echo($x->var1);
 * </code>
 *
 * @see Error
 *
 * @author		Александр Чибрикин aka alek13 <alek13.me@gmail.com>
 * @package		xTeam
 * @subpackage	a13FW
 * @version		1.0.0.01
 */
abstract class PropertyAccess extends Error {
	public function	__get($propName)
	{
		$p='_'.$propName;
		if (!property_exists($this, $p))
			$this->__raiseError(1, $p, get_class($this));
		return $this->$p;
	}
	public function	__set($propName,$propValue)
	{
		$p='_'.$propName;
		if (!property_exists($this, $p))
			$this->__raiseError(1, $p, get_class($this));
		return $this->$p=$propValue;
	}
}