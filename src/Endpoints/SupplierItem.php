<?php

namespace CreativeWork\FilamentExact\Endpoints;

use CreativeWork\FilamentExact\Traits\Findable;

class SupplierItem extends Model
{
    use Findable;

    protected $fillable = [
        'ID',
        'Barcode',
        'CopyRemarks',
        'CountryOfOrigin',
        'CountryOfOriginDescription',
        'Created',
        'Creator',
        'CreatorFullName',
        'Currency',
        'CurrencyDescription',
        'Division',
        'DropShipment',
        'EndDate',
        'Item',
        'ItemCode',
        'ItemDescription',
        'ItemUnit',
        'ItemUnitCode',
        'ItemUnitDescription',
        'MainSupplier',
        'MinimumQuantity',
        'Modified',
        'Modifier',
        'ModifierFullName',
        'Notes',
        'PurchaseLeadTime',
        'PurchaseLotSize',
        'PurchasePrice',
        'PurchaseUnit',
        'PurchaseUnitDescription',
        'PurchaseUnitFactor',
        'PurchaseVATCode',
        'PurchaseVATCodeDescription',
        'StartDate',
        'Supplier',
        'SupplierCode',
        'SupplierDescription',
        'SupplierItemCode',
    ];

    protected $url = 'logistics/SupplierItem';
}