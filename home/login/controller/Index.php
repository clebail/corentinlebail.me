<?php
class Home_Login_Controller_Index extends Core_Login_Controller_Index {
	protected function getRedirectUrl() {
	    return Home_Controller_Index::getUrl();
	}
}