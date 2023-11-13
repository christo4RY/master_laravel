<?php

namespace App\Abstract;

use Illuminate\Support\Facades\Session;

abstract class AlertResponse
{

    public static function sendSuccessAlertResponse($message = null, $to_route = null)
    {
        Session::flash('message', $message);
        Session::flash('color', 'bg-green-500');
        return $to_route;
    }

    public static function sendErrorAlertResponse($message = null, $to_route = null)
    {
        Session::flash('message', $message);
        Session::flash('color', 'bg-red-500');
        return $to_route;
    }

    public static function sendUpdateAlertResponse($message = null, $to_route = null)
    {
        Session::flash('message', $message);
        Session::flash('color', 'bg-blue-500');
        return $to_route;
    }
}
