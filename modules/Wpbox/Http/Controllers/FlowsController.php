<?php

namespace Modules\Wpbox\Http\Controllers;
use Modules\Wpbox\Models\Reply;
use Modules\Wpbox\Models\Flows;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Wpbox\Models\Campaign;
use Auth;


class FlowsController extends Controller
{
    /**
     * Provide class.
     */
    private $provider = Flows::class;



    /*  Provide class. entry for boat  */
    private $provider_reply = Reply::class;

    /**
     * Web RoutePath for the name of the routes.
     */
    private $webroute_path = 'flows.';

    /**
     * View path.
     */
    private $view_path = 'wpbox::flows.';

    /**
     * Parameter name.
     */
    private $parameter_name = 'flows';

    /**
     * Title of this crud.
     */
    private $title = 'flows';

    /**
     * Title of this crud in plural.
     */
    private $titlePlural = 'flows';

    private function getFields($class='col-md-4', $type='bot')
    {
        $fields=[];
        
        //Add name field
        $fields[0]=['class'=>$class, 'ftype'=>'input', 'name'=>'Name', 'id'=>'name', 'placeholder'=>'Enter name', 'required'=>true];

        //Add text field
        $fields[1]=['class'=>$class, 'ftype'=>'textarea', 'name'=>'Reply text', 'id'=>'text', 'placeholder'=>'Enter reply text', 'required'=>true,'additionalInfo'=>__('Text that will be send to contact. You can also use {{name}},{{phone}} on any other custom field name')];

        //Type
        $fields[2]=['class'=>$class, 'value'=>"1", 'ftype'=>'select', 'name'=>'Reply type', 'id'=>'type', 'placeholder'=>'Select reply type', 'data'=>['1'=>__('Just a quick reply'),'2'=>__('Reply bot: On exact match'),'3'=>__('Reply bot: When message contains'),'4'=>__('Welcome reply - when client send the first message')], 'required'=>true];
        
        //Add trigger field
        $fields[3]=['class'=>$class, 'ftype'=>'input', 'name'=>'Trigger', 'id'=>'trigger', 'placeholder'=>'Enter bot reply trigger', 'required'=>false];

        //If type is bot
        if($type=='bot'){
            // Add header field
            $fields[4]=['class'=>$class,'additionalInfo'=>"Optional, header text", 'ftype'=>'input', 'name'=>'Header', 'id'=>'header', 'placeholder'=>'Enter header', 'required'=>false];

            $fields[5]=['class'=>$class, 'additionalInfo'=>"Optional, footer text", 'ftype'=>'input', 'name'=>'Footer', 'id'=>'footer', 'placeholder'=>'Enter footer', 'required'=>false];

            $fields[6]=['class'=>$class,'separator'=>"Option 1: Bot with reply buttons", 'additionalInfo'=>"Optional, button1 text", 'ftype'=>'input', 'name'=>'Button1', 'id'=>'button1', 'placeholder'=>'Enter button1', 'required'=>false];

            $fields[7]=['class'=>$class, 'additionalInfo'=>"Optional, button1 ID", 'ftype'=>'input', 'name'=>'Button1 ID', 'id'=>'button1_id', 'placeholder'=>'Enter button1 ID', 'required'=>false];

            $fields[8]=['class'=>$class, 'additionalInfo'=>"Optional, button2 text", 'ftype'=>'input', 'name'=>'Button2', 'id'=>'button2', 'placeholder'=>'Enter button2', 'required'=>false];

            $fields[9]=['class'=>$class, 'additionalInfo'=>"Optional, button2 ID", 'ftype'=>'input', 'name'=>'Button2 ID', 'id'=>'button2_id', 'placeholder'=>'Enter button2 ID', 'required'=>false];

            $fields[10]=['class'=>$class, 'additionalInfo'=>"Optional, button3 text", 'ftype'=>'input', 'name'=>'Button3', 'id'=>'button3', 'placeholder'=>'Enter button3', 'required'=>false];

            $fields[11]=['class'=>$class, 'additionalInfo'=>"Optional, button3 ID", 'ftype'=>'input', 'name'=>'Button3 ID', 'id'=>'button3_id', 'placeholder'=>'Enter button3 ID', 'required'=>false];
       
            $fields[12]=['class'=>$class,'separator'=>"Option 2: Bot with button link - CTA URL", 'additionalInfo'=>"The button name", 'ftype'=>'input', 'name'=>'Button name', 'id'=>'button_name', 'placeholder'=>'Enter button name', 'required'=>false];

            $fields[13]=['class'=>$class, 'additionalInfo'=>"Button URL - Link", 'ftype'=>'input', 'name'=>'Button link', 'id'=>'button_url', 'placeholder'=>'Enter button url', 'required'=>false];

        }
        //Return fields
        return $fields;
    }


    private function getFilterFields(){
        $fields=$this->getFields('col-md-3', 'qr');
        $fields[0]['required']=true;
        unset($fields[1]);
        unset($fields[2]);
        unset($fields[3]);
        return $fields;
    }

