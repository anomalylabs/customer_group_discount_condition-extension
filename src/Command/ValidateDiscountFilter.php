<?php namespace Anomaly\CustomerGroupDiscountFilterExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\CustomerGroupDiscountFilterExtension\CustomerGroupDiscountFilterExtension;
use Anomaly\CustomersModule\Group\Contract\GroupInterface;
use Anomaly\CustomersModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\CustomersModule\Product\Contract\ProductInterface;

/**
 * Class ValidateDiscountFilter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CustomerGroupDiscountFilterExtension\Command
 */
class ValidateDiscountFilter
{

    /**
     * The extension instance.
     *
     * @var CustomerGroupDiscountFilterExtension
     */
    private $extension;

    /**
     * The target object.
     *
     * @var mixed
     */
    private $target;

    /**
     * Create a new ValidateDiscountFilter instance.
     *
     * @param CustomerGroupDiscountFilterExtension $extension
     * @param                                      $target
     */
    public function __construct(CustomerGroupDiscountFilterExtension $extension, $target)
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
            $configuration->value('anomaly.extension.customer_group_discount_filter::value', $this->filter->getId())
        )
        ) {
            return false;
        }

        $categories = $this->product->getCategories();

        return $categories->has($value->getId());
    }
}
