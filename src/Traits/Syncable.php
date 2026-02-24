<?php

namespace CodeWOW\FilamentExact\Traits;

use CodeWOW\FilamentExact\Services\Connection;
use Generator;

trait Syncable
{
    /**
     * @return Connection
     */
    abstract public function connection();

    abstract protected function isFillable($key);

    abstract public function url(): string;

    abstract public function primaryKey(): string;

    /**
     * Get records modified since a specific timestamp using the Sync API
     *
     * @param  string  $modifiedSince  Timestamp in ISO 8601 format (e.g., '2023-01-01T00:00:00Z')
     * @param  string  $filter  Additional OData filter
     * @param  string  $select  Fields to select
     * @param  string  $expand  Fields to expand
     */
    public function getModifiedSince(string $modifiedSince, string $filter = '', string $select = '', string $expand = ''): array
    {
        return iterator_to_array(
            $this->getModifiedSinceAsGenerator($modifiedSince, $filter, $select, $expand)
        );
    }

    /**
     * Get records modified since a specific timestamp using the Sync API as Generator
     *
     * @param  string  $modifiedSince  Timestamp in ISO 8601 format
     * @param  string  $filter  Additional OData filter
     * @param  string  $select  Fields to select
     * @param  string  $expand  Fields to expand
     */
    public function getModifiedSinceAsGenerator(string $modifiedSince, string $filter = '', string $select = '', string $expand = ''): Generator
    {
        $originalDivision = $this->connection()->getDivision();

        if ($this->isFillable('Division') && preg_match("@Division[\t\r\n ]+eq[\t\r\n ]+([0-9]+)@i", $filter, $divisionId)) {
            $this->connection()->setDivision($divisionId[1]);
        }

        $request = [
            '$filter' => "Modified ge datetime'{$modifiedSince}'",
        ];

        if (! empty($filter)) {
            $request['$filter'] = "({$request['$filter']}) and ({$filter})";
        }

        if (strlen($expand) > 0) {
            $request['$expand'] = $expand;
        }
        if (strlen($select) > 0) {
            $request['$select'] = $select;
        }

        $request['$orderby'] = 'Modified asc';

        $result = $this->connection()->get($this->url(), $request);
        if (! empty($divisionId)) {
            $this->connection()->setDivision($originalDivision);
        }

        return $this->collectionFromResultAsGenerator($result);
    }

    /**
     * Get records using delta sync (only changed records)
     *
     * @param  string  $deltaToken  Delta token from previous sync
     * @param  string  $filter  Additional OData filter
     * @param  string  $select  Fields to select
     * @param  string  $expand  Fields to expand
     */
    public function getDelta(string $deltaToken = '', string $filter = '', string $select = '', string $expand = ''): array
    {
        return iterator_to_array(
            $this->getDeltaAsGenerator($deltaToken, $filter, $select, $expand)
        );
    }

    /**
     * Get records using delta sync as Generator
     *
     * @param  string  $deltaToken  Delta token from previous sync
     * @param  string  $filter  Additional OData filter
     * @param  string  $select  Fields to select
     * @param  string  $expand  Fields to expand
     */
    public function getDeltaAsGenerator(string $deltaToken = '', string $filter = '', string $select = '', string $expand = ''): Generator
    {
        $originalDivision = $this->connection()->getDivision();

        if ($this->isFillable('Division') && preg_match("@Division[\t\r\n ]+eq[\t\r\n ]+([0-9]+)@i", $filter, $divisionId)) {
            $this->connection()->setDivision($divisionId[1]);
        }

        $request = [];

        if (! empty($deltaToken)) {
            $request['$deltatoken'] = $deltaToken;
        }

        if (! empty($filter)) {
            $request['$filter'] = $filter;
        }

        if (strlen($expand) > 0) {
            $request['$expand'] = $expand;
        }
        if (strlen($select) > 0) {
            $request['$select'] = $select;
        }

        $result = $this->connection()->get($this->url(), $request);
        if (! empty($divisionId)) {
            $this->connection()->setDivision($originalDivision);
        }

        return $this->collectionFromResultAsGenerator($result);
    }

    /**
     * Get the latest modified timestamp from the last record
     *
     * @param  string  $filter  Additional OData filter
     * @return string|null ISO 8601 timestamp or null if no records
     */
    public function getLatestModifiedTimestamp(string $filter = ''): ?string
    {
        $originalDivision = $this->connection()->getDivision();

        if ($this->isFillable('Division') && preg_match("@Division[\t\r\n ]+eq[\t\r\n ]+([0-9]+)@i", $filter, $divisionId)) {
            $this->connection()->setDivision($divisionId[1]);
        }

        $request = [
            '$select' => 'Modified',
            '$orderby' => 'Modified desc',
            '$top' => 1,
        ];

        if (! empty($filter)) {
            $request['$filter'] = $filter;
        }

        $result = $this->connection()->get($this->url(), $request);
        if (! empty($divisionId)) {
            $this->connection()->setDivision($originalDivision);
        }

        if (! empty($result) && isset($result[0]['Modified'])) {
            return $result[0]['Modified'];
        }

        return null;
    }
}
