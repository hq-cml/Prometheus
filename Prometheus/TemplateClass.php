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
        
        //构造函数
        public function __construct($arr_config = array())
        {
            $this->arr_conf = $this->arr_conf + $arr_config;   //合并配置，如果出现了相同的key，会覆盖
            $this->compiler = new CompileClass();
        }
        
        //获取模板引擎实例（单例模式）
        public static function get_instance()
        {
            if(is_null(self::$instance))
            {
                self::$instance = new TemplateClass();
            }

            return self::$instance;
        }
        
        //模板引擎配置函数
        public function set_config($key, $value=NULL)
        {
            if(is_array($key))
            {
                $this->arr_conf = $key + $this->arr_conf;      //合并配置，如果出现了相同的key，会覆盖
            }
            else
            {
                $this->arr_conf[$key] = $value;
            }
        }
        
        //模板引擎配置获取
        public function get_config($key = NULL)
        {
            if($key)
            {
                return $this->arr_conf[$key];
            }
            else
            {
                return $this->arr_conf;
            }
        }

        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
