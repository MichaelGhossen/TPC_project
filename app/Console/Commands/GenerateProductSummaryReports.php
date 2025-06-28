<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\ProductSummaryReportController;
use Carbon\Carbon;

class GenerateProductSummaryReports extends Command
{
    protected $signature = 'reports:generate-product-summary {--type=daily}';
    protected $description = 'Generate product summary reports for each product (daily, monthly, yearly)';

    public function handle()
    {
        $type = $this->option('type');
        $now = now();

        $processDate = match ($type) {
            'daily' => $now->copy()->subDay(),
            'monthly' => $now->copy()->subMonth(),
            'yearly' => $now->copy()->subYear(),
        };

        // Use the controller to run the logic
        $controller = new ProductSummaryReportController();
        $controller->generateSummaryReportForPeriod($type, $processDate);

        $this->info("{$type} product summary reports generated for {$processDate->toDateString()}");
    }
}
