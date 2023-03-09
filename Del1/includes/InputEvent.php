<?php
declare(strict_types=1); // Check for type cast problems
error_reporting(E_ALL); // Report and exit for all errors
/**
 * This is a PHP class definition for an InputEvent.
 * The class has three private properties: $name, $message, and $timestamp,
 * and a constructor that takes these three properties as arguments and assigns them to the corresponding properties.
 * The class also has three getter methods: getName(), getMessage(), and getTimestamp(),
 * which return the values of the corresponding properties.
 * The class is well-documented with inline comments that describe the purpose of each property and method,
 * and provide documentation for the constructor parameters.
 */
class InputEvent
{
    /**
     * private properties $name
     * @var
     */
    private $name;



    /**
     * private properties $message
     * @var
     */
    private $message;


    /**
     * private properties $timestamp
     * @var
     */
    private $timestamp;

    /**
     * The constructor method of the InputEvent class initializes a new InputEvent object
     * with the provided $name, $message, and $timestamp properties.
     *
     *  The constructor takes three parameters: $name, $message, and $timestamp,
     *  which are used to set the corresponding properties of the InputEvent object.
     *
     * @param $name
     * @param $message
     * @param $timestamp
     */
    public function __construct($name, $message, $timestamp) {
        $this->name = $name;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    /**
     * The getName() method returns the value of the $name property
     * @return name
     */
    function getName() {
        return $this->name;
    }

    /**
     * getMessage() returns the value of the $message property
     * @return message
     */
    function getMessage() {
        return $this->message;
    }

    /**
     *  getTimestamp() returns the value of the $timestamp property.
     * @return timestamp
     */
    function getTimestamp() {
        return $this->timestamp;
    }
}