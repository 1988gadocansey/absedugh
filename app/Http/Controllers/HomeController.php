<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Http\Response;
use App\Models\MessagesModel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\User;
use App\Models\StudentChart;


class HomeController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('auth');
        ini_set('max_execution_time', 180000);  
       
        $user=@\Auth::user()->id;
        $date=new \Datetime();
        @User::where("id", $user)->update(array("last_login"=>$date));
      
        
    }
    public function chartjs()
    {
        $viewer = User::select(\DB::raw("SUM(id) as count"))
            ->orderBy("created_at")
            ->groupBy(\DB::raw("year(created_at)"))
            ->get()->toArray();
        $viewer = array_column($viewer, 'count');

        $click = User::select(\DB::raw("SUM(id) as count"))
            ->orderBy("created_at")
            ->groupBy(\DB::raw("year(created_at)"))
            ->get()->toArray();
        $click = array_column($click, 'count');


        return view('graphs.try')
            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))
            ->with('click',json_encode($click,JSON_NUMERIC_CHECK));
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */


    public function population($level)
    {
         if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $levelName =Models\StudentModel::where('LEVEL', $level)->where('STATUS', "In school")->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();

             return $levelName;
        }
        else{

        $levelName = Models\StudentModel::where('LEVEL', $level)->where('STATUS', "In school")->count();

        return $levelName;
    }
    }


    public function classDoeNut($grad, $level, $CGPALow, $CGPAHigh)
    {
         if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $classDoughNut =Models\StudentModel::where('GRADUATING_GROUP',$grad)->where('LEVEL',$level)->where('CGPA','>',$CGPALow)->where('CGPA','<=',$CGPAHigh)->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();

             return $classDoughNut;
        }
        else{

        $classDoughNut = @Models\StudentModel::query()->where('GRADUATING_GROUP',$grad)->where('LEVEL',$level)->where('CGPA','>',$CGPALow)->where('CGPA','<=',$CGPAHigh)->count();

        return $classDoughNut;
    }
    }



    public function index(Request $request,SystemController $sys)
    {   if(@\Auth::user()->department=="Admissions"){
            //$sys->getZenith();
            return redirect("applicants/view");
         }

         if((@\Auth::user()->password=='$2y$10$O1CDHaNMOUhhipT9ftmpyew2IXwIdxBNvUPzJCSDh1V2VS0KlPgx6') && (@\Auth::user()->phone=="")){
            //$sys->getZenith();
            return view("users.updateProfile");
         }

         // if(@\Auth::user()->password=='$2y$10$O1CDHaNMOUhhipT9ftmpyew2IXwIdxBNvUPzJCSDh1V2VS0KlPgx6'){
         //    //$sys->getZenith();
         //    header('Location: http://www.srms.ttuportal.com/password/reset');
                    
         // }

        if(@\Auth::user()->phone==""){
            return view("users.updateProfile");
        }
        else{
           
            //ini_set('max_execution_time', 50000);
         // $sys->getZenith();
           // $sys->generateIndexNumbers();
           /* $dataGenerator=Models\StudentModel::where("LEVEL","100H")->orWhere("LEVEL","100NTT")
                ->orWhere("LEVEL","100BTT")->orWhere("LEVEL","500")->get();
            foreach($dataGenerator as $row){
                $index=$sys->assignIndex($row->PROGRAMMECODE);
                Models\StudentModel::where("STNO",$row->STNO)->update(array("INDEXNO"=>$index));
                Models\PortalPasswordModel::where("username",$row->STNO)->update(array("username"=>$index));
            }*/

 


        $lastVisit=\Carbon\Carbon::createFromTimeStamp(strtotime(@\Auth::user()->last_login))->diffForHumans();

        $academicDetails=$sys->getSemYear();
        $sem=$academicDetails[0]->SEMESTER;
        $year=$academicDetails[0]->YEAR;
        $grad = $academicDetails[0]->GRAD;
        $grad1 = explode('/',$grad);
        $gradBegin = $grad1[0];
        $year1 = explode('/',$year);
        $yearBegin = $year1[0];
        //$resultsem = $currentResultsArray1[1];

        if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $studentDetail =Models\StudentModel::where('STATUS','In school')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->sum("BILL_OWING") ;
        }
        else{

        $studentDetail=Models\StudentModel::query()->where('STATUS','In school')->sum("BILL_OWING");
    }


        if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $total =Models\StudentModel::where('STATUS','In school')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count("ID");
        }
        else{

        $total=@Models\StudentModel::query()->where('STATUS','In school')->count("ID");
    }


    if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $totalRegistered =Models\StudentModel::where('REGISTERED','1')->where('STATUS','In school')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();
        }
        else{

        $totalRegistered =Models\StudentModel::query()->where('REGISTERED','1')->where('STATUS','In school')
                     ->count();
    }


        

        
                      
              // $totalRegistered =count($totalRegistered );

               /*
                Gad--- i added the academic year and sem to reduce query weight
               */
       $registered= @Models\AcademicRecordsModel::query()->where('lecturer',@\Auth::user()->fund)
       ->where('sem',$sem)->where('year',$year)
       ->count("id");

        $totalOwing=@$sys->formatMoney($studentDetail);
        //Payment details
        $totalPaid=Models\FeePaymentModel::query()->where('YEAR',$year)->where('FEE_TYPE','School Fees')->sum("AMOUNT");

        $paid=@$sys->formatMoney($totalPaid);
 
        // statistics
         $totalProgram=@Models\StudentModel::query()->where('SYSUPDATE','1')->groupBy("LEVEL")->get();

