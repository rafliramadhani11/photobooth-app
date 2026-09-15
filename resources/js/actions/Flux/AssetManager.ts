import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \Flux\AssetManager::fluxJs
 * @see vendor/livewire/flux/src/AssetManager.php:88
 * @route '/flux/flux.js'
 */
export const fluxJs = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fluxJs.url(options),
    method: 'get',
})

fluxJs.definition = {
    methods: ["get","head"],
    url: '/flux/flux.js',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::fluxJs
 * @see vendor/livewire/flux/src/AssetManager.php:88
 * @route '/flux/flux.js'
 */
fluxJs.url = (options?: RouteQueryOptions) => {
    return fluxJs.definition.url + queryParams(options)
}

/**
* @see \Flux\AssetManager::fluxJs
 * @see vendor/livewire/flux/src/AssetManager.php:88
 * @route '/flux/flux.js'
 */
fluxJs.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fluxJs.url(options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::fluxJs
 * @see vendor/livewire/flux/src/AssetManager.php:88
 * @route '/flux/flux.js'
 */
fluxJs.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: fluxJs.url(options),
    method: 'head',
})

/**
* @see \Flux\AssetManager::fluxMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:94
 * @route '/flux/flux.min.js'
 */
export const fluxMinJs = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fluxMinJs.url(options),
    method: 'get',
})

fluxMinJs.definition = {
    methods: ["get","head"],
    url: '/flux/flux.min.js',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::fluxMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:94
 * @route '/flux/flux.min.js'
 */
fluxMinJs.url = (options?: RouteQueryOptions) => {
    return fluxMinJs.definition.url + queryParams(options)
}

/**
* @see \Flux\AssetManager::fluxMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:94
 * @route '/flux/flux.min.js'
 */
fluxMinJs.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fluxMinJs.url(options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::fluxMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:94
 * @route '/flux/flux.min.js'
 */
fluxMinJs.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: fluxMinJs.url(options),
    method: 'head',
})

/**
* @see \Flux\AssetManager::editorCss
 * @see vendor/livewire/flux/src/AssetManager.php:100
 * @route '/flux/editor.css'
 */
export const editorCss = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorCss.url(options),
    method: 'get',
})

editorCss.definition = {
    methods: ["get","head"],
    url: '/flux/editor.css',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::editorCss
 * @see vendor/livewire/flux/src/AssetManager.php:100
 * @route '/flux/editor.css'
 */
editorCss.url = (options?: RouteQueryOptions) => {
    return editorCss.definition.url + queryParams(options)
}

/**
* @see \Flux\AssetManager::editorCss
 * @see vendor/livewire/flux/src/AssetManager.php:100
 * @route '/flux/editor.css'
 */
editorCss.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorCss.url(options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::editorCss
 * @see vendor/livewire/flux/src/AssetManager.php:100
 * @route '/flux/editor.css'
 */
editorCss.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: editorCss.url(options),
    method: 'head',
})

/**
* @see \Flux\AssetManager::editorJs
 * @see vendor/livewire/flux/src/AssetManager.php:106
 * @route '/flux/editor.js'
 */
export const editorJs = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorJs.url(options),
    method: 'get',
})

editorJs.definition = {
    methods: ["get","head"],
    url: '/flux/editor.js',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::editorJs
 * @see vendor/livewire/flux/src/AssetManager.php:106
 * @route '/flux/editor.js'
 */
editorJs.url = (options?: RouteQueryOptions) => {
    return editorJs.definition.url + queryParams(options)
}

/**
* @see \Flux\AssetManager::editorJs
 * @see vendor/livewire/flux/src/AssetManager.php:106
 * @route '/flux/editor.js'
 */
editorJs.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorJs.url(options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::editorJs
 * @see vendor/livewire/flux/src/AssetManager.php:106
 * @route '/flux/editor.js'
 */
editorJs.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: editorJs.url(options),
    method: 'head',
})

/**
* @see \Flux\AssetManager::editorMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:112
 * @route '/flux/editor.min.js'
 */
export const editorMinJs = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorMinJs.url(options),
    method: 'get',
})

editorMinJs.definition = {
    methods: ["get","head"],
    url: '/flux/editor.min.js',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::editorMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:112
 * @route '/flux/editor.min.js'
 */
editorMinJs.url = (options?: RouteQueryOptions) => {
    return editorMinJs.definition.url + queryParams(options)
}

/**
* @see \Flux\AssetManager::editorMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:112
 * @route '/flux/editor.min.js'
 */
editorMinJs.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: editorMinJs.url(options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::editorMinJs
 * @see vendor/livewire/flux/src/AssetManager.php:112
 * @route '/flux/editor.min.js'
 */
editorMinJs.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: editorMinJs.url(options),
    method: 'head',
})

/**
* @see \Flux\AssetManager::flag
 * @see vendor/livewire/flux/src/AssetManager.php:49
 * @route '/flux/flags/{country}'
 */
export const flag = (args: { country: string | number } | [country: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: flag.url(args, options),
    method: 'get',
})

flag.definition = {
    methods: ["get","head"],
    url: '/flux/flags/{country}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Flux\AssetManager::flag
 * @see vendor/livewire/flux/src/AssetManager.php:49
 * @route '/flux/flags/{country}'
 */
flag.url = (args: { country: string | number } | [country: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { country: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    country: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        country: args.country,
                }

    return flag.definition.url
            .replace('{country}', parsedArgs.country.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Flux\AssetManager::flag
 * @see vendor/livewire/flux/src/AssetManager.php:49
 * @route '/flux/flags/{country}'
 */
flag.get = (args: { country: string | number } | [country: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: flag.url(args, options),
    method: 'get',
})
/**
* @see \Flux\AssetManager::flag
 * @see vendor/livewire/flux/src/AssetManager.php:49
 * @route '/flux/flags/{country}'
 */
flag.head = (args: { country: string | number } | [country: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: flag.url(args, options),
    method: 'head',
})
const AssetManager = { fluxJs, fluxMinJs, editorCss, editorJs, editorMinJs, flag }

export default AssetManager