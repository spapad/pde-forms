<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php if (isset(\Yii::$app->params['tracking-id'])) : ?>
            <?= $this->render('_tracking', ['tracking_id' => \Yii::$app->params['tracking-id']]) ?>
        <?php endif; ?>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Αρχική', 'url' => ['/site/index']],
                    ['label' => 'Σχετικά', 'url' => ['/site/about']],
                    Yii::$app->user->isGuest ?
                        ['label' => '<i class="glyphicon glyphicon-log-in"></i> Σύνδεση',
                        'encode' => false,
                        'visible' => Yii::$app->user->isGuest,
                        'url' => ['/site/login']
                        ] :
                        ['label' => '<i class="glyphicon glyphicon-user"></i>',
                        'encode' => false,
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            '<li class="dropdown-header">' . Yii::$app->user->identity->username . '</li>',
                            ['label' => '<i class="glyphicon glyphicon-log-out"></i> Αποσύνδεση',
                                'encode' => false,
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ],
                        ],
                        ],
                ],
            ]);
            NavBar::end();

            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])

                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Yii::$app->params['companyName'] ?> <?= date('Y') ?> |
                    <?= Html::a('Αρχική', ['site/index']) ?> | 
                    <?= Html::a('Σχετικά', ['site/about']) ?> | 
                    <?=
                    Yii::$app->user->isGuest ?
                        Html::a('Σύνδεση', ['site/login']) :
                        Html::a('Αποσύνδεση ' . Yii::$app->user->identity->username, ['site/logout'], ['data-method' => 'post'])

                    ?>
                </p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
