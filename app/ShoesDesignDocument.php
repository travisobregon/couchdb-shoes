<?php

namespace App;

use Doctrine\CouchDB\View\DesignDocument;

class ShoesDesignDocument implements DesignDocument
{
    public function getData()
    {
        return [
            'language' => 'javascript',
            'views' => [
                'on_sale' => [
                    'map' => 'function (doc) {
                        if (doc.on_sale) {
                            emit(null, doc);
                        }
                    }'
                ],
                'popular_vendor_shoes' => [
                    'map' => 'function (doc) {
                        emit(doc.vendor.name, doc.quantity_sold);
                    }',
                    'reduce' => 'function (key, values, rereduce) { 
                        return sum(values); 
                    }'
                ],
                'most_money_made_shoes' => [
                    'map' => 'function (doc) {
                        emit(doc._id, doc.quantity_sold * doc.price);
                    }'
                ],
                'most_pairs_available_shoes' => [
                    'map' => 'function (doc) {
                        doc.inventory.forEach(function (shoe) {
                           emit(doc._id, shoe.count);
                        });
                    }',
                    'reduce' => 'function (key, values, rereduce) { 
                        return sum(values); 
                    }'
                ],
            ],
        ];
    }
}
