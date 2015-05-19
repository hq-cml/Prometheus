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
            'suffix'         => '.html',       //模板文件的后缀
            'template_dir'   => 'html/',       //模板文件所在目录
            'compile_dir'    => 'cache/',      //编译后的缓存文件所在目录
            'cache_html'     => true,         //是否缓存成静态的html文件
            'suffix_cache'   => '.htm',        //缓存后的文件的后缀
            'suffix_compile' => '.php',        //编译后的文件的后缀
            'cache_time'     => 3600,          //缓存时间
            
            'php_turn'       => true,          //是否支持原生PHP
            'cache_control'  => 'control.dat', //
            'debug'          => false          //调试开关
        );
        private $control_data    = array();
        private $value           = array();  //所有由php待输出的变量
        private $compiler;                   //编译器实例
        static private $instance = NULL;     //单实例（单例模式）
                
        public  $debug           = array();  //调试信息        
        public  $file;                       //模板文件名称（仅文件名，不带后缀名，也不带路径）
        
        //构造函数
        public function __construct($arr_config = array())
        {
            $this->debug['begin'] = microtime(true);
            $this->arr_conf = $this->arr_conf + $arr_config;   //合并配置，如果出现了相同的key，会覆盖 
            $this->convert_real_path();

            if(!is_dir($this->arr_conf['template_dir']))
            {
                die("Template dir isn't found!");
            }
            
            if(!is_dir($this->arr_conf['compile_dir']))
            {
                mkdir($this->arr_conf['compile_dir'], 0770, true);//递归创建
            }            

            //留到需要编译的时候，再实例化，提高效率
            //$this->compiler = new CompileClass();
        }
        
        //获取绝对路径
        private function convert_real_path()
        {
            $pwd = strtr(dirname(dirname(__FILE__)), '\\', '/').'/'; //当前路径，两次调用dirname的原因是TmplateClass是放在Prometheus目录下的，需要返回上层目录
            $this->arr_conf['template_dir'] = $pwd.$this->arr_conf['template_dir'];
            $this->arr_conf['compile_dir']  = $pwd.$this->arr_conf['compile_dir'];
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
        
        //assign指派
        public function assign($key, $value)
        {
            $this->value[$key] = $value;
        }
        
        //批量指派
        public function assign_arr($array)
        {
            if(is_array($array))
            {
                $this->value = $this->value + $array;      //合并配置，如果出现了相同的key，会覆盖
            }
        }
        
        //获取成员$file的位置
        public function file_path()
        {
            return $this->arr_conf['template_dir'].$this->file.$this->arr_conf['suffix'];
        }
        
        //判断是否需要重新缓存html
        //只是判断是否需要生产缓存的html，与是否需要编译html成为php无关！
        public function re_cache_html($file)
        {
            $flag = false;
            $cache_file = $this->arr_conf['compile_dir'].md5($file).".".$file.$this->arr_conf['suffix_cache'];
            
            //判断配置文件，是否需要缓存html
            if($this->arr_conf['cache_html'])
            {
                //如果文件不存在，则需要缓存html
                //如果文件存在，则判断当前时间和修改时间距离，如果大于过期时间，也需要重新缓存
                if(is_file($cache_file))
                {
                    $flag = (time() - @filemtime($cache_file)) > $this->arr_conf['cache_time']? true:false;
                }
                else
                {
                    $flag = true;
                }
            }
            return $flag;
        }     

        //display函数
        public function display($file)
        {
            $this->debug['use_cache']      = 'true';  //是否使用了静态缓存
            $this->debug['compile']        = 'false'; //是否进行了重新编译
            $this->debug['generate_cache'] = 'false'; //是否进行了静态缓存生产
            
            $this->file = $file;
            
            //判断模板文件是否存在
            if(!is_file($this->file_path()))
            {
                die("Template File Not Found!");
            }

            //判断编译缓存，如果不存在，则编译缓存之
            $compile_file = $this->arr_conf['compile_dir'].md5($file).".".$file.$this->arr_conf['suffix_compile']; //编译成php文件
            $cache_file   = $this->arr_conf['compile_dir'].md5($file).".".$file.$this->arr_conf['suffix_cache'];  //缓存成htm文件
            
            
            

            
            
            $this->debug['spend'] = microtime(true)-$this->debug['begin'];
            $this->debug['count'] = count($this->value);
            
            $this->debug_info();

        }
        
        public function debug_info()
        {
            if($this->arr_conf['debug'])
            {
                echo "<Br>", '--------------------Debug Info------------------', "<Br>";
                echo "模板解析耗时：", $this->debug['spend'], '秒', "<br>";
                echo "模板包含变量数：", $this->debug['count'], "<br>";
                echo "是否进行了重新编译：", $this->debug['compile'], "<br>";
                echo "是否进行了静态缓存生产：", $this->debug['generate_cache'], "<br>";
                echo "是否使用了静态缓存：", $this->debug['use_cache'], "<br>";
                echo "<Br>", '--------------------Debug Info------------------', "<Br>";
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
