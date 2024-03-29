<?php
final class ipinfodb {

    protected $errors = array();
    protected $showTimezone = false;
    protected $service = 'api.ipinfodb.com';
    protected $version = 'v3/ip-city';
    protected $apiKey = 'ef272dcfee4b8be8247982410b3ad67c8d643ddb9add18078c91adcc3ccb5d3f';

    public function __construct() {
        
    }

    public function __destruct() {
        
    }

    public function setKey($key) {
        if (!empty($key))
            $this->apiKey = $key;
    }

    public function showTimezone() {
        $this->showTimezone = true;
    }

    public function getError() {
        return implode("\n", $this->errors);
    }

    public function getGeoLocation($host) {
        $ip = @gethostbyname($host);
        if (preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip)) {
            $xml = @file_get_contents('http://' . $this->service . '/' .$this->version . '/' . '?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');
   

            try {
                $response = @new SimpleXMLElement($xml);
                foreach ($response as $field => $value) {
                    $result[(string) $field] = (string) $value;
                }
                return $result;
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();
                return;
            }
        }
        $this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
        return;
    }

}

$ipinfodb = new ipinfodb;
$ipinfodb->setKey('ef272dcfee4b8be8247982410b3ad67c8d643ddb9add18078c91adcc3ccb5d3f');

?>