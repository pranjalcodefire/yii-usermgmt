<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;
use vendor\codefire\cfusermgmt\helper\SearchHelper;

$this->title = 'All User Activities';
?>
<?php if (!Yii::$app->request->isAjax) { ?>
    <style>
        .glyphicon {font-size: 16px; margin-right: 3px;}
    </style>

    <div class="container">
        <div class="radius_box">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="dasbordTitle">
                        <?php echo $this->title; ?></h2>
                </div>
                <?php echo SearchHelper::searchForm($this, (new vendor\codefire\cfusermgmt\models\UserActivity()), array('legend' => 'Search', "updateDivId" => "updateIndex")); ?>
            </div>
            <div class="padding5">	
                <div class="col-md-12" id="updateIndex">
                <?php } ?>
                <?php if (!empty($models)) { ?>    
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => true]); ?>
                    <?=
                    \yii\grid\GridView::widget([
                        'id' => 'gridId',
                        'dataProvider' => $activeDataProvider,
                        'pager' => ['class' => 'yii\widgets\LinkPager', 'lastPageLabel' => 'Last', 'firstPageLabel' => 'First', 'options' => ['class' => 'pagination']],
                        'emptyCell' => '-',
                        'rowOptions' => function ($model, $key, $index, $column) {
                        return ['id' => 'rowId' . $model->id, 'class' => (($model->status == ACTIVE) ? 'success' : 'danger')];
                    },
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'id',
                                'label' => 'User ID', 'format' => 'raw',
                                'value' => function ($model, $key, $index, $column) {
                                    return $model->user_id;
                                }
                            ],
                            [
                                'attribute' => 'first_name',
                                'label' => 'Name',
                                'value' => function ($model, $key, $index, $column) {
                                    return (!empty($model->name) ? $model->name : 'Guest');
                                }
                            ],
                            [
                                'attribute' => 'email',
                                'label' => 'Email',
                                'value' => function ($model, $key, $index, $column) {
                                    return (!empty($model->email) ? Html::encode($model->email) : NOT_FOUND_TEXT);
                                }
                            ],
                            [
                                'attribute' => 'username',
                                'label' => 'Username',
                                'value' => function ($model, $key, $index, $column) {
                                    return (!empty($model->username) ? $model->username : NOT_FOUND_TEXT);
                                }
                            ],
                            [
                                'attribute' => 'last_url',
                                'label' => 'Last Url',
                                'value' => function ($model, $key, $index, $column) {
                                    return $model->last_url;
                                }
                            ],
                            [
                                'attribute' => 'browser',
                                'label' => 'Browser',
                                'value' => function ($model, $key, $index, $column) {
                                    return $model->user_browser;
                                }
                            ],
                            [
                                'attribute' => 'ip_address',
                                'label' => 'IP Address',
                                'value' => function ($model, $key, $index, $column) {
                                    return $model->ip_address;
                                }
                            ],
                            [
                                'attribute' => 'created',
                                'label' => 'Last Seen',
                                'value' => function ($model, $key, $index, $column) {
                                    return date(DATE_FORMAT, strtotime($model->created));
                                }
                            ],
                            [
                                'attribute' => '',
                                'label' => 'Actions',
                                'content' => function ($model, $key, $index, $column) {
                                    return $this->render('actionIcons', ['model' => $model, 'online' => true]);
                                }
                                ],
                            ],
                        ]);
                        ?>
                        <?php \yii\widgets\Pjax::end(); ?>
                        <?php
                    } else {
                        echo "<div class='loans text-center'>No Users Online Found.</div>";
                    }
                    ?>
                    <?php if (!Yii::$app->request->isAjax) { ?>           
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

