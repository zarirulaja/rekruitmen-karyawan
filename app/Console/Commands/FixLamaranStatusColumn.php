<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixLamaranStatusColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-lamaran-status-column';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix the lamaran status column to properly accept the "review" status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing lamaran status column...');

        try {
            // Change the status column from enum to varchar
            DB::statement('ALTER TABLE lamaran MODIFY status VARCHAR(20) NOT NULL DEFAULT "pending"');
            $this->info('Successfully changed status column type to VARCHAR(20)');

            // Update any existing records with invalid status values
            $updated = DB::update('UPDATE lamaran SET status = "pending" WHERE status NOT IN ("pending", "review", "wawancara", "diterima", "ditolak")');
            $this->info("Updated {$updated} records with invalid status values");

            $this->info('Lamaran status column fixed successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to fix lamaran status column: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
