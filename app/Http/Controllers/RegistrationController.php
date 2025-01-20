<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\SubEvent;
use App\Models\Player;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class RegistrationController extends Controller
{
    public function register($id)
    {
        $subEvent = SubEvent::findOrFail($id);
        return view('registrations.register', compact('subEvent'));
    }

    public function storeRegistration(Request $request, $subEventId)
    {
        $commonRules = [
            'captain_name' => 'required|string|max:255',
            'captain_nim' => 'required|string|max:50',
            'captain_phone' => 'required|string|max:20',
        ];

        $categorySpecificRules = [];
        $additionalData = [];

        switch ($request->category) {
            case 'ELVERO':
            case 'FIDOVERO':
                $categorySpecificRules = [
                    'class' => 'required|string|max:100',
                ];
                $additionalData['class'] = $request->class;
                break;

            case 'STOVERO':
                $categorySpecificRules = [
                    'class' => 'required|string|max:100',
                    'player_name' => 'required|array|min:1|max:11',
                    'player_name.*' => 'required|string|max:255',
                    'player_nim' => 'required|array|min:1|max:11',
                    'player_nim.*' => 'required|string|max:50',
                    'ktm' => 'required|file|mimes:jpg,png,pdf|max:2048',
                    'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
                ];
                $additionalData['class'] = $request->class;
                $additionalData['ktm'] = $request->file('ktm')->store('uploads/ktm');
                $additionalData['payment_proof'] = $request->file('payment_proof')->store('uploads/payments');
                break;

            case 'ACAVERO':
            case 'MUSCOVERO':
                $categorySpecificRules = [
                    'team_name' => 'required|string|max:255',
                    'player_name' => 'required|array|min:1|max:11',
                    'player_name.*' => 'required|string|max:255',
                    'player_nim' => 'required|array|min:1|max:11',
                    'player_nim.*' => 'required|string|max:50',
                    'ktm' => 'required|file|mimes:jpg,png,pdf|max:2048',
                    'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
                ];
                $additionalData['team_name'] = $request->team_name;
                $additionalData['ktm'] = $request->file('ktm')->store('uploads/ktm');
                $additionalData['payment_proof'] = $request->file('payment_proof')->store('uploads/payments');
                break;

            default:
                return back()->withErrors(['category' => 'Kategori tidak valid.']);
        }

        $rules = array_merge($commonRules, $categorySpecificRules);

        // Validasi data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $registration = new Registration();
        $registration->subevent_id = $subEventId;
        $registration->category = $request->category;
        $registration->captain_name = $request->captain_name;
        $registration->captain_nim = $request->captain_nim;
        $registration->captain_phone = $request->captain_phone;
        $registration->team_name = $request->team_name;
        $registration->class = $request->class;
        $registration->ktm = $additionalData['ktm'] ?? null;
        $registration->payment_proof = $additionalData['payment_proof'] ?? null;
        $registration->save();

        if (in_array($request->category, ['STOVERO', 'ACAVERO', 'MUSCOVERO'])) {
            $playersData = [];
            foreach ($request->player_name as $index => $playerName) {
                $playersData[] = [
                    'registration_id' => $registration->id,
                    'player_name' => $playerName,
                    'player_nim' => $request->player_nim[$index],
                ];
            }
            Player::insert($playersData);
        }

        if ($request->category === 'ELVERO' || $request->category === 'FIDOVERO') {
            return redirect()->route('subevents.index')->with('success', 'Registrasi berhasil disimpan.');
        } else {
            // For STOVERO, ACAVERO, MUSCOVERO, redirect to proof page
            return redirect()->route('registrations.proof', $registration->id)->with('success', 'Registrasi berhasil disimpan.');
        }
    }

    public function showProof($id) {
        $registration = Registration::with('players')->findOrFail($id);
        $data = [
            'registration' => $registration,
            'category' => $registration->category,
            'team_name' => $registration->team_name,
            'class_stovero' => $registration->class,
            'captain_name' => $registration->captain_name,
            'captain_nim' => $registration->captain_nim,
            'participants' => $registration->players,
        ];
        return view('registrations.proof', $data);
    }

}
