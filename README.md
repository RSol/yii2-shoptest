Shop test task
============================

##Install

    makedir <dirname>
    cd <dirname>
    git clone https://github.com/RSol/yii2-shoptest.git .
    composer install

##Create DB

In DBServer (MySql) create DB. Example: `yii2_tbb`
    
##Configure DB connection

Copy file `config/db.sample.php` to `config/db.php` and change connection settings 

    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2_tbb',
    'username' => 'username',
    'password' => 'password',
    'charset' => 'utf8',    

##Run migrations

    php yii migrate
    
    
##Configure your server 

See http://www.yiiframework.com/doc-2.0/guide-start-installation.html#configuring-web-servers


###Заметки по заданию 

* Только товары хранятся в базе. Принял решение, что корзину лучше хранить в сессии.
* Акции реализованы каждая своим классом, но используются через компонент `\Yii::$app->actions`, конфигурация в конфиге `config/web.php`:

```
    'components' => [
        ...
        'actions' => [
            'class' => '\app\components\actions\Action',
            'firstStop' => false,
            'actions' => [
                [
                    'class' => '\app\components\actions\First',
                    'name' => 'Первая акция',
                ],
                [
                    'class' => '\app\components\actions\Second',
                    'name' => 'Вторая акция',
                ],
            ],
        ],
        ...
```
параметр настроки компонента `firstStop` указывает на необходимость остановки после нахождения первой подходящей акции (по умолчанию `true` - остановка после первой найденой акции).
Акции объявленные выше имеют высший приоритет. Т.е. в данном случае сначала применится "Первая акция" и если она применима и параметр  `firstStop == true`, остальные акции применяться не будут, если `firstStop == false`, то применится акция и дальше проверятся следующая акция с измененной ценой


* весь JS код размещен в `web/js/card.js` и подключается через `assets/CardAsset.php`