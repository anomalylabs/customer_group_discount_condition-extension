<?php namespace Anomaly\CustomerGroupDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\CustomerGroupDiscountConditionExtension\CustomerGroupDiscountConditionExtension;
use Anomaly\CustomersModule\Group\Contract\GroupInterface;
use Anomaly\CustomersModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\CustomersModule\Product\Contract\ProductInterface;

/**
 * Class ValidateDiscountCondition
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CustomerGroupDiscountConditionExtension\Command
 */
class ValidateDiscountCondition
{

    /**
     * The extension instance.
     *
     * @var CustomerGroupDiscountConditionExtension
     */
    private $extension;

    /**
     * The target object.
     *
     * @var mixed
     */
    private $target;

    /**
     * Create a new ValidateDiscountCondition instance.
     *
     * @param CustomerGroupDiscountConditionExtension $extension
     * @param                                      $target
     */
    public function __construct(CustomerGroupDiscountConditionExtension $extension, $target)
    {

        $this->target    = $target;
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param GroupRepositoryInterface         $categories
     * @param ConfigurationRepositoryInterface $configuration
     * @return string
     */
    public function handle(GroupRepositoryInterface $categories, ConfigurationRepositoryInterface $configuration)
    {
        /* @var GroupInterface $value */
        if (!$value = $categories->find(
            $configuration->value('anomaly.extension.customer_group_discount_condition::value', $this->condition->getId())
        )
        ) {
            return false;
        }

        $categories = $this->product->getCategories();

        return $categories->has($value->getId());
    }
}
