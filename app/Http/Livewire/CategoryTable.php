<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Category;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Nom Catégorie", "label_category")
                ->sortable()
                ->searchable(),
            Column::make("Créée le", "created_at")
            ->sortable()
        ];
    }
}
