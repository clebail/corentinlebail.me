<?php
class Home_Sitemap_Vue_Index extends Home_Vue_Abstract {
    public function render($datas) {
        header("Content-Type: text/xml; charset=utf-8");
        
        echo $this->callTemplate("sitemap/index", $datas);
    }
}