$stClass= $this->classDoeNut($grad, '300H', 3.994, 5.000);

$ndClassU= $this->classDoeNut($grad, '300H', 2.994, 3.994);

$ndClassL= $this->classDoeNut($grad, '300H', 1.994, 2.994);

$pass= $this->classDoeNut($grad, '300H', 1.494, 1.994);

$fail= $this->classDoeNut($grad, '300H', -1.000, 1.494);


$prgramClass=[];
$prgram1stClass=[];
$prgram2ndUClass=[];
$prgram2ndLClass=[];
$prgramPassClass=[];
$prgramFailClass=[];


$newI = $gradBegin;
$programCount =\DB::table('tpoly_students')->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', "LIKE", "" ."H". "%")->distinct('PROGRAMMECODE')->count('PROGRAMMECODE');

for($programCount1= 0; $programCount1 < $programCount; $programCount1++){
    
         }
//$prgramClas=@Models\StudentModel::query()->where('GRADUATING_GROUP', "LIKE", "" .$newI. "%")->where('PROGRAMMECODE', "LIKE", "" ."H". "%")->distinct('PROGRAMMECODE')->select('PROGRAMMECODE')->get();
    $prgramClas=@Models\ProgrammeModel::join('tpoly_students', 'tpoly_programme.PROGRAMMECODE', '=', 'tpoly_students.PROGRAMMECODE')->where("tpoly_programme.TYPE","HND")->where('tpoly_students.GRADUATING_GROUP', $grad)->distinct('tpoly_students.PROGRAMMECODE')->select('tpoly_programme.PROGRAMMECODE', 'tpoly_programme.PROGRAMME')->get();
             foreach ($prgramClas as $key => $value) {
              array_push($prgramClass, $value['PROGRAMME']);
//dd($prgramClass);
              $prgramClasTotal = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->count();

              $prgram1stClas = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->where('CGPA','>',3.994)->count();
              $prgram1stClassTotal = round(($prgram1stClas/$prgramClasTotal)*100,2);
                array_push($prgram1stClass, $prgram1stClassTotal);

                //dd($prgram1stClas, $prgramClasTotal, $prgram1stClassTotal, $value['PROGRAMMECODE']);

             $prgram2ndUClas = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->where('CGPA','>',2.994)->where('CGPA','<=',3.994)->count();
             $prgram2ndUClassTotal = round(($prgram2ndUClas/$prgramClasTotal)*100,2);
                array_push($prgram2ndUClass, $prgram2ndUClassTotal);

             $prgram2ndLClas = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->where('CGPA','>',1.994)->where('CGPA','<=',2.994)->count();
             $prgram2ndLClassTotal = round(($prgram2ndLClas/$prgramClasTotal)*100,2);
                array_push($prgram2ndLClass, $prgram2ndLClassTotal);

             $prgramPassClas = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->where('CGPA','>',1.494)->where('CGPA','<=',1.994)->count();
             $prgramPassClassTotal = round(($prgramPassClas/$prgramClasTotal)*100,2);
                array_push($prgramPassClass, $prgramPassClassTotal);

             $prgramFailClas = @Models\StudentModel::query()->where('GRADUATING_GROUP', $grad)->where('PROGRAMMECODE', $value['PROGRAMMECODE'])->where('CGPA','<=',1.494)->count();
             $prgramFailClassTotal = round(($prgramFailClas/$prgramClasTotal)*100,2);
                array_push($prgramFailClass, $prgramFailClassTotal);

          }
             //array_push($prgramClass, $prgramClas);
