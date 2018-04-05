<?php

namespace App\Grids;

use App\Models\Message;
use App\User;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\SelectFilterConfig;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\TotalsRow;
use Illuminate\Support\Facades\Config;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\FilterConfig;

class MessagesGrid
{

    public static function create()
    {
        $query = static::query();
        return static::gridInit($query);
    }

    # Let's take a Eloquent query as data provider
    # Some params may be predefined, other can be controlled using grid components
    public static function query()
    {
        return (new Message())
            ->newQuery()
            ->where('isRead', '!==', true)
            ->select(['user_id'])
            ->distinct();
    }

    public static function gridInit($query)
    {

# Instantiate & Configure Grid
        return new Grid(
            (new GridConfig)
                # Grids name used as html id, caching key, filtering GET params prefix, etc
                # If not specified, unique value based on file name & line of code will be generated
                ->setName('messages_grid')
                # See all supported data providers in sources
                ->setDataProvider(new EloquentDataProvider($query))
                # Setup caching, value in minutes, turned off in debug mode
                ->setCachingTime(5)
                # Setup table columns
                ->setColumns([
                    (new FieldConfig)
                        ->setName('user_id')
                        ->setLabel('Korisnik')
                        ->setCallback(function ($val) {
                            return User::find($val)->name;
                        })
                    ,
                    (new FieldConfig)
                        ->setName('user_id')
                        ->setLabel('Broj Poruka')
                        ->setCallback(function ($val) {
                            return Message::countUnreadMessagesFromUser($val);
                        })
                    ,
                    (new FieldConfig)
                        ->setName('user_id')
                        ->setLabel('Procitaj')
                        ->setCallback(function ($val) {
                            return "<a href='/dashboardUserMessages?user_id={$val}'><span class='glyphicon glyphicon-envelope'></span></a>";
                        })
                    ,
                ])
                # Setup additional grid components
                ->setComponents([
                    (new THead),
                    # Renders table footer (table>tfoot)
                    (new TFoot)

                ])
        );
    }
}