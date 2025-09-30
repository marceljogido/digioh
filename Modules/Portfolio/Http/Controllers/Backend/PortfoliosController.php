<?php

namespace Modules\Portfolio\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class PortfoliosController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Portfolios';

        // module name
        $this->module_name = 'portfolios';

        // directory path of the module
        $this->module_path = 'portfolio::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Portfolio\Models\Portfolio";
    }

}
