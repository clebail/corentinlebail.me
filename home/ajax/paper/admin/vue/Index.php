<?php
class Home_Ajax_Paper_Admin_Vue_Index extends Core_Vue_Abstract {
    public function renderContent($datas) {
        echo $this->callTemplate("paper/paper", $datas);
    }
}