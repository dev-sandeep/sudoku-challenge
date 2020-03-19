<?php

/**
 * responsible for getting quotes from different providers
 * @author Sandeep G
 * @since 20200319
 */

define('BANK_URL', 'http://demo9084693.mockable.io/bank');
define('CURL_URL', 'http://demo9084693.mockable.io/insurance');

class Insurance
{
    private $default_providers = ['bank', 'insurance-company'];

    public function quote($providers = null)
    {
        //setting the value
        if ($providers && is_array($providers)) {
            $providers = $providers; //if the param is an array
        } else if ($providers && !is_array($providers)) {
            $providers = [$providers]; //if the param is not an array
        } else { //nothing is passed
            $providers = $this->default_providers;
        }

        $quote = array();
        for ($i = 0; $i < count($providers); $i++) {
            $quote[$providers[$i]] = $this->get_quote($providers[$i]);
        }

        return $quote;
    }

    private function get_quote($provider = null)
    {
        switch ($provider) {
            case 'bank':
                return $this->get_content(BANK_URL);
            case 'insurance-company':
                return $this->curl_call(CURL_URL);
            default:
                return NULL;
        }
    }

    private function curl_call($url)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => array(
                    'month' => 3,
                )
            ));
            $prices = json_decode(curl_exec($curl));
            curl_close($curl);

            return $prices;
        } catch (Exception $e) {
            error_log("Error occurred while making a curl request " . $e);
        }
    }

    private function get_content($url)
    {
        try {
            return file_get_contents($url);
        } catch (Exception $exception) {
            error_log("Error occurred while getting file contents " . $exception); //or log in to logger
        }
    }
}

$insurance = new Insurance();
$quote = $insurance->quote();

var_dump($quote);
