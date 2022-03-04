<?php

/**
 * Data validator "in list" field filter class
 * 
 * @author Christophe SAUVEUR <chsxf.pro@gmail.com>
 */

namespace chsxf\MFX\DataValidator\Filter;

use chsxf\MFX\DataValidator\AbstractFilter;

/**
 * Descriptor of a filter field checking presence of the value in a list
 */
class In extends AbstractFilter
{
	/**
	 * @var array List of options
	 */
	private array $_options;

	/**
	 * Constructor
	 * @param array $options List of options
	 * @param string $message Error message
	 */
	public function __construct(array $options, ?string $message = NULL)
	{
		if ($message === null) {
			$message = sprintf(dgettext('mfx', "The value of the '%%s' field must be one of the following values: %s"), implode(', ', $options));
		}
		parent::__construct($message);

		$this->_options = $options;
	}

	/**
	 * {@inheritDoc}
	 * @see AbstractFilter::validate()
	 */
	public function validate(string $fieldName, mixed $value, int $atIndex = -1, bool $silent = false): bool
	{
		if (!in_array($value, $this->_options)) {
			if (!$silent) {
				$this->emitMessage($fieldName);
			}
			return false;
		}
		return true;
	}
}