    /**
     * Auth checker functin for the crud.
     */
    private function authChecker()
    {
        $this->ownerAndStaffOnly();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $this->authChecker();
        //Check if this is Quick Reply only view, ?type=qr
        //Use request
        $isQuickReplies= request()->has('type') && request()->get('type') === 'qr';
        
        if($isQuickReplies){
           
            $items=$this->provider::where('type', 1)->orderBy('id', 'desc');
            $items=$items->paginate(config('settings.paginate'));
        }else{
            
            //Bots
            //text based bots
         
            // $items=$this->provider::where('type', '!=', 1)->orderBy('id', 'desc');

            // //Template based bots
            // $template_bots = Campaign::orderBy('id', 'desc')->whereNull('contact_id')->where('is_bot', true);
            // $items = $items->get()->merge($template_bots->get());


            $items=$this->provider::orderBy('id', 'desc')->where('boat_id',$id);
            // dd('items',$items);
            //Template based bots
           // $template_bots = Campaign::orderBy('id', 'desc')->whereNull('contact_id')->where('is_bot', true);
            $items = $items->get();
        }
      
        
        // Regular, bot ant template based bot
        // $setup=[
            // 'usefilter'=>null,
            // 'title'=>__('Flow management'),
            // 'action_link'=>route('campaigns.create',['type'=>'bot']),
            // 'action_name'=>__('Create template based bot'),
            // 'action_link2'=>route($this->webroute_path.'create',['type'=>"bot"]),
            // 'action_name2'=>__('Create message bot'),
            // 'items'=>$items,
            // 'item_names'=>$this->titlePlural,
            // 'webroute_path'=>$this->webroute_path,
            // 'fields'=>$this->getFields('col-md-3', $isQuickReplies?'qr':'bot'),
            // 'filterFields'=>$this->getFilterFields(),
            // 'custom_table'=>true,
            // 'parameter_name'=>$this->parameter_name,
            // 'parameters'=>count($_GET) != 0,
            // 'hidePaging'=>!$isQuickReplies,
        // ];

        // if($isQuickReplies){
        //     $setup['title']=__('Quick Replies management');
        //     $setup['action_link']=route($this->webroute_path.'create',['type'=>"reply"]);
        //     $setup['action_name']=__('Create new reply');
        //     unset($setup['action_link2']);
        //     unset($setup['action_name2']);
        // }
    //   dd($this->view_path);
        return view($this->view_path.'index', ['items' => $items,'boat_id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $this->authChecker();
        $isBot = request()->has('type') && request()->get('type') === 'bot';

        $fields = $this->getFields('col-md-6', ($isBot?'bot':'qr'));

        if($isBot){
            
            //Unset the 2nd field, first option
            unset($fields[2]['data'][1]);
            $fields[2]['value']=2;

            return view('general.form', ['setup' => [
                'title'=>__('crud.new_item', ['item'=>__('text bot')]),
                'action_link'=>route($this->webroute_path.'index',['id'=>$id]),
                'action_name'=>__('crud.back'),
                'iscontent'=>true,
                'action'=>route($this->webroute_path.'store'),
                'id'=>$id,
            ],
            'fields'=>$fields ]);
        }else{
           
            unset($fields[2]['data'][3]);
            unset($fields[2]['data'][2]);
            unset($fields[2]['data'][4]);
            return view($this->view_path.'create', 
            ['setup' => [
                'title'=>__('crud.new_item', ['item'=>__('Quick Reply')]),
                'action_link'=>route($this->webroute_path.'index',['id',$id]),
                'action_name'=>__('crud.back'),
                'iscontent'=>true,
                'action'=>route($this->webroute_path.'store'),
               
            ],
            'fields'=>$fields,
            'id'=>$id,
         ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authChecker();
        //Create new field
        $field = $this->provider::create([
            'boat_id'=> $request->boat_id,
            'created_by'=> Auth::user()->id,
            'name' => $request->name,
            'trigger' => $request->trigger,
            'type'=> $request->type,
            // 'trigger_on' => $request->trigger_on,
            // 'status' => $request->status,
            // 'trigger_frequency' => $request->trigger_frequency
        ]);

        $field1 = $this->provider_reply::create([ 
            // 'company_id	'=> Auth::user()->id,
            'name' => $request->name,
            'trigger' => $request->trigger,
            'type'=> $request->type,
        ]);
        $field1->save();      
        $field->save();
       
        return redirect()->route($this->webroute_path.'index',['id'=>$request->boat_id]);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit($flowid,$boat_id = null)
    {

        $this->authChecker();
        
        $items = Flows::where('id', $flowid)->first();
      

        // $fields = $this->getFields('col-md-6',$reply->type==1?'qr':'bot');
        // $fields[0]['value'] = $reply->name;
        // $fields[1]['value'] = $reply->text;
        // $fields[2]['value'] = $reply->type;
        // $fields[3]['value'] = $reply->trigger;

        // if($reply->type!=1){
        //     $fields[4]['value'] = $reply->header;
        //     $fields[5]['value'] = $reply->footer;
        //     $fields[6]['value'] = $reply->button1;
        //     $fields[7]['value'] = $reply->button1_id;
        //     $fields[8]['value'] = $reply->button2;
        //     $fields[9]['value'] = $reply->button2_id;
        //     $fields[10]['value'] = $reply->button3;
        //     $fields[11]['value'] = $reply->button3_id;
        //     $fields[12]['value'] = $reply->button_name;
        //     $fields[13]['value'] = $reply->button_url;
        // }

        // $parameter = [];
        // $parameter[$this->parameter_name] = $reply->id;
        return view($this->view_path.'edit', ['items' => $items,'boat_id'=>$boat_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->authChecker();
        $item = Flows::findOrFail($id);
    
        // Update the attributes with the request data
        $item->boat_id = $request->boat_id;
        $item->created_by = Auth::user()->id;
        $item->name = $request->name;
        $item->trigger = $request->trigger;
        $item->trigger_on = $request->trigger_on;
        $item->status = $request->status;
        $item->trigger_frequency = $request->trigger_frequency;
        
        // Save the changes
        $item->save();
    
        return redirect()->route($this->webroute_path.'index',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authChecker();
        $item = $this->provider::findOrFail($id);
        $item->delete();
        return redirect()->route($this->webroute_path.'index');
    }
    
}
