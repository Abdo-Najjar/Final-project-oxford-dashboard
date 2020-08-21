<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SectionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Section::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/section');
        CRUD::setEntityNameStrings('section', 'sections');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'course_type_id',
            'label' => 'Course type',
            'type' => 'select',
            'entity' => 'courseType',
            'attribute' => 'name',

        ]);
        CRUD::setFromDb(); // columns
        $this->crud->orderColumns(['name', 'course_type_id']);
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
        CRUD::setValidation(SectionRequest::class);
        CRUD::addField([
            'name' => 'course_type_id',
            'label' => 'Course type',
            'type' => 'select',
            'entity' => 'courseType',
            'attribute' => 'name',
            'wrapperAttributes' => [
                'class' => 'col-md-6'
            ],
        ]);
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'select_from_array',
            'options' => Section::getTeachers($this->crud->getCurrentEntryId()),
            'wrapperAttributes' => [
                'class' => 'col-md-6'
            ],
        ]);
        CRUD::setFromDb(); // fields
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
