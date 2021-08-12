<?php


namespace container\functions\php\thinkphp;


use container\functions\php\PHPCommon;

class Thinkphp extends PHPCommon
{
    /**
     * 处理枚举
     */
    public function handleEnums($enums)
    {
        if (empty($enums)) return '';
        $result = '';
        //添加 append

        $strAppend = '';
        foreach ($enums as $enumData) {
            $strAppend .= "'" . $enumData['key'] . "_name',";
        }
        $result .= 'protected $append = [
            ' . $strAppend . '
    ];';

        $baseStr = '
    /**
     * {{keyName}}
     */
    ';

        foreach ($enums as $enumData) {
            $str = PHP_EOL . $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . $enumData['key_note'], $str) . PHP_EOL;

            $prefix = strtoupper($enumData['key']);

            foreach ($enumData['data'] as $key => $value) {
                $result .= '   const ' . $prefix . '_' . strtoupper($key) . ' = ' . "'" . $key . "';" . "     //" . $value . PHP_EOL;
            }
        }

        //数组

        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . $enumData['key_note'], $str) . PHP_EOL;

            $strFunction = '     const ' . $enumData['key'] . ' = [
            
{{arrData}}
      ];';
            $arrdata = '';
            foreach ($enumData['data'] as $key => $value) {
                $arrdata .= "          '" . $key . "' =>" . "'" . $value . "'," . PHP_EOL;
            }
            $strFunction = str_replace('{{arrData}}', $arrdata, $strFunction);
            $result .= $strFunction;

        }
        //获取枚举方法
        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . '获取描述', $str) . PHP_EOL;
            $function_name = ucfirst($this->app->tool->struct($enumData['key']));

            $strFunction = ' 
    public function get' . $function_name . 'Params($key)
    {
        if(empty($key)) return "未知";
        return self::' . $enumData['key'] . '[$key] ?? "未知";
    }';
            $result .= $strFunction;

        }

        //增加枚举的修改器
        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . '修改器', $str) . PHP_EOL;
            $function_name = ucfirst($this->app->tool->struct($enumData['key']));
            $strFunction = '
    public function get' . $function_name . 'NameAttr()
    {
       return $this->get' . $function_name . 'Params($this["' . $enumData['key'] . '"]);
    }';
            $result .= $strFunction;

        }


        $strLibFunction = '';
        //增加枚举的修改器
        foreach ($enums as $enumData) {
            $strLibFunction .= "'" . $enumData['key'] . "' =>self::" . $enumData['key'] . ',';
        }

        $result .= ' 
        
    /**
     * 获取所有枚举
     */
    public function getlibrary()
    {
       return [' . $strLibFunction . '];
    }';


        return $result;
    }
}
