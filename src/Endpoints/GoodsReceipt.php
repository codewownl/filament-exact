<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Storable;

class GoodsReceipt extends Model
{
    use Findable;
    use Storable;

    protected $fillable = [
        'ID',
        'Created',
        'Creator',
        'CreatorFullName',
        'Description',
        'Division',
        'Document',
        'DocumentSubject',
        'EntryNumber',
        'GoodsReceiptLineCount',
        'GoodsReceiptLines',
        'Modified',
        'Modifier',
        'ModifierFullName',
        'ReceiptDate',
        'ReceiptNumber',
        'Remarks',
        'Supplier',
        'SupplierCode',
        'SupplierContact',
        'SupplierContactFullName',
        'SupplierName',
        'Warehouse',
        'WarehouseCode',
        'WarehouseDescription',
        'YourRef',
    ];

    protected $url = 'purchaseorder/GoodsReceipts';
}
