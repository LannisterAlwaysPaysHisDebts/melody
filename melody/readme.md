# melody 轻量框架快速入门 

## 启动应用:
### web应用启动:
创建入口文件, 初始化框架:
```
require 'melody/App.php';
(new Melody\App())->run();
```

### 脚本应用启动:
```$xslt
require "./melody/Cli.php";
(new Melody\Cli())->run();
```

## 修改配置文件
框架基本配置文件: `melody/config/main.php`

