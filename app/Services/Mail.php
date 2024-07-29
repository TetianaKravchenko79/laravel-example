<?php
namespace App\Services;

use App\Services\GuzzleBase;

class Mail extends GuzzleBase {

    public $message;
    public $contact;
	public $emailTo;



	public function __construct() {
		$this->emailTo = config('app.adminemail');
	 }
 

	public function getUrl() {
       return 'http://api.25one.com.ua/api_mail.php';
	}

	public function getParams() {
       return [
          'email_to' => $this->emailTo,
          'title' => 'Message from site - ' . date('d-m-Y H:i:s'),
          'message' =>  $this->message . '<br>' . $this->contact,
       ];
	}

	public function funcSend($message, $contact) {
		$this->message = $message;
	    $this->contact = $contact;

	    return $this->funcGet();
	}

}

?>
