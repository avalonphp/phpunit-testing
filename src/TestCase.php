<?php
/*!
 * Avalon
 * Copyright 2011-2016 Jack P.
 * https://github.com/avalonphp
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Avalon\Testing\PhpUnit;

use Avalon\AppKernel;
use Avalon\Http\RedirectResponse;
use Avalon\Routing\Router;
use Avalon\Testing\TestSuite;
use Avalon\Testing\Http\MockRequest;
use Avalon\Testing\Http\Response;

/**
 * Extends the PHPUnit TestCase class to add helper methods.
 *
 * @package Avalon\Testing\PhpUnit
 * @author  Jack P.
 * @since   1.0.0
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AppKernel
     */
    public static $app;

    /**
     * @return AppKernel
     */
    protected static function getApp()
    {
        return static::$app;
    }

    /**
     * Visit the route.
     *
     * @return Response
     */
    protected function visit($routeName, array $requestInfo = [])
    {
        $requestInfo = $requestInfo + ['routeTokens' => []];

        $route = $this->generateUrl($routeName, $requestInfo['routeTokens']);
        $request = new MockRequest($route, $requestInfo);

        return $this->getApp()->process($request);
    }

    /**
     * Generate a route URL.
     *
     * @param string $route
     * @param array  $tokens
     *
     * @return string
     */
    protected function generateUrl($route, $tokens = [])
    {
        return Router::generateUrl($route, $tokens);
    }
}
