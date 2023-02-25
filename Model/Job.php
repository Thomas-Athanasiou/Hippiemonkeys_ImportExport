<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ImportExport
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\ImportExport\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface as ResourceInterface,
        Hippiemonkeys\ImportExport\Api\Data\EntityInterface,
        Hippiemonkeys\ImportExport\Api\EntityRepositoryInterface,
        Hippiemonkeys\ImportExport\Api\Data\SourceInterface,
        Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface;

    class Job
    extends AbstractModel
    implements JobInterface
    {
        protected const
            FIELD_SOURCE = 'source',
            FIELD_ENTITY = 'entity';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\ImportExport\Api\EntityRepositoryInterface $entityRepository
         * @param \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $sourceRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            EntityRepositoryInterface $entityRepository,
            SourceRepositoryInterface $sourceRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->_entityRepository = $entityRepository;
            $this->_sourceRepository = $sourceRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function execute(): void
        {
            /**
             * @todo
             */
            $entity = $this->getEntity();
            $entity->configureEntity();
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
        public function getEntity(): EntityInterface
        {
            $entity = $this->getData(static::FIELD_ENTITY);

            if ($entity === null)
            {
                $entity = $this->getSourceRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_ENTITY_ID)
                );
                $this->setData(static::FIELD_ENTITY, $entity);
            }

            return $entity;
        }

        /**
         * {@inheritdoc}
         */
        public function setEntity(EntityInterface $entity): JobInterface
        {
            return $this->setData(ResourceInterface::FIELD_ENTITY_ID, $entity->getId())->setData(static::FIELD_ENTITY, $entity);
        }

        /**
         * {@inheritdoc}
         */
        public function getSource(): SourceInterface
        {
            $source = $this->getData(static::FIELD_SOURCE);

            if ($source === null)
            {
                $source = $this->getSourceRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_SOURCE_ID)
                );
                $this->setData(static::FIELD_SOURCE, $source);
            }

            return $source;
        }

        /**
         * {@inheritdoc}
         */
        public function setSource(SourceInterface $source): JobInterface
        {
            return $this->setData(ResourceInterface::FIELD_SOURCE_ID, $source->getId())->setData(static::FIELD_SOURCE, $source);
        }

        /**
         * Entity Repository property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\ImportExport\Api\EntityRepositoryInterface $_entityRepository
         */
        private $_entityRepository;

        /**
         * Gets Entity Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\EntityRepositoryInterface
         */
        protected function getEntityRepository(): EntityRepositoryInterface
        {
            return $this->_entityRepository;
        }

        /**
         * Source Repository property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface $_sourceRepository
         */
        private $_sourceRepository;

        /**
         * Gets Source Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\ImportExport\Api\SourceRepositoryInterface
         */
        protected function getSourceRepository(): SourceRepositoryInterface
        {
            return $this->_sourceRepository;
        }
    }
?>