<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Task;

class CheckTaskOwner
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    /** @var App\Models\User */
    $user = auth()->user();

    $task = $request->route('task');

    if (!$task || $task->user_id !== $user->id) {
      return response()->json(['error' => 'Forbidden'], 403);
    }

    return $next($request);
  }
}
