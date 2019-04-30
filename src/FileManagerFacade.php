<?php

namespace Techlify\FileManager;

use Illuminate\Support\Facades\Facade;

/**
 * Description of FileManagerFacade
 *
 * @author 
 * @since
 */
class FileManagerFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'file-manager';
    }

}
