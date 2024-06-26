
window.fbAsyncInit = function () {
    // JavaScript SDK configuration and setup
    FB.init({
        appId: '1100245901048573', // Facebook App ID
        cookie: true, // enable cookies
        xfbml: true, // parse social plugins on this page
        version: 'v19.0' // Graph API version
    });
};

// Load the JavaScript SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook Login with JavaScript SDK
function launchWhatsAppSignup() {
    console.log('heree')
    const fbq ='';
    // Conversion tracking code
    fbq && fbq('trackCustom', 'WhatsAppOnboardingStart', { appId: '1100245901048573', 
    feature: 'whatsapp_embedded_signup' });

    // Launch Facebook login
    FB.login(function (response) {
        if (response.authResponse) {
            const code = response.authResponse.code;
            console.log('code', code);
            // The returned code must be transmitted to your backend,
            // which will perform a server-to-server call from there to our servers for an access token
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
        config_id: '242458892278725', // configuration ID goes here
        response_type: 'code',    // must be set to 'code' for System User access token
        override_default_response_type: true, // when true, any response types passed in the "response_type" will take precedence over the default types
        extras: {
            setup: {
                // Prefilled data can go here
            }
        }
    });
}
