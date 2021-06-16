<?php



class PluginManager{
    /**
     * 已经上班的员工/已经启用的插件:用来监听or监控
     * @access private
     * @var array
     */
    private $_staff = [];
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct(){
        $this->detector();
    }
    /**
     * 初始化所有插件类

     * @access public
     * @return void
     */
    public function detector(){
        //主要功能为将插件需要执行功能放入  $_staff
        $plugins  =  $this->get_active_plugins();

        if($plugins){
            foreach($plugins as $plugin){
                #这里将所有插件践行初始化
                #路径请自己注意
                if (@file_exists($plugin['path'])){
                    include_once($plugin['path']);
                    #此时设定 文件夹名称 文件名称 类名 是统一的 如果想设定不统一请自己在get_active_plugins()内进行实现
                    $class =  $plugin['name'];
                    if (class_exists($class)){
                        #初始化所有插件类
                        new  $class($this);
                    }
                }
            }
        }
    }

    /**
     * 这里是在插件中使用的方法 用来注册插件
     *
     * @param string $hook
     * @param object $class_name
     * @param string $method
     */
    public function register($hook, &$class_name, $method)
    {
        #获取类名和方法名链接起来做下标
        $func_class = get_class($class_name).'->'.$method;
        #将类和方法放入监听数组中 以$func_class做下标
        $this->_staff[$hook][$func_class] = array(&$class_name, $method);

    }

    /**
     * 这个是全局使用的触发钩子动作方法
     *
     * @param string $hook
     * @param string $data
     * @return string
     */
    public function trigger($hook, $data='')
    {
        #首先需要判断一下$hook 存不存在

        if (isset($this->_staff[$hook]) && is_array($this->_staff[$hook]) && count($this->_staff[$hook]) > 0) {
            $plugin_func_result = '';
            #如果存在定义 $plugin_func_result
            foreach ($this->_staff[$hook] as $staff)
            {
                # 如果只是记录 请不要返回
                $plugin_func_result = '';
                $class = &$staff[0]; #引用过来的类
                $method = $staff[1]; #类下面的方法
                if(method_exists($class,$method))
                {
                    $func_result = $class->$method($data);
                    if(is_numeric($func_result)){
                        #这里判断返回值是不是字符串,如果不是将不进行返回到页面上
                        $plugin_func_result .= $func_result;
                    }

                }
            }
        }

        return $plugin_func_result ?? '';
    }

    /**
     * 获取插件信息
     */
    public function get_active_plugins(){
        # 既假定了插件在根目录的/plugin
        # 我们再次假定插件的入口和插件文件夹的名字是一样的
        # 既假定了插件在根目录的/plugin
        # 注意:这个执行文件我放在了根目录 以下路径请根据实际情况获取

        $plugin_dir_path = '.'.DIRECTORY_SEPARATOR.'plugin'.DIRECTORY_SEPARATOR;

        $plugin_dir_name_arr = scandir($plugin_dir_path);

        $plugins = array();
        foreach($plugin_dir_name_arr as $k=>$v){
            if($v=="." || $v==".."){continue;}
            if(is_dir($plugin_dir_path.$v)){
                $path = $plugin_dir_path.$v.DIRECTORY_SEPARATOR.$v.'.php';
                $plugins[] = ['name'=>$v,'path'=>$path];
            }

        }
        return $plugins;
    }


}


