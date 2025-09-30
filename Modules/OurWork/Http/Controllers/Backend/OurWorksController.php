<?php

namespace Modules\OurWork\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class OurWorksController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'OurWorks';

        // module name
        $this->module_name = 'ourworks';

        // directory path of the module
        $this->module_path = 'ourwork::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\OurWork\Models\OurWork";
    }

}
