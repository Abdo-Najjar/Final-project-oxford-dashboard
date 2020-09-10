<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MassMediaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MassMediaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MassMediaCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\MassMedia::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/massmedia');
        CRUD::setEntityNameStrings('massmedia', 'mass_media');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MassMediaRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::field('title')->type('text');
        CRUD::field('description')->type('textarea');
        CRUD::field('url')->type('text');

        CRUD::addField([
            'name' => 'course_type_id',
            'label' => 'Course Type',
            'type' => 'select',
            'entity' => 'courseType',
            'attribute' => 'name',
            'wrapperAttributes' => [
                'class' => 'col-md-6'
            ],
        ]);

        CRUD::addField([
            'name'    => 'type',
            'label'   => 'Type',
            'type'    => 'select_from_array',
            'options' => ['0' => 'Video', '1' => 'Audio'],
            'wrapperAttributes' => [
                'class' => 'col-md-6'
            ],

        ]);

        // CRUD::field([
        //     // select_from_array
        //     'name'    => 'status',
        //     'label'   => 'Status',
        //     // 'type'    => 'select_from_array',
        //     // 'options' => ['draft' => 'Draft (invisible)', 'published' => 'Published (visible)'],
        // ]);
        // course_type_id

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
