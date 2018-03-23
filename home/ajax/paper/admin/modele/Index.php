<?php
class Home_Ajax_Paper_Admin_Modele_Index extends Core_Modele_Abstract {
    public function createRender() {
        $ret = array();
        $parseDown = new Home_Paper_Modele_Parsedown();
        
        $ret["date"] = $this->params["post"]["dateAdd"];
        $ret["title"] = $this->params["post"]["title"];
        $ret["content"] = $parseDown->text($this->params["post"]["content"]);
        
        return $ret;
    }
}