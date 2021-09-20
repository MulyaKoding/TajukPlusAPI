<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Subdistricts;
use Validator;
use App\Http\Resources\Provinces as ProvinceResource;
use App\Http\Resources\Cities as CityResource;
use App\Http\Resources\Districts as DistrictResource;
use App\Http\Resources\Subdistricts as SubdistrictResource;

class PlaceController extends BaseController
{
    public function getProvinces() {
        $provinces = Provinces::all();
        return $this->sendResponse(ProvinceResource::collection($provinces), 'Provinces successfully retrieved.');
    }

    public function getCities($id) {
        if(!$id) {
            $cities = Cities::all();
            return $this->sendResponse(CityResource::collection($cities), 'Cities successfully retrieved.');
        } else {
            $cities = Cities::where('prov_id', $id)->get();
            if (is_null($cities)) {
                return $this->sendError('Cities not found.');
            }
            return $this->sendResponse(CityResource::collection($cities), 'Cities successfully retrieved.');
        }
    }


    
    public function getDistricts($id) {
        if(!$id){
            $districts = Districts:: all();
            return $this -> sendResponse(DistrictResource::collection($districts),'Districts succesfully retrieved.');
        }else{
        $districts = Districts::where('city_id', $id)->get();
        if (is_null($districts)) {
            return $this->sendError('Districts not found.');
        }
        return $this->sendResponse(DistrictResource::collection($districts), 'Districts successfully retrieved.');
    }
    }

    public function getSubdistricts($id) {
        $subdistricts = Subdistricts::where('dis_id', $id)->get();
        if (is_null($subdistricts)) {
            return $this->sendError('Subdistricts not found.');
        }
        return $this->sendResponse(SubdistrictResource::collection($subdistricts), 'Subdistricts successfully retrieved.');
    }
}
