<?php

namespace TemplateTheme;

use App\Classes\Theme;
use App\Facades\Hook;
use Filament\Forms\Components\ColorPicker;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use luizbills\CSS_Generator\Generator as CSSGenerator;
use matthieumastadenis\couleur\ColorFactory;
use matthieumastadenis\couleur\ColorSpace;

class TemplateTheme extends Theme
{
    public function boot() {}

    public function getFormSchema(): array
    {
        return [
            ColorPicker::make('appearance_color')
                ->regex('/^#?(([a-f0-9]{3}){1,2})$/i')
                ->label(__('general.appearance_color')),
        ];
    }

    public function getFormData(): array
    {
        return [
            'appearance_color' => $this->getSetting('appearance_color'),
        ];
    }

    public function onActivate(): void
    {
        Hook::add('Frontend::Views::Head', function ($hookName, &$output) {
            $output .= Vite::useHotFile(base_path('plugins').DIRECTORY_SEPARATOR.$this->getInfo('folder').DIRECTORY_SEPARATOR.'vite.hot')
                ->useBuildDirectory('plugin'.DIRECTORY_SEPARATOR.Str::lower($this->getInfo('folder')).DIRECTORY_SEPARATOR.'build')
                ->withEntryPoints(['resources/css/app.css'])
                ->toHtml();

            if ($appearanceColor = $this->getSetting('appearance_color')) {
                $oklch = ColorFactory::new($appearanceColor)->to(ColorSpace::OkLch);
                $css = new CSSGenerator;
                $css->root_variable('p', "{$oklch->lightness}% {$oklch->chroma} {$oklch->hue}");

                $output .= <<<HTML
					<style>
						{$css->get_output()}
					</style>
				HTML;
            }
        });
    }
}
