<?php

namespace App\Http\Controllers\Api;

use PackageVersions\Versions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([
            'release' => config('sentry.release'),
            'versions' => array_merge([
                'php' => phpversion(),
            ], collect([
                'laravel/framework', 'aws/aws-sdk-php', 'sentry/sdk',
            ])->keyBy(function (&$value) {
                $key = $value;
                $value = Versions::getVersion($key);

                return $key;
            })->all()),
            'request' => [
                'client_ip' => $request->getClientIp(),
                'host' => $request->getHost(),
                'port' => $request->getPort(),
            ],
        ]);
    }
}
