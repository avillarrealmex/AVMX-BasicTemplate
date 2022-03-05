class SoapCallWithTimeout
{
    public function executeSoapCall($method, $params)
    {
        try {
            $client = $this->tryGetSoapClient();

            $timeout = ini_get('default_socket_timeout');
            ini_set('default_socket_timeout', 60);//set new timeout value - 60 seconds
            $client->__soapCall($method, $params);//execute SOAP call
            ini_set('default_socket_timeout', $timeout);//revert timeout back
        } catch (\Throwable $e) {
            if (isset($timeout)) {
                ini_set('default_socket_timeout', $timeout);//revert timeout back
            }
        }
    }
    protected function tryGetSoapClient()
    {
        $timeout = ini_get('default_socket_timeout');//get timeout (need to be reverted back afterwards)
        ini_set('default_socket_timeout', 10);//set new timeout value - 10 seconds
        try {
            $client = new \SoapClient($this->wsdl, $this->options);//get SOAP client
        } catch (\Throwable $e) {
            ini_set('default_socket_timeout', 10);//revert back in case of exception
            throw $e;
        }
        $this->iniSetTimeout($timeout);//revert back

        return $client;
    }
}
