<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = explode(' ', strtoupper($request->input('data')));
        $age = $this->extractAge($data);
        $nameAndCity = $this->extractNameAndCity($data, $age);

        $user = new User();
        $user->name = $nameAndCity['name'];
        $user->age = $age;
        $user->city = $nameAndCity['city'];
        $user->save();

        Session::flash('message', 'Data berhasil disimpan');

        return redirect()->back();
    }

    private function extractAge(&$data)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($value)) {
                return $value;
            }
        }
        return null;
    }

    private function extractNameAndCity($data, $age)
    {
        $nameAndCity = [];
        $nameAndCity['age'] = $age;

        $ageIndex = array_search($age, $data);
        $cityData = array_slice($data, $ageIndex + 1);

        $filteredCityData = array_filter($cityData, function ($word) {
            $invalidAgeIndicators = ['TH', 'TAHUN', 'THN'];
            return !in_array(strtoupper($word), $invalidAgeIndicators);
        });

        $city = implode(' ', $filteredCityData);
        $nameAndCity['city'] = $city;

        $nameData = array_slice($data, 0, $ageIndex);
        $name = implode(' ', $nameData);
        $nameAndCity['name'] = $name;

        return $nameAndCity;
    }
}
