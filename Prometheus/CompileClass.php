<?php
    /*
     * Prometheus: A simple PHP Template engine
     * Author: HQ
     * Version: 0.1
     *
     * Description：Basic Compile Class. Convert the html into php.
     */
    
    class CompileClass
    {
        private $template;          //待编译的文件
        private $content;           //需要替换的文本
        private $compiled_file;     //编译后的文件
        private $left = '{';        //左定界符
        private $right = '}';       //有定界符
        private $value  = array();  //值栈
        private $php_turn;          
        private $arr_pattern[];     //模式数组
        private $arr_replace[];     //替换数组
        
        public function __construct($template, $compiled_file, $config)
        {
            $this->template      = $template;
            $this->compiled_file = $compiled_file;
            $this->content       = file_get_contents($template);
            
            if($config['php_turn'] === false)
            {
                //TODO
            }
            
            //解析例如{$var}之类的变量
            $this->$arr_pattern['var'] = "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z_0-9\x7f-\xff]*)\}/";
            $this->$arr_replace['var'] = "<?php echo \$this->value['\\1'] ?>";
            
            //TODO foreach if...else...
            
            
        }
        
        public function compile($dest_file, $src_file)
        {
            $this->content = file_get_contents($src_file);
            $this->c_var();
            
            file_put_contents($dest_file, $this->content);
        }
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
