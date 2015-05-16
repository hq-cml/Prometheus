<?php
    /*
     * Prometheus: A simple PHP Template engine
     * Author: HQ
     * Version: 0.1
     *
     * Description：Basic Template Class
     */
    include 'CompileClass.php';
    class TemplateClass
    {
        //配置
        private $arr_conf = array(
            'suffix'        => '.html',      //模板文件的后缀
            'template_dir'  => 'html/',      //模板文件所在目录
            'compile_dir'   => 'cache/',     //编译后的缓存文件所在目录
            'cache_html'    => false,        //是否编译成静态的html文件
            'suffix_cache'  => '.htm',       //编译后的文件的后缀
            'cache_time'    => 3600,         //缓存时间
        );
        private $value           = array();  //所有由php待输出的变量
        private $compiler;                   //编译器
        static private $instance = NULL;     //单实例（单例模式）
                
        public  $file;                       //模板文件名称（仅文件名，不带后缀名，也不带路径）

        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
