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
 * @package     Axis_Controller
 * @copyright   Copyright 2008-2010 Axis
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Axis_Controller
 * @author      Axis Core Team <core@axiscommerce.com>
 * @abstract
 */
abstract class Axis_Controller_Action extends Zend_Controller_Action
{
    /**
     *  Main init
     */
    public function init()
    {
        parent::init();

        $this->db = Axis::db();
        $this->initView();
    }

    /**
     * Initialize View object
     *
     * @return Zend_View_Interface
     * @see Zend_Controller_Action initView()
     */
    public function initView()
    {
//        $view = parent::initView();
        require_once 'Zend/View/Interface.php';
        if (!$this->getInvokeArg('noViewRenderer')
            && $this->_helper->hasHelper('viewRenderer')) {

            $view = $this->view;
        } elseif (isset($this->view)
            && ($this->view instanceof Zend_View_Interface)) {

            $view = $this->view;
        } else {
            require_once 'Zend/View.php';
            $view = new Zend_View();
        }
        if ($view->templateName) {
            return $view;
        }

        if (Axis_Area::isBackend()) {
            $templateId = Axis::config('design/main/adminTemplateId');
        } else {
            $templateId = Axis::config('design/main/frontTemplateId');
        }

        $theme = Axis::single('core/template')->getTemplateNameById($templateId);

        $request = $this->getRequest();
        $systemPath = Axis::config('system/path');

        $view->templateName = $theme;
        $view->area = $area = Axis_Area::getArea();
        list($namespace, $module) = explode('_', $request->getModuleName(), 2);
        $view->namespace    = $namespace;
        $view->moduleName   = $module;

        $view->path         = $systemPath;
        $view->skinPath     = $systemPath . '/skin/' . $area . '/' . $theme;

        $currentUrl = $request->getScheme() . '://'
             . $request->getHttpHost()
             . $request->getRequestUri();

        $site = Axis::getSite();

        $view->baseUrl      = $site ?
            $site->base : Zend_Controller_Front::getInstance()->getBaseUrl();
        $view->secureUrl    = $site ? $site->secure : $view->baseUrl;
        $view->resourceUrl  = (0 === strpos($currentUrl, $view->secureUrl)) ?
            $view->secureUrl : $view->baseUrl;
        $view->catalogUrl   = Axis::config('catalog/main/route');

        //@TODO every template shoud have own defaults
        //$view->defaultTemplate = 'default';

        //Initialize Zend_View stack
        if (Axis_Area::isFrontend()) {
            $modulePath = strtolower($module);
        } else {
            $controller = $request->getControllerName();
            $modulePath = 'core';
            if (strpos($controller, '_')) {
                list($modulePath) = explode('_', $controller);
            }
        }

        $view->addFilterPath($systemPath . '/library/Axis/View/Filter', 'Axis_View_Filter');
        $view->addHelperPath($systemPath . '/library/Axis/View/Helper', 'Axis_View_Helper');
        $view->setScriptPath(array());

        $themes = array_unique(array(
            $theme,
            /* @TODO user defined default: $view->defaultTemplate */
            'fallback',
            'default'
        ));
        foreach (array_reverse($themes) as $_theme) {
            $themePath = $systemPath . '/app/design/' . $area . '/' . $_theme;
            if (is_readable($themePath . '/helpers')) {
                $view->addHelperPath($themePath . '/helpers', 'Axis_View_Helper');
            }
            if (is_readable($themePath . '/templates')) {
                $view->addScriptPath($themePath . '/templates');
                $view->addScriptPath($themePath . '/templates/' . $modulePath);
            }
            if (is_readable($themePath . '/layouts')) {
                $view->addScriptPath($themePath . '/layouts');
            }
        }

        // setting default meta tags
        $view->meta()->setDefaults();

        $view->doctype('XHTML1_STRICT');

        $view->setEncoding('UTF-8');
        //$view = Axis::app()->getBootstrap()->getResource('View');
        $this->view = $view;

        //for compatibility
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setView($view);

        // init layout

        $this->layout = Axis_Layout::getMvcInstance();

        $this->layout->setView($view)
            ->setOptions(array('layoutPath' =>
                $systemPath . '/app/design/' . $area . '/' . $theme . '/layouts'
        ));

        //backend $this->_helper->removeHelper('json');
        $this->_helper->addHelper(new Axis_Controller_Action_Helper_Json());

        Axis_FirePhp::log('Axis_Core_Box_Abstract::setView');
        Axis_Core_Box_Abstract::setView($view);
        return $view;
    }

    /**
     * Write a snapshot to session
     *
     * @param string $snapshot
     * @return void
     */
    protected function _setSnapshot($snapshot)
    {
        Axis::session()->snapshot = $snapshot;
    }

    /**
     * Retrieve snapshot from session
     *
     * @return string
     */
    protected function _getSnapshot()
    {
        $snapshot = Axis::session()->snapshot;
        unset(Axis::session()->snapshot);
        return $snapshot;
    }

    /**
     * @return bool
     */
    protected function _hasSnapshot()
    {
        return isset(Axis::session()->snapshot)
            && !empty(Axis::session()->snapshot);
    }
}