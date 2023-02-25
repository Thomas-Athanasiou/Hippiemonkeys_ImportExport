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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Magento\ImportExport\Model\Import\AbstractEntity;

    /**
     * @api
     */
    interface EntityInterface
    extends ModelInterface
    {
        /**
         * Gets Behavior
         *
         * @access public
         *
         * @return string
         */
        function getBehavior(): string;

        /**
         * Sets Behavior
         *
         * @access public
         *
         * @param string $behavior
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function setBehavior(string $behavior): EntityInterface;

        /**
         * Gets Validation Strategy
         *
         * @access public
         *
         * @return string
         */
        function getValidationStrategy(): string;

        /**
         * Sets Behavior
         *
         * @access public
         *
         * @param string $validationStrategy
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function setValidationStrategy(string $validationStrategy): EntityInterface;

        /**
         * Gets Allowed Error Count
         *
         * @access public
         *
         * @return int
         */
        function getAllowedErrorCount(): int;

        /**
         * Sets Allowed Error Count
         *
         * @access public
         *
         * @param int $allowedErrorCount
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function setAllowedErrorCount(int $allowedErrorCount): EntityInterface;

        /**
         * Configures internal entity instance with the required parameters set
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function configureEntity(): EntityInterface;

        /**
         * Gets Import Entity
         *
         * @access public
         *
         * @return \Magento\ImportExport\Model\Import\AbstractEntity
         */
        function getEntity(): AbstractEntity;

        /**
         * Sets Import Entity
         *
         * @access public
         *
         * @param \Magento\ImportExport\Model\Import\AbstractEntity
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\EntityInterface
         */
        function setEntity(AbstractEntity $abstractEntity): EntityInterface;
    }
?>