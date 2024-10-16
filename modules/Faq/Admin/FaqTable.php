<?php

namespace Modules\Faq\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\Faq\Entities\Faq;
use Yajra\DataTables\Exceptions\Exception;

class FaqTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected array $defaultRawColumns = [
        'publish_status',
    ];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('name', function (Faq $faq) {
                return $faq->name;
            })
            ->addColumn('publish_status', function ($faq) {
                return match ($faq->publish_status) {
                    Faq::PUBLISHED => '<span class="badge badge-success">' . trans('faq::faq.items.form.publish_status.published') . '</span>',
                    Faq::UNPUBLISHED => '<span class="badge badge-danger">' . trans("faq::faq.items.form.publish_status.unpublished") . '</span>',
                };
            });
    }
}
