<?php

/**
 * ----------------------------------------
 * @title PHP2Html
 * @desc Converts PHP Code to HTMLText
 * @author Steve Winfield
 * @copyright 2014 $AUTHOR$
 * @license see /LICENCE
 * ----------------------------------------
 * https://github.com/SteveWinfield/PHP2HTML
**/

class HTML {
	private $name;
	private $endTagSetted;
	private $content;
	private $attributes;
	
	public function getAttributes() {
		return $this->attributes;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function hasEndTag() {
		return $this->endTagSetted;
	}
	
	public function setContent($s) {
		if ($s instanceof HTML) {
			$s = $s->getContent();
		}
		return ($this->content = $s);
	}
	
	public function setAttributes($a) {
		if ($a instanceof HTML) {
			$a = $a->getAttributes();
		}
		return ($this->attributes = $a);
	}
	
	public function setHasEndTag($h) {
		if ($h instanceof HTML) {
			$h = $h->hasEndTag();
		}
		$this->endTagSetted = $h;
	}
	
	public function __construct($name, $content, $attributes = array()) {
		$this->name = $name;
		$this->content = $content;
		$this->attributes = $attributes;
		$this->endTagSetted = self::tagHasEndTag($name);
		if (!$this->endTagSetted && strlen($this->content) > 0) {
			throw new Exception('A HTML Object without an End-Tag can\'t have content.');
		}
	}
	
	public function __toString() {
		$args = '';
		foreach ($this->attributes as $key => $value) {
			if ($key != null) {
				$args .= ' ' . ($key = str_replace(self::$htmlFilter,'',$key)) . '="' . ($value = str_replace(array('>','"'),'',$value)) . '"';
			} else {
				$args .= ' ' . ($value = str_replace(self::$htmlFilter,'',$value));
			}
		}
		return '<'.$this->name.$args.'>' . $this->content . ($this->endTagSetted ? '</'.$this->name.'>' : '');
	}
	
	public static function __callStatic ($name, $arguments) {
		$name = strtolower(str_replace(self::$htmlFilter, '', $name));
		$content = '';
		$argsCount = count($arguments);
		$argsArray = array();
		for ($i = 0; $i < $argsCount; ++$i) {
			if ($i == 0 && is_array($arguments[$i])) {
				foreach ($arguments[$i] as $key => $value) {
					$argsArray[$key] = $value;
				}
				continue;
			}
			$content .= (string) $arguments[$i];
		}
		return new HTML($name, $content, $argsArray);
	}
	
	private static function tagHasEndTag($name) {
		switch ($name) {
			case 'area':
			case 'base':
			case 'basefont':
			case 'br':
			case 'col':
			case 'frame':
			case 'hr':
			case 'img':
			case 'input':
			case 'isindex':
			case 'link':
			case 'meta':
			case 'param':
				return false;
		}
		return true;
	}
	
	private static $htmlFilter = array('<','>','"','\'');
}