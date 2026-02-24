<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Storable;

class GoodsReceiptLine extends Model
{
    use Findable;
    use Storable;

    protected $fillable = [
        'ID',
        'BatchNumbers',
        'Created',
        'Creator',
        'CreatorFullName',
        'Description',
        'Division',
        'Expense',
        'ExpenseDescription',
        'GoodsReceiptID',
        'Item',
        'ItemCode',
        'ItemDescription',
        'ItemUnitCode',
        'LineNumber',
        'Location',
        'LocationCode',
        'LocationDescription',
        'Modified',
        'Modifier',
        'ModifierFullName',
        'Notes',
        'Project',
        'ProjectCode',
        'ProjectDescription',
        'PurchaseOrderID',
        'PurchaseOrderLineID',
        'PurchaseOrderNumber',
        'QuantityOrdered',
        'QuantityReceived',
        'Rebill',
        'SerialNumbers',
        'SupplierItemCode',
    ];

    protected $url = 'purchaseorder/GoodsReceiptLines';
}
