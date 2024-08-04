<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\testAntecesor\models\TreeModel */


$this->title = 'Query Results';
$this->params['breadcrumbs'][] = $this->title;

echo "<h1>Results</h1>";

foreach ($results as $result) {
    echo Html::tag('div', $result);
}
