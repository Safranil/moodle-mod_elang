<?php

/**
 * Prints a particular instance of elang
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package     mod
 * @subpackage  elang
 * @copyright   2013-2015 University of La Rochelle, France
 * @license     http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html CeCILL-B license
 *
 * @since       0.0.1
 */

require_once dirname(dirname(dirname(__FILE__))) . '/config.php';
require_once dirname(__FILE__) . '/locallib.php';

// Get the moodle version
$version = moodle_major_version(true);

// Get the course number
$id = required_param('id', PARAM_INT);

// Get the course module
$cm = get_coursemodule_from_id('elang', $id, 0, false, MUST_EXIST);

// Get the course
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

// Get the exercise
$elang = $DB->get_record('elang', array('id' => $cm->instance), '*', MUST_EXIST);

// Verify the login
require_login($course, true, $cm);

// Get the context
$context = context_module::instance($cm->id);

if (has_capability('mod/elang:report', $context))
{
	require_once dirname(__FILE__) . '/report.php';
}
else
{
	require_once dirname(__FILE__) . '/play.php';
}
