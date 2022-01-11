<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $type;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function message($id)
    {
        return Message::get($id, $this->type);
    }

    protected function empty($item)
    {
        if ($item == null) return true;
        else return false;
    }

    protected function error()
    {
        return redirect()
            ->route('category.list', ['view' => 'visible'])
            ->with('error', Message::get(0));
        exit();
    }
}
