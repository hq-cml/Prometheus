<?php
    include 'Prometheus/TemplateClass.php';
    
    #$ins = TemplateClass::get_instance();
    $ins = new TemplateClass();
    
    //$ins->file = 'test';
    //echo "<pre>";
    //print_r($ins->get_config());
    //print_r($ins->file_path());
    
    $ins->display('demo');