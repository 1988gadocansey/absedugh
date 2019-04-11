<?php



namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use App\Models;

use Validator;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Collection;

use Illuminate\Support\Str;

 

class UserController extends Controller

{

     

    /**

     * Create a new controller instance.

     *

     

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

       

         

    }

     

    /**

     * Display a list of all of the user's task.

     *

     * @param  Request  $request

     * @return Response

     */
    public function getIndexUserLevels(Request $request, SystemController $sys)

    {
      if ($sys->getUserLevel((@\Auth::user()->department),"academic_calender") == '1' || $sys->getUserLevel((@\Auth::user()->role),"academic_calender") == '1') {
        

       $userLevel = @Models\UserLevelModel::orderBy('id')->paginate('100');

       

          

           return view('users.userLevel')->with('data',$userLevel);

    }
  }


  public function updateUserLevel($item,$action, SystemController $sys) {
      if ($sys->getUserLevel((@\Auth::user()->department),"academic_calender") == '1' || $sys->getUserLevel((@\Auth::user()->role),"academic_calender") == '1') {

        if($action=="result_all0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("view_results_all"=>"0"));

        }

        elseif($action=="result_all1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("view_results_all"=>"1"));

        }

        elseif($action=="view_results_register0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("view_results_register"=>"0"));

        }

         elseif($action=="view_results_register1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("view_results_register"=>"1"));

        } 

        elseif($action=="print_card0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_card"=>"0"));

        }

