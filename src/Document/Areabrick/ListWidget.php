<?php

namespace Pimcore\Bundle\WidgetBundle\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document\Editable\Area\Info;

class ListWidget extends AbstractTemplateAreabrick implements EditableDialogBoxInterface
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'WerStreamt.es List Widget';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Mit dem Widget kannst du Verfügbarkeitsinformationen zu Filmen und Serien direkt auf deiner Webseite anzeigen.';
    }

    /**
     * @return mixed
     */
    public function getTemplateLocation(): string
    {
        return static::TEMPLATE_LOCATION_BUNDLE;
    }

    /**
     * @param $area
     * @param $info
     * @return EditableDialogBoxConfiguration
     */
    public function getEditableDialogBoxConfiguration($area, $info): EditableDialogBoxConfiguration
    {

        $config = new EditableDialogBoxConfiguration();
        $config->setReloadOnClose(true);

        $lifetime = (3600 * 16);
        $cacheKey = 'providers';
        $cachData = \Pimcore\Cache::load($cacheKey);
        if (!$cachData) {

            $providers = @file_get_contents('https://www.werstreamt.es/widgets/filter/providers/');

            if ($providers) {
                $providers = @json_decode($providers, true);
                if (is_array($providers)) {
                    $providers = array_map(function ($provider) {
                        return [$provider['alias'], $provider['title']];
                    }, $providers);
                }
            }

            \Pimcore\Cache::save($providers, $cacheKey, ['providers'], $lifetime);
        } else {
            $providers = $cachData;
        }

        $config->setItems([
            [
                'type' => 'input',
                'label' => 'URL zur Liste',
                'name' => 'url'
            ],
            [
                'type' => 'select',
                'name' => 'layout',
                'label' => 'Darstellung wählen',
                'config' => [
                    'store' => [
                        [1, 'Einspaltig'],
                        [2, 'Zweispaltig']
                    ],
                    'defaultValue' => 1
                ]
            ],
            [
                'type' => 'numeric',
                'name' => 'limit',
                'label' => 'Wie viele Einträge sollen angezeigt werden?',
                'config' => [
                    'minValue' => 1,
                    'maxValue' => 20
                ]
            ],
            [
                'type' => 'checkbox',
                'name' => 'showNumbers',
                'label' => 'Nummerierung anzeigen?'
            ],
            [
                'type' => 'multiselect',
                'name' => 'providers',
                'label' => 'Anbieter auswählen',
                'config' => [
                    'store' => is_array($providers) ? $providers : []
                ]
            ]
        ]);

        return $config;

    }

    /**
     * @return bool
     */
    public function needsReload(): bool
    {
        return true;
    }
}
