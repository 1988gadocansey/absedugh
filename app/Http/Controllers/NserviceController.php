<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models\ProgrammeModel;
use App\Models;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Excel;
class NserviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->generateAccounts();
//        $query=  \App\Models\StudentModel::where("LEVEL","!=","")->get();
//        foreach($query as $index=>$row){
//        $que=Models\PortalPasswordModel::where("username",$row->STNO)->first();  
//                  if(empty($que)){
//                   
//                   $real=strtoupper(str_random(9));
//                   
//                    Models\PortalPasswordModel::create([
//                    'username' => $row->STNO,
//                     'real_password' =>$real,
//                          'level' =>$row->LEVEL,
//                         'programme' =>$row->PROGRAMMECODE,
//                    'password' => bcrypt($real),
//                  ]);}
//        }
    }
    public function tpoly(Request $request) {
        ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
        $query=  \DB::table('table79')->get();
        foreach($query as $index=>$row){

            if($row->COL5){
                $gender="Male";
            }
            else{
                $gender="Female";
            }
            $new_bedroom=array(
                'indexno' => $row->COL2,
                'stno' => $row->COL2,
                'surname' =>$row->COL3,
                'firstname' =>$row->COL4,
                'sex' =>$gender,
                'address' =>$row->COL8,
                'telephoneno' =>$row->COL7,
                'LEVEL' =>"100H",
                'YEAR' =>"100H",
                'PROGRAMMECODE' =>"HIT",
                'NAME' => $row->COL3." , ".$row->COL4,
            );
            $bedroom = new Models\StudentModel($new_bedroom);
            $bedroom->save();

        }
    }
    public function generateAccounts() {
        ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
//         $user=  Models\PortalPasswordModel::where('year','2016/2017')->where('level','100H')->get();
//         foreach($user as $users=>$row){
//             
//             $student=$row->username;
//             $password=  strtoupper(str_random(9));
//             $hashedPassword = bcrypt($password);
//             
//             Models\PortalPasswordModel::where('username',$student)->where('level','100')->update(array("password" => $hashedPassword,'real_password'=>$password));
//             
//         } 
        $query=  \App\Models\StudentModel::where("LEVEL","100H")->where("PROGRAMMECODE","HIT")->get();
        foreach($query as $index=>$row){
            $que=Models\PortalPasswordModel::where("username",$row->INDEXNO)->first();
            if(empty($que)){
                $str = 'abcdefhkmnprtuvwxyz234678';
                $shuffled = str_shuffle($str);
                $vcode = substr($shuffled,0,9);
                $real=strtoupper($vcode);

                Models\PortalPasswordModel::create([
                    'username' => $row->INDEXNO,
                    'real_password' =>$real,
                    'level' =>$row->LEVEL,
                    'programme' =>$row->PROGRAMMECODE,
                    'password' => bcrypt($real),
                ]);}
        }
    }
    public function index(Request $request, SystemController $sys) {

        if(@\Auth::user()->role=="Support"){
            $departmentArray=explode(",",@\Auth::user()->department);
            $student = StudentModel::where('PROGRAMMECODE', '!=', '')->whereHas('programme', function($q)use($departmentArray) {
                $q->whereHas('departments', function($q)use($departmentArray) {
                    $q->whereIn('DEPTCODE',  $departmentArray);
                });
            }) ;
        }
        elseif (@\Auth::user()->role=="FSupport") {
            $student = StudentModel::where('PROGRAMMECODE', '!=', '')->whereHas('programme', function($q) {
                $q->whereHas('departments', function($q) {
                    $q->whereIn('FACCODE', array(@\Auth::user()->department));
                });
            }) ;
        }
        elseif (@\Auth::user()->department=="Finance") {
            $student = StudentModel::where("STATUS","In school");
        }
        else{
            $student = StudentModel::query();
            
        }

        if ($request->has('department') && trim($request->input('department')) != "") {
            $student->whereHas('programme', function($q)use ($request) {
                $q->whereHas('departments', function($q)use ($request) {
                    $q->whereIn('DEPTCODE', [$request->input('department')]);
                });
            });
        }
        if ($request->has('type') && trim($request->input('type')) != "") {
            $student->whereHas('programme', function($q)use ($request) {

                $q->where('TYPE', [$request->input('type')]);

            });
        }

        if ($request->has('school') && trim($request->input('school')) != "") {
            $student->whereHas('programme', function($q)use ($request) {
                $q->whereHas('departments', function($q)use ($request) {

                    $q->whereHas('school', function($q)use ($request) {
                        $q->whereIn('FACCODE', [$request->input('school')]);
                    });
                });
            });
        }



        if ($request->has('search') && trim($request->input('search')) != "") {
            // dd($request);
            $student->where($request->input('by'), "LIKE", "%" . $request->input("search", "") . "%");
        }
        if ($request->has('program') && trim($request->input('program')) != "") {
            $student->where("PROGRAMMECODE", $request->input("program", ""));
        }
        if ($request->has('level') && trim($request->input('level')) != "") {
            $student->where("LEVEL", $request->input("level", ""));
        }
        if ($request->has('qa') && trim($request->input('qa')) != "") {
            $student->where("QUALITY_ASSURANCE", $request->input("qa", ""));
        }

        if ($request->has('status') && trim($request->input('status')) != "") {
            $student->where("STATUS", $request->input("status", ""));
        }
        if ($request->has('group') && trim($request->input('group')) != "") {
            $student->where("GRADUATING_GROUP", $request->input("group", ""));
        }
        if ($request->has('nationality') && trim($request->input('nationality')) != "") {
            $student->where("COUNTRY", $request->input("country", ""));
        }
        if ($request->has('region') && trim($request->input('region')) != "") {
            $student->where("REGION", $request->input("region", ""));
        }
        if ($request->has('gender') && trim($request->input('gender')) != "") {
            $student->where("SEX", $request->input("gender", ""));
        }
        if ($request->has('sms') && trim($request->input('sms')) != "") {
            $student->where("SMS_SENT", $request->input("sms", ""));
        }
        if ($request->has('hall') && trim($request->input('hall')) != "") {
            $student->where("HALL", $request->input("hall", ""));
        }
        if ($request->has('register') && trim($request->input('register')) != "") {
            $student->where("REGISTERED", $request->input("register", ""));
        }
        if ($request->has('religion') && trim($request->input('religion')) != "") {
            $student->where("RELIGION", $request->input("religion", ""));
        }
        if ($request->has('search') && trim($request->input('search')) != "" && trim($request->input('by')) != "") {
            // dd($request);
            $student->where($request->input('by'), "LIKE", "%" . $request->input("search", "") . "%")
            ;
        }
        $data = $student->orderBy('LEVEL')->orderBy('PROGRAMMECODE')->orderBy('INDEXNO')->paginate(500);

        $request->flashExcept("_token");

        \Session::put('students', $data);
        return view('students.index')->with("data", $data)
            ->with('year', $sys->years())
            ->with('nationality', $sys->getCountry())
            ->with('halls', $sys->getHalls())
            ->with('level', $sys->getLevelList())
            ->with('religion', $sys->getReligion())
            ->with('region', $sys->getRegions())
            ->with('department', $sys->getDepartmentList())
            ->with('school', $sys->getSchoolList())
            ->with('programme', $sys->getProgramList())
            ->with('type', $sys->getProgrammeTypes());

    }
    public function sms(Request $request, SystemController $sys){
        ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
        $message = $request->input("message", "");
        $query = \Session::get('students');



        foreach($query as $rtmt=> $member) {
            $NAME = $member->NAME;
            $FIRSTNAME = $member->FIRSTNAME;
            $SURNAME = $member->SURNAME;
            $PROGRAMME = $sys->getProgram($member->PROGRAMME);
            $INDEXNO = $member->INDEXNO;
            $CGPA = $member->CGPA;
            $BILLS = $member->BILLS;
            $BILL_OWING = $member->BILL_OWING;
            $PASSWORD=$sys->getStudentPassword($INDEXNO);
            $newstring = str_replace("]", "", "$message");
            $finalstring = str_replace("[", "$", "$newstring");
            eval("\$finalstring =\"$finalstring\" ;");
            if ($sys->firesms($finalstring,$member->TELEPHONENO,$member->INDEXNO)) {

                StudentModel::where("INDEXNO",$INDEXNO)->update(array("SMS_SENT","1"));

            } else {
                // return redirect('/students')->withErrors("SMS could not be sent.. please verify if you have sms data and internet access.");
            }
        }
        return redirect('/students')->with('success','Message sent to students successfully');

        \Session::forget('students');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {

        return view('students.index');
    }
    public function anyData(Request $request)
    {

        $students = StudentModel::join('tpoly_programme', 'tpoly_students.PROGRAMMECODE', '=', 'tpoly_programme.PROGRAMMECODE')
            ->select(['tpoly_students.ID', 'tpoly_students.NAME','tpoly_students.INDEXNO', 'tpoly_programme.PROGRAMME','tpoly_students.LEVEL','tpoly_students.INDEXNO','tpoly_students.SEX','tpoly_students.AGE','tpoly_students.TELEPHONENO','tpoly_students.COUNTRY','tpoly_students.GRADUATING_GROUP','tpoly_students.STATUS']);



        return Datatables::of($students)

            ->addColumn('action', function ($student) {
                return "<a href=\"edit_student/$student->INDEXNO/id\" class=\"\"><i title='Click to view student details' class=\"md-icon material-icons\">&#xE88F;</i></a>";
                // use <i class=\"md-icon material-icons\">&#xE254;</i> for showing editing icon
                //return' <td> <a href=" "><img class="" style="width:70px;height: auto" src="public/Albums/students/'.$student->INDEXNO.'.JPG" alt=" Picture of Employee Here"    /></a>df</td>';


            })
            ->editColumn('id', '{!! $ID!!}')
            ->addColumn('Photo', function ($student) {
                // return '<a href="#edit-'.$student->ID.'" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light">View</a>';

                return' <a href="show_student/'.$student->INDEXNO.'/id"><img class="md-user-image-large" style="width:60px;height: auto" src="Albums/students/'.$student->INDEXNO.'.JPG" alt=" Picture of Student Here"    /></a>';


            })


            ->setRowId('id')
            ->setRowClass(function ($student) {
                return $student->ID % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])

            ->make(true);

        //flash the request so it can still be available to the view or search form and the search parameters shown on the form
        //$request->flash();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SystemController $sys)
    {
        $region=$sys->getRegions();
        $programme=$sys->getProgramList();
        $hall=$sys->getHalls();
        $religion=$sys->getReligion();
        return view('students.create')
            ->with('programme', $programme)
            ->with('country', $sys->getCountry())
            ->with('region', $region)
            ->with('hall',$hall)
            ->with('level', $sys->getLevelList())
            ->with('religion',$religion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SystemController $sys)
    {

        set_time_limit(36000);
        /*transaction is used here so that any errror rolls
         *  back the whole process and prevents any inserts or updates
         */
        if($request->user()->isSupperAdmin || @\Auth::user()->role=="Dean" || @\Auth::user()->department=="top"|| @\Auth::user()->role=="HOD" || @\Auth::user()->department=="Tpmid" || @\Auth::user()->department=="Tptop" || @\Auth::user()->department == "Admissions"){

            \DB::beginTransaction();

            $user = @\Auth::user()->id;

            $year=$request->input('year');

            $level= $year;

            $array=$sys->getSemYear();

            $fiscalYear=$array[0]->YEAR;
            $indexno = $request->input('indexno');
            $program = $request->input('programme');
            $gender = $request->input('gender');
            $category = $request->input('category');
            $hostel = $request->input('hostel');
            $hall = $request->input('halls');
            $dob = $request->input('dob');
            $gname = $request->input('gname');
            $gphone = $request->input('gphone');
            $goccupation = $request->input('goccupation');
            $gaddress = $request->input('gaddress');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $marital_status = $request->input('marital_status');
            $region = $request->input('region');
            $country = $request->input('nationality');
            $religion = $request->input('religion');
            $residentAddress = $request->input('contact');
            $address = $request->input('address');
            $hometown = $request->input('hometown');
            $nhis = $request->input('nhis');
            $type = $request->input('type');
            $disability = $request->input('disabilty');
            $title = $request->input('title');
            $age = $sys->age($dob, 'eu');
            $group = "";
            $fname = $request->input('fname');
            $bill= $request->input('bill');
            $lname = $request->input('surname');
            $othername = $request->input('othernames');

            $sql=  StudentModel::where("STNO",$indexno)->first();
            if(empty($sql)){
                /////////////////////////////////////////////////////

                $name = $lname . ' ' . $othername . ' ' . $fname;
                $query = new StudentModel();
                $query->YEAR = $year;
                $query->LEVEL = $level;
                $query->FIRSTNAME = $fname;
                $query->SURNAME = $lname;
                $query->OTHERNAMES = $othername;
                $query->TITLE = $title;
                $query->SEX = $gender;
                $query->DATEOFBIRTH = $dob;
                $query->NAME = $name;
                $query->AGE = $age;
                $query->GRADUATING_GROUP = $group;
                $query->MARITAL_STATUS = $marital_status;
                $query->HALL = $hall;
                $query->ADDRESS = $address;
                $query->RESIDENTIAL_ADDRESS = $residentAddress;
                $query->EMAIL = $email;
                $query->PROGRAMMECODE = $program;
                $query->TELEPHONENO = $phone;
                $query->COUNTRY = $country;
                $query->REGION = $region;
                $query->RELIGION = $religion;
                $query->HOMETOWN = $hometown;
                $query->GUARDIAN_NAME = $gname;
                $query->GUARDIAN_ADDRESS = $gaddress;
                $query->GUARDIAN_PHONE = $gphone;
                $query->GUARDIAN_OCCUPATION = $goccupation;
                $query->DISABILITY = $disability;
                $query->STATUS = "In school";
                $query->SYSUPDATE = "1";
                $query->NHIS = $nhis;
                $query->STUDENT_TYPE = $type;
                $query->TYPE = $category;

                $query->HOSTEL = $hostel;
                //$query->BILLS=$sys->getYearBill( $fiscalYear, $level, $program);
                // $query->BILL_OWING=$sys->getYearBill( $fiscalYear, $level, $program);
                $query->STNO =$indexno;
                $query->INDEXNO =$indexno;

                if($query->save()){
                    \DB::commit();
                    $que=Models\PortalPasswordModel::where("username",$indexno)->first();
                    if(empty($que)){
                        $program=$program;
                        $str = 'abcdefhkmnprtuvwxyz234678';
                        $shuffled = str_shuffle($str);
                        $vcode = substr($shuffled,0,9);
                        $real=strtoupper($vcode);
                        $level= $level;
                        Models\PortalPasswordModel::create([
                            'username' => $indexno,
                            'real_password' =>$real,
                            'level' =>$level,
                            'programme' =>$program,
                            'biodata_update' =>'1',
                            'password' => bcrypt($real),
                        ]);

                        $message = "Hi $fname, Please visit ttuportal.com to do update your biodata with $indexno as your username  and $real as password   ";

                        \DB::commit();
                        if ($sys->firesms($message, $phone, $indexno)) {

                        }
                    }
                    return redirect("/students")->with("success"," <span style='font-weight:bold;font-size:13px;'> student successfully added!</span> ");

                }else{

                    return redirect("/add_students")->with("error"," <span style='font-weight:bold;font-size:13px;'> student could not be added try again!</span>");


                }
            }
            else{
                return redirect("/add_students")->with("error"," <span style='font-weight:bold;font-size:13px;'>Please student exist in the system already!</span>");

            }
        } else{
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'This action is unauthorized.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,  SystemController $sys,Request $request)
    {

        $region=$sys->getRegions();


        // make sure only students who are currently in school can update their data
        $query = StudentModel::where('ID', $id)->first();
        $programme=$sys->getProgramList();
        $hall=$sys->getHalls();
        $religion=$sys->getReligion();

        $trails=  Models\AcademicRecordsModel::where('student', $id)->where("grade","E")->paginate(100);

        return view('students.show')->with('student', $query)
            ->with('programme', $programme)
            ->with('country', $sys->getCountry())
            ->with('region', $region)
            ->with('hall',$hall)
            ->with('trail',$trails)
            ->with('religion',$religion);
    }
    public function uploadStaff(Request $request) {
        if($request->hasFile('file')){
            $file=$request->file('file');
            $user = \Auth::user()->id;

            $ext = strtolower($file->getClientOriginalExtension());
            $valid_exts = array('csv','xlx','xlsx'); // valid extensions

            $path = $request->file('file')->getRealPath();
            if (in_array($ext, $valid_exts)) {
                $data = Excel::load($path, function($reader) {

                })->get();

                dd($data);
                if(!empty($data) && $data->count()){

                    foreach ($data as $key => $value) {

                        $insert[] = ['fullName' => $value->name, 'staffID' => $value->staffID,'department'=>$value->Department,'grade'=>$value->grade,'designation'=>$value->position,'phone'=>$value->phone];

                    }

                    // dd($insert);
                    if(!empty($insert)){

                        \DB::table('tpoly_workers')->insert($insert);

                        // return redirect('/dashboard')->with("success",  " <span style='font-weight:bold;font-size:13px;'>Staff  successfully uploaded!</span> " );


                    }

                }

            }
            else{
                //  return redirect('/getStaffCSV')->with("error", " <span style='font-weight:bold;font-size:13px;'>Please upload file format must be xlx,csv,xslx!</span> ");

            }
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function gad()
    {
        //
        return view('autocomplete');
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function showUploadForm() {
        return view("students.upload");
    }
    public function applicantUploadForm() {
        return view("students.applicantUpload");
    }
    public function indexNumberUploadForm() {
        return view("students.indexUpload");
    }
    
   
   
}
