<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Model;

    use Magento\Framework\ObjectManagerInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory;

    class SourceFactoryTypeComposite
    extends SourceInterfaceFactory
    {
        /**
         * Constructor
         *
         * @access protected
         *
         * @param \Magento\Framework\ObjectManagerInterface $objectManager
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory[] $typeFactories
         */
        public function __construct(
            ObjectManagerInterface $objectManager,
            array $typeFactories
        )
        {
            parent::__construct($objectManager);
            $this->_typeFactories = $typeFactories;
        }

        /**
         * Creates a new source instance
         *
         * @access public
         *
         * @param array $data
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        public function create(array $data = []): SourceInterface
        {
            return $this->getTypeFactories() [$data['type']]->create($data);
        }

        /**
         * Gets Object Manager
         *
         * @access protected
         *
         * @return \Magento\Framework\ObjectManagerInterface
         */
        protected function getObjectManager(): ObjectManagerInterface
        {
            return $this->_objectManager;
        }

        /**
         * Type Factories property
         *
         * @access private
         *
         * @var \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory[] $_typeFactories
         */
        private $_typeFactories;

        /**
         * Gets Type Factories
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterfaceFactory[]
         */
        protected function getTypeFactories(): array
        {
            return $this->_typeFactories;
        }
    }
?>