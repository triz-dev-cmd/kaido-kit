<?php

namespace App\Filament\Resources\BookResource\Widgets;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class FilterBooksWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.book-resource.widgets.filter-books-widget';

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->placeholder('Search by title')
                    ->maxLength(255),
                TextInput::make('author')
                    ->placeholder('Search by author')
                    ->maxLength(255),
                Select::make('genre')
                    ->placeholder('Select genre')
                    ->options([
                        'fiction' => 'Fiction',
                        'non-fiction' => 'Non-Fiction',
                        'sci-fi' => 'Science Fiction',
                        'biography' => 'Biography',
                    ]),
            ])
            ->statePath('data');
    }

    public function filter(): void
    {
        $this->dispatch('books-filtered', filters: $this->form->getState());
    }

    public function resetFilter(): void
    {
        $this->form->fill();
        $this->dispatch('books-filtered', filters: []);
    }
}
