<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/13/18
 * Time: 10:38
 */

namespace Helpers\Transformer;


class DataArrayPaginatorSerializer extends \League\Fractal\Serializer\DataArraySerializer
{

    public function mergeIncludes($transformedData, $includedData)
    {
        $includedData = array_map(function ($include) {
            return $include['data'];
        }, $includedData);

        return parent::mergeIncludes($transformedData, $includedData);
    }

}