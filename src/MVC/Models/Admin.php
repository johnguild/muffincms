<?php

namespace Johnguild\Muffincms\MVC\Models;

use Johnguild\Muffincms\MVC\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Admin extends Model
{

    public function updateExisting($request)
    {

      switch ($request['id']) {
        case '2':
        case '1':
        default:
          $this->val = isset($request[$this->key]['val']) ? 'true':'false';
          break;
      }

      $this->save();

    }



    public static function isMaintenance()
    {
      $i = Admin::find(1);

      if($i->val == 'true')
        return true;

      return false;
    }

    public static function isOpenRegistration()
    {
      $i = Admin::find(2);

      if($i->val == 'true')
        return true;

      return false;
    }
}
