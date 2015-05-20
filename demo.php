<?php
    header("Content-type: text/html; charset=utf-8");
    include 'Prometheus/TemplateClass.php';
    
    #$ins = TemplateClass::get_instance();
    $ins = new TemplateClass();
    
    
    $ins->set_config('debug', true);
    //$ins->set_config('cache_time', 1);    //²âÊÔ²»¶Ï¹ýÆÚ
    //$ins->set_config('cache_html', true); //²âÊÔÆôÓÃ¾²Ì¬»º´æ
    
    $ins->assign('data', 6);
    $ins->display('demo');