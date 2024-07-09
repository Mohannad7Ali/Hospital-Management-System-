<?php

namespace  App\Repository\Services ;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;
use Symfony\Component\CssSelector\Node\FunctionNode;

class SingleServiceRepository implements SingleServiceRepositoryInterface {

    public function index(){
        $Services = Service::all() ;
        return view('Dashboard.Services.Single Service.index' , compact('Services')) ;
    }
    public function store($request){
        try{
            $service = new Service() ;

            $service->price = $request->price ;
            $service->description = $request->description ;
            $service->status = 1 ;
            $service->save();
            //store trans
            $service->name = $request->name ;
            $service->save() ;
            session()->flash('add');
            return redirect()->back() ;
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }

    }
    public function update($request){
        try{
            $service = Service::findorFail($request->id) ;

            $service->price = $request->price ;
            $service->description = $request->description ;
            $service->status = $request->status ;
            $service->save();
            //store trans
            $service->name = $request->name ;
            $service->save() ;
            session()->flash('edit');
            return redirect()->route('Service.index') ;
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }

    }
    public function destroy($request){
        Service::destroy($request->id);
        session()->flash('delete');
        return redirect()->back() ;
    }

}
