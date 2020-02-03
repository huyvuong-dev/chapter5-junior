<?php

namespace Magenest\Chapter5\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Backend\Model\Auth\Session;

class CustomerGroup extends Column
{

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_authSession;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Session $authSession,
        array $components = [],
        array $data = []
    )
    {
        $this->_authSession = $authSession;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepare()
    {
        $firstName = $this->_authSession->getUser()->getFirstName();
        $firstCharacter = substr($firstName, 0, 1);
        $letters = range('A', 'M');
        if (!in_array($firstCharacter, $letters)) {
            $this->_data['config']['componentDisabled'] = true;
        }
        parent::prepare();
    }
}
