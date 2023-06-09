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

    namespace Hippiemonkeys\ImportExport\Model\Spi;

    use Hippiemonkeys\ImportExport\Api\Data\JobInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Job Resource interface
     */
    interface JobResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_CODE = 'code',
            FIELD_SOURCE_ID = 'source_id',
            FIELD_PROCESSOR_ID = 'processor_id',
            FIELD_ENTITY_TYPE_CODE = 'entity_type_code',
            FIELD_BEHAVIOR = 'behavior',
            FIELD_VALIDATION_STRATEGY = 'validation_strategy',
            FIELD_ALLOWED_ERROR_COUNT = 'allowed_error_count';

        /**
         * Saves Job data
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface
         */
        function saveJob(JobInterface $job): JobResourceInterface;

        /**
         * Loads a Job by its Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         * @param mixed $id
         *
         *@return \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface
         */
        function loadJobById(JobInterface $job, $id): JobResourceInterface;

        /**
         * Loads a Job by its Code
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         * @param string $code
         *
         * @return \Hippiemonkeys\ImportExport\Model\Spi\JobResourceInterface
         */
        function loadJobByCode(JobInterface $job, string $code): JobResourceInterface;

        /**
         * Deletes the Job
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\JobInterface $job
         *
         * @return bool
         */
        function deleteJob(JobInterface $job): bool;
    }
?>