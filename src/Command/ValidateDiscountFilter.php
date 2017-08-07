<?php namespace Anomaly\CustomerGroupDiscountFilterExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Anomaly\DiscountsModule\Filter\Contract\FilterInterface;
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
     * The filter interface.
     *
     * @var FilterInterface
     */
    protected $filter;

    /**
     * The product instance.
     *
     * @var ProductInterface
     */
    protected $product;

    /**
     * The discount interface.
     *
     * @var DiscountInterface
     */
    protected $discount;

    /**
     * Create a new ValidateDiscountFilter instance.
     *
     * @param ProductInterface  $product
     * @param FilterInterface   $filter
     * @param DiscountInterface $discount
     */
    public function __construct(ProductInterface $product, FilterInterface $filter, DiscountInterface $discount)
    {
        $this->filter   = $filter;
        $this->product  = $product;
        $this->discount = $discount;
    }

    /**
     * Handle the command.
     *
     * @param GroupRepositoryInterface      $categories
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
