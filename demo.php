<?php
    header("Content-type: text/html; charset=utf-8");
    include 'Prometheus/TemplateClass.php';
    
    #$ins = TemplateClass::get_instance();
    $ins = new TemplateClass();
    
    
    $ins->set_config('debug', true);
    //$ins->set_config('cache_time', 1);    //���Բ��Ϲ���
    //$ins->set_config('cache_html', true); //�������þ�̬����

    $ins->assign('data', 4);
    $ins->assign('arr', array('a'=>1, 'b'=>2, 'c'=>3));
    
    $ins->display('demo');
    
    //$ins->clean('demo');
    //$ins->clean();