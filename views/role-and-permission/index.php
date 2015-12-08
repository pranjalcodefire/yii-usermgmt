<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;
use vendor\codefire\cfusermgmt\helper\SearchHelper;

$this->title = 'All Roles';
?>
<?php if (!Yii::$app->request->isAjax) { ?>
    <style>
        .glyphicon {font-size: 18px; margin-right: 3px;}
    </style>

    <div class="container">
        <div class="radius_box">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="dasbordTitle"><?php echo $this->title; ?> <span class="pull-right"> <?php echo Html::a('Add New', Url::to(['role-and-permission/save']), ['class' => 'btn btn-primary']); ?></span></h2>
                </div>
                <?php echo SearchHelper::searchForm($this, (new \vendor\codefire\cfusermgmt\models\RoleAndPermission()), array('legend' => 'Search', "updateDivId" => "updateIndex")); ?>
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
                        'rowOptions' => function($model) {
                        return ['id' => 'rowId' . $model->name];
                    },
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'name',
                                'label' => 'Role Name', 'format' => 'raw',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->name);
                                }
                            ],
                            [
                                'attribute' => 'role_alias',
                                'label' => 'Role Alias',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->role_alias);
                                }
                            ],
                            [
                                'attribute' => 'allow_registration',
                                'label' => 'Allow Registration',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode(!empty($model->allow_registration) ? 'Yes' : 'No');
                                }
                            ],
                            [
                                'attribute' => 'created_at',
                                'label' => 'Created',
                                'value' => function ($model, $key, $index, $column) {
                                    return date(DATE_FORMAT, strtotime($model->created_at));
                                }
                            ],
                            [
                                'label' => 'Actions',
                                'content' => function ($model, $key, $index, $column) {
                                    return $this->render('actionIcons', ['model' => $model]);
                                }
                                ],
                            ],
                        ]);
                        ?>

                        <?php \yii\widgets\Pjax::end(); ?>

                        <?php
                    } else {
                        echo "<div class='loans text-center'>No Roles Found.</div>";
                    }
                    ?>
                    <?php if (!Yii::$app->request->isAjax) { ?>           
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
