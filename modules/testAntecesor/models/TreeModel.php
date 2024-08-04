<?php
namespace app\modules\testAntecesor\models;

use Yii;
use yii\base\Model;

class TreeModel extends Model
{
    public $n;
    public $edges; // Remover inicialización de array
    public $queries; // Remover inicialización de array

    public function rules()
    {
        return [
            [['n', 'edges', 'queries'], 'required', 'message' => 'Este campo no puede estar vacío'],
            [['n'], 'integer', 'min' => 1, 'max' => 100000],
            [['edges', 'queries'], 'string'], // Cambiar la validación de 'each' a 'string'
        ];
    }

    public function validateTree()
    {
        // Lógica para validar y procesar el árbol
    }
}
