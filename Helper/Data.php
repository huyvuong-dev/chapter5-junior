<?php
namespace Magenest\Chapter5\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $_customerGroupCollection;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupCollection
    ) {
        $this->_customerGroupCollection = $customerGroupCollection;
        parent::__construct($context);
    }

    public function getCollection()
    {
        return $this->_customerGroupCollection->getData();
    }
}
