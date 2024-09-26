<?php


use PHPUnit\Framework\TestCase;
use Src\MyGreeter;

class MyGreeterTest extends TestCase
{
    private MyGreeter $greeter;

    public function setUp(): void
    {
        $this->greeter = new MyGreeter('Asia/Shanghai');//初始化增加时区
    }

    public function test_init()
    {
        $this->assertInstanceOf(
            MyGreeter::class,
            $this->greeter
        );
    }

    public function test_greeting()
    {
        $this->assertTrue(
            strlen($this->greeter->greeting()) > 0
        );
    }
    /**
     * 新增加的测试 morning
     *
     * @return void
     */
    public function test_morning(){
        date_default_timezone_set('Asia/Shanghai');
        $timstamp = strtotime("2024-09-26 06:00:00");
        $this->greeter->settimestamp($timstamp);
        $this->assertEquals(
            $this->greeter->greeting(),
            'Good morning'
        );
    }
    /**
     * 新增加的测试 afternoon
     *
     * @return void
     */
    public function test_afternoon(){
        date_default_timezone_set('Asia/Shanghai');
        $timstamp = strtotime("2024-09-26 12:00:00");
        $this->greeter->settimestamp($timstamp);
        $this->assertEquals(
            $this->greeter->greeting(),
            'Good afternoon'
        );
    }
    /**
     * 新增加的测试 evening
     *
     * @return void
     */
    public function test_evening(){
        date_default_timezone_set('Asia/Shanghai');
        $timstamp = strtotime("2024-09-26 05:59:59");
        $this->greeter->settimestamp($timstamp);
        $this->assertEquals(
            $this->greeter->greeting(),
            'Good evening'
        );
    }
    /**
     * 新增加的测试 当前时间的测试
     *
     * @return void
     */
    public function test_default(){
        date_default_timezone_set('Asia/Shanghai');
        $hour = date('G'); 
        // 根据时间范围返回相应的问候语
        if ($hour >= 6 && $hour < 12) {
            $greet = "Good morning";
        } elseif ($hour >= 12 && $hour < 18) {
            $greet = "Good afternoon";
        } else {
            $greet = "Good evening";
        }
        $this->assertEquals(
            $this->greeter->greeting(),
            $greet
        );
    }
    /**
     * 新增加的测试 判断中间状态是否正确
     *
     * @return void
     */
    public function test_timestamp(){
        date_default_timezone_set('Asia/Shanghai');
        $timstamp = strtotime("2024-09-26 19:00:00");
        $this->greeter->settimestamp($timstamp);
        $this->assertEquals(
            $this->greeter->gettimestamp(),
            $timstamp
        );
    }
    /**
     * 随机测试
     *
     * @return void
     */
    public function test_random(){
        date_default_timezone_set('Asia/Shanghai');
        $timstamp_start = strtotime("2024-09-26 00:00:00");
        $timstamp_end = strtotime("2024-09-26 23:59:59");
        $timstamp = rand($timstamp_start,$timstamp_end);
        $this->greeter->settimestamp($timstamp);
        $hour = date('G',$timstamp); 
        // 根据时间范围返回相应的问候语
        if ($hour >= 6 && $hour < 12) {
            $greet = "Good morning";
        } elseif ($hour >= 12 && $hour < 18) {
            $greet = "Good afternoon";
        } else {
            $greet = "Good evening";
        }
        $this->assertEquals(
            $this->greeter->greeting(),
            $greet
        );
    }
}
