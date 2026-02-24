<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;
use CodeWOW\FilamentExact\Traits\Storable;

class WebhookSubscription extends Model
{
    use Findable;
    use Storable;

    protected $fillable = [
        'ID',
        'CallbackURL',
        'ClientID',
        'Created',
        'Creator',
        'CreatorFullName',
        'Description',
        'Division',
        'Topic',
        'UserID',
    ];

    protected $url = 'webhooks/WebhookSubscriptions';
}
