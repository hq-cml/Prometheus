<?php
    /*
     * Prometheus: A simple PHP Template engine
     * Author: HQ
     * Version: 0.1
     *
     * Description：Basic Compile Class
     */
    
    class CompileClass
    {
        private $template;          //待编译的文件
        private $content;           //需要替换的文本
        private $compiled_file;     //编译后的文件
        private $left;              //左定界符
        private $right;             //有定界符
        private $value  = array();  //值栈
        
        public function __construct()
        {
        }

        public function compile($dest_file, $src_file)
        {
            file_put_contents($dest_file, file_get_contents($src_file));
        }
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
