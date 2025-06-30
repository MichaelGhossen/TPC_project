<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * GET /api/activity-logs
     * List & filter activity logs with formatted changes.
     */
    public function index(Request $request)
    {
        $query = Activity::with(['causer', 'subject']);

        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->integer('user_id'));
        }

        if ($request->filled('model')) {
            $modelClass = 'App\\Models\\' . ucfirst(strtolower($request->string('model')));
            $query->where('subject_type', $modelClass);
        }

        if ($request->filled('event')) {
            $query->where('event', 'like', '%' . $request->string('event')->escape() . '%');
        }

        if ($request->filled('date_from')) {
            $from = Carbon::parse($request->string('date_from'))->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->filled('date_to')) {
            $to = Carbon::parse($request->string('date_to'))->endOfDay();
            $query->where('created_at', '<=', $to);
        }

        $formatted = $query
            ->orderByDesc('created_at')
            ->get()
            ->map(fn(Activity $log) => $this->formatLog($log));

        return response()->json([
            'status' => 200,
            'data' => $formatted,
        ]);
    }

    /**
     * GET /api/activity-logs/{id}
     * Show a single log entry with formatted changes.
     */
    public function show(int $id)
    {
        $log = Activity::with(['causer', 'subject'])->find($id);

        if (!$log) {
            return response()->json([
                'status' => 404,
                'message' => 'Activity log not found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->formatLog($log),
        ]);
    }

    /**
     * GET /api/{model}/{id}/activity-logs
     * List logs for a given model instance, formatted.
     */
    public function forSubject(string $model, int $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst(strtolower($model));

        $logs = Activity::with('causer')
            ->where('subject_type', $modelClass)
            ->where('subject_id', $id)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn(Activity $log) => $this->formatLog($log));

        return response()->json([
            'status' => 200,
            'data' => $logs,
        ]);
    }

    /**
     * Helper to format a single Activity instance.
     */
    protected function formatLog(Activity $log): array
    {
        return [
            'id' => $log->id,
            'event' => $log->description,
            'model' => class_basename($log->subject_type),
            'model_id' => $log->subject_id,
            'causer_id' => $log->causer_id,
            'causer_name' => optional($log->causer)->name,
            'date' => $log->created_at->toDateTimeString(),
            'changes' => [
                'old' => $log->properties['old'] ?? [],
                'new' => $log->properties['attributes'] ?? [],
            ],
        ];
    }
}