//dd($prgramClass);

$eachYearTotal=[];
         $years = [];
         $totalYearTotal = [];
         $totalMalePerYear = [];
         $totalFemalePerYear = [];

         $yearData = [];
         // $data = Student::all('INDEXNO');
         // foreach ($data as $key => $value) {
         //     echo $value['STNO']."<br>";
         // }
         // for($stdData =2014; $stdData<=date('Y'); $stdData++){
         //    echo ($data[$stdData])."<br>";
         // }
         //$newI = 2017;

         if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $MaleFresh1 =Models\StudentModel::where('SEX', 'Male')
                 ->where('STNO', "LIKE", "" .$yearBegin. "%")
                 ->where('STATUS', 'In school')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();
        }
        else{

         $MaleFresh1 = @Models\StudentChart::where('SEX', 'Male')
                 ->where('STNO', "LIKE", "" .$yearBegin. "%")
                 ->where('STATUS', 'In school')
                 ->count();

             }
             //array_push($totalMalePerYear, $Male);

             if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $FemaleFresh1 =Models\StudentModel::where('SEX', 'Female')
                 ->where('STNO', "LIKE", "" .$yearBegin. "%")
                 ->where('STATUS', 'In school')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();
        }
        else{

             $FemaleFresh1 = @Models\StudentChart::where('SEX', 'Female')
                 ->where('STNO', "LIKE", $yearBegin. "%")
                 ->where('STATUS', 'In school')
                 ->count();

             }

             $MaleFresh = @($MaleFresh1 / ($MaleFresh1 + $FemaleFresh1))*100;
              $FemaleFresh = @round(($FemaleFresh1 / ($MaleFresh1 + $FemaleFresh1))*100,2);

              if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $MaleFinal1 =Models\StudentModel::where('SEX', 'Male')
                 ->where('GRADUATING_GROUP', $grad)->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();
        }
        else{
              $MaleFinal1 = @Models\StudentChart::where('SEX', 'Male')
                 ->where('GRADUATING_GROUP', $grad)
                 //->where('STATUS','Alumni')
                 ->count();
             }
             //array_push($totalMalePerYear, $Male);
             if (@\Auth::user()->role=="Support") {
            $departmentArray=explode(",",@\Auth::user()->department);
            $FemaleFinal1 =Models\StudentModel::where('SEX', 'Female')
                 ->where('GRADUATING_GROUP', $grad)->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            })->count();
        }
        else{
             $FemaleFinal1 = @Models\StudentChart::where('SEX', 'Female')
                 ->where('GRADUATING_GROUP', $grad)
                 //->where('STATUS','Alumni')
                 ->count();
             }

             $MaleFinal = @($MaleFinal1 / ($MaleFinal1 + $FemaleFinal1))*100;
              $FemaleFinal = @round(($FemaleFinal1 / ($MaleFinal1 + $FemaleFinal1))*100,2);
             //array_push($totalFemalePerYear, $Female);
              //dd($FemaleFinal);
         for($i= $newI; $i <= $newI +4; $i++){
             array_push($years,$i);
$iPlusOne = $i + 1;
             $yrgp = $i.'/'.$iPlusOne;
             // substr($i, 0,2);
            // ".$var."
             

             

             $Male = @Models\StudentChart::where('SEX', 'Male')
                 ->where('GRADUATING_GROUP', "LIKE", "" .$i. "%")->count();
             array_push($totalMalePerYear, $Male);

             $Female = @Models\StudentChart::where('SEX', 'Female')
                 ->where('GRADUATING_GROUP', "LIKE", $i. "%")->count();
             array_push($totalFemalePerYear, $Female);

             array_push($yearData, $yrgp);

             $eachYearTotal = $Male + $Female;
             array_push($totalYearTotal, $eachYearTotal);

         }

