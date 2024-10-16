<?php

namespace Modules\Faq\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Http\Requests\SaveFaqRequest;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    use HasCrudActions {
        store as public crudStore;
    }
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'faq::admin.name';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'faq::admin.faqs';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFaqRequest::class;

    public function store()
    {

        $this->disableSearchSyncing();

        $entity = $this->getModel()->create(
            $this->getRequest('store')->all()
        );

        $this->searchable($entity);

        $message = trans('admin::messages.resource_created', ['resource' => $this->getLabel()]);

        if (request()->query('exit_flash')) {
            session()->flash('exit_flash', $message);
        }

        if (request()->wantsJson()) {
            return response()->json(
                [
                    'success' => true,
                    'message' => $message,
                    'faq_id' => $entity->id,
                ], 200
            );
        }

        return redirect()->route("{$this->getRoutePrefix()}.index")
            ->withSuccess($message);
    }


    public function create()
    {
        $data = array_merge(
            [$this->getResourceName() => $this->getModel()], $this->getFormData('create'));

        return view("{$this->viewPath}.create", $data);
    }


    public function update($id){

        $entity = Faq::where('id',$id)->first();

        $entity->update(
            $this->getRequest('update')->all()
        );

        $this->searchable($entity);

        $message = trans('admin::messages.resource_updated', ['resource' => $this->getLabel()]);

        if (request()->query('exit_flash')) {
            session()->flash('exit_flash', $message);
        }

        if (request()->wantsJson()) {
            return response()->json(
                [
                    'success' => true,
                    'message' => $message,
                ], 200
            );
        }
    }


    public function edit($id)
    {

        $data = array_merge([$this->getResourceName() => $this->getEntity($id)], $this->getFormData('edit', $id));

        return view("{$this->viewPath}.edit", $data);
    }
}
