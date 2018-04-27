<?php
class Home_Ajax_User_Controller_Index extends Core_Controller_Abstract {
    public function activeAction() {
        $datas = $this->modele->active($this->params["post"]["id"], $this->params["post"]["active"]);
    }
}