<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

namespace Myth\Support\Logger\Providers;

use Illuminate\Support\ServiceProvider;

class LoggerProvider extends ServiceProvider
{

    /**
     * Register services.
     * @return void
     */
    public function register()
    {

        foreach(glob(__DIR__.'/../Helpers/*.php') as $file){
            require_once($file);
        }
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {

    }
}
