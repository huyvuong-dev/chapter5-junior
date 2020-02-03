<?php

namespace Magenest\Chapter5\Model\Product\Type;

class NewProductType extends \Magento\Catalog\Model\Product\Type\Virtual {

    const TYPE_ID = "new_product_type";
    /**
     * @inheritDoc
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // TODO: Implement deleteTypeSpecificData() method.
    }
}