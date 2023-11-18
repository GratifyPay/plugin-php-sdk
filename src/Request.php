<?php

namespace GratifyPay\PhpSdk;

/**
 * Class Request
 * @package Glatify
 */
class Request
{
    const API_ENDPOINT = '';

    const SANDBOX_API_ENDPOINT = '';

    const TYPE_CONTENT = '';

    const VERSION = "1.3.1";

    private $ch;

    /**
     * @var string
     */
    protected $privateApiKey = '';

    /**
     * @var string
     */
    protected $merchantPublicId;

    /**
     * @var bool
     */
    protected $prod = false;

    /**
     * @var string
     */
    protected $useragent = 'Grafity PHP SDK ' . self::VERSION;

    /**
     * List of errors -
     *
     * @var string[]
     */
    protected $errors = [
        400 => 'Bad Request -- Your request is invalid.',
        401 => 'Unauthorized -- Your API key is wrong.',
        404 => 'Not Found -- The payment request could not be found.',
        500 => 'Internal Server Error -- We had a problem with our server. Try again later.',
    ];

    /**
     * @return bool
     */
    public function isProd(): bool {
        return $this->prod;
    }

    /**
     * @return string
     */
    public function getUseragent(): string {
        return $this->useragent;
    }

    /**
     * @param string useragent
     */
    public function setUseragent(string $useragent): void {
        $this->useragent = $useragent;
    }

    /**
     * Request constructor.
     * @param $merchantPublicId
     * @param $privateApiKey
     * @param bool $prod
     * @throws \Exception
     */
    public function __construct($merchantPublicId, $privateApiKey, bool $prod = false)
    {
        if (!extension_loaded('curl')) {
            throw new \Exception('For work with Glatify Api to need php curl extension');
        }

        $this->merchantPublicId = $merchantPublicId;
        $this->privateApiKey = $privateApiKey;
        $this->prod = $prod;
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
        $endpoint = ($this->prod ? static::API_ENDPOINT : static::SANDBOX_API_ENDPOINT);

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
            'User-Agent: ' . $this->useragent,
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
