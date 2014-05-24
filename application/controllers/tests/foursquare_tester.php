<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Foursquare_tester extends CI_Controller {

	public function index()
	{
		$provider = 'foursquare';
		$provider = $this->oauth2->provider($provider, array(
            'id' => 'VMV4GBOHFFKWK5A5RNDSAQIYIK5IXKJNTRZXB4ZUBVN4HBZ4',
            'secret' => 'LV3THOOXI2NOIH5H4YGDWVSKK4VGKNGP0JDQ40V3F4EKH3P4',
			'redirect_uri' => 'http://localhost/ci',
			'v' => '20131206'
        ));
		
		 if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
            $provider->authorize();
			
        }
        else
        {
            // Howzit?
            try
            {
			
                $token = $provider->access($_GET['code']);

                $user = $provider->get_user_info($token);
				
				$friends = $provider->get_friends($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>Tokens: ";
                var_dump($token);

                echo "\n\nUser Info: ";
				
				$url = 'https://api.instagram.com/v1/users/self/?'.http_build_query(array('access_token' => $token->access_token,));

		var_dump(json_decode(file_get_contents($url)));

                //var_dump($user);
				
				
				
				//echo "\n\nFriends Info: ";
                //var_dump($friends);
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
		
	}
}


