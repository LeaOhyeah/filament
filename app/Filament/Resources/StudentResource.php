<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;


    // custom label singular
    public static function getModelLabel(): string
    {
        return 'Siswa';
    }
    // custom label model plural
    public static function getPluralModelLabel(): string
    {
        return 'Daftar Siswa';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('nis')->label('NIS')->required(),
                    TextInput::make('name')->label('Nama')->required(),
                    Select::make('gender')->label('Jenis Kelamin')->options([
                        "Male" => "Male",
                        "Female" => "Female",
                    ]),
                    DatePicker::make('birthday')->label('Tanggal Lahir')->required(),
                    Select::make('religion')->label('Agama')->options([
                        "Islam" => "Islam",
                        "Katolik" => "Katolik",
                        "Protestan" => "Protestan",
                        "Hindu" => "Hindu",
                        "Buddha" => "Buddha",
                        "Khonghuchu" => "Khonghuchu",
                    ]),
                    TextInput::make('contact')->label('Kontak')->required(),
                    FileUpload::make('profile')->label('Foto Profil')->directory('students'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->label('NIS'),
                    TextColumn::make('name')->label('Nama'),
                    TextColumn::make('gender')->label('Jenis Kelamin'),
                    TextColumn::make('birthday')->label('Tanggal Lahir'),
                    TextColumn::make('religion')->label('Agama'),
                    TextColumn::make('contact')->label('Kontak'),
                    ImageColumn::make('profile')->label('Foto Profil'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
