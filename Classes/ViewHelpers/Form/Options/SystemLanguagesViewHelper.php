<?php
namespace MONOGON\TranslationTools\ViewHelpers\Form\Options;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use MONOGON\TranslationTools\Configuration\ExtConf;

/**
 * TranslationController
 */
class SystemLanguagesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var MONOGON\TranslationTools\Domain\Repository\SystemLanguageRepository
	 * @inject
	 */
	protected $systemLanguageRepository = NULL;

	/**
	 * @return array Files
	 */
	public function render (){

		$defaultLanguage = GeneralUtility::trimExplode(':', ExtConf::get('defaultLanguage'));

		$options = array();
		$options[reset($defaultLanguage)] = end($defaultLanguage);

		$systemLanguages = $this->systemLanguageRepository->findAll();
		foreach ($systemLanguages as $systemLanguage) {
			$options[$systemLanguage->getFlag()] = $systemLanguage->getTitle();
		}

		return $options;
	}

}