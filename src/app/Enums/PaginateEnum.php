<?php

namespace App\Enums;

enum PaginateEnum: string
{
    const DEFAULT_PAGE = 1;

    const DEFAULT_PER_PAGE = 10;

    const DEFAULT_SORT = 'id';

    const DEFAULT_DIRECTION = self::DESC_DIRECTION;

    const DEFAULT_PAGINATE = true;

    const DESC_DIRECTION = 'desc';

    const ASC_DIRECTION = 'asc';

    const DIRECTION = [
        self::ASC_DIRECTION,
        self::DESC_DIRECTION,
    ];
}
