<?php namespace Anomaly\CustomerGroupDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;
use Anomaly\DiscountsModule\Condition\Extension\ConditionExtension;
use Anomaly\CustomersModule\Group\Contract\GroupInterface;
use Anomaly\CustomersModule\Group\Contract\GroupRepositoryInterface;
use Illuminate\Translation\Translator;

/**
 * Class GetColumnValue
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CustomerGroupDiscountConditionExtension\Command
 */
class GetColumnValue
{

    /**
     * The discount interface.
     *
     * @var DiscountInterface
     */
    protected $discount;

    /**
     * The condition interface.
     *
     * @var ConditionInterface
     */
    protected $condition;

    /**
     * The condition extension.
     *
     * @var ConditionExtension
     */
    protected $extension;

    /**
     * Create a new GetColumnValue instance.
     *
     * @param ConditionExtension   $extension
     * @param DiscountInterface $discount
     * @param ConditionInterface   $condition
     */
    public function __construct(
        ConditionExtension $extension,
        DiscountInterface $discount,
        ConditionInterface $condition = null
    ) {
        $this->discount  = $discount;
        $this->condition    = $condition;
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @return string
     */
    public function handle(
        Translator $translator,
        GroupRepositoryInterface $categories,
        ConfigurationRepositoryInterface $configuration
    ) {
        $operator = $configuration->presenter(
            'anomaly.extension.customer_group_discount_condition::operator',
            $this->condition->getId()
        )->value;

        /* @var GroupInterface $value */
        if ($value = $categories->find(
            $configuration->value('anomaly.extension.customer_group_discount_condition::value', $this->condition->getId())
        )
        ) {
            $value = $value->getName();
        }

        return $translator->trans(
            'anomaly.extension.customer_group_discount_condition::message.condition',
            compact('operator', 'value')
        );
    }
}
