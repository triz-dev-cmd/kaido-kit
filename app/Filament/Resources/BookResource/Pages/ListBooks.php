<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;

class ListBooks extends ListRecords implements HasForms
{
    protected static string $resource = BookResource::class;
    //override view
    protected static string $view = 'filament.resources.books.pages.list-books';

    protected array $filters = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BookResource\Widgets\FilterBooksWidget::class,
        ];
    }

    #[On('books-filtered')]
    public function handleFiltered(array $filters): void
    {
        $this->filters = $filters;
        $this->tableFilters = [];

        $this->resetTable();
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if (!empty($this->filters['title'])) {
            $query->where('title', 'like', "%{$this->filters['title']}%");
        }

        if (!empty($this->filters['author'])) {
            $query->where('author', 'like', "%{$this->filters['author']}%");
        }

        if (!empty($this->filters['genre'])) {
            $query->where('genre', $this->filters['genre']);
        }

        return $query;
    }
}
