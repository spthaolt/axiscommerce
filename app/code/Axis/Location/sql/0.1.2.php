<?php
/**
 * Axis
 *
 * This file is part of Axis.
 *
 * Axis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Axis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Axis.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Axis
 * @package     Axis_Location
 * @copyright   Copyright 2008-2010 Axis
 * @license     GNU Public License V3.0
 */

class Axis_Location_Upgrade_0_1_2 extends Axis_Core_Model_Migration_Abstract
{
    protected $_version = '0.1.2';
    protected $_info = 'install';

    public function up()
    {
        $installer = Axis::single('install/installer');

        $installer->run("

        -- DROP TABLE IF EXISTS `{$installer->getTable('location_address_format')}`;

        CREATE TABLE IF NOT EXISTS `{$installer->getTable('location_address_format')}` (
            `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(32) NOT NULL,
            `address_format` TEXT NOT NULL DEFAULT '',
            `address_summary` TEXT NOT NULL DEFAULT '',
            PRIMARY KEY  (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        -- DROP TABLE IF EXISTS `{$installer->getTable('location_country')}`;
        CREATE TABLE IF NOT EXISTS `{$installer->getTable('location_country')}` (
            `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(64) NOT NULL default '',
            `iso_code_2` char(2) NOT NULL default '',
            `iso_code_3` char(3) NOT NULL default '',
            `address_format_id` smallint(5) unsigned NOT NULL,
            PRIMARY KEY  (`id`),
            KEY `LOCATION_COUNTRY_ISO2` (`iso_code_2`),
            KEY `LOCATION_COUNTRY_ISO3` (`iso_code_3`),
            KEY `LOCATION_COUNTRY_FORMAT` USING BTREE (`address_format_id`),
            CONSTRAINT `FK_LOCATION_COUNTRY_FORMAT` FOREIGN KEY (`address_format_id`)
                REFERENCES `{$installer->getTable('location_address_format')}` (`id`) ON UPDATE CASCADE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=243 ;

        INSERT INTO `{$installer->getTable('location_country')}` (`id`, `name`, `iso_code_2`, `iso_code_3`, `address_format_id`) VALUES
        (0, 'ALL WORLD COUNTRY', '*', '*', 1),
        (1, 'Afghanistan', 'AF', 'AFG', 1),
        (2, 'Albania', 'AL', 'ALB', 1),
        (3, 'Algeria', 'DZ', 'DZA', 1),
        (4, 'American Samoa', 'AS', 'ASM', 1),
        (5, 'Andorra', 'AD', 'AND', 1),
        (6, 'Angola', 'AO', 'AGO', 1),
        (7, 'Anguilla', 'AI', 'AIA', 1),
        (8, 'Antarctica', 'AQ', 'ATA', 1),
        (9, 'Antigua and Barbuda', 'AG', 'ATG', 1),
        (10, 'Argentina', 'AR', 'ARG', 1),
        (11, 'Armenia', 'AM', 'ARM', 1),
        (12, 'Aruba', 'AW', 'ABW', 1),
        (13, 'Australia', 'AU', 'AUS', 1),
        (14, 'Austria', 'AT', 'AUT', 1),
        (15, 'Azerbaijan', 'AZ', 'AZE', 1),
        (16, 'Bahamas', 'BS', 'BHS', 1),
        (17, 'Bahrain', 'BH', 'BHR', 1),
        (18, 'Bangladesh', 'BD', 'BGD', 1),
        (19, 'Barbados', 'BB', 'BRB', 1),
        (20, 'Belarus', 'BY', 'BLR', 1),
        (21, 'Belgium', 'BE', 'BEL', 1),
        (22, 'Belize', 'BZ', 'BLZ', 1),
        (23, 'Benin', 'BJ', 'BEN', 1),
        (24, 'Bermuda', 'BM', 'BMU', 1),
        (25, 'Bhutan', 'BT', 'BTN', 1),
        (26, 'Bolivia', 'BO', 'BOL', 1),
        (27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1),
        (28, 'Botswana', 'BW', 'BWA', 1),
        (29, 'Bouvet Island', 'BV', 'BVT', 1),
        (30, 'Brazil', 'BR', 'BRA', 1),
        (31, 'British Indian Ocean Territory', 'IO', 'IOT', 1),
        (32, 'Brunei Darussalam', 'BN', 'BRN', 1),
        (33, 'Bulgaria', 'BG', 'BGR', 1),
        (34, 'Burkina Faso', 'BF', 'BFA', 1),
        (35, 'Burundi', 'BI', 'BDI', 1),
        (36, 'Cambodia', 'KH', 'KHM', 1),
        (37, 'Cameroon', 'CM', 'CMR', 1),
        (38, 'Canada', 'CA', 'CAN', 1),
        (39, 'Cape Verde', 'CV', 'CPV', 1),
        (40, 'Cayman Islands', 'KY', 'CYM', 1),
        (41, 'Central African Republic', 'CF', 'CAF', 1),
        (42, 'Chad', 'TD', 'TCD', 1),
        (43, 'Chile', 'CL', 'CHL', 1),
        (44, 'China', 'CN', 'CHN', 1),
        (45, 'Christmas Island', 'CX', 'CXR', 1),
        (46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1),
        (47, 'Colombia', 'CO', 'COL', 1),
        (48, 'Comoros', 'KM', 'COM', 1),
        (49, 'Congo', 'CG', 'COG', 1),
        (50, 'Cook Islands', 'CK', 'COK', 1),
        (51, 'Costa Rica', 'CR', 'CRI', 1),
        (52, 'Cote D''Ivoire', 'CI', 'CIV', 1),
        (53, 'Croatia', 'HR', 'HRV', 1),
        (54, 'Cuba', 'CU', 'CUB', 1),
        (55, 'Cyprus', 'CY', 'CYP', 1),
        (56, 'Czech Republic', 'CZ', 'CZE', 1),
        (57, 'Denmark', 'DK', 'DNK', 1),
        (58, 'Djibouti', 'DJ', 'DJI', 1),
        (59, 'Dominica', 'DM', 'DMA', 1),
        (60, 'Dominican Republic', 'DO', 'DOM', 1),
        (61, 'East Timor', 'TP', 'TMP', 1),
        (62, 'Ecuador', 'EC', 'ECU', 1),
        (63, 'Egypt', 'EG', 'EGY', 1),
        (64, 'El Salvador', 'SV', 'SLV', 1),
        (65, 'Equatorial Guinea', 'GQ', 'GNQ', 1),
        (66, 'Eritrea', 'ER', 'ERI', 1),
        (67, 'Estonia', 'EE', 'EST', 1),
        (68, 'Ethiopia', 'ET', 'ETH', 1),
        (69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1),
        (70, 'Faroe Islands', 'FO', 'FRO', 1),
        (71, 'Fiji', 'FJ', 'FJI', 1),
        (72, 'Finland', 'FI', 'FIN', 1),
        (73, 'France', 'FR', 'FRA', 1),
        (74, 'France, Metropolitan', 'FX', 'FXX', 1),
        (75, 'French Guiana', 'GF', 'GUF', 1),
        (76, 'French Polynesia', 'PF', 'PYF', 1),
        (77, 'French Southern Territories', 'TF', 'ATF', 1),
        (78, 'Gabon', 'GA', 'GAB', 1),
        (79, 'Gambia', 'GM', 'GMB', 1),
        (80, 'Georgia', 'GE', 'GEO', 1),
        (81, 'Germany', 'DE', 'DEU', 1),
        (82, 'Ghana', 'GH', 'GHA', 1),
        (83, 'Gibraltar', 'GI', 'GIB', 1),
        (84, 'Greece', 'GR', 'GRC', 1),
        (85, 'Greenland', 'GL', 'GRL', 1),
        (86, 'Grenada', 'GD', 'GRD', 1),
        (87, 'Guadeloupe', 'GP', 'GLP', 1),
        (88, 'Guam', 'GU', 'GUM', 1),
        (89, 'Guatemala', 'GT', 'GTM', 1),
        (90, 'Guinea', 'GN', 'GIN', 1),
        (91, 'Guinea-bissau', 'GW', 'GNB', 1),
        (92, 'Guyana', 'GY', 'GUY', 1),
        (93, 'Haiti', 'HT', 'HTI', 1),
        (94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1),
        (95, 'Honduras', 'HN', 'HND', 1),
        (96, 'Hong Kong', 'HK', 'HKG', 1),
        (97, 'Hungary', 'HU', 'HUN', 1),
        (98, 'Iceland', 'IS', 'ISL', 1),
        (99, 'India', 'IN', 'IND', 1),
        (100, 'Indonesia', 'ID', 'IDN', 1),
        (101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1),
        (102, 'Iraq', 'IQ', 'IRQ', 1),
        (103, 'Ireland', 'IE', 'IRL', 1),
        (104, 'Israel', 'IL', 'ISR', 1),
        (105, 'Italy', 'IT', 'ITA', 1),
        (106, 'Jamaica', 'JM', 'JAM', 1),
        (107, 'Japan', 'JP', 'JPN', 1),
        (108, 'Jordan', 'JO', 'JOR', 1),
        (109, 'Kazakhstan', 'KZ', 'KAZ', 1),
        (110, 'Kenya', 'KE', 'KEN', 1),
        (111, 'Kiribati', 'KI', 'KIR', 1),
        (112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1),
        (113, 'Korea, Republic of', 'KR', 'KOR', 1),
        (114, 'Kuwait', 'KW', 'KWT', 1),
        (115, 'Kyrgyzstan', 'KG', 'KGZ', 1),
        (116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1),
        (117, 'Latvia', 'LV', 'LVA', 1),
        (118, 'Lebanon', 'LB', 'LBN', 1),
        (119, 'Lesotho', 'LS', 'LSO', 1),
        (120, 'Liberia', 'LR', 'LBR', 1),
        (121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1),
        (122, 'Liechtenstein', 'LI', 'LIE', 1),
        (123, 'Lithuania', 'LT', 'LTU', 1),
        (124, 'Luxembourg', 'LU', 'LUX', 1),
        (125, 'Macau', 'MO', 'MAC', 1),
        (126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1),
        (127, 'Madagascar', 'MG', 'MDG', 1),
        (128, 'Malawi', 'MW', 'MWI', 1),
        (129, 'Malaysia', 'MY', 'MYS', 1),
        (130, 'Maldives', 'MV', 'MDV', 1),
        (131, 'Mali', 'ML', 'MLI', 1),
        (132, 'Malta', 'MT', 'MLT', 1),
        (133, 'Marshall Islands', 'MH', 'MHL', 1),
        (134, 'Martinique', 'MQ', 'MTQ', 1),
        (135, 'Mauritania', 'MR', 'MRT', 1),
        (136, 'Mauritius', 'MU', 'MUS', 1),
        (137, 'Mayotte', 'YT', 'MYT', 1),
        (138, 'Mexico', 'MX', 'MEX', 1),
        (139, 'Micronesia, Federated States of', 'FM', 'FSM', 1),
        (140, 'Moldova, Republic of', 'MD', 'MDA', 1),
        (141, 'Monaco', 'MC', 'MCO', 1),
        (142, 'Mongolia', 'MN', 'MNG', 1),
        (143, 'Montserrat', 'MS', 'MSR', 1),
        (144, 'Morocco', 'MA', 'MAR', 1),
        (145, 'Mozambique', 'MZ', 'MOZ', 1),
        (146, 'Myanmar', 'MM', 'MMR', 1),
        (147, 'Namibia', 'NA', 'NAM', 1),
        (148, 'Nauru', 'NR', 'NRU', 1),
        (149, 'Nepal', 'NP', 'NPL', 1),
        (150, 'Netherlands', 'NL', 'NLD', 1),
        (151, 'Netherlands Antilles', 'AN', 'ANT', 1),
        (152, 'New Caledonia', 'NC', 'NCL', 1),
        (153, 'New Zealand', 'NZ', 'NZL', 1),
        (154, 'Nicaragua', 'NI', 'NIC', 1),
        (155, 'Niger', 'NE', 'NER', 1),
        (156, 'Nigeria', 'NG', 'NGA', 1),
        (157, 'Niue', 'NU', 'NIU', 1),
        (158, 'Norfolk Island', 'NF', 'NFK', 1),
        (159, 'Northern Mariana Islands', 'MP', 'MNP', 1),
        (160, 'Norway', 'NO', 'NOR', 1),
        (161, 'Oman', 'OM', 'OMN', 1),
        (162, 'Pakistan', 'PK', 'PAK', 1),
        (163, 'Palau', 'PW', 'PLW', 1),
        (164, 'Panama', 'PA', 'PAN', 1),
        (165, 'Papua New Guinea', 'PG', 'PNG', 1),
        (166, 'Paraguay', 'PY', 'PRY', 1),
        (167, 'Peru', 'PE', 'PER', 1),
        (168, 'Philippines', 'PH', 'PHL', 1),
        (169, 'Pitcairn', 'PN', 'PCN', 1),
        (170, 'Poland', 'PL', 'POL', 1),
        (171, 'Portugal', 'PT', 'PRT', 1),
        (172, 'Puerto Rico', 'PR', 'PRI', 1),
        (173, 'Qatar', 'QA', 'QAT', 1),
        (174, 'Reunion', 'RE', 'REU', 1),
        (175, 'Romania', 'RO', 'ROM', 1),
        (176, 'Russian Federation', 'RU', 'RUS', 1),
        (177, 'Rwanda', 'RW', 'RWA', 1),
        (178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1),
        (179, 'Saint Lucia', 'LC', 'LCA', 1),
        (180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1),
        (181, 'Samoa', 'WS', 'WSM', 1),
        (182, 'San Marino', 'SM', 'SMR', 1),
        (183, 'Sao Tome and Principe', 'ST', 'STP', 1),
        (184, 'Saudi Arabia', 'SA', 'SAU', 1),
        (185, 'Senegal', 'SN', 'SEN', 1),
        (186, 'Seychelles', 'SC', 'SYC', 1),
        (187, 'Sierra Leone', 'SL', 'SLE', 1),
        (188, 'Singapore', 'SG', 'SGP', 1),
        (189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1),
        (190, 'Slovenia', 'SI', 'SVN', 1),
        (191, 'Solomon Islands', 'SB', 'SLB', 1),
        (192, 'Somalia', 'SO', 'SOM', 1),
        (193, 'South Africa', 'ZA', 'ZAF', 1),
        (194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1),
        (195, 'Spain', 'ES', 'ESP', 1),
        (196, 'Sri Lanka', 'LK', 'LKA', 1),
        (197, 'St. Helena', 'SH', 'SHN', 1),
        (198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1),
        (199, 'Sudan', 'SD', 'SDN', 1),
        (200, 'Suriname', 'SR', 'SUR', 1),
        (201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1),
        (202, 'Swaziland', 'SZ', 'SWZ', 1),
        (203, 'Sweden', 'SE', 'SWE', 1),
        (204, 'Switzerland', 'CH', 'CHE', 1),
        (205, 'Syrian Arab Republic', 'SY', 'SYR', 1),
        (206, 'Taiwan', 'TW', 'TWN', 1),
        (207, 'Tajikistan', 'TJ', 'TJK', 1),
        (208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1),
        (209, 'Thailand', 'TH', 'THA', 1),
        (210, 'Togo', 'TG', 'TGO', 1),
        (211, 'Tokelau', 'TK', 'TKL', 1),
        (212, 'Tonga', 'TO', 'TON', 1),
        (213, 'Trinidad and Tobago', 'TT', 'TTO', 1),
        (214, 'Tunisia', 'TN', 'TUN', 1),
        (215, 'Turkey', 'TR', 'TUR', 1),
        (216, 'Turkmenistan', 'TM', 'TKM', 1),
        (217, 'Turks and Caicos Islands', 'TC', 'TCA', 1),
        (218, 'Tuvalu', 'TV', 'TUV', 1),
        (219, 'Uganda', 'UG', 'UGA', 1),
        (220, 'Ukraine', 'UA', 'UKR', 1),
        (221, 'United Arab Emirates', 'AE', 'ARE', 1),
        (222, 'United Kingdom', 'GB', 'GBR', 1),
        (223, 'United States', 'US', 'USA', 1),
        (224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1),
        (225, 'Uruguay', 'UY', 'URY', 1),
        (226, 'Uzbekistan', 'UZ', 'UZB', 1),
        (227, 'Vanuatu', 'VU', 'VUT', 1),
        (228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1),
        (229, 'Venezuela', 'VE', 'VEN', 1),
        (230, 'Viet Nam', 'VN', 'VNM', 1),
        (231, 'Virgin Islands (British)', 'VG', 'VGB', 1),
        (232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1),
        (233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1),
        (234, 'Western Sahara', 'EH', 'ESH', 1),
        (235, 'Yemen', 'YE', 'YEM', 1),
        (236, 'Yugoslavia', 'YU', 'YUG', 1),
        (237, 'Zaire', 'ZR', 'ZAR', 1),
        (238, 'Zambia', 'ZM', 'ZMB', 1),
        (239, 'Zimbabwe', 'ZW', 'ZWE', 1),
        (240, 'Aaland Islands', 'AX', 'ALA', 1);

        -- DROP TABLE IF EXISTS `{$installer->getTable('location_geozone')}`;
        CREATE TABLE IF NOT EXISTS `{$installer->getTable('location_geozone')}` (
            `id` mediumint(8) unsigned NOT NULL auto_increment,
            `name` varchar(128) NOT NULL,
            `description` text,
            `priority` mediumint(8) NOT NULL,
            `created_on` datetime NOT NULL,
            `modified_on` datetime default NULL,
            PRIMARY KEY  (`id`),
            UNIQUE KEY `priority` (`priority`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        INSERT INTO `{$installer->getTable('location_geozone')}` (`id`, `name`, `description`, `priority`) VALUES (1, 'ALL', 'ALL WORLD', 1),(2, 'USA', 'United State of America', 5);

        -- DROP TABLE IF EXISTS `{$installer->getTable('location_geozone_zone')}`;
        CREATE TABLE IF NOT EXISTS `{$installer->getTable('location_geozone_zone')}` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `geozone_id` mediumint(8) unsigned NOT NULL,
            `zone_id` mediumint(8) unsigned default NULL,
            `created_on` datetime NOT NULL,
            `modified_on` datetime default NULL,
            `country_id` mediumint(8) unsigned NOT NULL,
            PRIMARY KEY  (`id`),
            KEY `FK_LOCATION_GEOZONE_ZONE_ZONE` (`zone_id`),
            KEY `FK_LOCATION_GEOZONE_ZONE_COUNTRY` (`country_id`),
            KEY `FK_LOCATION_GEOZONE_ZONE_GEOZONE` (`geozone_id`),
            CONSTRAINT `FK_LOCATION_GEOZONE_ZONE_COUNTRY` FOREIGN KEY (`country_id`) REFERENCES `{$installer->getTable('location_country')}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `FK_LOCATION_GEOZONE_ZONE_GEOZONE` FOREIGN KEY (`geozone_id`) REFERENCES `{$installer->getTable('location_geozone')}` (`id`) ON DELETE CASCADE,
            CONSTRAINT `FK_LOCATION_GEOZONE_ZONE_ZONE` FOREIGN KEY (`zone_id`) REFERENCES `{$installer->getTable('location_zone')}` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        INSERT INTO `{$installer->getTable('location_geozone_zone')}` (`geozone_id`, `zone_id`, `country_id`) VALUES (1, 0, 0),(2, 0, 223);

        -- DROP TABLE IF EXISTS `{$installer->getTable('location_zone')}`;
        CREATE TABLE IF NOT EXISTS `{$installer->getTable('location_zone')}` (
            `id` mediumint(8) unsigned NOT NULL auto_increment,
            `code` varchar(32) NOT NULL,
            `name` varchar(128) NOT NULL,
            `country_id` mediumint(8) unsigned NOT NULL default '0',
            PRIMARY KEY  (`id`),
            KEY `FK_LOCATION_ZONE_COUNTRY` (`country_id`),
            CONSTRAINT `FK_LOCATION_ZONE_COUNTRY` FOREIGN KEY (`country_id`) REFERENCES `{$installer->getTable('location_country')}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;

        INSERT INTO `{$installer->getTable('location_zone')}` (`id`, `code`, `name`, `country_id`) VALUES
        (0, '*', 'ALL ZONES', 0),
        (1, 'AL', 'Alabama', 223),
        (2, 'AK', 'Alaska', 223),
        (3, 'AS', 'American Samoa', 223),
        (4, 'AZ', 'Arizona', 223),
        (5, 'AR', 'Arkansas', 223),
        (6, 'AF', 'Armed Forces Africa', 223),
        (7, 'AA', 'Armed Forces Americas', 223),
        (8, 'AC', 'Armed Forces Canada', 223),
        (9, 'AE', 'Armed Forces Europe', 223),
        (10, 'AM', 'Armed Forces Middle East', 223),
        (11, 'AP', 'Armed Forces Pacific', 223),
        (12, 'CA', 'California', 223),
        (13, 'CO', 'Colorado', 223),
        (14, 'CT', 'Connecticut', 223),
        (15, 'DE', 'Delaware', 223),
        (16, 'DC', 'District of Columbia', 223),
        (17, 'FM', 'Federated States Of Micronesia', 223),
        (18, 'FL', 'Florida', 223),
        (19, 'GA', 'Georgia', 223),
        (20, 'GU', 'Guam', 223),
        (21, 'HI', 'Hawaii', 223),
        (22, 'ID', 'Idaho', 223),
        (23, 'IL', 'Illinois', 223),
        (24, 'IN', 'Indiana', 223),
        (25, 'IA', 'Iowa', 223),
        (26, 'KS', 'Kansas', 223),
        (27, 'KY', 'Kentucky', 223),
        (28, 'LA', 'Louisiana', 223),
        (29, 'ME', 'Maine', 223),
        (30, 'MH', 'Marshall Islands', 223),
        (31, 'MD', 'Maryland', 223),
        (32, 'MA', 'Massachusetts', 223),
        (33, 'MI', 'Michigan', 223),
        (34, 'MN', 'Minnesota', 223),
        (35, 'MS', 'Mississippi', 223),
        (36, 'MO', 'Missouri', 223),
        (37, 'MT', 'Montana', 223),
        (38, 'NE', 'Nebraska', 223),
        (39, 'NV', 'Nevada', 223),
        (40, 'NH', 'New Hampshire', 223),
        (41, 'NJ', 'New Jersey', 223),
        (42, 'NM', 'New Mexico', 223),
        (43, 'NY', 'New York', 223),
        (44, 'NC', 'North Carolina', 223),
        (45, 'ND', 'North Dakota', 223),
        (46, 'MP', 'Northern Mariana Islands', 223),
        (47, 'OH', 'Ohio', 223),
        (48, 'OK', 'Oklahoma', 223),
        (49, 'OR', 'Oregon', 223),
        (50, 'PW', 'Palau', 163),
        (51, 'PA', 'Pennsylvania', 223),
        (52, 'PR', 'Puerto Rico', 223),
        (53, 'RI', 'Rhode Island', 223),
        (54, 'SC', 'South Carolina', 223),
        (55, 'SD', 'South Dakota', 223),
        (56, 'TN', 'Tennessee', 223),
        (57, 'TX', 'Texas', 223),
        (58, 'UT', 'Utah', 223),
        (59, 'VT', 'Vermont', 223),
        (60, 'VI', 'Virgin Islands', 223),
        (61, 'VA', 'Virginia', 223),
        (62, 'WA', 'Washington', 223),
        (63, 'WV', 'West Virginia', 223),
        (64, 'WI', 'Wisconsin', 223),
        (65, 'WY', 'Wyoming', 223),
        (66, 'AB', 'Alberta', 38),
        (67, 'BC', 'British Columbia', 38),
        (68, 'MB', 'Manitoba', 38),
        (69, 'NF', 'Newfoundland', 38),
        (70, 'NB', 'New Brunswick', 38),
        (71, 'NS', 'Nova Scotia', 38),
        (72, 'NT', 'Northwest Territories', 38),
        (73, 'NU', 'Nunavut', 38),
        (74, 'ON', 'Ontario', 38),
        (75, 'PE', 'Prince Edward Island', 38),
        (76, 'QC', 'Quebec', 38),
        (77, 'SK', 'Saskatchewan', 38),
        (78, 'YT', 'Yukon Territory', 38),
        (79, 'NDS', 'Niedersachsen', 81),
        (80, 'BAW', 'Baden-Wrttemberg', 81),
        (81, 'BAY', 'Bayern', 81),
        (82, 'BER', 'Berlin', 81),
        (83, 'BRG', 'Brandenburg', 81),
        (84, 'BRE', 'Bremen', 81),
        (85, 'HAM', 'Hamburg', 81),
        (86, 'HES', 'Hessen', 81),
        (87, 'MEC', 'Mecklenburg-Vorpommern', 81),
        (88, 'NRW', 'Nordrhein-Westfalen', 81),
        (89, 'RHE', 'Rheinland-Pfalz', 81),
        (90, 'SAR', 'Saarland', 81),
        (91, 'SAS', 'Sachsen', 81),
        (92, 'SAC', 'Sachsen-Anhalt', 81),
        (93, 'SCN', 'Schleswig-Holstein', 81),
        (94, 'THE', 'Thringen', 81),
        (95, 'WI', 'Wien', 14),
        (96, 'NO', 'Niedersterreich', 14),
        (97, 'OO', 'Obersterreich', 14),
        (98, 'SB', 'Salzburg', 14),
        (99, 'KN', 'KÃ¤rtnen', 14),
        (100, 'ST', 'Steiermark', 14),
        (101, 'TI', 'Tirol', 14),
        (102, 'BL', 'Burgenland', 14),
        (103, 'VB', 'Voralberg', 14),
        (104, 'AG', 'Aargau', 204),
        (105, 'AI', 'Appenzell Innerrhoden', 204),
        (106, 'AR', 'Appenzell Ausserrhoden', 204),
        (107, 'BE', 'Bern', 204),
        (108, 'BL', 'Basel-Landschaft', 204),
        (109, 'BS', 'Basel-Stadt', 204),
        (110, 'FR', 'Freiburg', 204),
        (111, 'GE', 'Genf', 204),
        (112, 'GL', 'Glarus', 204),
        (113, 'JU', 'Graubnden', 204),
        (114, 'JU', 'Jura', 204),
        (115, 'LU', 'Luzern', 204),
        (116, 'NE', 'Neuenburg', 204),
        (117, 'NW', 'Nidwalden', 204),
        (118, 'OW', 'Obwalden', 204),
        (119, 'SG', 'St. Gallen', 204),
        (120, 'SH', 'Schaffhausen', 204),
        (121, 'SO', 'Solothurn', 204),
        (122, 'SZ', 'Schwyz', 204),
        (123, 'TG', 'Thurgau', 204),
        (124, 'TI', 'Tessin', 204),
        (125, 'UR', 'Uri', 204),
        (126, 'VD', 'Waadt', 204),
        (127, 'VS', 'Wallis', 204),
        (128, 'ZG', 'Zug', 204),
        (129, 'ZH', 'Zrich', 204),
        (130, 'A Corua', 'A Corua', 195),
        (131, 'Alava', 'Alava', 195),
        (132, 'Albacete', 'Albacete', 195),
        (133, 'Alicante', 'Alicante', 195),
        (134, 'Almeria', 'Almeria', 195),
        (135, 'Asturias', 'Asturias', 195),
        (136, 'Avila', 'Avila', 195),
        (137, 'Badajoz', 'Badajoz', 195),
        (138, 'Baleares', 'Baleares', 195),
        (139, 'Barcelona', 'Barcelona', 195),
        (140, 'Burgos', 'Burgos', 195),
        (141, 'Caceres', 'Caceres', 195),
        (142, 'Cadiz', 'Cadiz', 195),
        (143, 'Cantabria', 'Cantabria', 195),
        (144, 'Castellon', 'Castellon', 195),
        (145, 'Ceuta', 'Ceuta', 195),
        (146, 'Ciudad Real', 'Ciudad Real', 195),
        (147, 'Cordoba', 'Cordoba', 195),
        (148, 'Cuenca', 'Cuenca', 195),
        (149, 'Girona', 'Girona', 195),
        (150, 'Granada', 'Granada', 195),
        (151, 'Guadalajara', 'Guadalajara', 195),
        (152, 'Guipuzcoa', 'Guipuzcoa', 195),
        (153, 'Huelva', 'Huelva', 195),
        (154, 'Huesca', 'Huesca', 195),
        (155, 'Jaen', 'Jaen', 195),
        (156, 'La Rioja', 'La Rioja', 195),
        (157, 'Las Palmas', 'Las Palmas', 195),
        (158, 'Leon', 'Leon', 195),
        (159, 'Lleida', 'Lleida', 195),
        (160, 'Lugo', 'Lugo', 195),
        (161, 'Madrid', 'Madrid', 195),
        (162, 'Malaga', 'Malaga', 195),
        (163, 'Melilla', 'Melilla', 195),
        (164, 'Murcia', 'Murcia', 195),
        (165, 'Navarra', 'Navarra', 195),
        (166, 'Ourense', 'Ourense', 195),
        (167, 'Palencia', 'Palencia', 195),
        (168, 'Pontevedra', 'Pontevedra', 195),
        (169, 'Salamanca', 'Salamanca', 195),
        (170, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 195),
        (171, 'Segovia', 'Segovia', 195),
        (172, 'Sevilla', 'Sevilla', 195),
        (173, 'Soria', 'Soria', 195),
        (174, 'Tarragona', 'Tarragona', 195),
        (175, 'Teruel', 'Teruel', 195),
        (176, 'Toledo', 'Toledo', 195),
        (177, 'Valencia', 'Valencia', 195),
        (178, 'Valladolid', 'Valladolid', 195),
        (179, 'Vizcaya', 'Vizcaya', 195),
        (180, 'Zamora', 'Zamora', 195),
        (181, 'Zaragoza', 'Zaragoza', 195),
        (182, 'ACT', 'Australian Capital Territory', 13),
        (183, 'NSW', 'New South Wales', 13),
        (184, 'NT', 'Northern Territory', 13),
        (185, 'QLD', 'Queensland', 13),
        (186, 'SA', 'South Australia', 13),
        (187, 'TAS', 'Tasmania', 13),
        (188, 'VIC', 'Victoria', 13),
        (189, 'WA', 'Western Australia', 13);

        ");

        Axis::model('location/address_format')->insert(array(
            'name'              => 'ISO/IEC 19773',
            'address_format'    => '{{firstname}} {{lastname}}EOL{{if company}}{{company}}EOL{{/if}}{{if street_address}}{{street_address}}EOL{{/if}}{{if suburb}}{{suburb}}EOL{{/if}}{{if city}}{{city}}{{/if}} {{if zone.name}}{{zone.name}} {{/if}}{{if postcode}}{{postcode}}{{/if}}{{if country}}EOL{{country.name}}EOL{{/if}}{{if phone}}T: {{phone}}EOL{{/if}}{{if fax}}F: {{fax}}EOL{{/if}}',
            'address_summary'   => '{{firstname}} {{lastname}}'
        ));

        Axis::single('admin/menu')
            ->add('Locations / Taxes', null, 70, 'Axis_Location')
            ->add('Locations / Taxes->Countries', 'location_country', 10, 'Axis_Location')
            ->add('Locations / Taxes->Zones', 'location_zone', 20, 'Axis_Location')
            ->add('Locations / Taxes->Zones Definitions', 'location_zone-definition', 30, 'Axis_Location');

        Axis::single('admin/acl_resource')
            ->add('admin/location', 'Locations/Taxes')
            ->add('admin/location_country', 'Countries')
            ->add("admin/location_country/delete")
            ->add("admin/location_country/get-address-format")
            ->add("admin/location_country/index")
            ->add("admin/location_country/list")
            ->add("admin/location_country/save")

            ->add('admin/location_zone', 'Zones')
            ->add("admin/location_zone/delete")
            ->add("admin/location_zone/index")
            ->add("admin/location_zone/list")
            ->add("admin/location_zone/save")
            ->add('admin/location_zone-definition', 'Zones Definitions')

            ->add("admin/location_zone-definition/delete-assigns")
            ->add("admin/location_zone-definition/delete")
            ->add("admin/location_zone-definition/get-assign")
            ->add("admin/location_zone-definition/index")
            ->add("admin/location_zone-definition/list-assigns")
            ->add("admin/location_zone-definition/list")
            ->add("admin/location_zone-definition/save-assign")
            ->add("admin/location_zone-definition/save");

        Axis::single('core/config_field')
            ->add('locale', 'Locale', null, null, array('translation_module' => 'Axis_Locale'))
            ->add('locale/main/addressFormat', 'Locale/General/Default Address Format', 1, 'select', 'Default address format', array('model' => 'AddressFormat'));
    }

    public function down()
    {

    }
}