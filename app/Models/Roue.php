<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roue extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'gameOverText'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roueElements()
    {
        return $this->hasMany(RoueElement::class);
    }

    /**
     * @return array
     */
    public function format()
    {
        $colorArray = [];
        $segmentValuesArray = $this->roueElements();
        foreach ($segmentValuesArray as $key => $value) {
            array_push($colorArray, $segmentValuesArray[$key]);
        }

        return [
            'id' => $this->id,
            'svgWidth' => $this->svgWidth,
            'svgHeight' => $this->svgHeight,
            'wheelStrokeColor' => $this->wheelStrokeColor,
            'wheelStrokeWidth' => $this->wheelStrokeWidth,
            'wheelSize' => $this->wheelSize,
            'wheelTextOffsetY' => $this->wheelTextOffsetY,
            'wheelTextColor' => $this->wheelTextColor,
            'wheelTextSize' => $this->wheelTextSize,
            'wheelImageOffsetY' => $this->wheelImageOffsetY,
            'wheelImageSize' => $this->wheelImageSize,
            'centerCircleSize' => $this->centerCircleSize,
            'centerCircleStrokeColor' => $this->centerCircleStrokeColor,
            'centerCircleStrokeWidth' => $this->centerCircleStrokeWidth,
            'centerCircleFillColor' => $this->centerCircleFillColor,
            'segmentStrokeWidth' => $this->segmentStrokeWidth,
            'centerX' => $this->centerX,
            'centerY' => $this->centerY,
            'hasShadows' => $this->hasShadows,
            'numSpins' => $this->numSpins,
            'minSpinDuration' => $this->minSpinDuration,
            'gameOverText' => $this->gameOverText,
            'invalidSpinText' => $this->invalidSpinText,
            'introText' => $this->introText,
            'hasSound' => $this->hasSound,
            'clickToSpin' => $this->clickToSpin,
            'segmentValuesArray' => $this->roueElements(),
            'colorArray' => $colorArray,
        ];
    }

}
