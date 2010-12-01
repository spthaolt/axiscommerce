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
 * @package     Axis_Account
 * @subpackage  Axis_Account_Controller
 * @copyright   Copyright 2008-2010 Axis
 * @license     GNU Public License V3.0
 */

/**
 * 
 * @category    Axis
 * @package     Axis_Account
 * @subpackage  Axis_Account_Controller
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Axis_Account_IndexController extends Axis_Account_Controller_Account
{
	public function indexAction()
	{
	    $this->view->pageTitle = Axis::translate('account')->__('My Account');
        $this->view->meta()->setTitle(
            Axis::translate('account')->__(
                'My Account'
        ));
	    $customer = Axis::single('account/customer')
                ->find(Axis::getCustomerId())->current();

        $this->view->customerName = $customer->firstname . ' '
            . $customer->lastname;
        $this->view->customerEmail = $customer->email;
        $this->render();
    }
}