<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IncomingMail extends Controller
{
    protected array $acceptedAddresses = [];

    public function __construct()
    {
        $accepted = [
            'abuse',
            'alerts',
            'announce',
            'billing',
            'collections',
            'datacenter.managers',
            'emergency',
            'facilities.management',
            'hardware',
            'hr',
            'info',
            'internal',
            'management',
            'marketing',
            'networking',
            'sales',
            'security',
            'support',
            'vendor',
            'webmaster',
            // TODO:  finish list to be more expansive.
        ];

        foreach($accepted as $addressPrefix) {
            $this->acceptedAddresses[] = sprintf("%s@%s", $addressPrefix, env('APP_DOMAIN'));
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request)
    {
        $to = $request->input('envelope.to');
        Log::info($to);

        if ($to !== in_array($to, $this->acceptedAddresses)) {
            return response("To address not expected", 422)
                ->header('content-type', 'text/plain');
        }

        $file = $request->file('attachments')[0];

        Log::info($file);

        return "Thanks!";
    }
}
