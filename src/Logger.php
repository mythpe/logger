<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

namespace Myth\Support;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class Logger
{

    /**
     * @var string log path
     */
    protected $path = 'logs';

    /**
     * file name
     * @var string
     */
    protected $name = 'logger.log';

    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Illuminate\Filesystem\Filesystem|mixed|string
     */
    protected $fs = '';

    /**
     * Logger constructor.
     * @param string $name
     * @param string $path
     */
    public function __construct($name = null, $path = null)
    {
        $path && $this->setPath($path);
        $name && $this->setName($name);
        $this->fs = app(Filesystem::class);
    }

    /**
     * @param $content
     * @param string $name
     * @param string $path
     * @return mixed|string
     */
    public static function log($content, $name = null, $path = null)
    {
        return (new static($name, $path))->createLog($content);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return base_path(rtrim($this->path, '/'));
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = Str::before($name, '.log').".log";
    }

    /**
     * @param $content
     * @return mixed|string
     */
    public function createLog($content)
    {
        $fileName = $this->getFileName($this->name);
        if(!$this->fs->isDirectory($this->getPath())){
            $this->fs->makeDirectory($this->getPath());
        }
        try{
            if(!is_string($content)){
                $content = collect($content)->toJson(JSON_UNESCAPED_UNICODE);
            }
            $content = "[".Carbon::now()."]:".PHP_EOL.$content;
            $this->fs->prepend($fileName, $content.PHP_EOL);
            return $this->fs->get($fileName);
        }
        catch(\Exception $exception){
        }
        return "";
    }

    /**
     * @param $name
     * @return string
     */
    protected function getFileName($name)
    {
        return $this->getPath()."/".ltrim($name, '/');
    }
}