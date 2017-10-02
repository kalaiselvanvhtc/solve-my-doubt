<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Engine;

final class Config
{
    // Database info (if you want to test the script, please edit the below constants with yours)
    const
    DB_HOST = 'smddev.database.windows.net',
    DB_NAME = 'smddevenv',
    DB_USR = 'adminsmd@smddev',
    DB_PWD = 'MySQLazureadmin2017',
   
    DB_SSLMODE='prefer',        

    // Title of the site
    SITE_NAME = 'My Simple Blog!';
}
