<?php

namespace Gratify\PhpSdk;

/**
 * Class Request
 * @package Glatify
 */
class Request
{
    const API_ENDPOINT = '';

    const SANDBOX_API_ENDPOINT = '';

    const API_US_ENDPOINT = '';

    const SANDBOX_API_US_ENDPOINT = '';

    const TYPE_CONTENT = '';

    /**
     * @var string
     */
    protected $privateApiKey = '';

    /**
     * @var bool
     */
    protected $isLive = false;

    /**
     * @var bool
     */
    protected $isUS = false;

    private $ch;

    /**
     * List of errors -
     *
     * @var string[]
     */
    protected $errors = array(
        400 => 'Bad Request -- Your request is invalid.',
        401 => 'Unauthorized -- Your API key is wrong.',
        404 => 'Not Found -- The payment request could not be found.',
        500 => 'Internal Server Error -- We had a problem with our server. Try again later.',
    );

    /**
     * @var string
     */
    protected $merchantPublicId;

    /**
     * Request constructor.
     * @param $merchantPublicId
     * @param $privateApiKey
     * @param bool $live
     * @param bool $isUS
     * @throws \Exception
     */
    public function __construct($merchantPublicId, $privateApiKey, bool $live = false, bool $isUS = false)
    {
        if (!extension_loaded('curl')) {
            throw new \Exception('For work with Glatify Api to need php curl extension');
        }

        $this->merchantPublicId = $merchantPublicId;
        $this->privateApiKey = $privateApiKey;
        $this->isLive = $live;
        $this->isUS = $isUS;
        $this->ch = curl_init();
    }

    /**
     * @param $type PUT, DELETE, GET, POST
     * @param $path
     * @param array $request
     * @return bool
     * @throws \Exception
     */
    protected function request($type, $path, $request = [])
    {
        $endpoint = $this->isUS
            ? ($this->isLive ? static::API_US_ENDPOINT : static::SANDBOX_API_US_ENDPOINT)
            : ($this->isLive ? static::API_ENDPOINT : static::SANDBOX_API_ENDPOINT);

        curl_setopt($this->ch, CURLOPT_URL, $endpoint . $path);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($this->ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $isJsonRequest = false;
        if (is_object($request)) {
            $isJsonRequest = true;
            $request = json_encode($request);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $request);
        }

        if (!empty($request)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $request);
        }

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->getHeaders($isJsonRequest));

        $result = curl_exec($this->ch);
        $result = !empty($result) ? json_decode($result, true) : null;

        $this->checkError($result);

        return $result;
    }

    /**
     * @param null $response
     * @return void
     * @throws \Exception
     */
    protected function checkError($response = null)
    {
        $error = curl_error($this->ch);
        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if (!empty($error)) {
            throw new \Exception($error);
        } elseif (isset($response['errors']) && is_array($response['errors'])) {
            $message = '';
            foreach ($response['errors'] as $error) {
                $message .= sprintf(
                    "%s: at the: %s, location: %s\n",
                    $error['msg'] ?? '',
                    $error['param'] ?? '',
                    $error['location'] ?? ''
                );
            }
            throw new \Exception($message, $httpCode);
        } elseif (isset($response['errorMessage']) && isset($response['errorCode'])) {
            throw new \Exception($response['errorMessage'], $httpCode);
        } elseif ($httpCode != 200 && $httpCode != 201) {
            $message = isset($this->errors[$httpCode])
                ? $this->errors[$httpCode]
                : 'Error message does not exists.';
            throw new \Exception($message, $httpCode);
        }
    }

    /**
     * @return string[]
     */
    protected function getHeaders($isJsonRequest)
    {
        $headers = [
            'User-Agent: Grafity PHP SDK 1.2.2',
            'Authorization: Basic ' . base64_encode($this->merchantPublicId . ':' . $this->privateApiKey),
        ];

        if ($isJsonRequest) {
            array_push($headers, 'Content-Type: ' . static::TYPE_CONTENT);
        }

        return $headers;
    }

    /**
     *
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}
