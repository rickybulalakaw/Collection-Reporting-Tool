<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class MessageTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Eloquent, Query Builder or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder
     */
    public function datasource(): Builder
    {
        return DB::table('messages')
        ->join('users', 'messages.user_id', '=', 'users.id')
        ->where('messages.recipient_user_id', auth()->user()->id)
        ->select('messages.*', 'users.name as user_name', 'users.last_name as user_last_name')
        ->orderBy('messages.created_at', 'desc');
        // ->get();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            // ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            // ->addColumn('deleted_at_formatted', fn ($model) => Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s'))
            // ->addColumn('entity')

           /** Example of custom column using a closure **/
            // ->addColumn('entity_lower', fn ($model) => strtolower(e($model->entity)))

            // ->addColumn('entity_id')
            ->addColumn('id')
            ->addColumn('message')
            // ->addColumn('message_id')
            // ->addColumn('recipient_user_id')
            // ->addColumn('status')
            ->addColumn('subject')
            // ->addColumn('updated_at_formatted', fn ($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('user_name')
            ->addColumn('user_last_name');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            // Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')
            //     ->sortable(),

            // Column::make('Entity', 'entity')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Entity id', 'entity_id'),
            // Column::make('Id', 'id'),
            Column::make('First Name', 'user_name' )
                ->sortable()
                ->searchable(),
            Column::make('Last Name', 'user_last_name')
                ->sortable()
                ->searchable(),
            Column::make('Subject', 'subject')
                ->sortable()
                ->searchable(),
            Column::make('Message', 'message')
                ->sortable()
                ->searchable(),

            // Column::make('Message id', 'message_id'),
            // Column::make('Recipient user id', 'recipient_user_id'),
            // Column::make('Status', 'status'),
        

            // Column::make('Updated at', 'updated_at_formatted', 'updated_at')
            //     ->sortable(),

        
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::datetimepicker('created_at'),
            // Filter::datetimepicker('deleted_at'),
            // Filter::inputText('entity')->operators(['contains']),
            Filter::inputText('user_name')->operators(['contains']),
            Filter::inputText('user_last_name')->operators(['contains']),
            Filter::inputText('subject')->operators(['contains']),
            Filter::inputText('message')->operators(['contains']),
            // Filter::datetimepicker('updated_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
