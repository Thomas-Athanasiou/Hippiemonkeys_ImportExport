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

    namespace Hippiemonkeys\ImportExport\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractTableResource as AbstractResource,
        Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface;

    class Job
    extends AbstractResource
    implements JobResourceInterface
    {
        /**
         * {@inheritdoc}
         */
        public function saveJob(JobInterface $job): JobResourceInterface
        {
            return $this->saveModel($job);
        }

        /**
         * {@inheritdoc}
         */
        public function loadJobById(JobInterface $job, $id): JobResourceInterface
        {
            return $this->loadModel($job, $id, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteJob(JobInterface $job): bool
        {
            return $this->deleteModel($job);
        }
    }
?>