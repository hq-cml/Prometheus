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
        private $arr_pattern = array();  //模式数组
        private $arr_replace = array();  //替换数组
        
        public function __construct($template, $compile_file, $php_turn)
        {
            $this->template      = $template;
            $this->compile_file  = $compile_file;
            $this->content       = file_get_contents($template);
            
            //PHP的原生语法支持
            if($php_turn === true)
            {
                $this->arr_pattern['php_turn'] = "/<\?(=|php|) *(.+) *\?>/is"; //{ if }
                $this->arr_replace['php_turn'] = "<?\\1\\2 ?>";
            }
            
            //解析例如{$var}之类的变量
            $this->arr_pattern['var'] = "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z_0-9\x7f-\xff]*)\}/";
            $this->arr_replace['var'] = "<?php echo $\\1 ?>";
            
            //解析{foreach}起始标签，其中很多的*和?是为了之前的空格符
            $this->arr_pattern['foreach_beg_1'] = "/\{ *foreach *\\$(.+) *as *\\$(.+) *\}/";            //{foreach $arr as $v}
            $this->arr_replace['foreach_beg_1'] = "<?php foreach((array)$\\1 as $\\2){ ?>"; 

            $this->arr_pattern['foreach_beg_2'] = "/\{ *foreach *\\$(.+) *as *\\$(.+) *=> *\\$(.+)\}/";   //{foreach $arr as $k=>$v}
            $this->arr_replace['foreach_beg_2'] = "<?php foreach((array)$\\1 as $\\2 => $\\3){ ?>";  

            //解析{/foreach}结束标签
            $this->arr_pattern['foreach_end'] = "/\{\/ *foreach *\}/";
            $this->arr_replace['foreach_end'] = "<?php } ?>";             
            
            //解析if
            $this->arr_pattern['if_beg'] = "/\{ *if *(.+) *\}/"; //{ if }
            $this->arr_replace['if_beg'] = "<?php if(\\1){ ?>";
            
            //解析elseif
            $this->arr_pattern['elseif'] = "/\{ *(elseif|else if ) *(.+) *\}/"; //{ if }
            $this->arr_replace['elseif'] = "<?php }elseif(\\2){ ?>";
            
            //解析else
            $this->arr_pattern['else'] = "/\{ *else *\}/"; //{ if }
            $this->arr_replace['else'] = "<?php }else{ ?>";
            
            //解析{/if}
            $this->arr_pattern['if_end'] = "/\{ *\/if *\}/"; //{ /if }
            $this->arr_replace['if_end'] = "<?php } ?>";
            
            //TODO php 函数
            
            
        }
        
        
        public function compile()
        {
            //批量解析
            $this->content = preg_replace($this->arr_pattern, $this->arr_replace, $this->content);
            
            file_put_contents($this->compile_file, $this->content);
        }
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
