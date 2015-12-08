<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php \vendor\codefire\cfusermgmt\assets\UsermgmtAsset::register($this); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1'>
		<link href="<?= \Yii::$app->request->BaseUrl; ?>/images/favicon.png" rel="shortcut icon">
		<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <script>
        var SITE_URL = '<?php echo yii\helpers\Url::home(true); ?>';
    </script>
    <?php $this->beginBody() ?>
    <?php include 'header.php'; ?>
    <div class="success_message">
        <?php echo $this->render ("@cfusermgmtView/shared/flash_msg");?>
    </div>
    <?= $content ?>
    <?php include 'footer.php'; ?>
    <?php $this->endBody() ?>


</html>
<?php $this->endPage() ?>
