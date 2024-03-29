<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use PDO;

class FunctionController extends Controller
{
    function getCurrentBudgetYear() {
        $thisDate = new \DateTime();
        $thisYear = $thisDate->format('Y') + 543;
        $thisMonth = $thisDate->format('n');
    
        $budgetYear = 0;
    
        if ($thisMonth >= 10) {
            $budgetYear = $thisYear + 1;
        } elseif ($thisMonth >= 1) {
            $budgetYear = $thisYear;
        }
    
        return $budgetYear;
    }
    
}
