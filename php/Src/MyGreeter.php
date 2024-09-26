<?php
namespace Src;
/**
 * MyGreeter class
 */

class MyGreeter {

    private $timezone;//时区
    private $currenttimestamp = 0;//默认的时间戳

    const MORNING   = "Good morning";//返回的文案
    const AFTERNOON = "Good afternoon";
    const EVENING   = "Good evening";
    /**
     * 构造函数初始化时区
     * @param string $timezone 时区字符串，默认为北京时间
     */
    public function __construct($timezone = 'Asia/Shanghai'){
        // 设置时区
        date_default_timezone_set($timezone);
        $this->timezone         = $timezone;
        $this->currenttimestamp = time();
    }
    /**
     * 设置当前时间
     *
     * @param integer $timestamp
     * @return void
     */
    public function settimestamp($timestamp ){
        $this->currenttimestamp = $timestamp;
    }
    /**
     * 获得当前时间戳
     *
     * @param integer $timestamp
     * @return void
     */
    public function gettimestamp(){
        return $this->currenttimestamp;
    }
    /**
     * 根据当前时间返回适当的问候语
     * @return string 问候语
     */
    public function greeting(){
        // 获取当前时间的小时数
        $hour = date('G', $this->currenttimestamp); // 24小时格式无前导零

        // 根据时间范围返回相应的问候语
        if ($hour >= 6 && $hour < 12){
            return MyGreeter::MORNING;
        } elseif ($hour >= 12 && $hour < 18){
            return MyGreeter::AFTERNOON;
        } else {
            return MyGreeter::EVENING;
        }
    }
}

