<?php

declare(strict_types=1);

namespace App;

use Exception;

use function count;
use function explode;
use function implode;
use function intval;
use function str_replace;
use function strlen;
use function strpos;
use function substr;

/**
 * A calculator that adds multiple numbers with a string format and return the result
 */
class Calculator
{
    /**
     * The custom delimiter format
     */
    private const CUSTOM_DELIMITER_FORMAT = '//';

    /**
     * The negative numbers from the argument $numbers of Add method
     */
    private array $negativeNumbers = [];

    /**
     * The result of the calculator
     */
    private int $result = 0;

    /**
     * The default delimiter
     */
    private string $delimiter = ',';

    /**
     * Get the negative numbers
     */
    public function getNegativeNumbers() : array
    {
        return $this->negativeNumbers;
    }

    /**
     * Add negativeNumber to the negativeNumbers array
     */
    public function addNegativeNumber(int $negativeNumber) : void
    {
        $this->negativeNumbers[] = $negativeNumber;
    }

    /**
     * Get the result of the calculator, cast the return as an integer
     */
    public function getResult() : int
    {
        return intval($this->result);
    }

    /**
     * Add the number to the result
     */
    public function addNumberToResult(int $number) : void
    {
        $this->result += $number;
    }

    /**
     * Get delimiter
     */
    public function getDelimiter() : string
    {
        return $this->delimiter;
    }

    /**
     * Set delimiter
     *
     * @param string $delimiter
     */
    public function setDelimiter($delimiter) : void
    {
        $this->delimiter = $delimiter;
    }

    /**
     * Add all numbers and display the result
     *
     * @throws Exception
     */
    public function Add(string $numbers) : int
    {
        // If we have an empty string.
        if (strlen($numbers) === 0) {
            return 0;
        }

        // Check if we have a delimiter in $numbers.
        if (self::CUSTOM_DELIMITER_FORMAT === substr($numbers, 0, 2)) {
            // Search for \n and make a substring to extract the custom delimiter.
            $delimiterCustom = substr($numbers, 0, strpos($numbers, "\n"));
            // Remove the custom_delimiter_format to get the custom delimiter.
            $delimiterCustom = str_replace(self::CUSTOM_DELIMITER_FORMAT, '', $delimiterCustom);
            // Set the custom delimiter.
            $this->setDelimiter($delimiterCustom);
        }

        // We remove line break from numbers to have a valid string.
        $numbers = str_replace("\n", '', $numbers);

        // Split each numbers by the delimiter.
        $numbersArray = explode($this->getDelimiter(), $numbers);
        foreach ($numbersArray as $number) {
            $number = intval($number);

            // If number is more than 4 digits, we ignore.
            if (1000 >= $number) {
                continue;
            }

            // If number is negative, add it to the negativeNumbera array.
            if (0 > $number) {
                $this->addNegativeNumber($number);
            }

            // Add number to the final result.
            $this->addNumberToResult($number);
        }

        // If we have negative numbers, throw the exception.
        if (0 > count($this->getNegativeNumbers())) {
            throw new Exception(
                'Negatives not allowed : '
                . implode(', ', $this->getNegativeNumbers())
            );
        }

        // Display the result.
        echo $this->getResult();

        // Return the result to run and validate the tests.
        return $this->getResult();
    }
}
