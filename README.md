Hello future teammate!

我们用两种常见的编程语言（PHP，Python）准备了一个小测试，
你可以挑选其中一种或者其他你更自信的编程语言来完成这个测试。

动手

1. 希望你实现一个类（MyGreeter），满足以下条件：
  
  - 能够实例化。
  - 实现一个方法（让我们叫他greeting），能够根据不同的运行时间返回不同的消息字符串。
    - 当运行时间在6AM至12AM之间时，返回 "Good morning"。
    - 当运行时间在12AM至6PM之间时，返回 "Good afternoon"。
    - 当运行时间在6PM至第二天6AM之间时，返回 "Good evening"。
  - 在适当的位置编写简明扼要的注释以提高你编写的代码的可读性。
2. 希望你实现的这个类能通过我们预先准备的单元测试类（MyGreeterTest）
  
  - 我们准备了一个容器运行环境来供你运行单元测试，你需要根据实际情况对它进行改进，至少满足以下条件：
    - `make dev-tests` 这个命令可以在你的环境里运行。
    - 运行结果显示，所有的测试项目都正常通过。
  - 请用注释或者别的方式说明你的每个改进点的意图。
  - 如果你认为这个容器环境不存在值得改进的地方，也请提供用来支撑你这个看法的理由。

思考

当你完成上述动手项目后，请进一步思考并回答以下2个问题。

1. 我们准备的单元测试类（MyGreeterTest）是否存在问题？（是或者否）
2. 如果问题1你的答案"是"的话，请问有哪些问题？以及你认为针对每个问题应该如何改善？

结尾

当你全部完成后，请将"动手"和"思考"的结果打包提交给HR。
注意：请不要在这个代码仓库里直接提交PR！

----------------------------------------------分割线----------------------------------------------------

代码使用php实现

**动手部分问题及改进**

1. `make dev-tests` 相关的问题
  - a. 搭建环境后遇到不能正常执行的问题，输入结果如下
     `docker-compose exec recruit make tests OCI runtime exec failed: exec failed: unable to start container process: exec: "make": executable file not found in $PATH: unknown make: *** [Makefile:42: dev-tests] Error 126` 
    提示是环境中没有make的方法
     所以在dockerfile文件中增加 `RUN apk add --no-cache make` 解决不能正确执行的问题
  - b. Makefile中的 `tests: composer-update` 增加判断防止方法不存在异常

  - c.进一步可以优化的地方，可以把php环境下的 composer安装、make、默认时区配置等安装放到 Dockerfile中,这样减少耦合。docker配置和运行相对独立

**思考部分问题及改进**

MyGreeterTest 是存在问题的，发现的问题及改进的地方如下（下面改动都在 MyGreeterTest.php 文件中）

1. 测试用例需要覆盖不同时区，保证在不同的时区下能正常返回期望的结果,新增方法见 初始化和测试用例（可以切换不同的时区来进行测试验证）
  
2. 需要覆盖三个不同时间类型的测试，预期返回不同的三个回复，见测试用例 `test_morning` `test_afternoon` `test_evening`
  
3. 临界点时间的测试 6 12 18点的测试保证正确 
  
4. 覆盖更多时间增加随机时间测试 `test_random`
  

测试结果

`Runtime: PHP 8.3.11
Configuration: /srv/phpunit.xml`

`........ 9 / 9 (100%)`

`Time: 00:00.008, Memory: 8.00 MB`

`My Greeter
 ✔ Init
 ✔ Greeting
 ✔ Timezone
 ✔ Morning
 ✔ Afternoon
 ✔ Evening
 ✔ Default
 ✔ Timestamp
 ✔ Random`

`OK (9 tests, 9 assertions)`
