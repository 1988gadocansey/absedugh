<?php
/**
 * Created by PhpStorm.
 * User: gadoo
 * Date: 18/06/2019
 * Time: 3:44 PM
 */


namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models;
use App\User;
use App\Models\AcademicRecordsModel;
use PhpParser\Node\Expr\AssignOp\Mod;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Excel;

class UploadController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //set_time_limit(36000);
        ini_set('max_input_vars', '90000');
        ini_set('max_execution_time', 180000);
        $this->middleware('auth');


    }

    public function uploadStudentData(SystemController $sys, Request $request)
    {


        return view('students.uploadData');


    }

    public function processStudentUpload(Request $request, SystemController $sys)
    {

        set_time_limit(36000);

        $valid_exts = array('csv', 'xls', 'xlsx'); // valid extensions
        $file = $request->file('file');
        $name = time() . '-' . $file->getClientOriginalName();


        $ext = strtolower($file->getClientOriginalExtension());

        if (in_array($ext, $valid_exts)) {
            // Moves file to folder on server
            // $file->move($destination, $name);

            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {

            })->get();
            $total = count($data);


            $user = \Auth::user()->id;
            foreach ($data as $value => $row) {
                $indexno = $row->index;
                $bill = $row->bill;
                $paid = $row->paid;
                $owing = $row->owing;
                $plan = $row->pmt_plan;
                $cohort = $row->cohort;


                Models\StudentModel::where('INDEXNO', $indexno)->update(array("PMT_PLAN" => $plan, "COHORT" => $cohort, "BILLS" => $bill, "PAID" => $paid, "BILL_OWING" => $owing));

                $fees=new Models\FeePaymentModel();

                $fees->INDEXNO=$indexno;
                $fees->AMOUNT=$paid;
                $fees->SEMESTER=1;
                $fees->YEAR="2018/2019";
                $fees->INDEXNO=$indexno;
                $fees->PAYMENTDETAILS="Balance b/d";

                $fees->save();


            }


            return "success";

        }

    }

}