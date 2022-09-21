<?php

namespace App\Classes;

abstract class FailedJobReporter
{
    /**
     * The job failed to process.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    final public function failed(\Exception $exception): void
    {
        if (app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }
    }
}
