<?php

namespace App\Kernel;

class Request
{
    private ?string $method;
    private ?string $url;
    private ?string $ip;
    private array $parameters = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = $_SERVER['PATH_INFO'] ?? '/';
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->prepareParams();
    }

    private function prepareParams()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') {
            $params = $_REQUEST;
        }
        elseif (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
            $params = $_POST;
        }

        $this->parameters = filter_var_array($params ?? [], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): static
    {
        $this->method = $method;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;
        return $this;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;
        return $this;
    }
}
