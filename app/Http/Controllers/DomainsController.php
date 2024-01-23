<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain;
use Exception;

class DomainsController extends Controller
{
    public function index()
    {
        if(!checkPersonPermission('view-domain-3-0'))
            return ErrorMessage(403);

        $data = Domain::getAlldomains();

        $total_count = count($data);

        return view('domains.index', compact('data','total_count'));
    }

    public function add(Request $request){

        if(!checkPersonPermission('add-domain-3-0'))
            return ErrorMessage(403);


        $v = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'digits:11|numeric|nullable',
            'latitude' => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'domain_avatar' => ['nullable', 'mimes:png,jpg,jpeg,gif']
            ],[
            'name.required'=>'Please provide Domain Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Domain::where('name', '=', $request->name)->exists()) {
                $errors = "Domain name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
            }

            //try catch starts here
            try{

            $domain = new Domain();
            $domain->name = $request->name;
            $domain->address = $request->address;
            $domain->phone = $request->phone;
            $domain->latitude = $request->latitude;
            $domain->longitude = $request->longitude;
            $domain->status = $request->status;
            $domain->created_by = Auth::user()->id;

            if ($request->has('domain_avatar')) {
                $domain->updateDomainPic();
            }

            $domain->save();

            $message = "Domain Added Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

             }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
            //Try catch ends here
    }

    public function edit($id){
        if(!checkPersonPermission('update-domain-3-0'))
            return ErrorMessage(403);

        try{

                $domain = Domain::find($id);
                $returnHTML = view('domains.ajax.update_domain', compact('domain'))->render();

                return response()->json([
                    'status' => 200,
                    'html' => $returnHTML
                    ]);

               } catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }


    public function update(Request $request){
        if(!checkPersonPermission('update-domain-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'digits:11|numeric|nullable',
            'latitude' => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'domain_avatar' => ['nullable', 'mimes:png,jpg,jpeg,gif']
            ],[
            'name.required'=>'Please provide Domain Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

           /* if (Domain::where('name', '=', $request->name)->exists()) {
                $errors = "Domain name Already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
            } */

                   //try catch starts here
                   try{

                    $domain = Domain::find($request->domain_id);
                    $domain->name = $request->name;
                    $domain->address = $request->address;
                    $domain->phone = $request->phone;
                    $domain->latitude = $request->latitude;
                    $domain->longitude = $request->longitude;
                    $domain->status = $request->status;
                    $domain->created_by = Auth::user()->id;

                    if ($request->has('domain_avatar')){
                        $domain->updateDomainPic();
                    }

                    $domain->update();

                    $message = "Domain Updated Successfully";
                    return response()->json(['status' => 200,'message' => $message ]);

                     }catch(Exception $e)  {
                        $message =  $e->getMessage();
                        return response()->json([
                            'status' => 400,
                            'message' => $message
                        ]);
                    }
                    //Try catch ends here
    }

    public function destroy($id) {
        if(!checkPersonPermission('delete-domain-3-0'))
            return ErrorMessage(403);

        try{

            $domain = Domain::find($id);
            $domain->deleted_by = Auth::user()->id;
            $domain->delete();

            $message = "Domain Deleted Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }
}
