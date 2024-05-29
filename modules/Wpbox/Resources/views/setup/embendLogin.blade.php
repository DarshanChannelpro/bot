<div class="card shadow max-height-vh-70 overflow-auto overflow-x-hidden">
    <div class="card-header shadow-lg">
        <b>Embed Login Setup</b>
    </div>
    <div class="card-body overflow-auto overflow-x-hidden scrollable-div d-flex " >
        @if ($company->getConfig('whatsapp_webhook_verified','no')!='yes' || $company->getConfig('whatsapp_settings_done','no')!='yes')
        <div >
            <div class="d-flex" >
              <button onclick="launchWhatsAppSignup()" style="background-color: #1877f2; border: 0; border-radius: 4px; color: #fff; cursor: pointer; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; height: 55px; padding: 0 24px;">
                 Login with Facebook</button>
            <div class="ml-5">
                  <img src="{{ true ? asset('icons8-verify-50.png') : asset('icons8-id-not-verified-30.png') }}" alt="Verification Status" style="display: inline-block;" class="w-70">
            </div>
        </div>
        </div>

        
            {{-- <button onclick="location.reload()" class="btn btn-outline-success" type="button">{{ __('Refresh status')}}</button> --}}

        @else  

        {{-- <div>
            <button onclick="launchWhatsAppSignup()" style="background-color: #1877f2; border: 0; border-radius: 4px; color: #fff; cursor: pointer; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; height: 55px !important; padding: 0 24px;">
                Login with Facebook</button>
            <div>
                <img src="{{ false ? asset('icons8-verify-50.png') : asset('icons8-id-not-verified-30.png') }}" alt="Verification Status" style="display: inline-block; margin-top: 10px; width:90% ">
            </div>
        </div> --}}
            {{-- <div class="alert alert-success" role="alert">
                <strong>{{ __('Success!')}}</strong> {{ __('You are now connected to Whatsapp Cloud API. You can start use the system') }}
            </div>  --}}
                
        @endif




        <script src="{{ asset('js/embend-login.js') }}"></script>
    </div>
   

</div>