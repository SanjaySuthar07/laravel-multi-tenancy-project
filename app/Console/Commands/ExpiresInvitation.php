<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ExpiresInvitation extends Command
{
    protected $signature = 'expires:invitation';
    protected $description = 'Expires Invitation';

    public function handle()
    {
        $invitations = \App\Models\Invitation::where('status', 'pending')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($invitations as $invitation) {
            $invitation->update(['status' => 'expired']);
        }

        $this->info('Invitations expired successfully.');
    }
}