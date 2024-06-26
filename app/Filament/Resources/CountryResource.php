<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
  protected static ?string $model = Country::class;
  protected static ?string $navigationLabel = 'Countries';
  protected static ?string $modelLabel = 'Employees Country';
  protected static ?string $navigationIcon = 'heroicon-o-flag';
  protected static ?string $navigationGroup = 'System Management';
  protected static ?int $navigationSort = 1;


  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255)
          ->columnSpan(['md' => 2]),

        Forms\Components\TextInput::make('code')
          ->required()
          ->maxLength(3),

        Forms\Components\TextInput::make('phone_code')
          ->required()
          ->numeric()
          ->maxLength(5),
      ])
      ->columns(4);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable()
          ->sortable(),

        Tables\Columns\TextColumn::make('code')
          ->searchable()
          ->sortable(),

        Tables\Columns\TextColumn::make('phone_code')
          ->numeric()
          ->searchable()
          ->sortable(),

        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),

        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function infolist(Infolist $infolist): Infolist
  {
    return $infolist
      ->schema([
        Infolists\Components\Section::make('Country Info')
          ->schema([
            Infolists\Components\TextEntry::make('name')
              ->label('Country'),

            Infolists\Components\TextEntry::make('code')
              ->label('Code'),

            Infolists\Components\TextEntry::make('phone_code')
              ->label('Phone Code'),
          ])
          ->columns(['md' => 3]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListCountries::route('/'),
      'create' => Pages\CreateCountry::route('/create'),
      'edit' => Pages\EditCountry::route('/{record}/edit'),
    ];
  }
}
