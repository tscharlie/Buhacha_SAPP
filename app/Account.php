<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    protected $fillable = ['name', 'iban'];
    
    protected $appends = ['disabled', 'enabled'];
    protected $visible = ['id', 'name', 'iban'];
    
    protected $perPage = 15;

    public function getIbanAttribute($value) {
        if (empty($value)) {
            return null;
        }
        return $value;
    }

    public function getEnabledAttribute() {
        return !empty($this->iban);
    }

    public function getDisabledAttribute() {
        return empty($this->iban);
    }

    public function scopeEnabled($builder, int $value = 1) {
        if ($value === 1) {
            $builder->whereNotNull('iban')->whereNotIn('iban', [""]);
        } else if ($value === 0) {
            $builder->whereNull('iban')->orWhereIn('iban', [""]);
        } else {
            abort(500, 'invalid enabled param');
        }
    }

}
