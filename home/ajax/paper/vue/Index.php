<?php
class Home_Ajax_Paper_Vue_Index extends Core_Vue_Abstract {
    public function renderLoginOk($datas) {
        echo json_encode(
            array(
                "saisie" => $this->callTemplate("paper/saisie/content", $datas),
                "navigation" => $this->callTemplate("page/header/navigation"),
                "summary" => $this->callTemplate("paper/summary/content", $datas),
            )
        );
    }
    
    public function renderError() {
        echo json_encode(array("error" => 1));
    }
    
    public function renderAddComment($datas) {
        echo json_encode(
            array(
                "saisie" => $this->callTemplate("paper/saisie/content", $datas),
                "summary" => $this->callTemplate("paper/summary/content", $datas),
            )
        );
    }
    
    public function renderReply($datas) {
        echo $this->callTemplate("paper/saisie/content/reply", $datas);
    }
}