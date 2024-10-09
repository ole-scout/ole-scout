<?php

namespace FossHaas\Courses\Filament\Resources;

use FossHaas\Courses\Filament\Resources\CourseResource\Pages;
use FossHaas\Courses\Filament\Resources\CourseResource\RelationManagers;
use FossHaas\Courses\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use FossHaas\Courses\Enums\Access;
use FossHaas\Courses\Filament\Resources\CourseResource\RelationManagers\ActivitiesRelationManager;
use FossHaas\Courses\Filament\Resources\CourseResource\RelationManagers\ActivityGroupsRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->live()
            ->columns(5)
            ->schema([
                Forms\Components\Grid::make()
                    ->columnSpan(4)
                    ->columns(5)
                    ->schema([
                        Forms\Components\Select::make('language')
                            ->options(config('support.locales'))
                            ->default(config('app.locale'))
                            ->selectablePlaceholder(false)
                            ->required(),
                        Forms\Components\Select::make('course_group_id')
                            ->columnSpan(4)
                            ->relationship(
                                name: 'courseGroup',
                                modifyQueryUsing: fn(Builder $query) => $query->orderBy('slug')
                            )
                            ->allowHtml()
                            ->getOptionLabelFromRecordUsing(
                                fn($record) => strtoupper($record->slug) . ': ' . $record->title
                            )
                            ->placeholder(__('No course group')),
                        Forms\Components\TextInput::make('title')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\Grid::make()
                            ->columnSpanFull()
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('author')
                                    ->label(__('Author')),
                                Forms\Components\TextInput::make('clearance')
                                    ->label(__('Clearance')),
                            ]),
                    ]),
                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required(),
                        Forms\Components\ColorPicker::make('color')
                            ->required(),
                        Forms\Components\FileUpload::make('icon')
                            ->image()
                            ->extraAttributes(fn(Get $get) => [
                                'class' => '[&:not(:hover)_.filepond--action-revert-item-processing]:!opacity-0 [&:not(:hover)_.filepond--action-remove-item]:!opacity-0 [&_.filepond--image-preview]:bg-[var(--color)] [&_.filepond--image-bitmap>canvas]:m-2 [&_.filepond--image-bitmap>canvas]:size-[calc(100px-1rem)] [&_.filepond--image-preview-wrapper]:border-2 [&_.filepond--image-preview-wrapper]:border-white dark:[&_.filepond--image-preview-wrapper]:border-gray-800 [&_.filepond--image-preview-overlay-success]:hidden [&_.filepond--image-preview-overlay-idle]:hidden',
                                'x-bind:style' => '{\'--color\': $wire.data.color}',
                                'style' => '--color: ' . $get('color'),
                            ])
                            ->imageResizeMode('contain')
                            ->imageResizeUpscale(false)
                            ->imageResizeTargetWidth('256')
                            ->imageResizeTargetHeight('256')
                            ->avatar()
                            ->disk('fake')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => data_uri($file)
                            )
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make()
                    ->label(__('Access & Visibility'))
                    ->columnSpan(2)
                    ->columns(1)
                    ->schema([
                        Forms\Components\Checkbox::make('is_published')
                            ->label(__('Published'))
                            ->helperText(__('Unpublished courses are only visible to administrators.')),
                        Forms\Components\Radio::make('access')
                            ->hiddenLabel()
                            ->options(Access::class)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            // ->reorderable('order_column')
            ->groups([
                Tables\Grouping\Group::make('courseGroup.slug')
                    ->label(__('Course group'))
                    ->titlePrefixedWithLabel(false)
                    ->getTitleFromRecordUsing(
                        fn($record) => $record->courseGroup ? (
                            strtoupper($record->courseGroup->slug)
                        ) : __('N/A')
                    )
                    ->getDescriptionFromRecordUsing(
                        fn($record) => $record->courseGroup ? (
                            $record->courseGroup->title
                        ) : __('No course group')
                    ),
            ])
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('language')
                        ->badge()
                        ->color('gray')
                        ->extraAttributes(['class' => 'uppercase'])
                        ->grow(false),
                    Tables\Columns\ImageColumn::make('icon')
                        ->extraImgAttributes(fn(Course $record) => [
                            'style' => "background-color: {$record->color}",
                            'class' => 'p-2'
                        ])
                        ->circular()
                        ->grow(false),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('slug')
                            ->extraAttributes(['class' => 'uppercase'])
                            ->weight(FontWeight::SemiBold)
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('title')
                            ->searchable()
                            ->sortable(),
                    ]),
                    Tables\Columns\TextColumn::make('activities_count')
                        ->counts('activities')
                        ->formatStateUsing(fn($state) => trans_choice(':count activity|:count activities', $state))
                        ->badge('yellow')
                        ->grow(false),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('is_published')
                            ->icon(fn($state) => $state ? 'fluentui-checkmark-circle-16' : 'fluentui-dismiss-circle-16-o')
                            ->formatStateUsing(fn($state) => $state ? __('Published') : __('Unpublished'))
                            ->color(fn($state) => $state ? 'success' : 'gray')
                            ->badge()
                            ->grow(false),
                        Tables\Columns\TextColumn::make('access')
                            ->badge()
                            ->grow(false),
                    ])
                        ->space(2)
                        ->grow(false),
                ]),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label(__('Published courses'))
                    ->placeholder(__('Show all courses'))
                    ->trueLabel(__('Only show published'))
                    ->falseLabel(__('Only show unpublished')),
                Tables\Filters\SelectFilter::make('language')
                    ->multiple()
                    ->options(config('support.locales')),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ActivitiesRelationManager::class,
            ActivityGroupsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
