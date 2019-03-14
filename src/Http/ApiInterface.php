<?php

namespace Pinfort\wavesPHP\Http;

interface ApiInterface
{
    public function get(string $path, ?string $host = null, array $headers = []);
    public function post(string $path, ?array $postData = null, ?string $host = null, array $headers = []);
}