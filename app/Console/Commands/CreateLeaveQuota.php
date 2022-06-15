<?php

namespace App\Console\Commands;

use App\Models\LeaveQuotas;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateLeaveQuota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateLeaveQuota:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CreateLeaveQuota description';

    protected $year;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->year = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->format('Y');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $member = Member::pluck('id')->toArray();

        $checkMonth = LeaveQuotas::where('year', 'like', $this->year);

        if ($checkMonth->exists()) {
            return $this->updateLeaveQuota($this->year);
        } else {
            return $this->createLeaveQuota($member);
        }
    }

    public function createLeaveQuota($member = [])
    {
        foreach ($member as $member_id) {
            $leaveQuota = new LeaveQuotas();
            $leaveQuota->member_id = $member_id;
            $leaveQuota->year = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->format('Y');
            $leaveQuota->quota = 1;
            $leaveQuota->remain = 1;

            $leaveQuota->save();
        }
    }

    public function updateLeaveQuota($year)
    {
        DB::statement("UPDATE leave_quotas 
        set quota = quota+1 ,
        remain = remain+1
        WHERE year = '$year'");
    }
}
