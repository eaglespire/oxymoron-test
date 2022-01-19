<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanCollection;
use App\Http\Resources\LoanResource;
use App\Http\Resources\UserCollection;
use App\Models\Loan;
use App\Rules\CheckGuarantorName;
use App\Rules\LoanAmount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        try {
            return (new LoanCollection(Loan::paginate(10)));
        } catch (QueryException $exception){
            return response(['message'=>'Ooops!!!, something went wrong'], 400);
        }
    }

    public function store(Request  $request)
    {
        /*
         * Validate the request before proceeding further
         */
        $fields = $this->validate_request($request);
        //return $request;
        try {
            /*
         *  Save the loan in the loans table
         */
            $loan = Loan::create($fields);
            return (new LoanResource(Loan::find($loan->id)))->additional(['meta'=>['success'=>'loan applied successfully', 'status'=> 200]]);
        }catch (ModelNotFoundException $exception){
            return response(['message'=>'could not apply for loan, try again later'], 422);
        }
    }
    public function validate_request(Request $request): array
    {
       return $request->validate([
           'firstname'=>'required|string',
           'lastname'=>'required|string',
           'age'=>'required|integer|min:18|max:65',
           'loan_amount'=>'required|numeric',
           'monthly_salary'=>['required', 'numeric', new LoanAmount('loan_amount')] ,
           'payback_period'=>'required|integer' ,
           'next_of_kin_name'=>'required|string|max:255',
           'guarantor_name'=>['required','string','max:255', new
           CheckGuarantorName('next_of_kin_name')]
       ]);
    }
    /*
     * View a single loan application
     */
    public function show(int $id)
    {
        try {
            return (new LoanResource(Loan::findOrFail($id)));
        } catch (ModelNotFoundException $exception){
            return response(['message'=>'data not found'], 404);
        }
    }
}
