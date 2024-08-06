<?php

namespace FossUndHaas\Consent\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Markdown;
use Illuminate\Contracts\View\View;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Livewire\Component;

class ProviderDetails extends Component implements HasForms, HasInfolists
{
  use InteractsWithForms, InteractsWithInfolists;

  public array $data = [];

  public function mount($provider): void
  {
    $this->data = [...$provider];
    if (isset($this->data['email'])) {
      $this->data['email'] = '[' . $this->data['email'] . '](mailto:' . $this->data['email'] . ')';
    }
    if (isset($this->data['phone'])) {
      $this->data['phone'] = '[' . $this->formatPhone($this->data['phone']) . '](tel:' . $this->data['phone'] . ')';
    }
    foreach (['privacyPolicy', 'imprint', 'contact'] as $field) {
      if (isset($this->data[$field]) && substr($this->data[$field], 0, 1) === '/') {
        $this->data[$field] = url($this->data[$field]);
      }
    }
  }

  protected function formatPhone(string $phone): string
  {
    $phoneUtil = PhoneNumberUtil::getInstance();
    $parsed = $phoneUtil->parse($phone);
    return $phoneUtil->format($parsed, PhoneNumberFormat::INTERNATIONAL);
  }

  public function providerInfolist(Infolist $infolist): Infolist
  {
    return $infolist
      ->state($this->data)
      ->schema([
        Section::make($this->data['name'])
          ->description($this->data['address'])
          ->compact()
          ->collapsed()
          ->columns(3)
          ->schema([
            TextEntry::make('email')
              ->label(__('E-Mail-Adresse'))
              ->columnSpan(2)
              ->hidden(fn (?string $state) => empty($state))
              ->markdown(),
            TextEntry::make('phone')
              ->label(__('Telefonnummer'))
              ->hidden(fn (?string $state) => empty($state))
              ->markdown(),
            TextEntry::make('privacyPolicy')
              ->label(__('Datenschutz'))
              ->hidden(fn (?string $state) => empty($state))
              ->columnSpan(3)
              ->markdown(),
            TextEntry::make('imprint')
              ->label(__('Impressum'))
              ->hidden(fn (?string $state) => empty($state))
              ->columnSpan(3)
              ->markdown(),
            TextEntry::make('contact')
              ->label(__('Kontaktformular'))
              ->hidden(fn (?string $state) => empty($state))
              ->columnSpan(3)
              ->markdown(),
          ])
      ]);
  }

  public function render(): View
  {
    return view('consent::livewire.provider-details');
  }
}
