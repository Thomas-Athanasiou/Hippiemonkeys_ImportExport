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

    use SimpleXMLElement,
        Magento\Framework\Model\Context,
        Magento\Framework\Module\Dir as ModuleDirectory,
        Magento\Framework\Filesystem,
        Magento\Framework\Convert\Xml;

    class SourceXml
    extends AbstractSource
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
            Xml $xmlConverter,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $moduleDirectory, $filesystem, $data);
            $this->_xmlConverter = $xmlConverter;
        }

        /**
         * {@inheritdoc}
         */
        protected function getSourceArray(): array
        {
            return $this->getXmlConverter()->xmlToAssoc(new SimpleXMLElement($this->getSourceFile()->readAll()));
        }

        /**
         * Xml Converter property
         *
         * @access private
         *
         * @var \Magento\Framework\Convert\Xml $_xmlConverter
         */
        private $_xmlConverter;

        /**
         * Gets Xml Converter
         *
         * @access private
         *
         * @var \Magento\Framework\Convert\Xml
         */
        protected function getXmlConverter(): Xml
        {
            return $this->_xmlConverter;
        }
    }
?>