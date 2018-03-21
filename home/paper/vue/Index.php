<?php
class Home_Paper_Vue_Index extends Home_Vue_Abstract {
    public function renderBody($datas) {
        echo $this->callTemplate("paper/index", $datas);
    }
}