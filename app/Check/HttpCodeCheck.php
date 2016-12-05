<?php

namespace Pd\Monitoring\Check;

/**
 * @property string $url
 * @property string $code
 * @property string|NULL $lastCode
 */
class HttpCodeCheck extends Check
{

	public function __construct()
	{
		parent::__construct();
		$this->type = ICheck::TYPE_HTTP_CODE;
	}


	public function getterStatus(): int
	{
		if ( ! $this->lastCode) {
			return ICheck::STATUS_ERROR;
		} else {
			if ($this->lastCode === $this->code) {
				return ICheck::STATUS_OK;
			} else {
				return ICheck::STATUS_ALERT;
			}
		}
	}


	public function getTitle(): string
	{
		return 'HTTP stavový kód';
	}
}
