<?php

namespace App\Http\Controllers;

use App\Models\Role_Listing;

class ExpiredDeadlineController
{
  public function updateStatusForExpiredDeadlines()
{
    $currentDate = now()->toDateString();

    // Update records where either condition is met
    Role_Listing::where('deadline', '<', $currentDate)
        ->orWhere('vacancy', '<', 1)
        ->update(['status' => 2]);
}
}

