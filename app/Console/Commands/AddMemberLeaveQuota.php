<?php

namespace App\Console\Commands;

use App\Models\LeaveQuotas;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddMemberLeaveQuota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddMemberLeaveQuota:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AddMemberLeaveQuota description';

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
        $member = Member::pluck('id')->toArray();
        return $this->createLeaveQuota($member);
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
}
