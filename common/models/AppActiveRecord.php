<?php 
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;


/**
 * Invoice In model
 *
 */
class AppActiveRecord extends ActiveRecord
{

	public static function getFulltextAttribuets() {
		return [];
	}

	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

}

?>