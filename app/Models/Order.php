<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'delivery_address',
        'addition',
        'discount',
        'payment',
        'total_order',
        'information'
    ];

    /**
     * Converter todas as palavras em caixa alta
     * @param string $value
     */
    public function setPaymentAttribute($value)
    {
        $this->attributes['payment'] = Str::upper($value);
    }

    /**
     * Converter todas as palavras em caixa alta
     * @param string $value
     */
    public function setInformationAttribute($value)
    {
        $this->attributes['information'] = Str::upper($value);
    }

    /**
     * Converte o campo para moeda padão decimal
     * @param string $value
     */
    public function setTotalOrderAttribute($value)
    {
        $this->attributes['total_order'] = floatval(convertStringToDouble($value));
    }

    /**
     * Converte o campo para moeda padão decimal
     * @param string $value
     */
    public function setAdditionAttribute($value)
    {
        $this->attributes['addition'] = floatval(convertStringToDouble($value));
    }

    /**
     * Converte o campo para moeda padão decimal
     * @param string $value
     */
    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = floatval(convertStringToDouble($value));
    }

    /**
     * Converte o campo para modeda padão Real
     * @param string $value
     *
     * @return string
     */
    public function getTotalOrderAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Converte o campo para modeda padão Real
     * @param string $value
     *
     * @return string
     */
    public function getAdditionAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Converte o campo para modeda padão Real
     * @param string $value
     *
     * @return string
     */
    public function getDiscountAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    
}