<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\widgets\Alert;
use vendor\codefire\cfusermgmt\helper\SearchHelper;

$model = new vendor\codefire\cfusermgmt\models\User;

$this->title = 'All Users';
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
                        <?php echo $this->title; ?>
    <!--                        <span class="pull-right"> <?php //echo Html::a('Add New', Url::to(['user/save']), ['class' => 'btn btn-primary']);                ?></span>-->
                    </h2>
                </div>
                <?php echo SearchHelper::searchForm($this, $model, array('legend' => 'Search', "updateDivId" => "updateIndex")); ?>
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
                                    return Html::encode($model->id);
                                }
                            ],
                            [
                                'attribute' => 'first_name',
                                'label' => 'Name',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->first_name . ' ' . $model->last_name);
                                }
                            ],
                            [
                                'attribute' => 'email',
                                'label' => 'Email',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->email);
                                }
                            ],
                            [
                                'attribute' => 'username',
                                'label' => 'Username',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->username);
                                }
                            ],
                            [
                                'attribute' => 'groups',
                                'label' => 'Group(s)',
                                'value' => function ($model, $key, $index, $column) {
                                    return Html::encode(vendor\codefire\cfusermgmt\views\helpers\Helper::findRoleAlias($model->userRole[0]->item_name));
                                }
                            ],
                            [
                                'attribute' => 'email_verified',
                                'label' => 'Email Verified',
                                'contentOptions' => function ($model, $key, $index, $column) {
                                    return ['id' => 'email_verified_td' . $model->id];
                                },
                                    'value' => function ($model, $key, $index, $column) {
                                    return ((Html::encode($model->email_verified) == VERIFIED) ? 'Yes' : 'No');
                                }
                                ],
                                [
                                    'attribute' => 'status',
                                    'label' => 'Status',
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        return ['id' => 'status_td' . $model->id];
                                    },
                                        'value' => function ($model, $key, $index, $column) {
                                        return ((Html::encode($model->status) == ACTIVE) ? 'Active' : 'Inactive');
                                    }
                                    ],
                                    [
                                        'attribute' => 'created',
                                        'label' => 'Created',
                                        'value' => function ($model, $key, $index, $column) {
                                            return date(DATE_FORMAT, strtotime($model->created));
                                        }
                                    ],
                                    [
                                        'attribute' => 'status',
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
                        echo "<div class='loans text-center'>No Users Found.</div>";
                    }
                    ?>
                    <?php if (!Yii::$app->request->isAjax) { ?>           
                                </div>
                            </div>
                    
                    </div>
                </div>
            <?php } ?>
