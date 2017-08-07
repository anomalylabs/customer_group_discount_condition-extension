<?php namespace Anomaly\CustomerGroupDiscountConditionExtension;

use Anomaly\CustomerGroupDiscountConditionExtension\Command\GetColumnValue;
use Anomaly\CustomerGroupDiscountConditionExtension\Command\GetFormBuilder;
use Anomaly\CustomerGroupDiscountConditionExtension\Command\ValidateDiscountCondition;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;
use Anomaly\DiscountsModule\Condition\Extension\ConditionExtension;
use Anomaly\DiscountsModule\Condition\Extension\Form\ConditionExtensionFormBuilder;

/**
 * Class CustomerGroupDiscountConditionExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CustomerGroupDiscountConditionExtension
 */
class CustomerGroupDiscountConditionExtension extends ConditionExtension
{

    /**
     * This extension provides the category
     * condition for the discounts module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.discounts::condition.customer_group';

    /**
     * Return the form builder.
     *
     * @param DiscountInterface $discount
     * @param ConditionInterface   $condition
     * @return ConditionExtensionFormBuilder
     */
    public function form(DiscountInterface $discount, ConditionInterface $condition = null)
    {
        return $this->dispatch(new GetFormBuilder($this, $discount, $condition));
    }

    /**
     * Return the column value for the table.
     *
     * @param DiscountInterface $discount
     * @param ConditionInterface   $condition
     * @return string
     */
    public function column(DiscountInterface $discount, ConditionInterface $condition)
    {
        return $this->dispatch(new GetColumnValue($this, $discount, $condition));
    }

    /**
     * Return if the condition matches or not.
     *
     * @param $target
     * @return string
     */
    public function matches($target)
    {
        return $this->dispatch(new ValidateDiscountCondition($this, $target));
    }
}
