<?php

class EDValidatorMap extends ValidatorMap
{

	public function getMessage()
	{
		return 'O campo ' . $this->getColumn()->getPhpName() . ' ' . utf8_decode(parent::getMessage()); // usar fun��o para traduzir as mensagens
	}
  
}
