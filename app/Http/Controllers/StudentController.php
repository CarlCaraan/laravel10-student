<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Sibling;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PDF;

class StudentController extends Controller
{

    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function StudentAdd()
    {
        return view('add_student');
    }

    public function StudentStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'student_id' => 'required|unique:users',
            'address' => 'required',
            'dob' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        // User
        $user = new User();
        $user->email = $request->email;
        $user->student_id = $request->student_id;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->username = $request->username;
        // Hash the password before saving it
        $user->password = Hash::make($request->password);
        $user->save();

        // Siblings
        $count = count($request->sibling_name);
        if ($count != NULL) {
            for ($i = 0; $i < $count; $i++) {
                $sibling = new Sibling();
                $sibling->user_id = $user->id; // Associate sibling with the user
                $sibling->sibling_name = $request->sibling_name[$i];
                $sibling->save();
            } //End For loop
        } // End if


        return redirect()->route('dashboard');
    }

    public function StudentEdit($id)
    {
        $allData['user'] = User::find($id);
        $allData['sibling'] = Sibling::where('user_id', $id)->get();
        return view('edit_student', $allData);
    } // End Method

    public function StudentUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'student_id' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'username' => 'required',
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->student_id = $request->student_id;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->username = $request->username;
        $user->save();

        // Siblings
        // Delete Sibling
        $sibling = Sibling::where('user_id', $id)->delete();
        $count = count($request->sibling_name);
        if ($count != NULL) {
            for ($i = 0; $i < $count; $i++) {
                $sibling = new Sibling();
                $sibling->user_id = $user->id; // Associate sibling with the user
                $sibling->sibling_name = $request->sibling_name[$i];
                $sibling->save();
            } //End For loop
        } // End if


        return redirect()->back();
    } // End Method

    public function StudentDelete($id)
    {
        $data = User::find($id);
        $data->delete();

        $sibling = Sibling::where('user_id', $id)->delete();

        return redirect()->route('dashboard');
    }

    // Generate PDF
    public function GeneratePDF($id)
    {
        $data['user'] = User::find($id);
        $data['sibling'] = Sibling::where('user_id', $id)->get();
        $html = view('report_student', $data)->render();
        $pdf = PDF::loadHTML($html);

        return $pdf->download('students.pdf');
    }
}
