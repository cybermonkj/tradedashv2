<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Validator;
use App\states;
use App\country;
use Session;
use Hash;
use File;
use Auth;
use App\User;
use App\banks;
use App\activities;
use App\packages;
use App\investment;
use App\msg;
use App\withdrawal;
use App\deposits;
use App\ref;
use App\fund_transfer;
use App\xpack_inv;
use App\xpack_packages;
use App\site_settings;
use App\ticket;
use App\comments;
use App\admin;
use App\kyc;
use App\ref_set;
use GuzzleHttp\Client as GuzzleClient;
use DotenvEditor;

   
function cal_earn()
{
    $totalEarning = 0;    
    $currentEarning = 0;
    $workingDays = 0;
          
    foreach($actInv as $inv)
    {
        $totalElapse = getDays(date('y-m-d'), $inv->end_date);
        if($totalElapse == 0)
        {
            $lastWD = $inv->last_wd;
            $enddate = ($inv->end_date);
            if($inv->package_id >= 5 && $inv->package_id <= 10)
            {
              $getDays = getDays($lastWD, $enddate);
              $currentEarning += $getDays*$inv->interest*$inv->capital;
            }
            else
            {
              $workingDays = getWorkingDays($lastWD, $enddate);
              $currentEarning += $workingDays*$inv->interest*$inv->capital;
            }
        }
        else
        {
            $sd = $inv->last_wd;
            $ed = date('Y-m-d');            
            if($inv->package_id >= 5 && $inv->package_id <= 10)
            {
              $getDays = getDays($sd, $ed);
              $currentEarning += $getDays*$inv->interest*$inv->capital;
            }
            else
            {
              $workingDays = getWorkingDays($sd, $ed);
              $currentEarning += $workingDays*$inv->interest*$inv->capital;
            }
        }
    }
}


