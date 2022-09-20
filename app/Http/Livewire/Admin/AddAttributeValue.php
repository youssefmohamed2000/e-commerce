<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddAttributeValue extends Component
{
    public $product;
    public $attributes;
    public $attribute_id = array();
    public $selected_attribute = array();
    public $values = array();

    /*public function getAttributeName()
    {
        foreach ($this->attribute_id as $id) {
            $name = $this->attributes->where('id', $id)->first()->name;
            if (!in_array($name, $this->selected_attribute))
                $this->selected_attribute[$id] = $name;
        }
        return $this->selected_attribute;
    }*/

    public function storeAttribute()
    {
        if (!empty($this->values)) {
            foreach ($this->values as $key => $value) {
                try {
                    if (in_array($key, $this->attribute_id) && !empty($value)) {
                        DB::table('attribute_values')->updateOrInsert([
                            'product_attribute_id' => $key,
                            'value' => $value,
                            'product_id' => $this->product->id,
                        ]);
                        $this->values = null;
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', 'There are some errors while adding attribute');
                }
            }
        } else {
            session()->flash('error', 'Add Some Attributes');
        }
    }

    public function deleteAttribute($id)
    {
        $this->attribute_id = array_diff($this->attribute_id, array($id));
        unset($this->values[$id]);
    }

    public function render()
    {
        //dd($this->values);
        /* if ($this->attribute_id !== null) {
             $this->selected_attribute = $this->getAttributeName();
             //dd($this->selected_attribute);
         }*/
        return view('livewire.admin.add-attribute-value');
    }
}
