<?php
namespace ElementsKit;
// use \ElementsKit\Elementskit_Widget_Mail_Chimp_Handler as Handler;
class ElementsKit_Widget_Mail_Chimp_Api extends Core\Handler_Api {
    public function config(){
        $this->prefix = 'widget/mailchimp';

    }

    public function get_sendmail(){

        $return = ['success' => [], 'error' => [] ];
		$dataApi 	= Elementskit_Widget_Mail_Chimp_Handler::get_data();

		$token 		= $dataApi['token'];
		$list  		= $dataApi['list'];
		$email  	= $this->request['email'];
	    $firstname  = $this->request['firstname'];
	    $lastname  	= $this->request['lastname'];
	    $phone  	= $this->request['phone'];

		$api_data = explode( '-', $token );		
		// $url = sprintf('https://%s.api.mailchimp.com/3.0/lists/%s/members/', $hosting, $list);
		$url = 'https://'.$api_data[1].'.api.mailchimp.com/3.0/lists/'.$api_data[0].'/members/';
		
		
		$margeFiled = [];
		if(strlen($firstname) > 1):
			$margeFiled['FNAME'] = $firstname;
		endif;
		if(strlen($lastname) > 1):
			$margeFiled['LNAME'] = $lastname;
		endif;
		if(strlen($phone) > 1):
			$margeFiled['PHONE'] = $phone;
		endif;

		$postData = [];
		$postData['email_address'] = $email;
		$postData['status'] =  'subscribed';
		if(sizeof($margeFiled) > 0):
			$postData['merge_fields'] =  $margeFiled;
		endif;
		$postData['status_if_new'] =  'subscribed';

		$response = wp_remote_post( $url, [
			'method' => 'POST',
			'data_format' => 'body',
			'timeout' => 45,
			'headers' => [

							'Authorization' => 'apikey '.$token,
							'Content-Type' => 'application/json; charset=utf-8'
					],
			'body' => json_encode($postData	)
			]
		);

		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
			$return['error'] = "Something went wrong: $error_message";
		} else {
			$return['success'] = $response;
		}

		return $return;
    }
}
//https://us20.api.mailchimp.com/3.0/lists?apikey=24550c8cb06076781d51a80274a52878-us20

?>