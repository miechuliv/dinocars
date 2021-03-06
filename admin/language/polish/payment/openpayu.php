<?php
// Heading
$_['heading_title']     = 'konto PayU';

// Text
$_['text_module']       = 'Moduły';
$_['text_openpayu']       = '<a onclick="window.open(\'https://www.payu.pl/\');"><img src="view/image/payment/payu.png" alt="PayU account" title="PayU account" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_success']      = "Sukces: Udało się zmodyfikować moduł 'konto PayU'!";
$_['text_payment']		= 'Płatność';

// Entry
// Entry
$_['entry_merchantposid']		= 'Id punktu płatnośc:<br /><span class="help">OAuth protocol - client_id</span>';
$_['entry_posauthkey']			= 'Klucz autoryzacji płatności:<br /><span class="help">pos_auth_key</span>';
$_['entry_signaturekey']		= 'Klucz (MD5):<br /><span class="help">Protokół OAuth - client_secret</span>';
$_['entry_clientid'] 			= 'Client ID:<br /><span class="help">Protokół OAuth - client_id</span>';
$_['entry_clientsecret'] 		= 'Drugi klucz (MD5):<br /><span class="help">Symetryczny klucz do szyfrowania komunikacji - secret key</span>';
$_['entry_test']					= 'Sandbox:<br /><span class="help">środowisko testowe</span>';
$_['entry_status']				= 'Status:';
$_['entry_sort_order']			= 'Kolejność:';
$_['entry_failed_status']		= 'Status: Failed<br /><span class="help">&nbsp;</span>';
$_['entry_complete_status']	= 'Status: Completed <br /><span class="help">&nbsp;</span>';
$_['entry_cancelled_status']	= 'Status: Cancelled <br /><span class="help">&nbsp;</span>';
$_['entry_pending_status']		= 'Status: Pending <br /><span class="help">&nbsp;</span>';
$_['entry_reject_status'] 		= 'Status: Rejected <br /><span class="help">&nbsp;</span>';
$_['entry_sent_status'] 		= 'Status: Sent <br /><span class="help">&nbsp;</span>';
$_['entry_returned_status']	= 'Status: Returned <br /><span class="help">&nbsp;</span>';
$_['entry_new_status']			= 'Status: New <br /><span class="help">&nbsp;</span>';
$_['entry_button']				= 'Małe logo:<br /><span class="help">widoczne jako przycisk zatwierdzający płatność</span>';
// Error
$_['error_permission']			= "Uwaga: Brak uprawnień do modyfikacji modułu 'konto PayU'!";
$_['error_merchantposid']		= '* Merchant POS ID wymagane!';
$_['error_signaturekey']		= '* Signature Key wymagany!';
$_['error_clientsecret']		= '* Client Secret wymagany!';
$_['error_posauthkey']			= '* POS Auth Key wymagany!';
$_['error_clientid']			= '* Client ID wymagane!';
$_['error_sort_order']			= '* Kolejność wymagana!'
?>