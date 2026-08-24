<?php

namespace App\Enums;

enum AlertSeverity: string
{
    case Info = 'info';
    case Success = 'success';
    case Error = 'error';
    case Warning = 'warning';
}
