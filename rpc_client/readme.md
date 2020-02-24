# laravel5.8脚手架

    cd到项目根目录，一次执行
    cp .env.example .env
    修改.env文件的配置属性(主要是DB_*字段)
    composer install -vvv
    在本地新建数据库（数据库名使用.env中设置的数据库名）
    php artisan vendor:publish
    php artisan migrate
    php artisan db:seed
    php artisan key:generate
    
## 已集成
    swagger接口文档
    laravel-ide-helper代码提示工具
    Redis封装类
    jwt接口验证
    intervention图片处理类
    
## swagger（Api文档）
    https://learnku.com/laravel/t/7430/how-to-write-api-documents-based-on-swagger-php
##### 文档访问路径
    http://xxxx/api/documentation
##### 生成接口文档
    php artisan l5-swagger:generate
    
## 测试路由
    /info php信息
    /redis redis配置测试
    /api/v1/test 框架测试