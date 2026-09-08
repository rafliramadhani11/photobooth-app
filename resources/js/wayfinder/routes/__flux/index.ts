import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../wayfinder'
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
const __flux = {
    flag: Object.assign(flag, flag),
}

export default __flux