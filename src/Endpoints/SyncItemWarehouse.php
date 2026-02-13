<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Storable;
use CodeWOW\FilamentExact\Traits\Syncable;

class SyncItemWarehouse extends Model
{
    use Findable;
    use Syncable;

    protected $fillable = [
        'ID',
        'Created',
        'Creator',
        'CreatorFullName',
        'Division',
        'Item',
        'ItemCode',
        'ItemDescription',
        'Modified',
        'Modifier',
        'ModifierFullName',
        'ReorderPoint',
        'Timestamp',
        'Warehouse',
        'WarehouseCode',
        'WarehouseDescription',
    ];

    protected $url = 'sync/Inventory/ItemWarehouses';
}