//dd($totalFemalePerYear);
         //$TotalStudent = Student::whereBetween('yearAdmitted', [$years[0], $years[count($years )-1]])->count();

    //         if (@\Auth::user()->role=="Support") {
    //         $departmentArray=explode(",",@\Auth::user()->department);
    //         $nt100 =Models\StudentModel::where('LEVEL', '100NT')->where('STATUS', "In school")->whereHas('programme', function($q)use($departmentArray) {
    //             $q->whereHas('departments', function($q)use($departmentArray) {
    //                 $q->whereIn('DEPTCODE',  $departmentArray);
    //             });
    //         })->count();
    //     }
    //     else{

    //     $nt100 = Models\StudentModel::where('LEVEL', '100NT')->where('STATUS', "In school")->count();
    // }

            $nt100=$this->population('100NT');               
            $nt200=$this->population('200NT');
            $hnd100=$this->population('100H');
            $hnd200=$this->population('200H');
            $hnd300=$this->population('300H');
            $btt100=$this->population('100BTT');
            $btt200=$this->population('200BTT');
            $bt100=$this->population('100BT');
            $bt200=$this->population('200BT');
            $bt300=$this->population('300BT');
            $bt400=$this->population('400BT');
            $mt100=$this->population('500MT');
            $mt200=$this->population('600MT');
              //$nt200 = @Models\StudentChart::where('LEVEL', '200NT')->where('STATUS', "In school")->count();

         
                 
                 //$admitPreviousHnd =  @Models\StudentChart::where('LEVEL', '200H')->where('STATUS', "In school")->count();
            $admitPreviousHnd = $hnd200;
            $admitPreviousBtt = $btt200;
            $admitPreviousNt = $nt200;
            $admitPreviousBt = $bt200;
            $admitPreviousMt = $mt200;
            $admitCurrentHnd =  $hnd100;
            $admitCurrentBtt = $btt100;
            $admitCurrentNt =  $nt100;
            $admitCurrentBt = $bt100;
            $admitCurrentMt =  $mt100;

                 $previousTotal = $admitPreviousMt + $admitPreviousNt + $admitPreviousHnd + $admitPreviousBt + $admitPreviousBtt;
                 $currentTotal = $admitCurrentMt + $admitCurrentNt + $admitCurrentHnd + $admitCurrentBt + $admitCurrentBtt; 




        return view('dashboard')->with('paid', $paid)
                                ->with('owing', $totalOwing)
                                  ->with('register', $registered)
                                  ->with('total', $total)
                                  ->with('totalRegistered', $totalRegistered)
                                  ->with('data', $totalProgram)
                                ->with('sem', $sem)
                                ->with('year', $year)
                                ->with('lastVisit', $lastVisit)
                                ->with('totalYearTotal', $totalYearTotal)
                                ->with('totalMalePerYear', $totalMalePerYear)
                                ->with('totalFemalePerYear', $totalFemalePerYear)
                                ->with('yearData', $yearData)
                                ->with('stClass', $stClass)
                                ->with('ndClassU', $ndClassU)
                                ->with('ndClassL', $ndClassL)
                                ->with('pass', $pass)
                                ->with('fail', $fail)
                                ->with('nt100', $nt100)
                                ->with('nt200', $nt200)
                                ->with('hnd100', $hnd100)
                                ->with('hnd200', $hnd200)
                                ->with('hnd300', $hnd300)
                                ->with('btt100', $btt100)
                                ->with('btt200', $btt200)
                                ->with('bt100', $bt100)
                                ->with('bt200', $bt200)
                                ->with('bt300', $bt300)
                                ->with('bt400', $bt400)
                                 ->with('mt100', $mt100)
                                ->with('mt200', $mt200)
                                ->with('admitPreviousHnd',$admitPreviousHnd)
                                ->with('admitPreviousBtt',$admitPreviousBtt)
                                ->with('admitPreviousBt',$admitPreviousBt)
                                ->with('admitPreviousNt',$admitPreviousNt)
                                ->with('admitPreviousMt',$admitPreviousMt)
                                ->with('admitCurrentHnd',$admitCurrentHnd)
                                ->with('admitCurrentBtt',$admitCurrentBtt)
                                ->with('admitCurrentBt',$admitCurrentBt)
                                ->with('admitCurrentNt',$admitCurrentNt)
                                ->with('admitCurrentMt',$admitCurrentMt)
                                ->with('currentTotal',$currentTotal)
                                ->with('previousTotal',$previousTotal) 
                                ->with('prgramClass',$prgramClass)
                                ->with('prgram1stClass',$prgram1stClass)
                                ->with('prgram2ndUClass',$prgram2ndUClass)                             
                                ->with('prgram2ndLClass',$prgram2ndLClass)
                                ->with('prgramPassClass',$prgramPassClass)
                                ->with('prgramFailClass',$prgramFailClass)
                                ->with('MaleFresh',$MaleFresh)
                                ->with('FemaleFresh',$FemaleFresh)
                                ->with('MaleFinal',$MaleFinal)
                                ->with('FemaleFinal',$FemaleFinal)
                                ->with('MaleFresh1',$MaleFresh1)
                                ->with('FemaleFresh1',$FemaleFresh1)
                                ->with('MaleFinal1',$MaleFinal1)
                                ->with('FemaleFinal1',$FemaleFinal1)
                                ;



        }

    }
    public function accountStatement(Request $request, SystemController $sys) {
        $student=@\Auth::user()->username;


        $academicDetails=$sys->getSemYear();
        $sem=$academicDetails[0]->SEMESTER;
        $year=$academicDetails[0]->YEAR;

        $studentDetail=Models\StudentModel::query()->where('STATUS','In school')->where('INDEXNO',$student)->first();


        $outstandingBill=@$sys->formatMoney($studentDetail->BILL_OWING);
        $SemesterBill=@$sys->formatMoney($studentDetail->BILLS);
          //Payment details
        $paymentDetail=  Models\FeePaymentModel::query()->where('INDEXNO',$student)->orderBy('LEVEL','DESC')->orderBy('YEAR','DESC')->paginate(100);
        return view("students.account_statement")->with("transaction", $paymentDetail)
                ->with('balance', $outstandingBill)
                ->with('semesterBill', $paymentDetail);
    }
    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function buildChart(Request $request)
    {
         $viewer = User::select(\DB::raw("SUM(id) as count"))
        ->orderBy("created_at")
        ->groupBy(\DB::raw("year(created_at)"))
        ->get()->toArray();
    $viewer = array_column($viewer, 'count');

    $click = User::select(\DB::raw("SUM(id) as count"))
        ->orderBy("created_at")
        ->groupBy(\DB::raw("year(created_at)"))
        ->get()->toArray();
    $click = array_column($click, 'count');

    return view('graph')
            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))
            ->with('click',json_encode($click,JSON_NUMERIC_CHECK));
    }
    public function getLaraChart()
    {
        $lava = new Lavacharts; // See note below for Laravel

        $popularity = $lava->DataTable();
        $data = \App\Models\CountryUser::select("name as 0","total_users as 1")->get()->toArray();

        $popularity->addStringColumn('Country')
                   ->addNumberColumn('Popularity')
                   ->addRows($data);

        $lava->GeoChart('Popularity', $popularity);

        return view('graph',compact('lava'));
    }
    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
