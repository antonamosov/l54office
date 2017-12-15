<?php

function city($cityId)
{
    $city = config('cities.' . $cityId);
    return $city;
}

function university($universityId)
{
    $university = config('universities.' . $universityId);
    return $university;
}

function school($schoolId)
{
    $school = config('schools.' . $schoolId);
    return $school;
}

function nation($countryId)
{
    $country = config('countries.' . $countryId);
    return $country;
}

function province($id)
{
    return config('provinces.' . $id);
}

function emailType($id)
{
    return config('email_types.' . $id);
}

function localFormatDate($date)
{
    if($date) {
        return $date->timezone("GMT+2")->format("d/m/Y H:i");
    }
    else {
        return "";
    }
}

function localFormatOnlyDate($date)
{
    if($date) {
        return $date->timezone("GMT+2")->format("d/m/Y");
    }
    else {
        return "";
    }
}

function localDate($date)
{
    if($date && !is_string($date)) {
        return $date->timezone("GMT+2")->format("Y-m-d");
    }
    elseif($date && is_string($date)) {
        return date("Y-m-d", strtotime($date));
    }
    else {
        return "";
    }
}

function paymentType($typeId)
{
    if($typeId) {
        return config('payments.types.' . $typeId);
    }
    else {
        return '';
    }
}

function studentFieldValue($key, $value)
{
    $config = config('students.' . $key);
    if ($config) {
        $reformatType = $config['reformat_type'];
        if ($reformatType === 'config') {
            return config($config['config_file'] . '.' . $value);
        }
        elseif ($reformatType === 'list') {
            $list = explode(',', $value);
            $s = [];
            foreach ($list as $k => $v) {
                $s[] = config($config['config_file'] . '.' . $v);
            }
            return implode(', ', $s);
        }
        elseif ($reformatType === 'date') {
            return date('Y-m-d', strtotime($value . '+2 hour'));
        }
        elseif ($reformatType === 'model') {
            return \App\Session::find($value)->description;
        }
        elseif ($reformatType === 'boolean') {
            return $value ? 'YES' : 'NO';
        }
    }

    return false;
}

function studentFiledReName($key)
{
    $config = config('students.' . $key);

    if ($config) {
        if (isset($config['re_name'])) {
            $key = $config['re_name'];
        }
    }

    return $key;
}