         elseif($action=="print_card1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_card"=>"1"));

        } 

        elseif($action=="courses_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("courses_upload"=>"0"));   

        }

         elseif($action=="courses_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("courses_upload"=>"1"));

        } 

        elseif($action=="mounted_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("mounted_upload"=>"0"));

        }

         elseif($action=="mounted_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("mounted_upload"=>"1"));

        } 

        elseif($action=="delete_mounted0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_mounted"=>"0"));

        }

         elseif($action=="delete_mounted1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_mounted"=>"1"));

        } 

        elseif($action=="resit_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("resit_upload"=>"0"));   

        }

         elseif($action=="resit_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("resit_upload"=>"1"));

        }

        elseif($action=="legacy_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("legacy_upload"=>"0"));

        }

         elseif($action=="legacy_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("legacy_upload"=>"1"));

        } 

        elseif($action=="transcript0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("transcript"=>"0"));

        }

         elseif($action=="transcript1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("transcript"=>"1"));

        } 

        elseif($action=="admin_top0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_top"=>"0"));   

        }

         elseif($action=="admin_top1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_top"=>"1"));

        } 

        elseif($action=="admin_academic0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_academic"=>"0"));

        }

         elseif($action=="admin_academic1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_academic"=>"1"));

        } 

        elseif($action=="exam_dpt0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("exam_dpt"=>"0"));

        }

         elseif($action=="exam_dpt1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("exam_dpt"=>"1"));

        } 

        elseif($action=="create_bill0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_bill"=>"0"));   

        }

         elseif($action=="create_bill1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_bill"=>"1"));

        }

        elseif($action=="enter_fees0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("enter_fees"=>"0"));

        }

         elseif($action=="enter_fees1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("enter_fees"=>"1"));

        } 

        elseif($action=="grant_protocol0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("grant_protocol"=>"0"));

        }

         elseif($action=="grant_protocol1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("grant_protocol"=>"1"));

        } 

        elseif($action=="change_status0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_status"=>"0"));   

        }

         elseif($action=="change_status1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_status"=>"1"));

        } 

        elseif($action=="change_programme0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_programme"=>"0"));

        }

         elseif($action=="change_programme1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_programme"=>"1"));

        } 

        elseif($action=="print_receipt0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_receipt"=>"0"));

        }

         elseif($action=="print_receipt1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_receipt"=>"1"));

        } 

        elseif($action=="delete_fee0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_fee"=>"0"));   

        }

         elseif($action=="delete_fee1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_fee"=>"1"));

        }

        elseif($action=="delete_payment0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_payment"=>"0"));

        }

         elseif($action=="delete_payment1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_payment"=>"1"));

        } 

        elseif($action=="academic_calender0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("academic_calender"=>"0"));

        }

         elseif($action=="academic_calender1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("academic_calender"=>"1"));

        }

        elseif($action=="download_nabptex0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("download_nabptex"=>"0"));

        }

         elseif($action=="download_nabptex1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("download_nabptex"=>"1"));

        } 

        elseif($action=="create_student0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_student"=>"0"));

        }

         elseif($action=="create_student1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_student"=>"1"));

        } 

        elseif($action=="create_staff0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_staff"=>"0"));   

        }

         elseif($action=="create_staff1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_staff"=>"1"));

        } 

        elseif($action=="mounted_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("mounted_upload"=>"0"));

        }

         elseif($action=="mounted_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("mounted_upload"=>"1"));

        } 

        elseif($action=="delete_mounted0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_mounted"=>"0"));

        }

         elseif($action=="delete_mounted1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_mounted"=>"1"));

        } 

        elseif($action=="resit_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("resit_upload"=>"0"));   

        }

         elseif($action=="resit_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("resit_upload"=>"1"));

        }

        elseif($action=="legacy_upload0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("legacy_upload"=>"0"));

        }

         elseif($action=="legacy_upload1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("legacy_upload"=>"1"));

        } 

        elseif($action=="transcript0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("transcript"=>"0"));

        }

         elseif($action=="transcript1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("transcript"=>"1"));

        } 

        elseif($action=="admin_top0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_top"=>"0"));   

        }

         elseif($action=="admin_top1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_top"=>"1"));

        } 

        elseif($action=="admin_academic0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_academic"=>"0"));

        }

         elseif($action=="admin_academic1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("admin_academic"=>"1"));

        } 

        elseif($action=="exam_dpt0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("exam_dpt"=>"0"));

        }

         elseif($action=="exam_dpt1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("exam_dpt"=>"1"));

        } 

        elseif($action=="create_bill0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_bill"=>"0"));   

        }

         elseif($action=="create_bill1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("create_bill"=>"1"));

        }

        elseif($action=="enter_fees0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("enter_fees"=>"0"));

        }

         elseif($action=="enter_fees1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("enter_fees"=>"1"));

        } 

        elseif($action=="grant_protocol0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("grant_protocol"=>"0"));

        }

         elseif($action=="grant_protocol1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("grant_protocol"=>"1"));

        } 

        elseif($action=="change_status0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_status"=>"0"));   

        }

         elseif($action=="change_status1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_status"=>"1"));

        } 

        elseif($action=="change_programme0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_programme"=>"0"));

        }

         elseif($action=="change_programme1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("change_programme"=>"1"));

        } 

        elseif($action=="print_receipt0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_receipt"=>"0"));

        }

         elseif($action=="print_receipt1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("print_receipt"=>"1"));

        } 

        elseif($action=="delete_fee0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_fee"=>"0"));   

        }

         elseif($action=="delete_fee1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_fee"=>"1"));

        }

        elseif($action=="delete_payment0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_payment"=>"0"));

        }

         elseif($action=="delete_payment1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("delete_payment"=>"1"));

        } 

        elseif($action=="academic_calender0"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("academic_calender"=>"0"));

        }

         elseif($action=="academic_calender1"){

          $query= @Models\UserLevelModel::where("id",$item)->update(array("academic_calender"=>"1"));

        } 

        

          

         if($query){

      

          return redirect("/user_level");

           }

           else{

               return redirect("/user_level")->with("error","<span style='font-weight:bold;font-size:13px;'> Access cannot be updated try again later</span> ");

         

           }
         }

    }



    public function getIndex(Request $request)

    {

        

        return view('users.users');

    }

    public function anyData(Request $request)

    {

         if( @\Auth::user()->department=='top' || @\Auth::user()->department=='Tptop' || @\Auth::user()->role=="Admin"){

        

       

       $staffs = User::join('tpoly_workers', 'users.staffID', '=', 'tpoly_workers.id')

           ->select(['users.id','tpoly_workers.fullName','tpoly_workers.staffID', 'users.name','users.email', 'users.role','users.department']);

         

         }

          



        return Datatables::of($staffs)

                         

             

               

            ->addColumn('Photo', function ($staff) {

               // return '<a href="#edit-'.$student->ID.'" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light">View</a>';

            

                return' <a href="#"><img class="md-user-image-large" style="width:60px;height: auto" src="public/albums/staff/'.$staff->staffID.'.JPG" alt=" Picture of Staff Here"    /></a>';

                          

                                         

            })

              

            

            ->setRowId('id')

             

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

      public function createStaffAccount(Request $request, SystemController $sys)

    { 

        if( @\Auth::user()->department=='top' || @\Auth::user()->department=='Tptop' || @\Auth::user()->role=="Admin"){

        $staffID = $request['staffID'];

         

            $checker = $sys->getStaffAccount($staffID);

            

            $username = $request['name'];

            $confirm = $request['confirm'];

            $department = $request['department'];

            $role = $request['role'];



            $phone = $request['phone'];

            $email = $request['email'];

            $real = strtoupper($request['password']);

            if(!empty($checker[0]->staffID)){

          //$this->validate($request, [

              $this->validate($request, [

            

            'name' => 'required|max:255',

            'phone' => 'required|max:10',

            'password' => 'required|min:7',

            'staffID' => 'required',

            'email' => 'required',

        ]);

              User::create([

            'name' => $username,

            'department' =>$department,

            'role' =>$role,

            'staffID' =>$sys->getLecturerFromStaffID($staffID),

            'phone' =>$phone,

            'email' =>$email,

            'password' => bcrypt($real),

            'fund' => $staffID,

        ]);

             

                     return redirect("/power_users")->with("success","<span style='font-weight:bold;font-size:13px;'> Account successfully created for $staffID and password $real  </span> ");

//            

//             }

//             else{

//               return redirect("/power_users")->with("success","<span style='font-weight:bold;font-size:13px;'> Account successfully created for $staffID and password $real  </span> ");

//             }

       }

       else{

           return redirect("/power_users")->with("error","<span style='font-weight:bold;font-size:13px;'> Staff with ID $staffID does not  . </span> ");

           

        }}

        else{

            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'This action is unauthorized.');

        }

    }



