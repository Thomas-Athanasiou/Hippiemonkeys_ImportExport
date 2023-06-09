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

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Model\Spi\SourceResourceInterface as ResourceInterface,
        Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Module\Dir as ModuleDirectory,
        Magento\Framework\Filesystem;

    abstract class AbstractSource
    extends AbstractModel
    implements SourceInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\Framework\Module\Dir $moduleDirectory
         * @param \Magento\Framework\Filesystem $filesystem
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ModuleDirectory $moduleDirectory,
            Filesystem $filesystem,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_moduleDirectory = $moduleDirectory;
            $this->_filesystem = $filesystem;
        }

        /**
         * {@inheritdoc}
         */
        public function getCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setCode(string $code): SourceInterface
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * {@inheritdoc}
         */
        public function getResourceLocator(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setResourceLocator(string $resourceLocator): SourceInterface
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $resourceLocator);
        }

        /**
         * Gets Data String
         *
         * @access protected
         *
         * @return string
         */
        protected function getDataString(): string
        {
            return file_get_contents($this->getResourceLocator(), false, null, 0, null);
        }
    }
?>