<?php

namespace FossHaas\Consent\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CookieDetails extends Component implements HasForms, HasInfolists
{
  use InteractsWithForms, InteractsWithInfolists;

  public array $data = [];

  public function mount($cookies): void
  {
    $this->data = ["cookies" => $cookies];
  }

  public function cookiesInfolist(Infolist $infolist): Infolist
  {
    return $infolist
      ->state($this->data)
      ->schema([
        Section::make(__('Technische Details'))
          ->collapsed()
          ->compact()
          ->schema([
            RepeatableEntry::make('cookies')
              ->hiddenLabel(true)
              ->columns(3)
              ->schema([
                TextEntry::make('type')
                  ->label(__('Typ'))
                  ->formatStateUsing(fn (string $state): string => match ($state) {
                    'cookie' => __('Cookie'),
                    'local_storage' => __('Local Storage'),
                    'session_storage' => __('Session Storage'),
                  }),
                TextEntry::make('name')
                  ->label(__('Name'))
                  ->extraAttributes(['class' => 'font-mono']),
                TextEntry::make('duration')
                  ->label(__('Laufzeit')),
                TextEntry::make('content')
                  ->label(__('Daten'))
                  ->columnSpan(3),
                TextEntry::make('purpose')
                  ->label(__('Zweck'))
                  ->columnSpan(3),
                TextEntry::make('legalBasis')
                  ->label(__('Rechtsgrundlage'))
                  ->columnSpan(3)
              ])
          ])
      ]);
  }

  public function render(): View
  {
    return view('consent::livewire.cookie-details');
  }
}
