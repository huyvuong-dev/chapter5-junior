<?php
namespace Magenest\Chapter5\Block;

use Magento\Catalog\Model\ProductRepository;

class Test extends \Magento\Framework\View\Element\Template
{
    protected $_productRepository;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ProductRepository $productRepository,
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getInfo(){
        $tmp = $this->_productRepository->getById(2055)->getCustomAttribute('sample_save')->getValue();
        $lastStr = strrpos($tmp,'varchar');
        $result = substr($tmp,0,$lastStr);
        return $result;
    }
}