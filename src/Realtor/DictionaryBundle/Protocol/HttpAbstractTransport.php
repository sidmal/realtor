<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.03.14
 * Time: 17:45
 */

namespace Realtor\DictionaryBundle\Protocol;

use Guzzle\Http\Client;

class HttpAbstractTransport
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var null
     */
    private $logger;

    public function __construct()
    {
        $this->options = array();

        $this->logger = null;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        $httpClient = new Client();

        if($this->getOptions()){
            $httpClient->setConfig($this->getOptions());
        }

        return $httpClient;
    }

    /**
     * @param string $optionKey
     * @param string $optionValue
     * @return $this
     */
    public function setOption($optionKey, $optionValue)
    {
        $this->options[$optionKey] = $optionValue;

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach($options as $optionKey => $optionValue){
            $this->setOption($optionKey, $optionValue);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function setHeader($headerKey, $headerValue)
    {
        $this->headers[$headerKey] = $headerValue;

        return $this;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function getLogger()
    {
        return $this->logger;
    }
} 