import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/events/{event}/detail'
 */
const LivewirePageController146a1c65e47140c245bf504974482f4f = (args: { event: string | number | { id: string | number } } | [event: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController146a1c65e47140c245bf504974482f4f.url(args, options),
    method: 'get',
})

LivewirePageController146a1c65e47140c245bf504974482f4f.definition = {
    methods: ["get","head"],
    url: '/events/{event}/detail',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/events/{event}/detail'
 */
LivewirePageController146a1c65e47140c245bf504974482f4f.url = (args: { event: string | number | { id: string | number } } | [event: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { event: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { event: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    event: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        event: typeof args.event === 'object'
                ? args.event.id
                : args.event,
                }

    return LivewirePageController146a1c65e47140c245bf504974482f4f.definition.url
            .replace('{event}', parsedArgs.event.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/events/{event}/detail'
 */
LivewirePageController146a1c65e47140c245bf504974482f4f.get = (args: { event: string | number | { id: string | number } } | [event: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController146a1c65e47140c245bf504974482f4f.url(args, options),
    method: 'get',
})
/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/events/{event}/detail'
 */
LivewirePageController146a1c65e47140c245bf504974482f4f.head = (args: { event: string | number | { id: string | number } } | [event: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: LivewirePageController146a1c65e47140c245bf504974482f4f.url(args, options),
    method: 'head',
})

    /**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/profile'
 */
const LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.url(options),
    method: 'get',
})

LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.definition = {
    methods: ["get","head"],
    url: '/dashboard/settings/profile',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/profile'
 */
LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.url = (options?: RouteQueryOptions) => {
    return LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.definition.url + queryParams(options)
}

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/profile'
 */
LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.url(options),
    method: 'get',
})
/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/profile'
 */
LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16.url(options),
    method: 'head',
})

    /**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/appearance'
 */
const LivewirePageController4e5587561dbcb930cf96e8d4852bdf18 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.url(options),
    method: 'get',
})

LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.definition = {
    methods: ["get","head"],
    url: '/dashboard/settings/appearance',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/appearance'
 */
LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.url = (options?: RouteQueryOptions) => {
    return LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.definition.url + queryParams(options)
}

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/appearance'
 */
LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.url(options),
    method: 'get',
})
/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/appearance'
 */
LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: LivewirePageController4e5587561dbcb930cf96e8d4852bdf18.url(options),
    method: 'head',
})

    /**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/security'
 */
const LivewirePageController0f5c37d948ee6efc7b165b658baa28b0 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.url(options),
    method: 'get',
})

LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.definition = {
    methods: ["get","head"],
    url: '/dashboard/settings/security',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/security'
 */
LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.url = (options?: RouteQueryOptions) => {
    return LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.definition.url + queryParams(options)
}

/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/security'
 */
LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.url(options),
    method: 'get',
})
/**
* @see \Livewire\Mechanisms\HandleRouting\LivewirePageController::__invoke
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRouting/LivewirePageController.php:7
 * @route '/dashboard/settings/security'
 */
LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: LivewirePageController0f5c37d948ee6efc7b165b658baa28b0.url(options),
    method: 'head',
})

/**
* Multiple routes resolve to \Livewire\Mechanisms\HandleRouting\LivewirePageController::LivewirePageController, so this export is a
* dictionary keyed by URI rather than a callable. Call a specific route with `LivewirePageController['<uri>'](...)`,
* or import the route by name from your generated `routes/` directory.
*/
const LivewirePageController = {
    '/events/{event}/detail': LivewirePageController146a1c65e47140c245bf504974482f4f,
    '/dashboard/settings/profile': LivewirePageControllerfe4276e6c3a3337f03594ff5e70bae16,
    '/dashboard/settings/appearance': LivewirePageController4e5587561dbcb930cf96e8d4852bdf18,
    '/dashboard/settings/security': LivewirePageController0f5c37d948ee6efc7b165b658baa28b0,
}

export default LivewirePageController