<?php

namespace Magenest\Chapter5\Model\Product\Attribute\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;
use Magenest\Chapter5\Helper\Data;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;

class AddCustomerGroup extends AbstractSource implements SourceInterface,OptionSourceInterface
{
    protected $_dataHelper;
    /**
     * @var OptionFactory
     */
    protected $optionFactory;

    /**
     * @param OptionFactory $optionFactory
     */
    public function __construct(OptionFactory $optionFactory, Data $dataHelper)
    {
        $this->_dataHelper = $dataHelper;
        $this->optionFactory = $optionFactory;
    }

    /**
     * @return array
     */
    public function getAllOptions()
    {
        $tags = $this->_dataHelper->getCollection();
        foreach ($tags as $tag) {
            $this->_options[] = [
                'label' => $tag['customer_group_code'],
                'value' => $tag['customer_group_id']
            ];
        }
        return $this->_options;
    }


    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }

    /**
     * Retrieve flat column definition
     *
     * @return array
     */
    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();

        return [
            $attributeCode => [
                'unsigned' => false,
                'default' => null,
                'extra' => null,
                'type' => Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'Bundle Price View ' . $attributeCode . ' column',
            ],
        ];
    }

    /**
     * Retrieve Select for update Attribute value in flat table
     *
     * @param int $store
     * @return  \Magento\Framework\DB\Select|null
     */
    public function getFlatUpdateSelect($store)
    {
        return $this->optionFactory->create()->getFlatUpdateSelect($this->getAttribute(), $store, false);
    }
}