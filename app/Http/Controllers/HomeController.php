<?php

namespace App\Http\Controllers;
use App\Models\pay;
use App\Models\product;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        $pro = product::All();
        // return redirect('adminProduct')->with('pro',$pro);
        return view('adminProduct')->with('pro',$pro);  
    }

    public function productStore(Request $req )
    {
        $input= $req->all();
        product::create($input);
        return redirect()->route('adminProduct');
    }

    
    public function update(Request $request)
    {
        $product=product::find($request->input('id'));
        $input= $request->all();
        $product->update($input);
        return redirect()->route('adminProduct');

    }

    public function destroy($id)
    {
        product::destroy($id);
        return redirect()->route('adminProduct');

    }

    public function productEdit($id)
    {
        
        $input=product::find($id);
        // return redirect()->route('edit')->with('product',$input);
        return view('productEdit',compact('input'));
        
    }

    public function create()
    {
        return view('createProduct');
    }

    public function payment($id)
    {
        $input=product::find($id);
        return view('payment')->with('product',$input);
    }
    public function product()
    {
        $product= product::all();
        return view('product')->with('pro',$product);
    }

    public function success(Request $request)
    {

        $t_code=$request->mer_txnid;
        $pg_txnid=$request->pg_txnid;
        if(Pay::where('tran_id',$t_code)->exists()){
            $status=1;
            Pay::where('tran_id',$t_code)->update(array('status'=>$status));
        }
        return view('success');
    }

    public function fail(Request $request)
    {
        $t_code=$request->mer_txnid;
        $pg_txnid=$request->pg_txnid;
        if(Pay::where('tran_id',$t_code)->exists()){
            $status=2;
            Pay::where('tran_id',$t_code)->update(array('status'=>$status));
        }
        
        return view('fail');
    }

    public function store(Request $request){
        $status=0;
        //date_default_timezone_set('Asia/Dhaka');
        //$date =Carbon::now();
        $date=date('Y-m-d');
        $fields_string=0;
        $store_id=0;
        $signature_key=0;
        $pg_txnid=0;
        $tran_id=random_int(10000000,99999999);
        $success_url=0;
        $fail_url=0;
        $cancel_url=0;
        $pay=new Pay;
        $pay->amount =$request->input('amount');
        $pay->currency =$request->input('currency');
        $pay->desc =$request->input('desc');
        $pay->cus_name =$request->input('cus_name');
        $pay->cus_email =$request->input('cus_email');
        $pay->cus_add1 =$request->input('cus_add1');
        $pay->cus_add2 =$request->input('cus_add2');
        $pay->cus_city =$request->input('cus_city');
        $pay->cus_state =$request->input('cus_state');
        $pay->cus_country =$request->input('cus_country');
        $pay->cus_phone =$request->input('cus_phone');
        $pay->store_id =$store_id;
        $pay->tran_id =$tran_id;
        $pay->signature_key =$signature_key;
        $pay->success_url =$success_url;
        $pay->fail_url =$fail_url;
        $pay->cancel_url =$cancel_url;
        $pay->date =$date;
        $pay->status=$status;
        $pay->pg_txnid=$pg_txnid;


        if($pay->save()){
            
                        $url = 'https://sandbox.aamarpay.com/request.php';
                        $fields = array(
                            'store_id' => 'aamarpaytest', 
                            'amount' => $request->input('amount'), 
                            'payment_type' => 'VISA',
                            'currency' => $request->input('currency'), 
                            'tran_id' => $tran_id,
                            'cus_name' => $request->input('cus_name'), 
                            'cus_email' => $request->input('cus_email'),
                            'cus_add1' => $request->input('cus_add1'), 
                            'cus_add2' => $request->input('cus_add2'),
                            'cus_city' => $request->input('cus_city'), 
                            'cus_state' =>$request->input('cus_state'), 
                            'cus_postcode' => '1206',
                            'cus_country' => $request->input('cus_country'), 
                            'cus_phone' => $request->input('cus_phone'),
                            'cus_fax' => 'Not¬Applicable',
                            'ship_name' =>$request->input('cus_name'),
                            'ship_add1' => 'House B-121, Road 21',
                            'ship_add2' => 'Mohakhali',
                            'ship_city' => 'Dhaka', 
                            'ship_state' => 'Dhaka',
                            'ship_postcode' => '1212', 
                            'ship_country' => 'Bangladesh',
                            'desc' => $request->input('desc'), 
                            'success_url' => route('success'),
                            'fail_url' => route('fail'),
                            'cancel_url' => route('product'),
                            'opt_a' => 'Reshad', 
                            'opt_b' => 'Akil',
                            'opt_c' => 'Liza', 
                            'opt_d' => 'Sohel',
                            'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183');
                        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                        $fields_string = http_build_query($fields);
         
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);  
      
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
            curl_close($ch); 

            $this->redirect_to_merchant($url_forward);
        }
        

   

    }
    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
          </body>
        </html>
        <?php	
        exit;
    } 

    
}
