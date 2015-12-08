<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'All Settings';
?>
<?php if (!Yii::$app->request->isAjax) { ?>
<style>
    .btn-primary {min-width: inherit;}
</style>

<div class="container">
    <div class="radius_box">
        <div class="row">
            <div class="col-md-12">
                <h2 class="dasbordTitle"><?php echo $this->title; ?></h2>
            </div>
            <?php echo \vendor\codefire\cfusermgmt\helper\SearchHelper::searchForm($this, (new \vendor\codefire\cfusermgmt\models\Setting), array('legend' => 'Search', "updateDivId" => "updateIndex")); ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="padding5" id="updateIndex">    
                    <?php } ?>
                    <?php if (!empty($models)) { ?>
                        <?php \yii\widgets\Pjax::begin(['enablePushState' => true]); ?>
                        <?=
                        \yii\grid\GridView::widget([
                            'id' => 'gridId',
                            'dataProvider' => $activeDataProvider,
                            'pager' => ['class' => 'yii\widgets\LinkPager', 'lastPageLabel' => 'Last', 'firstPageLabel' => 'First', 'options' => ['class' => 'pagination']],
                            'emptyCell' => '-',
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'id',
                                    'label' => 'Id', 'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        return Html::encode($model->id);
                                    }
                                ],
                                [
                                    'attribute' => 'name_public',
                                    'label' => 'Setting Description',
                                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:70%;text-align:left;'],
                                    'value' => function ($model, $key, $index, $column) {
                                    return Html::encode($model->name_public);
                                }
                                ],
                                [
                                    'attribute' => 'value',
                                    'label' => 'Value',
                                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:20%;text-align:center;'],
                                    'content' => function ($model, $key, $index, $column) {
                                    if ($model['type'] == 'checkbox') {
                                        return Html::checkbox($model->name, $model->value, ['id' => 'setting-' . $model->id]);
                                    } else {
                                        return Html::textInput($model->name, $model->value, ['id' => 'setting-' . $model->id, 'class' => 'form-control']);
                                    }
                                }
                                ],
                                [
                                    'attribute' => 'value',
                                    'label' => 'Action',
                                    'content' => function ($model, $key, $index, $column) {
                                        return Html::submitButton('Submit', ['class' => 'btn btn-primary ableToUpdateValue', 'id' => 'ableToUpdateValue' . $model->id, 'onclick' => 'javascript:ableToUpdateValue(' . $model->id . ')']);
                                    }
                                    ],
                                ],
                            ]);
                            ?>
                            <?php \yii\widgets\Pjax::end(); ?>
                        <?php }else {
                            echo "<div class='loans text-center'>No Settings Found.</div>";
                        } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if (!Yii::$app->request->isAjax) { ?>           
    </div>
</div>
<?php } ?>