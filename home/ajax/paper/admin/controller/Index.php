<?php
class Home_Ajax_Paper_Admin_Controller_Index extends Core_Controller_Abstract {
    public function renderAction() {
        $this->vue->renderContent($this->modele->createRender());
    }
}