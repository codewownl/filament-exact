<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Storable;

class Account extends Model
{
    use Findable;
    use Storable;

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'Code',
        'Name',
        'Email',
        'Phone',
        'PhoneExtension',
        'Website',
        'VATNumber',
        'ChamberOfCommerce',
        'StartDate',
        'EndDate',
        'Status',
        'IsSupplier',
        'IsSales',
        'IsPurchase',
        'IsAccountant',
        'Accountant',
        'AccountantCode',
        'AccountManager',
        'AccountManagerCode',
        'AccountManagerFullName',
        'Blocked',
        'Class_01',
        'Class_02',
        'Class_03',
        'Class_04',
        'Class_05',
        'Classification',
        'ClassificationDescription',
        'Created',
        'Creator',
        'CreatorFullName',
        'CreditLinePurchase',
        'CreditLineSales',
        'DiscountPurchase',
        'DiscountSales',
        'Division',
        'Email',
        'Fax',
        'IntraStatArea',
        'IntraStatAreaDescription',
        'IntraStatDeliveryTerm',
        'IntraStatDeliveryTermDescription',
        'IntraStatSystem',
        'IntraStatSystemDescription',
        'IntraStatTransactionA',
        'IntraStatTransactionADescription',
        'IntraStatTransactionB',
        'IntraStatTransactionBDescription',
        'IntraStatTransportMethod',
        'IntraStatTransportMethodDescription',
        'IsMailing',
        'IsPilot',
        'IsReseller',
        'Language',
        'LanguageDescription',
        'Modified',
        'Modifier',
        'ModifierFullName',
        'PaymentConditionPurchase',
        'PaymentConditionPurchaseDescription',
        'PaymentConditionSales',
        'PaymentConditionSalesDescription',
        'Phone',
        'Remarks',
        'SearchCode',
        'VATLiability',
        'VATLiabilityDescription',
        'VATNumber',
        'Website',
        'AddressLine1',
        'AddressLine2',
        'City',
        'Postcode',
        'Country',
        'CountryCode',
        'State',
        'StateDescription',
    ];

    protected $url = 'crm/Accounts';
}
