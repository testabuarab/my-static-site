<?php


namespace venveo\bulkedit\models;

use craft\base\Field;
use craft\base\Model;
use craft\models\FieldLayout;
use craft\records\User;
use yii\db\ActiveQueryInterface;

/**
 * @property int|null ownerId
 * @property integer siteId
 * @property string elementIds
 * @property ActiveQueryInterface $site
 * @property User $owner
 * @property ActiveQueryInterface $historyItems
 * @property string fieldIds
 * @property integer id
 */
class FieldWrapper extends Model
{
    public Field $field;

    public $strategy;

    /**
     * @var FieldLayout[]
     */
    public array $layouts;
}
