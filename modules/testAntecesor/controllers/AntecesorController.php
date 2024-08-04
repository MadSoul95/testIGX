<?php

namespace app\modules\testAntecesor\controllers;

use Yii;
use yii\web\Controller;
use app\modules\testAntecesor\models\TreeModel;

class AntecesorController extends Controller
{
    public function actionIndex()
    {
        $model = new TreeModel();
        $results = null;

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $results = $this->processQueries($model->n, $model->edges, $model->queries);
            } else {
                Yii::$app->session->setFlash('error', 'Error en la validación o datos de POST no recibidos');
            }
        }

        return $this->render('index', ['model' => $model, 'results' => $results]);
    }

    private function processQueries($n, $edges, $queries)
    {
        $graph = [];
        $entry = [];
        $exit = [];
        $time = 0;
        $visited = array_fill(1, $n + 1, false);

        for ($i = 1; $i <= $n; $i++) {
            $graph[$i] = [];
        }

        foreach (explode("\n", trim($edges)) as $edge) {
            $edge = trim($edge);
            if (empty($edge)) continue;
            $nodes = array_map('intval', explode(' ', $edge));
            if (count($nodes) != 2) {
                Yii::$app->session->setFlash('error', 'Formato de arista inválido: ' . htmlspecialchars($edge));
                return '';
            }
            list($u, $v) = $nodes;
            if ($u > $n || $v > $n) {
                Yii::$app->session->setFlash('error', 'Nodo fuera de rango en arista: ' . htmlspecialchars($edge));
                return '';
            }
            $graph[$u][] = $v;
            $graph[$v][] = $u;
        }

        $dfs = function ($node) use (&$graph, &$visited, &$entry, &$exit, &$time, &$dfs) {
            $visited[$node] = true;
            $entry[$node] = ++$time;
            foreach ($graph[$node] as $neighbor) {
                if (!$visited[$neighbor]) {
                    $dfs($neighbor);
                }
            }
            $exit[$node] = ++$time;
        };

        $dfs(1);

        $results = [];
        foreach (explode("\n", trim($queries)) as $query) {
            $query = trim($query);
            if (empty($query)) continue;
            $nodes = array_map('intval', explode(' ', $query));
            if (count($nodes) != 2) {
                Yii::$app->session->setFlash('error', 'Formato de consulta no válido: ' . htmlspecialchars($query));
                return '';
            }
            list($u, $v) = $nodes;
            if ($u > $n || $v > $n) {
                Yii::$app->session->setFlash('error', 'Nodo fuera de rango en consulta: ' . htmlspecialchars($query));
                return '';
            }
            if ($entry[$u] <= $entry[$v] && $exit[$u] >= $exit[$v]) {
                $results[] = "SI";
            } else {
                $results[] = "NO";
            }
        }

        return implode("\n", $results);
    }
}
