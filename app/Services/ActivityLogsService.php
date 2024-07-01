<?php

namespace App\Services;

use App\Models\Activity_log;
use Illuminate\Support\Facades\Hash;

class ActivityLogsService
{
    public function insert($data){
        Activity_log::create([
            'subject_id'      => $data['subject_id'],
            'subject_type'    => $data['subject_type'],
            'description'     => $data['description'],
            'causer_id'       => $data['causer_id'],
            'causer_type'     => $data['causer_type'],
            'properties'      => $data['properties'],
        ]);
    }
}