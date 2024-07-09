<?php

namespace  App\Repository\Doctors;

use App\Models\Doctor;
use App\Models\Section;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;

class DoctorRepository implements DoctorRepositoryInterface
{

    use ImageUploadTrait;

    public function index()
    {
        // $doctors = Doctor::all();
        $doctors = Doctor::with('DoctorAppointment')->get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add', compact('sections', 'appointments'));
    }

    public function store($request)
    {

        DB::beginTransaction();

        try {
            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            $doctors->save();

            // store trans
            $doctors->name = $request->name;
            $doctors->save();

            //store in pivot table
            $doctors->DoctorAppointment()->attach($request->appointments);

            //store Image
            $this->VerifyAndStoreImage($request, 'photo', 'Doctors', 'UploadImageDisk', $doctors->id, 'App\Models\Doctor');




            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if ($request->page_id == 1) {
            if ($request->filename) {
                $this->Delete_Attachment('UploadImageDisk', 'Doctors', $request->filename, $request->id);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        } else {

            // delete selector doctor
            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_doctors) {
                $doctor = Doctor::findorfail($ids_doctors);
                if ($doctor->image) {
                    $this->Delete_Attachment('UploadImageDisk', 'Doctors' , $doctor->image->filename, $ids_doctors);
                }
            }

            Doctor::destroy($delete_select_id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }
    }

    public function edit($id)  {
        $doctor = Doctor::findorFail($id) ;
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.edit', compact('sections', 'appointments' , 'doctor'));
    }

    public function update($request)
    {

        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->status = 1;
            $doctor->save();

            // update trans
            $doctor->name = $request->name;
            $doctor->save();

            //update Appointment
            $doctor->DoctorAppointment()->sync($request->appointments);

            //delete old image
            if($request->hasfile('photo')){
                if($doctor->image){
                    $this->Delete_Attachment('UploadImageDisk', 'Doctors', $request->filename, $request->id);
                }
            }

            //store Image

            $this->VerifyAndStoreImage($request, 'photo', 'Doctors', 'UploadImageDisk', $doctor->id, 'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.edit');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_password($request)  {
        try{
            $doctor = Doctor::findorFail($request->id) ;
            $doctor->update([
                'password'=>Hash::make($request->password),
            ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function update_status($request)  {
        try{
            $doctor = Doctor::findorFail($request->id) ;
            $doctor->update([
                'Status'=>$request->Status,
            ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
}



}
