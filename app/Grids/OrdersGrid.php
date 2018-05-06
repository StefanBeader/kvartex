<?php

namespace App\Grids;

use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderStatus;
use App\User;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\IdFieldConfig;
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

class OrdersGrid
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
        return (new Order())
            ->newQuery()
            ->orderBy('created_at', 'DESC');
    }

    public static function gridInit($query)
    {

# Instantiate & Configure Grid
        return new Grid(
            (new GridConfig)
                ->setDataProvider(new EloquentDataProvider($query))
                ->setName('orders_grid')
                ->setPageSize(10)
                ->setColumns([
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Broj')
                    ,
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Stauts')
                        ->setCallback(function ($val) {
                            $statusCode = OrderStatus::where('order_id', $val)->first()->status_code;
                            if ($statusCode == 1) {
                                return "<span class='glyphicon glyphicon-stop alert-success'></span>";
                            }else {
                                return "<span class='glyphicon glyphicon-stop alert-danger'></span>";
                            }
                        })
                    ,
                    (new FieldConfig)
                        ->setName('user_id')
                        ->setLabel('Korisnik')
                        ->setCallback(function ($val) {
                            return User::find($val)->name;
                        })
                        ->addFilter(
                            (new FilterConfig())
                                ->setName('user_id')
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('currency_id')
                        ->setLabel('Valuta')
                        ->setCallback(function ($val) {
                            return Currency::getName($val);
                        })
                        ->addFilter(
                            (new SelectFilterConfig)
                                ->setName('currency_id')
                                ->setOperator(FilterConfig::OPERATOR_EQ)
                                ->setOptions(Currency::getOptions())
                                ->setSubmittedOnChange(true)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('amount')
                        ->setLabel('Vrednost')
                    ,
                    (new FieldConfig)
                        ->setName('order_type_id')
                        ->setLabel('Vrsta')
                        ->setCallback(function ($val) {
                            if ($val === Order::BUY) {
                                return __('Kupovina');
                            } elseif ($val === Order::SELL) {
                                return __('Prodaja');
                            }
                        })
                        ->addFilter(
                            (new SelectFilterConfig)
                                ->setName('order_type_id')
                                ->setOperator(FilterConfig::OPERATOR_EQ)
                                ->setOptions([
                                    1 => __('Kupovina'),
                                    2 => __('Prodaja')
                                ])
                                ->setSubmittedOnChange(true)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('created_at')
                        ->setLabel('Datum')
                        ->setCallback(function ($val) {
                            return $val->format('d-m-Y');
                        })
                    ,
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Akcije')
                        ->setCallback(function ($val) {
                            return "<a href='/order/{$val}'><span class='glyphicon glyphicon-eye-open'></span></a>";
                        })
                    ,
                ])
                # Setup additional grid components
                ->setComponents([
                    # Renders table header (table>thead)
                    (new THead)
                        # Setup inherited components
                        ->setComponents([
                            # Add this if you have filters for automatic placing to this row
                            new ColumnHeadersRow,
                            new FiltersRow,
                            # Row with additional controls
                            (new OneCellRow)
                                ->setComponents([
                                    # Control for specifying quantity of records displayed on page
                                    (new RecordsPerPage)
                                        ->setVariants([
                                            10,
                                            25,
                                            50
                                        ])
                                    ,
                                    # Submit button for filters.
                                    # Place it anywhere in the grid (grid is rendered inside form by default).
                                    (new HtmlTag)
                                        ->setTagName('button')
                                        ->setAttributes([
                                            'type' => 'submit',
                                            # Some bootstrap classes
                                            'class' => 'btn btn-primary'
                                        ])
                                        ->setContent('Filter')
                                ])
                                # Components may have some placeholders for rendering children there.
                                ->setRenderSection(THead::SECTION_BEGIN)
                        ])
                    ,
                    # Renders table footer (table>tfoot)
                    (new TFoot)

                ])
        );
    }
}