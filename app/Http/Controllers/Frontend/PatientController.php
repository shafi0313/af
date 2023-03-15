<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\PatientStoreRequest;

class PatientController extends Controller
{
    public function store(Request $request, PatientStoreRequest $patient)
    {
        $data = $patient->validated();
        // $data['user_id'] = user()->id;

        if ($patient->hasFile('patient_img')) {
            $data['patient_img'] = imageStore($patient, 'patient_img', 'patient_img', 'patients/');
        }
        if ($patient->hasFile('nid')) {
            $data['nid'] = imageStore($patient, 'nid', 'nid', 'patients/');
        }
        if ($patient->hasFile('sonod')) {
            $data['sonod'] = imageStore($patient, 'sonod', 'sonod', 'patients/');
        }
        if ($patient->hasFile('prescription')) {
            $data['prescription'] = imageStore($patient, 'prescription', 'prescription', 'patients/');
        }
        $patientCreate = Patient::create($data);

        foreach ($patient->price as $key => $value) {
            $medicine = [
                'patient_id' => $patientCreate->id,
                'medicine'   => $patient->medicine[$key],
                'price'      => $patient->price[$key],
            ];
            Medicine::create($medicine);
        }

        try {
            // Patient::create($data);
            Alert::success('Success', 'Application Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->back();
        }
    }
}
