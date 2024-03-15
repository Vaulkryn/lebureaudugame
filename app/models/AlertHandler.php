<?php

namespace app\models;

class AlertHandler
{
    private $alert = [];

    public function addAlert($message, $type, $function)
    {
        $this->alert[] = ['message' => $message, 'type' => $type, 'function' => $function];
    }

    public function getAlerts()
    {
        return $this->alert;
    }
}
