<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tree-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-12 row width: 100%;">
                    <div class="col-md-10" style="float: left;">
                        <h3>Análisis de Antecesores - Matriz de Árbol</h3>
                    </div>
                </div>
                <div class="col-md-12 row width: 100%;">
                    <hr style="border-color: black;">
                </div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6">
                    <h3>Nodo Máximo</h3>
                    <p>(Considerar que esto representa el número máximo de nodos presentes en el árbol. Esta cantidad debe ser el número mayor contenido por el árbol)</p>
                    <?= $form->field($model, 'n')->label(false)->textInput(['type' => 'number', 'min' => 1, 'placeholder' => "4"]) ?>
                </div>

                <div class="col-md-6">
                    <h3>Aristas</h3>
                    <p>(ingrese un conjunto de dos N°, en donde la primera posición corresponderá al ancestro del siguiente número en el arreglo. Ejemplo: 1 2)</p>
                    <?= $form->field($model, 'edges')->label(false)->textarea(['rows' => 6, 'placeholder' => "1 2\n2 3\n3 4"]) ?>
                </div>
            </div>

            <div class="col-md-12 row">
                <div class="col-md-6">
                    <h3>Consultas</h3>
                    <p>(ingrese un conjunto de dos N°, en donde la primera posición corresponderá a la consulta de que si el primer número ingresado permite llegar al segundo número. <br> Ejemplo: 1 2)</p>
                    <?= $form->field($model, 'queries')->label(false)->textarea(['rows' => 6, 'placeholder' => "1 2\n2 3\n3 4"]) ?>
                </div>

                <div class="col-md-6">
                    <?php if ($results !== null): ?>
                        <h3>Resultados</h3>
                        <p>Aquí se muestra el análisis de las aristas registradas. En cuyo caso de obtener la respuesta SI, quiere decir que se puede llegar a la segunda posición por medio de la primera.</p>
                        <?= Html::textarea('results', $results, ['readonly' => true, 'rows' => 6, 'class' => 'form-control']) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <center><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></center>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
