<?php

namespace CodeWOW\FilamentExact\Endpoints;

use CodeWOW\FilamentExact\Traits\Findable;

class LeaveAbsenceHoursByDay extends Model
{
    use Findable;

    protected $fillable = [
        'ID',
        'Created',
        'Date',
        'Division',
        'Employee',
        'EmployeeFullName',
        'EmployeeHID',
        'Employment',
        'EmploymentHID',
        'EndTime',
        'ExternalIDInt',
        'ExternalLeaveAbsenceType',
        'Hours',
        'Modified',
        'StartTime',
        'Status',
        'Type',
    ];

    protected $url = 'hrm/LeaveAbsenceHoursByDay';
}
