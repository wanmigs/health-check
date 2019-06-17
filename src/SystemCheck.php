<?php

namespace wanmigs\HealthCheck;

class SystemCheck
{
    public $buildPath = '';

    public function getStatus()
    {
        return [
            "status" => 'OK',
            "timestamp" => date("Y-m-d H:i:s", time()),
            "instance-id" => $_SERVER['HTTP_HOST']
        ];
    }

    public function getPhpInfo()
    {
        return [
            "timestamp" => date("Y-m-d H:i:s", time()),
            "instance-id" => $_SERVER['HTTP_HOST'],
            'php-version' => 'php' . (float)phpversion(),
            'php-modules' => get_loaded_extensions(),
        ];
    }

    public function getReleaseInfo()
    {
        $file = getenv('GIT_BUILD_FILE_PATH') ?: $this->buildPath;

        if (! file_exists($file)) {
            return [
                'git-status' => 'UNKNOWN'
            ];
        }

        $data = json_decode(file_get_contents($file), TRUE);

        return $data;
    }

    public function setBuildPath($path = '')
    {
        $this->buildPath = $path;
    }
}
