<?php

namespace App\Console\Commands;

use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Models\TimeLevelTable;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UpdateRank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->addHours(7);
        $timeTables = TimeLevelTable::where('expiration_date', '<', $now)->get();
        if (count($timeTables) > 0){
            for ($i = 0; $i < count($timeTables); $i++) {
                DB::table('time_level_tables')->where('id', $timeTables[$i]->id)->update(['status' => TimeLevelStatus::EXPIRED]);
                DB::table('permission_user')->where('id', $timeTables[$i]->permission_user_id)->update(['status' => PermissionUserStatus::EXPIRED]);
            }
        }
    }
}
