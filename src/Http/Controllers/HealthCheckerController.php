<?php

namespace Laravel\Health\Http\Controllers;

use Laravel\Health\Exceptions\CheckerNotFoundException;

class HealthCheckerController
{
    public function index()
    {
        try {
            $healthManager = \HealthChecker::eagerLoader(config('health-checker'))
                ->getHealthStatus();

            return response()->json([
                'status' => [
                    'code' => 200,
                    'message' => "OK"
                ],
                'health_status' => $healthManager
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => [
                    'code' => 500,
                    'message' => "Internal Server Error"
                ],
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function show(string $checker)
    {
        try {

            $healthManager = \HealthChecker::oneLoader(config('health-checker'), $checker)
                ->getHealthStatus();

            return response()->json([
                'status' => [
                    'code' => 200,
                    'message' => "Ok"
                ],
                'health_status' => $healthManager
            ]);
        } catch (CheckerNotFoundException $exception) {
            return response()->json([
                'status' => [
                    'code' => 400,
                    'message' => "Bad request"
                ],
                'error' => $exception->getMessage()
            ], 400);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => [
                    'code' => 500,
                    'message' => "Internal Server Error"
                ],
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
