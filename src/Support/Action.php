<?php

namespace Selene\Modules\RevisionModule\Support;

use MyCLabs\Enum\Enum;

class Action extends Enum
{
    protected const CREATED = 'created';
    protected const UPDATED = 'updated';
    protected const DELEED  = 'deleted';
    protected const AUTO    = 'auto';
}
