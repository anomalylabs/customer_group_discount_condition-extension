<?php namespace Anomaly\CustomerGroupDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\CustomerGroupDiscountConditionExtension\CustomerGroupDiscountConditionExtension;
use Anomaly\CustomersModule\Customer\Contract\CustomerInterface;
use Anomaly\CustomersModule\Group\Contract\GroupInterface;
use Anomaly\CustomersModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

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
        $this->extension = $extension;
        $this->target    = $target;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @param GroupRepositoryInterface $categories
     * @return string
     */
    public function handle(
        ConfigurationRepositoryInterface $configuration,
        GroupRepositoryInterface $categories,
        Guard $auth
    ) {

        /**
         * If we don't have a user
         * we can't have a customer.
         *
         * @var UserInterface $user
         */
        if (!$user = $auth->user()) {
            return false;
        }

        /**
         * The customer is what we
         * are after after all..
         *
         * @var CustomerInterface $customer
         */
        if (!$customer = $user->call('get_customer')) {
            return false;
        }

        /* @var GroupInterface $value */
        if (!$value = $categories->find(
            $configuration->value(
                'anomaly.extension.customer_group_discount_condition::value',
                $this->extension->getCondition()->getId()
            )
        )
        ) {
            return false;
        }

        return $customer->hasGroup($value);
    }
}
