<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:29 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{

    protected $setTableOverride = false;

    /**
     * Create a new Eloquent model instance.
     *
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(isset($this->table) && !empty($this->table)){
            $this->setTable($this->table);
        } else {
            //enable override method flag
            $this->setTableOverride = true;
        }

    }

    /**
     * Set the table associated with the model.
     *
     */
    public function setTable($table)
    {

        parent::setTable($table);
        return $this;
    }

}
