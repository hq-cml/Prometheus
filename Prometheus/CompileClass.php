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
        
        public function c_var()
        {
            $pattern = "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z_0-9\x7f-\xff]*)\}/";
            $this->content = preg_replace($pattern, "<?php echo \$this->value['\\1'] ?>", $this->content);
        }
        
        public function compile($dest_file, $src_file)
        {
            $this->content = file_get_contents($src_file);
            $this->c_var();
            
            file_put_contents($dest_file, $this->content);
        }
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
