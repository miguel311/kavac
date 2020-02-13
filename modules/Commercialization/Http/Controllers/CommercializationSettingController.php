<?php

namespace Modules\Commercialization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Commercialization\Models\CommercializationMoney;
use Modules\Commercialization\Models\CommercializationSetting;





class CommercializationSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

	    	$com_smoney = CommercializationMoney::all();
	    	$com_senttings = CommercializationSetting::all();




        //$codeSettings = CodeSetting::where('module', 'budget')->get();

        	//$cCode = $codeSettings->where('table', 'commercialization_settings')->first();




	        return view('commercialization::settings', compact('com_smoney', 'com_senttings'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }
}






//        if($request->ajax()){
  //          $plan = PersonIntegrityPlan::get();
    //        return $plan;

        //}else{
        //    $integrities = HealthIntegrity::get();
         //   return view('cotizador.cotizadorsaludindex', compact('integrities'));
        //}



