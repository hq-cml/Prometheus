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
        private $template;               //待编译的文件
        private $content;                //需要替换的文本
        private $compile_file;           //编译后的文件
        private $left = '{';             //左定界符
        private $right = '}';            //有定界符
        private $value  = array();       //值栈
        private $php_turn;          
        private $arr_pattern = array();  //模式数组
        private $arr_replace = array();  //替换数组
        
        public function __construct($template, $compile_file, $config)
        {
            $this->template      = $template;
            $this->compile_file  = $compile_file;
            $this->content       = file_get_contents($template);
            
            if($config['php_turn'] === false)
            {
                //TODO 原生PHP支持
            }
            
            //解析例如{$var}之类的变量
            $this->arr_pattern['var'] = "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z_0-9\x7f-\xff]*)\}/";
            $this->arr_replace['var'] = "<?php echo \$this->value['\\1'] ?>";
            
            //
            
            //TODO foreach if...else...
            
            
        }
        
        
        public function compile()
        {
            //批量解析
            $this->content = preg_replace($this->arr_pattern, $this->arr_replace, $this->content);
            
            file_put_contents($this->compile_file, $this->content);
        }
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
