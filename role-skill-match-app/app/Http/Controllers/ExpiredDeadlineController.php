<?php

namespace App\Http\Controllers;

use App\Models\Role_Listing;

class ExpiredDeadlineController
{
  public function updateStatusForExpiredDeadlines()
  {
    $currentDate = now()->toDateString();

        // Update records where the deadline has passed today
    Role_Listing::where('deadline', '<', $currentDate)
      ->update(['status' => 2]);
    Role_Listing::where('vacancy', '<', 1)
      ->update(['status' => 2]);

  }
}

