<?php

namespace Laravel\Health\Checkers;

use Illuminate\Support\Facades\Cache;
use Laravel\Health\Exceptions\NotWriteableException;

class DirectoryPermissionChecker extends BaseChecker
{
    public function check() : DirectoryPermissionChecker
    {
        try {
            foreach ($this->resources['dirs'] as $directory) {
                $dir =  getcwd() . '/' . $directory;
                if (!is_writable($dir)) {
                    throw new NotWriteableException($dir, $this->resources['messages']['error']);
                }
            }
            $this->makeResponse(null, true);
        } catch (\Exception $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }
}
