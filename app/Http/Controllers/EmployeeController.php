<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //membuat method menampilkan data seluruh karyawan
    public function index()
    {
        
        $employee = Employee::all();

        if ($employee->isEmpty()) {
            $data = [
                    'message' => 'Data is empty'
                ];
            return response()->json($data, 200);
        }

        $data = [
            'message' => 'Get all Resource',
            'data' => $employee
        ];

        return response()->json($data, 200);
    }

    //membuat method menambahkan data
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'email' => 'required|email',
            'status' => 'required',
            'hired_on'=> 'required',
        ]);

        $input = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on,
        ];

        $employee = employee::create($input);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $employee,
        ];

        return response()->json($data, 201);
    }

    //membuat method menampilkan data tertentu
    public function show($id)
    {
        $employee = employee::find($id);

        if ($employee) {
            $data = [
                'message' => 'Get detail resource',
                'data' => $employee,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 404);
        }
    }

    //membuat method mengupdate data

    public function update(Request $request, $id)
    {
        $employee = employee::find($id);


        if (!$employee) {
            $data = [
                    'message' => 'Resource not found',
                ];
            return response()->json($data, 404);
        }

        // Update employee data with the request input
        $input = [
            'name' => $request->name ?? $employee->name,
            'gender' => $request->gender ?? $employee->gender,
            'phone' => $request->phone ?? $employee->phone,
            'address' => $request->address ?? $employee->address,
            'email' => $request->email ?? $employee->email,
            'status' => $request->status ?? $employee->status,
            'hired_on' => $request->hired_on ?? $employee->hired_on,
        ];

        $employee->update($input);

        $data = [
            'message' => 'Resource is update successfully',
            'data' => $employee
        ];

        return response()->json($data, 200);
    }

    //membuat method menghapus data

    public function destroy($id)
    {
        $employee = employee::find($id);

        if (!$employee) {
            $data = [
                    'message' => 'employee not found',
                ];
            return response()->json($data,
                404
            );
        }

        $employee->delete();

        $data = [
                'message' => 'resource is delete successfully',
                'data' => $employee
            ];

        return response()->json($data, 200);
    }

    //membuat method untuk mencari dengan nama
    public function search($name)
    {
        // menjalankan perintah search menggunakan elloquent where dan get
        $employee = Employee::where('name', 'like', "%$name%")->get();

        if ($employee) {
            $data = [
                'message' => 'Get searched resource',
                'data' => $employee,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 404);
        }
    }

    //membuat method untuk mendapatkan resource active
    public function active()
    {
        // menjalankan perintah mencari data active menggunakan elloquent where dan get
        $ActiveEmployee = Employee::where('status', 'active')->get();

        $data = [
            'message' => 'Get active resource',
            'data' => $ActiveEmployee,
        ];

        return response()->json($data, 200);
    }

    //membuat method untuk mendapatkan data resource inactive
    public function inactive()
    {
        // menjalankan perintah mencari data inactive menggunakan elloquent where dan get
        $InactiveEmployee = Employee::where('status', 'inactive')->get();

        $data = [
            'message' => 'Get inactive resource',
            'data' => $InactiveEmployee,
        ];

        return response()->json($data, 200);
    }

    //membuat method untuk mendapatkan data resource inactive
    public function terminated()
    {
        // menjalankan perintah mencari data terminated menggunakan elloquent where dan get
        $TerminatedEmployee = Employee::where('status', 'terminated')->get();

        $data = [
            'message' => 'Get terminated resource',
            'data' => $TerminatedEmployee,
        ];

        return response()->json($data, 200);
    }

    
}
