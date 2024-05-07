<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
  protected static ?string $model = Department::class;
  protected static ?string $navigationLabel = 'Departments';
  protected static ?string $modelLabel = 'Departments';
  protected static ?string $navigationIcon = 'heroicon-o-home-modern';
  protected static ?string $navigationGroup = 'System Management';
  protected static ?int $navigationSort = 4;


  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),

        Tables\Columns\TextColumn::make('employees_count')
          ->label('Employees Quantity')
          ->counts('employees'),

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
        Infolists\Components\Section::make('Department Info')
          ->schema([
            Infolists\Components\TextEntry::make('name')
              ->label('Department Name'),

            Infolists\Components\TextEntry::make('employees_count')
              ->label('Quantity')
              ->state(function (Model $record): int {
                return $record->employees()->count();
              }),
          ])
          ->columns(['sm' => 2]),
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
      'index' => Pages\ListDepartments::route('/'),
      'create' => Pages\CreateDepartment::route('/create'),
      //'view' => Pages\ViewDepartment::route('/{record}'),
      'edit' => Pages\EditDepartment::route('/{record}/edit'),
    ];
  }
}
