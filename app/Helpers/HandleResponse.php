<?php

if (!function_exists("json_success")) {
    /**
     * @param string $message Error message
     * @param string $code Optional custom error code
     * @param string | array $data Optional data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Http\JsonResponse
     */
    function json_response($message, $status = 500, $code = "", $data = "", $extraHeaders = [])
    {
        $response = [
            "status" => $status,
            "data" => $message
        ];
        if ($code) $response['code'] = $code;
        if ($data) $response['data'] = $data;
        $headers = array_merge(["Content-type" => "application/json"], $extraHeaders);
        return response()->json($response, $status, $headers);
    }
}


if (!function_exists("parse_extra")) {
    /**
     * @param string | array $data Optional data
     * @param string $type
     * @return string
     */
    function parse_extra($data = null, $type = 'in')
    {
        try {
            if ($type === 'in') {
                $data = json_encode($data);
            }
            if ($type === 'out') {
                $data = json_decode($data, 1);
            }
            return $data;
        } catch (Exception $e) {
            return '';
        }
    }
}

if (!function_exists("parse_images")) {
    /**
     * @param string | array $data Optional data
     * @param string $type
     * @return string
     */
    function parse_images($data = [])
    {
        try {
            $raw = [];

            foreach ($data as $datum) {
                $raw[] = $datum['id'];
            }
            return implode(',', $raw);
        } catch (Exception $e) {
            return '';
        }
    }
}

if (!function_exists("wrapper_extra")) {
    /**
     * @param string | array $data Optional data
     * @param string $type
     * @return string
     */
    function wrapper_extra($data)
    {
        try {
            if ($data->extra) {
                $data->extra = json_decode($data->extra, 1);
            }
            return $data;
        } catch (Exception $e) {
            return $data;
        }
    }
}




