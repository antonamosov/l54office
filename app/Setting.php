<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'value'
    ];

    public $timestamps = false;

    /**
     * Get object times for expired emails by day, hour, minute
     *
     * return object
     */
    public function getExpiredMailTimes()
    {
        $option = $this->getOption('cron_expired_interval');

        return (object) [
            'days' => (int) date('d', strtotime($option->value)),
            'hours' => (int) date('H', strtotime($option->value)),
            'minutes' => (int) date('i', strtotime($option->value)),
        ];
    }

    /**
     * Get option from settings
     *
     * @param $option
     * @return mixed
     */
    public function getOption($option)
    {
        return Setting::where('name', '=', $option)->first();
    }

}
