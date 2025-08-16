<?php

namespace App\Providers;

use App\Forms\Components\VideoUploader;
use App\Livewire\ClientInterface\Home;
use App\Models\Client;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Select::configureUsing(fn (Select $select) => $select->native(false)->inlineLabel());
        SelectFilter::configureUsing(fn (SelectFilter $selectFilter) => $selectFilter->native(false));
        TextInput::configureUsing(fn (TextInput $textInput) => $textInput->inlineLabel());
        Textarea::configureUsing(fn (Textarea $textarea) => $textarea->inlineLabel());
        DatePicker::configureUsing(fn (DatePicker $datePicker) => $datePicker->inlineLabel());
        FileUpload::configureUsing(fn (FileUpload $fileUpload) => $fileUpload->inlineLabel());
        RichEditor::configureUsing(fn (RichEditor $richEditor) => $richEditor->inlineLabel());
        VideoUploader::configureUsing(fn (VideoUploader $videoUploader) => $videoUploader->inlineLabel());

        
        Table::macro('clientData', function () {
            return $this->modifyQueryUsing(function (Builder $query) {
                return $query->where('client_id', request()->user()->client_id);
            });
        }); 

        Model::preventSilentlyDiscardingAttributes();
    }
}