//     public function createStudentAccount(Request $request, SystemController $sys)

//    { 

//        if( @\Auth::user()->department=='top' || @\Auth::user()->department=='Tptop' || @\Auth::user()->role=="Admin"){

//        

//       $checker=  $sys->getStaffAccount($request['username']);

//      

//       $username=$request['username'];

//       $confirm=$request['confirm'];

//       $department=$request['department'];

//       $role=$request['role'];

//       $staffID=$request['staffID'];

//       $real=strtoupper($request['password']);

//       if(!empty($checker)){

//          //$this->validate($request, [

//              $this->validate($request, [

//            

//            'username' => 'required|max:255|unique:users',

//            'password' => 'required|min:7|unique:users',

//        ]);

//             users::create([

//            'username' => $username,

//             'department' =>$department,

//                 'role' =>$role,

//                  'staffID' =>$staffID,

//            'password' => bcrypt($real),

//        ]);

//             if($confirm!=$real){

//                   return redirect("/users")->with("error","<span style='font-weight:bold;font-size:13px;'> Passwords do not match  </span> ");

//         

//             }

//             else{

//               return redirect("/users")->with("success","<span style='font-weight:bold;font-size:13px;'> Account successfully created for $username and password $real  </span> ");

//             }

//       }

//       else{

//           return redirect("/users")->with("error","<span style='font-weight:bold;font-size:13px;'> Staff with indexno $username does not exist . </span> ");

//           

//        }}

//        else{

//            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'This action is unauthorized.');

//        }

//    }

    /**

     * Create a new task.

     *

     * @param  Request  $request

     * @return Response

     */

    public function store(Request $request)

    {

         

       

    }

    // show form for edit resource

    public function edit($id){

        }



    public function update(Request $request, $id){

        

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

        

    }

}

