<?php
abstract class Core_Login_Modele_Index extends Core_Modele_Abstract {
	public abstract function loginSuccess($login, $password, &$userDatas);
}