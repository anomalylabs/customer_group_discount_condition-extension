<?php namespace Anomaly\CustomerGroupDiscountFilterExtension;

use Anomaly\CustomerGroupDiscountFilterExtension\Command\GetColumnValue;
use Anomaly\CustomerGroupDiscountFilterExtension\Command\GetFormBuilder;
use Anomaly\CustomerGroupDiscountFilterExtension\Command\ValidateDiscountFilter;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Anomaly\DiscountsModule\Filter\Contract\FilterInterface;
use Anomaly\DiscountsModule\Filter\Extension\FilterExtension;
use Anomaly\DiscountsModule\Filter\Extension\Form\FilterExtensionFormBuilder;
use Anomaly\CustomersModule\Product\Contract\ProductInterface;

/**
 * Class CustomerGroupDiscountFilterExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CustomerGroupDiscountFilterExtension
 */
class CustomerGroupDiscountFilterExtension extends FilterExtension
{

    /**
     * This extension provides the category
     * filter for the discounts module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.discounts::filter.customer_group';

    /**
     * Return the form builder.
     *
     * @param DiscountInterface $discount
     * @param FilterInterface   $filter
     * @return FilterExtensionFormBuilder
     */
    public function form(DiscountInterface $discount, FilterInterface $filter = null)
    {
        return $this->dispatch(new GetFormBuilder($this, $discount, $filter));
    }

    /**
     * Return the column value for the table.
     *
     * @param DiscountInterface $discount
     * @param FilterInterface   $filter
     * @return string
     */
    public function column(DiscountInterface $discount, FilterInterface $filter)
    {
        return $this->dispatch(new GetColumnValue($this, $discount, $filter));
    }

    /**
     * Return if a product passes the filter or not.
     *
     * @param DiscountInterface $discount
     * @param FilterInterface   $filter
     * @param ProductInterface  $product
     * @return bool
     */
    public function passes(DiscountInterface $discount, FilterInterface $filter, ProductInterface $product)
    {
        return $this->dispatch(new ValidateDiscountFilter($discount, $filter, $product));
    }
}
