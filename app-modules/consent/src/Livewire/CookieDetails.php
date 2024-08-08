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
use FossHaas\Consent\CookieType;
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
              ->columns(4)
              ->schema([
                TextEntry::make('type')
                  ->label(__('Typ'))
                  ->formatStateUsing(fn (string $state): string => CookieType::from($state)->label()),
                TextEntry::make('name')
                  ->label(__('Name'))
                  ->columnSpan(2)
                  ->extraAttributes(['class' => 'font-mono']),
                TextEntry::make('duration')
                  ->label(__('Laufzeit')),
                TextEntry::make('content')
                  ->label(__('Daten'))
                  ->columnSpan(4),
                TextEntry::make('purpose')
                  ->label(__('Zweck'))
                  ->columnSpan(4),
                TextEntry::make('legalBasis')
                  ->label(__('Rechtsgrundlage'))
                  ->columnSpan(4)
              ])
          ])
      ]);
  }

  public function render(): View
  {
    return view('consent::livewire.cookie-details');
  }
}
