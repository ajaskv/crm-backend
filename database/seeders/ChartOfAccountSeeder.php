<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use App\Models\Utility;
use Auth;
use Illuminate\Database\Seeder;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = \Auth::user()->creatorId();
        ChartOfAccount::where('created_by', $user_id)->delete();
        Utility::invoice_ChartOfAccount($user_id);
    }
}
