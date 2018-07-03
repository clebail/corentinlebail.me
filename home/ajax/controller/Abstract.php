<?php
class Home_Ajax_Controller_Abstract extends Core_Controller_Abstract {
    protected function isRequestGood() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}