<?php
namespace App\Http\Controllers;

use App\Services\WizardService;
use Illuminate\Http\Request;

class WizardController extends Controller
{
    protected $wizardService;

    public function __construct(WizardService $wizardService)
    {
        $this->wizardService = $wizardService;
    }

    public function step2(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->wizardService->handleStep2($request);
        }

        return view('wizard.step2');
    }

    public function confirm()
    {
        $data = $this->wizardService->confirm();
        return view('wizard.confirm', $data);
    }

    public function submit()
    {
        return $this->wizardService->completeRegistration();
    }
}
