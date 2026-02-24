<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Syncable;

class SyncSupplierItem extends Model
{
    use Findable;
    use Syncable;

    protected $fillable = [
        'ID',
        'Timestamp',
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

    protected $url = 'sync/Logistics/SupplierItem';
}
