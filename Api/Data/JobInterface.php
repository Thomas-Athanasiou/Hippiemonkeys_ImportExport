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

    namespace Hippiemonkeys\ImportExport\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface JobInterface
    extends ModelInterface
    {
        /**
         * Executes the import process
         *
         * @access public
         */
        function execute(): void;

        /**
         * Gets Job Code
         *
         * @access public
         *
         * @return string
         */
        function getCode(): string;

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
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setBehavior(string $behavior): JobInterface;

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
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setValidationStrategy(string $validationStrategy): JobInterface;

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
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setAllowedErrorCount(int $allowedErrorCount): JobInterface;

        /**
         * Gets Source
         *
         * @access public
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\SourceInterface
         */
        function getSource(): SourceInterface;

        /**
         * Sets Source
         *
         * @access public
         *
         * @param \Hippiemonkeys\ImportExport\Api\Data\SourceInterface $source
         *
         * @return \Hippiemonkeys\ImportExport\Api\Data\JobInterface
         */
        function setSource(SourceInterface $source): JobInterface;
    }
?>