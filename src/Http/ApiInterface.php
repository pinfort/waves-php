<?php

namespace Pinfort\wavesPHP\Http;

/**
 * Interface of api class
 * @package Pinfort\wavesPHP\Http
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Http
 */
interface ApiInterface
{
    /**
     * Do http access with verb GET.
     * @param string $path Path to access. It must be start with slash.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return mixed
     */
    public function get(string $path, ?string $host = null, array $headers = []): array;


    /**
     * Do Http access with verb POST.
     * @param string $path Path to access. It must be start with slash.
     * @param array|null $postData Input Data to post. Key-value style.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return mixed
     */
    public function post(string $path, ?array $postData = null, ?string $host = null, array $headers = []): array;
}
